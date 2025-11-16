<?php

require_once __DIR__ . '/../../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class SenhaController
{
    /**
     * Exibe o formulário de Esqueci a Senha
     * Mapeado para a rota 'recuperar_senha'.
     */
    public function showForm()
    {
        $data = [
            'titulo' => 'Recuperar Senha',
            'styles' => ['RecuperaSenha/style.css'],
            'scripts' => ['RecuperaSenha/script.js']
        ];
        $this->renderView(__DIR__ . '/../Views/RecuperaSenha.php', $data);
    }

    /**
     * Processa a solicitação de e-mail via AJAX
     * Mapeado para a rota 'recuperar_senha_submit'.
     */
    public function processEmailRequest()
    {
        header('Content-Type: application/json');
        
        $json_data = file_get_contents('php://input');
        $data = json_decode($json_data);
        $email = $data->email ?? null;

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'message' => 'E-mail não é válido']);
            exit;
        }

        $pdo = dbConnect();
        
        try {
            $stmt = $pdo->prepare("SELECT id, nome FROM Usuarios WHERE email = :email");
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch();

            if (!$user) {
                echo json_encode(['success' => false, 'message' => 'E-mail não cadastrado, tente novamente']);
                exit;
            }

            $token = random_int(100000, 999999);
            $data_expiracao = date('Y-m-d H:i:s', strtotime('+15 minutes'));
            $usuario_id = $user['id'];
            $nome_usuario = $user['nome'];

            $sql = "INSERT INTO RecuperacaoSenha (usuario_id, token, data_expiracao, utilizado) 
                    VALUES (:usuario_id, :token, :data_expiracao, 0)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':usuario_id' => $usuario_id,
                ':token' => $token,
                ':data_expiracao' => $data_expiracao
            ]);

            $mail = new PHPMailer(true);

            try {
                // Configurações do Servidor
                //$mail->SMTPDebug = 2;
                $mail->isSMTP();
                //$mail->Host       = 'smtp-mail.outlook.com';
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = getenv('SENDER_EMAIL_USER');
                $mail->Password   = getenv('SENDER_EMAIL_PASS');
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;
                $mail->CharSet    = 'UTF-8';

                // Quem envia e quem recebe
                $mail->setFrom(getenv('SENDER_EMAIL_USER'), 'Portal Acadêmico');
                $mail->addAddress($email, $nome_usuario);

                // Conteúdo do E-mail
                $mail->isHTML(true);
                $mail->Subject = 'Seu Código de Recuperação de Senha';
                $mail->Body    = "Olá, $nome_usuario.<br><br>" .
                                 "Seu código para redefinir a senha é: <b>$token</b><br><br>" .
                                 "Este código expira em 15 minutos.<br>" .
                                 "Se você não solicitou isso, apenas ignore este e-mail.";
                $mail->AltBody = "Seu código para redefinir a senha é: $token";

                $mail->send();
                
                // Se o e-mail foi enviado, retorna sucesso para o AJAX
                echo json_encode(['success' => true]);

            } catch (Exception $e) {
                // Se o PHPMailer falhar
                echo json_encode(['success' => false, 'message' => "E-mail não pôde ser enviado. Erro: {$mail->ErrorInfo}"]);
            }

        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Erro de servidor: ' . $e->getMessage()]);
        }
        exit;
    }

    /**
     * Exibe o formulário de Resetar Senha
     * Mapeado para a rota 'resetar_senha_form'.
     */
    public function showResetForm()
    {
        $data = [
            'titulo' => 'Redefinir Senha',
            'styles' => ['ResetarSenha/style.css'], 
            'scripts' => ['ResetarSenha/script.js']
        ];
        $this->renderView(__DIR__ . '/../Views/ResetarSenha.php', $data);
    }

    /**
     * Processa o formulário de reset de senha
     * Mapeado para a rota 'resetar_senha_submit'.
     */
    public function processResetPassword()
    {
        // Coletar dados do formulário
        $token = $_POST['token'] ?? null;
        $senha = $_POST['senha'] ?? null;
        $confirmar_senha = $_POST['confirmar_senha'] ?? null;

        // Validar senhas
        if (empty($token) || empty($senha) || empty($confirmar_senha)) {
            $this->redirectWithError('resetar_senha_form', 'Todos os campos são obrigatórios.');
        }
        if (strlen($senha) < 8) {
            $this->redirectWithError('resetar_senha_form', 'A senha deve ter no mínimo 8 caracteres.');
        }
        if ($senha !== $confirmar_senha) {
            $this->redirectWithError('resetar_senha_form', 'As senhas não conferem.');
        }

        try {
            $pdo = dbConnect();
            
            // Validar o token
            $sql = "SELECT * FROM RecuperacaoSenha 
                    WHERE token = :token AND utilizado = 0 AND data_expiracao > NOW()";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':token' => $token]);
            $token_data = $stmt->fetch();

            if (!$token_data) {
                $this->redirectWithError('resetar_senha_form', 'Token inválido, expirado ou já utilizado.');
            }

            // Atualizar a senha do usuário
            $usuario_id = $token_data['usuario_id'];
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

            $stmt_user = $pdo->prepare("UPDATE Usuarios SET senha_hash = :senha_hash WHERE id = :id");
            $stmt_user->execute([
                ':senha_hash' => $senha_hash,
                ':id' => $usuario_id
            ]);

            // Marcar token como utilizado
            $stmt_token = $pdo->prepare("UPDATE RecuperacaoSenha SET utilizado = 1 WHERE id = :id");
            $stmt_token->execute([':id' => $token_data['id']]);
            
            // Redireciona para o login com sucesso
            $_SESSION['flash_success'] = 'Senha redefinida com sucesso! Faça o login.';
            header('Location: ' . BASE_URL . '/index.php?rota=login');
            exit;

        } catch (PDOException $e) {
            $this->redirectWithError('resetar_senha_form', 'Erro de servidor: ' . $e->getMessage());
        }
    }

    // Funções utilitárias para este controller
    private function renderView(string $view_path, array $data = []): void
    {
        extract($data);
        ob_start();
        require $view_path;
        $conteudo = ob_get_clean();
        include 'login_layout.php';
    }

    private function redirectWithError(string $rota, string $message): void
    {
        $_SESSION['flash_error'] = $message;
        header('Location: ' . BASE_URL . '/index.php?rota=' . $rota);
        exit;
    }
}
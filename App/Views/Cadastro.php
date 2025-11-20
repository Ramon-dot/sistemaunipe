<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Portal Acadêmico UNIPÊ</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Reutilizando o CSS da tela de presença para manter a consistência -->
    <link href="<?php echo BASE_URL; ?>/css/TelaPresenca/style.css" rel="stylesheet">

</head>
<body>

<div class="wrapper">
    <nav id="sidebar">
        <div class="sidebar-top">
            <div class="sidebar-header">
                <img src="https://cdn-icons-png.flaticon.com/512/3814/3814282.png" alt="Foto de Perfil">
                <div>
                    <span class="menu-text">BEM VINDO</span>
                    <h5 class="menu-text"><?php echo htmlspecialchars($_SESSION['user_nome'] ?? 'Visitante'); ?></h5>
                </div>
            </div>
            <div id="sidebar-toggle">
                <i class="bi bi-arrow-left-circle"></i>
            </div>
        </div>
        <hr>
        <ul class="sidebar-menu">
            <li class="sidebar-title menu-text">MENU INTERATIVO</li>
            <li class="sidebar-item">
                <a href="<?php echo BASE_URL; ?>/index.php?rota=home" class="sidebar-link">
                    <i class="bi bi-house"></i>
                    <span class="menu-text">Home Page</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="<?php echo BASE_URL; ?>/index.php?rota=presenca" class="sidebar-link">
                    <i class="bi bi-file-earmark-text"></i>
                    <span class="menu-text">Presença</span>
                </a>
            </li>
            <li class="sidebar-item active">
                <a href="#cadastroSubmenu" data-bs-toggle="collapse" class="sidebar-link dropdown-toggle">
                    <i class="bi bi-bar-chart"></i>
                    <span class="menu-text">Cadastros</span>
                </a>
                <ul class="collapse list-unstyled submenu show" id="cadastroSubmenu">
                    <li class="sidebar-item active">
                        <a href="<?php echo BASE_URL; ?>/index.php?rota=cadastro_form" class="sidebar-link"><span class="menu-text">Alunos/Professores</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a href="<?php echo BASE_URL; ?>/index.php?rota=disciplinas" class="sidebar-link"><span class="menu-text">Disciplinas</span></a>
                    </li>
                </ul>
            </li>
        </ul>
        <hr>
        <ul class="sidebar-menu" style="flex-grow: 0;">
            <li class="sidebar-title menu-text">CONFIGURAÇÕES</li>
            <li class="sidebar-item">
                 <a href="#settingsSubmenu" data-bs-toggle="collapse" class="sidebar-link dropdown-toggle">
                    <i class="bi bi-gear"></i>
                    <span class="menu-text">Settings</span>
                </a>
                <ul class="collapse list-unstyled submenu" id="settingsSubmenu"></ul>
            </li>
        </ul>
        <div class="sidebar-footer">
            <a href="<?php echo BASE_URL; ?>/index.php?rota=logout">
                <i class="bi bi-box-arrow-right"></i>
                <span class="menu-text">Logout Account</span>
            </a>
        </div>
    </nav>
    
    <div id="main-content">
        <nav class="top-navbar">
            <i class="bi bi-chevron-left"></i> UNIPÊ Portal Acadêmico
        </nav>
        
        <div class="content-area">
            <div class="presence-card">
                <div class="presence-header d-flex justify-content-between align-items-center">
                    <h2>Formulário de Cadastro</h2>
                </div>
                
                <div class="p-3">
                    <form action="<?php echo BASE_URL; ?>/index.php?rota=cadastro_process" method="POST">
            
                        <h5 class="mt-2">Dados de Acesso</h5>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="col-md-6">
                                <label for="tipo_usuario" class="form-label">Tipo de Usuário</label>
                                <select class="form-select" id="tipo_usuario" name="tipo_usuario" required>
                                    <option value="Aluno">Aluno</option>
                                    <option value="Professor">Professor</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="senha" name="senha" required>
                            </div>
                            <div class="col-md-6">
                                <label for="confirmarSenha" class="form-label">Confirmar Senha</label>
                                <input type="password" class="form-control" id="confirmarSenha" name="confirmarSenha" required>
                            </div>
                        </div>

                        <hr>

                        <h5>Dados Pessoais</h5>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" required>
                            </div>
                            <div class="col-md-6">
                                <label for="sobrenome" class="form-label">Sobrenome</label>
                                <input type="text" class="form-control" id="sobrenome" name="sobrenome" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="cpf" class="form-label">CPF</label>
                                <input type="text" class="form-control" id="cpf" name="cpf" required>
                            </div>
                            <div class="col-md-4">
                                <label for="rg" class="form-label">RG</label>
                                <input type="text" class="form-control" id="rg" name="rg">
                            </div>
                            <div class="col-md-4">
                                <label for="dataNascimento" class="form-label">Data de Nascimento</label>
                                <input type="date" class="form-control" id="dataNascimento" name="dataNascimento" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="genero" class="form-label">Gênero</label>
                                <select class="form-select" id="genero" name="genero">
                                    <option value="Masculino">Masculino</option>
                                    <option value="Feminino">Feminino</option>
                                    <option value="Outro">Outro</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="telefone" class="form-label">Telefone</label>
                                <input type="text" class="form-control" id="telefone" name="telefone">
                            </div>
                        </div>

                        <hr>

                        <h5>Endereço</h5>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="cep" class="form-label">CEP</label>
                                <input type="text" class="form-control" id="cep" name="cep">
                            </div>
                            <div class="col-md-7">
                                <label for="endereco" class="form-label">Endereço</label>
                                <input type="text" class="form-control" id="endereco" name="endereco">
                            </div>
                            <div class="col-md-2">
                                <label for="numero" class="form-label">Número</label>
                                <input type="text" class="form-control" id="numero" name="numero">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="complemento" class="form-label">Complemento</label>
                                <input type="text" class="form-control" id="complemento" name="complemento">
                            </div>
                            <div class="col-md-4">
                                <label for="bairro" class="form-label">Bairro</label>
                                <input type="text" class="form-control" id="bairro" name="bairro">
                            </div>
                            <div class="col-md-3">
                                <label for="cidade" class="form-label">Cidade</label>
                                <input type="text" class="form-control" id="cidade" name="cidade">
                            </div>
                            <div class="col-md-1">
                                <label for="estado" class="form-label">UF</label>
                                <input type="text" class="form-control" id="estado" name="estado">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-check-circle"></i> Cadastrar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo BASE_URL; ?>/js/TelaPresenca/script.js"></script>

</body>
</html>
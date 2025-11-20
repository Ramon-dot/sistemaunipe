<main class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-4">

            <div class="card rounded-3 shadow-sm border-0 p-4">
                <h1 class="h3 fw-bold text-dark text-center mb-2">Redefinir Senha</h1>
                <p class="text-muted text-center">
                    Informe o token e sua nova senha.
                </p>

                <?php
                // Exibir mensagens flash (Sucesso ou Erro)
                if (isset($_SESSION['flash_error'])) {
                    echo '<div class="alert alert-danger mt-3" role="alert">' . htmlspecialchars($_SESSION['flash_error']) . '</div>';
                    unset($_SESSION['flash_error']);
                }
                ?>

                <form action="<?php echo BASE_URL; ?>/index.php?rota=resetar_senha_submit" method="POST" class="needs-validation mt-3" novalidate>

                    <div class="mb-3">
                        <label for="token" class="form-label fw-medium">Informe o Token</label>
                        <input type="text" class="form-control" id="token" name="token" placeholder="Código de 6 dígitos" required>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <label for="senha" class="form-label fw-medium">Digite a nova senha</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" class="form-control" id="senha" name="senha" placeholder="Mínimo 8 caracteres" required>
                            <button class="btn btn-outline-secondary" type="button" id="toggleSenha">
                                <i class="bi bi-eye-slash"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="confirmar_senha" class="form-label fw-medium">Confirme a senha</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" class="form-control" id="confirmar_senha" name="confirmar_senha" placeholder="Repita a nova senha" required>
                            <button class="btn btn-outline-secondary" type="button" id="toggleConfirmarSenha">
                                <i class="bi bi-eye-slash"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold mt-3">
                        Salvar nova Senha
                    </button>

                </form>
            </div>
        </div>
    </div>
</main>
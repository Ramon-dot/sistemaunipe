<main class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card rounded-3 p-4">
                <div class="text-center mb-4">
                    <h1 class="h3 fw-bold text-dark mb-2">Recuperar Senha</h1>
                    <p class="text-muted">
                        Digite seu e-mail para receber um código de recuperação
                    </p>
                </div>

                <form id="forgotPasswordForm" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="email" class="form-label fw-medium text-dark">
                            Endereço de E-mail
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="bi bi-envelope text-muted"></i>
                            </span>
                            <input
                                type="email"
                                class="form-control border-start-0"
                                id="email"
                                placeholder="seu.email@exemplo.com"
                                required>
                        </div>
                        <div class="invalid-feedback">
                            Por favor, digite um e-mail válido.
                        </div>
                    </div>

                    <div id="statusMessage" class="alert d-none mb-3" role="alert">
                        <div class="d-flex align-items-start">
                            <i id="statusIcon" class="bi me-2"></i>
                            <span id="statusText"></span>
                        </div>
                    </div>

                    <button
                        type="submit"
                        class="btn btn-primary w-100 py-2 mb-3 fw-semibold"
                        id="submitBtn">
                        <span id="buttonText">Enviar Código de Recuperação</span>
                        <span id="buttonSpinner" class="spinner-border spinner-border-sm d-none ms-2" role="status"></span>
                    </button>

                    <div class="info-box rounded p-3 mb-3">
                        <p class="mb-0 small">
                            <i class="bi bi-info-circle me-1"></i>
                            Você receberá um código de recuperação por e-mail. Use-o para redefinir sua senha.
                        </p>
                    </div>
                </form>

                <div class="text-center">
                    <p class="text-muted mb-0">
                        Lembrou sua senha?
                        <a href="<?php echo BASE_URL; ?>/index.php?rota=login" class="text-decoration-none fw-semibold text-primary ms-1">
                            Faça login
                        </a>
                    </p>
                </div>
            </div>

            <div class="text-center mt-3 security-note">
                <p class="mb-0">
                    <i class="bi bi-shield-lock me-1"></i>
                    Sua segurança é importante. Nunca compartilhe seu código de recuperação.
                </p>
            </div>
        </div>
    </div>
</main>
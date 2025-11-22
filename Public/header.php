<?php
// Inicia a sessão se ainda não estiver iniciada para garantir que $_SESSION esteja disponível.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Acadêmico UNIPÊ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="<?php echo BASE_URL; ?>/css/TelaHome/style.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>/css/TelaDisciplinas/style.css" rel="stylesheet">
</head>

<body>
    <div class="header-institucional d-none d-md-flex">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTMdg51oW37wPYvhxl8VPtTz-PCx5HbIF9HUQ&s" alt="Logo UNIPÊ" class="logo">
        <span class="titulo">UNIPÊ</span>
        <span class="subtitulo">Portal Acadêmico</span>
    </div>

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
            <li class="sidebar-item">
                <a href="#cadastroSubmenu" data-bs-toggle="collapse" class="sidebar-link dropdown-toggle">
                    <i class="bi bi-bar-chart"></i>
                    <span class="menu-text">Cadastros</span>
                </a>
                <ul class="collapse list-unstyled submenu" id="cadastroSubmenu">
                    <li class="sidebar-item">
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

    <div class="main-content" id="main-content">
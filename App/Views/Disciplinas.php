<div class="content-area">
    <div class="presence-card">
        <div class="presence-header d-flex justify-content-between align-items-center">
            <h2>Disciplinas</h2>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="O que você procura?" aria-label="Search">
                <button class="btn btn-success" type="submit">Buscar</button>
            </form>
        </div>
        
        <div class="p-3">
            
            <!-- Exibe mensagens de erro, se houver -->
            <?php
            if (isset($_SESSION['flash_error'])) {
                echo '<div class="alert alert-danger" role="alert">' . htmlspecialchars($_SESSION['flash_error']) . '</div>';
                unset($_SESSION['flash_error']);
            }
            ?>

            <div class="row g-4">
                
                <!-- Loop para renderizar os cards do banco de dados -->
                <?php if (empty($cursos)): ?>
                    <div class="col-12">
                        <p class="text-center">Nenhum curso cadastrado no sistema.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($cursos as $curso): ?>
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
                        <a href="<?php echo BASE_URL; ?>/index.php?rota=presenca&curso_id=<?php echo $curso['id']; ?>" class="text-decoration-none">
                            <div class="card discipline-card h-100">
                                <div class="card-img-container">
                                    <img src="https://placehold.co/400x200/004e92/ffffff?text=<?php echo urlencode(substr($curso['nome_curso'], 0, 10)); ?>..." class="card-img-top" alt="Imagem do Curso">
                                    <div class="card-img-overlay-icon">
                                        <i class="bi bi-box-arrow-in-right"></i>
                                    </div>
                                </div>
                                
                                <div class="card-body d-flex flex-column">
                                    <h6 class="card-subtitle-code mb-1">
                                        <?php echo htmlspecialchars($curso['total_alunos']); ?> Aluno(s)
                                    </h6>
                                    <h5 class="card-title">
                                        <?php echo htmlspecialchars($curso['nome_curso']); ?>
                                    </h5>
                                    
                                    <p class="card-text card-status mt-auto">
                                        <span class="start-link">
                                            Acessar Lista de Presença
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
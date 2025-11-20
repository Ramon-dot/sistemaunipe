<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
        <h2 class="h3 mb-0 text-dark font-weight-bold">
            Lista Presença
        </h2>
        
        <form class="d-flex ms-auto" id="form-busca-aluno" method="GET">

            <input type="hidden" name="rota" value="presenca">

            <input type="hidden" name="curso_id" value="<?php echo htmlspecialchars($_GET['curso_id'] ?? 1); ?>">
            <input class="form-control me-2" type="search" placeholder="Buscar aluno" name="busca" value="<?php echo htmlspecialchars($termoBusca ?? ''); ?>">
            <button class="btn btn-success" type="submit">Buscar</button>
        </form>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table table-borderless table-hover align-middle table-presenca" id="lista-presenca">
                
                <thead class="table-light">
                    <tr>
                        <th scope="col" class="py-3 px-4">Alunos</th>
                        <th scope="col" class="py-3 px-4">Data</th>
                        <th scope="col" class="py-3 px-4">Quantidades de faltas</th>
                        <th scope="col" class="py-3 px-4">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Usando a variável $alunosParaExibir do SEU controller
                    foreach ($alunosParaExibir as $aluno): 
                    ?>
                    
                    <tr data-matricula-id="<?= $aluno['matricula_id']; ?>" 
                        data-status="<?= $aluno['presente'] ? '1' : '0'; ?>">
                        
                        <td class="px-4">
                            <div class="aluno-nome"><?= htmlspecialchars($aluno['nome']); ?></div>
                            <div class="aluno-rgm">RGM: <?= htmlspecialchars($aluno['rgm'] ?? ''); ?></div>
                        </td>
                        <td class="px-4">
                            <span class="badge-data"><?= htmlspecialchars($aluno['data']); ?></span>
                        </td>
                        <td class="px-4">
                            <span class="badge-faltas">
                                <?= $aluno['faltas'];?>
                            </span>
                        </td>
                        <td class="px-4">
                            <?php if ($aluno['presente']): ?>
                                <button class="btn btn-sm btn-presente btn-acao">
                                    <i class="bi bi-check-circle-fill me-1"></i> Presente
                                </button>
                            <?php else: ?>
                                <button class="btn btn-sm btn-falta btn-acao">
                                    <i class="bi bi-x-circle-fill me-1"></i> Falta
                                </button>
                            <?php endif; ?>
                            
                            <?php if ($aluno['reprovado'] ?? false): ?>
                                <span class="badge bg-danger ms-2">Reprovado</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<button class="btn btn-primary btn-salvar-presencas" id="btn-salvar-presencas">
    <i class="bi bi-save-fill me-2"></i> Salvar Presenças
</button>
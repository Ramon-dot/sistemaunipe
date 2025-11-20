<div class="content-area">
    <div class="presence-card">
        <div class="presence-header d-flex justify-content-between align-items-center">
            <h2><?php echo htmlspecialchars($titulo); ?></h2>
            <a href="<?php echo BASE_URL; ?>/index.php?rota=cadastro_form" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Novo Cadastro
            </a>
        </div>
        
        <div class="table-responsive mt-3">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nome Completo</th>
                        <th>Email</th>
                        <th>Documento</th>
                        <th>Status</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($usuarios)): ?>
                        <tr>
                            <td colspan="5" class="text-center">Nenhum usuário encontrado.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($usuarios as $usuario): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($usuario['nome'] . ' ' . $usuario['sobrenome']); ?></td>
                                <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                                <td><?php echo htmlspecialchars($usuario['documento'] ?? ''); ?></td>
                                <td>
                                    <span class="badge <?php echo $usuario['status'] === 'Ativo' ? 'bg-success' : 'bg-danger'; ?>">
                                        <?php echo htmlspecialchars($usuario['status']); ?>
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="<?php echo BASE_URL; ?>/index.php?rota=usuario_editar&id=<?php echo $usuario['id']; ?>" class="btn btn-sm btn-warning" title="Editar">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="<?php echo BASE_URL; ?>/index.php?rota=usuario_excluir&id=<?php echo $usuario['id']; ?>" class="btn btn-sm btn-danger" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este usuário?');">
                                        <i class="bi bi-trash-fill"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="presence-card">
    <div class="presence-header d-flex justify-content-between align-items-center">
        <h2>Editar Usuário: <?php echo htmlspecialchars($usuario['nome']); ?></h2>
    </div>
    
    <div class="p-3">
        <form action="<?php echo BASE_URL; ?>/index.php?rota=usuario_update" method="POST">
            <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
            <input type="hidden" name="tipo_usuario" value="<?php echo $usuario['tipo_usuario']; ?>">

            <h5 class="mt-2">Dados de Acesso</h5>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="Ativo" <?php echo ($usuario['status'] === 'Ativo') ? 'selected' : ''; ?>>Ativo</option>
                        <option value="Inativo" <?php echo ($usuario['status'] === 'Inativo') ? 'selected' : ''; ?>>Inativo</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="senha" class="form-label">Nova Senha (deixe em branco para não alterar)</label>
                    <input type="password" class="form-control" id="senha" name="senha">
                </div>
                <div class="col-md-6">
                    <label for="confirmarSenha" class="form-label">Confirmar Nova Senha</label>
                    <input type="password" class="form-control" id="confirmarSenha" name="confirmarSenha">
                </div>
            </div>

            <hr>

            <h5>Dados Pessoais</h5>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="sobrenome" class="form-label">Sobrenome</label>
                    <input type="text" class="form-control" id="sobrenome" name="sobrenome" value="<?php echo htmlspecialchars($usuario['sobrenome']); ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" value="<?php echo htmlspecialchars($usuario['cpf']); ?>" required>
                </div>
                <div class="col-md-4">
                    <label for="rg" class="form-label">RG</label>
                    <input type="text" class="form-control" id="rg" name="rg" value="<?php echo htmlspecialchars($usuario['rg'] ?? ''); ?>">
                </div>
                <div class="col-md-4">
                    <label for="dataNascimento" class="form-label">Data de Nascimento</label>
                    <input type="date" class="form-control" id="dataNascimento" name="dataNascimento" value="<?php echo htmlspecialchars($usuario['data_nascimento']); ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="genero" class="form-label">Gênero</label>
                    <select class="form-select" id="genero" name="genero">
                        <option value="Masculino" <?php echo ($usuario['genero'] === 'Masculino') ? 'selected' : ''; ?>>Masculino</option>
                        <option value="Feminino" <?php echo ($usuario['genero'] === 'Feminino') ? 'selected' : ''; ?>>Feminino</option>
                        <option value="Outro" <?php echo ($usuario['genero'] === 'Outro') ? 'selected' : ''; ?>>Outro</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo htmlspecialchars($usuario['telefone']); ?>">
                </div>
            </div>

            <hr>

            <h5>Endereço</h5>
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="cep" class="form-label">CEP</label>
                    <input type="text" class="form-control" id="cep" name="cep" value="<?php echo htmlspecialchars($usuario['cep'] ?? ''); ?>">
                </div>
                <div class="col-md-7">
                    <label for="endereco" class="form-label">Endereço</label>
                    <input type="text" class="form-control" id="endereco" name="endereco" value="<?php echo htmlspecialchars($usuario['endereco'] ?? ''); ?>">
                </div>
                <div class="col-md-2">
                    <label for="numero" class="form-label">Número</label>
                    <input type="text" class="form-control" id="numero" name="numero" value="<?php echo htmlspecialchars($usuario['numero'] ?? ''); ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="complemento" class="form-label">Complemento</label>
                    <input type="text" class="form-control" id="complemento" name="complemento" value="<?php echo htmlspecialchars($usuario['complemento'] ?? ''); ?>">
                </div>
                <div class="col-md-4">
                    <label for="bairro" class="form-label">Bairro</label>
                    <input type="text" class="form-control" id="bairro" name="bairro" value="<?php echo htmlspecialchars($usuario['bairro'] ?? ''); ?>">
                </div>
                <div class="col-md-3">
                    <label for="cidade" class="form-label">Cidade</label>
                    <input type="text" class="form-control" id="cidade" name="cidade" value="<?php echo htmlspecialchars($usuario['cidade'] ?? ''); ?>">
                </div>
                <div class="col-md-1">
                    <label for="estado" class="form-label">UF</label>
                    <input type="text" class="form-control" id="estado" name="estado" value="<?php echo htmlspecialchars($usuario['estado'] ?? ''); ?>">
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="bi bi-check-circle"></i> Salvar Alterações
                </button>
            </div>
        </form>
    </div>
</div>
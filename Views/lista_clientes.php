<link rel="stylesheet" href="/MustacheBarber/Views/style/global.css">
<body class="page-lista">

<div class="page-wrapper">

    <div class="page-header">
        <div>
            <a href="javascript:history.back()" class="btn-voltar">← Voltar</a>
            <span class="page-pretitle">Painel Administrativo</span>
            <h1 class="page-title">Clientes Cadastrados</h1>
        </div>
        <a href="?action=cadastroCliente" class="btn-novo">+ Novo Cliente</a>
    </div>

    <?php if (empty($clientes)): ?>

        <div class="estado-vazio">
            <strong>Nenhum cliente cadastrado</strong>
            <p>Adicione o primeiro pelo botão acima.</p>
        </div>

    <?php else: ?>

        <div class="table-card">
            <table class="clientes-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($clientes as $cliente): ?>
                    <tr>
                        <td class="col-id"><?= htmlspecialchars($cliente['id']) ?></td>
                        <td class="col-nome"><?= htmlspecialchars($cliente['nome']) ?></td>
                        <td class="col-email"><?= htmlspecialchars($cliente['email']) ?></td>
                        <td class="col-tel">
                            <?php if (!empty($cliente['telefone'])): ?>
                                <?= htmlspecialchars($cliente['telefone']) ?>
                            <?php else: ?>
                                <span class="col-vazio">—</span>
                            <?php endif; ?>
                        </td>
                        <td class="col-acoes">
                            <a href="?action=editarCliente&id=<?= $cliente['id'] ?>" class="btn-acao btn-editar">Editar</a>
                            <a href="?action=excluirCliente&id=<?= $cliente['id'] ?>" class="btn-acao btn-excluir" onclick="return confirm('Excluir <?= htmlspecialchars($cliente['nome']) ?>?')">Excluir</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="page-footer">
            <span class="badge-count">
                <?= count($clientes) ?> cliente<?= count($clientes) !== 1 ? 's' : '' ?>
            </span>
        </div>

    <?php endif; ?>

</div>

</body>
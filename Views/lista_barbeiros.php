<link rel="stylesheet" href="/MustacheBarber/Views/style/global.css">
<body class="page-lista">

<div class="page-wrapper">

    <div class="page-header">
        <div>
            <a href="javascript:history.back()" class="btn-voltar">← Voltar</a>
            <span class="page-pretitle">Painel Administrativo</span>
            <h1 class="page-title">Barbeiros Cadastrados</h1>
        </div>
        <a href="?action=cadastrarBarbeiro" class="btn-novo">+ Novo Barbeiro</a>
    </div>

    <?php if (empty($barbeiros)): ?>

        <div class="estado-vazio">
            <strong>Nenhum barbeiro cadastrado</strong>
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
                    <?php foreach($barbeiros as $barbeiro): ?>
                    <tr>
                        <td class="col-id"><?= htmlspecialchars($barbeiro['id']) ?></td>
                        <td class="col-nome"><?= htmlspecialchars($barbeiro['nome']) ?></td>
                        <td class="col-email"><?= htmlspecialchars($barbeiro['email']) ?></td>
                        <td class="col-tel">
                            <?php if (!empty($barbeiro['telefone'])): ?>
                                <?= htmlspecialchars($barbeiro['telefone']) ?>
                            <?php else: ?>
                                <span class="col-vazio">—</span>
                            <?php endif; ?>
                        </td>
                        <td class="col-acoes">
                            <a href="?action=editarBarbeiro&id=<?= $barbeiro['id'] ?>" class="btn-acao btn-editar">Editar</a>
                            <a href="?action=excluirBarbeiro&id=<?= $barbeiro['id'] ?>" class="btn-acao btn-excluir" onclick="return confirm('Excluir <?= htmlspecialchars($barbeiro['nome']) ?>?')">Excluir</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="page-footer">
            <span class="badge-count">
                <?= count($barbeiros) ?> barbeiro<?= count($barbeiros) !== 1 ? 's' : '' ?>
            </span>
        </div>

    <?php endif; ?>

</div>

</body>
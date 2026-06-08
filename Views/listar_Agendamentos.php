<link rel="stylesheet" href="/MustacheBarber/Views/style/global.css">
<body class="page-lista">

<div class="page-wrapper">

    <div class="page-header">
        <div>
            <a href="javascript:history.back()" class="btn-voltar">← Voltar</a>
            <span class="page-pretitle">Painel Administrativo</span>
            <h1 class="page-title">Agendamentos</h1>
        </div>
        <a href="?action=criarAgendamento" class="btn-novo">+ Novo Agendamento</a>
    </div>

    <?php if (empty($agendamentos)): ?>

        <div class="estado-vazio">
            <strong>Nenhum agendamento cadastrado</strong>
            <p>Adicione o primeiro pelo botão acima.</p>
        </div>

    <?php else: ?>

        <div class="table-card">
            <table class="clientes-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Barbeiro</th>
                        <th>Início</th>
                        <th>Fim</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($agendamentos as $agendamento): ?>
                    <tr>
                        <td class="col-id"><?= htmlspecialchars($agendamento['id']) ?></td>
                        <td class="col-nome"><?= htmlspecialchars($agendamento['nome_cliente']) ?></td>
                        <td class="col-nome"><?= htmlspecialchars($agendamento['nome_barbeiro']) ?></td>
                        <td><?= htmlspecialchars($agendamento['data_hora_inicio']) ?></td>
                        <td><?= htmlspecialchars($agendamento['data_hora_fim']) ?></td>
                        <td><?= htmlspecialchars($agendamento['status']) ?></td>
                        <td class="col-acoes">
                            <a href="?action=editarAgendamento&id=<?= $agendamento['id'] ?>" class="btn-acao btn-editar">Editar</a>
                            <a href="?action=cancelarAgendamento&id=<?= $agendamento['id'] ?>" class="btn-acao btn-excluir" onclick="return confirm('Cancelar agendamento de <?= htmlspecialchars($agendamento['nome_cliente']) ?>?')">Cancelar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="page-footer">
            <span class="badge-count">
                <?= count($agendamentos) ?> agendamento<?= count($agendamentos) !== 1 ? 's' : '' ?>
            </span>
        </div>

    <?php endif; ?>

</div>

</body>
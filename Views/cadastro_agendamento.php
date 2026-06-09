<?php
$servicos = $servicos ?? [];
$barbeiros = $barbeiros ?? [];
$dadosAgendamento = $dadosAgendamento ?? null;
$erro = $erro ?? null;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($dadosAgendamento) ? 'Editar Agendamento' : 'Novo Agendamento' ?> - Mustache Barber</title>
    <link rel="stylesheet" href="/MustacheBarber/Views/style/global.css">
</head>
<body>

<div class="login-container">

    <h1><?= isset($dadosAgendamento) ? 'Editar Agendamento' : 'Novo Agendamento' ?></h1>

    <?php if (!empty($erro)): ?>
        <div class="erro"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <form action="" method="post">

        <label>Serviço</label>    
        <select name="servico_id" required>
            <?php if (empty($servicos)): ?>
                <option value="">Nenhum serviço cadastrado</option>
            <?php else: ?>
                <?php foreach($servicos as $servico): ?>
                    <option value="<?= $servico['id'] ?>"
                        <?= (isset($dadosAgendamento['servico_id']) && $dadosAgendamento['servico_id'] == $servico['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($servico['nome']) ?> - R$ <?= number_format($servico['valor'], 2, ',', '.') ?>
                    </option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>   

        <label>Barbeiro</label>
        <select name="barbeiro_id" required>
            <?php if (empty($barbeiros)): ?>
                <option value="">Nenhum barbeiro cadastrado</option>
            <?php else: ?>
                <?php foreach($barbeiros as $barbeiro): ?>
                    <option value="<?= $barbeiro['id'] ?>"
                        <?= (isset($dadosAgendamento['barbeiro_id']) && $dadosAgendamento['barbeiro_id'] == $barbeiro['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($barbeiro['nome']) ?>
                    </option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>

        <label>Data e Hora</label>
        <input
            type="datetime-local"
            name="data_hora_inicio"
            value="<?= isset($dadosAgendamento['data_hora_inicio']) ? htmlspecialchars($dadosAgendamento['data_hora_inicio']) : '' ?>"
            required
        >

        <button type="submit">
            <?= isset($dadosAgendamento) ? 'Salvar Alterações' : 'Agendar' ?>
        </button>

    </form>

    <a href="?action=listarAgendamentos">← Voltar para Agendamentos</a>

</div>

</body>
</html>
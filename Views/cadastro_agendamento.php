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

    <form method="POST">

        <label>ID do Cliente</label>
        <input
            type="number"
            name="cliente_id"
            placeholder="ID do cliente"
            value="<?= htmlspecialchars($dadosAgendamento['cliente_id'] ?? '') ?>"
            required
        >

        <label>ID do Barbeiro</label>
        <input
            type="number"
            name="barbeiro_id"
            placeholder="ID do barbeiro"
            value="<?= htmlspecialchars($dadosAgendamento['barbeiro_id'] ?? '') ?>"
            required
        >

        <label>Data e Hora</label>
        <input
            type="datetime-local"
            name="data_hora_inicio"
            value="<?= htmlspecialchars($dadosAgendamento['data_hora_inicio'] ?? '') ?>"
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
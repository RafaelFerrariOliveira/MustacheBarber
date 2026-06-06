<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($dadosBarbeiro) ? 'Editar Barbeiro' : 'Novo Barbeiro' ?> - Mustache Barber</title>
    <link rel="stylesheet" href="/MustacheBarber/Views/style/global.css">
</head>
<body>

<div class="login-container">

    <h1><?= isset($dadosBarbeiro) ? 'Editar Barbeiro' : 'Novo Barbeiro' ?></h1>

    <?php if (!empty($erro)): ?>
        <div class="erro"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <form method="POST">

        <label>Nome</label>
        <input
            type="text"
            name="nome"
            placeholder="Nome completo"
            value="<?= htmlspecialchars($dadosBarbeiro['nome'] ?? '') ?>"
            required
        >

        <label>Email</label>
        <input
            type="email"
            name="email"
            placeholder="email@exemplo.com"
            value="<?= htmlspecialchars($dadosBarbeiro['email'] ?? '') ?>"
            required
        >

        <label>Telefone</label>
        <input
            type="text"
            name="telefone"
            placeholder="(00) 00000-0000"
            value="<?= htmlspecialchars($dadosBarbeiro['telefone'] ?? '') ?>"
        >

        <?php if (!isset($dadosBarbeiro)): ?>
        <label>Senha</label>
        <input
            type="password"
            name="senha"
            placeholder="••••••••"
            required
        >
        <?php endif; ?>

        <button type="submit">
            <?= isset($dadosBarbeiro) ? 'Salvar Alterações' : 'Cadastrar Barbeiro' ?>
        </button>

    </form>

    <a href="?action=listarBarbeiros">← Voltar para Barbeiros</a>

</div>

</body>
</html>
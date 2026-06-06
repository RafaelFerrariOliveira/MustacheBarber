<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($dadosCliente) ? 'Editar Cliente' : 'Cadastro' ?> - Mustache Barber</title>
    <link rel="stylesheet" href="/MustacheBarber/Views/style/global.css">
</head>
<body>

<div class="login-container">

    <h1><?= isset($dadosCliente) ? 'Editar Cliente' : 'Criar Conta' ?></h1>

    <?php if (!empty($erro)): ?>
        <div class="erro"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <form method="POST">

        <label>Nome</label>
        <input
            type="text"
            name="nome"
            placeholder="Seu nome completo"
            value="<?= htmlspecialchars($dadosCliente['nome'] ?? '') ?>"
            required
        >

        <label>Email</label>
        <input
            type="email"
            name="email"
            placeholder="seu@email.com"
            value="<?= htmlspecialchars($dadosCliente['email'] ?? '') ?>"
            required
        >

        <label>Telefone</label>
        <input
            type="text"
            name="telefone"
            placeholder="(00) 00000-0000"
            value="<?= htmlspecialchars($dadosCliente['telefone'] ?? '') ?>"
        >

        <?php if (!isset($dadosCliente)): ?>
        <label>Senha</label>
        <input type="password" name="senha" placeholder="••••••••" required>
        <?php endif; ?>

        <button type="submit">
            <?= isset($dadosCliente) ? 'Salvar Alterações' : 'Cadastrar' ?>
        </button>

    </form>

    <a href="<?= isset($dadosCliente) ? '?controller=cliente&action=listar' : '?controller=auth&action=login' ?>">
        <?= isset($dadosCliente) ? '← Voltar para Clientes' : 'Voltar ao Login' ?>
    </a>

</div>

</body>
</html>
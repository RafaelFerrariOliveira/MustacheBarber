<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mustache Barber</title>
    <link rel="stylesheet" href="/MustacheBarber/Views/style/global.css">
</head>
<body>

<div class="login-container">

    <h1>Mustache Barber</h1>

    <?php if (!empty($erro)): ?>
        <div class="erro"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <form method="POST">

        <label>Email</label>
        <input type="email" name="email" placeholder="seu@email.com" required>

        <label>Senha</label>
        <input type="password" name="senha" placeholder="••••••••" required>

        <button type="submit">Entrar</button>

    </form>

    <a href="?controller=auth&action=cadastroCliente">Criar Conta</a>

</div>

</body>
</html>
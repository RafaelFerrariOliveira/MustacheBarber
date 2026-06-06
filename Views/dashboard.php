<!DOCTYPE html>
<html>

<head>

    <title>Mustache Barber</title>

    <link rel="stylesheet" href="Views/style/global.css">

</head>

<body>

<div class="container">

    <h1>💈 Mustache Barber</h1>

    <h2>
        Bem-vindo,
        <?= $_SESSION['usuario_nome'] ?>
    </h2>

    <div class="menu">

        <a href="?action=listarClientes">
            Clientes
        </a>

        <a href="?action=listarBarbeiros">
            Barbeiros
        </a>

        <a href="?action=listarAgendamentos">
            Agendamentos
        </a>

        <a href="?action=logout">
            Sair
        </a>

    </div>

</div>

</body>

</html>
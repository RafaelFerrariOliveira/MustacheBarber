<?php

session_start();

require_once 'Controllers/AuthController.php';
require_once 'Controllers/ClienteController.php';
require_once 'Controllers/BarbeiroController.php';

$action = $_GET['action'] ?? 'dashboard';

$rotasPublicas = [
    'login',
    'cadastroCliente'
];

if (
    !isset($_SESSION['usuario_id']) &&
    !in_array($action, $rotasPublicas)
)
{
    header('Location: Index.php?action=login');
    exit;
}

switch ($action)
{

    case 'login':
        $auth = new AuthController();
        $auth->login();
        break;

    case 'logout':
        $auth = new AuthController();
        $auth->logout();
        break;

    // ── Clientes ──

    case 'cadastroCliente':
        $cliente = new ClienteController();
        $cliente->cadastrar();
        break;

    case 'listarClientes':
        $cliente = new ClienteController();
        $cliente->listar();
        break;

    case 'editarCliente':
        $cliente = new ClienteController();
        $cliente->editar();
        break;

    case 'excluirCliente':
        $cliente = new ClienteController();
        $cliente->excluir();
        break;

    // ── Barbeiros ──

    case 'listarBarbeiros':
        $barbeiro = new BarbeiroController();
        $barbeiro->listar();
        break;

    case 'cadastrarBarbeiro':
        $barbeiro = new BarbeiroController();
        $barbeiro->cadastrar();
        break;

    case 'editarBarbeiro':
        $barbeiro = new BarbeiroController();
        $barbeiro->editar();
        break;

    case 'excluirBarbeiro':
        $barbeiro = new BarbeiroController();
        $barbeiro->excluir();
        break;

    // ── Dashboard ──

    case 'dashboard':
        require 'Views/dashboard.php';
        break;

    default:
        header('Location: Index.php?action=dashboard');
        exit;
}
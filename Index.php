<?php

session_start();

require_once __DIR__ . '/Controllers/AuthController.php';
require_once __DIR__ . '/Controllers/ClienteController.php';
require_once __DIR__ . '/Controllers/BarbeiroController.php';
require_once __DIR__ . '/Controllers/AgendamentoController.php';
require_once __DIR__ . '/Controllers/ServicoController.php';

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

    case 'criarAgendamento':
        $agendamento = new AgendamentoController();
        $agendamento->criar();
        break;

    case 'listarAgendamentos':
        $agendamento = new AgendamentoController();
        $agendamento->listar();
        break;

    case 'editarAgendamento':
        $agendamento = new AgendamentoController();
        $agendamento->editar();
        break;

    case 'cancelarAgendamento':
        $agendamento = new AgendamentoController();
        $agendamento->cancelar();
        break;

    case 'finalizarAgendamento':
        $agendamento = new AgendamentoController();
        $agendamento->finalizar();
        break;

    case 'listarServicos':
        $servico = new ServicoController();
        $servico->index();
        break;

    case 'cadastrarServico':
        $servico = new ServicoController();
        $servico->criar();
        break;

    case 'editarServico':
        $servico = new ServicoController();
        $servico->editar((int)($_GET['id'] ?? 0));
        break;

    case 'excluirServico':
        $servico = new ServicoController();
        $servico->excluir((int)($_GET['id'] ?? 0));
        break;

    case 'toggleServico':
        $servico = new ServicoController();
        $servico->toggleAtivo((int)($_GET['id'] ?? 0));
        break;

    case 'dashboard':
        require 'Views/dashboard.php';
        break;

    default:
        header('Location: Index.php?action=dashboard');
        exit;
}
?>
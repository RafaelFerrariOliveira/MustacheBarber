<?php

require_once __DIR__ . '/../Models/Cliente.php';

class ClienteController
{
    public function cadastrar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $telefone = $_POST['telefone'];
            $senha = $_POST['senha'];

            $cliente = new Cliente();

            $cliente->cadastrar(
                $nome,
                $email,
                $telefone,
                $senha
            );

            header("Location: Index.php?action=login");
            exit;
        }

        require 'Views/cadastro_cliente.php';
    }

  public function editar()
{
    $id = $_GET['id'] ?? null;

    if (!$id) {
        header("Location: Index.php?action=listarClientes");
        exit;
    }

    $cliente = new Cliente();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $nome     = $_POST['nome'];
        $email    = $_POST['email'];
        $telefone = $_POST['telefone'];

        $cliente->editar($id, $nome, $email, $telefone);

        header("Location: Index.php?action=listarClientes");
        exit;
    }

    $dadosCliente = $cliente->buscarPorId($id);

    require 'Views/cadastro_cliente.php'; // ← view compartilhada
}

public function excluir()
{
    $id = $_GET['id'] ?? null;

    if ($id) {
        $cliente = new Cliente();
        $cliente->excluir($id);
    }

    header("Location: Index.php?controller=cliente&action=listar");
    exit;
}

    public function listar()
    {
        $cliente = new Cliente();

        $clientes = $cliente->listar();

        require 'Views/lista_clientes.php';
    }
}
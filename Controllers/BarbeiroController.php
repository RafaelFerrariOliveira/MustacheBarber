<?php

require_once __DIR__ . '/../Models/Barbeiro.php';

class BarbeiroController
{
    public function cadastrar()
    {
        if($_SERVER['REQUEST_METHOD'] ==='POST')
            {
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $telefone = $_POST['telefone'];
                $senha = $_POST['senha'];

                $barbeiro = new Barbeiro();

                $barbeiro->cadastrar(
                    $nome,
                    $email,
                    $telefone,
                    $senha
                );

                header("Location: Index.php?action=listarBarbeiros");
                exit;
            }

            require 'Views/cadastro_barbeiro.php';
    }

    public function editar()
    {
        $id = $_GET['id'] ?? null;

        if (!$id)
        {
            header("Location: Index.php?action=listarBarbeiros");
            exit;
        }

        $barbeiro = new Barbeiro();

        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {

            $nome   = $_POST['nome'];
            $email   = $_POST['email'];
            $telefone   = $_POST['telefone'];

            $barbeiro->editar($id, $nome, $email, $telefone);

            header("Location: Index.php?action=listarBarbeiros");
            exit;
        }

        $dadosBarbeiro = $barbeiro->buscarPorId($id);

        require 'Views/cadastro_barbeiro.php';
    }

    public function excluir()
    {
        $id = $_GET['id'] ?? null;

        if ($id)
        {
            $barbeiro = new Barbeiro();
            $barbeiro->excluir($id);
        }

        header("Location: Index.php?controller=listarBarbeiros");
        exit;
    }

    public function listar()
    {
        $barbeiro = new Barbeiro();

        $barbeiros = $barbeiro->listar();

        require 'Views/lista_barbeiros.php';
    }

}

?>
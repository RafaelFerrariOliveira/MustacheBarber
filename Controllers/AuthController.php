<?php

require_once __DIR__ . '/../Models/Usuario.php';

class AuthController
{
    public function login()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $usuarioModel = new Usuario();

            $usuario = $usuarioModel->buscarPorEmail($email);

            if(
                $usuario &&
                password_verify($senha, $usuario['senha'])
            )
            {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];
                $_SESSION['usuario_tipo'] = $usuario['tipo'];

                header("Location: Index.php");
                exit;
            }

            $erro = "Usuário ou senha inválidos";
        }

        require 'Views/login.php';
    }

    public function logout()
    {
        session_destroy();

        header("Location: Index.php");
        exit;
    }
}
<?php

class Database
{
    private $host = "localhost:3306";
    private $dbname = "mustachebarber";
    private $user = "root";
    private $password = "";

    public function conectar()
    {
        try {

            $conexao = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8",
                $this->user,
                $this->password
            );

            $conexao->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

            return $conexao;

        } catch(PDOException $e) {

            die("Erro ao conectar: " . $e->getMessage());

        }
    }
}
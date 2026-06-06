<?php

require_once __DIR__ . '/../Config/DataBase.php';

class Cliente
{
    private $conn;

    public function __construct()
    {
        $db = new DataBase();
        $this->conn = $db->conectar();
    }

    public function cadastrar($nome, $email, $telefone, $senha)
    {
        $sql = "
            INSERT INTO usuarios
            (
                nome,
                email,
                telefone,
                senha,
                tipo
            )
            VALUES
            (
                ?, ?, ?, ?, 'CLIENTE'
            )
        ";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $nome,
            $email,
            $telefone,
            password_hash($senha, PASSWORD_DEFAULT)
        ]);
    }

    public function listar()
    {
        $sql = "
            SELECT *
            FROM usuarios
            WHERE tipo = 'CLIENTE'
        ";

        $stmt = $this->conn->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editar($id, $nome, $email, $telefone)
{
    $sql = "
        UPDATE usuarios
        SET
            nome     = ?,
            email    = ?,
            telefone = ?
        WHERE id = ?
    ";

    $stmt = $this->conn->prepare($sql);

    return $stmt->execute([$nome, $email, $telefone, $id]);
}

public function excluir($id)
{
    $sql = "
        DELETE FROM usuarios
        WHERE id = ?
    ";

    $stmt = $this->conn->prepare($sql);

    return $stmt->execute([$id]);
}

    public function buscarPorId($id)
    {
        $sql = "
            SELECT *
            FROM usuarios
            WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
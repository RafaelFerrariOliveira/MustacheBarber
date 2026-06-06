<?php

require_once __DIR__ . '/../Config/DataBase.php';

class Usuario
{
    private $conn;

    public function __construct()
    {
        $db = new DataBase();
        $this->conn = $db->conectar();
    }

    public function buscarPorEmail($email)
    {
        $sql = "SELECT * FROM usuarios WHERE email = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
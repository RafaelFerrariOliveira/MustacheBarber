<?php

require_once __DIR__ . '/../config/database.php';

class Servico {
    /** @var PDO */
    private $conn;

    public function __construct() {
        $database = new DataBase();
        $this->conn = $database->conectar();
    }

    public function listar(): array {
        $stmt = $this->conn->query("SELECT * FROM servicos ORDER BY nome ASC");
        return $stmt->fetchAll();
    }

    public function buscarPorId(int $id): array|false {
        $stmt = $this->conn->prepare("SELECT * FROM servicos WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function criar(array $dados): bool {
        $sql = "INSERT INTO servicos (nome, descricao, duracao_minutos, valor, ativo)
                VALUES (:nome, :descricao, :duracao_minutos, :valor, :ativo)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':nome'            => $dados['nome'],
            ':descricao'       => $dados['descricao'],
            ':duracao_minutos' => (int)   $dados['duracao_minutos'],
            ':valor'           => (float) $dados['valor'],
            ':ativo'           => isset($dados['ativo']) ? 1 : 0,
        ]);
    }

    public function atualizar(int $id, array $dados): bool {
        $sql = "UPDATE servicos
                SET nome = :nome,
                    descricao = :descricao,
                    duracao_minutos = :duracao_minutos,
                    valor = :valor,
                    ativo = :ativo
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':nome'            => $dados['nome'],
            ':descricao'       => $dados['descricao'],
            ':duracao_minutos' => (int)   $dados['duracao_minutos'],
            ':valor'           => (float) $dados['valor'],
            ':ativo'           => isset($dados['ativo']) ? 1 : 0,
            ':id'              => $id,
        ]);
    }

    public function excluir(int $id): bool {
        $stmt = $this->conn->prepare("DELETE FROM servicos WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function toggleAtivo(int $id): bool {
        $stmt = $this->conn->prepare("UPDATE servicos SET ativo = NOT ativo WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
<?php

require_once __DIR__ . '/../Config/DataBase.php';

class Agendamento
{
    private $conn;

    public function __construct()
    {
        $db = new DataBase();
        $this->conn = $db->conectar();
    }

    public function criarReserva($cliente_id, $barbeiro_id, $servico_id, $data_horario_inicio)
    {
        $data_hora_fim = date('Y-m-d H:i:s', strtotime($data_horario_inicio . ' +1 hour'));
        $status = 'AGENDADO';
        $observacoes = null;

        $sql ="
            INSERT INTO agendamentos
            (
                cliente_id,
                barbeiro_id,
                servico_id,
                data_hora_inicio,
                data_hora_fim,
                status,
                observacoes
            )
            VALUES
            (
                ?, ?, ?, ?, ?, ?, ?
            )
            ";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $cliente_id,
            $barbeiro_id,
            $servico_id,
            $data_horario_inicio,
            $data_hora_fim,
            $status,
            $observacoes
        ]);
    }    

    public function listar()
    {
        $sql = "
            SELECT 
                agendamentos.id,
                agendamentos.data_hora_inicio,
                agendamentos.data_hora_fim,
                agendamentos.status,
                c.nome AS nome_cliente,
                b.nome AS nome_barbeiro,
                s.nome AS nome_servico
            FROM agendamentos
            JOIN usuarios c ON agendamentos.cliente_id = c.id
            JOIN usuarios b ON agendamentos.barbeiro_id = b.id
            JOIN servicos s ON agendamentos.servico_id = s.id
        ";

        $stmt = $this->conn->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id)
    {
        $sql = "
            SELECT *
            FROM
            agendamentos
            WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function cancelar($id)
    {
        $sql = "
            UPDATE agendamentos SET status = 'CANCELADO' WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([$id]);
    }

    public function editar($id, $cliente_id, $barbeiro_id, $data_horario_inicio)
    {
        $data_hora_fim = date('Y-m-d H:i:s', strtotime($data_horario_inicio . ' +1 hour'));
        $sql = "
            UPDATE agendamentos
            SET
                cliente_id    = ?,
                barbeiro_id    = ?,
                data_hora_inicio    = ?,
                data_hora_fim   = ?
            WHERE id = ?
            ";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([$cliente_id, $barbeiro_id, $data_horario_inicio, $data_hora_fim, $id]);
    }
}
?>
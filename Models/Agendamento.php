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
        $sqlServico = "SELECT duracao_minutos FROM servicos WHERE id = ?";
        $stmtServico = $this->conn->prepare($sqlServico);
        $stmtServico->execute([$servico_id]);  
        $servico = $stmtServico->fetch(PDO::FETCH_ASSOC);

        if(!$servico)
        {
            throw new Exception("Serviço não encontrado");
        }

        $duracao_minutos = $servico['duracao_minutos'];

        $data_hora_fim = date('Y-m-d H:i:s', strtotime($data_horario_inicio . " +{$duracao_minutos} minutes")); 

        if(strtotime($data_horario_inicio) < time())
        {
            throw new Exception("Não é possível agendar em horário passado");
        }

        if(!$this->verificarHorario($barbeiro_id, $data_horario_inicio, $data_hora_fim))
        {
            throw new Exception("Esse horário não esta disponível");
        }

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

    public function editar($id, $cliente_id, $barbeiro_id, $servico_id, $data_horario_inicio)  
    {
        $sqlServico = "SELECT duracao_minutos FROM servicos WHERE id = ?";
        $stmtServico = $this->conn->prepare($sqlServico);
        $stmtServico->execute([$servico_id]);  
        $servico = $stmtServico->fetch(PDO::FETCH_ASSOC);

        if(!$servico){
            throw new Exception("Serviço não encontrado");
        }

        $duracao_minutos = $servico['duracao_minutos'];

        $data_hora_fim = date('Y-m-d H:i:s', strtotime($data_horario_inicio . " +{$duracao_minutos} minutes")); 

        if(strtotime($data_horario_inicio) < time())
        {
            throw new Exception("Não é possível editar para um horário passado");
        }

        $sql = "
            UPDATE agendamentos
            SET
                cliente_id    = ?,
                barbeiro_id   = ?,
                servico_id    = ?, 
                data_hora_inicio = ?,
                data_hora_fim = ?
            WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([$cliente_id, $barbeiro_id, $servico_id, $data_horario_inicio, $data_hora_fim, $id]);  
    }

    public function verificarHorario($barbeiro_id, $data_hora_inicio, $data_hora_fim, $ignoreId = null)
    {
        $sql = "
            SELECT COUNT(*) 
            FROM agendamentos 
            WHERE barbeiro_id = ? 
            AND status = 'AGENDADO'
            AND (
                (data_hora_inicio < ? AND data_hora_fim > ?) 
                OR (data_hora_inicio BETWEEN ? AND ?) 
                OR (data_hora_fim BETWEEN ? AND ?)
            )
        ";
        
        $params = [
            $barbeiro_id,
            $data_hora_fim,
            $data_hora_inicio,
            $data_hora_inicio,
            $data_hora_fim,
            $data_hora_inicio,
            $data_hora_fim
        ];
        
        if ($ignoreId) {
            $sql .= " AND id != ?";
            $params[] = $ignoreId;
        }
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        
        $conflitos = $stmt->fetchColumn();
        
        return $conflitos == 0;
}

    public function finalizar($id)
    {
        $sql = "UPDATE agendamentos SET status = 'FINALIZADO' WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
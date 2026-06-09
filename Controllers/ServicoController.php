<?php

require_once __DIR__ . '/../Models/Servico.php';

class ServicoController {
    /** @var Servico */
    private Servico $model;

    public function __construct() {
        $this->model = new Servico();
    }

    public function index(): void {
        $servicos = $this->model->listar();
        $mensagem = $_SESSION['mensagem'] ?? null;
        $tipo     = $_SESSION['tipo']     ?? null;
        unset($_SESSION['mensagem'], $_SESSION['tipo']);
        require __DIR__ . '/../Views/Servico.php';
    }

    public function criar(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = $this->sanitizar($_POST);
            $erros = $this->validar($dados);
            if (empty($erros)) {
                $this->model->criar($dados);
                $_SESSION['mensagem'] = 'Serviço cadastrado com sucesso!';
                $_SESSION['tipo']     = 'sucesso';
                $this->redirecionar('listarServicos');
            } else {
                $servico = $_POST;
                require __DIR__ . '/../Views/cadastro_servico.php';
            }
        } else {
            $servico = [];
            $erros   = [];
            require __DIR__ . '/../Views/cadastro_servico.php';
        }
    }

    public function editar(int $id): void {
        $servico = $this->model->buscarPorId($id);
        if (!$servico) {
            $_SESSION['mensagem'] = 'Serviço não encontrado.';
            $_SESSION['tipo']     = 'erro';
            $this->redirecionar('listarServicos');
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = $this->sanitizar($_POST);
            $erros = $this->validar($dados);
            if (empty($erros)) {
                $this->model->atualizar($id, $dados);
                $_SESSION['mensagem'] = 'Serviço atualizado com sucesso!';
                $_SESSION['tipo']     = 'sucesso';
                $this->redirecionar('listarServicos');
            } else {
                $servico = $_POST;
                require __DIR__ . '/../Views/cadastro_servico.php';
            }
        } else {
            $erros = [];
            require __DIR__ . '/../Views/cadastro_servico.php';
        }
    }

    public function excluir(int $id): void {
        if ($this->model->buscarPorId($id)) {
            $this->model->excluir($id);
            $_SESSION['mensagem'] = 'Serviço excluído com sucesso!';
            $_SESSION['tipo']     = 'sucesso';
        } else {
            $_SESSION['mensagem'] = 'Serviço não encontrado.';
            $_SESSION['tipo']     = 'erro';
        }
        $this->redirecionar('listarServicos');
    }

    public function toggleAtivo(int $id): void {
        $this->model->toggleAtivo($id);
        $this->redirecionar('listarServicos');
    }

    private function sanitizar(array $input): array {
        return [
            'nome'            => trim(htmlspecialchars($input['nome']      ?? '')),
            'descricao'       => trim(htmlspecialchars($input['descricao'] ?? '')),
            'duracao_minutos' => filter_var($input['duracao_minutos'] ?? 0, FILTER_SANITIZE_NUMBER_INT),
            'valor'           => filter_var(str_replace(',', '.', $input['valor'] ?? '0'), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            'ativo'           => $input['ativo'] ?? null,
        ];
    }

    private function validar(array $dados): array {
        $erros = [];
        if (empty($dados['nome']))                                               $erros[] = 'Nome é obrigatório.';
        if (strlen($dados['nome']) > 100)                                        $erros[] = 'Nome deve ter no máximo 100 caracteres.';
        if (empty($dados['duracao_minutos']) || $dados['duracao_minutos'] <= 0)  $erros[] = 'Duração deve ser maior que zero.';
        if (!is_numeric($dados['valor']) || $dados['valor'] < 0)                 $erros[] = 'Valor deve ser um número positivo.';
        return $erros;
    }

    private function redirecionar(string $acao, ?int $id = null): void {
        $url = 'Index.php?action=' . $acao;
        if ($id !== null) $url .= '&id=' . $id;
        header('Location: ' . $url);
        exit;
    }
}
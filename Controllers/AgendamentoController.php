    <?php

    require_once __DIR__ . '/../Models/Agendamento.php';

    class AgendamentoController
    {
        public function criar()
        {
            if($_SERVER['REQUEST_METHOD'] ===  'POST')
                {
                    $cliente_id = $_POST['cliente_id'];
                    $barbeiro_id = $_POST['barbeiro_id'];
                    $data_hora_incio = $_POST['data_hora_inicio'];

                    $agendamento = new Agendamento();

                    $agendamento->criarReserva(
                        $cliente_id,
                        $barbeiro_id,
                        $data_hora_incio
                    );

                    header("Location: Index.php?action=listarAgendamentos");
                    exit;
                }
                require_once __DIR__ . '/../Views/cadastro_agendamento.php';
        }
        
        public function editar()
        {
            $id = $_GET['id'] ?? null;

            if(!$id)
            {
                header("Location: Index.php?action=listarAgendamentos");
                exit;
            }

            $agendamento = new Agendamento();

            if($_SERVER['REQUEST_METHOD'] === 'POST')
            {
                $cliente_id     = $_POST['cliente_id'];
                $barbeiro_id    = $_POST['barbeiro_id'];
                $data_hora_incio    = $_POST['data_hora_inicio'];


                $agendamento->editar($id, $cliente_id, $barbeiro_id, $data_hora_incio);

                header("Location: Index.php?action=listarAgendamentos");
                exit;    
            }

            $dadosAgendamento = $agendamento->buscarPorId($id);

            require 'Views/cadastro_agendamento.php';
        }

        public function listar()
        {
            $agendamento = new Agendamento();

            $agendamentos = $agendamento->listar();

            require_once __DIR__ . '/../Views/listar_Agendamentos.php';
        }

        public function cancelar()
        {
            $id = $_GET['id'] ?? null;

            if ($id)
            {
                $agendamento = new Agendamento();
                $agendamento->cancelar($id);
            }

            header("Location: Index.php?action=listarAgendamentos");
            exit;
        }
    }
    ?>
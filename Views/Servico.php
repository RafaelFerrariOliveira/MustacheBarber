<?php
/** @var string|null $mensagem */
/** @var string|null $tipo */
/** @var array       $servicos */
$mensagem = $mensagem ?? null;
$tipo     = $tipo     ?? null;
$servicos = $servicos ?? [];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Serviços — MustacheBarber</title>
  <link rel="stylesheet" href="/MustacheBarber/Views/style/global.css">
</head>
<body class="page-lista">

<div class="page-wrapper">

  <a href="Index.php?action=dashboard" class="btn-voltar">← Voltar ao dashboard</a>

  <div class="page-header">
    <div>
      <span class="page-pretitle">Gestão</span>
      <h1 class="page-title">Serviços</h1>
    </div>
    <a href="Index.php?action=cadastrarServico" class="btn-novo">+ Novo Serviço</a>
  </div>

  <?php if ($mensagem): ?>
    <div class="alert alert-<?= htmlspecialchars($tipo) ?>">
      <?= htmlspecialchars($mensagem) ?>
    </div>
  <?php endif; ?>

  <?php if (empty($servicos)): ?>
    <div class="estado-vazio">
      <p>Nenhum serviço cadastrado ainda.</p>
    </div>
  <?php else: ?>
    <div class="table-card">
      <table class="clientes-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Duração</th>
            <th>Valor</th>
            <th>Status</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($servicos as $s): ?>
            <tr>
              <td class="col-id"><?= $s['id'] ?></td>
              <td class="col-nome"><?= htmlspecialchars($s['nome']) ?></td>
              <td class="col-descricao"><?= htmlspecialchars($s['descricao'] ?: '—') ?></td>
              <td class="col-duracao"><?= (int)$s['duracao_minutos'] ?> min</td>
              <td class="col-valor">R$ <?= number_format($s['valor'], 2, ',', '.') ?></td>
              <td>
                <a href="Index.php?action=toggleServico&id=<?= $s['id'] ?>">
                  <span class="<?= $s['ativo'] ? 'badge-ativo' : 'badge-inativo' ?>">
                    <?= $s['ativo'] ? 'Ativo' : 'Inativo' ?>
                  </span>
                </a>
              </td>
              <td class="col-acoes">
                <a href="Index.php?action=editarServico&id=<?= $s['id'] ?>" class="btn-acao btn-editar">Editar</a>
                <a href="Index.php?action=excluirServico&id=<?= $s['id'] ?>" class="btn-acao btn-excluir"
                   onclick="return confirm('Excluir <?= htmlspecialchars($s['nome']) ?>?')">Excluir</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <div class="page-footer">
      <span class="badge-count"><?= count($servicos) ?> serviço(s) cadastrado(s)</span>
    </div>
  <?php endif; ?>

</div>

</body>
</html>
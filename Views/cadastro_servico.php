<?php
/** @var array $servico */
/** @var array $erros   */
$servico = $servico ?? [];
$erros   = $erros   ?? [];
$d       = !empty($_POST) ? $_POST : $servico;
$isEdit  = !empty($servico['id']);
$acao    = $isEdit ? 'Index.php?action=editarServico&id=' . $servico['id'] : 'Index.php?action=cadastrarServico';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $isEdit ? 'Editar' : 'Novo' ?> Serviço — MustacheBarber</title>
  <link rel="stylesheet" href="/MustacheBarber/Views/style/global.css">
</head>
<body class="page-form">

<div class="form-wrapper">

  <a href="Index.php?action=listarServicos" class="btn-voltar">← Voltar aos serviços</a>

  <div class="page-header">
    <div>
      <span class="page-pretitle"><?= $isEdit ? 'Editar' : 'Novo' ?></span>
      <h1 class="page-title">Serviço</h1>
    </div>
  </div>

  <?php if (!empty($erros)): ?>
    <div class="errors-box">
      <ul>
        <?php foreach ($erros as $e): ?>
          <li><?= htmlspecialchars($e) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

  <div class="form-card">
    <form action="<?= $acao ?>" method="POST">

      <div class="form-group">
        <label for="nome">Nome *</label>
        <input type="text" id="nome" name="nome" maxlength="100"
               placeholder="Ex: Corte Degradê, Barba Completa…"
               value="<?= htmlspecialchars($d['nome'] ?? '') ?>" required>
      </div>

      <div class="form-group">
        <label for="descricao">Descrição</label>
        <textarea id="descricao" name="descricao"
                  placeholder="Descreva brevemente o serviço…"><?= htmlspecialchars($d['descricao'] ?? '') ?></textarea>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="duracao_minutos">Duração (min) *</label>
          <input type="number" id="duracao_minutos" name="duracao_minutos" min="1"
                 placeholder="Ex: 30"
                 value="<?= htmlspecialchars($d['duracao_minutos'] ?? '') ?>" required>
        </div>
        <div class="form-group">
          <label for="valor">Valor (R$) *</label>
          <input type="number" id="valor" name="valor" min="0" step="0.01"
                 placeholder="Ex: 45.00"
                 value="<?= htmlspecialchars($d['valor'] ?? '') ?>" required>
        </div>
      </div>

      <div class="form-group">
        <label>Status</label>
        <label class="toggle-wrap" for="ativo">
          <input type="checkbox" id="ativo" name="ativo" value="1"
                 <?= (!empty($d['ativo']) || (!$isEdit && empty($_POST))) ? 'checked' : '' ?>>
          <span class="toggle"></span>
          <span class="toggle-label">Serviço ativo (disponível para agendamento)</span>
        </label>
      </div>

      <div class="form-actions">
        <button type="submit" class="btn-salvar">
          <?= $isEdit ? 'Salvar alterações' : 'Cadastrar serviço' ?>
        </button>
        <a href="Index.php?action=listarServicos" class="btn-cancelar">Cancelar</a>
      </div>

    </form>
  </div>

</div>

</body>
</html>
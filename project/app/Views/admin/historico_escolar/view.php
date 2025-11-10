<?php
  $session = \Config\Services::session();
?>

<?= $this->extend('admin/template/masterpage') ?>
<?= $this->section('content') ?>

<div class="row mb-2">
  <div class="col-sm-6">
    <h1>Histórico Escolar - <?= $historico->nome_aluno ?></h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="<?= base_url('Admin/home')?>">Home</a></li>
      <li class="breadcrumb-item"><a href="<?= base_url('Admin/HistoricoEscolar')?>">Histórico Escolar</a></li>
      <li class="breadcrumb-item active">Visualizar</li>
    </ol>
  </div>
</div>

<div class="row">
  <div class="col-12">
    <a href="<?= base_url('Admin/HistoricoEscolar')?>" class="btn btn-secondary mb-3">
      <i class="fas fa-arrow-left"></i> Voltar
    </a>
    <a href="<?= base_url('Admin/HistoricoEscolar/edit/' . $historico->id)?>" class="btn btn-primary mb-3">
      <i class="fas fa-edit"></i> Editar Histórico
    </a>
  </div>
</div>

<div class="row">
  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Informações do Aluno</h3>
      </div>
      <div class="card-body">
        <dl class="row">
          <dt class="col-sm-5">Matrícula:</dt>
          <dd class="col-sm-7"><?= $historico->matricula ?? '-' ?></dd>

          <dt class="col-sm-5">Nome:</dt>
          <dd class="col-sm-7"><?= $historico->nome_aluno ?></dd>

          <dt class="col-sm-5">Data Início:</dt>
          <dd class="col-sm-7"><?= $historico->data_inicio ? date('d/m/Y', strtotime($historico->data_inicio)) : '-' ?></dd>

          <dt class="col-sm-5">Situação:</dt>
          <dd class="col-sm-7">
            <?php
              $badges = [
                'ativo' => 'badge-success',
                'concluido' => 'badge-primary',
                'transferido' => 'badge-warning',
                'cancelado' => 'badge-danger'
              ];
              $badge = $badges[$historico->situacao] ?? 'badge-secondary';
            ?>
            <span class="badge <?= $badge ?>"><?= ucfirst($historico->situacao) ?></span>
          </dd>
        </dl>

        <?php if($historico->observacao_geral): ?>
          <hr>
          <strong>Observações Gerais:</strong>
          <p class="text-muted"><?= nl2br(esc($historico->observacao_geral)) ?></p>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <div class="col-md-8">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Períodos Letivos</h3>
        <a href="<?= base_url('Admin/HistoricoEscolar/Periodo/create/' . $historico->id)?>" class="btn btn-sm btn-success">
          <i class="fas fa-plus"></i> Adicionar Período
        </a>
      </div>
      <div class="card-body">
        <?php if(!empty($periodos)): ?>
          <div class="accordion" id="accordionPeriodos">
            <?php foreach($periodos as $index => $periodo): ?>
              <div class="card">
                <div class="card-header" id="heading<?= $periodo->id ?>">
                  <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse<?= $periodo->id ?>" aria-expanded="<?= $index == 0 ? 'true' : 'false' ?>" aria-controls="collapse<?= $periodo->id ?>">
                      <strong><?= $periodo->ano_letivo ?></strong> - <?= $periodo->turma ?> - <?= $periodo->estabelecimento ?>
                      <span class="badge badge-<?= $periodo->resultado == 'aprovado' ? 'success' : ($periodo->resultado == 'reprovado' ? 'danger' : 'info') ?> float-right">
                        <?= ucfirst($periodo->resultado) ?>
                      </span>
                    </button>
                  </h2>
                </div>

                <div id="collapse<?= $periodo->id ?>" class="collapse <?= $index == 0 ? 'show' : '' ?>" aria-labelledby="heading<?= $periodo->id ?>" data-parent="#accordionPeriodos">
                  <div class="card-body">
                    <dl class="row">
                      <dt class="col-sm-4">Estabelecimento:</dt>
                      <dd class="col-sm-8"><?= $periodo->estabelecimento ?></dd>

                      <dt class="col-sm-4">Município/UF:</dt>
                      <dd class="col-sm-8"><?= $periodo->municipio ?> / <?= $periodo->uf ?></dd>

                      <dt class="col-sm-4">Turma:</dt>
                      <dd class="col-sm-8"><?= $periodo->turma ?></dd>

                      <dt class="col-sm-4">Ano Letivo:</dt>
                      <dd class="col-sm-8"><?= $periodo->ano_letivo ?></dd>

                      <?php if($periodo->carga_horaria_total): ?>
                        <dt class="col-sm-4">Carga Horária:</dt>
                        <dd class="col-sm-8"><?= $periodo->carga_horaria_total ?>h</dd>
                      <?php endif; ?>

                      <?php if($periodo->frequencia): ?>
                        <dt class="col-sm-4">Frequência:</dt>
                        <dd class="col-sm-8"><?= number_format($periodo->frequencia, 2, ',', '.') ?>%</dd>
                      <?php endif; ?>
                    </dl>

                    <?php if($periodo->observacao): ?>
                      <hr>
                      <strong>Observações:</strong>
                      <p class="text-muted"><?= nl2br(esc($periodo->observacao)) ?></p>
                    <?php endif; ?>

                    <hr>
                    <div class="btn-group" role="group">
                      <a href="<?= base_url('Admin/HistoricoEscolar/Periodo/notas/' . $periodo->id)?>" class="btn btn-sm btn-info">
                        <i class="fas fa-list"></i> Ver Notas
                      </a>
                      <a href="<?= base_url('Admin/HistoricoEscolar/Periodo/edit/' . $periodo->id)?>" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i> Editar
                      </a>
                      <a href="<?= base_url('Admin/HistoricoEscolar/Periodo/delete/' . $periodo->id)?>" class="btn btn-sm btn-danger" onclick="return confirm('Deseja realmente excluir este período?')">
                        <i class="fas fa-trash"></i> Excluir
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> Nenhum período letivo cadastrado ainda.
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>

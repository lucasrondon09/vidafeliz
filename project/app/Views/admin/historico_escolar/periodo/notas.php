<?php
  $session = \Config\Services::session();
?>

<?= $this->extend('admin/template/masterpage') ?>
<?= $this->section('content') ?>

<div class="row mb-2">
  <div class="col-sm-6">
    <h1>Notas do Período</h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="<?= base_url('Admin/home')?>">Home</a></li>
      <li class="breadcrumb-item"><a href="<?= base_url('Admin/HistoricoEscolar')?>">Histórico Escolar</a></li>
      <li class="breadcrumb-item"><a href="<?= base_url('Admin/HistoricoEscolar/view/' . $historico->id)?>"><?= $historico->nome_aluno ?></a></li>
      <li class="breadcrumb-item active">Notas</li>
    </ol>
  </div>
</div>

<div class="row">
  <div class="col-12">
    <a href="<?= base_url('Admin/HistoricoEscolar/view/' . $historico->id)?>" class="btn btn-secondary mb-3">
      <i class="fas fa-arrow-left"></i> Voltar
    </a>
    <a href="<?= base_url('Admin/HistoricoEscolar/Notas/create/' . $periodo->id)?>" class="btn btn-success mb-3">
      <i class="fas fa-plus"></i> Adicionar Disciplina/Nota
    </a>
  </div>
</div>

<div class="row">
  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Informações do Período</h3>
      </div>
      <div class="card-body">
        <dl class="row">
          <dt class="col-sm-5">Aluno:</dt>
          <dd class="col-sm-7"><?= $historico->nome_aluno ?></dd>

          <dt class="col-sm-5">Ano Letivo:</dt>
          <dd class="col-sm-7"><?= $periodo->ano_letivo ?></dd>

          <dt class="col-sm-5">Turma:</dt>
          <dd class="col-sm-7"><?= $periodo->turma ?></dd>

          <dt class="col-sm-5">Escola:</dt>
          <dd class="col-sm-7"><?= $periodo->estabelecimento ?></dd>

          <dt class="col-sm-5">Local:</dt>
          <dd class="col-sm-7"><?= $periodo->municipio ?>/<?= $periodo->uf ?></dd>

          <dt class="col-sm-5">Resultado:</dt>
          <dd class="col-sm-7">
            <?php
              $badges = [
                'aprovado' => 'badge-success',
                'reprovado' => 'badge-danger',
                'cursando' => 'badge-info',
                'transferido' => 'badge-warning'
              ];
              $badge = $badges[$periodo->resultado] ?? 'badge-secondary';
            ?>
            <span class="badge <?= $badge ?>"><?= ucfirst($periodo->resultado) ?></span>
          </dd>
        </dl>
      </div>
    </div>
  </div>

  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Disciplinas e Notas</h3>
      </div>
      <div class="card-body">
        <?php
        if(!empty($session->getFlashdata('alert'))){
          $alert = $session->getFlashdata('alert');
          $message = $session->getFlashdata('message');
          $classAlert = ($alert == 'success') ? 'success' : 'danger';
        }

        if(isset($alert)):
        ?>    
          <div class="mb-3">
            <div>
              <div class="alert alert-<?= $classAlert;?> alert-dismissible fade show" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                  <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                </svg>
                <?= $message;?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
          </div>                    
        <?php endif;?>

        <?php if(!empty($notas)): ?>
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Disciplina</th>
                  <th>CH</th>
                  <th>Nota</th>
                  <th>Resultado</th>
                  <th>Faltas</th>
                  <th style="width: 120px;">Ações</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($notas as $nota): ?>
                  <tr>
                    <td><?= $nota->disciplina ?></td>
                    <td><?= $nota->carga_horaria ?? '-' ?>h</td>
                    <td><?= $nota->nota ?? '-' ?></td>
                    <td>
                      <?php
                        $badges = [
                          'aprovado' => 'badge-success',
                          'reprovado' => 'badge-danger',
                          'dependencia' => 'badge-warning',
                          'dispensado' => 'badge-info'
                        ];
                        $badge = $badges[$nota->resultado] ?? 'badge-secondary';
                      ?>
                      <span class="badge <?= $badge ?>"><?= ucfirst($nota->resultado) ?></span>
                    </td>
                    <td><?= $nota->faltas ?></td>
                    <td>
                      <a href="<?= base_url('Admin/HistoricoEscolar/Notas/edit/' . $nota->id)?>" class="btn btn-sm btn-primary" title="Editar">
                        <i class="fas fa-edit"></i>
                      </a>
                      <a href="<?= base_url('Admin/HistoricoEscolar/Notas/delete/' . $nota->id)?>" class="btn btn-sm btn-danger" title="Excluir" onclick="return confirm('Deseja realmente excluir esta nota?')">
                        <i class="fas fa-trash"></i>
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        <?php else: ?>
          <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> Nenhuma disciplina/nota cadastrada neste período ainda.
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>

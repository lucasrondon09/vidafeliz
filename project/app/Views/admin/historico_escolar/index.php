<?php
  $session = \Config\Services::session();
?>

<?= $this->extend('admin/template/masterpage') ?>
<?= $this->section('content') ?>

<div class="row mb-2">
  <div class="col-sm-6">
    <h1>Histórico Escolar</h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="<?= base_url('Admin/home')?>">Home</a></li>
      <li class="breadcrumb-item active">Histórico Escolar</li>
    </ol>
  </div>
</div>

<div class="row">
  <div class="col-12">
    <a href="<?= base_url('Admin/HistoricoEscolar/create')?>" class="btn btn-success">
      <i class="fas fa-plus fa-fw"></i>
      Cadastrar Histórico
    </a>
  </div>
</div>

<div class="row mt-3">
  <div class="col-12">
    <div class="card">
      <div class="card-header d-flex align-items-center">
        <h3 class="card-title">Registros</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
      <?php
        if(!empty($session->getFlashdata('alert'))){
          $alert = $session->getFlashdata('alert');
          $message = $session->getFlashdata('message');
          $classAlert = ($alert == 'success') ? 'success' : 'danger';
        }

        if(isset($alert)):
        ?>    
          <div class="mt-4">
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
        
        <table id="registros" class="table table-bordered table-hover mb-3">
          <thead>
          <tr>
            <th>Matrícula</th>
            <th>Aluno</th>
            <th>Data Início</th>
            <th>Situação</th>
            <th style="width: 150px;">Ações</th>
          </tr>
          </thead>
          <tbody>
          <?php if(!empty($historicos)): ?>
            <?php foreach($historicos as $historico): ?>
              <tr>
                <td><?= $historico->matricula ?? '-' ?></td>
                <td><?= $historico->nome_aluno ?></td>
                <td><?= $historico->data_inicio ? date('d/m/Y', strtotime($historico->data_inicio)) : '-' ?></td>
                <td>
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
                </td>
                <td>                  <a href="<?= base_url('Admin/HistoricoEscolar/view/' . $historico->id)?>"
 class="btn btn-sm btn-info" title="Visualizar">
                    <i class="fas fa-eye"></i>
                  </a>
                  <a href="<?= base_url('Admin/HistoricoEscolarPdf/gerar/' . $historico->id)?>"
 class="btn btn-sm btn-danger" title="Gerar PDF" target="_blank">
                    <i class="fas fa-file-pdf"></i>
                  </a>
                  <a href="<?= base_url('Admin/HistoricoEscolar/edit/' . $historico->id)?>"
 class="btn btn-sm btn-primary" title="Editar">
                    <i class="fas fa-edit"></i>
                  </a>
                  <a href="<?= base_url('Admin/HistoricoEscolar/delete/' . $historico->id)?>"
 class="btn btn-sm btn-danger" title="Excluir"
 onclick="return confirm('Deseja realmente excluir este histórico?')">
                    <i class="fas fa-trash"></i>
                  </a>              </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="5" class="text-center">Nenhum histórico cadastrado</td>
            </tr>
          <?php endif; ?>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>



<?= $this->endSection() ?>

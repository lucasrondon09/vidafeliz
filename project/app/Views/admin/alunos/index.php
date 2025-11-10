<?php 
  $session = \Config\Services::session();
  
?>

<?= $this->extend('admin/template/masterpage') ?>
<?= $this->section('content') ?>


<div class="row mb-2">
  <div class="col-sm-6">
    <h1>Alunos</h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="<?= base_url('Admin/home')?>">Home</a></li>
      <li class="breadcrumb-item active">Alunos</li>
    </ol>
    
  </div>
</div>
<?php if(!empty($id_pai)):?>
<div class="row">
  <div class="col-12">
    <a href="<?= base_url('Admin/Alunos/cadastrar/'.$id_pai)?>" class="btn btn-success">
      <i class="fas fa-plus fa-fw"></i>
      Cadastrar
    </a>
  </div>
</div>
<?php endif?>

<div class="row mt-3">
  <div class="col-12">
    <div class="card">
      <div class="card-header d-flex align-items-center">
        <h3 class="card-title">Registros</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
      <?php

        if(!empty($session->getFlashdata())){
          $alert = $session->getFlashdata();
          
          if(key($alert) == 'success'){
            
            $classAlert = 'success';
            $message    = $session->getFlashdata('success');
          }else{

            $classAlert = 'danger';
            $message    = $session->getFlashdata('error');
          }
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
            <th>Matricula</th>
            <th>Nome</th>
            <th>Turma</th>
            <th>Ano</th>
            <th>Período</th>
            <th></th>
          </tr>
          </thead>
          <tbody>
          <?php foreach($table as $tableItem):?>
            <tr>
              <td><?= $tableItem->matricula?></td>
              <td><?= $tableItem->nome?></td>
              <td><?= isset($tableItem->nome_turma) ? $tableItem->nome_turma :  '--' ?></td>
              <td><?= isset($tableItem->ano_turma) ? $tableItem->ano_turma :  '--' ?></td>
              <td><?= isset($tableItem->periodo_turma) ? getPeriodos($tableItem->periodo_turma) :  '--' ?></td>
              <td class="text-center">
                <a href="<?= base_url('Admin/Alunos/historico-escolar').'/'.$tableItem->id;?>" class="btn btn-sm btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Histórico Escolar">
                  <i class="fas fa-file-alt"></i>
                </a>
                <a href="<?= base_url('Admin/Alunos/visualizar').'/'.$tableItem->id.'/'.(isset($id_pai) ? $id_pai : '');?>" class="btn btn-sm btn-outline-info" data-toggle="tooltip" data-placement="top" title="Visualizar">
                  <i class="fa fa-eye"></i>
                </a>

                <a href="<?= base_url('Admin/Alunos/editar').'/'.$tableItem->id.'/'.(isset($id_pai) ? $id_pai : '');?>" class="btn btn-sm btn-outline-warning" data-toggle="tooltip" data-placement="top" title="Editar">
                  <i class="fas fa-pen fa-fw"></i>
                </a>
                
                <a href="<?= base_url('Admin/Alunos/excluir').'/'.$tableItem->id;?>" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Excluir" onClick="return deletar()">
                  <i class="fas fa-trash fa-fw"></i>
                </a>
              </td>
            </tr>
          <?php endforeach;?>  
          </tbody>
        </table>    
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>



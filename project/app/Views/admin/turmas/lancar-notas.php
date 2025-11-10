<?php 
  $session = \Config\Services::session();
  
?>

<?= $this->extend('admin/template/masterpage') ?>
<?= $this->section('content') ?>


<div class="row mb-2">
  <div class="col-sm-6">
    <h1>Lançar Notas</h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="<?= base_url('Admin/home')?>">Home</a></li>
      <li class="breadcrumb-item active">Lançar Notas</li>
    </ol>
    
  </div>
</div>
<div class="row">
  <div class="col-12">
    <a href="<?= $url?>" class="btn btn-primary">
      <i class="fas fa-arrow-left fa-fw"></i>
      Voltar
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
            <th>Disciplinas</th>
            <th></th>
          </tr>
          </thead>
          <tbody>
          <?php foreach($disciplinasTurma as $disciplinasTurmaItem):?>
            <tr>
              <td><?= $disciplinasTurmaItem->descricao?></td><td class="text-center">

                <a href="<?= base_url('Admin/Turmas/lancar-notas-alunos').'/'.$id_turma.'/'.$disciplinasTurmaItem->id_turma_disciplina;?>" class="btn btn-sm btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Lançar Notas">
                    <i class="fas fa-arrow-right fa-fw"></i>
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

<script>
  function deletar(){

    return confirm('Tem certeza que deseja excluir o registro?');

  }
</script>

<?= $this->endSection() ?>



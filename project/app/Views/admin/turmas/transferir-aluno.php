<?php 
$session = \Config\Services::session();
$validate = \Config\Services::validation();
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
      <li class="breadcrumb-item"><a href="<?= base_url('Admin/Turmas')?>">Turmas</a></li>
    </ol>
  </div>
</div>
<div class="row mt-2">
  <!-- left column -->
  <div class="col-md-12">
    <!-- jquery validation -->
    <div class="card">
      <h3 class="card-title mt-3">
        <a href="<?= base_url('Admin/Turmas/alunos/'.$id_turma)?>" class="text-decoration-none text-dark">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
          </svg>
        </a>               
        Registros
      </h3>
      <!-- form start -->
      <?php

      if(!empty($session->getFlashdata())){
        $alert = $session->getFlashdata();
        
        if(key($alert) == 'success'){
          
          $classAlert = 'success';
          $message    = $session->getFlashdata('success');
        }elseif(key($alert) == 'danger'){

          $classAlert = 'danger';
          $message    = $session->getFlashdata('error');
        }else{
          $classAlert = '';
          $message    = '';
        }
      }

      if(!empty($classAlert)):
      
      ?>    
        <div class="row mt-4 px-3">
          <div class="col-12">
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
      <div class="row">
        <div class="col-12">
          <span class="text-danger"><?= $validate->listErrors(); ?></span>
        </div>
      </div>
      
      <?= csrf_field() ?>
        <div class="card-body">
        <div class="form-group">
            <label for="nome">Matricula</label>
            <input type="text" name="matricula" class="form-control" value="<?= $aluno->matricula ?>" readonly>
          </div>
          <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" name="nome" class="form-control" value="<?= $aluno->nome ?>" readonly>
          </div>
          <div class="form-group">
            <label for="nome">Turma Atual</label>
            <input type="text" name="turma" class="form-control" value="<?= $turma_atual ?>" readonly>
          </div>
          <hr>
          <?= form_open(base_url('/Admin/Turmas/alunos/transferir/'.$id_turma.'/'.$id_aluno))?>
          <div class="form-group">
            <h3>Transferir Aluno</h3>
            <div class="col-md-12">
              <label for="bairro">Turmas</label>
              <select name="turma" class="form-control" id="turma">
                <option value="" disabled selected>Selecione uma turma</option>
                <?php foreach($turmas as $turma):?>
                  <option value="<?= $turma->id?>"><?= $turma->nome?></option>
                <?php endforeach?>;
              </select>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <?php if(!empty($idAlunoTurma->id)):?>
            <button type="submit" class="btn btn-primary" id="submit">
              Salvar
            </button>
            
            <a href="<?= base_url('Admin/Alunos/cancelar-matricula/'.$idAlunoTurma->id)?>" class="btn btn-danger">
              Cancelar Matrícula
            </a>
            <?php endif;?>
        </div>
        <?= form_close() ?>
    </div>
    </div>
</div>
<?= $this->endSection() ?>


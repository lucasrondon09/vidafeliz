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
      <li class="breadcrumb-item"><a href="<?= base_url('Admin/Alunos')?>">Alunos</a></li>
      <li class="breadcrumb-item"><a href="<?= base_url('Admin/Alunos/historico-escolar/'.$idAluno)?>">Histórico Escolar</a></li>
      <li class="breadcrumb-item active">Disciplinas e Notas</li>
    </ol>
  </div>
</div>
<div class="row mt-2">
  <!-- left column -->
  <div class="col-md-12">
    <!-- jquery validation -->
    <div class="card">
      <!-- form start -->
      <?php

      if(!empty($session->getFlashdata())){
        $alert = $session->getFlashdata();
        
        if(key($alert) == 'success'){
          
          $classAlert = 'success';
          $message    = $session->getFlashdata('success');
        }elseif(key($alert) == 'error'){

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
      
        <div class="card-body">
          <a href="<?= base_url('Admin/Alunos/historico-escolar/disciplinas-notas/'.$idHistorico) ?>" class="btn btn-secondary">
          <i class="fas fa-arrow-left"></i> Voltar
          </a>
          <?= form_open($action)?>
          <?= $type == 'read' ? '<fieldset disabled>': '';?>
          <?= csrf_field() ?>
          <h3 class="mt-3"><?= $aluno->nome?></h3>
          <div class="form-group row">
            <div class="col-md-4">
                <label for="ano">Disciplina</label>
                <select name="id_disciplina" class="form-control" id="id_disciplina"> 
                  <option value="" disabled selected>Selecione o disciplina</option>
                    <?php foreach($disciplinas as $disciplina):?>
                      <option value="<?= $disciplina->id?>" <?= isset($record->id_disciplina) && $record->id_disciplina == $disciplina->id ? 'selected' : set_select('id_disciplina', $disciplina->id) ?>>
                        <?= $disciplina->descricao?>
                      </option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="col-md-8">
              <label for="nota">Nota</label>
                <input type="number" step="0.01" name="nota" class="form-control" value="<?= isset($record) ? $record->nota : set_value('nota') ?>">
            </div>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <?php if($type !== 'read'):?>
            <button type="submit" class="btn btn-primary" id="submit">
              Salvar
            </button>
          <?php endif;?>
        </div>
        <?= $type = 'read' ? '</fieldset>': '';?>
        <?= form_close() ?>
    </div>
    </div>
</div>
<?= $this->endSection() ?>


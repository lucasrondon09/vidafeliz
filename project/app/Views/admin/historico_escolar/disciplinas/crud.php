<?php 
  $session = \Config\Services::session();
  $validation = \Config\Services::validation();
?>

<?= $this->extend('admin/template/masterpage') ?>
<?= $this->section('content') ?>

<div class="row mb-2">
  <div class="col-sm-6">
    <h1><?= $title?></h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="<?= base_url('Admin/home')?>">Home</a></li>
      <li class="breadcrumb-item"><a href="<?= base_url('Admin/HistoricoEscolar/Disciplinas')?>">Disciplinas</a></li>
      <li class="breadcrumb-item active"><?= $titleBreadcrumb?></li>
    </ol>
  </div>
</div>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><?= $title?></h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <a href="<?= base_url('Admin/HistoricoEscolar/Disciplinas')?>" class="btn btn-secondary mb-3">
          <i class="fas fa-arrow-left"></i> Voltar
        </a>

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

        <?php if($validation->getErrors()):?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Erro de validação:</strong>
            <ul class="mb-0">
              <?php foreach($validation->getErrors() as $error):?>
                <li><?= esc($error)?></li>
              <?php endforeach;?>
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php endif;?>

        <form action="<?= $action?>" method="post">
          <?= csrf_field() ?>

          <div class="row">
            <div class="col-md-8">
              <div class="form-group">
                <label for="descricao">Descrição da Disciplina <span class="text-danger">*</span></label>
                <input 
                  type="text" 
                  class="form-control <?= $validation->hasError('descricao') ? 'is-invalid' : '' ?>" 
                  id="descricao" 
                  name="descricao" 
                  placeholder="Ex: Matemática, Português, História..."
                  value="<?= old('descricao', isset($record) ? esc($record->descricao) : '')?>"
                  <?= $type == 'read' ? 'readonly' : '' ?>
                  required
                  maxlength="50">
                <?php if($validation->hasError('descricao')):?>
                  <div class="invalid-feedback">
                    <?= $validation->getError('descricao')?>
                  </div>
                <?php endif;?>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="carga_horaria">Carga Horária (horas)</label>
                <input 
                  type="number" 
                  class="form-control <?= $validation->hasError('carga_horaria') ? 'is-invalid' : '' ?>" 
                  id="carga_horaria" 
                  name="carga_horaria" 
                  placeholder="Ex: 80, 120, 160..."
                  value="<?= old('carga_horaria', isset($record) ? esc($record->carga_horaria) : '')?>"
                  <?= $type == 'read' ? 'readonly' : '' ?>
                  min="1"
                  step="1">
                <?php if($validation->hasError('carga_horaria')):?>
                  <div class="invalid-feedback">
                    <?= $validation->getError('carga_horaria')?>
                  </div>
                <?php endif;?>
                <small class="form-text text-muted">Campo opcional</small>
              </div>
            </div>
          </div>

          <?php if($type != 'read'):?>
          <div class="row mt-3">
            <div class="col-12">
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Salvar
              </button>
              <a href="<?= base_url('Admin/HistoricoEscolar/Disciplinas')?>" class="btn btn-secondary">
                <i class="fas fa-times"></i> Cancelar
              </a>
            </div>
          </div>
          <?php endif;?>
        </form>

      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>

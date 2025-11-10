<?php 
$session = \Config\Services::session();
$validate = \Config\Services::validation();
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
        <li class="breadcrumb-item"><a href="<?= $url?>"><?= $title?></a></li>
        <li class="breadcrumb-item active"><?= $titleBreadcrumb?></li>
      </ol>
    </div>
  </div>
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- jquery validation -->
      <div class="card">
        <h3 class="card-title mt-3">
          <a href="<?= $url?>" class="text-decoration-none text-dark">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
            </svg>
          </a>               
          <?= $titleType?>
        </h3>
        <!-- form start -->
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
        <?= form_open($action) ?>
        <?= $type == 'read' ? '<fieldset disabled>': '';?>
        <?= csrf_field() ?>
          <div class="card-body">
            <div class="form-group">
              <label for="nome">Nome</label>
              <input type="text" name="nome" class="form-control" id="nome" name="nome" value="<?= isset($record) ? $record->nome : set_value('nome') ?>">
            </div>
            <div class="form-group">
              <label for="grau">Período</label>
              <?php $periodos = getPeriodos(); ?>
              <?php if (isset($record->periodo)): ?>
                <select name="periodo" class="form-control" id="periodo">
                  <?php foreach($periodos as $key => $value): ?>
                    <option value="<?= $key ?>" <?= $record->periodo == $key ? 'selected' : '' ?>><?= $value ?></option>
                  <?php endforeach; ?>
                </select>
              <?php else: ?>
                <select name="periodo" class="form-control" id="periodo">
                  <option value="0" selected>--Selecione--</option>
                  <?php foreach($periodos as $key => $value):?>
                    <option value="<?= $key?>" <?= set_select('periodo', $key) ?>><?= $value?></option>
                  <?php endforeach;?>
                </select>
              <?php endif; ?>
            </div>
            <div class="form-group">
              <label for="grau">Grau</label>
              <?php $grau = getGrau(); ?>
              <?php if (isset($record->grau)): ?>
                <select name="grau" class="form-control" id="grau">
                  <?php foreach($grau as $keyGrau => $valueGrau): ?>
                    <option value="<?= $keyGrau ?>" <?= $record->grau == $keyGrau ? 'selected' : '' ?>><?= $valueGrau ?></option>
                  <?php endforeach; ?>
                </select>
              <?php else: ?>
                <select name="grau" class="form-control" id="grau">
                  <option value="0" selected>--Selecione--</option>
                  <?php foreach($grau as $keyGrau => $valueGrau):?>
                    <option value="<?= $keyGrau?>" <?= set_select('periodo', $keyGrau) ?>><?= $valueGrau?></option>
                  <?php endforeach;?>
                </select>
              <?php endif; ?>
            </div>
            <div class="form-group">
              <label for="dias_letivos">Dias Letivos</label>
              <input type="number" name="dias_letivos" class="form-control" id="dias_letivos" min="0" step="1" value="<?= isset($record) ? $record->dias_letivos : set_value('dias_letivos') ?>">
            </div>
            <div class="form-group">
              <label for="carga_horaria">Carga Horária</label>
              <input type="number" name="carga_horaria" class="form-control" id="carga_horaria" min="0" step="1" value="<?= isset($record) ? $record->carga_horaria : set_value('carga_horaria') ?>">
            </div>
            <div class="form-group">
              <label for="senha">Ano Letivo</label>
                <input type="number" name="ano_letivo" class="form-control" id="ano_letivo" min="1900" max="<?= date('Y')+1 ?>" placeholder="AAAA" value="<?= isset($record) ? $record->ano_letivo : date('Y') ?>">
            </div>
          </div>
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
      <!-- /.card -->
      </div>
    <!--/.col (left) -->
    <!-- right column -->
    <div class="col-md-6">

    </div>
    <!--/.col (right) -->
  </div>
  <?= $this->endSection() ?>

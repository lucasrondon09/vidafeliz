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
      <li class="breadcrumb-item active"><?= $titleBreadcrumb?></li>
    </ol>
  </div>
</div>
<div class="row mt-2">
  <!-- left column -->
  <div class="col-md-12">
    <!-- jquery validation -->
    <div class="card">
      <h3 class="card-title mt-3">
        <?php 
          $urlParam = base_url('Admin/Alunos').(!empty($id_pai) ? '/'.$id_pai: '');

          if(!empty($session->getFlashdata('id_turma'))){
            $urlParam = base_url('Admin/Turmas/alunos').'/'.$session->getFlashdata('id_turma');
          }
        ?>
        <a href="<?= $urlParam?>" class="text-decoration-none text-dark">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
          </svg>
        </a>               
        <?= $title?>
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
      <?= form_open($action)?>
      <?= $type == 'read' ? '<fieldset disabled>': '';?>
      <?= csrf_field() ?>
        <div class="card-body">
          <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" name="nome" class="form-control" value="<?= isset($record) ? $record->nome : set_value('nome') ?>">
          </div>
          <div class="form-group row">
            <div class="col-md-4">
              <label for="cpf">CPF</label>
              <input type="text" name="cpf" class="form-control cpf_mask" id="cpf" value="<?= isset($record) ? $record->cpf : set_value('cpf') ?>">
            </div>
            <div class="col-md-4">
              <label for="rg">RG</label>
              <input type="text" name="rg" class="form-control" id="rg" value="<?= isset($record) ? $record->rg : set_value('rg') ?>">
            </div>
            <div class="col-md-4">
              <label for="data_nascimento">Data de Nascimento</label>
              <input type="date" name="nascimento" class="form-control" id="nascimento" value="<?= isset($record) ? $record->nascimento : set_value('nascimento') ?>">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-6">
              <label for="telefone">Telefone</label>
              <input type="text" name="telefone" class="form-control fone_mask" id="telefone" value="<?= isset($record) ? $record->telefone : set_value('telefone') ?>">
            </div>
            <div class="col-md-6">
              <label for="mae_email">Email</label>
              <input type="email" name="email" class="form-control" id="email" value="<?= isset($record) ? $record->email : set_value('email') ?>">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-6">
              <label for="naturalidade">Naturalidade</label>
              <input type="text" name="naturalidade" class="form-control" id="naturalidade" value="<?= isset($record) ? $record->naturalidade : set_value('naturalidade') ?>">
            </div>
            <div class="col-md-6">
              <label for="nacionalidade">Nacionalidade</label>
              <input type="text" name="nacionalidade" class="form-control" id="nacionalidade" value="<?= isset($record) ? $record->nacionalidade : set_value('nacionalidade') ?>">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-6">
              <label for="endereco">Endereço</label>
              <input type="text" name="endereco" class="form-control" id="endereco" value="<?= isset($record) ? $record->endereco : set_value('endereco') ?>">
            </div>
            <div class="col-md-2">
              <label for="numero">Número</label>
              <input type="text" name="numero" class="form-control" id="numero" value="<?= isset($record) ? $record->numero : set_value('numero') ?>">
            </div>
            <div class="col-md-4">
              <label for="complemento">Complemento</label>
              <input type="text" name="complemento" class="form-control" id="complemento" value="<?= isset($record) ? $record->complemento : set_value('complemento') ?>">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-3">
              <label for="bairro">Bairro</label>
              <input type="text" name="bairro" class="form-control" id="bairro" value="<?= isset($record) ? $record->bairro : set_value('bairro') ?>">
            </div>
            <div class="col-md-3">
              <label for="cidade">Cidade</label>
              <input type="text" name="cidade" class="form-control" id="cidade" value="<?= isset($record) ? $record->cidade : set_value('cidade') ?>">
            </div>
            <div class="col-md-3">
              <label for="estado">Estado</label>
              <input type="text" name="estado" class="form-control" id="estado" value="<?= isset($record) ? $record->estado : set_value('estado') ?>">
            </div>
            <div class="col-md-3">
              <label for="cep">CEP</label>
              <input type="text" name="cep" class="form-control cep_mask" id="cep" value="<?= isset($record) ? $record->cep : set_value('cep') ?>">
            </div>
          </div>
          <hr>
          <div class="form-group">
            <h3>Matricular Aluno</h3>
            <div class="col-md-12">
              <label for="bairro">Turmas</label>
              <select name="turma" class="form-control" id="turma">
                <option value="" disabled selected>Selecione uma turma</option>
                <?php foreach($turmas as $turma):?>
                  <option value="<?= $turma->id?>" <?= isset($turma_aluno->id_turma) && $turma_aluno->id_turma == $turma->id ? 'selected' : set_select('turma', $turma->id) ?>><?= $turma->nome?></option>
                <?php endforeach?>;
              </select>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <?php if($type !== 'read'):?>
            <button type="submit" class="btn btn-primary" id="submit">
              Salvar
            </button>
            <?php if(!empty($turma_aluno)):?>
            <a href="<?= base_url('Admin/Alunos/cancelar-matricula/'.$turma_aluno->id)?>" class="btn btn-danger">
              Cancelar Matrícula
            </a>
            <?php endif;?>
          <?php endif;?>
        </div>
        <?= $type = 'read' ? '</fieldset>': '';?>
        <?= form_close() ?>
    </div>
    </div>
</div>
<?= $this->endSection() ?>


<?php
  $session = \Config\Services::validation();
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
      <li class="breadcrumb-item"><a href="<?= base_url('Admin/HistoricoEscolar')?>">Histórico Escolar</a></li>
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
        <a href="<?= base_url('Admin/HistoricoEscolar')?>" class="btn btn-secondary mb-3">
          <i class="fas fa-arrow-left"></i> Voltar
        </a>

        <?php
        $session = \Config\Services::session();
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

        <form action="<?= $action?>" method="post">
          <?= csrf_field() ?>

          <div class="form-group">
            <label for="id_aluno">Aluno <span class="text-danger">*</span></label>
            <select class="form-control <?= $validation->hasError('id_aluno') ? 'is-invalid' : '' ?>" 
                    id="id_aluno" 
                    name="id_aluno" 
                    required
                    <?= $type == 'edit' ? 'disabled' : '' ?>>
              <option value="">Selecione um aluno</option>
              <?php if(!empty($alunos)): ?>
                <?php foreach($alunos as $aluno): ?>
                  <option value="<?= $aluno->id ?>" 
                          <?= (isset($historico) && $historico->id_aluno == $aluno->id) ? 'selected' : '' ?>>
                    <?= $aluno->matricula ?> - <?= $aluno->nome ?>
                  </option>
                <?php endforeach; ?>
              <?php endif; ?>
            </select>
            <?php if($type == 'edit'): ?>
              <input type="hidden" name="id_aluno" value="<?= $historico->id_aluno ?>">
            <?php endif; ?>
            <?php if($validation->hasError('id_aluno')): ?>
              <div class="invalid-feedback">
                <?= $validation->getError('id_aluno') ?>
              </div>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label for="data_inicio">Data de Início</label>
            <input type="date" 
                   class="form-control <?= $validation->hasError('data_inicio') ? 'is-invalid' : '' ?>" 
                   id="data_inicio" 
                   name="data_inicio" 
                   value="<?= old('data_inicio', isset($historico) ? $historico->data_inicio : '') ?>">
            <?php if($validation->hasError('data_inicio')): ?>
              <div class="invalid-feedback">
                <?= $validation->getError('data_inicio') ?>
              </div>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label for="situacao">Situação <span class="text-danger">*</span></label>
            <select class="form-control <?= $validation->hasError('situacao') ? 'is-invalid' : '' ?>" 
                    id="situacao" 
                    name="situacao" 
                    required>
              <option value="">Selecione</option>
              <option value="ativo" <?= old('situacao', isset($historico) ? $historico->situacao : '') == 'ativo' ? 'selected' : '' ?>>Ativo</option>
              <option value="concluido" <?= old('situacao', isset($historico) ? $historico->situacao : '') == 'concluido' ? 'selected' : '' ?>>Concluído</option>
              <option value="transferido" <?= old('situacao', isset($historico) ? $historico->situacao : '') == 'transferido' ? 'selected' : '' ?>>Transferido</option>
              <option value="cancelado" <?= old('situacao', isset($historico) ? $historico->situacao : '') == 'cancelado' ? 'selected' : '' ?>>Cancelado</option>
            </select>
            <?php if($validation->hasError('situacao')): ?>
              <div class="invalid-feedback">
                <?= $validation->getError('situacao') ?>
              </div>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label for="observacao_geral">Observações Gerais</label>
            <textarea class="form-control <?= $validation->hasError('observacao_geral') ? 'is-invalid' : '' ?>" 
                      id="observacao_geral" 
                      name="observacao_geral" 
                      rows="4"><?= old('observacao_geral', isset($historico) ? $historico->observacao_geral : '') ?></textarea>
            <?php if($validation->hasError('observacao_geral')): ?>
              <div class="invalid-feedback">
                <?= $validation->getError('observacao_geral') ?>
              </div>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-success">
              <i class="fas fa-save"></i> Salvar
            </button>
            <a href="<?= base_url('Admin/HistoricoEscolar')?>" class="btn btn-secondary">
              <i class="fas fa-times"></i> Cancelar
            </a>
          </div>
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>

<?= $this->endSection() ?>

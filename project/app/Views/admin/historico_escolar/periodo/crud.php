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
      <li class="breadcrumb-item"><a href="<?= base_url('Admin/HistoricoEscolar')?>">Histórico Escolar</a></li>
      <li class="breadcrumb-item"><a href="<?= base_url('Admin/HistoricoEscolar/view/' . $historico->id)?>"><?= $historico->nome_aluno ?></a></li>
      <li class="breadcrumb-item active"><?= $titleBreadcrumb?></li>
    </ol>
  </div>
</div>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><?= $title?> - <?= $historico->nome_aluno ?></h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <a href="<?= base_url('Admin/HistoricoEscolar/view/' . $historico->id)?>" class="btn btn-secondary mb-3">
          <i class="fas fa-arrow-left"></i> Voltar
        </a>

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

        <form action="<?= $action?>" method="post">
          <?= csrf_field() ?>

          <div class="row">
            <div class="col-md-8">
              <div class="form-group">
                <label for="estabelecimento">Estabelecimento de Ensino <span class="text-danger">*</span></label>
                <input type="text" 
                       class="form-control <?= $validation->hasError('estabelecimento') ? 'is-invalid' : '' ?>" 
                       id="estabelecimento" 
                       name="estabelecimento" 
                       value="<?= old('estabelecimento', isset($periodo) ? $periodo->estabelecimento : '') ?>"
                       required
                       maxlength="500">
                <?php if($validation->hasError('estabelecimento')): ?>
                  <div class="invalid-feedback">
                    <?= $validation->getError('estabelecimento') ?>
                  </div>
                <?php endif; ?>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="ano_letivo">Ano Letivo <span class="text-danger">*</span></label>
                <input type="text" 
                       class="form-control <?= $validation->hasError('ano_letivo') ? 'is-invalid' : '' ?>" 
                       id="ano_letivo" 
                       name="ano_letivo" 
                       value="<?= old('ano_letivo', isset($periodo) ? $periodo->ano_letivo : '') ?>"
                       required
                       maxlength="4"
                       placeholder="Ex: 2023">
                <?php if($validation->hasError('ano_letivo')): ?>
                  <div class="invalid-feedback">
                    <?= $validation->getError('ano_letivo') ?>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="municipio">Município <span class="text-danger">*</span></label>
                <input type="text" 
                       class="form-control <?= $validation->hasError('municipio') ? 'is-invalid' : '' ?>" 
                       id="municipio" 
                       name="municipio" 
                       value="<?= old('municipio', isset($periodo) ? $periodo->municipio : '') ?>"
                       required
                       maxlength="200">
                <?php if($validation->hasError('municipio')): ?>
                  <div class="invalid-feedback">
                    <?= $validation->getError('municipio') ?>
                  </div>
                <?php endif; ?>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <label for="uf">UF <span class="text-danger">*</span></label>
                <input type="text" 
                       class="form-control <?= $validation->hasError('uf') ? 'is-invalid' : '' ?>" 
                       id="uf" 
                       name="uf" 
                       value="<?= old('uf', isset($periodo) ? $periodo->uf : '') ?>"
                       required
                       maxlength="2"
                       placeholder="Ex: SP"
                       style="text-transform: uppercase;">
                <?php if($validation->hasError('uf')): ?>
                  <div class="invalid-feedback">
                    <?= $validation->getError('uf') ?>
                  </div>
                <?php endif; ?>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="turma">Série/Turma <span class="text-danger">*</span></label>
                <input type="text" 
                       class="form-control <?= $validation->hasError('turma') ? 'is-invalid' : '' ?>" 
                       id="turma" 
                       name="turma" 
                       value="<?= old('turma', isset($periodo) ? $periodo->turma : '') ?>"
                       required
                       maxlength="100"
                       placeholder="Ex: 1º Ano">
                <?php if($validation->hasError('turma')): ?>
                  <div class="invalid-feedback">
                    <?= $validation->getError('turma') ?>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="resultado">Resultado <span class="text-danger">*</span></label>
                <select class="form-control <?= $validation->hasError('resultado') ? 'is-invalid' : '' ?>" 
                        id="resultado" 
                        name="resultado" 
                        required>
                  <option value="">Selecione</option>
                  <option value="aprovado" <?= old('resultado', isset($periodo) ? $periodo->resultado : '') == 'aprovado' ? 'selected' : '' ?>>Aprovado</option>
                  <option value="reprovado" <?= old('resultado', isset($periodo) ? $periodo->resultado : '') == 'reprovado' ? 'selected' : '' ?>>Reprovado</option>
                  <option value="cursando" <?= old('resultado', isset($periodo) ? $periodo->resultado : '') == 'cursando' ? 'selected' : '' ?>>Cursando</option>
                  <option value="transferido" <?= old('resultado', isset($periodo) ? $periodo->resultado : '') == 'transferido' ? 'selected' : '' ?>>Transferido</option>
                </select>
                <?php if($validation->hasError('resultado')): ?>
                  <div class="invalid-feedback">
                    <?= $validation->getError('resultado') ?>
                  </div>
                <?php endif; ?>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="carga_horaria_total">Carga Horária Total (horas)</label>
                <input type="number" 
                       class="form-control <?= $validation->hasError('carga_horaria_total') ? 'is-invalid' : '' ?>" 
                       id="carga_horaria_total" 
                       name="carga_horaria_total" 
                       value="<?= old('carga_horaria_total', isset($periodo) ? $periodo->carga_horaria_total : '') ?>"
                       min="0"
                       placeholder="Ex: 800">
                <?php if($validation->hasError('carga_horaria_total')): ?>
                  <div class="invalid-feedback">
                    <?= $validation->getError('carga_horaria_total') ?>
                  </div>
                <?php endif; ?>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="frequencia">Frequência (%)</label>
                <input type="number" 
                       class="form-control <?= $validation->hasError('frequencia') ? 'is-invalid' : '' ?>" 
                       id="frequencia" 
                       name="frequencia" 
                       value="<?= old('frequencia', isset($periodo) ? $periodo->frequencia : '') ?>"
                       min="0"
                       max="100"
                       step="0.01"
                       placeholder="Ex: 95.50">
                <?php if($validation->hasError('frequencia')): ?>
                  <div class="invalid-feedback">
                    <?= $validation->getError('frequencia') ?>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="observacao">Observações</label>
            <textarea class="form-control <?= $validation->hasError('observacao') ? 'is-invalid' : '' ?>" 
                      id="observacao" 
                      name="observacao" 
                      rows="4"><?= old('observacao', isset($periodo) ? $periodo->observacao : '') ?></textarea>
            <?php if($validation->hasError('observacao')): ?>
              <div class="invalid-feedback">
                <?= $validation->getError('observacao') ?>
              </div>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-success">
              <i class="fas fa-save"></i> Salvar
            </button>
            <a href="<?= base_url('Admin/HistoricoEscolar/view/' . $historico->id)?>" class="btn btn-secondary">
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

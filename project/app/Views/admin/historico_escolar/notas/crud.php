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
      <li class="breadcrumb-item"><a href="<?= base_url('Admin/HistoricoEscolar/Periodo/notas/' . $periodo->id)?>">Período <?= $periodo->ano_letivo ?></a></li>
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
        <a href="<?= base_url('Admin/HistoricoEscolar/Periodo/notas/' . $periodo->id)?>" class="btn btn-secondary mb-3">
          <i class="fas fa-arrow-left"></i> Voltar
        </a>

        <div class="alert alert-info mb-3">
          <strong>Aluno:</strong> <?= $historico->nome_aluno ?> | 
          <strong>Período:</strong> <?= $periodo->ano_letivo ?> - <?= $periodo->turma ?> | 
          <strong>Escola:</strong> <?= $periodo->estabelecimento ?>
        </div>

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
                <label for="id_historico_disciplina">Disciplina <span class="text-danger">*</span></label>
                <select class="form-control <?= $validation->hasError('id_historico_disciplina') ? 'is-invalid' : '' ?>" 
                        id="id_historico_disciplina" 
                        name="id_historico_disciplina" 
                        required
                        <?= $type == 'edit' ? 'disabled' : '' ?>>
                  <option value="">Selecione uma disciplina</option>
                  <?php if(!empty($disciplinas)): ?>
                    <?php foreach($disciplinas as $disciplina): ?>
                      <?php 
                        // Verificar se a disciplina já foi usada (apenas no modo create)
                        $disabled = ($type == 'create' && in_array($disciplina->id, $disciplinasUsadas)) ? 'disabled' : '';
                        $selected = (old('id_historico_disciplina', isset($nota) ? $nota->id_historico_disciplina : '') == $disciplina->id) ? 'selected' : '';
                      ?>
                      <option value="<?= $disciplina->id ?>" <?= $selected ?> <?= $disabled ?>>
                        <?= $disciplina->descricao ?> 
                        <?= $disciplina->carga_horaria ? '(' . $disciplina->carga_horaria . 'h)' : '' ?>
                      </option>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </select>
                <?php if($type == 'edit'): ?>
                  <input type="hidden" name="id_historico_disciplina" value="<?= $nota->id_historico_disciplina ?>">
                  <small class="form-text text-muted">A disciplina não pode ser alterada após o cadastro.</small>
                <?php endif; ?>
                <?php if($validation->hasError('id_historico_disciplina')): ?>
                  <div class="invalid-feedback">
                    <?= $validation->getError('id_historico_disciplina') ?>
                  </div>
                <?php endif; ?>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="nota">Nota/Conceito</label>
                <input type="text" 
                       class="form-control <?= $validation->hasError('nota') ? 'is-invalid' : '' ?>" 
                       id="nota" 
                       name="nota" 
                       value="<?= old('nota', isset($nota) ? $nota->nota : '') ?>"
                       maxlength="10"
                       placeholder="Ex: 8.5 ou A">
                <small class="form-text text-muted">Nota numérica ou conceito (A, B, C, etc.)</small>
                <?php if($validation->hasError('nota')): ?>
                  <div class="invalid-feedback">
                    <?= $validation->getError('nota') ?>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="resultado">Resultado <span class="text-danger">*</span></label>
                <select class="form-control <?= $validation->hasError('resultado') ? 'is-invalid' : '' ?>" 
                        id="resultado" 
                        name="resultado" 
                        required>
                  <option value="">Selecione</option>
                  <option value="aprovado" <?= old('resultado', isset($nota) ? $nota->resultado : '') == 'aprovado' ? 'selected' : '' ?>>Aprovado</option>
                  <option value="reprovado" <?= old('resultado', isset($nota) ? $nota->resultado : '') == 'reprovado' ? 'selected' : '' ?>>Reprovado</option>
                  <option value="dependencia" <?= old('resultado', isset($nota) ? $nota->resultado : '') == 'dependencia' ? 'selected' : '' ?>>Dependência</option>
                  <option value="dispensado" <?= old('resultado', isset($nota) ? $nota->resultado : '') == 'dispensado' ? 'selected' : '' ?>>Dispensado</option>
                </select>
                <?php if($validation->hasError('resultado')): ?>
                  <div class="invalid-feedback">
                    <?= $validation->getError('resultado') ?>
                  </div>
                <?php endif; ?>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="faltas">Número de Faltas</label>
                <input type="number" 
                       class="form-control <?= $validation->hasError('faltas') ? 'is-invalid' : '' ?>" 
                       id="faltas" 
                       name="faltas" 
                       value="<?= old('faltas', isset($nota) ? $nota->faltas : '0') ?>"
                       min="0"
                       placeholder="0">
                <?php if($validation->hasError('faltas')): ?>
                  <div class="invalid-feedback">
                    <?= $validation->getError('faltas') ?>
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
                      rows="3"><?= old('observacao', isset($nota) ? $nota->observacao : '') ?></textarea>
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
            <a href="<?= base_url('Admin/HistoricoEscolar/Periodo/notas/' . $periodo->id)?>" class="btn btn-secondary">
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

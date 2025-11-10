<?php

use App\Controllers\Admin\Parametros;
use App\Models\Admin\AlunosNotasModel;
use App\Models\Admin\AlunosFaltasModel;
use App\Models\Admin\ParametrosModel;

  $session = \Config\Services::session();
  
?>

<?= $this->extend('admin/template/masterpage') ?>
<?= $this->section('content') ?>


<div class="row mb-2">
  <div class="col-sm-6">
    <h1>Avaliação Individual</h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="<?= base_url('Admin/home')?>">Home</a></li>
      <li class="breadcrumb-item active">Avaliação Individual</li>
    </ol>
    
  </div>
</div>
<div class="row">
  <div class="col-12">
    <a href="<?= $url?>" class="btn btn-primary">
      <i class="fas fa-arrow-left fa-fw"></i>
      Voltar
    </a>
    <?php if(session()->userPerfil != 3):?>
    <a type="button" class="btn btn-success" data-toggle="modal" data-target="#incluirProfessorModal" data-placement="top" title="Professores">
        <i class="fa fa-chalkboard-teacher"></i> Vincular Professor(a)
    </a>
    <?php endif;?>

    <div class="modal fade" id="incluirProfessorModal" tabindex="-1" role="dialog" aria-labelledby="incluirProfessorModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="incluirProfessorModalLabel">Incluir Novo Registro</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action=""></form>
          <?= form_open(base_url('/Admin/Turmas/avaliacao-individual/salvar-professor')) ?>
          <div class="modal-body">
            <div class="form-group">
              <input type="text" class="form-control" name="id_turma" value="<?= $id_turma?>" hidden>
              <label>Professor(a)</label>
              <select class="form-control select2" name="id_professor">
                <option value="" disabled selected>--Selecione--</option>
              <?php foreach ($professores as $professoresItem): ?>
                <option value="<?= $professoresItem->id ?>"><?= $professoresItem->nome ?></option>
              <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label>Auxiliar</label>
              <select class="form-control select2" name="id_auxiliar">
                <option value="" disabled selected>--Selecione--</option>
              <?php foreach ($professores as $professoresItem): ?>
                <option value="<?= $professoresItem->id ?>"><?= $professoresItem->nome ?></option>
              <?php endforeach; ?>
              </select>
            </div>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
          <?= form_close()?>
        </div>
      </div>
    </div>
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

        <h5>
          <b>Professor(a):</b> <?= !empty($professorTurma) ? $professorTurma->nome : 'Não consta'; ?>
          
          <?php if (!empty($professorTurma)): ?>
            <?php if(session()->userPerfil != 3):?>
            <span class="badge badge-danger rounded-pill" style="cursor:pointer;" title="Desvincular Professor(a)"
            onclick="if(confirm('Deseja realmente desvinvular este Professor(a)?')){ window.location.href='<?= base_url('Admin/Turmas/avaliacao-individual/excluir-professor/' . $id_turma . '/' . $professorTurma->id) ?>'; }">
              &times;
            </span>
            <?php endif;?>
          <?php endif; ?>
        </h5>
        <h5 class="mb-3">
          <b>Auxiliar:</b> <?= !empty($auxiliarTurma) ? $auxiliarTurma->nome : 'Não consta'; ?>
        </h5>

        <table id="registros" class="table table-bordered table-hover mb-3">
          <thead>
          <tr>
            <th>Matricula</th>
            <th>Nome</th>
            <th></th>
          </tr>
          </thead>
          <tbody>
          <?= form_open(base_url('Admin/Turmas/lancar-notas-alunos/salvar')) ?>
          <?= form_hidden('id_turma', $id_turma) ?>
          <?php foreach($table as $tableItem):?>
            <tr>
              <td><?= $tableItem->matricula?></td>
              <td><?= $tableItem->nome?></td>
              <td class="text-right">
                <a href="<?= base_url('Admin/Turmas/avaliacao-individual-aluno/' . $id_turma . '/' . $tableItem->id_aluno.'/1') ?>" class="btn btn-info btn-sm">
                  1º Bimestre
                </a>
                <a href="<?= base_url('Admin/Turmas/avaliacao-individual-aluno/' . $id_turma . '/' . $tableItem->id_aluno.'/2') ?>" class="btn btn-info btn-sm">
                  2º Bimestre
                </a>
                <a href="<?= base_url('Admin/Turmas/avaliacao-individual-aluno/' . $id_turma . '/' . $tableItem->id_aluno.'/3') ?>" class="btn btn-info btn-sm">
                  3º Bimestre
                </a>
                <a href="<?= base_url('Admin/Turmas/avaliacao-individual-aluno/' . $id_turma . '/' . $tableItem->id_aluno.'/4') ?>" class="btn btn-info btn-sm">
                  4º Bimestre
                </a>
              </td>
            </tr>
          <?php endforeach;?> 
            
          <?= form_close() ?>
          </tbody>
        </table>   
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>



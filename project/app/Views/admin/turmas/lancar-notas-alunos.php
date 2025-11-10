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
            <th>Matricula</th>
            <th>Nome</th>
            <th class="text-center">1º Bim.</th>
            <th class="text-center">2º Bim.</th>
            <th class="text-center">3º Bim.</th>
            <th class="text-center">4º Bim.</th>
            <th class="text-center">Média</th>
          </tr>
          </thead>
          <tbody>
          <?= form_open(base_url('Admin/Turmas/lancar-notas-alunos/salvar')) ?>
          <?= form_hidden('id_turma', $id_turma) ?>
          <?= form_hidden('id_disciplina', $id_disciplina) ?>
          <?php foreach($table as $tableItem):?>
            <tr>
              <td><?= $tableItem->matricula?></td>
              <td><?= $tableItem->nome?></td>
                <?php $media = 0?>
                <?php for ($bim = 1; $bim <= 4; $bim++):?>

                  <?php
                    $alunoNotaModel = (new AlunosNotasModel())->getNotasByAluno($tableItem->id_aluno, $id_turma, $id_disciplina, $bim);
                    $notaAluno = $alunoNotaModel ? $alunoNotaModel->nota : "";
                    $media += $notaAluno ? $notaAluno/4 : 0;
                    $alunoFaltaModel = (new AlunosFaltasModel())->getFaltasByAluno($tableItem->id_aluno, $id_turma, $id_disciplina, $bim);
                    $faltaAluno = $alunoFaltaModel ? $alunoFaltaModel->falta : "";
                  ?>
                <td class="text-center">
                  <div style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                    <div style="display: flex; align-items: center; margin-bottom: 4px;">
                      <label class="mr-1 mb-0" style="font-weight:bold;">N</label>
                      <?= form_input([
                        'type'        => 'number',
                        'name'        => "notas[{$tableItem->id_aluno}][{$bim}]",
                        'value'       => $notaAluno,
                        'min'         => '0',
                        'step'        => '0.1',
                        'class'       => 'form-control form-control-sm',
                        'placeholder' => "Nota {$bim}"
                        
                      ]) 
                      ?>
                    </div>
                    <div style="display: flex; align-items: center;">
                      <label class="mr-1 mb-0" style="font-weight:bold;">F</label>
                      <?= form_input([
                        'type'        => 'number',
                        'name'        => "faltas[{$tableItem->id_aluno}][{$bim}]",
                        'value'       => $faltaAluno,
                        'min'         => '0',
                        'class'       => 'form-control form-control-sm',
                        'placeholder' => "Faltas {$bim}"
                      ]) 
                      ?>
                    </div>
                  </div>
                </td>
                <?php endfor; ?>
                <?php 
                  $parametrosModel = (new ParametrosModel())->getMediaEscolar();
                  $meddiaEscolar = $parametrosModel ? $parametrosModel->valor : 0;
                  $alertMedia = $media < $meddiaEscolar ? 'text-danger' : 'text-success';
                ?>
                <td class="text-center <?= $alertMedia?>"><?= $media?></td>
                
            </tr>
          <?php endforeach;?> 
            <tr>
              <td colspan="6" class="text-center">
                <?= form_submit('submit', 'Salvar Notas', ['class' => 'btn btn-primary']) ?>
              </td>
            </tr>
          <?= form_close() ?>
          </tbody>
        </table>   
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>



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
      <li class="breadcrumb-item"><a href="<?= base_url('Admin/home') ?>">Home</a></li>
      <li class="breadcrumb-item active">Avaliação Individual</li>
    </ol>

  </div>
</div>
<div class="row">
  <div class="col-12">
    <a href="<?= $url ?>" class="btn btn-primary">
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
        <?= form_open(base_url('/Admin/Turmas/avaliacao-individual-aluno-salvar'))?>
        <div class="row">
          <div class="col-12">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Professor(a)</label>
                  <input type="text" class="form-control" name="professor" disabled value="<?= !empty($professor) ? esc(strtoupper($professor->nome)) : 'Não consta' ?>">
                </div>
                <div class="form-group col-md-6">
                  <label>Auxiliar</label>
                  <input type="text" class="form-control" name="auxiliar" value="<?= !empty($auxiliar) ? esc(strtoupper($auxiliar->nome)) : 'Não consta' ?>" disabled>
                </div>
              </div>
              <div class="form-group">
                <label>Aluno(a)</label>
                <input type="text" class="form-control" name="id_aluno" hidden value="<?= esc(strtoupper($aluno->id)) ?>">
                <input type="text" class="form-control" name="aluno" disabled value="<?= esc(strtoupper($aluno->nome)) ?>">
              </div>
                <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Turma</label>
                  <input type="text" class="form-control" name="id_turma" hidden value="<?= esc($turma->id) ?>">
                  <input type="text" class="form-control" name="periodo" disabled value="<?= esc($turma->nome.' - '. strtoupper(getPeriodos($turma->periodo))) ?>">
                </div>
                <div class="form-group col-md-6">
                  <label>Bimestre</label>
                  <input type="text" class="form-control" name="bimestre" hidden value="<?= esc($bimestre) ?>">
                  <input type="text" class="form-control" disabled value="<?= esc($bimestre).'º BIMESTRE' ?>">
                </div>
                </div>
          </div>
        </div> 
        <div class="row">
          <div class="col-12">
            <?php
            $num = 1;
            $currentCategoria = null;
            foreach ($avaliacao as $item) {
              if ($item->categoria !== $currentCategoria) {
                if ($currentCategoria !== null) {
                  // Fecha a div da categoria anterior
                  echo '</div>';
                }
                // Nova categoria
                echo '<h5 class="bg-secondary p-3">' . getCategoriaAvaliacaoIndividual(esc($item->categoria)) . '</h5>';
                echo '<div class="row">';
                $currentCategoria = $item->categoria;
              }
            ?>
              <div class="col-4">
                <div class="form-group">
                  <label><?= '#'.$num.'-'.esc($item->descricao) ?></label>
                  <div>
                    <?php
                    $avaliacaoIndividualAlunoTurmaModel = new \App\Models\Admin\AvaliacaoIndividualAlunoTurmaModel();
                    $resposta = $avaliacaoIndividualAlunoTurmaModel->getResposta($aluno->id, $turma->id, $item->id, $bimestre);
                    ?>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="resposta[<?= $item->id?>]" value="s" <?= (!empty($resposta) && $resposta->resposta == 's') ? 'checked' : '' ?>>
                      <label class="form-check-label" for="sim">Sim</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="resposta[<?= $item->id?>]" value="p" <?= (!empty($resposta) && $resposta->resposta == 'p') ? 'checked' : '' ?>>
                      <label class="form-check-label" for="parcial">Parcial</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="resposta[<?= $item->id?>]" value="n" <?= (!empty($resposta) && $resposta->resposta == 'n') ? 'checked' : '' ?>>
                      <label class="form-check-label" for="nao">Não</label>
                    </div>
                  </div>
                </div>
              </div>
            <?php
            $num++;
            }
            ?>
            <?php
            if ($currentCategoria !== null) {
              echo '</div>';
            }
            ?>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
        <?= form_close() ?>      
      </div>
    </div>
  </div>  
</div>

<?= $this->endSection() ?>
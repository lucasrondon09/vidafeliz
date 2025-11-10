<?php 
  $session = \Config\Services::session();
  
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
      <li class="breadcrumb-item active">Alunos</li>
    </ol>
    
  </div>
</div>
<div class="row">
  <div class="col-12">
    <a href="<?= $url?>" class="btn btn-primary">
      <i class="fas fa-arrow-left fa-fw"></i>
      Voltar
    </a>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#incluirModal">
      <i class="fas fa-plus fa-fw"></i>
      Incluir
    </button>

    <!-- Modal -->
    <div class="modal fade" id="incluirModal" tabindex="-1" role="dialog" aria-labelledby="incluirModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="incluirModalLabel">Incluir Novo Registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <!-- Form content goes here -->
        <?= form_open(base_url('Admin/Turmas/alunos/incluir')) ?>
          <div class="form-group">
            <input type="text" class="form-control" id="id_turma" name="id_turma" value="<?= $id_turma?>" hidden>
          <label for="nome">Alunos</label>
            <p class="text-danger">* A lista abaixo exibe apenas os alunos que ainda não estão matriculados em nenhuma Turma no Ano Letivo selecionado.</p>
            <select class="form-control select2" id="input_select" name="id_aluno[]" multiple="multiple">
            <?php foreach ($alunos as $aluno): ?>
              <option value="<?= $aluno->id ?>"><?= $aluno->nome ?></option>
            <?php endforeach; ?>
            </select>
          </div>
          <!-- Add more fields as needed -->
        
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
        <?php form_close()?>
      </div>
      </div>
      
    </div>

    <script>
      function submitIncluirForm() {
      // Add form submission logic here
      const form = document.getElementById('incluirForm');
      console.log('Form data:', new FormData(form));
      // Close modal after submission
      $('#incluirModal').modal('hide');
      // Do this before you initialize any of your modals
      $.fn.modal.Constructor.prototype.enforceFocus = function() {};
      }
    </script>
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
            <th>Turma</th>
            <th>Ano Letivo</th>
            <th>Período</th>
            <th></th>
          </tr>
          </thead>
          <tbody>
          <?php foreach($table as $tableItem):?>
            <tr>
              <td><?= $tableItem->matricula?></td>
              <td><?= $tableItem->nome?></td>
              <td><?= isset($tableItem->nome_turma) ? $tableItem->nome_turma :  '--' ?></td>
              <td><?= isset($tableItem->ano_turma) ? $tableItem->ano_turma :  '--' ?></td>
              <td><?= isset($tableItem->periodo_turma) ? getPeriodos($tableItem->periodo_turma) :  '--' ?></td>
              <td class="text-center">
                <div class="btn-group mr-1">
                  <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Gerar Relatórios">
                    <i class="fas fa-file-alt fa-fw"></i>
                    Relatórios
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?= base_url('/Admin/Relatorios/declaracao-escolaridade/'.$id_turma.'/'.$tableItem->id) ?>" target="_blank">
                      Declaração de Escolaridade
                    </a>
                    <a class="dropdown-item" href="<?= base_url('Admin/Relatorios/ficha-individual/'.$id_turma.'/'.$tableItem->id) ?>" target="_blank">
                      Ficha Individual
                    </a>
                    <a class="dropdown-item" href="<?= base_url('Admin/Relatorios/historico_escolar/'.$tableItem->id) ?>" target="_blank">
                      Histórico Escolar
                    </a>
                  </div>
                </div>
                <a href="<?= base_url('/Admin/Turmas/alunos/info-complementares').'/'.$id_turma.'/'.$tableItem->id;?>" class="btn btn-sm btn-outline-warning" data-toggle="tooltip" data-placement="top" title="Informações Complementares">
                  <i class="fas fa-sticky-note fa-fw"></i> + Info
                </a>
                <a href="<?= base_url('/Admin/Turmas/alunos/transferir').'/'.$id_turma.'/'.$tableItem->id;?>" class="btn btn-sm btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Transferir">
                    <i class="fas fa-arrow-right fa-fw"></i> Transferir
                </a>
              </td>
            </tr>
          <?php endforeach;?>  
          </tbody>
        </table>   
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>



<?php 
  $session = \Config\Services::session();
  
?>

<?= $this->extend('admin/template/masterpage') ?>
<?= $this->section('content') ?>


<div class="row mb-2">
  <div class="col-sm-6">
    <h1>Pais</h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="<?= base_url('Admin/home')?>">Home</a></li>
      <li class="breadcrumb-item active">Pais</li>
    </ol>
    
  </div>
</div>
<div class="row">
  <div class="col-12">
    <a href="<?= base_url('Admin/Pais/cadastrar')?>" class="btn btn-success">
      <i class="fas fa-plus fa-fw"></i>
      Cadastrar
    </a>
  </div>
</div>

<div class="row mt-2">
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
            <th>Mãe</th>
            <th>Pai</th>
            <th></th>
          </tr>
          </thead>
          <tbody>
          <?php foreach($table as $tableItem):?>
            <?php 
              $mae_resp_pedagogico = $tableItem->mae_resp_pedagogico == 1 ? "Sim" : "Não";
              $mae_resp_financeiro = $tableItem->mae_resp_financeiro == 1 ? "Sim" : "Não";
              $pai_resp_pedagogico = $tableItem->pai_resp_pedagogico == 1 ? "Sim" : "Não";
              $pai_resp_financeiro = $tableItem->pai_resp_financeiro == 1 ? "Sim" : "Não";
            ?>
            <tr>
              <td><?= $tableItem->matricula?></td>
              <td><?= $tableItem->mae_nome .'<br>
                      <p class="font-weight-light">
                      <b>CPF:</b> '. mask_cpf($tableItem->mae_cpf).'</br>
                      <b>Telefone:</b> '.mask_telefone($tableItem->mae_telefone).'</br>
                      <b>Responsável Pedagógico:</b> '.$mae_resp_pedagogico.'</br>
                      <b>Responsável Financeiro:</b> '.$mae_resp_financeiro.'</br>
                      </p>
                      '?>
              </td>
              <td><?= $tableItem->pai_nome .'<br>
                      <p class="font-weight-light">
                      <b>CPF:</b> '. mask_cpf($tableItem->pai_cpf).'</br>
                      <b>Telefone:</b> '.$tableItem->pai_telefone.'</br>
                      <b>Responsável Pedagógico:</b> '.$pai_resp_pedagogico.'</br>
                      <b>Responsável Financeiro:</b> '.$pai_resp_financeiro.'</br>
                      </p>
                      '?>
              </td>
              <td class="text-center">
                <a href="<?= base_url('Admin/Alunos/'.$tableItem->id);?>" class="btn btn-sm btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Filhos">
                  <i class="fa fa-user-plus"></i>
                </a>

                <a href="<?= base_url('Admin/Pais/visualizar').'/'.$tableItem->id;?>" class="btn btn-sm btn-outline-info" data-toggle="tooltip" data-placement="top" title="Visualizar">
                  <i class="fa fa-eye"></i>
                </a>

                <a href="<?= base_url('Admin/Pais/editar').'/'.$tableItem->id;?>" class="btn btn-sm btn-outline-warning" data-toggle="tooltip" data-placement="top" title="Editar">
                  <i class="fas fa-pen fa-fw"></i>
                </a>
                
                <a href="<?= base_url('Admin/Pais/excluir').'/'.$tableItem->id;?>" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Excluir" onClick="return deletar()">
                  <i class="fas fa-trash fa-fw"></i>
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

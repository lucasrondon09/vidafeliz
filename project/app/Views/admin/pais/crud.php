<?php 
$session = \Config\Services::session();
$validate = \Config\Services::validation();
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
      <li class="breadcrumb-item"><a href="<?= base_url('Admin/Pais')?>">Usuários</a></li>
      <li class="breadcrumb-item active">Cadastrar</li>
    </ol>
  </div>
</div>
<div class="row mt-3">
  <!-- left column -->
  <div class="col-md-12">
    <!-- jquery validation -->
    <div class="card">
      <h3 class="card-title mt-3">
        <a href="<?= base_url('Admin/Pais')?>" class="text-decoration-none text-dark">
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
      <?= form_open($action)?>
      <?= $type == 'read' ? '<fieldset disabled>': '';?>
      <?= csrf_field() ?>
        <div class="card-body">
            <div class="alert alert-secondary mt-5" role="alert">
            DADOS DA MÃE
            </div>
            <div class="form-group">
            <label for="mae_nome">Nome</label>
            <input type="text" name="mae_nome" class="form-control" value="<?= isset($record) ? $record->mae_nome : set_value('mae_nome') ?>">
            </div>
            <div class="form-group row">
            <div class="col-md-4">
              <label for="mae_cpf">CPF</label>
              <input type="text" name="mae_cpf" class="form-control cpf_mask" id="mae_cpf" value="<?= isset($record) ? $record->mae_cpf : set_value('mae_cpf') ?>">
            </div>
            <div class="col-md-4">
              <label for="mae_rg">RG</label>
              <input type="text" name="mae_rg" class="form-control" id="mae_rg" value="<?= isset($record) ? $record->mae_rg : set_value('mae_rg') ?>">
            </div>
            <div class="col-md-4">
              <label for="mae_data_nascimento">Data de Nascimento</label>
              <input type="date" name="mae_nascimento" class="form-control" id="mae_nascimento" value="<?= isset($record) ? $record->mae_nascimento : set_value('mae_data_nascimento') ?>">
            </div>
            </div>
            <div class="form-group row">
            <div class="col-md-6">
              <label for="mae_telefone">Telefone</label>
              <input type="text" name="mae_telefone" class="form-control fone_mask" id="mae_telefone" value="<?= isset($record) ? $record->mae_telefone : set_value('mae_telefone') ?>">
            </div>
            <div class="col-md-6">
              <label for="mae_email">Email</label>
              <input type="email" name="mae_email" class="form-control" id="mae_email" value="<?= isset($record) ? $record->mae_email : set_value('mae_email') ?>">
            </div>
            </div>
            <div class="form-group row">
            <div class="col-md-6">
              <label for="mae_profissao">Profissão</label>
              <input type="text" name="mae_profissao" class="form-control" id="mae_profissao" value="<?= isset($record) ? $record->mae_profissao : set_value('mae_profissao') ?>">
            </div>
            <div class="col-md-6">
              <label for="mae_empresa">Empresa</label>
              <input type="text" name="mae_empresa" class="form-control" id="mae_empresa" value="<?= isset($record) ? $record->mae_empresa : set_value('mae_empresa') ?>">
            </div>
            </div>
            <div class="form-group row">
            <div class="col-md-6">
              <label for="mae_naturalidade">Naturalidade</label>
              <input type="text" name="mae_naturalidade" class="form-control" id="mae_naturalidade" value="<?= isset($record) ? $record->mae_naturalidade : set_value('mae_naturalidade') ?>">
            </div>
            <div class="col-md-6">
              <label for="mae_nacionalidade">Nacionalidade</label>
              <input type="text" name="mae_nacionalidade" class="form-control" id="mae_nacionalidade" value="<?= isset($record) ? $record->mae_nacionalidade : set_value('mae_nacionalidade') ?>">
            </div>
            </div>
            <div class="form-group row">
            <div class="col-md-6">
              <label for="mae_endereco">Endereço</label>
              <input type="text" name="mae_endereco" class="form-control" id="mae_endereco" value="<?= isset($record) ? $record->mae_endereco : set_value('mae_endereco') ?>">
            </div>
            <div class="col-md-2">
              <label for="mae_numero">Número</label>
              <input type="text" name="mae_numero" class="form-control" id="mae_numero" value="<?= isset($record) ? $record->mae_numero : set_value('mae_numero') ?>">
            </div>
            <div class="col-md-4">
              <label for="mae_complemento">Complemento</label>
              <input type="text" name="mae_complemento" class="form-control" id="mae_complemento" value="<?= isset($record) ? $record->mae_complemento : set_value('mae_complemento') ?>">
            </div>
            </div>
            <div class="form-group row">
            <div class="col-md-3">
              <label for="mae_bairro">Bairro</label>
              <input type="text" name="mae_bairro" class="form-control" id="mae_bairro" value="<?= isset($record) ? $record->mae_bairro : set_value('mae_bairro') ?>">
            </div>
            <div class="col-md-3">
              <label for="mae_cidade">Cidade</label>
              <input type="text" name="mae_cidade" class="form-control" id="mae_cidade" value="<?= isset($record) ? $record->mae_cidade : set_value('mae_cidade') ?>">
            </div>
            <div class="col-md-3">
              <label for="mae_estado">Estado</label>
              <input type="text" name="mae_estado" class="form-control" id="mae_estado" value="<?= isset($record) ? $record->mae_estado : set_value('mae_estado') ?>">
            </div>
            <div class="col-md-3">
              <label for="mae_cep">CEP</label>
              <input type="text" name="mae_cep" class="form-control cep_mask" id="mae_cep" value="<?= isset($record) ? $record->mae_cep : set_value('mae_cep') ?>">
            </div>
            </div>
            <div class="form-group row">
            <div class="col-md-4">
              <label for="mae_estado_civil">Estado Civil</label>
              <select name="mae_estado_civil" class="form-control" id="mae_estado_civil">
              <option value="" <?= isset($record) && $record->mae_estado_civil == '' ? 'selected' : '' ?>>--Selecione--</option>
              <option value="Solteiro(a)" <?= isset($record) && $record->mae_estado_civil == 'Solteiro(a)' ? 'selected' : '' ?>>Solteiro(a)</option>
              <option value="Casado(a)" <?= isset($record) && $record->mae_estado_civil == 'Casado(a)' ? 'selected' : '' ?>>Casado(a)</option>
              <option value="Divorciado(a)" <?= isset($record) && $record->mae_estado_civil == 'Divorciado(a)' ? 'selected' : '' ?>>Divorciado(a)</option>
              <option value="Viúvo(a)" <?= isset($record) && $record->mae_estado_civil == 'Viúvo(a)' ? 'selected' : '' ?>>Viúvo(a)</option>
              <option value="União Estável" <?= isset($record) && $record->mae_estado_civil == 'União Estável' ? 'selected' : '' ?>>União Estável</option>
              </select>
            </div>
            <div class="col-md-4">
              <label for="mae_responsavel_pedagogico">Responsável Pedagógico</label>
              <div class="form-check">
              <input class="form-check-input" type="radio" name="mae_resp_pedagogico" id="mae_responsavel_pedagogico_sim" value="1" <?= isset($record) && $record->mae_resp_pedagogico == '1' ? 'checked' : '' ?>>
              <label class="form-check-label" for="mae_responsavel_pedagogico_sim">Sim</label>
              </div>
              <div class="form-check">
              <input class="form-check-input" type="radio" name="mae_resp_pedagogico" id="mae_responsavel_pedagogico_nao" value="0" <?= isset($record) && $record->mae_resp_pedagogico == '0' ? 'checked' : '' ?>>
              <label class="form-check-label" for="mae_responsavel_pedagogico_nao">Não</label>
              </div>
            </div>
            <div class="col-md-4">
              <label for="responsavel_financeiro_mae">Responsável Financeiro</label>
              <div class="form-check">
              <input class="form-check-input" type="radio" name="mae_resp_financeiro" id="mae_responsavel_financeiro_sim" value="1" <?= isset($record) && $record->mae_resp_financeiro == '1' ? 'checked' : '' ?>>
              <label class="form-check-label" for="mae_responsavel_financeiro_sim">Sim</label>
              </div>
              <div class="form-check">
              <input class="form-check-input" type="radio" name="mae_resp_financeiro" id="mae_responsavel_financeiro_nao" value="0" <?= isset($record) && $record->mae_resp_financeiro == '0' ? 'checked' : '' ?>>
              <label class="form-check-label" for="mae_responsavel_financeiro_nao">Não</label>
              </div>
            </div>
            </div>
            <div class="alert alert-secondary mt-5" role="alert">
            DADOS DO PAI
            </div>
            <div class="form-group">
            <label for="pai_nome">Nome</label>
            <input type="text" name="pai_nome" class="form-control" value="<?= isset($record) ? $record->pai_nome : set_value('pai_nome') ?>">
            </div>
            <div class="form-group row">
            <div class="col-md-4">
            <label for="pai_cpf">CPF</label>
            <input type="text" name="pai_cpf" class="form-control cpf_mask" id="pai_cpf" value="<?= isset($record) ? $record->pai_cpf : set_value('pai_cpf') ?>">
            </div>
            <div class="col-md-4">
            <label for="pai_rg">RG</label>
            <input type="text" name="pai_rg" class="form-control" id="pai_rg" value="<?= isset($record) ? $record->pai_rg : set_value('pai_rg') ?>">
            </div>
            <div class="col-md-4">
            <label for="pai_data_nascimento">Data de Nascimento</label>
            <input type="date" name="pai_nascimento" class="form-control" id="pai_data_nascimento" value="<?= isset($record) ? $record->pai_nascimento : set_value('pai_data_nascimento') ?>">
            </div>
            </div>
            <div class="form-group row">
            <div class="col-md-6">
            <label for="pai_telefone">Telefone</label>
            <input type="text" name="pai_telefone" class="form-control fone_mask" id="pai_telefone" value="<?= isset($record) ? $record->pai_telefone : set_value('pai_telefone') ?>">
            </div>
            <div class="col-md-6">
            <label for="pai_email">Email</label>
            <input type="email" name="pai_email" class="form-control" id="pai_email" value="<?= isset($record) ? $record->pai_email : set_value('pai_email') ?>">
            </div>
            </div>
            <div class="form-group row">
            <div class="col-md-6">
            <label for="pai_profissao">Profissão</label>
            <input type="text" name="pai_profissao" class="form-control" id="pai_profissao" value="<?= isset($record) ? $record->pai_profissao : set_value('pai_profissao') ?>">
            </div>
            <div class="col-md-6">
            <label for="pai_empresa">Empresa</label>
            <input type="text" name="pai_empresa" class="form-control" id="pai_empresa" value="<?= isset($record) ? $record->pai_empresa : set_value('pai_empresa') ?>">
            </div>
            </div>
            <div class="form-group row">
            <div class="col-md-6">
            <label for="pai_naturalidade">Naturalidade</label>
            <input type="text" name="pai_naturalidade" class="form-control" id="pai_naturalidade" value="<?= isset($record) ? $record->pai_naturalidade : set_value('pai_naturalidade') ?>">
            </div>
            <div class="col-md-6">
            <label for="pai_nacionalidade">Nacionalidade</label>
            <input type="text" name="pai_nacionalidade" class="form-control" id="pai_nacionalidade" value="<?= isset($record) ? $record->pai_nacionalidade : set_value('pai_nacionalidade') ?>">
            </div>
            </div>
            <div class="form-group row">
            <div class="col-md-6">
            <label for="pai_endereco">Endereço</label>
            <input type="text" name="pai_endereco" class="form-control" id="pai_endereco" value="<?= isset($record) ? $record->pai_endereco : set_value('pai_endereco') ?>">
            </div>
            <div class="col-md-2">
            <label for="pai_numero">Número</label>
            <input type="text" name="pai_numero" class="form-control" id="pai_numero" value="<?= isset($record) ? $record->pai_numero : set_value('pai_numero') ?>">
            </div>
            <div class="col-md-4">
            <label for="pai_complemento">Complemento</label>
            <input type="text" name="pai_complemento" class="form-control" id="pai_complemento" value="<?= isset($record) ? $record->pai_complemento : set_value('pai_complemento') ?>">
            </div>
            </div>
            <div class="form-group row">
            <div class="col-md-3">
            <label for="pai_bairro">Bairro</label>
            <input type="text" name="pai_bairro" class="form-control" id="pai_bairro" value="<?= isset($record) ? $record->pai_bairro : set_value('pai_bairro') ?>">
            </div>
            <div class="col-md-3">
            <label for="pai_cidade">Cidade</label>
            <input type="text" name="pai_cidade" class="form-control" id="pai_cidade" value="<?= isset($record) ? $record->pai_cidade : set_value('pai_cidade') ?>">
            </div>
            <div class="col-md-3">
            <label for="pai_estado">Estado</label>
            <input type="text" name="pai_estado" class="form-control" id="pai_estado" value="<?= isset($record) ? $record->pai_estado : set_value('pai_estado') ?>">
            </div>
            <div class="col-md-3">
            <label for="pai_cep">CEP</label>
            <input type="text" name="pai_cep" class="form-control cep_mask" id="pai_cep" value="<?= isset($record) ? $record->pai_cep : set_value('pai_cep') ?>">
            </div>
            </div>
            <div class="form-group row">
            <div class="col-md-4">
            <label for="pai_estado_civil">Estado Civil</label>
            <select name="pai_estado_civil" class="form-control" id="pai_estado_civil">
            <option value="" <?= isset($record) && $record->pai_estado_civil == '' ? 'selected' : '' ?>>--Selecione--</option>
            <option value="Solteiro(a)" <?= isset($record) && $record->pai_estado_civil == 'Solteiro(a)' ? 'selected' : '' ?>>Solteiro(a)</option>
            <option value="Casado(a)" <?= isset($record) && $record->pai_estado_civil == 'Casado(a)' ? 'selected' : '' ?>>Casado(a)</option>
            <option value="Divorciado(a)" <?= isset($record) && $record->pai_estado_civil == 'Divorciado(a)' ? 'selected' : '' ?>>Divorciado(a)</option>
            <option value="Viúvo(a)" <?= isset($record) && $record->pai_estado_civil == 'Viúvo(a)' ? 'selected' : '' ?>>Viúvo(a)</option>
            <option value="União Estável" <?= isset($record) && $record->pai_estado_civil == 'União Estável' ? 'selected' : '' ?>>União Estável</option>
            </select>
            </div>
            <div class="col-md-4">
            <label for="pai_responsavel_pedagogico">Responsável Pedagógico</label>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="pai_resp_pedagogico" id="pai_responsavel_pedagogico_sim" value="1" <?= isset($record) && $record->pai_resp_pedagogico == '1' ? 'checked' : '' ?>>
            <label class="form-check-label" for="pai_responsavel_pedagogico_sim">Sim</label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="pai_resp_pedagogico" id="pai_responsavel_pedagogico_nao" value="0" <?= isset($record) && $record->pai_resp_pedagogico == '0' ? 'checked' : '' ?>>
            <label class="form-check-label" for="pai_responsavel_pedagogico_nao">Não</label>
            </div>
            </div>
            <div class="col-md-4">
            <label for="pai_responsavel_financeiro">Responsável Financeiro</label>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="pai_resp_financeiro" id="pai_responsavel_financeiro_sim" value="1" <?= isset($record) && $record->pai_resp_financeiro == '1' ? 'checked' : '' ?>>
            <label class="form-check-label" for="pai_responsavel_financeiro_sim">Sim</label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="pai_resp_financeiro" id="pai_responsavel_financeiro_nao" value="0" <?= isset($record) && $record->pai_resp_financeiro == '0' ? 'checked' : '' ?>>
            <label class="form-check-label" for="pai_responsavel_financeiro_nao">Não</label>
            </div>
            </div>
            </div>
            <div class="alert alert-secondary mt-5" role="alert" id="responsavel_financeiro">
            DADOS DE OUTRO RESPONSÁVEL FINANCEIRO
            </div>
            <div class="form-group">
            <label for="nome_responsavel_financeiro">Nome</label>
            <input type="text" name="resp_finan_nome" class="form-control" value="<?= isset($record) ? $record->resp_finan_nome : set_value('resp_finan_nome') ?>">
            </div>
            <div class="form-group row">
            <div class="col-md-4">
            <label for="cpf_responsavel_financeiro">CPF</label>
            <input type="text" name="resp_finan_cpf" class="form-control cpf_mask" id="cpf_responsavel_financeiro" value="<?= isset($record) ? $record->resp_finan_cpf : set_value('resp_finan_cpf') ?>">
            </div>
            <div class="col-md-4">
            <label for="rg_responsavel_financeiro">RG</label>
            <input type="text" name="resp_finan_rg" class="form-control" id="rg_responsavel_financeiro" value="<?= isset($record) ? $record->resp_finan_rg : set_value('resp_finan_rg') ?>">
            </div>
            <div class="col-md-4">
            <label for="data_nascimento_responsavel_financeiro">Data de Nascimento</label>
            <input type="date" name="resp_finan_nascimento" class="form-control" id="data_nascimento_responsavel_financeiro" value="<?= isset($record) ? $record->resp_finan_nascimento : set_value('resp_finan_data_nascimento') ?>">
            </div>
            </div>
            <div class="form-group row">
            <div class="col-md-6">
            <label for="telefone_responsavel_financeiro">Telefone</label>
            <input type="text" name="resp_finan_telefone" class="form-control fone_mask" id="telefone_responsavel_financeiro" value="<?= isset($record) ? $record->resp_finan_telefone : set_value('resp_finan_telefone') ?>">
            </div>
            <div class="col-md-6">
            <label for="email_responsavel_financeiro">Email</label>
            <input type="email" name="resp_finan_email" class="form-control" id="email_responsavel_financeiro" value="<?= isset($record) ? $record->resp_finan_email : set_value('resp_finan_email') ?>">
            </div>
            </div>
            <div class="form-group row">
            <div class="col-md-6">
            <label for="profissao_responsavel_financeiro">Profissão</label>
            <input type="text" name="resp_finan_profissao" class="form-control" id="profissao_responsavel_financeiro" value="<?= isset($record) ? $record->resp_finan_profissao : set_value('resp_finan_profissao') ?>">
            </div>
            <div class="col-md-6">
            <label for="empresa_responsavel_financeiro">Empresa</label>
            <input type="text" name="resp_finan_empresa" class="form-control" id="empresa_responsavel_financeiro" value="<?= isset($record) ? $record->resp_finan_empresa : set_value('resp_finan_empresa') ?>">
            </div>
            </div>
            <div class="form-group row">
            <div class="col-md-6">
            <label for="naturalidade_responsavel_financeiro">Naturalidade</label>
            <input type="text" name="resp_finan_naturalidade" class="form-control" id="naturalidade_responsavel_financeiro" value="<?= isset($record) ? $record->resp_finan_naturalidade : set_value('resp_finan_naturalidade') ?>">
            </div>
            <div class="col-md-6">
            <label for="nacionalidade_responsavel_financeiro">Nacionalidade</label>
            <input type="text" name="resp_finan_nacionalidade" class="form-control" id="nacionalidade_responsavel_financeiro" value="<?= isset($record) ? $record->resp_finan_nacionalidade : set_value('resp_finan_nacionalidade') ?>">
            </div>
            </div>
            <div class="form-group row">
            <div class="col-md-6">
            <label for="endereco_responsavel_financeiro">Endereço</label>
            <input type="text" name="resp_finan_endereco" class="form-control" id="endereco_responsavel_financeiro" value="<?= isset($record) ? $record->resp_finan_endereco : set_value('resp_finan_endereco') ?>">
            </div>
            <div class="col-md-2">
            <label for="numero_responsavel_financeiro">Número</label>
            <input type="text" name="resp_finan_numero" class="form-control" id="numero_responsavel_financeiro" value="<?= isset($record) ? $record->resp_finan_numero : set_value('resp_finan_numero') ?>">
            </div>
            <div class="col-md-4">
            <label for="complemento_responsavel_financeiro">Complemento</label>
            <input type="text" name="resp_finan_complemento" class="form-control" id="complemento_responsavel_financeiro" value="<?= isset($record) ? $record->resp_finan_complemento : set_value('resp_finan_complemento') ?>">
            </div>
            </div>
            <div class="form-group row">
            <div class="col-md-3">
            <label for="bairro_responsavel_financeiro">Bairro</label>
            <input type="text" name="resp_finan_bairro" class="form-control" id="bairro_responsavel_financeiro" value="<?= isset($record) ? $record->resp_finan_bairro : set_value('resp_finan_bairro') ?>">
            </div>
            <div class="col-md-3">
            <label for="cidade_responsavel_financeiro">Cidade</label>
            <input type="text" name="resp_finan_cidade" class="form-control" id="cidade_responsavel_financeiro" value="<?= isset($record) ? $record->resp_finan_cidade : set_value('resp_finan_cidade') ?>">
            </div>
            <div class="col-md-3">
            <label for="estado_responsavel_financeiro">Estado</label>
            <input type="text" name="resp_finan_estado" class="form-control" id="estado_responsavel_financeiro" value="<?= isset($record) ? $record->resp_finan_estado : set_value('resp_finan_estado') ?>">
            </div>
            <div class="col-md-3">
            <label for="cep_responsavel_financeiro">CEP</label>
            <input type="text" name="resp_finan_cep" class="form-control cep_mask" id="cep_responsavel_financeiro" value="<?= isset($record) ? $record->resp_finan_cep : set_value('resp_finan_cep') ?>">
            </div>
            </div>
            <div class="form-group row">
            <div class="col-md-4">
            <label for="estado_civil_responsavel_financeiro">Estado Civil</label>
            <select name="resp_finan_estado_civil" class="form-control" id="estado_civil_responsavel_financeiro">
            <option value="" <?= isset($record) && $record->resp_finan_estado_civil == '' ? 'selected' : '' ?>>--Selecione--</option>
            <option value="Solteiro(a)" <?= isset($record) && $record->resp_finan_estado_civil == 'Solteiro(a)' ? 'selected' : '' ?>>Solteiro(a)</option>
            <option value="Casado(a)" <?= isset($record) && $record->resp_finan_estado_civil == 'Casado(a)' ? 'selected' : '' ?>>Casado(a)</option>
            <option value="Divorciado(a)" <?= isset($record) && $record->resp_finan_estado_civil == 'Divorciado(a)' ? 'selected' : '' ?>>Divorciado(a)</option>
            <option value="Viúvo(a)" <?= isset($record) && $record->resp_finan_estado_civil == 'Viúvo(a)' ? 'selected' : '' ?>>Viúvo(a)</option>
            <option value="União Estável" <?= isset($record) && $record->resp_finan_estado_civil == 'União Estável' ? 'selected' : '' ?>>União Estável</option>
            </select>
            </div>
            <div class="col-md-4">
            <label for="parentesco_responsavel_financeiro">Parentesco</label>
            <select name="resp_finan_parentesco" class="form-control" id="grau_parentesco_responsavel_financeiro">
            <option value="" <?= isset($record) && $record->resp_finan_parentesco == '' ? 'selected' : '' ?>>--Selecione--</option>
            <option value="Avô(a)" <?= isset($record) && $record->resp_finan_parentesco == 'Avô(a)' ? 'selected' : '' ?>>Avô/Avó</option>
            <option value="Tio(a)" <?= isset($record) && $record->resp_finan_parentesco == 'Tio(a)' ? 'selected' : '' ?>>Tio/Tia</option>
            <option value="Primo(a)" <?= isset($record) && $record->resp_finan_parentesco == 'Primo(a)' ? 'selected' : '' ?>>Primo/Prima</option>
            <option value="Outro" <?= isset($record) && $record->resp_finan_parentesco == 'Outro' ? 'selected' : '' ?>>Outro</option>
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
          <?php endif;?>
        </div>
        <?= $type = 'read' ? '</fieldset>': '';?>
        <?= form_close() ?>
    </div>
    </div>
</div>

  <?= $this->endSection() ?>


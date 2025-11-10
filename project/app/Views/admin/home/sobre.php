<?= $this->extend('admin/template/masterpage') ?>
<?= $this->section('content') ?>


    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Sobre</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?= base_url('/');?>">Home</a></li>
          <li class="breadcrumb-item active">Sobre</li>
        </ol>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card text-center border-0 shadow">
          <div class="card-body">
            <img src="<?= base_url(constant('CMSLOGO'));?>" class="img-circle elevation-2 col-2" alt="<?= constant('CMSNOME')?>">
            <h5 class="mt-2"><?= constant('CMSNOME')?></h5>
            <p><strong><?= constant('CMSDESCRICAO')?></strong></p>
            <hr>
            <ul class="list-unstyled">
              <li>Versão: <?= constant('CMSVERSAO')?></li>
              <li>PHP: <?= constant('CMSVERSAOPHP')?></li>
              <li>MySQL: <?= constant('CMSVERSAOMYSQL')?></li>
              <li>Hospedagem: <?= constant('CMSHOSPEDAGEM')?></li>
              <li>Sistema Operacional: <?= constant('CMSSERVIDOR')?></li>
              <br>
              <li>Desenvolvido em: <?= constant('CMSDESENVOLVIDOEM')?></li>
              <li>Última Atualização: <?= constant('CMSATUALIZADOEM')?></li>
              <br>
              <li>Desenvolvido por: <a href="https://lucasrondon.com.br/" target="_blank"><?= constant('CMSDESENVOLVEDOR')?></a></li>
              <li><strong><?= constant('CMSNOME')?> &copy; <?= constant('CMSANODESENVOLVIMENTO')?>-<?= date('Y')?> .</strong>Todos os direitos reservados.</li>
              <!--<li><a href="<?= base_url('Termos de Uso - Start Commerce.pdf')?>" class="btn btn-sm btn-primary" target="_blank">Termos de Uso</a></li>-->
              <hr>
              <li>Desenvolvido a partir do projeto AdminLTE</li>
              <li>Arquitetura front-end de código aberto lançado sob a <strong>Licença MIT</strong></li>
              <li>Direitos Autorais &copy; <a href="https://adminlte.io/" target="_blank">AdminLTE.io</a></li>
              <hr>
              <li>Framework Codeigniter 4.3</li>
              <li>© 2024 CodeIgniter Foundation. CodeIgniter é um projeto de código aberto lançado sob a <strong>licença de código aberto do MIT.</strong></li>
              <li>Direitos Autorais &copy; <a href="https://www.codeigniter.com/" target="_blank">codeigniter.com</a></li>
            </ul>
          </div>  
        </div>
        <!-- /.invoice -->
      </div><!-- /.col -->
    </div><!-- /.row -->

  <?= $this->endSection() ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= constant('CMSNOME');?></title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback'">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/admin/plugins/fontawesome-free/css/all.min.css');?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url('assets/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')?>">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= base_url('assets/admin/plugins/jqvmap/jqvmap.min.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/admin/dist/css/adminlte.min.css')?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url('assets/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url('assets/admin/plugins/daterangepicker/daterangepicker.css')?>">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url('assets/admin/plugins/summernote/summernote-bs4.min.css')?>">
  <!-- datatables -->
  <link rel="stylesheet" href="<?= base_url('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')?>">
  <!-- dropzone -->
  <link rel="stylesheet" href="<?= base_url('assets/admin/dist/css/dropzone.css')?>" />
  <!-- cropper -->
  <link rel="stylesheet" href="<?= base_url('assets/admin/dist/css/cropper.css')?>"/>

  <!-- Select2 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <!-- Select2 Bootstrap 4 Theme -->
  <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css" rel="stylesheet" />



  <script src="<?= base_url('assets/admin/plugins/jquery/jquery.min.js');?>"></script>
  <script src="<?= base_url('assets/admin/dist/js/cropper.js')?>"></script>
	<script src="<?= base_url('assets/admin/dist/js/dropzone.js')?>"></script>
	<script src="<?= base_url('assets/admin/plugins/datatables/jquery.dataTables.min.js')?>"></script>
	<script src="<?= base_url('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')?>"></script>
	<script src="<?= base_url('assets/admin/dist/js/select2.min.js')?>"></script>


  <style>
    a, p, li{
      font-size: 0.9rem;
    }

    [class*=sidebar-dark-] {
    /*background-color: #091e42 !important;*/
    background-color: #143D5B !important;
    }

    .bg-dark, .btn-primary{
      background-color: #245A82 !important;
    }

    .btn-primary{
      border: none !important;
    }
  </style>

  

</head>

<script>
  $.fn.modal.Constructor.prototype.enforceFocus = function() {};
</script>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <!--
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= base_url(constant('CMSLOGO'));?>" alt="Admin Site" height="60" width="60">
  </div>
-->
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?= base_url('Admin/home')?>" class="nav-link">Home</a>
      </li>
      <!--
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Suporte</a>
      </li>-->
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?= base_url('Admin/sobre')?>" class="nav-link">Sobre</a>
      </li>
      <li class="border-left nav-item d-none d-sm-inline-block">
        <?php

            use App\Models\Admin\ParametrosModel;

            $anoLetivo = (new ParametrosModel())->getAnoLetivo()->valor?>
        <a href="<?= base_url('Admin/Ano-Letivo')?>" class="nav-link">Ano Letivo: <?= $anoLetivo?></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!--
      <li class="nav-item">
        <a class="nav-link" href="#" role="button" data-toggle="tooltip" data-placement="top" title="Acessar o site">
          <i class="fas fa-external-link-alt"></i>
        </a>
      </li>
      -->
      <li class="nav-item">
        <a class="nav-link px-2" href="<?= base_url('Admin/home');?>" role="button" data-toggle="tooltip" data-placement="top" title="Página inicial">
        <i class="fas fa-home"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link px-2" href="<?= base_url();?>" role="button" data-toggle="tooltip" data-placement="top" title="Acessar site">
        <i class="fas fa-external-link-square-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link px-2" href="<?= current_url();?>" role="button" data-toggle="tooltip" data-placement="top" title="Atualizar">
        <i class="fas fa-redo-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link px-2" data-widget="fullscreen" href="#" role="button" data-toggle="tooltip" data-placement="top" title="Expandir tela">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link px-2" href="<?= base_url('Admin/Autenticacao/logout')?>" role="button" data-toggle="tooltip" data-placement="top" title="Sair do sistema">
        <i class="fas fa-sign-out-alt"></i>
        </a>
      </li>
      <li class="border-left nav-item ml-2">
        <a class="nav-link" href="" role="button">
        <i class="fas fa-user-circle pr-2"></i><?= session()->userName;?>
        </a>
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="<?= base_url(constant('CMSLOGO'));?>" alt="Sistema de Gestão de Secretária Escolar" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><?= constant('CMSNOME')?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <!--
      <div class="mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url('assets/admin/dist/img/logoempresa.png');?>" class="w-100" alt="Logo">
        </div>
      </div>
      -->

      <!-- SidebarSearch Form 
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Procurar" aria-label="Procurar">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>-->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-item">
            <a href="<?= base_url('Admin/home')?>" class="nav-link">
            <i class="fa fa-home mr-2" aria-hidden="true"></i>
              <p>
              Home
              </p>
            </a>
          </li>
          
          <?php if(session()->userPerfil != 3):?>
          <li class="nav-item">
            <a href="<?= base_url('Admin/Usuarios')?>" class="nav-link">
            <i class="fa fa-user mr-2" aria-hidden="true"></i>
              <p>
                Usuários
              </p>
            </a>
          </li>
          <?php endif;?>
          <?php if(session()->userPerfil != 3):?>
          <li class="nav-item">
            <a href="<?= base_url('Admin/Pais')?>" class="nav-link">
            <i class="fas fa-user-friends mr-2" aria-hidden="true"></i>
              <p>
                Pais
              </p>
            </a>
          </li>
          <?php endif;?>
          <?php if(session()->userPerfil != 3):?>
          <li class="nav-item">
            <a href="<?= base_url('Admin/Alunos')?>" class="nav-link">
            <i class="fas fa-user-graduate mr-2" aria-hidden="true"></i>
              <p>
                Alunos
              </p>
            </a>
          </li>
          <?php endif;?>
          <li class="nav-item">
            <a href="<?= base_url('Admin/Turmas')?>" class="nav-link">
            <i class="fas fa-chalkboard-teacher mr-2" aria-hidden="true"></i>
              <p>
              Turmas
              </p>
            </a>
          </li>
          <?php if(session()->userPerfil != 3):?>
          <li class="nav-item">
            <a href="<?= base_url('Admin/Disciplinas')?>" class="nav-link">
            <i class="fas fa-book-open mr-2" aria-hidden="true"></i>
              <p>
              Disciplinas
              </p>
            </a>
          </li>
          <?php endif;?>
          <?php if(session()->userPerfil != 3):?>
          <li class="nav-item">
            <a href="<?= base_url('Admin/Relatorios')?>" class="nav-link">
            <i class="fas fa-file-alt mr-2" aria-hidden="true"></i>
              <p>
              Relatórios
              </p>
            </a>
          </li>
          <?php endif;?>
          <?php if(session()->userPerfil != 3):?>
          <li class="nav-item">
            <a href="<?= base_url('Admin/Parametros')?>" class="nav-link">
            <i class="fas fa-cogs mr-2" aria-hidden="true"></i>
              <p>
              Parâmetros
              </p>
            </a>
          </li>
          <?php endif;?>
          <!--
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="far fa-newspaper mr-2"></i>
              <p>
                Produtos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('Admin/Produtos')?>" class="nav-link">
                  <i class="fas fa-angle-right mr-2"></i>
                  <p>Produtos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('Admin/Produtos-Categorias')?>" class="nav-link">
                  <i class="fas fa-angle-right mr-2"></i>
                  <p>Categorias</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="far fa-newspaper mr-2"></i>
              <p>
                Notícias
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('Admin/Noticias')?>" class="nav-link">
                  <i class="fas fa-angle-right mr-2"></i>
                  <p>Notícias</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('Admin/Categorias')?>" class="nav-link">
                  <i class="fas fa-angle-right mr-2"></i>
                  <p>Categorias</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="fas fa-images mr-2"></i>
              <p>
                Galeria
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('Admin/Galerias')?>" class="nav-link">
                  <i class="fas fa-angle-right mr-2"></i>
                  <p>Galeria</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('Admin/Categorias-galeria')?>" class="nav-link">
                  <i class="fas fa-angle-right mr-2"></i>
                  <p>Categorias</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('Admin/Servicos')?>" class="nav-link">
            <i class="fas fa-briefcase mr-2"></i>
              <p>
                Serviços
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('Admin/Banners')?>" class="nav-link">
            <i class="fas fa-image mr-2"></i>
              <p>
                Banners
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-filter mr-2"></i>
              <p>
                Leads
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-tools mr-2"></i>
              <p>
                Configurações
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-angle-right mr-2"></i>
                  <p>E-mail</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-angle-right mr-2"></i>
                  <p>Google Analytics</p>
                </a>
              </li>
            </ul>
          </li>-->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content-header">
        <div class="container-fluid">
            <?= $this->renderSection('content'); ?>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<footer class="main-footer">
    <strong><?= constant('CMSNOME').'-'.constant('CMSDESCRICAO')?> &copy; <?= constant('CMSANODESENVOLVIMENTO')?>-<?= date('Y')?>.</strong>
    Todos os direitos reservados.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> <?= constant('CMSVERSAO')?>
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('assets/admin/plugins/jquery-ui/jquery-ui.min.js');?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
<!-- ChartJS -->
<script src="<?= base_url('assets/admin/plugins/chart.js/Chart.min.js');?>"></script>
<!-- Sparkline -->
<script src="<?= base_url('assets/admin/plugins/sparklines/sparkline.js');?>"></script>
<!-- JQVMap -->
<script src="<?= base_url('assets/admin/plugins/jqvmap/jquery.vmap.min.js');?>"></script>
<script src="<?= base_url('assets/admin/plugins/jqvmap/maps/jquery.vmap.usa.js');?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url('assets/admin/plugins/jquery-knob/jquery.knob.min.js');?>"></script>
<!-- daterangepicker -->
<script src="<?= base_url('assets/admin/plugins/moment/moment.min.js');?>"></script>
<script src="<?= base_url('assets/admin/plugins/daterangepicker/daterangepicker.js');?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('assets/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js');?>"></script>
<!-- Summernote -->
<script src="<?= base_url('assets/admin/plugins/summernote/summernote-bs4.min.js');?>"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('assets/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js');?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/admin/dist/js/adminlte.js');?>"></script>
<!-- Bootstrap Switch -->
<script src="<?= base_url('assets/admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js')?>"></script>
<!-- InputMask -->
<script src="<?= base_url('assets/admin/plugins/inputmask/jquery.inputmask.min.js');?>"></script>
<script>
  $(document).ready(function(){

    //Initialize InputMask
    $('[data-mask]').inputmask();

    $('.fone_mask').inputmask('(99) 99999-9999');

    $('.cpf_mask').inputmask('999.999.999-99');

    $('.cep_mask').inputmask('99999-999');

    $('#registros').DataTable({
      "language": {"url": "<?= base_url('assets/admin/plugins/datatables/pt-BR.json')?>"},
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true
    });


    //Initialize Select2 Elements
    $('.select2').select2({
      theme: 'bootstrap4'
    });
    
  });

</script>

<script>
            $(document).ready(function() {
              
            });
          </script>



<script src="<?= base_url('assets/admin/dist/js/footer.js');?>"></script>


</body>
</html>

<script>
  function deletar(){

    return confirm('Tem certeza que deseja excluir o registro?');

  }
</script>

<script>

  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })

</script>

<script>
$('#summernote').summernote({
  height: 500,                 
  minHeight: null,             
  maxHeight: null,             
});

//Date picker
$('#reservationdate').datetimepicker({
    format: 'L'
});

//bootstrap-switch
$("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })
</script>

<script>

$(document).ready(function(){


  $("#submit").click(function(){
    
    $(this).text('Carregando...');
    

    });


  var $modal = $('#modal');
  var image = document.getElementById('sample_image');
  var cropper;

  //crop
  $('#upload_image').change(function(event){
      var files = event.target.files;
      var done = function (url) {
          image.src = url;
          $modal.modal('show');
      };

      if (files && files.length > 0)
      {
        reader = new FileReader();
        reader.onload = function (event) {
            done(reader.result);
        };
        reader.readAsDataURL(files[0]);
          
      }
  });

  $modal.on('shown.bs.modal', function() {
      cropper = new Cropper(image, {
        aspectRatio: 4/3,
        viewMode: 1,
        preview: '.preview'
      });
  }).on('hidden.bs.modal', function() {
      cropper.destroy();
      cropper = null;
  });

  $("#crop").click(function(){

      canvas = cropper.getCroppedCanvas({
          width: 600,
          height: 400,
      });

      canvas.toBlob(function(blob) {
          var reader = new FileReader();
          reader.readAsDataURL(blob); 
          reader.onloadend = function() {
              var base64data = reader.result;  
            
              $.ajax({
                url: "/UploadImage/upload",
                  method: "POST",                	
                  data: {image: base64data},
                  success: function(data){
                      console.log(data);
                      $modal.modal('hide');
                      $('#capa').val(data);
                      $('#uploaded_image').attr('src', data);
                  }
                });
          }
      });
    });


});







</script>


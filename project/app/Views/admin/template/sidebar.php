  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="<?= base_url(constant('CMSLOGO'));?>" alt="Secretaria Digital" class="brand-image img-circle elevation-3" style="opacity: .8">
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
            <a href="<?= base_url('Admin/Usuarios')?>" class="nav-link">
            <i class="fa fa-users mr-2" aria-hidden="true"></i>
              <p>
                Usuários
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('Admin/Pais')?>" class="nav-link">
            <i class="fa fa-users mr-2" aria-hidden="true"></i>
              <p>
                Pais
              </p>
            </a>
          </li>
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
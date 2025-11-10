<?= $this->extend('admin/template/masterpage') ?>
<?= $this->section('content') ?>


    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Home</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
        </ol>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="callout callout-info">
          <h5>Bem vindo, <?= session()->userName;?>! <small class="float-right">Data: <?= date('d/m/Y')?></small></h5>
          <p></p> 
          <a href="<?= $empresa->site;?>" class="btn btn-info btn-sm text-decoration-none text-white" target="_blank">Acessar site</a>
        </div>

        <div class="invoice p-3">
          <div class="row">
            <div class="col-md-12"><h6 class="font-weight-bold text-secondary">Acesso Rápido <i class="fas fa-arrow-circle-right"></i></h6></div>
          </div>
          <div class="row">
            <?php if(session()->userPerfil != 3):?>
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-dark">
                <div class="inner">
                  <h3>Usuários</h3>

                  <p>Visualizar registros</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
                <a href="<?= base_url('/Admin/Usuarios')?>" class="small-box-footer">Acessar <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-dark">
                <div class="inner">
                  <h3>Pais</h3>

                  <p>Visualizar registros</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-friends"></i>
                </div>
                <a href="<?= base_url('/Admin/Pais')?>" class="small-box-footer">Acessar <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-dark">
                <div class="inner">
                  <h3>Alunos</h3>

                  <p>Visualizar registros</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <a href="<?= base_url('/Admin/Alunos')?>" class="small-box-footer">Acessar <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <?php endif;?>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-dark">
                <div class="inner">
                  <h3>Turmas</h3>

                  <p>Visualizar registros</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <a href="<?= base_url('/Admin/Turmas')?>" class="small-box-footer">Acessar <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
        </div>
          
      </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="row mt-3">
      <div class="col-md-6">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-globe"></i>
              Dados da Empresa
              
            </h3>
            <?php if(session()->userPerfil != 3):?>
            <div class="card-tools">
              <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                  <a type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal">
                  <i class="fas fa-pen"></i> Editar
                  </a>
                </li>
              </ul>
            </div>
            <?php endif;?>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
              <address>
                <strong><?= !empty($empresa->nome) ? $empresa->nome : '';?></strong><br>
                <?= !empty($empresa->endereco) ? $empresa->endereco : '';?>
                <?= !empty($empresa->cidade) ? ', '.$empresa->cidade : '';?>
                <?= !empty($empresa->uf) ? ' - ' . $empresa->uf : '';?>
                <?= !empty($empresa->cep) ? ' , CEP ' . $empresa->cep : '';?><br>
                <?= !empty($empresa->telefone) ? $empresa->telefone : '';?><br>
                <?= !empty($empresa->email) ? $empresa->email : '';?><br>
                <?php if(!empty($empresa->site)):?><a href="<?= $empresa->site;?>" target="_blank"><?= $empresa->site;?></a><?php endif;?><br>

                <!-- Button trigger modal -->
                

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Dados da Empresa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form action="<?= base_url('/Admin/home/editar-empresa')?>" method="post">
                      <div class="modal-body">
                        <input type="text" class="form-control" name="id" value="<?= $empresa->id ?>" hidden>
                        <div class="form-group">
                          <label for="name">Nome</label>
                          <input type="text" class="form-control" name="nome" value="<?= !empty($empresa->nome) ? $empresa->nome : '';?>">
                        </div>
                        <div class="form-group">
                          <label for="endereco">Endereço</label>
                          <input type="text" class="form-control" name="endereco" value="<?= !empty($empresa->endereco) ? $empresa->endereco : '';?>">
                        </div>
                        <div class="form-group">
                          <label for="cidade">Cidade</label>
                          <input type="text" class="form-control" name="cidade" value="<?= !empty($empresa->cidade) ? $empresa->cidade : '';?>">
                        </div>
                        <div class="form-group">
                          <label for="uf">UF</label>
                          <input type="text" class="form-control" name="uf" value="<?= !empty($empresa->uf) ? $empresa->uf : '';?>">
                        </div>
                        <div class="form-group">
                          <label for="cep">CEP</label>
                          <input type="text" class="form-control" name="cep" value="<?= !empty($empresa->cep) ?  $empresa->cep : '';?>">
                        </div>
                        <div class="form-group">
                          <label for="telefone">Telefone</label>
                          <input type="text" class="form-control" name="telefone" value="<?= !empty($empresa->telefone) ? $empresa->telefone : '';?>">
                        </div>
                        <div class="form-group">
                          <label for="email">Email</label>
                          <input type="text" class="form-control" name="email" value="<?= !empty($empresa->email) ? $empresa->email : '';?>">
                        </div>
                        <div class="form-group">
                          <label for="site">Site</label>
                          <input type="text" class="form-control" name="site" value="<?= !empty($empresa->site) ? $empresa->site : '';?>">
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submite" class="btn btn-primary">Salvar alterações</button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
              </address>
            
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->

      <div class="col-md-6">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-cog"></i>
              Configurações
            </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <ul class="list-group">
              <li class="list-group-item"><i class="fas fa-globe"></i> <?= constant('CMSNOME').' '. constant('CMSVERSAO')?></li>
              <li class="list-group-item"><i class="fas fa-cogs"></i> PHP <?= constant('CMSVERSAOPHP')?></li>
              <li class="list-group-item"><i class="fas fa-database"></i> MySQli <?= constant('CMSVERSAOMYSQL')?></li>
              <li class="list-group-item"><i class="fas fa-server"></i> <?= constant('CMSSERVIDOR')?></li>
            </ul>
            
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>

  <?= $this->endSection() ?>
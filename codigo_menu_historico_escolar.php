<!-- ========================================================================
     CÓDIGO PARA ADICIONAR AO MENU - HISTÓRICO ESCOLAR
     ========================================================================
     
     Instruções:
     1. Abra o arquivo: project/app/Views/admin/template/masterpage.php
     2. Localize a linha 248 (após o menu "Disciplinas")
     3. Adicione o código abaixo ANTES da linha 249 (antes do menu "Relatórios")
     
     ======================================================================== -->

          <?php if(session()->userPerfil != 3):?>
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="fas fa-graduation-cap mr-2" aria-hidden="true"></i>
              <p>
                Histórico Escolar
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('Admin/HistoricoEscolar')?>" class="nav-link">
                  <i class="fas fa-angle-right mr-2"></i>
                  <p>Históricos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('Admin/HistoricoEscolar/Disciplinas')?>" class="nav-link">
                  <i class="fas fa-angle-right mr-2"></i>
                  <p>Disciplinas</p>
                </a>
              </li>
            </ul>
          </li>
          <?php endif;?>

<!-- ========================================================================
     FIM DO CÓDIGO DO MENU
     ======================================================================== -->

<?php
use App\Models\Admin\AlunosTurmasModel;
use App\Models\Admin\TurmasModel;

$session = \Config\Services::session();
?>

<?= $this->extend('admin/template/masterpage') ?>
<?= $this->section('content') ?>

<div class="row mb-2">
  <div class="col-sm-6">
    <h1>Relatórios</h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="<?= base_url('Admin/home')?>">Home</a></li>
      <li class="breadcrumb-item active">Relatórios</li>
    </ol>
  </div>
</div>

<div class="row mt-3">
  <div class="col-12">
    <div class="card">
      <div class="card-header d-flex align-items-center">
        <h3 class="card-title">Relatórios</h3>
      </div>

      <div class="card-body">
        <?php if ($alert = $session->getFlashdata()): ?>
          <?php
            $type = key($alert);
            $classAlert = $type === 'success' ? 'success' : 'danger';
            $message = $session->getFlashdata($type);
          ?>
          <div class="alert alert-<?= $classAlert ?> alert-dismissible fade show" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill">
              <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zM8.93 6.588l-1 4.705c-.07.34.03.533.3.533.2 0 .49-.07.69-.246l-.09.416c-.29.346-.92.598-1.46.598-.7 0-1-.422-.81-1.319l.74-3.468c.06-.293.01-.399-.29-.47l-.45-.081.08-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
            </svg>
            <?= $message ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php endif; ?>

        <form action="<?= base_url('Admin/Relatorios/gerarRelatorio') ?>" method="post" id="formRelatorio" target="_blank">
          <div class="form-group">
            <label for="tipoRelatorio">Tipo de Relatório</label>
            <select class="form-control" id="tipoRelatorio" name="tipoRelatorio" required>
              <option value="">Selecione...</option>
              <option value="declaracao_escolaridade">Declaração de Escolaridade</option>
              <!--<option value="atestado">Atestado</option>-->
              <option value="ficha_individual">Ficha Individual</option>
              <option value="historico_escolar">Histórico Escolar</option>
              <option value="ficha_matricula">Ficha de Matrícula</option>
              <option value="avaliacao_individual">Avaliação Individual</option>
              <option value="atestado_transferencia">Atestado de Transferência</option>
            </select>
          </div>

          <?php $turmas = (new TurmasModel())->get(); ?>

          <div class="form-group" id="grupoTurmaAluno" style="display: none;">
            <label for="turma">Turma</label>
            <select class="form-control" id="turma" name="turma">
              <option value="">Selecione a turma...</option>
              <?php foreach ($turmas as $turma): ?>
                <option value="<?= htmlspecialchars($turma->id) ?>"><?= htmlspecialchars($turma->nome) ?></option>
              <?php endforeach; ?>
            </select>

            <label for="aluno" class="mt-2">Aluno</label>
            <select class="form-control" id="aluno" name="aluno">
              <option value="">Selecione o aluno...</option>
            </select>

            <div id="grupoTransferencia" style="display: none;">
              <label for="status" class="mt-2">Status do Aluno</label>
              <select class="form-control" id="status" name="status" required>
                <option value="">Selecione...</option>
                <option value="cursando">Cursando</option>
                <option value="aprovado">Aprovado</option>
              </select>

              <label for="turma_destino" class="mt-2">Turma de Destino</label>
              <select class="form-control" id="turma_destino" name="turma_destino" required>
                <option value="">Selecione a turma de destino...</option>
                <?php foreach ($turma_transferencia as $turma): ?>
                  <option value="<?= htmlspecialchars($turma['nome'] . ' DO ' . $turma['periodo']) ?>">
                      <?= htmlspecialchars($turma['nome'] . ' - ' . $turma['periodo']) ?>
                  </option>
                <?php endforeach; ?>
              </select>
              <small class="form-text text-muted">
                Selecione a turma para qual o aluno será transferido.
              </small>
            </div>
          </div>

          <button type="submit" class="btn btn-primary mt-3">Gerar Relatório</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
// Exibe/oculta os campos "Turma" e "Aluno"
document.addEventListener('DOMContentLoaded', function () {
  const tipoRelatorio = document.getElementById('tipoRelatorio');
  const grupoTurmaAluno = document.getElementById('grupoTurmaAluno');
  const turmaSelect = document.getElementById('turma');
  const alunoSelect = document.getElementById('aluno');

  const grupoTransferencia = document.getElementById('grupoTransferencia');

  function toggleGrupo() {
    const mostrar = ['declaracao_escolaridade', 'ficha_individual', 'avaliacao_individual', 'atestado_transferencia'].includes(tipoRelatorio.value);
    grupoTurmaAluno.style.display = mostrar ? '' : 'none';
    
    // Mostrar campos de transferência apenas para atestado de transferência
    if (tipoRelatorio.value === 'atestado_transferencia') {
      grupoTransferencia.style.display = '';
    } else {
      grupoTransferencia.style.display = 'none';
    }

    if (!mostrar) {
      turmaSelect.value = '';
      alunoSelect.innerHTML = '<option value="">Selecione o aluno...</option>';
    }
  }

  tipoRelatorio.addEventListener('change', toggleGrupo);
  toggleGrupo(); // estado inicial

  turmaSelect.addEventListener('change', function () {
    const turmaId = this.value;
    alunoSelect.innerHTML = '<option value="">Carregando...</option>';

    if (!turmaId) {
      alunoSelect.innerHTML = '<option value="">Todos...</option>';
      return;
    }

    fetch(`<?= base_url('Admin/Relatorios/getAlunosPorTurma') ?>/${turmaId}`)
      .then(response => response.json())
      .then(data => {
        let options = '<option value="">Todos...</option>';
        if (Array.isArray(data)) {
          data.forEach(aluno => {
            options += `<option value="${aluno.id_aluno}">${aluno.id_aluno} - ${aluno.nome}</option>`;
          });
        }
        alunoSelect.innerHTML = options;
      })
      .catch(() => {
        alunoSelect.innerHTML = '<option value="">Erro ao carregar alunos</option>';
      });
  });
});
</script>

<?= $this->endSection() ?>

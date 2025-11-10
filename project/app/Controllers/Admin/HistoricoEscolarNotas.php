<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Admin\HistoricoEscolarModel;
use App\Models\Admin\HistoricoEscolarPeriodoModel;
use App\Models\Admin\HistoricoEscolarNotasModel;
use App\Models\Admin\HistoricoDisciplinasModel;

class HistoricoEscolarNotas extends Controller
{
    protected $historicoModel;
    protected $periodoModel;
    protected $notasModel;
    protected $disciplinasModel;
    protected $session;
    protected $validation;
    protected $data;

    //--------------------------------------------------------------------
    public function __construct()
    {
        helper('auth');
        helper('form');
        helper('parametros');
        permission();
        permissionAdmin();

        $this->historicoModel = new HistoricoEscolarModel();
        $this->periodoModel = new HistoricoEscolarPeriodoModel();
        $this->notasModel = new HistoricoEscolarNotasModel();
        $this->disciplinasModel = new HistoricoDisciplinasModel();
        $this->session = session();
        $this->validation = \Config\Services::validation();
        $this->data = [];
    }

    //--------------------------------------------------------------------
    // CRUD NOTAS
    //--------------------------------------------------------------------

    /**
     * Formulário de criação de nota
     */
    public function create($idPeriodo)
    {
        $periodo = $this->periodoModel->find($idPeriodo);

        if (!$periodo) {
            $this->session->setFlashdata('alert', 'error');
            $this->session->setFlashdata('message', 'Período não encontrado!');
            return redirect()->to(base_url('Admin/HistoricoEscolar'));
        }

        $historico = $this->historicoModel->getComAluno($periodo->id_historico);
        $disciplinas = $this->disciplinasModel->getAtivas();

        // Verificar quais disciplinas já foram adicionadas neste período
        $notasExistentes = $this->notasModel->where('id_periodo', $idPeriodo)->findAll();
        $disciplinasUsadas = array_column($notasExistentes, 'id_historico_disciplina');

        $this->data['type'] = 'create';
        $this->data['title'] = 'Adicionar Disciplina/Nota';
        $this->data['titleBreadcrumb'] = 'Adicionar Nota';
        $this->data['action'] = base_url('Admin/HistoricoEscolar/Notas/store/' . $idPeriodo);
        $this->data['historico'] = $historico;
        $this->data['periodo'] = $periodo;
        $this->data['disciplinas'] = $disciplinas;
        $this->data['disciplinasUsadas'] = $disciplinasUsadas;

        return view('admin/historico_escolar/notas/crud', $this->data);
    }

    /**
     * Salvar nova nota
     */
    public function store($idPeriodo)
    {
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to(base_url('Admin/HistoricoEscolar'));
        }

        $periodo = $this->periodoModel->find($idPeriodo);

        if (!$periodo) {
            $this->session->setFlashdata('alert', 'error');
            $this->session->setFlashdata('message', 'Período não encontrado!');
            return redirect()->to(base_url('Admin/HistoricoEscolar'));
        }

        $rules = [
            'id_historico_disciplina' => ['label' => 'Disciplina', 'rules' => 'required|numeric'],
            'resultado' => ['label' => 'Resultado', 'rules' => 'required']
        ];

        if (!$this->validation->setRules($rules)->withRequest($this->request)->run()) {
            $this->session->setFlashdata('alert', 'error');
            $this->session->setFlashdata('message', 'Preencha todos os campos obrigatórios!');
            return redirect()->back()->withInput();
        }

        // Verificar se a disciplina já foi adicionada neste período
        $existe = $this->notasModel
            ->where('id_periodo', $idPeriodo)
            ->where('id_historico_disciplina', $this->request->getPost('id_historico_disciplina'))
            ->first();

        if ($existe) {
            $this->session->setFlashdata('alert', 'error');
            $this->session->setFlashdata('message', 'Esta disciplina já foi adicionada neste período!');
            return redirect()->back()->withInput();
        }

        $data = [
            'id_periodo' => $idPeriodo,
            'id_historico_disciplina' => $this->request->getPost('id_historico_disciplina'),
            'nota' => $this->request->getPost('nota') ?: null,
            'resultado' => $this->request->getPost('resultado'),
            'faltas' => $this->request->getPost('faltas') ?: 0,
            'observacao' => $this->request->getPost('observacao')
        ];

        if ($this->notasModel->insert($data)) {
            $this->session->setFlashdata('alert', 'success');
            $this->session->setFlashdata('message', 'Disciplina/nota adicionada com sucesso!');
            return redirect()->to(base_url('Admin/HistoricoEscolar/Periodo/notas/' . $idPeriodo));
        }

        $this->session->setFlashdata('alert', 'error');
        $this->session->setFlashdata('message', 'Erro ao adicionar disciplina/nota!');
        return redirect()->back()->withInput();
    }

    /**
     * Formulário de edição de nota
     */
    public function edit($id)
    {
        $nota = $this->notasModel->find($id);

        if (!$nota) {
            $this->session->setFlashdata('alert', 'error');
            $this->session->setFlashdata('message', 'Nota não encontrada!');
            return redirect()->to(base_url('Admin/HistoricoEscolar'));
        }

        $periodo = $this->periodoModel->find($nota->id_periodo);
        $historico = $this->historicoModel->getComAluno($periodo->id_historico);
        $disciplinas = $this->disciplinasModel->getAtivas();

        $this->data['type'] = 'edit';
        $this->data['title'] = 'Editar Disciplina/Nota';
        $this->data['titleBreadcrumb'] = 'Editar Nota';
        $this->data['action'] = base_url('Admin/HistoricoEscolar/Notas/update/' . $id);
        $this->data['historico'] = $historico;
        $this->data['periodo'] = $periodo;
        $this->data['disciplinas'] = $disciplinas;
        $this->data['nota'] = $nota;
        $this->data['disciplinasUsadas'] = [];

        return view('admin/historico_escolar/notas/crud', $this->data);
    }

    /**
     * Atualizar nota
     */
    public function update($id)
    {
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to(base_url('Admin/HistoricoEscolar'));
        }

        $nota = $this->notasModel->find($id);

        if (!$nota) {
            $this->session->setFlashdata('alert', 'error');
            $this->session->setFlashdata('message', 'Nota não encontrada!');
            return redirect()->to(base_url('Admin/HistoricoEscolar'));
        }

        $rules = [
            'resultado' => ['label' => 'Resultado', 'rules' => 'required']
        ];

        if (!$this->validation->setRules($rules)->withRequest($this->request)->run()) {
            $this->session->setFlashdata('alert', 'error');
            $this->session->setFlashdata('message', 'Preencha todos os campos obrigatórios!');
            return redirect()->back()->withInput();
        }

        $data = [
            'nota' => $this->request->getPost('nota') ?: null,
            'resultado' => $this->request->getPost('resultado'),
            'faltas' => $this->request->getPost('faltas') ?: 0,
            'observacao' => $this->request->getPost('observacao')
        ];

        if ($this->notasModel->update($id, $data)) {
            $this->session->setFlashdata('alert', 'success');
            $this->session->setFlashdata('message', 'Disciplina/nota atualizada com sucesso!');
            return redirect()->to(base_url('Admin/HistoricoEscolar/Periodo/notas/' . $nota->id_periodo));
        }

        $this->session->setFlashdata('alert', 'error');
        $this->session->setFlashdata('message', 'Erro ao atualizar disciplina/nota!');
        return redirect()->back()->withInput();
    }

    /**
     * Excluir nota
     */
    public function delete($id)
    {
        $nota = $this->notasModel->find($id);

        if (!$nota) {
            $this->session->setFlashdata('alert', 'error');
            $this->session->setFlashdata('message', 'Nota não encontrada!');
            return redirect()->to(base_url('Admin/HistoricoEscolar'));
        }

        $idPeriodo = $nota->id_periodo;

        if ($this->notasModel->delete($id)) {
            $this->session->setFlashdata('alert', 'success');
            $this->session->setFlashdata('message', 'Disciplina/nota excluída com sucesso!');
        } else {
            $this->session->setFlashdata('alert', 'error');
            $this->session->setFlashdata('message', 'Erro ao excluir disciplina/nota!');
        }

        return redirect()->to(base_url('Admin/HistoricoEscolar/Periodo/notas/' . $idPeriodo));
    }
}

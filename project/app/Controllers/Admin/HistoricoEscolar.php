<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Admin\HistoricoEscolarModel;
use App\Models\Admin\HistoricoEscolarPeriodoModel;
use App\Models\Admin\HistoricoEscolarNotasModel;
use App\Models\Admin\HistoricoDisciplinasModel;
use App\Models\Admin\AlunosModel;

class HistoricoEscolar extends Controller
{
    protected $historicoModel;
    protected $periodoModel;
    protected $notasModel;
    protected $disciplinasModel;
    protected $alunosModel;
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
        $this->alunosModel = new AlunosModel();
        $this->session = session();
        $this->validation = \Config\Services::validation();
        $this->data = [];
    }

    //--------------------------------------------------------------------
    // CRUD HISTÓRICO PRINCIPAL
    //--------------------------------------------------------------------

    /**
     * Lista todos os históricos
     */
    public function index()
    {
        $this->data['historicos'] = $this->historicoModel->listarComAlunos();
        return view('admin/historico_escolar/index', $this->data);
    }

    /**
     * Formulário de criação de histórico
     */
    public function create()
    {
        $this->data['type'] = 'create';
        $this->data['title'] = 'Cadastrar Histórico Escolar';
        $this->data['titleBreadcrumb'] = 'Cadastrar';
        $this->data['action'] = base_url('Admin/HistoricoEscolar/store');
        $this->data['alunos'] = $this->alunosModel->where('deleted_at', null)->orderBy('nome', 'ASC')->findAll();

        return view('admin/historico_escolar/crud', $this->data);
    }

    /**
     * Salvar novo histórico
     */
    public function store()
    {
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to(base_url('Admin/HistoricoEscolar'));
        }

        $rules = [
            'id_aluno' => ['label' => 'Aluno', 'rules' => 'required'],
            'situacao' => ['label' => 'Situação', 'rules' => 'required']
        ];

        if (!$this->validation->setRules($rules)->withRequest($this->request)->run()) {
            $this->session->setFlashdata('alert', 'error');
            $this->session->setFlashdata('message', 'Preencha todos os campos obrigatórios!');
            return redirect()->back()->withInput();
        }

        $idAluno = $this->request->getPost('id_aluno');

        // Verificar se aluno já possui histórico
        if ($this->historicoModel->alunoTemHistorico($idAluno)) {
            $this->session->setFlashdata('alert', 'error');
            $this->session->setFlashdata('message', 'Este aluno já possui um histórico escolar cadastrado!');
            return redirect()->back()->withInput();
        }

        $data = [
            'id_aluno' => $idAluno,
            'data_inicio' => $this->request->getPost('data_inicio') ?: null,
            'situacao' => $this->request->getPost('situacao'),
            'observacao_geral' => $this->request->getPost('observacao_geral')
        ];

        if ($this->historicoModel->insert($data)) {
            $this->session->setFlashdata('alert', 'success');
            $this->session->setFlashdata('message', 'Histórico escolar cadastrado com sucesso!');
            return redirect()->to(base_url('Admin/HistoricoEscolar'));
        }

        $this->session->setFlashdata('alert', 'error');
        $this->session->setFlashdata('message', 'Erro ao cadastrar histórico escolar!');
        return redirect()->back()->withInput();
    }

    /**
     * Visualizar histórico
     */
    public function view($id)
    {
        $historico = $this->historicoModel->getComAluno($id);

        if (!$historico) {
            $this->session->setFlashdata('alert', 'error');
            $this->session->setFlashdata('message', 'Histórico não encontrado!');
            return redirect()->to(base_url('Admin/HistoricoEscolar'));
        }

        $this->data['historico'] = $historico;
        $this->data['periodos'] = $this->periodoModel->getByHistorico($id);

        return view('admin/historico_escolar/view', $this->data);
    }

    /**
     * Formulário de edição de histórico
     */
    public function edit($id)
    {
        $historico = $this->historicoModel->find($id);

        if (!$historico) {
            $this->session->setFlashdata('alert', 'error');
            $this->session->setFlashdata('message', 'Histórico não encontrado!');
            return redirect()->to(base_url('Admin/HistoricoEscolar'));
        }

        $this->data['type'] = 'edit';
        $this->data['title'] = 'Editar Histórico Escolar';
        $this->data['titleBreadcrumb'] = 'Editar';
        $this->data['action'] = base_url('Admin/HistoricoEscolar/update/' . $id);
        $this->data['historico'] = $historico;
        $this->data['alunos'] = $this->alunosModel->where('deleted_at', null)->orderBy('nome', 'ASC')->findAll();

        return view('admin/historico_escolar/crud', $this->data);
    }

    /**
     * Atualizar histórico
     */
    public function update($id)
    {
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to(base_url('Admin/HistoricoEscolar'));
        }

        $historico = $this->historicoModel->find($id);

        if (!$historico) {
            $this->session->setFlashdata('alert', 'error');
            $this->session->setFlashdata('message', 'Histórico não encontrado!');
            return redirect()->to(base_url('Admin/HistoricoEscolar'));
        }

        $rules = [
            'id_aluno' => ['label' => 'Aluno', 'rules' => 'required'],
            'situacao' => ['label' => 'Situação', 'rules' => 'required']
        ];

        if (!$this->validation->setRules($rules)->withRequest($this->request)->run()) {
            $this->session->setFlashdata('alert', 'error');
            $this->session->setFlashdata('message', 'Preencha todos os campos obrigatórios!');
            return redirect()->back()->withInput();
        }

        $idAluno = $this->request->getPost('id_aluno');

        // Verificar se aluno já possui histórico (exceto o atual)
        if ($this->historicoModel->alunoTemHistorico($idAluno, $id)) {
            $this->session->setFlashdata('alert', 'error');
            $this->session->setFlashdata('message', 'Este aluno já possui outro histórico escolar cadastrado!');
            return redirect()->back()->withInput();
        }

        $data = [
            'id_aluno' => $idAluno,
            'data_inicio' => $this->request->getPost('data_inicio') ?: null,
            'situacao' => $this->request->getPost('situacao'),
            'observacao_geral' => $this->request->getPost('observacao_geral')
        ];

        if ($this->historicoModel->update($id, $data)) {
            $this->session->setFlashdata('alert', 'success');
            $this->session->setFlashdata('message', 'Histórico escolar atualizado com sucesso!');
            return redirect()->to(base_url('Admin/HistoricoEscolar'));
        }

        $this->session->setFlashdata('alert', 'error');
        $this->session->setFlashdata('message', 'Erro ao atualizar histórico escolar!');
        return redirect()->back()->withInput();
    }

    /**
     * Excluir histórico
     */
    public function delete($id)
    {
        $historico = $this->historicoModel->find($id);

        if (!$historico) {
            $this->session->setFlashdata('alert', 'error');
            $this->session->setFlashdata('message', 'Histórico não encontrado!');
            return redirect()->to(base_url('Admin/HistoricoEscolar'));
        }

        if ($this->historicoModel->delete($id)) {
            $this->session->setFlashdata('alert', 'success');
            $this->session->setFlashdata('message', 'Histórico escolar excluído com sucesso!');
        } else {
            $this->session->setFlashdata('alert', 'error');
            $this->session->setFlashdata('message', 'Erro ao excluir histórico escolar!');
        }

        return redirect()->to(base_url('Admin/HistoricoEscolar'));
    }
}

<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Admin\HistoricoEscolarModel;
use App\Models\Admin\HistoricoEscolarPeriodoModel;
use App\Models\Admin\HistoricoEscolarNotasModel;

class HistoricoEscolarPeriodo extends Controller
{
    protected $historicoModel;
    protected $periodoModel;
    protected $notasModel;
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
        $this->session = session();
        $this->validation = \Config\Services::validation();
        $this->data = [];
    }

    //--------------------------------------------------------------------
    // CRUD PERÍODOS LETIVOS
    //--------------------------------------------------------------------

    /**
     * Formulário de criação de período
     */
    public function create($idHistorico)
    {
        $historico = $this->historicoModel->getComAluno($idHistorico);

        if (!$historico) {
            $this->session->setFlashdata('alert', 'error');
            $this->session->setFlashdata('message', 'Histórico não encontrado!');
            return redirect()->to(base_url('Admin/HistoricoEscolar'));
        }

        $this->data['type'] = 'create';
        $this->data['title'] = 'Cadastrar Período Letivo';
        $this->data['titleBreadcrumb'] = 'Cadastrar Período';
        $this->data['action'] = base_url('Admin/HistoricoEscolar/Periodo/store/' . $idHistorico);
        $this->data['historico'] = $historico;

        return view('admin/historico_escolar/periodo/crud', $this->data);
    }

    /**
     * Salvar novo período
     */
    public function store($idHistorico)
    {
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to(base_url('Admin/HistoricoEscolar/view/' . $idHistorico));
        }

        $historico = $this->historicoModel->find($idHistorico);

        if (!$historico) {
            $this->session->setFlashdata('alert', 'error');
            $this->session->setFlashdata('message', 'Histórico não encontrado!');
            return redirect()->to(base_url('Admin/HistoricoEscolar'));
        }

        $rules = [
            'estabelecimento' => ['label' => 'Estabelecimento', 'rules' => 'required|min_length[3]'],
            'municipio' => ['label' => 'Município', 'rules' => 'required|min_length[3]'],
            'uf' => ['label' => 'UF', 'rules' => 'required|exact_length[2]'],
            'turma' => ['label' => 'Turma', 'rules' => 'required'],
            'ano_letivo' => ['label' => 'Ano Letivo', 'rules' => 'required|exact_length[4]|numeric'],
            'resultado' => ['label' => 'Resultado', 'rules' => 'required']
        ];

        if (!$this->validation->setRules($rules)->withRequest($this->request)->run()) {
            $this->session->setFlashdata('alert', 'error');
            $this->session->setFlashdata('message', 'Preencha todos os campos obrigatórios!');
            return redirect()->back()->withInput();
        }

        $data = [
            'id_historico' => $idHistorico,
            'estabelecimento' => $this->request->getPost('estabelecimento'),
            'municipio' => $this->request->getPost('municipio'),
            'uf' => strtoupper($this->request->getPost('uf')),
            'turma' => $this->request->getPost('turma'),
            'ano_letivo' => $this->request->getPost('ano_letivo'),
            'resultado' => $this->request->getPost('resultado'),
            'carga_horaria_total' => $this->request->getPost('carga_horaria_total') ?: null,
            'frequencia' => $this->request->getPost('frequencia') ?: null,
            'observacao' => $this->request->getPost('observacao'),
            'ordem' => 0
        ];

        if ($this->periodoModel->insert($data)) {
            // Atualizar ordem dos períodos
            $this->periodoModel->atualizarOrdem($idHistorico);
            
            $this->session->setFlashdata('alert', 'success');
            $this->session->setFlashdata('message', 'Período letivo cadastrado com sucesso!');
            return redirect()->to(base_url('Admin/HistoricoEscolar/view/' . $idHistorico));
        }

        $this->session->setFlashdata('alert', 'error');
        $this->session->setFlashdata('message', 'Erro ao cadastrar período letivo!');
        return redirect()->back()->withInput();
    }

    /**
     * Formulário de edição de período
     */
    public function edit($id)
    {
        $periodo = $this->periodoModel->find($id);

        if (!$periodo) {
            $this->session->setFlashdata('alert', 'error');
            $this->session->setFlashdata('message', 'Período não encontrado!');
            return redirect()->to(base_url('Admin/HistoricoEscolar'));
        }

        $historico = $this->historicoModel->getComAluno($periodo->id_historico);

        $this->data['type'] = 'edit';
        $this->data['title'] = 'Editar Período Letivo';
        $this->data['titleBreadcrumb'] = 'Editar Período';
        $this->data['action'] = base_url('Admin/HistoricoEscolar/Periodo/update/' . $id);
        $this->data['historico'] = $historico;
        $this->data['periodo'] = $periodo;

        return view('admin/historico_escolar/periodo/crud', $this->data);
    }

    /**
     * Atualizar período
     */
    public function update($id)
    {
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to(base_url('Admin/HistoricoEscolar'));
        }

        $periodo = $this->periodoModel->find($id);

        if (!$periodo) {
            $this->session->setFlashdata('alert', 'error');
            $this->session->setFlashdata('message', 'Período não encontrado!');
            return redirect()->to(base_url('Admin/HistoricoEscolar'));
        }

        $rules = [
            'estabelecimento' => ['label' => 'Estabelecimento', 'rules' => 'required|min_length[3]'],
            'municipio' => ['label' => 'Município', 'rules' => 'required|min_length[3]'],
            'uf' => ['label' => 'UF', 'rules' => 'required|exact_length[2]'],
            'turma' => ['label' => 'Turma', 'rules' => 'required'],
            'ano_letivo' => ['label' => 'Ano Letivo', 'rules' => 'required|exact_length[4]|numeric'],
            'resultado' => ['label' => 'Resultado', 'rules' => 'required']
        ];

        if (!$this->validation->setRules($rules)->withRequest($this->request)->run()) {
            $this->session->setFlashdata('alert', 'error');
            $this->session->setFlashdata('message', 'Preencha todos os campos obrigatórios!');
            return redirect()->back()->withInput();
        }

        $data = [
            'estabelecimento' => $this->request->getPost('estabelecimento'),
            'municipio' => $this->request->getPost('municipio'),
            'uf' => strtoupper($this->request->getPost('uf')),
            'turma' => $this->request->getPost('turma'),
            'ano_letivo' => $this->request->getPost('ano_letivo'),
            'resultado' => $this->request->getPost('resultado'),
            'carga_horaria_total' => $this->request->getPost('carga_horaria_total') ?: null,
            'frequencia' => $this->request->getPost('frequencia') ?: null,
            'observacao' => $this->request->getPost('observacao')
        ];

        if ($this->periodoModel->update($id, $data)) {
            // Atualizar ordem dos períodos
            $this->periodoModel->atualizarOrdem($periodo->id_historico);
            
            $this->session->setFlashdata('alert', 'success');
            $this->session->setFlashdata('message', 'Período letivo atualizado com sucesso!');
            return redirect()->to(base_url('Admin/HistoricoEscolar/view/' . $periodo->id_historico));
        }

        $this->session->setFlashdata('alert', 'error');
        $this->session->setFlashdata('message', 'Erro ao atualizar período letivo!');
        return redirect()->back()->withInput();
    }

    /**
     * Excluir período
     */
    public function delete($id)
    {
        $periodo = $this->periodoModel->find($id);

        if (!$periodo) {
            $this->session->setFlashdata('alert', 'error');
            $this->session->setFlashdata('message', 'Período não encontrado!');
            return redirect()->to(base_url('Admin/HistoricoEscolar'));
        }

        $idHistorico = $periodo->id_historico;

        if ($this->periodoModel->delete($id)) {
            // Atualizar ordem dos períodos restantes
            $this->periodoModel->atualizarOrdem($idHistorico);
            
            $this->session->setFlashdata('alert', 'success');
            $this->session->setFlashdata('message', 'Período letivo excluído com sucesso!');
        } else {
            $this->session->setFlashdata('alert', 'error');
            $this->session->setFlashdata('message', 'Erro ao excluir período letivo!');
        }

        return redirect()->to(base_url('Admin/HistoricoEscolar/view/' . $idHistorico));
    }

    /**
     * Visualizar notas de um período
     */
    public function notas($id)
    {
        $periodo = $this->periodoModel->getComNotas($id);

        if (!$periodo) {
            $this->session->setFlashdata('alert', 'error');
            $this->session->setFlashdata('message', 'Período não encontrado!');
            return redirect()->to(base_url('Admin/HistoricoEscolar'));
        }

        $historico = $this->historicoModel->getComAluno($periodo->id_historico);
        $notas = $this->notasModel->getByPeriodo($id);

        $this->data['historico'] = $historico;
        $this->data['periodo'] = $periodo;
        $this->data['notas'] = $notas;

        return view('admin/historico_escolar/periodo/notas', $this->data);
    }
}

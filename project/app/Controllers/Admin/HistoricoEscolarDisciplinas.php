<?php

namespace App\Controllers\Admin;

use App\Models\Admin\HistoricoDisciplinasModel;
use CodeIgniter\Controller;

class HistoricoEscolarDisciplinas extends Controller
{
    public $model, $session, $validation, $data;

    //--------------------------------------------------------------------
    public function __construct()
    {
        helper('auth');
        helper('form');
        permission();
        permissionAdmin();

        $this->model = new HistoricoDisciplinasModel();
        $this->session = session();
        $this->validation = \Config\Services::validation();
    }

    //--------------------------------------------------------------------
    public function index()
    {
        $this->data['table'] = $this->model->orderBy('descricao', 'ASC')->findAll();
        
        return view('admin/historico_escolar/disciplinas/index.php', $this->data);
    }

    //--------------------------------------------------------------------
    public function create()
    {
        $this->data['type'] = 'create';
        $this->data['title'] = 'Cadastrar Disciplina';
        $this->data['titleBreadcrumb'] = 'Cadastrar';
        $this->data['action'] = base_url('Admin/HistoricoEscolar/Disciplinas/cadastrar');

        if ($this->request->getMethod() === 'post') {
            
            $alert = 'error';
            $message = 'Não foi possível salvar o registro, tente novamente!';

            $rules = $this->validation->setRules([
                'descricao' => [
                    'label' => 'Descrição', 
                    'rules' => 'required|min_length[3]|max_length[50]'
                ],
                'carga_horaria' => [
                    'label' => 'Carga Horária', 
                    'rules' => 'permit_empty|numeric|greater_than[0]'
                ]
            ]);

            if ($this->validation->withRequest($this->request)->run()) {
                
                $fields = $this->request->getVar();
                
                // Verificar se disciplina já existe
                if ($this->model->disciplinaExiste($fields['descricao'])) {
                    $alert = 'error';
                    $message = 'Já existe uma disciplina cadastrada com este nome!';
                } else {
                    if ($this->setCreate()) {
                        $alert = 'success';
                        $message = 'Disciplina cadastrada com sucesso!';
                    }
                }
            }

            $this->session->setFlashdata($alert, $message);
            return redirect()->back();
        }

        return view('admin/historico_escolar/disciplinas/crud.php', $this->data);
    }

    //--------------------------------------------------------------------
    private function setCreate()
    {
        $fields = $this->request->getVar();

        try {
            $this->model->insert($fields);
            return true;
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return false;
        }
    }

    //--------------------------------------------------------------------
    public function read($id)
    {
        $this->data['type'] = 'read';
        $this->data['title'] = 'Visualizar Disciplina';
        $this->data['titleBreadcrumb'] = 'Visualizar';
        $this->data['action'] = base_url('Admin/HistoricoEscolar/Disciplinas/visualizar/' . $id);

        $record = $this->model->find($id);

        if (!$record) {
            $alert = 'error';
            $message = 'Registro não encontrado!';
            $this->session->setFlashdata($alert, $message);
            return redirect()->back();
        }

        $this->data['record'] = $record;

        return view('admin/historico_escolar/disciplinas/crud.php', $this->data);
    }

    //--------------------------------------------------------------------
    public function update($id)
    {
        $this->data['type'] = 'update';
        $this->data['title'] = 'Editar Disciplina';
        $this->data['titleBreadcrumb'] = 'Editar';
        $this->data['action'] = base_url('Admin/HistoricoEscolar/Disciplinas/editar/' . $id);

        if ($this->request->getMethod() === 'post') {

            $rules = $this->validation->setRules([
                'descricao' => [
                    'label' => 'Descrição', 
                    'rules' => 'required|min_length[3]|max_length[50]'
                ],
                'carga_horaria' => [
                    'label' => 'Carga Horária', 
                    'rules' => 'permit_empty|numeric|greater_than[0]'
                ]
            ]);

            if ($this->validation->withRequest($this->request)->run()) {

                $alert = 'error';
                $message = 'Não foi possível atualizar o registro!';
                
                $fields = $this->request->getVar();
                
                // Verificar se disciplina já existe (excluindo o próprio registro)
                if ($this->model->disciplinaExiste($fields['descricao'], $id)) {
                    $alert = 'error';
                    $message = 'Já existe outra disciplina cadastrada com este nome!';
                } else {
                    if ($this->setUpdate($id)) {
                        $alert = 'success';
                        $message = 'Disciplina atualizada com sucesso!';
                    }
                }

                $this->session->setFlashdata($alert, $message);
                return redirect()->back();
            }
        }

        $this->data['record'] = $this->model->find($id);

        return view('admin/historico_escolar/disciplinas/crud.php', $this->data);
    }

    //--------------------------------------------------------------------
    private function setUpdate($id)
    {
        $fields = $this->request->getVar();

        try {
            $this->model->update($id, $fields);
            return true;
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return false;
        }
    }

    //--------------------------------------------------------------------
    public function delete($id)
    {
        if ($this->setDelete($id)) {
            $alert = 'success';
            $message = 'Disciplina excluída com sucesso!';
        } else {
            $alert = 'error';
            $message = 'Não foi possível excluir a disciplina!';
        }

        $this->session->setFlashdata($alert, $message);
        return redirect()->back();
    }

    //--------------------------------------------------------------------
    private function setDelete($id)
    {
        try {
            $this->model->delete($id);
            return true;
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return false;
        }
    }
}

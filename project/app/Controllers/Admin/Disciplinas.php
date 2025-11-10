<?php

namespace App\Controllers\Admin;

use App\Models\Admin\DisciplinasModel;
use CodeIgniter\Controller;

class Disciplinas extends Controller
{
    public $model, $session, $validation, $data;
    
    //--------------------------------------------------------------------
    public function __construct()
	{
        helper('auth');
        helper('form');
        permission();
        permissionAdmin();

		$this->model	= new DisciplinasModel();
        $this->session  = session();
        $this->validation = \Config\Services::validation();
	}

    //--------------------------------------------------------------------
    public function index()
    {
        $this->data['title'] = 'Disciplinas';

        $this->data['table'] = 	$this->model->get();

        return view('admin/disciplinas/index.php', $this->data);

    }

    //--------------------------------------------------------------------
    public function create()
    {

        $this->data['url'] = base_url('Admin/Disciplinas/');
        $this->data['type'] = 'create';
        $this->data['title'] = 'Disciplinas';
        $this->data['titleType'] = 'Cadastrar Registro';
        $this->data['titleBreadcrumb'] = 'Cadastrar';
        $this->data['action'] = base_url('Admin/Disciplinas/cadastrar/');

        if($this->request->getMethod() === 'post'){

                $rules = $this->validation->setRules    ([
                                                            'descricao'         => ['label' => 'Descrição', 'rules' => 'required|min_length[3]|max_length[255]'],
                                                            'carga_horaria'     => ['label' => 'Carga Horária', 'rules' => 'required|min_length[1]']
                                                        ]);

                if ($this->validation->withRequest($this->request)->run()){

                    $alert = 'error';
                    $message = 'Não foi possível salvar o registro tente novamente!';

                    if($this->setCreate()){
                        $alert = 'success';
                        $message = 'O registro foi cadastrado com sucesso!';
                    }

                    $this->session->setFlashdata($alert, $message);
                    return redirect()->back();
                }
        }
        
        return view('admin/disciplinas/crud.php', $this->data);    

    }


    //--------------------------------------------------------------------
    private function setCreate()
    {

        try {

            $fields = $this->request->getVar();

            $this->model->insert($fields, false);

            return true;

        } catch (\Exception $e) {

            return false;

        }


    }

    public function read($id)
    {
        $this->data['url'] = base_url('Admin/Disciplinas');
        $this->data['title'] = 'Disciplinas';
        $this->data['titleType'] = 'Visualizar Registro';
        $this->data['type'] = 'read';
        $this->data['titleBreadcrumb'] = 'Visualizar';
        $this->data['action'] = base_url('Admin/Disciplinas/visualizar/'.$id);

        $this->data['record'] = $this->model->get($id);

        if (!$this->data['record']) {
            $alert = 'error';
            $message = 'Registro não encontrado!';
            $this->session->setFlashdata($alert, $message);
            return redirect()->back();
        }

        return view('admin/disciplinas/crud.php', $this->data);

    }

    public function update($id)
    {
        $this->data['url'] = base_url('Admin/Disciplinas');
        $this->data['title'] = 'Disciplinas';
        $this->data['titleType'] = 'Editar Registro';
        $this->data['type'] = 'update';
        $this->data['titleBreadcrumb'] = 'Editar';
        $this->data['action'] = base_url('Admin/Disciplinas/editar/'.$id);


        if($this->request->getMethod() === 'post'){

            $rules = $this->validation->setRules    ([
                                                        'descricao'   => ['label' => 'Descrição', 'rules' => 'required|min_length[3]|max_length[255]'],
                                                        'carga_horaria' => ['label' => 'Carga Horária', 'rules' => 'required|min_length[1]']
                                                    ]);                                                  

            if ($this->validation->withRequest($this->request)->run()){

                $alert = 'error';
                $message = 'Não foi possível atualizar o registro!';

                if($this->setUpdate($id)){
                    $alert = 'success';
                    $message = 'O registro foi atualizado com sucesso!';
                }

                $this->session->setFlashdata($alert, $message);
                return redirect()->back();

            }
        }

        $this->data['record'] = $this->model->get($id);

        return view('admin/disciplinas/crud.php', $this->data);

    }

    //--------------------------------------------------------------------
    private function setUpdate($id)
    {

        $fields = 	$this->request->getVar();

        try {

            return $this->model->update($id, $fields, false);

        } catch (\Exception $e) {

            return false;

        }

    }

    //--------------------------------------------------------------------
    public function delete($id)
    {

        $alert = 'error';
        $message = 'Não foi possível excluir o registro!';

        if($this->setDelete($id)){
            $alert = 'success';
            $message = 'Registro excluído com sucesso!';

        }

        $this->session->setFlashdata($alert, $message);
        return redirect()->back();

    }

    //--------------------------------------------------------------------
    private function setDelete($id)
    {

        return $this->model->delete($id) ? true : false;

    }

    


}

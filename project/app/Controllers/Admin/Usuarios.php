<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Admin\UsuarioModel;

class Usuarios extends Controller
{
    public $model, $session, $validation, $data;
    
    //--------------------------------------------------------------------
    public function __construct()
	{
        helper('auth');
        helper('form');
        permission();
        permissionAdmin();

		$this->model	= new UsuarioModel();
        $this->session  = session();
        $this->validation = \Config\Services::validation();
	}

    //--------------------------------------------------------------------
    public function index()
    {

        $this->data['table'] = 	$this->model->findAll();

        return view('admin/usuarios/index.php', $this->data);

    }

    //--------------------------------------------------------------------
    public function create()
    {


        $this->data['type'] = 'create';
        $this->data['title'] = 'Cadastrar Registro';
        $this->data['titleBreadcrumb'] = 'Cadastrar';
        $this->data['action'] = base_url('Admin/Usuarios/cadastrar/');

        if($this->request->getMethod() === 'post'){

            if(csrf_hash() === $this->request->getVar('csrf_test_name'))
            {
                $rules = $this->validation->setRules    ([
                                                            'nome'         => ['label' => 'Nome', 'rules' => 'required|min_length[3]|max_length[255]'],
                                                            'login'        => ['label' => 'Login', 'rules' => 'required|min_length[3]|max_length[255]'],
                                                            'senha'        => ['label' => 'Senha', 'rules' => 'required|min_length[6]|max_length[12]'],
                                                        ]);

                if ($this->validation->withRequest($this->request)->run()){

                    if($this->setCreate()){
                    $alert = 'success';
                    $message = 'O registro foi cadastrado com sucesso!';
                    }else{
                    $alert = 'error';
                    $message = 'Não foi possível salvar o registro tente novamente!';
                    }

                    $this->session->setFlashdata($alert, $message);
                    return redirect()->to('/Admin/Usuarios/cadastrar');
                }

            }else{
                $alert = 'error';
                $message = 'Não foi possível salvar o registro, tente novamente!';

                $this->session->setFlashdata($alert, $message);
                return redirect()->to('/Admin/Usuarios/cadastrar');
            }
        }
        
        return view('admin/usuarios/crud.php', $this->data);    

    }


    //--------------------------------------------------------------------
    private function setCreate()
    {

        $fields = 	[
                    'nome'  => $this->request->getVar('nome'),
                    'login' => $this->request->getVar('login'),
                    'perfil' => $this->request->getVar('perfil'),
                    'senha' => password_hash($this->request->getVar('senha'), PASSWORD_DEFAULT)
                    ];


        return$this->model->insert($fields, false);


    }

    public function read($id)
    {
        $this->data['type'] = 'read';
        $this->data['title'] = 'Visualizar Registro';
        $this->data['titleBreadcrumb'] = 'Visualizar';
        $this->data['action'] = base_url('Admin/Usuarios/visualizar/'.$id);


        if($this->request->getMethod() === 'post'){

            $record = $this->model->get($id);

            if (!$record) {
                $alert = 'error';
                $message = 'Registro não encontrado!';
                $this->session->setFlashdata($alert, $message);
                return redirect()->back();
            }
        }

        $this->data['record'] = $this->model->get($id);

        return view('admin/usuarios/crud.php', $this->data);

    }

    public function update($id)
    {
        $this->data['type'] = 'update';
        $this->data['title'] = 'Editar Registro';
        $this->data['titleBreadcrumb'] = 'Editar';
        $this->data['action'] = base_url('Admin/Usuarios/editar/'.$id);


        if($this->request->getMethod() === 'post'){

            $senha = "max_length[12]";

            if(!empty($this->request->getVar('senha'))){
                $senha = "min_length[6]|max_length[12]";
            }

            $rules = $this->validation->setRules    ([
                                                        'nome'         => ['label' => 'Nome', 'rules' => 'required|min_length[3]|max_length[255]'],
                                                        'login'        => ['label' => 'Login', 'rules' => 'required|min_length[3]|max_length[255]'],
                                                        'senha'        => ['senha' => 'Senha', 'rules' => $senha]
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

        return view('admin/usuarios/crud.php', $this->data);

    }

    //--------------------------------------------------------------------
    private function setUpdate($id)
    {

        $fields = 	[
                    'nome'  => $this->request->getVar('nome'),
                    'login' => $this->request->getVar('login')
                    ];

        if(!empty($this->request->getVar('senha'))){

            $fields  +=      [
                            'senha' => password_hash($this->request->getVar('senha'), PASSWORD_DEFAULT)
                            ];                    
        } 
        


        if($this->model->update($id, $fields)){

            return true;

        }

        return false;

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

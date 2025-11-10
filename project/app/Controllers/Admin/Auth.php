<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Admin\UsuarioModel;

class Auth extends Controller
{
    public $model, $session;
    //--------------------------------------------------------------------
    public function __construct()
	{

		$this->model	    = new UsuarioModel();
        $this->session     = session();
    
	}

    public function index()
    {
        helper('form');

        return view('admin/auth/login.php');

    }

    public function login()
    {
        helper('form');
        helper('text');
        $alert = NULL;
        $message = NULL;

        if($this->request->getMethod() === 'post'){

            if(csrf_hash() === $this->request->getVar('csrf_test_name'))
            {
                $login = $this->request->getPost('login');
                $senha = $this->request->getPost('senha');

                $user = $this->model->where('login', $login)->first();

                if($user){
                    if(password_verify($senha, $user->senha))
                    {
                        
                        $this->session->userId 	    = $user->id;
                        $this->session->userName	= $user->nome;
                        $this->session->userLogin	= $user->login;
                        $this->session->userPerfil	= $user->perfil;

                        return redirect()->to(base_url('Admin/home'));  
                    }else{
                        $alert = 'error';
                        $message = 'Usuário ou senha incorretos!';
                    }
                }else{
                    $alert = 'error';
                    $message = 'Usuário ou senha incorretos!';
                }
            }else{
                $alert = 'error';
                $message = 'Falha na autenticação!';
            }

            $this->session->setFlashdata($alert, $message);

            return redirect()->to(base_url('Admin/Autenticacao/login'));

        }

    }

    public function logout()
    {

        $this->session->destroy();
        return redirect()->to(base_url('Admin/Autenticacao/login'));

    }

}

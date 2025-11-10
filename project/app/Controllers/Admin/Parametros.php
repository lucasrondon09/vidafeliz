<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Admin\ParametrosModel;

class Parametros extends Controller
{
    public $model, $session, $validation, $data;

    //--------------------------------------------------------------------
    public function __construct()
	{
        helper('form');
        helper('auth');
        permission();
        permissionAdmin();

		$this->model	= new ParametrosModel();
        $this->session  = session();
        $this->validation = \Config\Services::validation();
	}

    //--------------------------------------------------------------------
    public function index()
    {
        $this->data['table'] = $this->model->findAll();

        return view('admin/parametros/index', $this->data);
    }

    public function create()
    {
        $this->data['type'] = 'create';
        $this->data['title'] = 'Cadastrar Registro';
        $this->data['titleBreadcrumb'] = 'Cadastrar';
        $this->data['action'] = base_url('Admin/Parametros/cadastrar/');

        if($this->request->getMethod() === 'post'){

                $rules = $this->validation->setRules    ([
                                                            'chave'         => ['label' => 'Chave', 'rules' => 'required|min_length[3]|max_length[255]'],
                                                            'valor'        => ['label' => 'Valor', 'rules' => 'required|max_length[255]']
                                                        ]);
                $alert = 'error';
                $message = 'Não foi possível salvar o registro tente novamente!';

                if ($this->validation->withRequest($this->request)->run()){
                    

                    if($this->setCreate()){
                        $alert = 'success';
                        $message = 'O registro foi cadastrado com sucesso!';
                    }

                    
                }

                $this->session->setFlashdata($alert, $message);
                return redirect()->back()->withInput();
            
        }

        return view('admin/parametros/crud', $this->data);
    }

    //--------------------------------------------------------------------
    public function setCreate()
    {
        $data = $this->request->getPost();

        return $this->model->insert($data);
    }

    public function read($id)
    {
        $this->data['type'] = 'read';
        $this->data['title'] = 'Visualizar Registro';
        $this->data['titleBreadcrumb'] = 'Visualizar';
        $this->data['action'] = base_url('Admin/Parâmetros/visualizar/'.$id);



        $record = $this->model->find($id);

        if (!$record) {
            $alert = 'error';
            $message = 'Registro não encontrado!';
            $this->session->setFlashdata($alert, $message);
            return redirect()->back();
        }

        $this->data['record'] = $record;

        return view('admin/parametros/crud.php', $this->data);

    }

    public function update($id)
    {
        $this->data['type'] = 'update';
        $this->data['title'] = 'Editar Registro';
        $this->data['titleBreadcrumb'] = 'Editar';
        $this->data['action'] = base_url('Admin/Parametros/editar/'.$id);


        if($this->request->getMethod() === 'post'){

            $rules = $this->validation->setRules    ([
                                                        'chave'         => ['label' => 'Chave', 'rules' => 'required|min_length[3]|max_length[255]'],
                                                        'valor'        => ['label' => 'Valor', 'rules' => 'required|max_length[255]']
                                                    ]);                                                  

            if ($this->validation->withRequest($this->request)->run()){

                $alert = 'error';
                $message = 'Não foi possível atualizar o registro!';

                if($this->setUpdate($id)){
                    $alert = 'success';
                    $message = 'O registro foi atualizado com sucesso!';
                }

                $this->session->setFlashdata($alert, $message);
                return redirect()->back()->withInput();

            }
        }

        $this->data['record'] = $this->model->find($id);

        return view('admin/parametros/crud.php', $this->data);

    }

    //--------------------------------------------------------------------
    private function setUpdate($id)
    {

        $fields = 	$this->request->getVar();

        return $this->model->update($id, $fields);

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

    //--------------------------------------------------------------------
    public function anoLetivo(){
        
        $this->data['ano'] = $this->getAnoLetivo();

        return view('admin/parametros/ano-letivo', $this->data);

    }

    //--------------------------------------------------------------------
    public function getAnoLetivo()
    {
        return $this->model->where('chave', 'ANO_LETIVO')->first();
    }

    //--------------------------------------------------------------------
    public function setAnoLetivo()
    {
        $ano = $this->request->getPost('ano_letivo');
        $this->validation->setRule('ano_letivo', 'Ano Letivo', 'required|is_natural_no_zero');
        if($this->validation->withRequest($this->request)->run() == false)
        {
            $this->session->setFlashdata('error', $this->validation->listErrors());
            return redirect()->back()->withInput();
        }           
        $this->model->where('chave', 'ANO_LETIVO')->set('valor', $ano)->update();
        $this->session->setFlashdata('success', 'Ano letivo atualizado com sucesso!');  
        return redirect()->back();
    }

    //--------------------------------------------------------------------
    public function getMediaEscolar()
    {
        return $this->model->where('chave', 'MEDIA_ESCOLAR')->first();
    }

    //--------------------------------------------------------------------
    public function setMediaEscolar($media)
    {
        $this->model->where('chave', 'MEDIA_ESCOLAR')->set('valor', $media)->update();
    }

    


}

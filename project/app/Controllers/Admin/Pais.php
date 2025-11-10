<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Admin\PaisModel;

class Pais extends Controller
{
    public $model, $session, $validation, $data, $id_familia;
    //--------------------------------------------------------------------
    public function __construct()
	{
        helper('auth');
        helper('form');
        helper('mask');
        permission();
        permissionAdmin();

		$this->model	= new PaisModel();
        $this->session  = session();
        $this->validation = \Config\Services::validation();
	}

    //--------------------------------------------------------------------
    public function index()
    {
        $this->data['table'] = 	$this->model->findAll();

        return view('admin/pais/index.php', $this->data);

    }

    //--------------------------------------------------------------------
    public function create()
    {
        $this->data['type'] = 'create';
        $this->data['title'] = 'Cadastrar Registro';
        $this->data['action'] = base_url('Admin/Pais/cadastrar');
        
        if($this->request->getMethod() === 'post'){

            $alert = 'error';
            $message = 'Não foi possível salvar o registro, tente novamente!';

            $rules = $this->validation->setRules    ([
                                                        'mae_nome'         => ['label' => 'Nome da Mãe', 'rules' => 'required|min_length[3]|max_length[255]']
                                                    ]);

            if ($this->validation->withRequest($this->request)->run()){

                $alert = 'error';
                $message = 'Não foi possível salvar o registro tente novamente!';

                if($this->setCreate()){
                    $alert = 'success';
                    $message = 'O registro foi salvo com sucesso!';
                }

            }

            $this->session->setFlashdata($alert, $message);
            return redirect()->back();

        }

        return view('admin/pais/crud.php', $this->data);

    }


    //--------------------------------------------------------------------
    private function setCreate()
    {
        $fields = $this->request->getVar();

        try {

            $matricula = $this->model->orderBy('matricula', 'DESC')->first();
            $newMatricula = date('Y') . '0001';

            if ($matricula) {
                $lastMatricula = $matricula->matricula;
                $prefix = substr($lastMatricula, 0, 4);
                $number = (int)substr($lastMatricula, 4) + 1;
                $newMatricula = $prefix . str_pad($number, 4, '0', STR_PAD_LEFT);
            }
            
            $fields['matricula'] = $newMatricula;
            $fields['pai_cpf'] = remove_mask_cpf($fields['pai_cpf']);
            $fields['pai_telefone'] = remove_mask_telefone($fields['pai_telefone']);
            $fields['pai_cep'] = remove_mask_cep($fields['pai_cep']);
            $fields['mae_cpf'] = remove_mask_cpf($fields['mae_cpf']);
            $fields['mae_telefone'] = remove_mask_telefone($fields['mae_telefone']);
            $fields['mae_cep'] = remove_mask_cep($fields['mae_cep']);
            $fields['resp_finan_cpf'] = remove_mask_cpf($fields['resp_finan_cpf']);
            $fields['resp_finan_telefone'] = remove_mask_telefone($fields['resp_finan_telefone']);
            $fields['resp_finan_cep'] = remove_mask_cep($fields['resp_finan_cep']);

            return $this->model->insert($fields, false);

        } catch (\Exception $e) {
            
            log_message('error', $e->getMessage());
            return false;
        }

    }

    public function read($id)
    {
        $this->data['type'] = 'read';
        $this->data['title'] = 'Visualizar Registro';
        $this->data['action'] = base_url('Admin/Pais/visualizar/'.$id);

        $record = $this->model->find($id);

        if (!$record) {
            $alert = 'error';
            $message = 'Registro não encontrado!';
            $this->session->setFlashdata($alert, $message);
            return redirect()->back();
        }

        $this->data['record'] = $record;
            
        return view('admin/pais/crud.php', $this->data);
    }

    public function update($id)
    {
        $this->data['type'] = 'update';
        $this->data['title'] = 'Editar Registro';
        $this->data['action'] = base_url('Admin/Pais/editar/'.$id);

        if($this->request->getMethod() === 'post'){

            $rules = $this->validation->setRules    ([
                                                        'mae_nome'         => ['label' => 'Nome da Mãe', 'rules' => 'required|min_length[3]|max_length[255]'],
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

        $this->data['record'] = $this->model->find($id);

        return view('admin/pais/crud.php', $this->data);

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

        if($this->setDelete($id)){
            $alert = 'success';
            $message = 'Registro excluído com sucesso!';

        }else{
            $alert = 'error';
            $message = 'Não foi possível excluir o registro!';

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

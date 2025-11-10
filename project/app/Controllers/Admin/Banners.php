<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Admin\BannerModel;
use CodeIgniter\Files\File;

class Banners extends Controller
{
    public $model, $session, $validation, $data, $modelImagens;
    //--------------------------------------------------------------------
    public function __construct()
	{
        helper('auth');
        permission();

		$this->model	= new BannerModel();
        $this->session  = session();
        $this->validation = \Config\Services::validation();
	}

    //--------------------------------------------------------------------
    public function index()
    {
        helper('form');

        if($this->request->getMethod() === 'post'){
            $search = $this->request->getVar('search');

            $this->data = 	[
                            'table'     => $this->model->like('titulo', $search)
                                                        ->paginate(10),
                            'pager'      => $this->model->pager                                                            
                            ];

        }else{

            $this->data = 	[
                            'table'     => $this->model->paginate(10),
                            'pager'     => $this->model->pager
                            ];
        }

        echo view('admin/template/header.php');
        echo view('admin/template/sidebar.php');
        echo view('admin/banners/index.php', $this->data);
        echo view('admin/template/footer.php');

    }

    //--------------------------------------------------------------------
    public function create()
    {
        helper('form');

       
        
        if($this->request->getMethod() === 'post'){


            if(csrf_hash() === $this->request->getVar('csrf_test_name'))
            {
                
                
                $rules = $this->validation->setRules([     'titulo'         => ['label' => 'Título', 'rules' => 'required|min_length[3]|max_length[255]'],
                                                            'imagem'         => [
                                                            'label' => 'Banner',
                                                            'rules' => [    
                                                                            'uploaded[imagem]',
                                                                            'is_image[imagem]',
                                                                            'mime_in[imagem,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                                                                            'max_size[imagem,100]',
                                                                        ],
                                                            ],
                                                    ]);

                if ($this->validation->withRequest($this->request)->run()){

                    if($this->save()){
                        $alert = 'success';
                        $message = 'O registro foi cadastrado com sucesso!';
                    }else{
                        $alert = 'error';
                        $message = 'Não foi possível salvar o registro tente novamente!';
                    }

                    $this->session->setFlashdata($alert, $message);
                    return redirect()->to('/Admin/Banners/cadastrar');
                }

            }else{
                $alert = 'error';
                $message = 'Não foi possível salvar o registro, tente novamente!';

                $this->session->setFlashdata($alert, $message);
                return redirect()->to('/Admin/Banners/cadastrar');
            }

           

        }

        echo view('admin/template/header.php');
        echo view('admin/template/sidebar.php');
        echo view('admin/banners/create.php');
        echo view('admin/template/footer.php');

    }


    //--------------------------------------------------------------------
    private function save()
    {

        $fields = 	$this->request->getPost();
        $img    = $this->request->getFile('imagem');

        if ($img->isValid() && ! $img->hasMoved()) {
            $newName = $img->getRandomName();

            $img->move(FCPATH . 'uploads/img/', $newName);

            $fields =   [
                        'titulo'        => $this->request->getVar('titulo'),
                        'link'     => $this->request->getVar('link'),
                        'texto'         => $this->request->getVar('texto'),
                        'posicao'       => $this->request->getVar('posicao'),
                        'status'        => $this->request->getVar('status'),
                        'imagem'        => base_url().'/uploads/img/'.$newName
                        ];                   

            if($this->model->insert($fields)){

                return true;
    
            }
        }    

        return false;

    }

    public function edit($id)
    {

        helper('form');

        if($this->request->getMethod() === 'post'){

            $img    = $this->request->getFile('imagem');

            if($img->getSize() != 0){

                $rules = $this->validation->setRules([     'titulo'         => ['label' => 'Título', 'rules' => 'required|min_length[3]|max_length[255]'],
                                                            'imagem'         => [
                                                            'label' => 'Banner',
                                                            'rules' => [
                                                                            'is_image[imagem]',
                                                                            'mime_in[imagem,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                                                                            'max_size[imagem,100]',
                                                                        ],
                                                            ],
                                                    ]);

                
            }else{
                $rules = $this->validation->setRules([     'titulo'         => ['label' => 'Título', 'rules' => 'required|min_length[3]|max_length[255]']]);
            }                                                 

            if ($this->validation->withRequest($this->request)->run()){

                if($this->update($id)){
                    $alert = 'success';
                    $message = 'O registro foi atualizado com sucesso!';
                }else{
                    $alert = 'error';
                    $message = 'Não foi possível atualizar o registro!';
                }

                $this->session->setFlashdata($alert, $message);
                return redirect()->to('/Admin/Banners/editar/'.$id);

            }
        }

        $this->data = 	[
                        'field'     => $this->model->get($id)
                        ];

        echo view('admin/template/header.php');
        echo view('admin/template/sidebar.php');
        echo view('admin/banners/edit.php', $this->data);
        echo view('admin/template/footer.php');

    }

    //--------------------------------------------------------------------
    private function update($id)
    {

        


        $fields =   [
                    'titulo'        => $this->request->getVar('titulo'),
                    'link'          => $this->request->getVar('link'),
                    'texto'         => $this->request->getVar('texto'),
                    'posicao'       => $this->request->getVar('posicao'),
                    'status'        => $this->request->getVar('status')
                    ];
        
        $img    = $this->request->getFile('imagem');

        if($img->getSize() != 0){


            if ($img->isValid() && ! $img->hasMoved()) {

                $newName = $img->getRandomName();
    
                $img->move(FCPATH . 'uploads/img/', $newName);
    
                $fields +=     [
                                'imagem'        => base_url().'/uploads/img/'.$newName
                                ];

            }
        }

        if($this->model->update($id, $fields)){
    
            return true;

        }

        return false;

        $fields = 	$this->request->getPost();

        if($this->model->update($id, $fields)){

            return true;

        }

        return false;

    }

    //--------------------------------------------------------------------
    public function delete($id)
    {

        if($this->deleted($id)){
            $alert = 'success';
            $message = 'Registro excluído com sucesso!';

        }else{
            $alert = 'error';
            $message = 'Não foi possível excluir o registro!';

        }

        $this->session->setFlashdata($alert, $message);
        return redirect()->to('/Admin/Banners');

    }

    //--------------------------------------------------------------------
    private function deleted($id)
    {

        $delete = $this->model->delete($id);

        if($delete){

            return true;

        }
    
        return false;

    }


    //--------------------------------------------------------------------
    public function upload()
    {

        
        
        if($this->request->getMethod() === 'post'){

            $data = $this->request->getVar('image');

            $image_array_1 = explode(";", $data);

            $image_array_2 = explode(",", $image_array_1[1]);

            $data = base64_decode($image_array_2[1]);

            $imageName = 'assets/dist/img/' . time() . '.png';

            file_put_contents(FCPATH.$imageName, $data);

            echo base_url($imageName);


            


        }
        
    }

    //--------------------------------------------------------------------
    public function galery($id)
    {

        helper('form');

        $this->data =   [
                        'field'     => $this->model->get($id),
                        'images'    => $this->modelImagens->where('idNoticia', $id)->find()
                        ];

        echo view('admin/template/header.php');
        echo view('admin/template/sidebar.php');
        echo view('admin/noticias/galery.php', $this->data);
        echo view('admin/template/footer.php');
       
        
    }


}

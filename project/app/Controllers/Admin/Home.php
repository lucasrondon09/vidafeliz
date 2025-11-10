<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Admin\EmpresaModel;


class Home extends Controller
{
    public $data;
    public function __construct()
	{
		
	}

    public function index()
    {
        helper('auth');
        permission();

        $modelEmpresa = new EmpresaModel();
        

        $this->data	=	[
                        'empresa' => $modelEmpresa->first()       
                        ];

        return view('admin/home/index.php', $this->data);
    }

    public function editarEmpresa() {

        try {
            $modelEmpresa = new EmpresaModel();
            $fields = $this->request->getVar();

            $modelEmpresa->update($fields['id'], $fields);

            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back();
        }

        
        
    }

    public function sobre()
    {
        helper('auth');
        permission();                      
        
        return view('admin/home/sobre.php');

    }
}

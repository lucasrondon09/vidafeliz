<?php

namespace App\Controllers\Site;

use CodeIgniter\Controller;

class Home extends Controller
{
    public function index()
    {
        
       return redirect()->to(base_url('/Admin'));
    }
}

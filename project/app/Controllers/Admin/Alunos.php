<?php

namespace App\Controllers\Admin;

use App\Models\Admin\AlunosModel;
use CodeIgniter\Controller;
use App\Models\Admin\PaisModel;
use App\Models\Admin\TurmasModel;
use App\Models\Admin\AlunosTurmasModel;
use App\Models\Admin\ParametrosModel;
use App\Models\Admin\HistoricoEscolarModel;
use App\Models\Admin\HistoricoEscolarNotasModel;

class Alunos extends Controller
{
    public $paisModel, $alunosModel, $turmasModel, $alunosTurmaModel, $historicoEscolar, $historicoEscolarNotas, $session, $validation, $data, $idTurma;
    //--------------------------------------------------------------------
    public function __construct()
	{
        helper('auth');
        helper('form');
        helper('mask');
        helper('parametros');
        permission();
        permissionAdmin();

		$this->paisModel	= new PaisModel();
		$this->alunosModel	= new AlunosModel();
        $this->turmasModel	= new TurmasModel();
        $this->alunosTurmaModel	= new AlunosTurmasModel();
        $this->historicoEscolar = new HistoricoEscolarModel();
        $this->historicoEscolarNotas = new HistoricoEscolarNotasModel();
        $this->session  = session();
        $this->validation = \Config\Services::validation();

        $this->data['turmas'] = $this->turmasModel->get();
	}

    

    //--------------------------------------------------------------------
    public function index($idPai = null)
    {

        $this->data['table'] = 	$this->alunosModel->select('alunos.*, turma_aluno.id_turma, turmas.nome as nome_turma, turmas.ano_letivo as ano_turma, turmas.periodo as periodo_turma')
                                                    ->join('turma_aluno', 'turma_aluno.id_aluno = alunos.id', 'left')
                                                    ->join('turmas', 'turmas.id = turma_aluno.id_turma', 'left')
                                                    ->where('alunos.deleted_at is null')
                                                    ->orderBy('turmas.ano_letivo', 'DESC')
                                                    ->findAll();

        if(!empty($idPai)){

            $this->data['table'] = 	$this->alunosModel
                                                        ->select('alunos.*, turma_aluno.id_turma, turmas.nome as nome_turma, turmas.ano_letivo as ano_turma, turmas.periodo as periodo_turma')
                                                        ->join('turma_aluno', 'turma_aluno.id_aluno = alunos.id', 'left')
                                                        ->join('turmas', 'turmas.id = turma_aluno.id_turma', 'left')
                                                        ->where('turma_aluno.deleted_at is null')
                                                        ->where('id_pai', $idPai)
                                                        ->orderBy('turmas.ano_letivo', 'DESC')
                                                        ->findAll();

        }

        $this->data['id_pai'] = $idPai;

        return view('admin/alunos/index.php', $this->data);

    }

    //--------------------------------------------------------------------
    public function create($idPai)
    {
        $this->data['type'] = 'create';
        $this->data['title'] = 'Cadastrar Registro';
        $this->data['titleBreadcrumb'] = 'Cadastrar';
        $this->data['action'] = base_url('Admin/Alunos/cadastrar/'.$idPai);
        $this->data['id_pai'] = $idPai;
        


        if($this->request->getMethod() === 'post'){

            $alert = 'error';
            $message = 'Não foi possível salvar o registro, tente novamente!';

            $rules = $this->validation->setRules    ([
                                                        'nome'         => ['label' => 'Nome', 'rules' => 'required|min_length[3]|max_length[255]']
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

        return view('admin/alunos/crud.php', $this->data);

    }


    //--------------------------------------------------------------------
    private function setCreate()
    {

        $fields = $this->request->getVar();
        
        try {


            $matricula = $this->alunosModel->orderBy('matricula', 'DESC')->first();
            $newMatricula = date('Y') . '0001';
    
            if ($matricula) {
                $lastMatricula = $matricula->matricula;
                $prefix = substr($lastMatricula, 0, 4);
                $number = (int)substr($lastMatricula, 4) + 1;
                $newMatricula = $prefix . str_pad($number, 4, '0', STR_PAD_LEFT);
            }
            
            $fields['matricula'] = $newMatricula;
            $fields['cpf'] = remove_mask_cpf($fields['cpf']);
            $fields['telefone'] = remove_mask_telefone($fields['telefone']);
            $fields['cep'] = remove_mask_cep($fields['cep']);
            $fields['id_pai'] = $this->data['id_pai'];
            
            

            $idAluno =  $this->alunosModel->insert($fields);

            if($fields['turma'] != 0){

                $fieldsAlunoTurma = [
                    'id_aluno' => $idAluno,
                    'id_turma' => (int)$fields['turma'],
                    'ano_letivo' => (new ParametrosModel())->getAnoLetivo()->valor,       
                ];
                
                $this->alunosTurmaModel->insert($fieldsAlunoTurma);

            }

            return true;

        } catch (\Exception $e) {
            
            log_message('error', $e->getMessage());
            return false;
        }

    }

    public function read($id, $idPai = null)
    {

        $this->data['type'] = 'read';
        $this->data['title'] = 'Visualizar Registro';
        $this->data['titleBreadcrumb'] = 'Visualizar';
        $this->data['action'] = base_url('Admin/Alunos/visualizar/'.$id);
        $this->data['id_pai'] = !empty($idPai) ? $idPai : '';

        $record = $this->alunosModel->find($id);

        if (!$record) {
            $alert = 'error';
            $message = 'Registro não encontrado!';
            $this->session->setFlashdata($alert, $message);
            return redirect()->back();
        }

        $this->data['record'] = $record;
        
        $turmaAluno = $this->alunosTurmaModel->getTurmaByAlunoId($id);

        $this->data['turma_aluno'] = !empty($turmaAluno) ? $turmaAluno->id_turma : '';
            
        return view('admin/alunos/crud.php', $this->data);
    }

    public function update($id, $id_pai =null)
    {
        $this->data['type'] = 'update';
        $this->data['title'] = 'Editar Registro';
        $this->data['titleBreadcrumb'] = 'Editar';
        $this->data['action'] = base_url('Admin/Alunos/editar/'.$id);
        $this->data['id_pai'] = !empty($id_pai) ? $id_pai : '';

        if($this->request->getMethod() === 'post'){

            $rules = $this->validation->setRules    ([
                                                        'nome'         => ['label' => 'Nome', 'rules' => 'required|min_length[3]|max_length[255]'],
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

        $this->data['record'] = $this->alunosModel->find($id);

        $turmaAluno = $this->alunosTurmaModel->getTurmaByAlunoId($id);

        $this->data['turma_aluno'] = !empty($turmaAluno) ? $turmaAluno : '';

        return view('admin/alunos/crud.php', $this->data);

    }

    //--------------------------------------------------------------------
    private function setUpdate($id)
    {
        $fields = 	$this->request->getVar();

        try {

            $fields['cpf'] = remove_mask_cpf($fields['cpf']);
            $fields['telefone'] = remove_mask_telefone($fields['telefone']);
            $fields['cep'] = remove_mask_cep($fields['cep']);

            if($fields['turma'] != 0){
                $alunoTurma = $this->alunosTurmaModel->getTurmaByAlunoId($id);

                $fieldsAlunoTurma = [
                    'id_aluno' => $id,
                    'id_turma' => (int)$fields['turma'],
                    'ano_letivo' => (int)(new ParametrosModel())->getAnoLetivo()->valor       
                ];

                if(!empty($alunoTurma)){
                    
                    $this->alunosTurmaModel->update($alunoTurma->id, $fieldsAlunoTurma);

                }else{
                    
                    $this->alunosTurmaModel->insert($fieldsAlunoTurma);
                }

                $this->alunosModel->update($id, $fields);

                return true;

            }

        } catch (\Exception $e) {
            
            log_message('error', $e->getMessage());
            return false;
        }
        
        

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

        return $this->alunosModel->delete($id) ? true : false;

    }

    //--------------------------------------------------------------------
    public function cancelarMatricula($id)
    {

        $alert = 'error';
        $message = 'Não foi possível excluir a turma!';

        $excluirTurma = $this->alunosTurmaModel->where('id', $id)->delete(null, true) ? true : false;
        if($excluirTurma){

            $alert = 'success';
            $message = 'Turma excluída com sucesso!';

        }

        $this->session->setFlashdata($alert, $message);
        return redirect()->back();
    

    }

    //--------------------------------------------------------------------
    public function historicoEscolar($idAluno)
    {
        
        $this->data['title'] = 'Histórico Escolar';
        $this->data['titleBreadcrumb'] = 'Histórico Escolar';
        $this->data['idAluno'] = $idAluno;
        $this->data['aluno'] = 	$this->alunosModel->find($idAluno);

        $this->data['table'] = $this->historicoEscolar->where('id_aluno', $idAluno)->findAll();
        

        return view('admin/alunos/historico_escolar.php', $this->data);
    }

    //--------------------------------------------------------------------
    public function historicoEscolarCreate($idAluno){

        $this->data['title'] = 'Histórico Escolar';
        $this->data['titleBreadcrumb'] = 'Histórico Escolar';
        $this->data['type'] = 'create';
        $this->data['idAluno'] = $idAluno;
        $this->data['aluno'] = 	$this->alunosModel->find($idAluno);
        $this->data['action'] = base_url('Admin/Alunos/historico-escolar/set-create/'.$idAluno);

        

        return view('admin/alunos/historico_escolar_crud.php', $this->data);
    }

    //--------------------------------------------------------------------
    public function historicoEscolarRead($id){

        $this->data['title'] = 'Histórico Escolar';
        $this->data['titleBreadcrumb'] = 'Histórico Escolar';
        $this->data['type'] = 'read';
        $this->data['action'] = base_url('Admin/Alunos/historico-escolar/visualizar/'.$id);

        $record = $this->historicoEscolar->find($id);

        if (!$record) {
            $alert = 'error';
            $message = 'Registro não encontrado!';
            $this->session->setFlashdata($alert, $message);
            return redirect()->back();
        }

        $this->data['record'] = $record;
        $this->data['idAluno'] = $record->id_aluno;
        $this->data['aluno'] = 	$this->alunosModel->find($record->id_aluno);
            
        return view('admin/alunos/historico_escolar_crud.php', $this->data);
    }

    public function historicoEscolarUpdate($id){

        $this->data['title'] = 'Histórico Escolar';
        $this->data['titleBreadcrumb'] = 'Histórico Escolar';
        $this->data['type'] = 'update';
        $this->data['action'] = base_url('Admin/Alunos/historico-escolar/editar/'.$id);

        if($this->request->getMethod() === 'post'){

            $rules = $this->validation->setRules    ([
                                                        'estabelecimento'         => ['label' => 'Estabelecimento', 'rules' => 'required|min_length[3]|max_length[255]'],
                                                        'ano'                     => ['label' => 'Ano', 'rules' => 'required|integer'],
                                                        'turma'                   => ['label' => 'Turma', 'rules' => 'required|min_length[1]|max_length[100]'],
                                                        'municipio'               => ['label' => 'Municipio', 'rules' => 'required|min_length[3]|max_length[255]'],
                                                        'uf'                      => ['label' => 'UF', 'rules' => 'required|min_length[2]|max_length[2]'],
                                                    ]);                                                  

            if ($this->validation->withRequest($this->request)->run()){

                $alert = 'error';
                $message = 'Não foi possível atualizar o registro!';

                if($this->setHistoricoEscolarUpdate($id)){
                    $alert = 'success';
                    $message = 'O registro foi atualizado com sucesso!';
                }

                $this->session->setFlashdata($alert, $message);
                return redirect()->back();

            }
        }

        $record = $this->historicoEscolar->find($id);

        if (!$record) {
            $alert = 'error';
            $message = 'Registro não encontrado!';
            $this->session->setFlashdata($alert, $message);
            return redirect()->back();
        }

        $this->data['record'] = $record;
        $this->data['idAluno'] = $record->id_aluno;
        $this->data['aluno'] = 	$this->alunosModel->find($record->id_aluno);
            
        return view('admin/alunos/historico_escolar_crud.php', $this->data);
    }


    public function setHistoricoEscolarUpdate($id){

        $fields = 	$this->request->getVar();

        try {

            $this->historicoEscolar->update($id, $fields);

            return true;

        } catch (\Exception $e) {
            
            log_message('error', $e->getMessage());
            return false;
        }
        
    }

    public function historicoEscolarDelete($id){

        $record = $this->historicoEscolar->find($id);

        if (!$record) {
            $alert = 'error';
            $message = 'Registro não encontrado!';
            $this->session->setFlashdata($alert, $message);
            return redirect()->back();
        }

        if($this->historicoEscolar->delete($id)){
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
    public function historicoEscolarSetCreate($idAluno){

        $alert = 'error';
        $message = 'Não foi possível salvar o registro, tente novamente!';

        $rules = $this->validation->setRules    ([
                                                    'estabelecimento'         => ['label' => 'Estabelecimento', 'rules' => 'required|min_length[3]|max_length[255]'],
                                                    'ano'                     => ['label' => 'Ano', 'rules' => 'required|integer'],
                                                    'turma'                   => ['label' => 'Turma', 'rules' => 'required|min_length[1]|max_length[100]'],
                                                    'municipio'               => ['label' => 'Municipio', 'rules' => 'required|min_length[3]|max_length[255]'],
                                                    'uf'                      => ['label' => 'UF', 'rules' => 'required|min_length[2]|max_length[2]'],
                                                ]);

                                                

        if ($this->validation->withRequest($this->request)->run()){

            $alert = 'error';
            $message = 'Não foi possível salvar o registro, tente novamente!';

            try {

                $fields = $this->request->getVar();
                $fields['id_aluno'] = $idAluno;

                $this->historicoEscolar->insert($fields);

                $alert = 'success';
                $message = 'O registro foi salvo com sucesso!';

            } catch (\Exception $e) {

                $alert = 'error';
                $message = 'Não foi possível salvar o registro, tente novamente!';

            }

        }else{

            $alert = 'error';
            $message = $this->validation->listErrors();

        }

        $this->session->setFlashdata($alert, $message);
        return redirect()->back();

    }

    //--------------------------------------------------------------------
    public function historicoEscolarNotas($idHistorico){


        $this->data['title'] = 'Disciplinas e Notas';
        $this->data['titleBreadcrumb'] = 'Disciplinas e Notas';
        $this->data['idHistorico'] = $idHistorico;

        $historico = $this->historicoEscolar->find($idHistorico);

        if (!$historico) {
            $alert = 'error';
            $message = 'Registro não encontrado!';
            $this->session->setFlashdata($alert, $message);
            return redirect()->back();
        }

        $this->data['aluno'] = 	$this->alunosModel->find($historico->id_aluno);
        $this->data['idAluno'] = $historico->id_aluno;

        $this->data['table'] = $this->historicoEscolarNotas->getNotasByHistoricoId($idHistorico);
        
        return view('admin/alunos/disciplinas_notas.php', $this->data);
    }

    //--------------------------------------------------------------------
    public function historicoEscolarNotasCreate($idHistorico){


        $this->data['title'] = 'Disciplinas e Notas';
        $this->data['titleBreadcrumb'] = 'Disciplinas e Notas';
        $this->data['type'] = 'create';
        $this->data['idHistorico'] = $idHistorico;
        $this->data['action'] = base_url('Admin/Alunos/historico-escolar/disciplinas-notas/cadastrar/'.$idHistorico);

        if($this->request->getMethod() === 'post'){


            $rules = $this->validation->setRules    ([
                                                        'id_disciplina'         => ['label' => 'Disciplina', 'rules' => 'required|integer'],
                                                        'nota'                  => ['label' => 'Nota', 'rules' => 'required'],
                                                    ]);                                                  

            if ($this->validation->withRequest($this->request)->run()){

                $alert = 'error';
                $message = 'Não foi possível salvar o registro!';

                if($this->setHistoricoEscolarNotasCreate($idHistorico)){
                    $alert = 'success';
                    $message = 'O registro foi salvo com sucesso!';
                }

                $this->session->setFlashdata($alert, $message);
                return redirect()->back();

            }
        }

        $historico = $this->historicoEscolar->find($idHistorico);

        if (!$historico) {
            $alert = 'error';
            $message = 'Registro não encontrado!';
            $this->session->setFlashdata($alert, $message);
            return redirect()->back();
        }

        $this->data['aluno'] = 	$this->alunosModel->find($historico->id_aluno);
        $this->data['idAluno'] = $historico->id_aluno;

        $this->data['disciplinas'] = (new \App\Models\Admin\DisciplinasModel())->where('deleted_at', null)->findAll();

        return view('admin/alunos/disciplinas_notas_crud.php', $this->data);
    }


    //--------------------------------------------------------------------
    public function setHistoricoEscolarNotasCreate($idHistorico){

        $fields = 	$this->request->getVar();
        $fields['id_historico'] = $idHistorico;

        try {

            $this->historicoEscolarNotas->insert($fields);

            return true;

        } catch (\Exception $e) {
            
            log_message('error', $e->getMessage());
            return false;
        }
        
    }

    //--------------------------------------------------------------------
    public function historicoEscolarNotasRead($id){

        $this->data['title'] = 'Disciplinas e Notas';
        $this->data['titleBreadcrumb'] = 'Disciplinas e Notas';
        $this->data['type'] = 'read';
        $this->data['action'] = base_url('Admin/Alunos/historico-escolar/disciplinas-notas/visualizar/'.$id);

        $record = $this->historicoEscolarNotas->find($id);

        if (!$record) {
            $alert = 'error';
            $message = 'Registro não encontrado!';
            $this->session->setFlashdata($alert, $message);
            return redirect()->back();
        }

        $historico = $this->historicoEscolar->find($record->id_historico);

        if (!$historico) {
            $alert = 'error';
            $message = 'Registro não encontrado!';
            $this->session->setFlashdata($alert, $message);
            return redirect()->back();
        }

        $this->data['record'] = $record;
        $this->data['idHistorico'] = $record->id_historico;
        $this->data['aluno'] = 	$this->alunosModel->find($historico->id_aluno);
        $this->data['idAluno'] = $historico->id_aluno;
        $this->data['disciplinas'] = (new \App\Models\Admin\DisciplinasModel())->where('deleted_at', null)->findAll();

        return view('admin/alunos/disciplinas_notas_crud.php', $this->data);
    }


    //--------------------------------------------------------------------
    public function historicoEscolarNotasUpdate($id){

        $this->data['title'] = 'Disciplinas e Notas';
        $this->data['titleBreadcrumb'] = 'Disciplinas e Notas';
        $this->data['type'] = 'update';
        $this->data['action'] = base_url('Admin/Alunos/historico-escolar/disciplinas-notas/editar/'.$id);

        if($this->request->getMethod() === 'post'){

            $rules = $this->validation->setRules    ([
                                                        'id_disciplina'         => ['label' => 'Disciplina', 'rules' => 'required|integer'],
                                                        'nota'                  => ['label' => 'Nota', 'rules' => 'required'],
                                                    ]);                                                  

            if ($this->validation->withRequest($this->request)->run()){

                $alert = 'error';
                $message = 'Não foi possível atualizar o registro!';

                if($this->setHistoricoEscolarNotasUpdate($id)){
                    $alert = 'success';
                    $message = 'O registro foi atualizado com sucesso!';
                }

                $this->session->setFlashdata($alert, $message);
                return redirect()->back();

            }
        }

        $record = $this->historicoEscolarNotas->find($id);

        if (!$record) {
            $alert = 'error';
            $message = 'Registro não encontrado!';
            $this->session->setFlashdata($alert, $message);
            return redirect()->back();
        }

        $historico = $this->historicoEscolar->find($record->id_historico);

        if (!$historico) {
            $alert = 'error';
            $message = 'Registro não encontrado!';
            $this->session->setFlashdata($alert, $message);
            return redirect()->back();
        }

        $this->data['record'] = $record;
        $this->data['idHistorico'] = $record->id_historico;
        $this->data['aluno'] = 	$this->alunosModel->find($historico->id_aluno);
        $this->data['idAluno'] = $historico->id_aluno;

        $this->data['disciplinas'] = (new \App\Models\Admin\DisciplinasModel())->where('deleted_at', null)->findAll();


      return view('admin/alunos/disciplinas_notas_crud.php', $this->data);
    }   

    //--------------------------------------------------------------------
    public function setHistoricoEscolarNotasUpdate($id){

        $fields = 	$this->request->getVar();

        try {

            $this->historicoEscolarNotas->update($id, $fields);

            return true;

        } catch (\Exception $e) {
            
            log_message('error', $e->getMessage());
            return false;
        }
    }
    
    //--------------------------------------------------------------------
    public function historicoEscolarNotasDelete($id){

        $record = $this->historicoEscolarNotas->find($id);

        if (!$record) {
            $alert = 'error';
            $message = 'Registro não encontrado!';
            $this->session->setFlashdata($alert, $message);
            return redirect()->back();
        }

        if($this->historicoEscolarNotas->delete($id)){
            $alert = 'success';
            $message = 'Registro excluído com sucesso!';

        }else{
            $alert = 'error';
            $message = 'Não foi possível excluir o registro!';

        }

        $this->session->setFlashdata($alert, $message);
        return redirect()->back();

    }


}

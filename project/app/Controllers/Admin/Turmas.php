<?php

namespace App\Controllers\Admin;


use CodeIgniter\Controller;
use App\Models\Admin\TurmasModel;
use App\Models\Admin\AlunosTurmasModel;
use App\Models\Admin\ParametrosModel;
use App\Models\Admin\AlunosModel;
use App\Models\Admin\UsuarioModel;
use App\Models\Admin\TurmaProfessorModel;
use App\Models\Admin\TurmaDisciplinaModel;
use App\Models\Admin\TurmaDisciplinaProfessorModel;
use App\Models\Admin\AlunosNotasModel;
use App\Models\Admin\AlunosFaltasModel;
use App\Models\Admin\DisciplinasModel;
use App\Models\Admin\AlunosInfoComplementaresModel;
use App\Models\Admin\AvaliacaoIndividualModel;
use App\Models\Admin\AvaliacaoIndividualAlunoTurmaModel;

class Turmas extends Controller
{
    public $model, $usuariosModel, $turmaProfessorModel, $modelAlunosTurma, $disciplinasModel, $disciplinasTurmaModel, $turmaDisciplinaProfessor, $alunosModel, $alunosFaltasModel, $alunosNotasModel,$session, $validation, $data;
    
    //--------------------------------------------------------------------
    public function __construct()
	{
        helper('auth');
        helper('form');
        helper('parametros');
        permission();

		$this->model	= new TurmasModel();
		$this->usuariosModel	= new UsuarioModel();
		$this->modelAlunosTurma	= new AlunosTurmasModel();
        $this->disciplinasTurmaModel = new TurmaDisciplinaModel();
        $this->disciplinasModel = new DisciplinasModel();
        $this->alunosModel = new AlunosModel();
        $this->alunosNotasModel = new AlunosNotasModel();
        $this->alunosFaltasModel = new AlunosFaltasModel();
        $this->turmaDisciplinaProfessor = new TurmaDisciplinaProfessorModel();
        $this->turmaProfessorModel = new TurmaProfessorModel();
        $this->session  = session();
        $this->validation = \Config\Services::validation();
	}

    //--------------------------------------------------------------------
    public function index()
    {
        
        $this->data['title'] = 'Turmas';
        $this->data['titleBreadcrumb'] = 'Turmas';
        $this->data['actionCreate'] = base_url('Admin/Turmas/cadastrar');    
        $this->data['actionSearch'] = base_url('Admin/Turmas');    


        $parametrosModel = new ParametrosModel();
		$anoLetivo = $parametrosModel->getAnoLetivo();

        $this->data['table'] = 	$this->model->get();
        if(session()->userPerfil == 3){ // Se for professor

            $this->data['table'] = 	$this->model->getTurmasByProfessor();
            $this->data['table'] += $this->turmaProfessorModel->getTurmasByProfessor();
            
        }

        return view('admin/turmas/index.php', $this->data);

    }

    //--------------------------------------------------------------------
    public function professoresTurmas($idTurma)
    {

        $this->data['table'] = 	$this->alunosModel->select('alunos.*, turma_aluno.id_turma, turmas.nome as nome_turma, turmas.ano_letivo as ano_turma, turmas.periodo as periodo_turma')
                                                    ->join('turma_aluno', 'turma_aluno.id_aluno = alunos.id')
                                                    ->join('turmas', 'turmas.id = turma_aluno.id_turma', 'left')
                                                    ->where('turma_aluno.id_turma', $idTurma)
                                                    ->where('turma_aluno.deleted_at is null')
                                                    ->findAll();

        $this->data['id_turma'] = $idTurma;
        $this->data['url'] = base_url('Admin/Turmas');

        $modelUsuarios = new UsuarioModel();
        $this->data['professores'] = $modelUsuarios->getProfessores();
        $this->data['professoresTurma'] = $modelUsuarios->getProfessoresByTurma($idTurma);

       return view('admin/turmas/professores.php', $this->data);
    }

    //--------------------------------------------------------------------
    public function incluirProfessor()
    {

        try {

            
            $fields['id_turma'] = $this->request->getVar('id_turma');
            $fields['id_disciplina'] = $this->request->getVar('id_disciplina');
            $professores = 	$this->request->getVar('id_professor');


            foreach ($professores as $professor) {
                $fields['id_usuario'] = $professor;
    
                $exists = $this->turmaDisciplinaProfessor->where('id_turma', $fields['id_turma'])
                                                         ->where('id_disciplina', $fields['id_disciplina'] )
                                                         ->where('id_usuario', $fields['id_usuario'] )
                                                         ->first();                   
    
                if(!$exists){

                    $this->turmaDisciplinaProfessor->insert($fields);
    
                }
    
            }

    } catch (\Exception $e) {

        $alert = 'error';
        $message = 'Erro: ' . $e->getMessage();

        $this->session->setFlashdata($alert, $message);
    }

    
    return redirect()->back();

    }

    public function removerProfessor($idTurma, $idDisciplina, $idProfessor)
    {

        $alert = 'error';
        $message = 'Não foi possível excluir o registro!';

        if($this->turmaDisciplinaProfessor->where('id_turma', $idTurma)
                                          ->where('id_disciplina', $idDisciplina)
                                          ->where('id_usuario', $idProfessor)
                                          ->delete()){
            $alert = 'success';
            $message = 'Professor removido com sucesso!';

        }

        $this->session->setFlashdata($alert, $message);
        return redirect()->back();

    }

    //--------------------------------------------------------------------
    public function excluirProfessor($id)
    {
        $alert = 'error';
        $message = 'Não foi possível excluir o registro!';

        $modelTurmaProfessor = new TurmaProfessorModel();

        if($modelTurmaProfessor->delete($id)){
            $alert = 'success';
            $message = 'Registro excluído com sucesso!';

        }

        $this->session->setFlashdata($alert, $message);
        return redirect()->back();

    }

    //--------------------------------------------------------------------
    public function alunosTurmas($idTurma)
    {
        permissionAdmin();

        $this->data['table'] = 	$this->alunosModel->select('alunos.*, turma_aluno.id_turma, turmas.nome as nome_turma, turmas.ano_letivo as ano_turma, turmas.periodo as periodo_turma')
                                                    ->join('turma_aluno', 'turma_aluno.id_aluno = alunos.id')
                                                    ->join('turmas', 'turmas.id = turma_aluno.id_turma', 'left')
                                                    ->where('turma_aluno.id_turma', $idTurma)
                                                    ->where('turma_aluno.deleted_at is null')
                                                    ->findAll();

        $parametrosModel = new ParametrosModel();
        $anoLetivo = $parametrosModel->getAnoLetivo()->valor;

        $subqueryMatriculadoEmQualquerAno = $this->alunosModel->builder()
            ->db()
            ->table('turma_aluno')
            ->select('1')
            ->where('turma_aluno.id_aluno = alunos.id'); // EXISTE alguma matrícula

        $subqueryMatriculadoNoAnoAtual = $this->alunosModel->builder()
            ->db()
            ->table('turma_aluno')
            ->select('1')
            ->where('turma_aluno.id_aluno = alunos.id')
            ->where('turma_aluno.ano_letivo', $anoLetivo); // MATRICULADO EM 2025

        $this->data['alunos'] = $this->alunosModel
            ->builder()
            ->where("NOT EXISTS (" . $subqueryMatriculadoNoAnoAtual->getCompiledSelect(false) . ")", null, false)
            ->where('alunos.deleted_at IS NULL')
            ->get()
            ->getResult();
                                        
        $this->data['id_turma'] = $idTurma;
        $this->data['url'] = base_url('Admin/Turmas');

       return view('admin/turmas/alunos.php', $this->data);
    }

    public function incluirAluno()
    {
        

        try {

            $fields['id_turma'] = $this->request->getVar('id_turma');
            $alunos = 	$this->request->getVar('id_aluno');

            $anoLetivo = new ParametrosModel();
            $fields['ano_letivo'] = $anoLetivo->getAnoLetivo()->valor;

            $nomeAluno = [];
            foreach ($alunos as $aluno) {
                $fields['id_aluno'] = $aluno;
    
                $exists = $this->modelAlunosTurma->where('id_aluno', $fields['id_aluno'] )
                                                 ->where('ano_letivo', $fields['ano_letivo'])
                                                 ->first();                   
                if(!$exists){

                    $alert = 'success';
                    $message = 'O registro foi cadastrado com sucesso!';
                    
                    $this->modelAlunosTurma->insert($fields);
    
                }else{

                    $nomeAluno[] = $this->alunosModel->find($fields['id_aluno'])->nome;
                    
                }
                
    
            }
            
            if(!empty($nomeAluno) && count($nomeAluno) > 0){
                $alert = 'error';
                $message = 'Os seguintes alunos já estão cadastrados: '.implode(", ", $nomeAluno);

                $this->session->setFlashdata($alert, $message); 
                return redirect()->to(base_url('Admin/Turmas/alunos/'.$fields['id_turma']));
            
            }

        } catch (\Exception $e) {

            $alert = 'error';
            $message = 'Não foi possível cadastrar o registro!';
            

        }

        $this->session->setFlashdata($alert, $message);
        return redirect()->to(base_url('Admin/Turmas/alunos/'.$fields['id_turma']));

    }

    //--------------------------------------------------------------------
    public function transferirAluno($idTurma, $idAluno)
    {

        $this->data['aluno'] = $this->alunosModel->find($idAluno);
        $this->data['turmas'] = $this->model->get();
        $this->data['id_turma'] = $idTurma;
        $this->data['id_aluno'] = $idAluno;  

        $this->data['idAlunoTurma'] = $this->modelAlunosTurma->getIdByTurmaIdAndAlunoId($idTurma, $idAluno);

        $idTurmaAluno = $this->modelAlunosTurma->getTurmaByAlunoId($idAluno);
        $this->data['turma_atual'] = "Sem turma";
        if($this->data['idAlunoTurma']){

            $turmaAtualAluno = $this->model->find($idTurmaAluno->id_turma);
            $this->data['turma_atual'] = $turmaAtualAluno->nome;
        }


        if($this->request->getMethod() === 'post'){

            $rules = $this->validation->setRules    ([
                                                        'turma'         => ['label' => 'Turma', 'rules' => 'required|min_length[1]|max_length[255]'],
                                                    ]);                                                  

            if ($this->validation->withRequest($this->request)->run()){

                $alert = 'error';
                $message = 'Não foi possível atualizar o registro!';

                if($this->setTransferir($this->data['idAlunoTurma'])){
                    $alert = 'success';
                    $message = 'O registro foi atualizado com sucesso!';
                }

                $this->session->setFlashdata($alert, $message);
                return redirect()->back();

            }
        }

        return view('admin/turmas/transferir-aluno.php', $this->data);

    }

    //--------------------------------------------------------------------
    public function infoComplementarAluno($idTurma, $idAluno)
    {

        $this->data['aluno'] = $this->alunosModel->find($idAluno);
        $this->data['id_turma'] = $idTurma;
        $this->data['id_aluno'] = $idAluno;  
        $this->data['turma_atual'] = $this->model->find($idTurma)->nome;
        $modelAlunosInfoCompletares = new AlunosInfoComplementaresModel();

        $this->data['info'] = $modelAlunosInfoCompletares->getInfoCompletaresByAlunoId($idAluno, $idTurma);

        if($this->request->getMethod() === 'post'){

            try {

                $modelAlunosInfoCompletares->insert(
                [
                    'id_aluno' => $idAluno,
                    'id_turma' => $idTurma,
                    'observacao' => $this->request->getVar('observacao'),
                    'situacao' => $this->request->getVar('situacao')
                ]);


                $alert = 'success';
                $message = 'O registro foi atualizado com sucesso!';


            } catch (\Exception $e) {
                $alert = 'error';
                $message = 'Não foi possível atualizar o registro!'.$e->getMessage();
            }


            $this->session->setFlashdata($alert, $message);
            return redirect()->back();

        
        }

        return view('admin/turmas/info-aluno.php', $this->data);

    }

    //--------------------------------------------------------------------
    public function setTransferir($idAlunoTurma)
    {

        $fields = 	$this->request->getVar();

        try {

            $this->modelAlunosTurma->update($idAlunoTurma->id, ['id_turma' => $fields['turma']], false);

            return true;

        } catch (\Exception $e) {

            return false;

        }

    }

    //--------------------------------------------------------------------
    public function create()
    {

        $this->data['url'] = base_url('Admin/Turmas');
        $this->data['type'] = 'create';
        $this->data['title'] = 'Turmas';
        $this->data['titleType'] = 'Cadastrar Registro';
        $this->data['titleBreadcrumb'] = 'Cadastrar';
        $this->data['action'] = base_url('Admin/Turmas/cadastrar/');

        if($this->request->getMethod() === 'post'){

                $rules = $this->validation->setRules    ([
                                                            'nome'              => ['label' => 'Nome', 'rules' => 'required|min_length[3]|max_length[255]'],
                                                            'periodo'           => ['label' => 'Periodo', 'rules' => 'required|min_length[1]|max_length[255]'],
                                                            'grau'              => ['label' => 'Grau', 'rules' => 'required|min_length[1]|max_length[255]'],
                                                            'ano_letivo'        => ['label' => 'Ano Letivo', 'rules' => 'required|min_length[4]'],
                                                            'carga_horaria'     => ['label' => 'Carga Horária', 'rules' => 'required|min_length[1]'],
                                                            'dias_letivos'      => ['label' => 'Dias Letivos', 'rules' => 'required|min_length[1]'],
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
        
        return view('admin/turmas/crud.php', $this->data);    

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

    //--------------------------------------------------------------------
    public function read($id)
    {
        $this->data['url'] = base_url('Admin/Turmas');
        $this->data['title'] = 'Turmas';
        $this->data['titleType'] = 'Visualizar Registro';
        $this->data['type'] = 'read';
        $this->data['titleBreadcrumb'] = 'Visualizar';
        $this->data['action'] = base_url('Admin/Turmas/visualizar/'.$id);


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

        return view('admin/turmas/crud.php', $this->data);

    }

    public function update($id)
    {
        permissionAdmin();

        $this->data['url'] = base_url('Admin/Turmas');
        $this->data['title'] = 'Turmas';
        $this->data['titleType'] = 'Editar Registro';
        $this->data['type'] = 'update';
        $this->data['titleBreadcrumb'] = 'Editar';
        $this->data['action'] = base_url('Admin/Turmas/editar/'.$id);


        if($this->request->getMethod() === 'post'){

            $rules = $this->validation->setRules    ([
                                                        'nome'         => ['label' => 'Nome', 'rules' => 'required|min_length[3]|max_length[255]'],
                                                        'periodo'      => ['label' => 'Periodo', 'rules' => 'required|min_length[1]|max_length[255]'],
                                                        'grau'          => ['label' => 'Grau', 'rules' => 'required|min_length[1]|max_length[255]'],
                                                        'ano_letivo'   => ['label' => 'Ano Letivo', 'rules' => 'required|min_length[4]'],
                                                        'carga_horaria' => ['label' => 'Carga Horária', 'rules' => 'required|min_length[1]'],
                                                        'dias_letivos' => ['label' => 'Dias Letivos', 'rules' => 'required|min_length[1]'],
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

        return view('admin/turmas/crud.php', $this->data);

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

        permissionAdmin();

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
    public function alunos($id)
    {
        $this->data['id'] = $id;
        $this->data['url'] = base_url('Admin/Turmas');
        $this->data['title'] = 'Alunos';
        $this->data['titleBreadcrumb'] = 'Alunos';
        $this->data['actionCreate'] = base_url('Admin/Turmas/cadastrar');    
        $this->data['actionSearch'] = base_url('Admin/Turmas/alunos/'.$id);    

        if($this->request->getMethod() === 'post'){

            $search = $this->request->getVar('search');

            $this->data += 	[
                            'table'     => $this->modelAlunosTurma
                                                        ->select('alunos.matricula, alunos.nome, turma_aluno.id, turma_aluno.id_aluno, turma_aluno.id_turma')
                                                        ->join('alunos', 'alunos.id = turma_aluno.id_aluno')
                                                        ->where('id_turma', $id)
                                                        ->groupStart()
                                                            ->like('alunos.nome', $search)
                                                        ->groupEnd()
                                                        ->paginate(10),
                            'pager'      => $this->modelAlunosTurma->pager                                                            
                            ];

        }else{

            $this->data['table'] = $this->modelAlunosTurma->getAlunosByTurmaId($id);

            

            $this->data += 	[
                            'table'     => $this->modelAlunosTurma
                                                                    ->select('alunos.matricula, alunos.nome, turma_aluno.id, turma_aluno.id_aluno, turma_aluno.id_turma')
                                                                    ->join('alunos', 'alunos.id = turma_aluno.id_aluno')
                                                                    ->where('id_turma', $id)
                                                                    ->paginate(10),
                            'pager'     => $this->modelAlunosTurma->pager
                            ];

        }

        return view('admin/turmas/alunos.php', $this->data);

    }

    //--------------------------------------------------------------------
    public function alunosEditar($idTurma, $idAluno)
    {
        $this->session->setFlashdata('id_turma', $idTurma);
        
        return redirect()->to(base_url('Admin/Alunos/editar/'.$idAluno));

    }


    //--------------------------------------------------------------------
    public function disciplinasTurmas($idTurma)
    {
        permissionAdmin();

        $this->data['url'] = base_url('Admin/Turmas');

        $this->data['disciplinasTurma'] = $this->disciplinasTurmaModel->getDisciplinaByTurma($idTurma);

        $this->data['disciplinas'] = $this->disciplinasModel->findAll();

        $this->data['professores'] = $this->usuariosModel->getProfessores();

        $this->data['id_turma'] = $idTurma;

       return view('admin/turmas/disciplinas.php', $this->data);
    }

    //--------------------------------------------------------------------
    public function incluirDisciplina()
    {

        permissionAdmin();

        try {

            $fields['id_turma'] = $this->request->getVar('id_turma');
            $disciplinas = 	$this->request->getVar('id_disciplina');

            foreach ($disciplinas as $disciplina) {
                $fields['id_disciplina'] = $disciplina;
    
                $exists = $this->disciplinasTurmaModel->where('id_turma', $fields['id_turma'])
                                                ->where('id_disciplina', $fields['id_disciplina'] )
                                                ->first();                   
    
                if(!$exists){
                    $this->disciplinasTurmaModel->insert($fields);
    
                }
    
            }

            $alert = 'success';
            $message = 'O registro foi cadastrado com sucesso!';

        } catch (\Exception $e) {

            $alert = 'error';
            $message = 'Não foi possível cadastrar o registro!';

        }

        $this->session->setFlashdata($alert, $message);
        return redirect()->to(base_url('Admin/Turmas/disciplinas/'.$fields['id_turma']));

    }

    //--------------------------------------------------------------------
    public function excluirDisciplina($id)
    {
        permissionAdmin();
        $alert = 'error';
        $message = 'Não foi possível excluir o registro!';

        if($this->disciplinasTurmaModel->delete($id)){
            $alert = 'success';
            $message = 'Registro excluído com sucesso!';

        }

        $this->session->setFlashdata($alert, $message);
        return redirect()->back();

    }


    //--------------------------------------------------------------------
    public function lancarNotas($idTurma)
    {
        $this->data['url'] = base_url('Admin/Turmas');

        $this->data['disciplinasTurma'] = $this->disciplinasTurmaModel->getDisciplinaByTurma($idTurma);
        

        $this->data['disciplinas'] = $this->disciplinasModel->findAll();

        $perfil = session()->userPerfil;

        if((int)$perfil){
            $userId = session()->userId;
            if($userId === 3){
                $this->data['disciplinasTurma'] = $this->disciplinasTurmaModel->getDisciplinaByProfessor($idTurma);
            }
        
        }

        $this->data['id_turma'] = $idTurma;

       return view('admin/turmas/lancar-notas.php', $this->data);
    }

    //-------------------------------------------------------------------- 
    public function lancarNotasAlunos($idTurma, $idDisciplina)
    {
        $this->data['id'] = $idTurma;
        $this->data['id_turma'] = $idTurma;
        $this->data['id_disciplina'] = $idDisciplina;
        $this->data['url'] = base_url('Admin/Turmas');
        $this->data['title'] = 'Alunos';
        $this->data['titleBreadcrumb'] = 'Alunos';
        $this->data['actionCreate'] = base_url('Admin/Turmas/cadastrar');    
        $this->data['actionSearch'] = base_url('Admin/Turmas/alunos/'.$idTurma);  
        
        $this->data['table'] = $this->modelAlunosTurma->getAlunosByTurmaId($idTurma);

        return view('admin/turmas/lancar-notas-alunos.php', $this->data);

    }

    //-------------------------------------------------------------------- 
    public function salvarNotasAlunos()
    {

        $notas = $this->request->getVar('notas');
        $faltas = $this->request->getVar('faltas');
        $fields['id_turma'] = $this->request->getVar('id_turma');
        $fields['id_disciplina'] = $this->request->getVar('id_disciplina');

        foreach ($notas as $idAluno => $bimestres) {
            foreach ($bimestres as $bimestre => $nota) {
                $fields['nota'] = $nota;
                $fields['id_aluno'] = $idAluno;
                $fields['bimestre'] = $bimestre;

                if($nota != null && $nota != 0){
                    $exists = $this->alunosNotasModel->where('id_turma', $fields['id_turma'])
                                                    ->where('id_disciplina', $fields['id_disciplina'])
                                                    ->where('id_aluno', $fields['id_aluno'])
                                                    ->where('bimestre', $bimestre)
                                                    ->first();                   
    
                    if(!$exists){
                        if(!$this->alunosNotasModel->insert($fields)){
                            $alert = 'error';
                            $message = 'Não foi possível salvar o registro!';

                            $this->session->setFlashdata($alert, $message);
                            return redirect()->back();

                        }
                    }else{
                        if(!$this->alunosNotasModel->update($exists->id, ['nota' => $nota])){
                            $alert = 'error';
                            $message = 'Não foi possível salvar o registro!';

                            $this->session->setFlashdata($alert, $message);
                            return redirect()->back();
                        }
                    }
                }
            }
        }
        
        foreach ($faltas as $idAluno => $bimestres) {
            foreach ($bimestres as $bimestre => $falta) {
                $fields['falta'] = $falta;
                $fields['id_aluno'] = $idAluno;
                $fields['bimestre'] = $bimestre;
                
                if($falta != null && $falta != 0){
                    $exists = $this->alunosFaltasModel->where('id_turma', $fields['id_turma'])
                                                    ->where('id_disciplina', $fields['id_disciplina'])
                                                    ->where('id_aluno', $fields['id_aluno'])
                                                    ->where('bimestre', $bimestre)
                                                    ->first();                   
    
                    if(!$exists){
                        if(!$this->alunosFaltasModel->insert($fields)){
                            $alert = 'error';
                            $message = 'Não foi possível salvar o registro!';

                            $this->session->setFlashdata($alert, $message);
                            return redirect()->back();

                        }
                    }else{
                        if(!$this->alunosFaltasModel->update($exists->id, ['falta' => $falta])){
                            $alert = 'error';
                            $message = 'Não foi possível salvar o registro!';

                            $this->session->setFlashdata($alert, $message);
                            return redirect()->back();
                        }
                    }
                }
            }
        }

        
        $alert = 'success';
        $message = 'Registro salvo com sucesso!';

        $this->session->setFlashdata($alert, $message);
        return redirect()->back();
    }


    //-------------------------------------------------------------------- 
    public function avaliacaoIndividual($idTurma)
    {
        $this->data['id'] = $idTurma;
        $this->data['id_turma'] = $idTurma;
        $this->data['url'] = base_url('Admin/Turmas');
        $this->data['title'] = 'Alunos';
        $this->data['titleBreadcrumb'] = 'Alunos';
        $this->data['actionCreate'] = base_url('Admin/Turmas/cadastrar');    
        $this->data['actionSearch'] = base_url('Admin/Turmas/alunos/'.$idTurma);  
        
        $this->data['table'] = $this->modelAlunosTurma->getAlunosByTurmaId($idTurma);
        $this->data['professores'] = $this->usuariosModel->getProfessores();
        $this->data['professorTurma'] = $this->turmaProfessorModel->getProfessor($idTurma);
        $this->data['auxiliarTurma'] = $this->turmaProfessorModel->getAuxiliar($idTurma);

        return view('admin/turmas/avaliacao-individual.php', $this->data);

    }


    //-------------------------------------------------------------------- 
    public function avaliacaoIndividualProfessor(){

        $fields = $this->request->getVar();

        

        try {

            $prof = $this->turmaProfessorModel->where('id_turma', $fields['id_turma'])
                                                ->first();

            if($prof){
                $this->turmaProfessorModel->update($prof->id, $fields, false);
            }else{  

                $this->turmaProfessorModel->insert($fields);
            }   

            $alert = 'success';
            $message = 'Vínculo com sucesso!';

        } catch (\Exception $e) {

            $alert = 'error';
            $message = 'Não foi possível realizar o vínculo!';

        }

        $this->session->setFlashdata($alert, $message);
        return redirect()->back();

    }

    //-------------------------------------------------------------------- 
    public function avaliacaoIndividualProfessorExcluir($id_turma, $id_professor)
    {
        $idTurmaProfessor = $this->turmaProfessorModel->where('id_turma', $id_turma)
                                                        ->where('id_professor', $id_professor)
                                                        ->first();
        

        try {
            if ($this->turmaProfessorModel->delete($idTurmaProfessor->id, true)) {
                $alert = 'success';
                $message = 'Professor desvinculado com sucesso!';
            }
        } catch (\Exception $e) {
            $alert = 'error';
            $message = 'Não foi possível excluir o registro!';
        }

        $this->session->setFlashdata($alert, $message);
        return redirect()->back();
    }

    //-------------------------------------------------------------------- 
    public function avaliacaoIndividualAuxiliarExcluir($id_turma, $id_auxiliar)
    {
        $idTurmaAuxiliar = $this->turmaProfessorModel->where('id_turma', $id_turma)
                                                        ->where('id_auxiliar', $id_auxiliar)
                                                        ->first();
        

        try {
            if ($this->turmaProfessorModel->delete($idTurmaAuxiliar->id, true)) {
                $alert = 'success';
                $message = 'Professor desvinculado com sucesso!';
            }
        } catch (\Exception $e) {
            $alert = 'error';
            $message = 'Não foi possível excluir o registro!';
        }

        $this->session->setFlashdata($alert, $message);
        return redirect()->back();
    }

    //-------------------------------------------------------------------- 
    public function avaliacaoIndividualAluno($idTurma, $idAluno, $bimestre)
    {
        $this->data['bimestre'] = $bimestre;
        $this->data['url'] = base_url('Admin/Turmas/avaliacao-individual/'.$idTurma);
        $this->data['aluno'] = $this->alunosModel->find($idAluno);
        $this->data['turma'] = $this->model->find($idTurma);
        $this->data['professor'] = $this->turmaProfessorModel->getProfessor($idTurma);
        $this->data['auxiliar'] = $this->turmaProfessorModel->getAuxiliar($idTurma);
        
        $turmaProfessor = $this->turmaProfessorModel->where('id_turma', $idTurma)
                                                    ->where('id_professor', session()->userId)
                                                    ->first();
        
        if($turmaProfessor === null && session()->userPerfil != 1){

            return redirect()->back()->with('error', 'Você não tem permissão para acessar esta página!');

        }

        $avaliacaoIndividualModel = new AvaliacaoIndividualModel();
        $this->data['avaliacao'] = $avaliacaoIndividualModel->get();
        $avaliacaoIndividualAlunoTurmaModel = new AvaliacaoIndividualAlunoTurmaModel();
        $this->data['resposta'] = $avaliacaoIndividualAlunoTurmaModel
                                                                    ->where('id_turma', $idTurma)
                                                                    ->where('id_aluno', $idAluno)
                                                                    ->where('bimestre', $bimestre)
                                                                    ->findAll();

        return view('admin/turmas/avaliacao-individual-aluno.php',$this->data);

    }

    //-------------------------------------------------------------------- 
    public function salvarAvaliacaoIndividual()
    {
        $fields = $this->request->getVar();

        try {

            $avaliacaoIndividualAlunoTurmaModel = new AvaliacaoIndividualAlunoTurmaModel();

            $avaliacaoIndividualAlunoTurmaModel
                ->where('id_turma', $fields['id_turma'])
                ->where('id_aluno', $fields['id_aluno'])
                ->where('bimestre', $fields['bimestre'])
                ->delete(null, true);

            foreach($fields['resposta'] as $key => $resposta){

                $fields['id_avaliacao'] = $key;
                $fields['resposta'] = $resposta;

                $avaliacaoIndividualAlunoTurmaModel->insert($fields);

            }

            $alert = 'success';
            $message = 'Avaliação individual salva com sucesso!';

        } catch (\Exception $e) {

            $alert = 'error';
            $message = 'Não foi possível salvar a avaliação individual!';

        }

        $this->session->setFlashdata($alert, $message);
        return redirect()->back();

    }


}
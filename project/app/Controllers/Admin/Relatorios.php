<?php

namespace App\Controllers\Admin;

use App\Models\Admin\AlunosModel;
use App\Models\Admin\AlunosTurmasModel;
use App\Models\Admin\TurmasModel;
use CodeIgniter\Controller;
use App\Models\Admin\UsuarioModel;
use App\Libraries\PdfGenerator;
use App\Models\Admin\AlunosFaltasModel;
use App\Models\Admin\AlunosNotasModel;
use App\Models\Admin\DisciplinasModel;
use App\Models\Admin\AlunosInfoComplementaresModel;
use App\Models\Admin\AvaliacaoIndividualModel;
use App\Models\Admin\TurmaProfessorModel;

class Relatorios extends Controller
{
    public $model, $turmaModel, $turmaProfessorModel, $avaliacaoIndividualModel, $notaModel, $alunosModel, $disciplinasModel, $faltaModel, $turmaAlunosModel, $session, $validation, $data, $conteudo;
    
    //--------------------------------------------------------------------
    public function __construct()
	{
        helper('auth');
        helper('form');
        helper('parametros');
        permission();
        permissionAdmin();

		$this->model	= new UsuarioModel();
        $this->alunosModel   = new AlunosModel();
        $this->turmaModel = new TurmasModel();
        $this->notaModel = new AlunosNotasModel();
        $this->faltaModel = new AlunosFaltasModel();
        $this->turmaAlunosModel = new AlunosTurmasModel();  
        $this->disciplinasModel = new DisciplinasModel();  
        $this->avaliacaoIndividualModel = new AvaliacaoIndividualModel();
        $this->turmaProfessorModel = new TurmaProfessorModel();
        $this->session  = session();
        $this->validation = \Config\Services::validation();
	}

    //--------------------------------------------------------------------
    public function index()
    {

        $this->data['table'] = 	$this->model->findAll();

        return view('admin/relatorios/index.php', $this->data);

    }

    //--------------------------------------------------------------------
    public function getAlunosPorTurma($idTurma = null)
    {
       
        if($idTurma == null){
            return $this->response->setJSON(['error' => 'ID da turma não informado']);
        }

        $alunos = $this->turmaAlunosModel->getAlunosByTurmaId($idTurma);


        if(empty($alunos)){
            return $this->response->setJSON(['error' => 'Nenhum aluno encontrado para esta turma']);
        }

        return $this->response->setJSON($alunos);

    }

    public function gerarRelatorio()
    {
        $tipoRelatorio = $this->request->getPost('tipoRelatorio');
        $idTurma = $this->request->getPost('turma');
        $idAluno = $this->request->getPost('aluno');

        if(empty($tipoRelatorio)){
            return redirect()->back()->with('error', 'Tipo de relatório ou turma não informados.');
        }

        switch ($tipoRelatorio) {
            case 'declaracao_escolaridade':
                return $this->declaracaoEscolaridade($idTurma, $idAluno);
            case 'ficha_matricula':
                return $this->fichaMatricula($idTurma, $idAluno);
            case 'ficha_individual':
                return $this->fichaIndividual($idTurma, $idAluno);  
            case 'avaliacao_individual':
                return $this->avaliacaoIndividual($idTurma, $idAluno);
            case 'atestado_transferencia':
                return $this->atestadoTransferencia($idTurma, $idAluno);             
            default:
                return redirect()->back()->with('error', 'Tipo de relatório inválido.');
        }
    }

    public function declaracaoEscolaridade($idTurma, $idAluno = null)
{
    if ($idAluno) {
        // Apenas 1 aluno, ainda assim retorno como array para padronizar
        $this->data['alunos'] = [$this->turmaAlunosModel->getAlunoById($idTurma, $idAluno)];
    } else {
        // Todos os alunos da turma
        $this->data['alunos'] = $this->turmaAlunosModel->getAlunosByTurmaId($idTurma);
    }

    $this->conteudo = view('admin/relatorios/declaracao-escolaridade', $this->data);
    return $this->gerarPdf('Declaracao_Escolaridade.pdf', 'I');
}



    //--------------------------------------------------------------------
    public function fichaMatricula($idTurma, $idAluno = null){
        
        $this->data['alunos'] = $this->turmaAlunosModel->getAlunosByTurmaId($idTurma);

        if($idAluno){
            
            $this->data['alunos'] = $this->turmaAlunosModel->getAlunoById($idTurma, $idAluno);

            //dd($this->turmaAlunosModel->db->getLastQuery());

        }

        
        $this->conteudo = view('admin/relatorios/ficha-matricula', $this->data);

        return $this->gerarPdf('Ficha_Matricula.pdf', 'I');
        
        //return $this->gerarPdf('Ficha_Matricula.pdf', 'D'); // D: download, I: inline, F: salvar no servidor, S: string
    }


    //--------------------------------------------------------------------
    public function fichaIndividual($idTurma, $idAluno = null){

        $this->data['id_turma'] = $idTurma;
        

        if(!empty($idAluno)){
            $this->data['id_aluno'] = $idAluno;
            $this->data['alunos'] = [$this->turmaAlunosModel->getAlunoById($idTurma, $idAluno)];
        
        }else{

            $this->data['alunos'] = $this->turmaAlunosModel->getAllAlunoById($idTurma);
        }

        
        $infoAlunosModel = new AlunosInfoComplementaresModel();

        $this->data['info'] = $infoAlunosModel->getInfoCompletaresByAlunoId($idAluno, $idTurma);
        
       

        $this->data['disciplinas'] = $this->disciplinasModel->getDisciplinasByTurma($idTurma);

        

        
        $this->conteudo = view('admin/relatorios/ficha-individual', $this->data);

        return $this->gerarPdf('Ficha_Individual.pdf', 'I');
        
        //return $this->gerarPdf('Ficha_Matricula.pdf', 'D'); // D: download, I: inline, F: salvar no servidor, S: string
    }


    //--------------------------------------------------------------------
    public function avaliacaoIndividual($idTurma, $idAluno = null)
    {
        $this->data['id_turma'] = $idTurma;

        if (!empty($idAluno)) {
            $this->data['id_aluno'] = $idAluno;
            $this->data['alunos'] = [$this->turmaAlunosModel->getAlunoById($idTurma, $idAluno)];
        } else {
            $this->data['alunos'] = $this->turmaAlunosModel->getAllAlunoById($idTurma);
        }

        // Obter notas e faltas
        $this->data['notas'] = $this->notaModel->getNotasByTurmaAndAluno($idTurma, $idAluno);
        $this->data['faltas'] = $this->faltaModel->getFaltasByTurmaAndAluno($idTurma, $idAluno);

        // Obter disciplinas
        $this->data['disciplinas'] = $this->disciplinasModel->getDisciplinasByTurma($idTurma);

        //obtendo avaliações individuais
        $this->data['avaliacoes'] = $this->avaliacaoIndividualModel->get();

        if (empty($this->data['avaliacoes'])) {
            return redirect()->back()->with('error', 'Nenhuma avaliação individual encontrada.');
        }

        $this->data['professor'] = $this->turmaProfessorModel->getProfessor($idTurma);
        $this->data['auxiliar'] = $this->turmaProfessorModel->getAuxiliar($idTurma);

        $this->data['turma'] = $this->turmaModel->find($idTurma);

        // Gerar conteúdo da view
        $this->conteudo = view('admin/relatorios/avaliacao-individual', $this->data);

        return $this->gerarPdf('Avaliacao_Individual.pdf', 'I');
    }

    //--------------------------------------------------------------------
    public function atestadoTransferencia($idTurma, $idAluno = null)
    {
        if (empty($idAluno)) {
            return redirect()->back()->with('error', 'É necessário selecionar um aluno para gerar o Atestado de Transferência.');
        }

        // Obter status do aluno (cursando ou aprovado)
        $status = $this->request->getPost('status');
        
        if (empty($status)) {
            return redirect()->back()->with('error', 'É necessário selecionar o status do aluno (Cursando ou Aprovado).');
        }

        // Buscar dados do aluno e turma
        $aluno = $this->turmaAlunosModel->getAlunoById($idTurma, $idAluno);
        
        if (empty($aluno)) {
            return redirect()->back()->with('error', 'Aluno não encontrado.');
        }

        $this->data['aluno'] = $aluno;
        $this->data['turma_atual'] = $aluno->nome_turma ?? '';
        $this->data['ano_letivo'] = date('Y');
        $this->data['status'] = strtoupper($status);
        
        // Determinar turma de transferência baseado no status
        if ($status === 'cursando') {
            // Se está cursando, transfere para a mesma turma
            $this->data['turma_transferencia'] = $aluno->nome_turma ?? '';
        } else {
            // Se aprovado, transfere para a próxima turma
            $this->data['turma_transferencia'] = $this->determinarProximaTurma($aluno->nome_turma ?? '');
        }

        // Gerar conteúdo da view
        $this->conteudo = view('admin/relatorios/atestado-transferencia', $this->data);

        return $this->gerarPdf('Atestado_Transferencia.pdf', 'I');
    }

    //--------------------------------------------------------------------
    private function determinarProximaTurma($turmaAtual)
    {
        // Mapeamento de turmas para próxima série
        $mapeamento = [
            'BERÇÁRIO' => 'MATERNAL I',
            'MATERNAL I' => 'MATERNAL II',
            'MATERNAL II' => 'PRÉ-I',
            'PRÉ-I' => 'PRÉ-II',
            'PRÉ-II' => '1º ANO',
            '1º ANO' => '2º ANO',
            '2º ANO' => '3º ANO',
            '3º ANO' => '4º ANO',
            '4º ANO' => '5º ANO',
            '5º ANO' => '6º ANO',
            '6º ANO' => '7º ANO',
            '7º ANO' => '8º ANO',
            '8º ANO' => '9º ANO',
            '9º ANO' => '1ª SÉRIE DO ENSINO MÉDIO',
        ];
    
        // Usar funções multibyte para preservar acentuação e comparar por prefixo,
        // assim '1º ANO A' será reconhecido como começando por '1º ANO'.
        $turmaUpper = mb_strtoupper(trim($turmaAtual));
    
        foreach ($mapeamento as $orig => $proxima) {
            $origUpper = mb_strtoupper($orig);
            if (mb_substr($turmaUpper, 0, mb_strlen($origUpper)) === $origUpper) {
                return $proxima;
            }
        }
    
        return $turmaAtual;
    }

/*
    public function gerarPdf($nomeArquivo = null, $saida = null): \CodeIgniter\HTTP\ResponseInterface
    {
        //$conteudo = view('admin/relatorios/exemplo'); // se preferir gerar o HTML a partir de uma view

        $pdf = new \App\Libraries\PdfGenerator();
        $arquivo = !empty($nomeArquivo) ? $nomeArquivo : 'relatorio.pdf';
        $modoSaida = !empty($saida) ? $saida : 'I'; // I: inline, D: download, F: salvar no servidor, S: string

        // Gera o conteúdo PDF como string
        $pdfContent = $pdf->generate($this->conteudo, $arquivo, $modoSaida);

        // Retorna a resposta com os headers corretos
        return $this->response
                    ->setHeader('Content-Type', 'application/pdf')
                    ->setHeader('Content-Disposition', 'inline; filename="' . $arquivo . '"')
                    ->setBody($pdfContent);
    }

    public function gerarPdf($nomeArquivo = null, $saida = null)
    {
        $this->conteudo = "<h1>Relatório de Alunos</h1>";
        $pdf = new \App\Libraries\PdfGenerator();
        $arquivo = $nomeArquivo ?? 'relatorio.pdf';
        $modoSaida = $saida ?? 'I';

        // Essa chamada já imprime ou faz download, dependendo do modo
        $pdf->generate($this->conteudo, $arquivo, $modoSaida);

        // Evita que o CodeIgniter continue processando
        exit;
    }*/


    public function gerarPdf($nomeArquivo = null, $saida = null)
    {
        //$mpdf = new \Mpdf\Mpdf();

        $mpdf = new \Mpdf\Mpdf([
                                    'mode' => 'utf-8',
                                    'format' => 'A4'
                                ]);
        $arquivo = $nomeArquivo ?? 'relatorio.pdf';
        $modoSaida = $saida ?? 'I';
        $mpdf->WriteHTML($this->conteudo);
        $mpdf->Output($nomeArquivo, $saida);
        exit;
    }




}

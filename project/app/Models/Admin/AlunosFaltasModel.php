<?php namespace App\Models\Admin;

use CodeIgniter\Model;

class AlunosFaltasModel extends Model
{
    protected $table = 'alunos_faltas';
	protected $primaryKey = 'id';
	protected $allowedFields = ['id_aluno', 'id_turma','id_disciplina', 'bimestre', 'falta'];
	
	protected $returnType     = 'object';
    protected $useSoftDeletes = true;
	
	protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

	public function getFaltasByAluno($idAluno = null, $idTurma = null, $idDisciplina = null, $bimestre = null)
	{

		if($idAluno == null || $idTurma == null || $idDisciplina == null)
		{
			return false;
		}
		
		if($bimestre != null)
		{
			return $this->where('id_aluno', $idAluno)
						->where('id_turma', $idTurma)
						->where('id_disciplina', $idDisciplina)
						->where('bimestre', $bimestre)
						->first();
		}
	
		return false;
	}

	public function getFaltas($idTurma, $idAluno, $idDisciplina){

		$idTurmaDisciplina = (new \App\Models\Admin\TurmaDisciplinaModel())->getDisciplina($idTurma, $idDisciplina);

		return $this->where('alunos_faltas.id_aluno', $idAluno)
					->where('alunos_faltas.id_turma', $idTurma)
					->where('alunos_faltas.id_disciplina', $idTurmaDisciplina->id)
					->findAll();

	}

	public function getFaltasByTurmaAndAluno($idTurma, $idAluno)
	{
		if ($idTurma == null || $idAluno == null) {
			return false;
		}

		return $this->where('id_turma', $idTurma)
					->where('id_aluno', $idAluno)
					->findAll();
	}

	
}

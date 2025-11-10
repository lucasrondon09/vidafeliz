<?php namespace App\Models\Admin;

use CodeIgniter\Model;

class AlunosNotasModel extends Model
{
    protected $table = 'alunos_notas';
	protected $primaryKey = 'id';
	protected $allowedFields = ['id_aluno', 'id_turma','id_disciplina', 'bimestre', 'nota'];
	
	protected $returnType     = 'object';
    protected $useSoftDeletes = true;
	
	protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

	public function getNotasByAluno($idAluno = null, $idTurma = null, $idDisciplina = null, $bimestre = null)
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

	public function getNotas($idTurma, $idAluno, $idDisciplina){

		$idTurmaDisciplina = (new \App\Models\Admin\TurmaDisciplinaModel())->getDisciplina($idTurma, $idDisciplina);

		return $this->where('alunos_notas.id_aluno', $idAluno)
					->where('alunos_notas.id_turma', $idTurma)
					->where('alunos_notas.id_disciplina', $idTurmaDisciplina->id)
					->findAll();

	}

	public function getNotasByTurmaAndAluno($idTurma, $idAluno)
	{
		if ($idTurma == null || $idAluno == null) {
			return false;
		}

		return $this->where('id_turma', $idTurma)
					->where('id_aluno', $idAluno)
					->findAll();
	}


	
}

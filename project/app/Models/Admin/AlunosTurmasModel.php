<?php namespace App\Models\Admin;

use CodeIgniter\Model;

class AlunosTurmasModel extends Model
{
    protected $table = 'turma_aluno';
	protected $primaryKey = 'id';
	protected $allowedFields = ['id_aluno', 'id_turma', 'ano_letivo'];
	
	protected $returnType     = 'object';
    protected $useSoftDeletes = true;
	
	protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    


		
	public function get($id = null)
	{
		if($id <> null)
		{
			return $this->find($id);
				
		}

		return $this->findAll();
		
	
	}

	public function getTurmaByAlunoId($idAluno = null)
	{
		return $this->where('id_aluno', $idAluno)->first();
	
	}

	public function getAlunosByTurmaId($idTurma = null)
	{
		return $this->select('alunos.*, alunos.id as id_aluno, pais.*, turmas.nome as nome_turma, turmas.periodo as turma_periodo, turma_aluno.id, turma_aluno.id_aluno, turma_aluno.id_turma, turmas.nome as nome_turma, turmas.periodo as turma_periodo, turmas.ano_letivo as ano_letivo, turmas.grau as grau_turma')
					->join('alunos', 'alunos.id = turma_aluno.id_aluno')
					->join('pais', 'pais.id = alunos.id_pai', 'left')
					->join('turmas', 'turmas.id = turma_aluno.id_turma', 'left')
					->join('turma_professor', 'turma_professor.id_turma = turmas.id', 'left')
					->where('turma_aluno.id_turma', $idTurma)
					->where('turma_aluno.deleted_at is null')
					->where('alunos.deleted_at is null')
					->where('pais.deleted_at is null')
					->where('turmas.deleted_at is null')
					->where('turma_professor.deleted_at is null')
					->orderBy('alunos.nome', 'ASC')
					->findAll();
	
	}

	public function getAlunoById($idTurma = null, $idAluno = null)
	{
		return $this->select('alunos.*, alunos.id as id_aluno,pais.*, turmas.nome as nome_turma, turmas.periodo as turma_periodo, turmas.carga_horaria as turma_carga_horaria, turmas.dias_letivos as turma_dias_letivos, turma_aluno.id, turma_aluno.id_aluno, turma_aluno.id_turma, turmas.nome as nome_turma, turmas.periodo as turma_periodo, turmas.ano_letivo as ano_letivo, turmas.grau as grau_turma')
					->join('alunos', 'alunos.id = turma_aluno.id_aluno')
					->join('pais', 'pais.id = alunos.id_pai', 'left')
					->join('turmas', 'turmas.id = turma_aluno.id_turma', 'left')
					->where('id_turma', $idTurma)
					->where('id_aluno', $idAluno)
					->first();
	
	}

	public function getAllAlunoById($idTurma = null)
	{
		return $this->select('alunos.*, alunos.id as id_aluno,pais.*, turmas.nome as nome_turma, turmas.periodo as turma_periodo, turmas.carga_horaria as turma_carga_horaria, turmas.dias_letivos as turma_dias_letivos, turma_aluno.id, turma_aluno.id_aluno, turma_aluno.id_turma, turmas.nome as nome_turma, turmas.periodo as turma_periodo, turmas.ano_letivo as ano_letivo, turmas.grau as grau_turma')
					->join('alunos', 'alunos.id = turma_aluno.id_aluno')
					->join('pais', 'pais.id = alunos.id_pai', 'left')
					->join('turmas', 'turmas.id = turma_aluno.id_turma', 'left')
					->where('id_turma', $idTurma)
					->findAll();
	
	}

	public function getIdByTurmaIdAndAlunoId($idTurma = null, $idAluno = null)
	{
		return $this->where('id_turma', $idTurma)
					->where('id_aluno', $idAluno)
					->first();

					
	
	}




	
}

<?php namespace App\Models\Admin;

use CodeIgniter\Model;

class AvaliacaoIndividualAlunoTurmaModel extends Model
{
    protected $table = 'avaliacao_individual_aluno_turma';
	protected $primaryKey = 'id';
	protected $allowedFields = ['id_aluno', 'id_turma', 'id_avaliacao', 'bimestre', 'resposta', 'auxiliar'];
	protected $returnType     = 'object';
    protected $useSoftDeletes = true;
	
	protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    
	public function get($id = null)
	{
		if ($id !== null) {
			return $this->find($id);
		}

		return $this->findAll();
	}

	public function getResposta($idAluno, $idTurma, $idAvaliacao, $bimestre){

		return $this->where('id_turma',$idTurma)
					->where('id_aluno', $idAluno)
					->where('id_avaliacao', $idAvaliacao)
					->where('bimestre', $bimestre)
					->first();

	}

	public function getBimestres($idAluno, $idTurma)
	{
		return $this->select('bimestre')
					->where('id_turma', $idTurma)
					->where('id_aluno', $idAluno)
					->groupBy('bimestre')
					->orderBy('bimestre', 'ASC')
					->findAll();
	}

	

	
	
}

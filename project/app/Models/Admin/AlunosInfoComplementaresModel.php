<?php namespace App\Models\Admin;

use CodeIgniter\Model;

class AlunosInfoComplementaresModel extends Model
{
    protected $table = 'alunos_info_complemetares';
	protected $primaryKey = 'id';
	protected $allowedFields = ['id_aluno', 'id_turma', 'observacao', 'situacao'];
	
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

	public function getInfoCompletaresByAlunoId($idAluno, $idTurma)
	{
		
		return $this->where('id_aluno', $idAluno)
					->where('id_turma', $idTurma)	
					->first();
	}

	




	
}

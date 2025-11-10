<?php namespace App\Models\Admin;

use CodeIgniter\Model;

class DisciplinasModel extends Model
{
    protected $table = 'disciplinas';
	protected $primaryKey = 'id';
	protected $allowedFields = ['descricao', 'carga_horaria'];
	
	protected $returnType     = 'object';
    protected $useSoftDeletes = true;
	
	protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    
		
	public function get($id = null)
	{

		if($id != null)
		{
			return $this->find($id);
				
		}
		
		return $this->findAll();	
	
	}

	public function getDisciplinasByTurma($idTurma)
	{
		return $this->db->table('turma_disciplina')
			->select('disciplinas.*')
			->join('disciplinas', 'disciplinas.id = turma_disciplina.id_disciplina')
			->where('turma_disciplina.id_turma', $idTurma)
			->where('turma_disciplina.deleted_at IS NULL')
			->get()
			->getResult();
	}

	


	
}

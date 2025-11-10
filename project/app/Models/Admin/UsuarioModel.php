<?php namespace App\Models\Admin;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuarios';
	protected $primaryKey = 'id';
	protected $allowedFields = ['nome', 'login', 'senha', 'perfil'];
	
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
		
		return $this->find();
	
	}

	public function getProfessores()
	{
		return $this->where('perfil', 3)->findAll();
	}

	public function getProfessoresByTurma($turma)
	{
		return $this->join('turma_professor', 'turma_professor.id_professor = usuarios.id')
					->where('turma_professor.id_turma', $turma)
					->where('turma_professor.deleted_at', null)
					->findAll();
	}


	
}

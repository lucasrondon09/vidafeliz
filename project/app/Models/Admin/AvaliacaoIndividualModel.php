<?php namespace App\Models\Admin;

use CodeIgniter\Model;

class AvaliacaoIndividualModel extends Model
{
    protected $table = 'avaliacao_individual';
	protected $primaryKey = 'id';
	protected $allowedFields = ['descricao', 'categoria'];
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

	
	
}

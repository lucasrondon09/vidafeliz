<?php namespace App\Models\Admin;

use CodeIgniter\Model;

class AlunosModel extends Model
{
    protected $table = 'alunos';
	protected $primaryKey = 'id';
	protected $allowedFields = [
		'id_pai','matricula', 
		'nome', 'cpf', 'rg', 'foto', 'nascimento', 'naturalidade', 'nacionalidade', 'email', 'telefone', 'endereco', 'numero', 'complemento', 'bairro', 'cidade', 'estado', 'cep'
	];
	
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

	public function getByTurma($idTurma)
	{
		return $this->where('id', $idTurma)->findAll();
	}


	
}

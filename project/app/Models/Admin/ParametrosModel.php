<?php namespace App\Models\Admin;

use CodeIgniter\Model;

class ParametrosModel extends Model
{
    protected $table = 'parametros';
	protected $primaryKey = 'id';
	protected $allowedFields = ['chave', 'valor', 'observacao'];
	
	protected $returnType     = 'object';
    protected $useSoftDeletes = true;
	
	protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    
		
	public function getAnoLetivo()
	{
		return $this->where('chave', 'ANO_LETIVO')->first();
	}

	public function getMediaEscolar()
	{
		return $this->where('chave', 'MEDIA_ESCOLAR')->first();
	}
	
	public function get($nomeChave){
		$parametros = $this->findAll();
		foreach ($parametros as $item) {
			if (isset($item->chave) && $item->chave === $nomeChave) {
				return $item->valor;
			}
		}

    return null; // caso não encontre

	}


	
}

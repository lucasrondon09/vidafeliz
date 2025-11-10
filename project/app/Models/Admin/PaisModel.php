<?php namespace App\Models\Admin;

use CodeIgniter\Model;

class PaisModel extends Model
{
    protected $table = 'pais';
	protected $primaryKey = 'id';
	protected $allowedFields = [
		'matricula', 
		'pai_nome', 'pai_cpf', 'pai_rg', 'pai_nascimento', 'pai_profissao', 'pai_empresa', 'pai_naturalidade', 'pai_nacionalidade', 'pai_email', 'pai_telefone', 'pai_endereco', 'pai_numero', 'pai_complemento', 'pai_bairro', 'pai_cidade', 'pai_estado', 'pai_cep', 'pai_estado_civil', 'pai_parentesco', 'pai_resp_financeiro', 'pai_resp_pedagogico',
		'mae_nome', 'mae_cpf', 'mae_rg', 'mae_nascimento', 'mae_profissao', 'mae_empresa', 'mae_naturalidade', 'mae_nacionalidade', 'mae_email', 'mae_telefone', 'mae_endereco', 'mae_numero', 'mae_complemento', 'mae_bairro', 'mae_cidade', 'mae_estado', 'mae_cep', 'mae_estado_civil', 'mae_parentesco', 'mae_resp_financeiro', 'mae_resp_pedagogico',
		'resp_finan_nome', 'resp_finan_parentesco', 'resp_finan_cpf', 'resp_finan_rg', 'resp_finan_nascimento', 'resp_finan_profissao', 'resp_finan_empresa', 'resp_finan_naturalidade', 'resp_finan_nacionalidade', 'resp_finan_email', 'resp_finan_telefone', 'resp_finan_endereco', 'resp_finan_numero', 'resp_finan_complemento', 'resp_finan_bairro', 'resp_finan_cidade', 'resp_finan_estado', 'resp_finan_cep', 'resp_finan_estado_civil', 'resp_finan_parentesco', 'resp_finan_resp_financeiro', 'resp_finan_resp_pedagogico'
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


	
}

<?php namespace App\Models\Admin;

use CodeIgniter\Model;

class HistoricoEscolarModel extends Model
{
    protected $table = 'historico_escolar';
	protected $primaryKey = 'id';
	protected $allowedFields = ['turma', 'estabelecimento','municipio', 'uf', 'ano', 'observacao', 'id_aluno'];
	
	protected $returnType     = 'object';
    protected $useSoftDeletes = true;
	
	protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

	

	
}

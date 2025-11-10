<?php namespace App\Models\Admin;

use CodeIgniter\Model;

class TurmasModel extends Model
{
    protected $table = 'turmas';
	protected $primaryKey = 'id';
	protected $allowedFields = ['nome', 'periodo','grau', 'ano_letivo', 'carga_horaria', 'dias_letivos'];
	protected $returnType     = 'object';
    protected $useSoftDeletes = true;
	
	protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    
		
	public function get($id = null)
	{
		$parametrosModel = new ParametrosModel();
		$anoLetivo = $parametrosModel->getAnoLetivo();

		if($id <> null)
		{
			return $this->where('ano_letivo', $anoLetivo->valor)->find($id);
				
		}

		if (!empty($anoLetivo = $anoLetivo->valor))
		{
			return $this->where('ano_letivo', $anoLetivo)->findAll();
		}
		
		return $this->findAll();	
	
	}


	public function getTurmasByProfessor()
	{
		return $this->db->table('turma_disciplina_professor')
			->select('turmas.*, turma_disciplina_professor.id AS id_turma_disciplina')
			->join('turmas', 'turmas.id = turma_disciplina_professor.id_turma')
			->where('turma_disciplina_professor.id_usuario', session()->userId)
			->where('turma_disciplina_professor.deleted_at IS NULL')
			->where('turmas.deleted_at IS NULL')
			->groupBy('turmas.id')
			->get()
			->getResult();
	}


	


	
}

<?php namespace App\Models\Admin;

use CodeIgniter\Model;

class HistoricoEscolarNotasModel extends Model
{
    protected $table = 'historico_escolar_notas';
	protected $primaryKey = 'id';
	protected $allowedFields = ['id_disciplina', 'id_historico','nota'];
	
	protected $returnType     = 'object';
    protected $useSoftDeletes = true;
	
	protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

	

    public function getNotasByHistoricoId($idHistorico)
    {

        return $this->join('disciplinas', 'disciplinas.id = historico_escolar_notas.id_disciplina')
                    ->select('historico_escolar_notas.*, disciplinas.descricao as disciplina, disciplinas.carga_horaria as ch')
                    ->where('id_historico', $idHistorico)->findAll();

    }
	
}

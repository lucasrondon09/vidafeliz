<?php 

namespace App\Models\Admin;

use CodeIgniter\Model;

class HistoricoEscolarNotasModel extends Model
{
    protected $table = 'historico_escolar_notas';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_periodo', 'id_historico_disciplina', 'nota', 'resultado', 
        'faltas', 'observacao'
    ];
    
    protected $returnType     = 'object';
    protected $useSoftDeletes = true;
    
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    /**
     * Busca notas de um período específico com dados das disciplinas
     * 
     * @param int $idPeriodo
     * @return array
     */
    public function getByPeriodo($idPeriodo)
    {
        return $this->select('historico_escolar_notas.*, historico_disciplinas.descricao as disciplina, historico_disciplinas.carga_horaria')
                    ->join('historico_disciplinas', 'historico_disciplinas.id = historico_escolar_notas.id_historico_disciplina')
                    ->where('historico_escolar_notas.id_periodo', $idPeriodo)
                    ->where('historico_escolar_notas.deleted_at', null)
                    ->orderBy('historico_disciplinas.descricao', 'ASC')
                    ->findAll();
    }

    /**
     * Busca nota com dados da disciplina
     * 
     * @param int $id
     * @return object|null
     */
    public function getComDisciplina($id)
    {
        return $this->select('historico_escolar_notas.*, historico_disciplinas.descricao as disciplina, historico_disciplinas.carga_horaria')
                    ->join('historico_disciplinas', 'historico_disciplinas.id = historico_escolar_notas.id_historico_disciplina')
                    ->where('historico_escolar_notas.id', $id)
                    ->where('historico_escolar_notas.deleted_at', null)
                    ->first();
    }

    /**
     * Verifica se disciplina já foi cadastrada no período
     * 
     * @param int $idPeriodo
     * @param int $idDisciplina
     * @param int|null $excludeId
     * @return bool
     */
    public function disciplinaJaCadastrada($idPeriodo, $idDisciplina, $excludeId = null)
    {
        $builder = $this->where('id_periodo', $idPeriodo)
                        ->where('id_historico_disciplina', $idDisciplina)
                        ->where('deleted_at', null);
        
        if ($excludeId) {
            $builder->where('id !=', $excludeId);
        }
        
        return $builder->countAllResults() > 0;
    }
}

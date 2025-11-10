<?php 

namespace App\Models\Admin;

use CodeIgniter\Model;

class HistoricoEscolarPeriodoModel extends Model
{
    protected $table = 'historico_escolar_periodo';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_historico', 'estabelecimento', 'municipio', 'uf', 'turma', 
        'ano_letivo', 'resultado', 'carga_horaria_total', 'frequencia', 
        'observacao', 'ordem'
    ];
    
    protected $returnType     = 'object';
    protected $useSoftDeletes = true;
    
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    /**
     * Busca períodos de um histórico específico
     * 
     * @param int $idHistorico
     * @return array
     */
    public function getByHistorico($idHistorico)
    {
        return $this->where('id_historico', $idHistorico)
                    ->where('deleted_at', null)
                    ->orderBy('ordem', 'ASC')
                    ->orderBy('ano_letivo', 'ASC')
                    ->findAll();
    }

    /**
     * Busca período com contagem de notas
     * 
     * @param int $id
     * @return object|null
     */
    public function getComNotas($id)
    {
        return $this->select('historico_escolar_periodo.*, COUNT(historico_escolar_notas.id) as total_notas')
                    ->join('historico_escolar_notas', 'historico_escolar_notas.id_periodo = historico_escolar_periodo.id', 'left')
                    ->where('historico_escolar_periodo.id', $id)
                    ->where('historico_escolar_periodo.deleted_at', null)
                    ->groupBy('historico_escolar_periodo.id')
                    ->first();
    }

    /**
     * Atualiza ordem dos períodos de um histórico
     * 
     * @param int $idHistorico
     * @return bool
     */
    public function atualizarOrdem($idHistorico)
    {
        $periodos = $this->where('id_historico', $idHistorico)
                         ->where('deleted_at', null)
                         ->orderBy('ano_letivo', 'ASC')
                         ->findAll();
        
        $ordem = 1;
        foreach ($periodos as $periodo) {
            $this->update($periodo->id, ['ordem' => $ordem]);
            $ordem++;
        }
        
        return true;
    }
}

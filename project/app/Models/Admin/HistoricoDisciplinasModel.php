<?php 

namespace App\Models\Admin;

use CodeIgniter\Model;

class HistoricoDisciplinasModel extends Model
{
    protected $table = 'historico_disciplinas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['descricao', 'carga_horaria'];
    
    protected $returnType     = 'object';
    protected $useSoftDeletes = true;
    
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    /**
     * Busca todas as disciplinas ativas
     * 
     * @return array
     */
    public function getAtivas()
    {
        return $this->where('deleted_at', null)
                    ->orderBy('descricao', 'ASC')
                    ->findAll();
    }

    /**
     * Verifica se já existe uma disciplina com o mesmo nome
     * 
     * @param string $descricao
     * @param int|null $excludeId ID para excluir da verificação (usado na edição)
     * @return bool
     */
    public function disciplinaExiste($descricao, $excludeId = null)
    {
        $builder = $this->where('descricao', $descricao)
                        ->where('deleted_at', null);
        
        if ($excludeId) {
            $builder->where('id !=', $excludeId);
        }
        
        return $builder->countAllResults() > 0;
    }
}

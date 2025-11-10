<?php 

namespace App\Models\Admin;

use CodeIgniter\Model;

class HistoricoEscolarModel extends Model
{
    protected $table = 'historico_escolar';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_aluno', 'data_inicio', 'situacao', 'observacao_geral'];
    
    protected $returnType     = 'object';
    protected $useSoftDeletes = true;
    
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    /**
     * Busca histórico de um aluno específico
     * 
     * @param int $idAluno
     * @return object|null
     */
    public function getByAluno($idAluno)
    {
        return $this->where('id_aluno', $idAluno)
                    ->where('deleted_at', null)
                    ->first();
    }

    /**
     * Busca histórico com dados do aluno
     * 
     * @param int $id
     * @return object|null
     */
    public function getComAluno($id)
    {
        return $this->select('historico_escolar.*, alunos.nome as nome_aluno, alunos.matricula, alunos.nascimento as data_nascimento, alunos.naturalidade, alunos.nacionalidade, pais.nome as nome_pai, pais.nome_mae')
                    ->join('alunos', 'alunos.id = historico_escolar.id_aluno')
                    ->join('pais', 'pais.id = alunos.id_pai', 'left')
                    ->where('historico_escolar.id', $id)
                    ->where('historico_escolar.deleted_at', null)
                    ->first();
    }

    /**
     * Lista todos os históricos com dados dos alunos
     * 
     * @return array
     */
    public function listarComAlunos()
    {
        return $this->select('historico_escolar.*, alunos.nome as nome_aluno, alunos.matricula')
                    ->join('alunos', 'alunos.id = historico_escolar.id_aluno')
                    ->where('historico_escolar.deleted_at', null)
                    ->orderBy('alunos.nome', 'ASC')
                    ->findAll();
    }

    /**
     * Verifica se aluno já possui histórico
     * 
     * @param int $idAluno
     * @param int|null $excludeId
     * @return bool
     */
    public function alunoTemHistorico($idAluno, $excludeId = null)
    {
        $builder = $this->where('id_aluno', $idAluno)
                        ->where('deleted_at', null);
        
        if ($excludeId) {
            $builder->where('id !=', $excludeId);
        }
        
        return $builder->countAllResults() > 0;
    }
}

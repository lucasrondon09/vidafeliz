<?php namespace App\Models\Admin;

use CodeIgniter\Model;

class TurmaDisciplinaProfessorModel extends Model
{
    protected $table = 'turma_disciplina_professor';
	protected $primaryKey = 'id';
	protected $allowedFields = ['id_turma', 'id_disciplina', 'id_usuario'];
	
	protected $returnType     = 'object';
    protected $useSoftDeletes = true;
	
	protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
	
    public function getProfessoresByTurmaAndDisciplina($id_turma, $id_disciplina)
    {
        return $this->join('usuarios', 'usuarios.id = turma_disciplina_professor.id_usuario')
                    ->select('usuarios.id, usuarios.nome')
                    ->where('id_turma', $id_turma)
                    ->where('id_disciplina', $id_disciplina)
                    ->findAll();
    }
}

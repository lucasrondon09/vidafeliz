<?php namespace App\Models\Admin;

use CodeIgniter\Model;

class TurmaDisciplinaModel extends Model
{
    protected $table = 'turma_disciplina';
	protected $primaryKey = 'id';
	protected $allowedFields = ['id_turma', 'id_disciplina'];
	
	protected $returnType     = 'object';
    protected $useSoftDeletes = true;
	
	protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getDisciplinaByProfessor($idTurma)
    {
        return $this->db->table('turma_disciplina_professor')
            ->select('disciplinas.*, turma_disciplina.id AS id_turma_disciplina') // Alias aqui
            ->join('disciplinas', 'disciplinas.id = turma_disciplina_professor.id_disciplina')
            ->join('turma_disciplina', 'turma_disciplina.id_turma = turma_disciplina_professor.id_turma AND turma_disciplina.id_disciplina = turma_disciplina_professor.id_disciplina')
            ->where('turma_disciplina_professor.id_turma', $idTurma)
            ->where('turma_disciplina_professor.id_usuario', session()->userId)
            ->where('turma_disciplina_professor.deleted_at IS NULL')
            ->where('disciplinas.deleted_at IS NULL')
            ->get()
            ->getResult();
    }




    public function getDisciplinaByTurma($idTurma)
    {
        return $this->select('disciplinas.*, turma_disciplina.id as id_turma_disciplina')
                    ->join('disciplinas', 'disciplinas.id = turma_disciplina.id_disciplina')
                    ->where('turma_disciplina.id_turma', $idTurma)
                    ->where('turma_disciplina.deleted_at is null')
                    ->findAll();
    }

    public function getDisciplina($idTurma, $idDisciplina)
    {
        return $this->where('id_turma', $idTurma)
                    ->where('id_disciplina', $idDisciplina)
                    ->first();
    }
	
}

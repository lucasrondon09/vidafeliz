<?php namespace App\Models\Admin;

use CodeIgniter\Model;

class TurmaProfessorModel extends Model
{
    protected $table = 'turma_professor';
	protected $primaryKey = 'id';
	protected $allowedFields = ['id_turma', 'id_professor', 'id_auxiliar'];
	
	protected $returnType     = 'object';
    protected $useSoftDeletes = true;
	
	protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getProfessor($idTurma){
        return $this->select('usuarios.id, usuarios.nome')
                                    ->join('usuarios', 'usuarios.id = turma_professor.id_professor')
                                    ->where('id_turma', $idTurma)
                                    ->where('turma_professor.deleted_at is null')
                                    ->where('usuarios.deleted_at is null')
                                    ->orderBy('usuarios.nome', 'ASC')
                                    ->first();
    }


    public function getAuxiliar($idTurma){
        return $this->select('usuarios.id, usuarios.nome')
                                    ->join('usuarios', 'usuarios.id = turma_professor.id_auxiliar')
                                    ->where('id_turma', $idTurma)
                                    ->where('turma_professor.deleted_at is null')
                                    ->where('usuarios.deleted_at is null')
                                    ->orderBy('usuarios.nome', 'ASC')
                                    ->first();
    }


    public function getTurmasByProfessor()
    {
        return $this->select('turmas.*, turma_professor.id AS id_turma_professor')
                    ->join('turmas', 'turmas.id = turma_professor.id_turma')
                    ->where('turma_professor.id_professor', session()->userId)
                    ->where('turma_professor.deleted_at IS NULL')
                    ->where('turmas.deleted_at IS NULL')
                    ->groupBy('turmas.id')
                    ->get()
                    ->getResult();
    }

	
}

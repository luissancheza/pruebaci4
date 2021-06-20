<?php
namespace App\Models;
use CodeIgniter\Model;

class EstadoModel extends Model{
    protected $table      = 'c_estado';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id', 'nombre'];

    protected $useTimestamps = true;

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;


    public function get_estados(){
        $query = "SELECT id, nombre
                    FROM c_estado 
                  ";
        return $this->db->query($query)->getResult();
    }
}
<?php
namespace App\Models;
use CodeIgniter\Model;

class MunicipioModel extends Model{
    protected $table      = 'c_municipio';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id', 'nombre'];

    protected $useTimestamps = true;

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;


    public function get_municipios(){
        $query = "SELECT id, nombre
                    FROM c_municipio 
                  ";
        return $this->db->query($query)->getResult();
    }

    public function get_municipiosxestado($idestado){
        $query = "SELECT id, nombre
                    FROM c_municipio
                    WHERE id_estado = ?
                  ";
        return $this->db->query($query, [$idestado])->getResult();
      }
}
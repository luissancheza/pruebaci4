<?php
namespace App\Models;
use CodeIgniter\Model;

class DireccionesModel extends Model{

    public function buscar_direcciones($idestado, $idmunicipio, $localidad, $direccion){
        $datos = [];  
        $where = "";
          if($idestado != 0){
            $where .= " AND d.id_estado = ?";
            array_push($datos, $idestado);
          }
          if($idmunicipio != -1){
            $where .= " AND d.id_municipio = ?";
            array_push($datos, $idmunicipio);
          }
          if($localidad != ""){
            $scape = $this->db->escapeString($localidad);
            $where .= " AND d.localidad LIKE '%{$scape}%' ";
          }
          if($direccion != ""){
            $scape = $this->db->escapeString($direccion);
            $where .= " AND d.direccion LIKE '%{$scape}%' ";
          }
        $query = "SELECT d.id, e.nombre AS nestado, m.nombre AS nmunicipio 
        FROM direccion d
        INNER JOIN c_estado e ON e.id = d.id_estado
        INNER JOIN c_municipio m ON m.id = d.id_municipio
        WHERE  1 = 1 $where ";
        return $this->db->query($query, $datos)->getResult();
    }

    public function insert_update_direccion($idestado, $idmunicipio, $localidad, $latitud, $longitud, $direccion, $iddireccion = null){
        if($iddireccion){
            $str_query = "UPDATE direccion SET id_estado = ?, id_municipio = ?, localidad = ?, latitud = ?, longitud = ?, direccion = ? WHERE id = ?";
            return $this->db->query($str_query, [$idestado, $idmunicipio, $localidad, $latitud, $longitud, $direccion, $iddireccion]);
        }else{
            $str_query = "INSERT INTO direccion(id_estado, id_municipio, localidad, latitud, longitud, direccion) VALUES(?, ?, ?, ?, ?, ?)";
            return $this->db->query($str_query, [$idestado, $idmunicipio, $localidad, $latitud, $longitud, $direccion]);
        }
    }

    public function get_infoDireccion($iddireccion){
        $query = "SELECT id, id_estado, id_municipio, localidad, latitud, longitud, direccion FROM direccion 
        WHERE  id = ? ";
        return $this->db->query($query, [$iddireccion])->getRow();
      }
}
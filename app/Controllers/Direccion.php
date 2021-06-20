<?php
namespace App\Controllers;
use App\Models\EstadoModel;
use App\Models\MunicipioModel;
use App\Models\DireccionesModel;

use CodeIgniter\HTTP\RequestInterface;

use App\Controllers\BaseController;

class Direccion extends BaseController{
    protected $estados;
    protected $municipio;
    protected $request;

    public function __construct(){
        $this->estado = new EstadoModel();
        $this->municipio = new MunicipioModel();
        $this->direccion = new DireccionesModel();
        $this->request = \Config\Services::request();
    }

    public function index(){
        $data = array();
        $data['estados'] = $this->estado->get_estados();
        pagina_webapp("direccion/index", $data);
    }

    public function get_municipiosxestado() {
        if ($this->request->isAJAX()) {
            // $idestado = $this->input->post("idestado");
            $idestado = $this->request->getVar('idestado');
            // echo $idestado; die();
            $municipios = $this->municipio->get_municipiosxestado($idestado);
            
            $data = array(
                'municipios' => $municipios,
            );
            echo json_encode($data);
        }
	}

    public function buscar_direcciones(){
        if ($this->request->isAJAX()) {
            // echo"<pre>";
            // print_r($_POST);
            // die();
            $idestado = $this->request->getVar("slc_estado");
            $idmunicipio = $this->request->getVar("slc_municipio");
            $localidad = $this->request->getVar("txt_localidad");
            $direccion = $this->request->getVar("txt_direccion");

            $direcciones = $this->direccion->buscar_direcciones($idestado, $idmunicipio, $localidad, $direccion);
            
            $response = array(
                'direcciones' => $direcciones,
            );
    
            echo json_encode($response);
        }
    }

    public function direccion() {
        $data = array();
        $data['estados'] = $this->estado->get_estados();
        pagina_webapp("direccion/direccion", $data);
	}

    public function insert_update() {
        if ($this->request->isAJAX()) {
            $iddireccion = $this->request->getVar("iddireccion");
            $idestado = $this->request->getVar("slc_estado");
            $idmunicipio = $this->request->getVar("slc_municipio");
            $localidad = $this->request->getVar("txt_localidad");
            $latitud = $this->request->getVar("txt_latitud");
            $longitud = $this->request->getVar("txt_longitud");
            $direccion = $this->request->getVar("txt_direccion");

            if($iddireccion == 0){
                $status = $this->direccion->insert_update_direccion($idestado, $idmunicipio, $localidad, $latitud, $longitud, $direccion);
            }else{
                $status = $this->direccion->insert_update_direccion($idestado, $idmunicipio, $localidad, $latitud, $longitud, $direccion, $iddireccion);
            }
            
            $response = array(
                'respuesta' => $status,
            );
    
            echo json_encode($response);
        };
	}

    public function editar_direccion($iddireccion){
        $data = array();
        $data['iddireccion'] = $iddireccion;
        $data['estados'] = $this->estado->get_estados();
        $datos = $this->direccion->get_infoDireccion($iddireccion);
        $data['municipios'] = $this->municipio->get_municipiosxestado($datos->id_estado);
        $data['datos'] = $datos;
        pagina_webapp('direccion/direccion', $data);
    }

    public function delete_direccion() {
        if ($this->request->isAJAX()) {
            $iddireccion = $this->request->getVar("iddireccion");
            
            $status = $this->direccion->delete_direccion($iddireccion);

            $response = array(
                'respuesta' => $status,
            );
    
            echo json_encode($response);
        };
	}
}

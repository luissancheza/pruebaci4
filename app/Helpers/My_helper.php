<?php  if(!defined('APPPATH')) exit('No direct script access allowed');


if(!function_exists('chicking_helper')) {
       function chicking_helper(){
           return 'welcome to helper function';
       }
}

if(!function_exists('pagina_webapp')) {
    function pagina_webapp($view, $data){
      echo view("templates/header", $data );
      echo view($view, $data );
      echo view("templates/footer", $data );
    }
  }

if(!function_exists('respuesta_ajax')){
  function respuesta_ajax( $output, $response) {
    
    $response->setStatusCode(response::HTTP_OK);
    $response->setBody($output);
    $response->setHeader('Content-type', 'text/html');
    $response->noCache();

    // Sends the output to the browser
    // This is typically handled by the framework
    return $response->send();
  }
} //respuesta_ajax

if(!function_exists('enviaDataJson')){
    function enviaDataJson($status, $data, $contexto) {
        $response = service('response');

        $response->setStatusCode(Response::HTTP_OK);
        $response->setBody($output);
        $response->setHeader('Content-type', 'text/html');
        $response->noCache();

        // Sends the output to the browser
        // This is typically handled by the framework
        return $response->send();
    }// enviaDataJson()
}




?>

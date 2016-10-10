<?php
namespace App\Controllers;

use App\Model\UsuarioModel;
use App\DAO\UsuarioDAO;

class UsuarioController 
{
	private $c;
	private $logger;

    public function __construct($c)
    {
	    $this->c = $c;
        $this->logger = $c->get('logger');	
	    
        $this->logger->info(__CLASS__.":".__FUNCTION__."();");
	}

	public function guardar($uuid)
	{
        $this->logger->info(__CLASS__.":".__FUNCTION__."();");
	    $this->logger->info("uuid:".$uuid);
	   
	    $enviar = true;
	    $errores = "";

	    if(!isset($uuid) && strlen($uuid)==0){
	        $enviar = false;
	        $errores .= "\nuuid no recibido";        
	    }
		if($enviar){	
		    $this->logger->info("Guardar");
		    $model = new UsuarioModel($this->logger);
		    $model->setUUID($uuid);
		    list($result,$mensaje) = $this->c->UsuarioDAO->guardar($model);
	    	if($result){
		    	$data = array('result' => $result, 'mensaje' => $mensaje);
			} else {
			    $data = array('result' => $result, 'errores' => $mensaje);
			}	
		} else {
		    $data = array('result' => $enviar, 'errores' => $errores);
		}

	    return $data;
 	}
}
?>
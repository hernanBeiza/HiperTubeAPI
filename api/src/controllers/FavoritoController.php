<?php
namespace App\Controllers;

use App\Model\FavoritoModel;
use App\DAO\FavoritoDAO;

class FavoritoController 
{
	private $c;
	private $logger;

    public function __construct($c)
    {
	    $this->c = $c;
        $this->logger = $c->get('logger');	
	    
        $this->logger->info(__CLASS__.":".__FUNCTION__."();");
	}

	public function guardar($uuid,$videoid,$nombre,$descripcion,$miniatura)
	{
		$this->logger->info(__CLASS__.":".__FUNCTION__."();");
	    $this->logger->info("uuid:".$uuid);
	    $this->logger->info("videoid:".$videoid);
	    $this->logger->info("nombre:".$nombre);
	    $this->logger->info("descripcion:".$descripcion);
	    $this->logger->info("miniatura:".$miniatura);
		
	    $enviar = true;
	    $errores = "";

	    if(!isset($uuid) && strlen($uuid)==0){
	        $enviar = false;
	        $errores .= "\nuuid no recibido";        
	    }

	    if(!isset($videoid)&& strlen($videoid)==0){
	        $enviar = false;
	        $errores .= "\nvideoid no recibido";        
	    }	    

	    if(!isset($nombre)&& strlen($nombre)==0){
	        $enviar = false;
	        $errores .= "\nnombre no recibido";        
	    }

	    if(!isset($descripcion)&& strlen($descripcion)==0){
	        $enviar = false;
	        $errores .= "\ndescripcion no recibido";        
	    }	    

	    if(!isset($miniatura)&& strlen($miniatura)==0){
	        $enviar = false;
	        $errores .= "\nminiatura no recibido";        
	    }

	    if($enviar){	
		    $this->logger->info("enviar");
		    $model = new FavoritoModel($this->logger);
		    $model->setUUID($uuid);
		    $model->setVideoID($videoid);
		    $model->setNombre($nombre);
		    $model->setDescripcion($descripcion);
		    $model->setMiniatura($miniatura);
		    //$this->logger->info($model->jsonSerialize());		    
	    	list($result,$mensaje) = $this->c->FavoritoDAO->guardar($model);

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

	public function obtener($uuid)
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
	    	$mensaje = "Datos recibidos";
	    	$favoritos = $this->c->FavoritoDAO->obtener($uuid);
	    	/*
	    	foreach ($favoritos as $favorito) {
    		    //$this->logger->info("uuid-> ".$favorito->toString());
				$this->logger->info("uuid-> ".$favorito);   
		    }
			*/
		    $data = array('result' => $enviar, 'mensaje' => $mensaje, 'favoritos' => $favoritos);
		} else {
		    $data = array('result' => $enviar, 'errores' => $errores);
		}

	    return $data;
	}
}
?>
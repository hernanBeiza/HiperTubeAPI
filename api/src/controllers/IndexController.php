<?php
namespace App\Controllers;

use App\Model\IndexModel;

class IndexController 
{
	private $c;
	private $logger;

    public function __construct($logger,$c)
    {
        $this->logger = $logger;	
	    $this->c = $c;
	    
	    $this->logger->info("IndexController: __construct");
	}

	public function obtener()
	{
	    $this->logger->info("IndexController: obtener");
    	$dato = $this->c->IndexModel->obtener();
		$this->logger->info("IndexController:".$dato);
		return "Bienvenido a la API de Hipertube";
	}
}
?>
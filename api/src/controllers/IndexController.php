<?php
namespace App\Controller;

use App\Model\IndexModel;

class IndexController 
{
	private $logger;

    public function __construct($logger)
    {
        $this->logger = $logger;	
	    $this->logger->info("IndexController: __construct");
	}

	public function obtener()
	{
	    $this->logger->info("IndexController: obtener");
		//var $model = new App\Model\IndexModel();
	    //$this->logger->info($model->obtener());
		return "Soy IndexController";
	}
}
?>
<?php
namespace App\Model;

class IndexModel
{
	private $logger;

    public function __construct($logger)
    {
        $this->logger = $logger;	
	    $this->logger->info("IndexModel: __construct");
	}

    public function obtener()
    {
    	return "Y yo soy IndexModel";    	
    }
}
?>
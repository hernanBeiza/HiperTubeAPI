<?php
namespace App\Model;

class UsuarioModel
{
	private $logger;

    private $uuid;
    
    public function __construct($logger)
    {
        $this->logger = $logger;	
        $this->logger->info(__CLASS__.":".__FUNCTION__."();");
	}

    public function setUUID ($uuid){
        //$this->logger->info("uuid: ".$uuid);
        $this->uuid = $uuid;
    }

    public function getUUID (){
        //$this->logger->info("uuid: ".$this->uuid);
        return $this->uuid;
    }

    public function jsonSerialize() {
        $yo = [
            'uuid' => $this->uuid
        ];
        return json_encode($yo);
    }


}
?>
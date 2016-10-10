<?php
namespace App\Model;

class FavoritoModel
{
    private $logger;

    private $uuid;
    private $videoid;
    private $nombre;
    private $descripcion;
    private $miniatura;
    
    /*
    public function __construct($uuid,$videoid)
    {
        $this->uuid = $uuid;
        $this->videoid = $videoid;
    }
    */
    public function __construct($logger)
    {        
        $this->logger = $logger;
        //$this->logger->info(__CLASS__.":".__FUNCTION__."();");
    }

    public function setUUID ($uuid){
        //$this->logger->info("uuid: ".$uuid);
        $this->uuid = $uuid;
    }

    public function getUUID (){
        //$this->logger->info("uuid: ".$this->uuid);
        return $this->uuid;
    }

    public function setVideoID ($videoid){
        $this->videoid = $videoid;
    }

    public function getVideoID (){
        return $this->videoid;
    }


    public function setNombre ($nombre){
        $this->nombre = $nombre;
    }

    public function getNombre (){
        return $this->nombre;
    }


    public function setDescripcion ($descripcion){
        $this->descripcion = $descripcion;
    }

    public function getDescripcion (){
        return $this->descripcion;
    }


    public function setMiniatura ($miniatura){
        $this->miniatura = $miniatura;
    }

    public function getMiniatura (){
        return $this->miniatura;
    }

    public function jsonSerialize() {
        /*
        $this->logger->info("jsonSerialize: ".get_object_vars($this));
        foreach (get_object_vars($this) as $key => $value) {
            $this->logger->info($key." ".$value);
        }
        json_encode(get_object_vars($this));        
        */
        $yo = [
            'uuid' => $this->uuid,
            'videoid' => $this->videoid,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'miniatura' => $this->miniatura
        ];

        return json_encode($yo);
    }

}
?>
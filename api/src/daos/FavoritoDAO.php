<?php
namespace App\DAO;

use App\DAO\DBDAO;
use App\Model\FavoritoModel;

class FavoritoDAO extends DBDAO
{
    private $c;
    private $logger;

    public function __construct($c)
    {
        $this->c = $c;
        $this->logger = $c->get('logger');  
        
        parent::__construct($this->logger);
        
        $this->logger->info(__CLASS__.":".__FUNCTION__."();");
	}

    public function obtener($uuid)
    {
        $this->logger->info(__CLASS__.":".__FUNCTION__."();");
        $mysqli = $this->mysqli;
        $sql = "SELECT * FROM favorito WHERE uuid =".$uuid;
        $this->logger->info($sql);

        $result = $mysqli->query($sql) or die($mysqli->error.__LINE__);
        $favoritos = array();

        if ($result = $mysqli->query($sql)) {
            if($result->num_rows > 0) {
                while($fila = $result->fetch_assoc()) {
                    $modelo = new FavoritoModel($this->logger);
                    $modelo->setUUID($fila['uuid']);
                    $modelo->setIDVIdeo($fila['idvideo']);
                    $modelo->setNombre($fila['nombre']);
                    $modelo->setDescripcion($fila['descripcion']);
                    $modelo->setMiniatura($fila['miniatura']);
                    array_push($favoritos, $modelo->jsonSerialize());
                }
                $result->close();
            } else {
                $favoritos = null;
            }
        }
        
        return $favoritos;
    }

    public function obtenerConUUIDAndIDVideo($uuid,$idvideo){
        $this->logger->info(__CLASS__.":".__FUNCTION__."();");
        $mysqli = $this->mysqli;
        $sql = "SELECT * FROM favorito WHERE idvideo ='".$idvideo."' AND uuid='".$uuid."'";
        $this->logger->info($sql);

        $result = $mysqli->query($sql) or die($mysqli->error.__LINE__);

        if ($result = $mysqli->query($sql)) {
            if($result->num_rows > 0) {
                while($fila = $result->fetch_assoc()) {
                    $modelo = new FavoritoModel($this->logger);
                    $modelo->setUUID($fila['uuid']);
                    $modelo->setIDVideo($fila['idvideo']);
                    $modelo->setNombre($fila['nombre']);
                    $modelo->setDescripcion($fila['descripcion']);
                    $modelo->setMiniatura($fila['miniatura']);
                }
                $result->close();
                $info = array(true,"Encontramos tu video :)",$modelo->jsonSerialize()); 
            } else {
                $info = array(false,"No tienes un video guardado :(",null); 
            }
        }        
        return $info;      
    }
    
    public function guardar($model)
    {
        $this->logger->info(__CLASS__.":".__FUNCTION__."();");

        list($encontrado,$favoritoModel,$mensaje) = $this->obtenerConUUIDAndIDVideo($model->getUUID(),$model->getIDVideo());
        if($encontrado){
            $info = array(false,"Ya agregaste este video a tus favoritos :)");
        } else {            
            $mysqli = $this->mysqli;
            $sql = "INSERT INTO favorito (uuid,idvideo,nombre,descripcion,miniatura) ";
            $sql.= "VALUES ('".$model->getUUID()."','".$model->getIDVideo()."','".$mysqli->real_escape_string($model->getNombre())."', '".$mysqli->real_escape_string($model->getDescripcion())."', '".$model->getMiniatura()."')";
            $this->logger->info($sql);
            $result = $mysqli->query($sql) or die($mysqli->error.__LINE__);
            if($result) {
                $info = array(true,"¡Guardamos tu video en favoritos! :)");
            } else {
                $info = array(false,"No pudimos guardar el video :(");
            }
        }
        return $info;
    }
    
}
?>
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
                    /*
                    $favorito = array(
                        "id" => $fila['id'],
                        "nombre" => $fila['nombre'],
                        "estilos" => $fila['estilos'],
                        "valid" => $fila['valid'],
                    );
                    */
                    $modelo = new FavoritoModel($this->logger);
                    $modelo->setUUID($fila['uuid']);
                    $modelo->setVideoID($fila['videoid']);
                    array_push($favoritos, $modelo->jsonSerialize());
                }
                $result->close();
            } else {
                $favoritos = null;
            }
        }
        
        return $favoritos;
    }

    /*
    public function guardar($uuid,$videoid,$nombre,$descripcion,$miniatura)
    {
        $this->logger->info(__CLASS__.":".__FUNCTION__."();");
        $mysqli = $this->mysqli;
        $sql = "INSERT INTO favorito (uuid,idvideo,nombre,descripcion,miniatura) ";
        $sql.= "VALUES ('".$uuid."','".$videoid."','".$mysqli->real_escape_string($nombre)."', '".$mysqli->real_escape_string($descripcion)."', '".$miniatura."')";
        $this->logger->info($sql);
        $result = $mysqli->query($sql) or die($mysqli->error.__LINE__);
        if($result) {
            $info = array(true,"Video guardado correctamente");
        } else {
            $info = array(false,"El video no se guardó");
        }
        return $info;
    }
    */
    
    public function guardar($model)
    {
        $this->logger->info(__CLASS__.":".__FUNCTION__."();");
        $mysqli = $this->mysqli;
        $sql = "INSERT INTO favorito (uuid,idvideo,nombre,descripcion,miniatura) ";
        $sql.= "VALUES ('".$model->getUUID()."','".$model->getVideoID()."','".$mysqli->real_escape_string($model->getNombre())."', '".$mysqli->real_escape_string($model->getDescripcion())."', '".$model->getMiniatura()."')";
        $this->logger->info($sql);
        $result = $mysqli->query($sql) or die($mysqli->error.__LINE__);
        if($result) {
            $info = array(true,"Video guardado correctamente");
        } else {
            $info = array(false,"El video no se guardó");
        }
        return $info;
    }
    
}
?>
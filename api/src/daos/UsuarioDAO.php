<?php
namespace App\DAO;

use App\DAO\DBDAO;
use App\Model\UsuarioModel;

class UsuarioDAO extends DBDAO
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

    public function obtener()
    {
        $this->logger->info(__CLASS__.":".__FUNCTION__."();");
        $mysqli = $this->mysqli;
        $sql = "SELECT * FROM usuario";
        $this->logger->info($sql);

        $result = $mysqli->query($sql) or die($mysqli->error.__LINE__);
        $usuarios = array();

        if ($result = $mysqli->query($sql)) {
            if($result->num_rows > 0) {
                while($fila = $result->fetch_assoc()) {
                    $modelo = new UsuarioModel($this->logger);
                    $modelo->setUUID($fila['uuid']);
                    array_push($usuarios, $modelo->jsonSerialize());                
                }
                $result->close();
                $info = array(true,$usuarios,"Usuario guardado correctamente");
            } else {
                $info = array(false,null,"No hay usuarios aún :(");
            }
        }
        
        return $info;        
    }

    public function guardar($usuarioModel)
    {
        $this->logger->info(__CLASS__.":".__FUNCTION__."();");

        list($result,$usuario,$mensaje) = $this->obtenerConUUID($usuarioModel->getUUID());
        if($result){
            $info = array(false,$mensaje);
        } else {
            $mysqli = $this->mysqli;
            $sql = "INSERT INTO usuario (uuid) ";
            $sql.= "VALUES ('".$usuarioModel->getUUID()."')";
            $this->logger->info($sql);
            $result = $mysqli->query($sql) or die($mysqli->error.__LINE__);
            if($result) {
                $info = array(true,"Usuario guardado correctamente");
            } else {
                $info = array(false,"El usuario no se guardó");
            }            
        }
        return $info;
    }

    public function obtenerConUUID($uuid)
    {
        $this->logger->info(__CLASS__.":".__FUNCTION__."();");
        $mysqli = $this->mysqli;
        $sql = "SELECT * FROM usuario WHERE uuid =".$uuid;
        $this->logger->info($sql);
        $result = $mysqli->query($sql) or die($mysqli->error.__LINE__);
        if ($result = $mysqli->query($sql)) {
            if($result->num_rows > 0) {
                while($fila = $result->fetch_assoc()) {
                    $modelo = new UsuarioModel($this->logger);
                    $modelo->setUUID($fila['uuid']);
                    array_push($usuarios, $modelo->jsonSerialize());                
                }
                $result->close();
                $info = array(true,$modelo,"Ya existe un usuario con ese UUID");
            } else {
                $info = array(false,null,"No hay usuarios con ese UUID :(");
            }
        }        
        return $info;        
    }
    
}
?>
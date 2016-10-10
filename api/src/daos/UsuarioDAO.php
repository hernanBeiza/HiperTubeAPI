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

    public function guardar($usuarioModel)
    {
        $this->logger->info(__CLASS__.":".__FUNCTION__."();");
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
        return $info;
    }
    
}
?>
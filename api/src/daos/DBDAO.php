<?php
namespace App\DAO;

class DBDAO 
{
    private $logger;

	private $host="localhost";
	private $user = 'root';
	private $password = 'j5U1Hcui';
	private $db = 'hipertubedb';

	public $mysqli;

    public function __construct($logger){
		$this->logger=$logger;
        $this->logger->info(__CLASS__.":".__FUNCTION__."();");		
		$this->conectar();
	}

	public function conectar() {
		//logPHP(basename(__FILE__, '.php'),__FUNCTION__);
		//Usar \ en una clase con namespace
		$this->mysqli = new \MySQLi($this->host, $this->user, $this->password, $this->db);
		/* Cambiar el conjunto de caracteres a utf8 */
		if (!$this->mysqli->set_charset("utf8")) {
			//logPHP(basename(__FILE__, '.php'),"Error cargando el conjunto de caracteres utf8: ".$this->mysqli->error);
		} else {
			//logPHP(basename(__FILE__, '.php'),"Conjunto de caracteres actual: ". $this->mysqli->character_set_name());
		}
		/* Revisar conexión */
		if (mysqli_connect_errno()) {
			//logPHP(basename(__FILE__, '.php'),"Connect failed: %s\n", mysqli_connect_error());
		    exit();
		}
	}

	public function desconectar() {
		//logPHP(basename(__FILE__, '.php'),__FUNCTION__);
		if (mysqli_close($this->mysqli)) {
			//logPHP(basename(__FILE__, '.php'),"Conexión cerrada");
			unset($host);
			unset($user);
			unset($password);
			unset($db);			
			unset($mysqli);
		} else {
			//logPHP(basename(__FILE__, '.php'),"Conexión no cerrada");
		}
	}

	function __destruct() {
		//logPHP(basename(__FILE__, '.php'),__FUNCTION__);
	}

}
?>
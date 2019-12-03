<?php 
	session_start();
	
	class conectorBD{
		private $host = 'localhost';
		private $user = 'root';
		private $password = '';
		public $database = 'agenda';

		public $conexion;

	function verifyConexion(){ 

	    $init = @$this->conexion = new mysqli($this->host, $this->user, $this->password); 

	    if( ! $this->conexion ){ 
	      $conexion['msg'] = "<h3>Error al conectarse a la base de datos.</h3>";
	    }
	    
	   		 echo json_encode($conexion); 
	  }

	  function initConexion($nombre_db){
	  	$this->conexion = new mysqli($this->host, $this->user, $this->password, $nombre_db);
	  	if ($this->conexion->connect_error) {
	  		return $this->conexión->connect_errno;
	  	}else{
	  		return "OK";
	  	}
	  }

	  function userSession(){
	  	if (isset($_SESSION['email'])) {
	  		$response['msg'] = $_SESSION['email'];
	  	}else{
	  		$response['msg'] = '';
	  	}
	  	return json_encode($response);
	  }

	  function verifyUsers(){
	  	$sql = 'SELECT COUNT(email) FROM usuarios';
	  	$totalUsers = $this->ejecutarQuery($sql);
	  	while ($row = $totalUsers->fetch_assoc()) {

	  		return $row['COUNT(email)'];
	  	}
	  }

	  function getConexion(){
	  	return $this->conexion;
	  }
	  function ejecutarquery($query){
	  	return $this->conexion->query($query);
	  }
	  
	  function cerrarConexion(){
	  	$this->conexion->close();
	  }
	  function crearDB(){
	  	$this->conexion =new mysqli($this->host,$this->user,$this->password);
	  	$query = $this->conexion->query('CREATE DATABASE IF NOT EXISTS '.$this->database);
	  	if ($query == 1) {
	  		return "OK";
	  	}else {
	  		return "Error";
	  	}
	  }
	  
	  
    function insertData($tabla, $data){
    $sql = 'INSERT INTO '.$tabla.' (';
    $i = 1;
    foreach ($data as $key => $value) {
      $sql .= $key;
      if ($i<count($data)) {
        $sql .= ', ';
      }else $sql .= ')';
      $i++;
    }
    $sql .= ' VALUES (';
    $i = 1;
    foreach ($data as $key => $value) {
      $sql .= $value;
      if ($i<count($data)) {
        $sql .= ', ';
      }else $sql .= ');';
      $i++;
    }
    return $this->ejecutarQuery($sql);
  }
  
  function actualizarRegistro($tabla, $data, $condicion){
    $sql = 'UPDATE '.$tabla.' SET ';
    $i=1;
    foreach ($data as $key => $value) {
      $sql .= $key.'='.$value;
      if ($i<sizeof($data)) {
        $sql .= ', ';
      }else $sql .= ' WHERE '.$condicion.';';
      $i++;
    }
    return $this->ejecutarQuery($sql);
  }
  
  function eliminarRegistro($tabla, $condicion){
    $sql = "DELETE FROM ".$tabla." WHERE ".$condicion.";";
    return $this->ejecutarQuery($sql);
  }
  
  function consultar($tablas, $campos, $condicion = ""){
    $sql = "SELECT ";
    $result = array_keys($campos);
    $ultima_key = end($result);
    foreach ($campos as $key => $value) {
      $sql .= $value;
      if ($key!=$ultima_key) {
        $sql.=", ";
      }else $sql .=" FROM ";
    }

    $result = array_keys($tablas);
    $ultima_key = end($result);
    foreach ($tablas as $key => $value) {
      $sql .= $value;
      if ($key!=$ultima_key) {
        $sql.=", ";
      }else $sql .= " ";
    }

    if ($condicion == "") {
      $sql .= ";";
    }else {
      $sql .= $condicion.";";
    }
    return $this->ejecutarQuery($sql);
  }
 

}

class Usuarios 
{
  public $nombreTabla = 'usuarios'; 
  public $data = ['email' => 'varchar(50) NOT NULL PRIMARY KEY',
  'nombre' => 'varchar(50) NOT NULL',
  'password' => 'varchar(255) NOT NULL',
  'fecha_nacimiento' => 'date NOT NULL'];

}

class Eventos
{
  public $nombreTabla = 'eventos'; 
  public $data = ['id' => 'INT NOT NULL PRIMARY KEY AUTO_INCREMENT',
  'titulo'=> 'VARCHAR(50) NOT NULL',
  'fecha_inicio'=> 'date NOT NULL',
  'hora_inicio' => 'varchar(20)',
  'fecha_finalizacion'=> 'varchar(20)',
  'hora_finalizacion'=> 'varchar(20)',
  'allday'=> 'tinyint(1) NOT NULL',
  'fk_usuarios'=>'varchar(50) NOT NULL'];
}

 ?>
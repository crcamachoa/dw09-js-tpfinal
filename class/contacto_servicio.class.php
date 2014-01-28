<?php
class Contacto_servicio {
	private static $instancia;
	private $dbh;
	private $rowPage;
	private function __construct() {
		$rowPage = 3;
		try {
			$this->open_conection();
			$this->dbh->exec ( "SET CHARACTER SET utf8" );
			$this->dbh->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$this->dbh->setAttribute ( PDO::ATTR_EMULATE_PREPARES, false );
		} catch ( PDOException $e ) {
			print "Error!: " . $e->getMessage ();
			die ();
		}
	}
	public function __destruct(){
		$this->dbh = null;
	}
	private function open_conection(){
		include "/bd.php";
		$this->dbh = new PDO ( "pgsql:dbname=$dbname;host=$host;user=$user;password=$password" );
	}
	private function close_conection(){
		$this->dbh = null;
	}
	public static function singleton() {
		if (! isset ( self::$instancia )) {
			$miclase = __CLASS__;
			self::$instancia = new $miclase ();
		}
		return self::$instancia;
	}
	public function vaciar_contacto_servicio($id) {
		try {
			$query = $this->dbh->prepare('delete from contacto_servicio where contacto = ?');
			$query->bindParam ( 1, $id );
			$query->execute ();
		} catch ( PDOException $e ) {
			$e->getMessage ();
		}
	}
	public function asignar_servicio($id, $servicio) {
		try {
			$query = $this->dbh->prepare('insert into contacto_servicio(contacto, servicio) values(?,?)');
			$query->bindParam ( 1, $id );
			$query->bindParam ( 2, $servicio );
			$query->execute ();
		} catch ( PDOException $e ) {
			$e->getMessage ();
		}
	}
	public function get_contacto_servicios($id) {
		try {
			$query = $this->dbh->prepare ( 'select r.id as rid, r.nombre as rnombre, s.id as sid, s.servicio as sservicio 
					from contacto_servicio cs join servicios s on cs.servicio = s.id join rubro r on r.id = s.id_rubro 
					where contacto = ? order by r.id, s.id' );
			$query->bindParam ( 1, $id );
			$query->execute ();
			return $query->fetchAll();
		} catch ( PDOException $e ) {
			$e->getMessage ();
		}
	}
	public function get_contacto_servicio_check($contacto, $servicio) {
		try {
			$query = $this->dbh->prepare ( 'select count(1) as existe from contacto_servicio where contacto = ? and servicio = ?');
			$query->bindParam ( 1, $contacto );
			$query->bindParam ( 2, $servicio );
			$query->execute ();
			return $query->fetch();
		} catch ( PDOException $e ) {
			$e->getMessage ();
		}
	}
	public function getContactosPorServicio($servicio) {
		try {
			
			if($servicio != "todos")
            {        
                $sql = "select distinct (con.id), con.nombre, con.apellido, con.ci, con.email, 
                    con.telefono, con.direccion, con.observacion, ser.servicio 
                    from contacto con 
                        join contacto_servicio conser on con.id = conser.contacto 
                        join servicios ser on conser.servicio = ser.id 
                        join rubro ru on ser.id_rubro = ru.id where ser.id = $servicio" ;
                //$query = $this->dbh->prepare ( $sql );
                //$query->bindParam ( 1, $servicio );
            }
            else{
                $sql = 'select distinct (con.id), con.nombre, con.apellido, con.ci, con.email,
                    con.telefono, con.direccion, con.observacion, ser.servicio 
                    from contacto con 
                        join contacto_servicio conser on con.id = conser.contacto 
                        join servicios ser on conser.servicio = ser.id 
                        join rubro ru on ser.id_rubro = ru.id' ;
                //$query = $this->dbh->prepare ( $sql );
            }
            $query = $this->dbh->prepare ( $sql );
			$query->execute ();
			return $query->fetchAll ();
		} catch ( PDOException $e ) {
			$e->getMessage ();
		}
	}
	public function __clone() {
		trigger_error ( 'La clonacion no es permitida!.', E_USER_ERROR );
	}
}
?>
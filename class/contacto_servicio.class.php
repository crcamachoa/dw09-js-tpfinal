<?php
class Contacto_servicio {
	private static $instancia;
	private $dbh;
	private $rowPage;
	private function __construct() {
		$rowPage = 3;
		include "/bd.php";
		try {
			$this->dbh = new PDO ( "pgsql:dbname=$dbname;host=$host;user=$user;password=$password" );
			$this->dbh->exec ( "SET CHARACTER SET utf8" );
			$this->dbh->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$this->dbh->setAttribute ( PDO::ATTR_EMULATE_PREPARES, false );
		} catch ( PDOException $e ) {
			print "Error!: " . $e->getMessage ();
			die ();
		}
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
			$this->open_conection();
			$query = $this->dbh->prepare('delete from contacto_servicio where contacto = ?');
			$query->bindParam ( 1, $id );
			$query->execute ();
			$this->close_conection();
		} catch ( PDOException $e ) {
			$e->getMessage ();
		}
	}
	public function asignar_servicio($id, $servicio) {
		try {
			$this->open_conection();
			$query = $this->dbh->prepare('insert into contacto_servicio(contacto, servicio) values(?,?)');
			$query->bindParam ( 1, $id );
			$query->bindParam ( 2, $servicio );
			$query->execute ();
			$this->close_conection();
		} catch ( PDOException $e ) {
			$e->getMessage ();
		}
	}
	public function get_contacto_servicios($id) {
		try {
			$this->open_conection();
			$query = $this->dbh->prepare ( 'select r.id as rid, r.nombre as rnombre, s.id as sid, s.servicio as sservicio 
					from contacto_servicio cs join servicios s on cs.servicio = s.id join rubro r on r.id = s.id_rubro 
					where contacto = ? order by r.id, s.id' );
			$query->bindParam ( 1, $id );
			$query->execute ();
			return $query->fetchAll();
			$this->close_conection();
		} catch ( PDOException $e ) {
			$e->getMessage ();
		}
	}
	public function get_contacto_servicio_check($contacto, $servicio) {
		try {
			$this->open_conection();
			$query = $this->dbh->prepare ( 'select count(1) as existe from contacto_servicio where contacto = ? and servicio = ?');
			$query->bindParam ( 1, $contacto );
			$query->bindParam ( 2, $servicio );
			$query->execute ();
			return $query->fetch();
			$this->close_conection();
		} catch ( PDOException $e ) {
			$e->getMessage ();
		}
	}
	public function __clone() {
		trigger_error ( 'La clonación no es permitida!.', E_USER_ERROR );
	}
}
?>
<?php
class Servicio {
	private static $instancia;
	private $dbh;
	private $rowPage;
	private function __construct() {
		$rowPage = 3;
		//include "/bd.php";
		try {
			//$this->dbh = new PDO ( "pgsql:dbname=$dbname;host=$host;user=$user;password=$password" );
			$this->open_conection();
			$this->dbh->exec ( "SET CHARACTER SET utf8" );
			$this->dbh->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$this->dbh->setAttribute ( PDO::ATTR_EMULATE_PREPARES, false );
		} catch ( PDOException $e ) {
			print "Error!: " . $e->getMessage ();
			die ();
		}
	}
	private function __destruct(){
		$this->dbh = null;
	}
	public static function singleton() {
		if (! isset ( self::$instancia )) {
			$miclase = __CLASS__;
			self::$instancia = new $miclase ();
		}
		return self::$instancia;
	}
	private function open_conection(){
		include "/bd.php";
		$this->dbh = new PDO ( "pgsql:dbname=$dbname;host=$host;user=$user;password=$password"  );
	}
	public function get_servicios() {
		try {
			//$this->open_conection();
			$query = $this->dbh->prepare ( 'select * from servicios' );
			$query->execute ();
			return $query->fetchAll ();
			//$this->dbh = null;
		} catch ( PDOException $e ) {
			$e->getMessage ();
		}
	}
	public function get_servicios_json() {
		try {
			//$this->open_conection();
			$query = $this->dbh->prepare ( 'select * from servicios' );
			$query->execute ();
			return json_encode($query->fetchAll ());
			//$this->dbh = null;
		} catch ( PDOException $e ) {
			$e->getMessage ();
		}
	}
	public function get_servicios_rubro() {
		try {
			//$this->open_conection();
			$query = $this->dbh->prepare ( 'select s.id as sid, s.servicio as sservicio, r.id as rid, r.nombre as rnombre
					from servicios s join rubro r on s.id_rubro = r.id order by s.id_rubro, s.id' );
			$query->execute ();
			return $query->fetchAll ();
			//$this->dbh = null;
		} catch ( PDOException $e ) {
			$e->getMessage ();
		}
	}
	public function get_servicio($id) {
		try {
			//$this->open_conection();
			$query = $this->dbh->prepare ( 'select * from servicios where id = ?' );
			$query->bindParam ( 1, $id );
			$query->execute ();
			return $query->fetch ();
			//$this->dbh = null;
		} catch ( PDOException $e ) {
			$e->getMessage ();
		}
	}
	public function get_servicio_rubro($id) {
		try {
			//$this->open_conection();
			$query = $this->dbh->prepare ( 'select s.id as sid, s.servicio as sservicio, r.id as rid, r.nombre as rnombre from servicios s join rubro r on s.id_rubro = r.id where r.id = ?' );
			$query->bindParam ( 1, $id );
			$query->execute ();
			return $query->fetchAll ();
			//$this->dbh = null;
		} catch ( PDOException $e ) {
			$e->getMessage ();
		}
	}
	public function get_servicio_nombre($id) {
		try {
			//$this->open_conection();
			$query = $this->dbh->prepare ( 'select servicio as sservicio from servicios where id = ?' );
			$query->bindParam ( 1, $id );
			$query->execute ();
			return $query->fetch ();
			//$this->dbh = null;
		} catch ( PDOException $e ) {
			$e->getMessage ();
		}
	}
	public function count_servicios() {
		try {
			//$this->open_conection();
			$query = $this->dbh->prepare ( 'select count(1) from servicios' );
			$query->execute ();
			return $query->fetch ();
			//$this->dbh = null;
		} catch ( PDOException $e ) {
			$e->getMessage ();
		}
	}
	public function __clone() {
		trigger_error ( 'La clonación no es permitida!.', E_USER_ERROR );
	}
}
?>
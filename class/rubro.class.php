<?php
class Rubro {
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
	public function get_rubros() {
		try {
			$this->open_conection();
			$query = $this->dbh->prepare ( 'select * from rubro' );
			$query->execute ();
			return $query->fetchAll ();
			$this->dbh = null;
		} catch ( PDOException $e ) {
			$e->getMessage ();
		}
	}
	public function get_rubro($id) {
		try {
			$this->open_conection();
			$query = $this->dbh->prepare ( 'select * from rubro where id = ?' );
			$query->bindParam ( 1, $id );
			$query->execute ();
			return $query->fetch ();
			$this->dbh = null;
		} catch ( PDOException $e ) {
			$e->getMessage ();
		}
	}
	public function count_rubro() {
		try {
			$this->open_conection();
			$query = $this->dbh->prepare ( 'select count(1) from rubro' );
			$query->execute ();
			return $query->fetch ();
			$this->dbh = null;
		} catch ( PDOException $e ) {
			$e->getMessage ();
		}
	}
	public function __clone() {
		trigger_error ( 'La clonación no es permitida!.', E_USER_ERROR );
	}
}
?>
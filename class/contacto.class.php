<?php
class Contacto {
	private static $instancia;
	private $dbh;
	private $rowPage;
	private function __construct() {
		$this->rowPage = 3;
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
	public function get_contactos() {
		try {
			$this->open_conection();
			$query = $this->dbh->prepare ( 'select * from contacto order by id' );
			$query->execute ();
			return $query->fetchAll ();
			$this->dbh = null;
		} catch ( PDOException $e ) {
			$e->getMessage ();
		}
	}
	public function get_contacto($id) {
		try {
			$this->open_conection();
			$query = $this->dbh->prepare ( 'select * from contacto where id = ?' );
			$query->bindParam ( 1, $id );
			$query->execute ();
			return $query->fetch ();
			$this->dbh = null;
		} catch ( PDOException $e ) {
			$e->getMessage ();
		}
	}
	public function get_contactos_where_page($where, $page) {
		$offset = $this->rowPage * $page;
		try {
			$this->open_conection();
			$query = $this->dbh->prepare ( "select * from contacto $where limit ? offset ?" );
			$query->bindParam ( 1, $this->rowPage );
			$query->bindParam ( 2, $offset );
			$query->execute ();
			return $query->fetchAll ();
			$this->dbh = null;
		} catch ( PDOException $e ) {
			$e->getMessage ();
		}
	}
	public function get_contactos_page($page) {
		$offset = $this->rowPage * $page;
		try {
			$this->open_conection();
			$query = $this->dbh->prepare ( 'select * from contacto limit ? offset ?' );
			$query->bindParam ( 1, $this->rowPage );
			$query->bindParam ( 2, $offset );
			$query->execute ();
			return $query->fetchAll ();
			$this->dbh = null;
		} catch ( PDOException $e ) {
			$e->getMessage ();
		}
	}
	public function get_last_id($lineas) {
		try {
			$this->open_conection();
			$query = $this->dbh->prepare('select id from contacto order by id desc limit ?');
			$query->bindParam(1, $lineas);
			$query->execute();
			return $query->fetch ();
			$this->dbh = null;
		} catch ( PDOException $e ) {
			$e->getMessage ();
		}
	}
	public function count() {
		try {
			$this->open_conection();
			$query = $this->dbh->prepare('select count(1) as cantidad from contacto');
			$query->execute();
			return $query->fetch ();
			$this->dbh = null;
		} catch ( PDOException $e ) {
			$e->getMessage ();
		}
	}
	public function count_where($where) {
		try {
			$this->open_conection();
			$query = $this->dbh->prepare ( "select count(1) as cantidad from contacto $where" );
			$query->execute ();
			return $query->fetch ();
			$this->dbh = null;
		} catch ( PDOException $e ) {
			$e->getMessage ();
		}
	}
	public function getRowPage() {
		return $this->rowPage;
	}
	public function delete_contacto($id) {
		try {
			$this->open_conection();
			$query = $this->dbh->prepare ( 'delete from contacto where id = ?' );
			$query->bindParam ( 1, $id );
			$query->execute ();
			$this->dbh = null;
		} catch ( PDOException $e ) {
			$e->getMessage ();
		}
	}
	public function insert_contacto($nombre, $apellido, $ci, $email, $telefono, $direccion, $observacion) {
		try {
			$this->open_conection();
			$query = $this->dbh->prepare ( 'insert into contacto(nombre,apellido,ci,email,telefono,direccion,observacion) values(?,?,?,?,?,?,?)' );
			$query->bindParam ( 1, $nombre );
			$query->bindParam ( 2, $apellido );
			$query->bindParam ( 3, $ci );
			$query->bindParam ( 4, $email );
			$query->bindParam ( 5, $telefono );
			$query->bindParam ( 6, $direccion );
			$query->bindParam ( 7, $observacion );
			$query->execute ();
			$this->dbh = null;
		} catch ( PDOException $e ) {
			$e->getMessage ();
		}
	}
	public function update_contacto($id, $nombre, $apellido, $ci, $email, $telefono, $direccion, $observacion) {
		try {
			$this->open_conection();
			$query = $this->dbh->prepare ( 'update contacto SET nombre = ?, apellido = ?, ci = ?, email = ?, telefono = ?, direccion = ?, observacion = ? WHERE id = ?' );
			$query->bindParam ( 1, $nombre );
			$query->bindParam ( 2, $apellido );
			$query->bindParam ( 3, $ci );
			$query->bindParam ( 4, $email );
			$query->bindParam ( 5, $telefono );
			$query->bindParam ( 6, $direccion );
			$query->bindParam ( 7, $observacion );
			$query->bindParam ( 8, $id );
			$query->execute ();
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
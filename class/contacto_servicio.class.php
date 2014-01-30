<?php
class Contacto_servicio {
	private static $instancia;
	private $dbh;
	private $rowPage;
	private function __construct() {
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
		$this->rowPage = $rowPerPage;
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
	public function getContactosPorServicio($servicio, $offset, $limit, $busqueda) {
		if($offset == 0){
            $_SESSION["actual"] = 1;
        }else{
            $_SESSION["actual"] = ($offset/$limit) + 1;
        }
        $_SESSION["limit"] = $limit;
        $bindBusqueda = '%'.$busqueda.'%';
		try {
			if($servicio != "todos")
            {   if ( $busqueda == "" ){
	                $sql = "select distinct (con.id), con.nombre, con.apellido, con.ci, con.email, 
	                    con.telefono, con.direccion, con.observacion, ser.servicio 
	                    from contacto con 
	                        join contacto_servicio conser on con.id = conser.contacto 
	                        join servicios ser on conser.servicio = ser.id 
	                        join rubro ru on ser.id_rubro = ru.id 
	                    where ser.id = ?
	                    limit ? 
	                    offset ?" ;
	                $query = $this->dbh->prepare ( $sql );
	                $query->bindParam(1, $servicio );
	                $query->bindParam(2, $limit); 
	            	$query->bindParam(3, $offset);
	            }else{
	            	$sql = "select distinct (con.id), con.nombre, con.apellido, con.ci, con.email, 
                    con.telefono, con.direccion, con.observacion, ser.servicio 
                    from contacto con 
                        join contacto_servicio conser on con.id = conser.contacto 
                        join servicios ser on conser.servicio = ser.id 
                        join rubro ru on ser.id_rubro = ru.id 
                    where ser.id = ? 
                    	and (con.id || ' ' || con.nombre  || ' ' || con.apellido 
                    	 || ' ' ||  con.telefono  || ' ' || con.email  || ' ' ||  ru.nombre) like ?
                    limit ? 
                    offset ?" ;
	                $query = $this->dbh->prepare ( $sql );
	                $query->bindParam(1, $servicio );
	                $query->bindParam(2, $bindBusqueda );
	                $query->bindParam(3, $limit); 
	            	$query->bindParam(4, $offset);
	            }
            }
            else{
            	if ( $busqueda == "" ){
	                $sql = "select distinct (con.id), con.nombre, con.apellido, con.ci, con.email,
	                    con.telefono, con.direccion, con.observacion, ser.servicio 
	                    from contacto con 
	                        join contacto_servicio conser on con.id = conser.contacto 
	                        join servicios ser on conser.servicio = ser.id 
	                        join rubro ru on ser.id_rubro = ru.id
	                    limit ?
	                    offset ?" ;
	                $query = $this->dbh->prepare ( $sql );
	                $query->bindParam(1, $limit); 
	            	$query->bindParam(2, $offset);
            	}else{
	            	$sql = "select distinct (con.id), con.nombre, con.apellido, con.ci, con.email,
	                    con.telefono, con.direccion, con.observacion, ser.servicio 
	                    from contacto con 
	                        join contacto_servicio conser on con.id = conser.contacto 
	                        join servicios ser on conser.servicio = ser.id 
	                        join rubro ru on ser.id_rubro = ru.id
                    where (con.id || ' ' || con.nombre  || ' ' || con.apellido 
                    	 || ' ' ||  con.telefono  || ' ' || con.email  || ' ' ||  ru.nombre) like ?
                    limit ?
                    offset ?" ;
	                $query = $this->dbh->prepare ( $sql );
	                $query->bindParam(1, $bindBusqueda);
	                $query->bindParam(2, $limit );
	                $query->bindParam(3, $offset); 
	            }
            }
			$query->execute ();

			// if($query->rowCount() > 0)
   //          {
				return $query->fetchAll ();
			// }
		} catch ( PDOException $e ) {
			$e->getMessage ();
		}
	}
	
	//obtenemos el número de posts totales
    public function get_all_contacto_servicio($servicio, $busqueda)
    {
         $bindBusqueda = '%'.$busqueda.'%';
         try {
         	if($servicio != "todos")
            {
            	if ( $busqueda == "" ){ 
                    $sql = "select count(1)
                        from contacto con 
                            join contacto_servicio conser on con.id = conser.contacto 
                            join servicios ser on conser.servicio = ser.id 
                            join rubro ru on ser.id_rubro = ru.id
                        where ser.id = ?";
                    $query = $this->dbh->prepare($sql);
                    $query->bindParam(1, $servicio );
                }else{
                    $sql = "select count(1)
                        from contacto con 
                            join contacto_servicio conser on con.id = conser.contacto 
                            join servicios ser on conser.servicio = ser.id 
                            join rubro ru on ser.id_rubro = ru.id
                        where ser.id = ?
                            and (con.id || ' ' || con.nombre  || ' ' || con.apellido 
                    	     || ' ' ||  con.telefono  || ' ' || con.email  || ' ' ||  ru.nombre) like ?";
                    $query = $this->dbh->prepare($sql);
                    $query->bindParam(1, $servicio );
                    $query->bindParam(2, $bindBusqueda );
                }
            }else{
                if ( $busqueda == "" ){
                    $sql = "select count(1)
                        from contacto con 
                            join contacto_servicio conser on con.id = conser.contacto 
                            join servicios ser on conser.servicio = ser.id 
                            join rubro ru on ser.id_rubro = ru.id";
                    $query = $this->dbh->prepare($sql);
                }else{
                    $sql = "select count(1)
                        from contacto con 
                            join contacto_servicio conser on con.id = conser.contacto 
                            join servicios ser on conser.servicio = ser.id 
                            join rubro ru on ser.id_rubro = ru.id
                        where (con.id || ' ' || con.nombre  || ' ' || con.apellido 
                    	     || ' ' ||  con.telefono  || ' ' || con.email  || ' ' ||  ru.nombre) like ?";
                    $query = $this->dbh->prepare($sql);
                    $query->bindParam(1, $bindBusqueda );
                }
            }
            
            $query->execute();

            //si es true
            // if($query->rowCount() == 1)
            // {
                return $query->fetchColumn();
            // }
        }catch(PDOException $e){
            print "Error!: " . $e->getMessage();
        }      
    }

    //creamos los enlaces de nuestra paginación
    public function crea_links($servicio, $busqueda)
    {

        //html para retornar
        $html = "";

        //página actual
        $actual_pag = $_SESSION["actual"];

        //limite por página
        $limit = $_SESSION["limit"];

        //total de enlaces que existen
        $totalPag = ceil($this->get_all_contacto_servicio($servicio, $busqueda) / $limit);

        //links delante y detrás que queremos mostrar
        $pagVisibles = 2;

        if($actual_pag <= $pagVisibles)
        {
            $primera_pag = 1;   
        }else{
            $primera_pag = $actual_pag - $pagVisibles; 
        }

        if($actual_pag + $pagVisibles <= $totalPag)
        {
            $ultima_pag = $actual_pag + $pagVisibles;
        }else{
            $ultima_pag = $totalPag;
        }
					

        $html .= '<ul class="pagination">';
        $html .= ($actual_pag > 1) ? 
        ' <li><a href="#"  data-offset="0" data-limit="'.$limit.'" >first</a> </li>' : 
        ' <li class="disabled"><a href="#">first</a> </li>';
        $html .= ($actual_pag > 1) ? 
        ' <li><a href="#" data-offset="'.(($actual_pag-2) * $limit).'" data-limit="'.$limit.'" >back</a> </li>' : 
        ' <li class="disabled"><a href="#">back</a> </li>';
         
        for($i=$primera_pag; $i<=$ultima_pag; $i++) 
        {
            $html .= ($i == $actual_pag) ? 
            ' <li class="active"><a href="#">'.$i.'</a> </li>' : 
            ' <li><a href="#" data-offset="'.(($i-1)*$limit).'" data-limit="'.$limit.'" >'.$i.'</a> </li>';
        }
         
        $html .= ($actual_pag < $totalPag) ? 
        ' <li><a href="#" data-offset="'.(($actual_pag)*$limit).'" data-limit="'.$limit.'" >next</a> </li>' : 
        ' <li class="disabled"><a href="#">next</a> </li>';
        $html .= ($actual_pag < $totalPag) ? 
        ' <li><a href="#" data-offset="'.(($totalPag-1)*$limit).'" data-limit="'.$limit.'" >last</a> </li>' : 
        ' <li class="disabled"><a href="#">last</a> </li>';


        // $html .= ($actual_pag > 1) ? 
        // ' <li><a href="#" class="button round" onclick="paginarContactos('.$servicio.',0,'.$limit.')">Primera</a> </li>' : 
        // ' <li><a href="#" class="button round disabled">Primera</a> </li>';
        // $html .= ($actual_pag > 1) ? 
        // ' <li><a href="#" class="button round" onclick="paginarContactos('.$servicio.','.(($actual_pag-1)*$limit).','.$limit.')">Anterior</a> </li>' : 
        // ' <li><a href="#" class="button round disabled">Anterior</a> </li>';
         
        // for($i=$primera_pag; $i<=$ultima_pag; $i++) 
        // {
        //     $html .= ($i == $actual_pag) ? 
        //     ' <li><a class="button secondary round disabled" href="#">'.$i.'</a> </li>' : 
        //     ' <li><a class="button round" href="#" onclick="paginarContactos('.$servicio.','.(($i)*$limit).','.$limit.')">'.$i.'</a> </li>';
        // }
         
        // $html .= ($actual_pag < $totalPag) ? 
        // ' <li><a href="#" class="button round" onclick="paginarContactos('.$servicio.','.(($actual_pag+1)*$limit).','.$limit.')">Siguiente</a> </li>' : 
        // ' <li><a href="#" class="button round disabled">Siguiente</a> </li>';
        // $html .= ($actual_pag < $totalPag) ? 
        // ' <li><a href="#" class="button round" onclick="paginarContactos('.$servicio.','.(($totalPag)*$limit).','.$limit.')">Última</a> </li>' : 
        // ' <li><a href="#" class="button round disabled">Última</a> </li>';
        $html .= '</ul>';

        return $html;

    }


	public function __clone() {
		trigger_error ( 'La clonacion no es permitida!.', E_USER_ERROR );
	}
}
?>
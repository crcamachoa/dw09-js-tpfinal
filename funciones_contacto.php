<?php function obtenerServicios($conn, $contacto)  
{ 
    $query = "select ser.servicio from contacto con join contacto_servicio conser on con.id = conser.contacto join servicios ser on conser.servicio = ser.id join rubro ru on ser.id_rubro = ru.id where con.id =$contacto"; 
    $resultSet = pg_query($conn,$query); 
  
    if(!$resultSet){ 
        die("Ocurrió un error al ejecutar el query"); 
  
    } 
  
    if($row = pg_fetch_assoc($resultSet)) 
    { 
//          echo "lo logré!"; 
            $servicios=trim($row[ 'servicio']); 
        while($row = pg_fetch_assoc($resultSet)) 
        { 
    //          echo "lo logré!"; 
            $servicios=$servicios.", ".(trim($row['servicio'])); 
        } 
    } 
  
    echo $servicios; 
} 
  
?>
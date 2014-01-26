<?php
require_once 'class/contacto.class.php';
$contactos = Contacto::singleton();
$data = $contactos->get_contactos();

$rec_limit = $contactos->getRowPage(); //obtener lineas por pagina
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<!-- 	<link   href="css/bootstrap.min.css" rel="stylesheet"> -->
	<!-- 	<script src="js/bootstrap.min.js"></script> -->
	<!-- 	<script type="text/javascript" src="js/jquery.js"></script> -->
	<meta charset="utf-8">
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="js/jquery.js"></script> 
	<script type="text/javascript" src="js/jquery-1.10.1.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>

</head>

<body>
	<?php include 'menu.php'; ?>
	<div class="container">
		<br><br><br>
		<div class="row">
			<h3>Contactos</h3>
		</div>
		<div class="row">
			<div id="servicioListaContainer" class="col-md-2">
				<div class="list-group"> 


				</div> 
			</div>
			<div id="contactoTablaContainer" class="col-md-7">
				<table id="tableFilter" class="table table-striped table-bordered">
					<!--                 <table id="tableFilter" class="table table-striped table-hover table-condensed"> -->
					<thead>
						<tr >
							<th>ID</th>
							<th>NOMBRE</th>
							<th>APELLIDO</th>
							<th>TELEFONO</th>
							<th>EMAIL</th>
							<th>SERVICIO</th>
						</tr>
					</thead>
					<tbody class="tbody">

					</tbody>
				</table>
			</div>

			<!-- ZONA D! -->
			<div id="contactoPerfilContainer" class="col-md-3">
				<div class="row">
<!--					<div class="col-sm-6 col-md-6">-->
						<div class="thumbnail">
							<!-- Acá se cargan las imagenes -->
							<img id="pulgarcito" src="" alt="...">
							<div class="caption">
								<h3>Datos de Contacto</h3>
                                <table>
                                <tr>                            
                                <td>Nombre:</td>
								<td id="nombre"></td>                                
                                </tr>
                                <tr>                            
                                <td>Apellido:</td>
								<td id="apellido"></td>                                
                                </tr>
                                <tr>                            
                                <td>Email:</td>
								<td id="email"></td>                                
                                </tr>
                                <tr>                            
                                <td>Telefono:</td>
								<td id="telefono"></td>                                
                                </tr>
                                </table>
                                <br>
								<span>Servicios:</span>
								<p id="servicios"></p>
								<br>

							</div>
						</div>
<!--					</div>-->
				</div>
			</div>
			<!-- FIN DE ZONA D! -->
		</div>
	</div> <!-- /container -->

	<script>
	var getPersona = function(){
        
        $('#contactoPerfilContainer').show(); // Muestra el div detalle (Zona D)
        
		$("tr").removeClass("active");
		$(this).addClass("active")
		var text = $(this).attr("id");
		var ajaxRequest = {};
		ajaxRequest.url = "getPersona.php";
		ajaxRequest.type = "GET";
		
		var id_persona= text.slice(2);
		ajaxRequest.data = {persona : id_persona};
		ajaxRequest.success =function(PersonaJson){
			var persona = PersonaJson;
		 	//Usar para D
		 	//Las fotos se guardan en la carper photos/#.jpg, donde # es el ID del usuario
		 	var foto = "photos/"+persona[0].id+".jpg";
		 	//Se le asigna el atributo src a la foto con el id del clickeado
		 	$("#pulgarcito").attr("src",foto);

		 	$("#nombre").html(persona[0].nombre.trim());
		 	$("#apellido").html(persona[0].apellido.trim());
		 	$("#email").html(persona[0].email.trim());
            $("#telefono").html(persona[0].telefono.trim());
		 	var losservicios=persona[0].servicio.trim();
		 	
			//para concatenar todos los servicios ofrecidos si llegan varios
			for (var i = 1; i < persona.length; i++) {
				losservicios+=", "+persona[i].servicio.trim()
			};
			$("#servicios").html(losservicios);
		};
$.ajax(ajaxRequest);
};
//llama al ajax de un servicio especifico
var llamarAjaxServicio = function(cualServicio){
	var ajaxRequest = {};
	ajaxRequest.url = "getservicios.php";
	ajaxRequest.type = "GET";

	ajaxRequest.data = {servicio : cualServicio};

	ajaxRequest.success = function(responseJSON) {
           		 // get JSON
           		 var servicios = responseJSON;
           		 var tabla=""; 

           		 for (var i = 0; i < servicios.length; i++) {
           		 	tabla+='<tr id="C_'+servicios[i].id+'">"';
           		 	tabla+="<td>"+servicios[i].id+"</td>";
           		 	tabla+="<td>"+servicios[i].nombre+"</td>";
           		 	tabla+="<td>"+servicios[i].apellido+"</td>";
           		 	tabla+="<td>"+servicios[i].telefono+"</td>";
           		 	tabla+="<td>"+servicios[i].email+"</td>";
           		 	tabla+="<td>"+servicios[i].servicio+"</td>";
           		 	tabla+="</tr>";
           		 };

           		 $("tbody.tbody").html(tabla);
				//Para colorear lo que se clickea
				$("tr").on("click", getPersona);

			};
			$.ajax(ajaxRequest);
		};
		//para traiga los servicios del que se clicko
		var getServicios= function ()
		{
            
             $('#contactoPerfilContainer').hide(); // oculta la zona D
            
			//para activar y desactivar los botones
			$('.active').attr("class", "list-group-item");
			$(this).attr("class", "list-group-item active");
            $('#tableFilter-filtering').val('');
            
            

			llamarAjaxServicio($(this).attr("id"));



		};

//para que se popule con todos los servicios al iniciar
var getServiciosOnLoad= function ()
{

	llamarAjaxServicio("todos");
    $('#contactoPerfilContainer').hide();

};

$.ajax({
	url: 'serviciosListar.php',
	dataType: 'json',
	success: function(serviciosList){
		var servicioListHtml = '';
		var len = serviciosList.length;
		servicioListHtml +='<a  id="todos" class="list-group-item active">Todos</a>';
		for(var i=0;i<len;i++){
			servicioListHtml += '<a id="' + serviciosList[i].id + '" class="list-group-item">' + serviciosList[i].servicio + "</a>";
		}
		$('.list-group').html(servicioListHtml);
		$('a.list-group-item').on("click",getServicios);
	}
}
);
$(document).ready(getServiciosOnLoad);
</script>
<!-- SCRIPT PARA EL FILTRO DE BUSQUEDA -->            
<script src="js/jquery.table-filter.js"></script>
<script type="text/javascript">
$(function () {
	$("#tableFilter").addTableFilter();
});
</script>    
<!-- FIN DEL SCRIPT DE BUSQUEDA -->                    

</body>
</html>
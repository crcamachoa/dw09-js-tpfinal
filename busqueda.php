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

					<a  id="todos" class="list-group-item active">Cras justo odio</a>
					<a  id="1" class="list-group-item" >Dapibus ac facilisis in</a>
					<a  id ="2" class="list-group-item" >Morbi leo risus</a>
					<a  id= "3"class="list-group-item" >Porta ac consectetur ac</a>
					<a  id="4" class="list-group-item" >Vestibulum at eros</a>

				</div> 
			</div>
			<div id="contactoTablaContainer" class="col-md-8">
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
					<tbody>

					</tbody>
				</table>
			</div>
			<div id="contactoPerfilContainer" class="col-md-2">
				Datos de un contacto
			</div>
		</div>
	</div> <!-- /container -->

	<script>
	var getPersona = function(){
		$("tr").removeClass("active");
		$(this).addClass("active")

		var ajaxRequest = {};
		ajaxRequest.url = "getPersona.php";
		ajaxRequest.type = "GET";
		var text = $(this).attr("id");
		var id_persona= text.slice(2);
		ajaxRequest.data = {persona : id_persona};
		ajaxRequest.success =function(PersonaJson){
			var persona = PersonaJson;
		 	//Usar para D
		 	alert(persona[0].nombre.trim()+" "+persona[0].apellido);
		 };
		 $.ajax(ajaxRequest);
		};
//llama al ajax de un servicio especifico
		var llamarAjaxServicio = function(cualServicio){
			var ajaxRequest = {};
			ajaxRequest.url = "getservicios.php";
			ajaxRequest.type = "GET";

			ajaxRequest.data = {servicio : cualServicio};
			//ajaxRequest.data = {servicio : "2"};
			ajaxRequest.success = function(responseJSON) {
           		 // get JSON
           		 var servicios = responseJSON;
           		 var tabla=""; 

           		 for (var i = 0; i < servicios.length; i++) {
           		 	tabla+='<tr id="B_'+servicios[i].id+'">"';
           		 	tabla+="<td>"+servicios[i].id+"</td>";
           		 	tabla+="<td>"+servicios[i].nombre+"</td>";
           		 	tabla+="<td>"+servicios[i].apellido+"</td>";
           		 	tabla+="<td>"+servicios[i].telefono+"</td>";
           		 	tabla+="<td>"+servicios[i].email+"</td>";
           		 	tabla+="<td>"+servicios[i].servicio+"</td>";
           		 	tabla+="</tr>";
           		 };

           		 $("tbody").html(tabla);
				//Para colorear lo que se clickea
				$("tr").on("click", getPersona);

			};
			$.ajax(ajaxRequest);
		};
		//para traiga los servicios del que se clicko
		var getServicios= function ()
		{
			//para activar y desactivar los botones
			$('.active').attr("class", "list-group-item");
			$(this).attr("class", "list-group-item active");

			llamarAjaxServicio($(this).attr("id"));



		};

//para que se popule con todos los servicios al iniciar
		var getServiciosOnLoad= function ()
		{

			llamarAjaxServicio("todos");

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
	</body>
	</html>
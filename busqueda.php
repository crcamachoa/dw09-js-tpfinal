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
					<a  class="list-group-item" id="1">Dapibus ac facilisis in</a>
					<a  class="list-group-item" id ="2">Morbi leo risus</a>
					<a  class="list-group-item" id= "3">Porta ac consectetur ac</a>
					<a  class="list-group-item" id="4">Vestibulum at eros</a>

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
	$(document).ready(function(){
		$.ajax({
			url: 'serviciosListar.php',
			dataType: 'json',
			success: function(serviciosList){
				var servicioListHtml = '';
				var len = serviciosList.length;
				for(var i=0;i<len;i++){
					servicioListHtml += '<a id="' + serviciosList[i].id + '" class="list-group-item">' + serviciosList[i].servicio + "</a>";
				}
				$('#servicioListaContainer').html(servicioListHtml);
			}
		});

		
		var evento1= function getServicios()
		{

			var ajaxRequest = {};
			ajaxRequest.url = "getservicios.php";
			ajaxRequest.type = "GET";
			ajaxRequest.data = {servicio : $(this).attr("id")};
			ajaxRequest.success = function(responseJSON) {
           		 // get JSON
           		 var servicios = responseJSON;
           		 var tabla=""; 

           		 for (var i = 0; i < servicios.length; i++) {
           		 	tabla+="<tr>";
           		 	tabla+="<td>"+servicios[i].id+"</td>";
           		 	tabla+="<td>"+servicios[i].nombre+"</td>";
           		 	tabla+="<td>"+servicios[i].apellido+"</td>";
           		 	tabla+="<td>"+servicios[i].email+"</td>";
           		 	tabla+="<td>"+servicios[i].servicio+"</td>";
           		 	tabla+="</tr>";
           		 };
           		 $("tbody").html(tabla);

           		}

           		$.ajax(ajaxRequest);
           	};

           	$("a").on("click",evento1);
           });
</script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta charset="utf-8">
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="js/jquery.js"></script> 
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
<!-- Zona A-->
			<div id="servicioListaContainer" class="col-md-2">
				<div class="list-group"> 


				</div> 
			</div>
<!--Fin Zona A-->
			
			<div id="contactoTablaContainer" class="col-md-7">
<!--Zona C-->
				<input type="text" id="busqueda" class="form-control" placeholder="Busqueda" />
				<br />

				<table id="tableFilter" class="table table-striped table-bordered">
					<!--                 <table id="tableFilter" class="table table-striped table-hover table-condensed"> -->
					<thead>
						
							<th>ID</th>
							<th>NOMBRE</th>
							<th>APELLIDO</th>
							<th>TELEFONO</th>
							<th>EMAIL</th>
							<th>SERVICIO</th>
						
					</thead>
					<tbody class="tbody">

					</tbody>
				</table>
				<!-- Inicio - Paginacion -->
				<div id="contactoPaginacion">
					
				</div>
				<!-- End - Paginacion -->
			</div>
<!--Fin Zona C-->

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
	//evitamos el comportamiento por defecto de los links
	$(document).on("click", "a", function(e){
	    e.preventDefault();    
	})

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
var llamarAjaxServicio = function(cualServicio, offsetActual, limitActual, busquedaActual){
	var ajaxRequest = {};
	ajaxRequest.url = "getcontactos.php";
	ajaxRequest.type = "GET";

	ajaxRequest.data = {servicio : cualServicio, offset : offsetActual, limit : limitActual, busqueda : busquedaActual};

	ajaxRequest.success = function(responseJSON) {
   		 // get JSON
   		 var servicios = responseJSON;

   		 var tabla=""; 

   		 for (var i = 0; i < servicios.datos.length; i++) {
   		 	tabla+='<tr id="C_'+servicios.datos[i].id+'">"';
   		 	tabla+="<td>"+servicios.datos[i].id+"</td>";
   		 	tabla+="<td>"+servicios.datos[i].nombre+"</td>";
   		 	tabla+="<td>"+servicios.datos[i].apellido+"</td>";
   		 	tabla+="<td>"+servicios.datos[i].telefono+"</td>";
   		 	tabla+="<td>"+servicios.datos[i].email+"</td>";
   		 	tabla+="<td>"+servicios.datos[i].servicio+"</td>";
   		 	tabla+="</tr>";
   		 };

   		$("tbody.tbody").html("");
   		$("tbody.tbody").html(tabla);
		//Para colorear lo que se clickea
		$("tbody tr").css('cursor','pointer');

		$("tbody tr").on("click", getPersona);

		// Paginacion
		//cargamos los links en el ul #contactoPaginacion
		$("#contactoPaginacion").html("");
		$("#contactoPaginacion").html(servicios.links);

		$("#contactoPaginacion li a").on("click", cambiarPagina)

		//hacemos una sencilla animacion
		// $(document.body).animate({opacity: 0.3}, 400);
	 //    $("html, body").animate({ scrollTop: 0 }, 400);
	 //    $(document.body).animate({opacity: 1}, 400);

		// var paginado = "";
		// for (var i = 1; i <= 3; i++) {
		// 	paginado += '<li class="pag"><a data-page="'+i+'">'+i+'</a></li>';
		// }
		// $("#contactoPaginacion").html(paginado);
		// $("li.pag").css('cursor','pointer');
		// $("li.pag").on("click", cambiarPagina)
	};
	$.ajax(ajaxRequest);
};

//para traiga los servicios del que se clicko
var getServicios= function ()
{
     $('#contactoPerfilContainer').hide(); // oculta la zona D
    
	//para activar y desactivar los botones
	$('a.active').attr("class", "list-group-item");
	$(this).attr("class", "list-group-item active");
    $('#tableFilter-filtering').val('');
    
	llamarAjaxServicio($(this).attr("id"), 0, 3, "");
};

//para que se popule con todos los servicios al iniciar
var cambiarPagina = function()
{
	llamarAjaxServicio($("a.active").attr("id"), $(this).attr('data-offset'), $(this).attr('data-limit'), $("#busqueda").val());
	//llamarAjaxServicio("todos",3,3);
    $('#contactoPerfilContainer').hide();

};

//para que se popule con todos los servicios al iniciar
var getServiciosOnLoad= function ()
{

	llamarAjaxServicio("todos", 0, 3, "");
    $('#contactoPerfilContainer').hide();

    var consulta;
                                                                          
	//hacemos focus al campo de búsqueda
	$("#busqueda").focus();
                                                                                                    
	//comprobamos si se pulsa una tecla
	$("#busqueda").keyup(function(e){
                                     
		//obtenemos el texto introducido en el campo de búsqueda
		consulta = $("#busqueda").val();
                                                                           
        //hace la búsqueda
        llamarAjaxServicio($("a.active").attr("id"), 0, 3, consulta);                                                              
                                                                           
    });
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

		//Para completar la zona A
		$('.list-group').html(servicioListHtml);
		//Para que se llame a getservicios cada vez que se clickea en la zona A
		$('a.list-group-item').on("click",getServicios);
		//para mostrar el puntero
		$('a.list-group-item').css("cursor","pointer");
	}
});

$(document).ready(getServiciosOnLoad);
</script>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
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
<!-- ZONA A! -->
		<div class="row">
			<div id="servicioListaContainer" class="col-md-2">
				<div class="list-group"> 
                    <!-- Trae la lista de Servicios utilizando  -->
				</div> 
			</div>
<!-- FIN DE ZONA A! -->
<!-- ZONA C! -->
			<div id="contactoTablaContainer" class="col-md-7">
				<table id="tableFilter" class="table table-striped table-bordered">
					<!--                 <table id="tableFilter" class="table table-striped table-hover table-condensed"> -->
					<thead>
							<th>NOMBRE</th>
							<th>APELLIDO</th>
							<th>TELEFONO</th>
							<th>EMAIL</th>
							<th>SERVICIO</th>		
					</thead>
					<tbody class="tbody"> <!-- Aqui se carga los datos de la Zona C via ajax-->

					</tbody>
				</table>
			</div>
<!-- FIN de ZONA C! -->
			<!-- ZONA D! -->
			<div id="contactoPerfilContainer" class="col-md-3">
				<div class="row">
						<div class="thumbnail">
							<!-- Acá se cargan las imagenes -->
							<img id="pulgarcito" src="" alt="..."> <!-- src se completa mediante la funcion getPersona --> 
							<div class="caption">
								<h3>Datos de Contacto</h3>
                                <table>
                                <tr>                            
                                <td><b>Nombre:</b></td>
								<td id="nombre"></td>                                
                                </tr>
                                <tr>                            
                                <td><b>Apellido:</b></td>
								<td id="apellido"></td>                                
                                </tr>
                                <tr>                            
                                <td><b>Email:</b></td>
								<td id="email"></td>                                
                                </tr>
                                <tr>                            
                                <td><b>Telefono:</b></td>
								<td id="telefono"></td>                                
                                </tr>
                                </table>
                                <br>
								<span><b>Servicios:</b></span>
								<p id="servicios"></p>
								<br>

							</div>
						</div>
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
           		 var contactos = responseJSON;
           		 var tabla=""; 

           		 for (var i = 0; i < contactos.length; i++) {
           		 	tabla+='<tr id="C_'+contactos[i].id+'">"';
           		 	tabla+="<td>"+contactos[i].nombre+"</td>";
           		 	tabla+="<td>"+contactos[i].apellido+"</td>";
           		 	tabla+="<td>"+contactos[i].telefono+"</td>";
           		 	tabla+="<td>"+contactos[i].email+"</td>";
           		 	tabla+="<td>"+contactos[i].servicio+"</td>";
           		 	tabla+="</tr>";
           		 };

           		 $(".tbody").html(tabla);
				//Para cambiar el cursor
				$(".tbody tr").css('cursor','pointer'); 

				$(".tbody tr").on("click", getPersona);

			};
			$.ajax(ajaxRequest);
		};
		//para traiga los servicios del que se clicko
		var getContactos= function ()
		{
            
             $('#contactoPerfilContainer').hide(); // oculta la zona D
            
			//para activar y desactivar los botones
			$('a.active').attr("class", "list-group-item");
			$(this).attr("class", "list-group-item active");
            $('#tableFilter-filtering').val('');
            
            

			llamarAjaxServicio($(this).attr("id"));



		};

//para que se popule con todos los servicios al iniciar
var getContactosOnLoad= function ()
{

	llamarAjaxServicio("todos");
    $('#contactoPerfilContainer').hide();

};

$.ajax({  //Se cargar los Servicios al cargarse la pagina
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
		$('a.list-group-item').on("click",getContactos);
		//para mostrar el puntero
		$('a.list-group-item').css("cursor","pointer");
	}
}
);
$(document).ready(getContactosOnLoad);
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
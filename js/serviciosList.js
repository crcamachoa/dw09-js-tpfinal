function columnaservicios(){
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

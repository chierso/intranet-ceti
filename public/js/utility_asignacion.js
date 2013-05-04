$(document).on("ready", init);
var server="http://localhost:81/intranet-ceti/";
var id;
var nombre;
function init(){
	$('.btn-success').on('click',agregar);	
	$('#frm_add').on('submit',function (ev){
		
		ev.preventDefault();
		dataString = $(this).serialize();
		//alert(dataString);
		$.ajax({
		  type: "POST",
		  url: '../abm/abm_asignacion/asignar_tutoria',
		  data: dataString
		});
		$('#modalAdd').modal('hide');
		location.reload();
		return false;	
	});
}

function agregar() {
    id=$(this).attr('data-id');
    nombre=$(this).attr('data-docente');
    $('#pDocente').html(''+nombre);
    $('#id_docente').val(''+id);
}

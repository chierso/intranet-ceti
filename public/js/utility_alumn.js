$(document).on("ready", init);
var server="http://localhost:81/intranet-ceti/";
var jsonAlumno;
var alumno;

function init(){
	$('.btn-success').on('click',agregar);	
	$('#frm_add').on('submit',function (ev){
		ev.preventDefault();
		dataString = $(this).serialize();
		//alert(dataString);
		$.ajax({
		  type: "POST",
		  url: server+'/abm/abm_alumn/buscar_alumn',
		  data: dataString,
		  success: function(alumnos)
		  {
		  	$('#tbody').html('');
		  	for (var incremento in alumnos)
		    {
		        alumno = alumnos[incremento];
		        $('#tbody').append(
		            "<tr>"
		            +"<td class='id'>" + alumno.id + 
		            "</td><td class='nombre'>" + alumno.nombre + 
		            "</td><td class='numerico'>" + alumno.edad + 
		            "</td><td class='numerico'>" + alumno.grado + 
		            "</td>"
		            +"</tr>"); 
		    }
			jsonAlumno=json;		  	
		  }
		});
		return false;	
	});
}

function agregar() {
    id=$(this).attr('data-id');
    nombre=$(this).attr('data-docente');
    $('#pDocente').html(''+nombre);
    $('#id_docente').val(''+id);
}

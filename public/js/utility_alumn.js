$(document).on("ready", init);
var server="http://localhost:81/intranet-ceti/";
var jsonAlumno;
var alumno;

function init(){	
	$('#buscador').on('submit',function (ev){
		ev.preventDefault();
		dataString = $(this).serialize();
		//alert(dataString);
		$.ajax({
		  type: "POST",
		  url: server+'abm/abm_alumn/buscar_alumn',
		  data: dataString,
		  success: function(alumnos)
		  {
		  	$('#tbody').html('');
		  	for (var incremento in alumnos)
		    {
		        alumno = alumnos[incremento];
		        $('#tbody').append(
		            '<tr>'
		            +'<td>' +  (parseInt(parseInt(incremento++))).toString + 
		            '</td><td>' + alumno.fullname + 
		            '</td><td>' + alumno.grade + 
		            '</td><td>' + alumno.section + 
		            '</td><td>' + 
		            '<a data-id="'+alumno.id+'" role="button" href="'+server+'reports/record/reporteAlumnoParametro/'+alumno.id+'" class="btn btn-info btn-mini" title="Ver Notas"><i class="icon-white icon-file"></i></a>'+
					'<a data-id="'+alumno.id+'" role="button" href="#modalAdd" class="btn btn-warning btn-mini"><i class="icon-white icon-edit"></i></a>'+
					' <a data-id="'+alumno.id+'" role="button" data-togle="modal" class="btn btn-danger btn-mini"><i class="icon-white icon-remove"></i></a>'
		            + '</td></tr>'); 
		    }
		    //$('input:radio').prop('checked', false);  	
		  }
		});
		return false;	
	});
}

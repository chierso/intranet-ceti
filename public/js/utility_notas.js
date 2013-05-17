$(document).on("ready", init);
var server="http://localhost:81/intranet-ceti/";
var jsonAlumno;
var alumno;
var id;
// variables de registro de notas
var bimester;
var grade;
var section;
var subject;

function init(){	
	$('#buscador').on('submit',function (ev){
		ev.preventDefault();
		dataString = $(this).serialize();
		//alert(dataString);
		bimester = $("input[name=rbt_bimester]:checked").val();
		grade 	 = $("#grade").val();
		section	 = $("input[name=rbt_section]:checked").val();
		subject	 = $("#subject").val();
		
		$.ajax({
		  type: "POST",
		  url: server+'abm/abm_alumn/buscar_alumn',
		  data: dataString,
		  success: function(alumnos)
		  {
		  	$('#tbody').html('');
		  	$('#iBimester').val(''+bimester);
		  	$('#iGrade').val(''+grade);
		  	$('#iSection').val(''+section);
		  	$('#iSubject').val(''+subject);
		  	
		  	for (var incremento in alumnos)
		    {
		        alumno = alumnos[incremento];
		        $('#tbody').append(
		            '<tr>'
		            +'<td>' + (incremento+1) + 
		            '</td><td>' + alumno.fullname + 
		            '</td>'+
		            '<td>'+ 
		            '<input data-id="'+alumno.id+'" name="notas[]" type="text" />'
		            );    
		    }
		    $('#tbody').append('</td></tr><tr><td colspan="4"><input id="submitNotas" type="submit" class="btn btn-success" value="Insertar" /></td></tr>');
		    $('input:radio').prop('checked', false);
		  }
		});
		return false;	
	});
	
	$('#test').on('click',function (ev){
		ev.preventDefault();
		id=$(this).attr('data-id');
		$('#id_alumno').val(''+id);
		$('#bimester').val(''+id);
		$('#results').fadeOut('slow',function(){
			$('#modalNotas').fadeIn('slow');
		});
		return false;	
	});
}

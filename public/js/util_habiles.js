$(document).on("ready", init);
var server="http://localhost:81/intranet-ceti/";

function init(){	
	$('#hab').on('click',function (ev){
		ev.preventDefault();
		dataString = $('#habilitar').serialize();
		//alert(dataString);
		$.ajax({
		  type: "POST",
		  url: server+'habilitar/hab',
		  data: dataString,
		  success: function()
		  {
		  	$('#msg').html('<div class="alert alert-success"><b>CORRECTO!</b> Tus cambios se grabaron correctamente.</div>');	
		  },
		  error: function(){
		  	$('#msg').html('<div class="alert alert-error"><b>ERROR!</b> Tus cambios no pudieron ser grabados.</div>');			  	
		  }
		});
		return false;	
	});
	$('#inhab').on('click',function (ev){
		ev.preventDefault();
		dataString = $('#habilitar').serialize();
		//alert(dataString);
		$.ajax({
		  type: "POST",
		  url: server+'habilitar/inhab',
		  data: dataString,
		  success: function()
		  {
		  	$('#msg').html('<div class="alert alert-success"><b>CORRECTO!</b> Tus cambios se grabaron correctamente.</div>');	
		  },
		  error: function(){
		  	$('#msg').html('<div class="alert alert-error"><b>ERROR!</b> Tus cambios no pudieron ser grabados.</div>');			  	
		  }
		});
		return false;	
	});
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
		            +'<td><input type="checkbox" name="check[]" value="' +  alumno.id + '" />'+
		            '</td><td>' + alumno.fullname + 
		            '</td><td>' + alumno.grade + 
		            '</td><td>' + alumno.section + 
		            '</td>' + 
		            '</tr>'); 
		    }
		    //$('input:radio').prop('checked', false);  	
		  }
		});
		return false;	
	});
	$('#filtro').on('submit',function (ev){
		ev.preventDefault();
		var indice = 1;
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
		            +'<td>'+(indice).toString()+
		            '</td><td>' + alumno.fullname + 
		            '</td><td>' + alumno.grade + 
		            '</td><td>' + alumno.section + 
		            '</td><td>'+evaluar(alumno.condicion)+'</td>' + 
		            '</tr>'); 
		            indice++;
		    }
		    //$('input:radio').prop('checked', false);  	
		  }
		});
		return false;	
	});
	$('#reportar').on('click',function(){
		var txtx = $('#Buscador').val();
		var grado = $('#grade').val();
		var section = $('input:radio[name=rbt_seccion]:checked').val();
		if(section == undefined){section="";}
		$('#txt_search').val(''+txtx);
		$('#g').val(''+grado);
		$('#s').val(''+section);
		$('#toPDF').submit();
	});
	function evaluar(cond){
		if(cond == 'I'){return 'INHABILITADO';}
		else{return 'HABILITADO';}
	}
}

$("#all").change(function(){
	$('#habilitar input[type=checkbox]').each( function() {			
		if($("input[name=checktodos]:checked").length == 1){
			this.checked = true;
		} else {
			this.checked = false;
		}
	});
});

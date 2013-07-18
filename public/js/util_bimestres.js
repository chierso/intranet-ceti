$(document).on("ready", init);
var server="http://localhost:81/intranet-ceti/";

function init(){	
	$('#frm_calendario').on('submit',function (ev){
		ev.preventDefault();
		action = $('#action').val();
		dataString = $(this).serialize();
		//alert(dataString);
		$.ajax({
		  type: "POST",
		  url: server+'abm/abm_asignacion_bimestre/'+action,
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
}

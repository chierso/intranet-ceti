$(document).on('ready',init);
var server="http://localhost:81/intranet-ceti/";

function init() {

  $('#login').on('submit',function(){
  	dataString = $(this).serialize();
  	$.ajax({
		  type: "POST",
		  url: server+'login/sendLogin',
		  data: dataString,
		  success: function(evt)
		  {
		  	if(evt=="error"){
		  		$('#msg').html('<div class="alert alert-error"><b>Error!</b> Los datos ingresados no coinciden.</div>');
		  	}	
		  	else{
		  		location.reload();
		  	}
		  },
		  error: function(){
		  	$('#msg').html('<div class="alert alert-error"><b>ERROR!</b> Tus cambios no pudieron ser grabados.</div>');			  	
		  }
	});
  	return false;
  })
}

$(document).on('ready',init);
var server="http://localhost:81/intranet-ceti/";

function init() {
  $('#dpYears').datepicker({
  	autoclose: 1
  });
  
    $('#add_docente').on('submit',function(){
  	dataString = $(this).serialize();
  	$.ajax({
		  type: "POST",
		  url: server+'abm/abm_docente/insert_docente',
		  data: dataString,
		  success: function(evt)
		  {
		  	if(evt=="error"){
		  		$('#msg').html('<div class="alert alert-error"><b>Error!</b> Los datos ingresados no son válidos!.</div>');
		  	}	
		  	else{
		  		alert(evt);
		  		$('#msg').html('<div class="alert alert-success">Docente registrado</div>');
		  	}
		  },
		  error: function(){
		  	$('#msg').html('<div class="alert alert-error"><b>Error!</b> Los datos ingresados no son válidos!.</div>');	
		  }
	});
  	return false;
  })
  
	$('#add_alumn').on('submit',function(){
  	dataString = $(this).serialize();
  	$.ajax({
		  type: "POST",
		  url: server+'abm/abm_alumn/insert_alumn',
		  data: dataString,
		  success: function(evt)
		  {
		  	if(evt=="error"){
		  		$('#msg').html('<div class="alert alert-error"><b>Error!</b> Los datos ingresados no son válidos!.</div>');
		  	}	
		  	else{
		  		alert(evt);
		  		$('#msg').html('<div class="alert alert-success">'+evt+'</div>');
		  	}
		  },
		  error: function(){
		  	$('#msg').html('<div class="alert alert-error"><b>Error!</b> Los datos ingresados no son válidos!.</div>');	
		  }
	});
  	return false;
  })

}

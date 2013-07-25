$(document).on("ready", init);
var server="http://localhost:81/intranet-ceti/";
var indice  = 0;
var nfilas 	= $('#tbl_excel > tbody > tr').length;

function init(){
	if($('#frm_excel_sql').length){
	 	validar();
	 }
     var pbar;
     var progress;
     var tiempo = nfilas*11;     
     $('#frm_excel_alm').on('submit',function (ev){
		dataString = $(this).serialize();
		progreso();
		$('html, body').animate({ scrollTop: 0 }, 'slow');
     	$.ajax({
			type: "POST",
			url: server+'abm/abm_alumn/insert_alumn_excel',
			data: dataString,
			success: function(alumnos)
			{
				clearInterval(pbar);
				clearInterval(progress);
				$('#progress').css('width','100%');
				$('#progress').text('100%');
				$('.progress').removeClass('active');
				
				$("#msg").html('<div class="alert alert-success" id="exito"><b>Éxito!</b><br>Los usuarios han sido registrados con éxito</div>'+
				'<br>'+alumnos);
				$("#frm_excel_alm").hide("fast");
			},
			error: function(){
				$("#msg").html('<div class="alert alert-error" id="exito"><b>Error!</b><br>Tus datos no pudieron ser cargados</div>');
			}	
		   });
		return false;
		});
		
     $('#frm_excel_sql').on('submit',function (ev){
		dataString = $(this).serialize();
		progreso();
		$('html, body').animate({ scrollTop: 0 }, 'slow');
     	$.ajax({
			type: "POST",
			url: server+'abm/abm_notas/insert_excel',
			data: dataString,
			success: function(alumnos)
			{
				clearInterval(pbar);
				clearInterval(progress);
				$('#progress').css('width','100%');
				$('#progress').text('100%');
				$('.progress').removeClass('active');
				
				$("#msg").html('<div class="alert alert-success" id="exito"><b>Éxito!</b><br>Tus datos han sido cargados correctamente</div>'+
				'<a href="'+server+'" class="btn btn-info">Regresar al Inicio</a><br><br>');
				$("#frm_excel_sql").hide("fast");
			},
			error: function(){
				$("#msg").html('<div class="alert alert-error" id="exito"><b>Error!</b><br>Tus datos no pudieron ser cargados</div>');
				console.log("error");
			
			}			
		});
		return false;
	});
	function progreso(){
		pbar = setTimeout(function(){
	        $('#progress').each(function() {
	            var me = $(this);
	            var perc = me.attr("data-percentage");
	        
	            var current_perc = 0;
	            progress = setInterval(function() {
	                if (current_perc>=perc) {
	                    clearInterval(progress);
	                } else {
	                    current_perc +=1;
	                    me.css('width', (current_perc)+'%');
	                }
	                me.text((current_perc)+'%');
	            }, tiempo);
	        });
    	},300);
	}	
      
     
     $('input.error_excel').focus(function(){
     	$(this).removeClass('error_excel');
     	validar();
     });
     
     $('input.error_excel').focusout(function(){
     	validar();
     });     
     function validar(){
	//alert('error');
	$('input.input-excel').each(function(){
		var nota = $(this).val();
		if((parseInt(nota)<=20) && (parseInt(nota)>=0)){
		}
		else
		{
			$(this).addClass('error_excel')
		}
	})
}
}



/*
$('.input-excel').focus(function(){
	$(this).removeClass('input-excel').addClass('input-excel-full');
});

$('.input-excel').focusout(function(){
	$(this).addClass('input-excel')
});
*/
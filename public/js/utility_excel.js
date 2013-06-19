$(document).on("ready", init);
var server="http://localhost:81/intranet-ceti/";
var nfilas 	= $('#tbl_excel > tbody > tr').length;
	var alumno 	= new Array(nfilas);
	var n1		= new Array(nfilas);
	var n2  	= new Array(nfilas);
	var n3	 	= new Array(nfilas);
	var n4  	= new Array(nfilas);
	var n5 	 	= new Array(nfilas);
	var n6 		= new Array(nfilas);
	var n7  	= new Array(nfilas);
	var n8  	= new Array(nfilas);
	var n9  	= new Array(nfilas);
	var n10 	= new Array(nfilas);
	var n11 	= new Array(nfilas);
	var indice  = 0;

function init(){
	/*$('#frm_excel_sql').on('submit',function (ev){
		ev.preventDefault();
		$("#tbl_excel tbody tr").each(function (index) {
              $(this).children("td").each(function (index2) {
                  switch (index2) {
					case 1:
                          alumno[indice] = ""+$(this).text()+"";
                          //alumno[indice] = "%"+$(this).text()+"%";
                          //console.log(""+alumno[indice]);
                          break;
                    case 2:
                          n1[indice] = $(this).text();
                          break;
                    case 3:
                          n2[indice] = $(this).text();
                          break;
                    case 4:
                          n3[indice] = $(this).text();
                          break;
                    case 5:
                          n4[indice] = $(this).text();
                          break;
                    case 6:
                          n5[indice] = $(this).text();
                          break;
                    case 7:
                          n6[indice] = $(this).text();
                          break;
                    case 8:
                          n7[indice] = $(this).text();
                          break;
                    case 9:
                          n8[indice] = $(this).text();
                          break;
                    case 10:
                          n9[indice] = $(this).text();
                          break;
                    case 11:
                          n10[indice] = $(this).text();
                          break;
                    case 12:
                          n11[indice] = $(this).text();
                          break;
                  }
              })
          	indice++;
          })
          
          // begin insert
          //var dataString = 'alumnos[]='+alumno+'&notas1[]='+n1+'&notas2[]='+n2+'&notas3[]='+n3+'&notas4[]='+n4+'&notas5[]='+n5+'&notas6[]='+n6+'&notas7[]='+n7+'&notas8[]='+n8+'&notas9[]='+n9+'&notas10[]='+n10+'&notas11[]='n11;
			var dataString = {alumnos:alumno,notas1:n1,notas2:n2,notas3:n3,notas4:n4,notas5:n5,notas6:n6,notas7:n7,notas8:n8,notas9:n9,notas10:n10,notas11:n11}
          //console.log("toString: "+alumString);
          $.ajax({
			  type: "POST",
			  url: server+'abm/abm_notas/insert_excel',
			  data: dataString,
			  success: function(alumnos)
			  {
				alert('debugeando o ke pedo?');
			  },
			  error: 
			  	function(ex){console.log("error"+ex);}
			  
		   });	
          
          return false;
      })*/
     var pbar;
     var progress;
     var tiempo = nfilas*10;
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
          return false;
     });
}
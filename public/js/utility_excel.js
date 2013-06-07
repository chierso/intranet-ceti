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
	$('#frm_excel_sql').on('submit',function (ev){
		ev.preventDefault();
		$("#tbl_excel tbody tr").each(function (index) {
              $(this).children("td").each(function (index2) {
                  switch (index2) {
					case 1:
                          alumno[indice] = "%"+$(this).text()+"%";
                          //alumno[indice] = $(this).text();
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
          $.ajax({
			  type: "POST",
			  url: server+'abm/abm_notas/insert_excel',
			  data: dataString,
			  success: function(alumnos)
			  {
				alert('debugeando o ke pedo?');
			  },
			  error: 
			  	function(){console.log("error");}
			  
		   });	
          
          return false;
      })
}
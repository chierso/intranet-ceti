$(document).on("ready", readyConsultaBeneficiado);
var server="http://localhost:81/intranet-ceti/";
function readyConsultaBeneficiado(){
	$('#tabla_subject').html('<table cellpadding="0" cellspacing="0" border="0" class="display" id="tabla"></table>' );
  	oTable=$('#tabla').dataTable( {
    	"bFilter": false	,
        "bSort": false,
        "bLengthChange": false,   
    	"oLanguage": {
            "sLengthMenu": "Mostrar _MENU_ records por página",
            "sZeroRecords": "No hay registros",
            "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 a 0 de 0 registros",
            "sInfoFiltered" : "",
            "sProcessing":"Procesando",
            "oPaginate": {
            	'sNext':"Siguiente",
              	'sFirst':"Primero",
              	'sLast':"Último",
              	'sPrevious':"Atrás"
            }
       	},
    	"bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "aoColumns": [
            { "sTitle": "Código", "mDataProp":'id_subject', "sWidth":'50px' },
            { "sTitle": "Nombre", "mDataProp":'name' },
            { "sTitle": "Años" , "mDataProp":'id_subject'}
         ],
        "bProcessing": true,
    	"bServerSide": true,
    	"iDisplayLength": 5,
    	"sAjaxSource": server+"/index.php/abm/abm_gestionCurso/listarCurso",
    	"fnServerData": function ( sSource, aoData, fnCallback ) {
      		aoData.push(
          	{
	           	'name':"txt_consulta_beneficiado",
	           	'value':$("input[name='txt_consulta_beneficiado']").val()
          	});
      		aoData.push(
           	{
		        'name':"rbt_tipo_consulta",
		        'value':$("input:radio[name='rbt_tipo_consulta']:checked").val()
          	});
      	$.getJSON( sSource, aoData, function (json) { 
        	fnCallback(json);
        });
      }
    });
    $("#tabla tbody tr").click( function( e ) {
        if ( $(this).hasClass('row_selected') ) {
            $(this).removeClass('row_selected');
        }
        else {
            oTable.$('tr.row_selected').removeClass('row_selected');
            $(this).addClass('row_selected');
        }
    });
    $("#consultar_beneficiado").submit(function(e){
    	oTable.fnDraw();
    	return false;
    });

}

/*  VARIABLE GLOBAL PARA ALMACENAR CONEXIONES AJAX PENDIENTES O EN PROCESO  */
var xhr = [];

/*************************************/
/* Funcion para obtener url del sitio */
/*************************************/
$.fn.get_url = function(nb_modulo){
	
	var url 	 =  new Object();
	
	url.base_url = window.location.origin;
	
	url.indx_url = url.base_url;
	
	url.full_url = url.base_url;
	
	var path     = window.location.pathname.split('/');
	
	var pos_idx  = path.indexOf("index.php");
	
	if( pos_idx > 0 )
	{
		for(i = 0; i <= pos_idx ; i++ )
		{
			if(path[i].length> 0)
			{
				url.full_url = url.full_url + '/' + path[i];
				
			}

		}
		url.base_url = url.base_url+'/'+path[pos_idx-1];
		url.indx_url = url.full_url + '/';
	}
	
	url.full_url = ( nb_modulo != null ) ? url.full_url = url.full_url + '/' + nb_modulo + '/' : url.full_url = url.full_url + '/' ;

    return 	url;
};

/*************************/
/* Evento document ready */
/*************************/
$(document).ready(function(){
 
	//se añade dinamicamente la capa de carga
	$('body').append('<div id="background_progressbar" class="modal fade" data-backdrop="static" data-show="true">\
						<div id="progressbar" class="progress-bar progress-bar-striped progress-bar-animated"></div>\
					  </div>');
					  
	//se añade dinamicamente el dialogo modal
	$('body').append('<div class="modal fade" id="dialogo" tabindex="-1" role="dialog" aria-hidden="true">\
					  <div class="modal-dialog" role="document">\
						<div class="modal-content">\
						  <div class="modal-header bg-info text-white">\
							<h5 class="modal-title">title</h5>\
						  </div>\
						  <div class="modal-body">\
						  ...\
						  </div>\
						  <div class="modal-footer">\
							...\
						  </div>\
						</div>\
					  </div>\
					</div>');
					
	
   //$('#defaultForm').formValidation();
   $('.background_progressbar').show();
  //$.fn.dialogo(1,'Cuerpo del mensaje','Titulo Pantalla',$.fn.test_si, 'datasi', $.fn.test_no, 'datano', '');
});//Fin del document ready
/**************************/

$.fn.test_si = function(data_si){
	
	console.log(data_si);
}

$.fn.test_no = function(data_no){
	
	console.log(data_no);
}


/*************************/
/* Evento document ready */
/*************************/
$.fn.get_msj = function(tipo, msj){
	
	var classMsj = 'alert-info';
	
	switch(tipo) {
		
		case 'exito':
			classMsj = 'alert alert-success';
			break;
		case 'error':
			classMsj = 'alert alert-danger';
			break;
		case 'alerta':
			classMsj = 'alert alert-warning';
			break;
		case 'info':
			classMsj = 'alert alert-info';
			break;
		default:
			classMsj = 'alert alert-info';
			
	} 
	
	return '<div class="'+classMsj+'">'+msj+'</div>';
		
}


/*************************/
/* Evento document ready */
/*************************/
$.fn.get_msj_error = function(msj){
	
    classMsj = "error";
		
	msj = $.fn.get_msj(classMsj, msj );
	
	$.fn.dialogo(1, msj, 'Error', '', '', '', '', '');
		
}

$.fn.get_msj_exito = function(msj){
	
    classMsj = "exito";
		
	msj = $.fn.get_msj(classMsj, msj );
	
	$.fn.dialogo(1, msj, 'Informacion', '', '', '', '', '');
		
}

$.fn.get_msj_alerta = function(msj){
	
    classMsj = "alerta";
		
	msj = $.fn.get_msj(classMsj, msj );
	
	$.fn.dialogo(1, msj, 'Informacion', '', '', '', '', '');
		
}

$.fn.get_msj_auto = function(cod, msj){
	
	if( parseInt(cod) == 1 )
	{
		classMsj = "exito";

	}else{

		classMsj = "alerta";

	}
	
	msj = $.fn.get_msj(classMsj, msj );
	
	$.fn.dialogo(1, msj, 'Informacion', '', '', '', '', '');
		
}


/*******************************************************************************
/* Funcion de dialogo con callback  															
/* parametros:
/* (int tipo, string mensaje ,string titulo , callBack() f_si , array data_si, callBack() fn_no, array data_no, string size) ;
/* tipo: 1 -> mensaje, 2 -> confirmacion  
/* size: nomal (default), sm -> pequeño, lg -> grande
*******************************************************************************/
$.fn.dialogo = function(tipo, mensaje, titulo, fn_si, data_si=null, fn_no=null, data_no=null, size){
	
	var fn_si = (fn_si == null || fn_si == '')? function(){}: fn_si;

	var fn_no = (fn_no == null || fn_no == '')? function(){}: fn_no;

	switch(size) {
		
		case 'lg':
			size = 'modal-lg';
			break;
		case 'sm':
			size = 'modal-sm';
			break;
		default:
			size = '';
			
	} 

	switch(tipo){//Tipo de dialogo
		
		case 1:
		
			if(titulo == ''){
		   
				titulo   = 'Informaci\u00f3n';	
				titclass = 'alert-info'
			
			}
			btn = '<button type="button" id="btn_aceptar_mod" class="btn btn-primary" data-dismiss="modal">Aceptar</button>';
			
			break;
		
		case 2:
		
			if(titulo == ''){
		   
				titulo = 'Confirmar';	
				
			}
			
			btn  = '<button type="button" id="btn_cancelar_mod" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>';
			
			btn += '<button type="button" id="btn_confirmar_mod" class="btn btn-success" data-dismiss="modal">Aceptar</button>';
			
			break;
		
		default:
		
			return;
	}
	
	$('#dialogo').find('.modal-footer').html(btn);
	
	$('#dialogo').find('.modal-dialog').addClass(size);
	
	$('#dialogo').find('.modal-title').text(titulo);
	  
	$('#dialogo').find('.modal-body').html(mensaje);
	
	var i = 1;

	if($('#dialogo').is(":visible")){
		
		setTimeout(function() {
			
			$('#dialogo').modal('show');
		
		}, 1000);

	} else{
		
		setTimeout(function() {
				
			$('#dialogo').modal('show');
					
		}, 200);
	}
	
	$('#btn_aceptar_mod').on('click', function () {			fn_si(data_si);	});	
	
	$('#btn_confirmar_mod').on('click', function () {		fn_si(data_si);	});

	$('#btn_cancelar_mod, #btn_cerrar_mod').on('click', function () {	fn_no(data_no);	});
   	
}//Fin de la función dialogo
/**************************/

/***************************************************/
/*  FUNCION GENERAL PARA ENVIO DE DATOS POR AJAX  */
/*  $.fn.ajaxSend(string url, string dataType, object data, callBack(respuesta) successCall, bool async, bool beforeSend)  */
/*************************************************/
$.fn.ajaxSend = function(url, dType, data, successCall, async = false, bfs = true){
	
	var SuccessCall   = (successCall == '')? function(){}: successCall;
	
	var v_contentType = 'application/x-www-form-urlencoded; charset=UTF-8';
	
	var v_processData = true;
	
	if(dType == 'file')
	{
		dType 			= 'html';
		v_contentType   = false;
		v_processData   = false;
		
	}
	
	var obj = $.ajax({
			
		url:  url,
		type: "POST",
		dataType: dType,
		data: data,
		async:async,
		processData: v_processData,
		beforeSend: function(objeto){
			
			/*  SE AÑADE LA URL COMO ATRIBUTO AL OBJETO AJAX  */
			objeto.url = url;

			/*  SE BUSCA LA APARICION DE LA CONEXION EN EL ARREGLO  */
			$.each(window.xhr, function(dex, conex){

			/*  SE VALIDA SI LA CONEXION YA SE HA HECHO A LA MISMA URL Y AUN NO SE HA PROCESADO LA RESPUESTA  */
			if(conex.url === url && conex.readyState < 4){

					/*  SE TERMINA LA CONEXION ANTERIOR  */
					conex.abort();
								
					/*  SE ELIMINA LA CONEXION DEL ARREGLO  */
					window.xhr.splice(dex, 1);
				}
			});
			
			/*  SE AÑADE LA NUEVA CONEXION A LA VARIABLE GLOBAL  */
			window.xhr.push(
				objeto  //  OBJECT [CONEXION AJAX ACTUAL]  
			);
			
			/*  beforeSend() activacion de show barra de progreso  */
			if(bfs == true){
				
				$('.background_progressbar').show(); 
				
			}
			
		},
		
		contentType: v_contentType,
		
		error: function(objeto, quepaso, otroobj){
			
			/*  EL ABORTAR NO NECESITA ERROR Y SU DEPURACION YA FUE REALIZADA EN BEFORE SEND  */
			if(quepaso !== 'abort'){
				
				msj = 	'<h5> Ha ocurrido un error: </h5>'
						+'<p> Consulte con el Personal de Tecnologia <p>'
						+'<div class="btn btn-info btn-sm" type="button" data-toggle="collapse" data-target="#msj-error">Ver Detalles</div>'
						+'<div id="msj-error" class="collapse"> '+ objeto.responseText + '</div>';
				
				
				msj = $.fn.get_msj('error', msj );
				
				console.log(quepaso);
				console.log(objeto);
				console.log(otroobj);
				
				setTimeout(function() {
					$.fn.dialogo(1,msj,'ERROR',$.fn.test_si,'',$.fn.test_no,'');
				}, 500);
				
				
				var dex = window.xhr.indexOf(objeto);
	
				/*  SE ELIMINA LA CONEXION DEL ARREGLO  */
				window.xhr.splice(dex, 1);
				//console.log('ajax deleted on error');	
			
			}
			
		},
		processData:true,

		success: SuccessCall,
		complete: function(objeto, estatus){
			
			/*  SI SE COMPLETO EXITOSAMENTE SE BORRA EL OBJETO DE LA MEMORIA  */
			if(estatus == 'success'){
	
				/*  SE BUSCA LA APARICION DE LA CONEXION EN EL ARREGLO  */
				var dex = window.xhr.indexOf(objeto);
				
				/*  SE ELIMINA LA CONEXION DEL ARREGLO  */
				window.xhr.splice(dex, 1);
				
				/*  ALMACENO LA RESPUESTA PARA USAR EL ID DEL VISITANTE INSERTADO  */
				
			}//  FIN IF
			
		}//  FIN COMPLETE
		
	});//Fin del ajax
	
	$('.background_progressbar').hide();

	return obj.responseText;
}/*Fin de la función */


/***********************************/
/* limpia una url obtenida por cookie */
/***********************************/
$.fn.url_cookie = function(valor_url_cookie){
	
	valor_url_cookie = valor_url_cookie.replace('%3A',':');
	valor_url_cookie = valor_url_cookie.replace(/%2F/g,'/');
	return valor_url_cookie;
}


/***********************************/
/* Función que obtiene las cookies */
/***********************************/
$.fn.obtener_cookie = function(nombre_cookie){
	
	var nombre  = nombre_cookie + "=";
    var cookies = document.cookie.split(';');

    for(var i=0; i<cookies.length; i++){
		
        var cookie = cookies[i];
        while (cookie.charAt(0) ==' ') cookie = cookie.substring(1);
        if(cookie.indexOf(nombre) == 0) return cookie.substring(nombre.length,cookie.length);
		
    }//Fin del for
	
    return "";
	
};//Fin de la función
/******************/

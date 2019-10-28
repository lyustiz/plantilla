//Variable global
var xhr = null;

/***********************/
/*Evento document ready*/
/***********************/
$(document).ready(function(){
	
   //llamada a los eventos
   $.fn.eventos();

   //Ocultamos el mensaje de carga
   $('.background_progressbar').hide();
   
   //Barra de progreso
   $("#progressbar").progressbar({
      value: false
   });

   //Función que muestra el formulario
   $.fn.formulario();
   
});//Fin del document ready
/*************************/

/*********************************************************/
/*Función que muestra el formularios para la utenticación*/
/*********************************************************/
$.fn.formulario = function(){
	
	var fecha = new Date();
    var anio = fecha.getFullYear();
	
	//Creamos el formulario
	var formulario  = '  <div class="membrete">';
	    formulario += '    <div class="membrete_izq"></div>';
		formulario += '    <div class="membrete_der"></div>';
		formulario += '  </div>';
		formulario += '  <div></div>';<!-- Capa que contiene la franja roja -->
		formulario += '  <div class="usuario_conectado"></div>';<!-- Capa que contiene el fondo negro con el nombre del usuario -->
		formulario += '  <div class="contenido_intranet">';
		formulario += '    <div class="contenido_movible">';
		formulario += '      <div id="login">';
	    formulario += '        <form>';		
	    formulario += '          <table border="0" class="tabla_logueo">';
		formulario += '            <tr>';
	    formulario += '              <td height="10" colspan="2"></td>';
	    formulario += '            </tr>';
	    formulario += '            <tr height="50">';
		formulario += '              <td rowspan="9" width="500"></td>';
	    formulario += '              <td align="right" class="titulo_inicio_sesion">Iniciar Sesi&oacute;n</td>';
	    formulario += '            </tr>';
	    formulario += '            <tr>';
	    formulario += '              <td height="9"></td>';
	    formulario += '            </tr>';
	    formulario += '            <tr height="50">';
	    formulario += '              <td align="center" width="400">';
	    formulario += '                <input id="usuario" class="validar validate[required,custom[onlyLetterNumber]]" type="text" data-prompt-position="topLeft" placeholder="Usuario">'; 
	    formulario += '              </td>';
	    formulario += '            </tr>';
		formulario += '            <tr>';
	    formulario += '              <td height="10"></td>';
	    formulario += '            </tr>';
		formulario += '            <tr height="50">';
	    formulario += '              <td align="center">';
	    formulario += '                <input id="clave" class="validar validate[required]" type="password" data-prompt-position="topLeft" placeholder="Contrase&ntilde;a">';
		formulario += '              </td>';
	    formulario += '            </tr>';
	    formulario += '            <tr>';
	    formulario += '              <td height="10"></td>';
	    formulario += '            </tr>';
	    formulario += '            <tr height="50">';
	    formulario += '              <td align="center">';
	    formulario += '                <input id="inicio_sesion" type="button" value="Iniciar Sesi&oacute;n" class="btn">';
	    formulario += '              </td>';
	    formulario += '            </tr>';
		formulario += '            <tr>';
	    formulario += '              <td height="3"></td>';
	    formulario += '            </tr>';
		formulario += '            <tr height="50">';
	    formulario += '              <td align="center">';
	    formulario += '                <input id="cambio_clave" type="button" value="Olvid&eacute; mi contrase&ntilde;a" class="btn">';
	    formulario += '              </td>';
	    formulario += '            </tr>';
	    formulario += '            <tr>';
	    formulario += '              <td height="30" colspan="2"></td>';
	    formulario += '            </tr>';
	    formulario += '          </table>';
		formulario += '        </form>';
		formulario += '      </div>';
		formulario += '      <div id="sistemas_asociados"></div>';<!-- Capa que contiene los iconos de los sistemas -->
	    formulario += '    </div>';
		formulario += '  </div>';
		formulario += '  <div class="pie_pagina">';
	    formulario += '    &copy; '+anio+' Corporaci&oacute;n Venezolana de Comercio Exterior &nbsp; <u>Rif:</u> G-20011022-8';
		formulario += '  </div>';
		
	//Mostramos el formulario
	$('.capa_contenido').append(formulario);
	
	//Seteamos el ancho del contenido
	$('.contenido_movible > div').css({'width' : $(window).width()});
	
	//Verificamos si existe una sessión activa
	$.fn.chequear_cookie();
	
	//Agregamos tooltips
	$.fn.toolTips('.mensajito');
	
	$.fn.eventos();
	
}//Fin de la función
/******************/

/******************************************/
/*Función donde se especifican los eventos*/
/******************************************/
$.fn.eventos = function(){
   
   /***********************************/
   /*Evento keydown sobre el documento*/
   /***********************************/
    $(document).unbind('keydown');
	$(document).keydown(function(event){
		
		if( event.which == 13){//Tecla enter
		
			event.preventDefault();
			
			$('#inicio_sesion').trigger('click');
			
			return false;
		}
		
	 });//Fin del evento keydown*//
   /*************************/
   
   /**********************************/
   /* Evento resize sobre la ventana */
   /**********************************/
   $(window).unbind('resize');
   $(window).resize(function() {
     
	 //Llamo a la función que verifica el tamaño de la ventana
	 $.fn.tamano_venata();
	   
	 $.fn.eventos();
	 
   });//Fin del evento resize
   /************************/

   /********************************************/
   /*Evento mouseenter sobre los msj de errores*/
   /********************************************/
   $('.formError').unbind('mouseenter');
   $('.formError').mouseenter(function(){
	  
	   $(this).hide(250,function(){
		                          $(this).remove()
	                              }
	   );
	   
	   $.fn.eventos();
	   
   });//Fin del evento mouseenter
   /****************************/
   
   /****************************************/
   /*Evento click sobre los elementos input*/
   /****************************************/
   $('input').unbind('click');
   $('input').click(function(){
	   
	   //Ocultamos los errores
	   $('.formError').hide(250,
	                        function(){
		                               $(this).remove()
	                                  }
	   );
	   
	   $.fn.eventos();
	   
   });//Fin del evento click
   /************************/
   
   /*****************************************************************/
   /*Evento keyup sobre el campo de usuario y el campo de contraseña*/
   /*****************************************************************/
   $('#usuario, #clave').unbind('keyup');
   $('#usuario, #clave').keyup(function(){
	   
	   //Ocultamos los errores
	   $('.formError').hide(250,
	                        function(){
		                               $(this).remove()
	                                  }
	   );
	   
	   //Obtengo el valor
	   var valor = $(this).val().trim();
	   $(this).val(valor);
	   
	   $.fn.eventos();
	   
   });//Fin del evento keyup
   /***********************/
   
   /*********************************************/
   /*Evento click sobre el btn de iniciar sesion*/
   /*********************************************/
   $('#inicio_sesion').unbind('click');
   $('#inicio_sesion').click(function(){
	   
	   //Validamos
	   var validador = $.fn.validar();
	   
	   //Evaluamos el validador
	   if(validador == true){
		   
		   //Obtenemos los datos
		   var usuario = $('#usuario').val();
		   var clave   = $('#clave').val();
		   
		   //Evaluamos si hay un objeto xhr
		   if(xhr != null){
			   
			   xhr.abort();
			   
		   }//Fin del if
		   
		   xhr = $.ajax({

			  url: "c_intranet/autenticar",
			  type: "POST",
			  dataType: "json",
			  data:{
				    usuario:usuario,
					clave:clave
				   },
			  async:true,
			  beforeSend: function(objeto){
				    
				  //Ocultamos el mensaje de carga
			      $('.background_progressbar').show();	
				  
			  },
			  complete: function(objeto, exito){
			  },
			  contentType: "application/x-www-form-urlencoded;charset=ISO-8859-15",
			  error: function(objeto, quepaso, otroobj){
				  
				  //Ocultamos el mensaje de carga
			      $('.background_progressbar').hide();
				  
				  xhr = null;
				  
				  //Evaluo el error
				  if(quepaso == 'timeout'){
						
						var msj   = 'Timeout!';
						
				  }else{
						
						var msj   = 'Ocurrió un error<p>Por favor intente de nuevo!.</p>';
						
				   }//Fin del if
					
				   var tipo  = 1;
				   var ttl   = 'Error';
				   var fn_si = '';
				   var fn_no = '';
				   var ancho = 380;
				   var alto  = 200;
				
				   //Llamamos a la función que genera el dilogo
				   $.fn.dialogo(tipo,msj,ttl,fn_si,fn_no,ancho,alto);
				 				  
			  },
			  processData:true,
			  success: function(data){
				  
				  xhr = null
				  
				  //Ocultamos el mensaje de carga
			      $('.background_progressbar').hide();
				  
				  
				  //Obtenemos la respuesta
				  var respuesta = data['RESPUESTA'];
				  
				  //Evaluamos el código del error
				  switch(respuesta){
					  
					  case '1':  //Limpiamos el localStorages
				                 localStorage.clear();
					             
					             //Seteamos las Cookies
					             $.fn.crear_cookie('nombre',data['nombre']);
								 $.fn.crear_cookie('cedula',data['cedula']);
					             
								 //Buscamos los sistemas asociados
					             $.fn.cargarSistemas(data['cedula']);
								 
								 break;
					  
					  case '-1':  var msj   = '<b>'+data['MSJ']+'</b>';
								  var tipo  = 1;
								  var ttl   = 'Error';
								  var fn_si = '';
								  var fn_no = '';
								  var ancho = 380;
								  var alto  = 200; 
					              
								  //Llamamos a la función que genera el dilogo
				                  $.fn.dialogo(tipo,msj,ttl,fn_si,fn_no,ancho,alto);
								  
								 break;
					  
					  default:    var msj   = 'Ocurrió un error<p>Por favor intente de nuevo!.</p><p>Si el problema persiste por favor comunicarlo a través del correo <b>prueba@corpovex.gob.ve</b>.</p>';
							      var tipo  = 1;
								  var ttl   = 'Error';
								  var fn_si = '';
								  var fn_no = '';
								  var ancho = 380;
								  var alto  = 200; 
					  
								  //Llamamos a la función que genera el dilogo
								  $.fn.dialogo(tipo,msj,ttl,fn_si,fn_no,ancho,alto);
					  
				  }//Fin del switch
				  
				  $.fn.eventos();
				  
			  }//Fin del success
			  
		   });//Fin del ajax
		   
	   }else{
		   
		   $.fn.eventos();
		   
	   }//Fin del if
	   
   });//Fin del evento click
   /***********************/
   
   /********************************************/
   /* Evento click sobre el btn salir_intranet */
   /********************************************/
   $('.salir_intranet').unbind('click');
   $('.salir_intranet').click(function(){
	   
	   //Borramos la cookie
	   $.fn.borrar_cookie('cedula');
	   $.fn.borrar_cookie('nombre');
	   
	   //Limpio la clave
	   $('#clave').val('');

	   
	   //Evaluamos si hay un objeto xhr
		   if(xhr != null){
			   
			   xhr.abort();
			   
		   }//Fin del if
		   
		   xhr = $.ajax({

			  url: "c_intranet/logout",
			  type: "POST",
			  dataType: "json",
			  data:{
				    logout:'logout',
				   },
			  async:true,
			  beforeSend: function(objeto){
				    
				  //Ocultamos el mensaje de carga
			      $('.background_progressbar').show();	
				  
			  },
			  complete: function(objeto, exito){
			  },
			  contentType: "application/x-www-form-urlencoded;charset=ISO-8859-15",
			  error: function(objeto, quepaso, otroobj){
				  
				  //Ocultamos el mensaje de carga
			      $('.background_progressbar').hide();
				  
				  xhr = null;
				  
				  //Evaluo el error
				  if(quepaso == 'timeout'){
						
						var msj   = 'Timeout!';
						
				  }else{
						
						var msj   = 'Ocurrió un error<p>Por favor intente de nuevo!.</p>';
						
				   }//Fin del if
					
				   var tipo  = 1;
				   var ttl   = 'Error';
				   var fn_si = '';
				   var fn_no = '';
				   var ancho = 380;
				   var alto  = 200;
				
				   //Llamamos a la función que genera el dilogo
				   $.fn.dialogo(tipo,msj,ttl,fn_si,fn_no,ancho,alto);
				 				  
			  },
			  processData:true,
			  success: function(data){
				  
				  xhr = null
				  
				  //Ocultamos el mensaje de carga
			      $('.background_progressbar').hide();
				  
			  }//Fin del success
			  
		   });//Fin del ajax
	   
	   
	   
	   
	   //Ocultamos la franja donde se muestra el nombre del usuario conectado
	   $('.usuario_conectado').animate({
									    height:"1px"
									   },
									   150,
									   function(){
										   
										   //Mostramos el formulario de autenticación
                                           $('.contenido_intranet').scrollTo($("#login",0), 700,{axis:'x',offset:{left:0,top:0}});
										   
										   //Limpio la capa
										   $(this).html('');
										   
									   }
	                                  );
	   $.fn.eventos();
	   
   });//Fin del evento click
   /***********************/
   
   /*************************************************/
   /* Evento click sobre los iconos de los sistemas */
   /*************************************************/
   $('.sistema').unbind('click')
   $('.sistema').click(function(){
	   
	   //Obtengo el id del sistema
	   var id_sistema  = $(this).attr('id');
	   var path_inicio = $(this).attr('path_inicio');
	   
	   //Creo la cookie con el id del sistema
	   $.fn.crear_cookie('id_sistema',id_sistema);
	   $.fn.crear_cookie('path_inicio',path_inicio);
	   
	   //Ventana modal
	   $.colorbox({
				
			 width:"100%", 
			 height:"100%", 
			 iframe:true,
			 initialWidth:"10px",
			 initialHeight:"10px",
			 escKey:false,
			 scrolling:false,
			 overlayClose: false,
			 title: '',
			 close: "<img width='20' height='20' src='../../assets/modules/jquery/images/colorbox/salir.png'>",
			 href: "c_intranet/v_sistema",
			 onOpen: function(){
				 
				 //Cerramos el dialogo
				 //$('#dialogo').dialog("close");
				 
			 },
			 onClosed: function(){
				 
				 //Limpiamos el localStorages
				 localStorage.clear();
				 
				 //Borramos la cookie
				 $.fn.borrar_cookie('id_sistema');
				 
			 }//Fin del evento onClosed
			 
		});//Fin del colorbox
	   
	   $.fn.eventos();
	   
   });//Fin del evento click
   /***********************/
   
};//Fin de la función eventos
/***************************/

/*******************************/
/* Función que crea una cookie */
/*******************************/
$.fn.crear_cookie = function(nombre_cookie, valor_cookie){
	
	//Creo la cookie la cookie
	document.cookie=nombre_cookie+'='+valor_cookie+';domain='+window.location.hostname+';path=/';
	
};//Fin de la función
/*******************/

/******************************************/
/* Función que borra la cookie por nombre */
/******************************************/
$.fn.borrar_cookie = function(nombre_cookie){
	
	//Borramos la cookie
    document.cookie = nombre_cookie+"=; domain="+window.location.hostname+";path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC";
	
}//Fin de la función
/******************/

/****************************************************************/
/* Función que verifica si la cookie asociada al usuario existe */
/****************************************************************/
$.fn.chequear_cookie = function(){
	
	/*var id_usuario = $.fn.obtener_cookie("ID_USUARIO");
	
	//Evaluamos si existe
    if (id_usuario != "" && id_usuario != null){
		
		//Busco los sistemas asociados
		$.fn.cargarSistemas(id_usuario);
		
		//Mostramos los sistemas asociados
		$('.contenido_intranet').scrollTo($("#sistemas_asociados",0), 0,{axis:'x',offset:{left:0,top:0}});
		
    }else{
		
		//Mostramos el formulario de autenticación
        $('.contenido_intranet').scrollTo($("#login",0), 0,{axis:'x',offset:{left:0,top:0}});
		
    }//Fin del if*/
	
};//Fin de la función
/*******************/

/***********************************/
/* Función que obtiene las cookies */
/***********************************/
$.fn.obtener_cookie = function(nombre_cookie){
	
	var nombre  = nombre_cookie + "=";
    var cookies = document.cookie.split(';');
	
	//Recorremos
    for(var i=0; i<cookies.length; i++){
		
        var cookie = cookies[i];
        while (cookie.charAt(0) ==' ') cookie = cookie.substring(1);
        if(cookie.indexOf(nombre) == 0) return cookie.substring(nombre.length,cookie.length);
		
    }//Fin del for
	
    return "";
	
};//Fin de la función
/******************/

/**********************************/
/*Función que valida el formulario*/
/**********************************/
$.fn.validar = function(){
    
	validador = true;
	
	//Recorremos los campos para validar
	$('.validar').each(function(){
        
		//Validamos el campo actual
		var validar = $(this).validationEngine('validate');
		
		//Evaluamos
		if(validar == true){
			
			validador = false;
			
			return validador;
			
		}//Fin del if
		
    });//Fin del each
	
	return validador;

}//Fin de la función
/******************/

/*******************************************************/
/* Función que busca los sistemas asociados al usuario */
/*******************************************************/
$.fn.cargarSistemas = function(idUsuario){
	
	$.ajax({

		  url: "c_intranet/sistemas_asociados",
		  type: "POST",
		  dataType: "json",
		  data:{
				idUsuario:idUsuario
			   },
		  async:true,
		  beforeSend: function(objeto){
			  
			  //Limpiamos el contenido
			  $("#sistemas_asociados").html('');
			  
			  //Ocultamos el mensaje de carga
			  $('.background_progressbar').show();	
			  
		  },
		  complete: function(objeto, exito){
		  },
		  contentType: "application/x-www-form-urlencoded;charset=ISO-8859-15",
		  error: function(objeto, quepaso, otroobj){
			  
			  //Ocultamos el mensaje de carga
			  $('.background_progressbar').hide();
			  
			  xhr = null;
			  
			  //Evaluo el error
			  if(quepaso == 'timeout'){
					
					var msj   = 'Timeout!';
					
			  }else{
					
					var msj   = 'Ocurrió un error<p>Por favor intente de nuevo!.</p>';
					
			   }//Fin del if
				
			   var tipo  = 1;
			   var ttl   = 'Error';
			   var fn_si = '';
			   var fn_no = '';
			   var ancho = 380;
			   var alto  = 200;
			
			   //Llamamos a la función que genera el dilogo
			   $.fn.dialogo(tipo,msj,ttl,fn_si,fn_no,ancho,alto);
							  
		  },
		  processData:true,
		  success: function(data){
			  
			  //Ocultamos el mensaje de carga
			  $('.background_progressbar').hide();
			  
			  //Obtenemos el nº de registros
			  var numReg = data['SISTEMAS'].length;
			  
			  var sistemas = '';
			  
			  //Evaluamos el nº de registros
			  if(numReg > 0){
			      
				  //Recorro los resultados
				  var id_sistema    = null;
				  var desc_sistema  = null;
				  var icono_sistema = null;
				  var nb_sistema    = null;
				  var page_inicio   = null;
				  
				  for(var i = 0; i < numReg; i++){
					  
					id_sistema    = data['SISTEMAS'][i]['id_sistema'];
					desc_sistema  = data['SISTEMAS'][i]['desc_sistema'];
					icono_sistema = data['SISTEMAS'][i]['icono_sistema'];
					nb_sistema    = data['SISTEMAS'][i]['sistema']; 
					path_inicio   = data['SISTEMAS'][i]['path_inicio']; 
					  
					  
					  sistemas += '<div id="'+id_sistema+'" class="sistema mensajito" title="'+desc_sistema+'" path_inicio="'+path_inicio+'">';
				      sistemas += '  <div class="imagen">';
				      sistemas += '    <img src="../../assets/modules/aplicaciones/images/iconos/sistemas/'+icono_sistema+'">';
				      sistemas += '  </div>';
				      sistemas += '  <div class="descripcion">'+nb_sistema+'</div>';
				      sistemas += '</div>';
					  
				  }//Fin del for
				  
			  }//Fin del if
			  
			  sistemas += '<div class="salir_intranet">';
			  sistemas += '  <div class="imagen"></div>';
			  sistemas += '  <div class="descripcion">Salir</div>';
			  sistemas += '</div>';
			  
			  //Mostramos los iconos del sistema
			  $("#sistemas_asociados").append(sistemas);
			  
			  //Muevo el contenido de la intranet
			  $('.contenido_intranet').scrollTo($("#sistemas_asociados",0), 
			                                    1000,
												{
											     axis:'x',
												 offset:{left:0,top:0},
												 onAfter:function(){
													 
													//Mostramos la franja donde se muestra el nombre del usuario conectado
													$('.usuario_conectado').animate({
																				     height:"30px"
																				    },
																				    300,
																				    function(){
																					  
																				      $(this).append('Bienvenido:&nbsp;&nbsp;'+data['SESSION']['nombre']+'!');
																					  
																				    }
																				   );
													 
												 }
												}
											    );
			  
			  //Verificamos la sesión
			  //$.fn.session()
			  
			  //Agregamos tooltips
			  $.fn.toolTips('.mensajito');
			  
			  $.fn.eventos();
			  
		  }//Fin del success
			  
	});//Fin del ajax
	
}//Fin de la función
/******************/

/***************************************************/
/* Función donde verifica si la sesión esta activa */
/***************************************************/
$.fn.session = function(){
   
   var refreshId = setInterval(function(){
	   
	   var id_usuario = $.fn.obtener_cookie("ID_USUARIO");
	
	   //Evaluamos si existe
	   if (id_usuario != "" && id_usuario != null){
			
			//Mostramos los sistemas asociados
			$('.contenido_intranet').scrollTo($("#sistemas_asociados",0), 0,{axis:'x',offset:{left:0,top:0}});
			
	   }else{
			
			//Mostramos el formulario de autenticación
			$('.contenido_intranet').scrollTo($("#login",0), 0,{axis:'x',offset:{left:0,top:0}});
			
	   }//Fin del if
	 
   }, 5000);
   
};//Fin de la función session
/***************************/

/************************************************/
/* Función que verifica el tamaño de la venatan */
/************************************************/
$.fn.tamano_venata = function(){
	
	//Verifico si hay un colorbox abierto
	if($("#colorbox").css("display")=="block"){
		
		//Obtengo el alto y ancho de la ventana
		var ancho_ventana = $(window).width();
		var alto_ventana  = $(window).height();
		
		//Evaluo el ancho
		if(ancho_ventana < 1200){
			
			//Expandimos el colorbox al tamaño del marco de la aplicación
            $.colorbox.resize({width:"1200px"});
			
		}else{
			
			//Expandimos el colorbox al tamaño del marco de la aplicación
            $.colorbox.resize({width:"100%"});
			
		}//Fin del if
		   
		//Evaluo el alto
		if(alto_ventana < 700){
			
			//Expandimos el colorbox al tamaño del marco de la aplicación
            $.colorbox.resize({height:"700px"});
			
		}else{
			
			//Expandimos el colorbox al tamaño del marco de la aplicación
        	$.colorbox.resize({height:"100%"});
			
		}//Fin del if
		  
     }//Fin del if
	
};//Fin de la función
/*******************/

/***************************************************************/
/*Funcion de dialogo para mostrar los mensajes de exito o error*/
/***************************************************************/
$.fn.dialogo = function(tipo,mensaje,titulo,fn_si,fn_no,ancho,alto){
	
	if(tipo == 1){//Dialogo
		
		if(titulo == ''){
	   
	      titulo = 'Informaci\u00f3n';	
	   
	    }
		
		//Ventana de dialogo
		$('#dialogo').dialog({
					 modal: true,
					 resizable: false,
					 title: titulo,
					 height:alto,
				     width: ancho,
					 buttons: {
							 Ok: function() {
								 
								 eval(fn_si);
								 
								 $(this).dialog("close");
								 
								 $.fn.eventos();
								 
							  }
					 },
					 show: {
						 effect: "explode",
						 duration: 500
					 },
					 hide: {
						 effect: "explode",
						 duration: 500
					 },
					 open: function(){
						  
						  //Mensaje del dialogo
						  $(this).append(mensaje);
						  
					 },
					 close: function(){
					     
						 $(this).dialog("destroy");
						 	 
				     },
					 beforeClose: function(){
					  
					     $(this).html('');
					  
					 } 
		});
        
		//Le asignamos un indice superior al del colorbox para hacerlo visible
		$('.ui-front').css('z-index','10000');
		
	}else if(tipo == 2){
		
		if(titulo == ''){
	   
	      titulo = 'Confirmar';	
	   
	    }
		
		//Ventana de confirmación
	    $('#dialogo').dialog({
						   title: titulo,
						   resizable: false,
						   height:alto,
						   width: ancho,
						   modal: true,
						   buttons: {
									 "Si": function() {

										$(this).dialog("close");
										
										eval(fn_si);
										
										$.fn.eventos();
										
									 },
									 "No": function(){
										 
										 eval(fn_no);
										 
									     $(this).dialog("close");
										 
									 }
						   },
						   show: {
							 effect: "explode",
							 duration: 500
						   },
						   hide: {
							 effect: "explode",
							 duration: 500
						   },
						   open: function(){
							  
							  //Mensaje del dialogo
							  $(this).append(mensaje);
							  
						   },
					 	   close: function(){
					     
						      $(this).dialog("destroy");
						 	 
				           },
					       beforeClose: function(){
					  
					  		  $(this).html('');
					  
					       } 
	    });
		
		//Le asignamos un indice superior al del colorbox para hacerlo visible
		$('.ui-front').css('z-index','10000');
		
	}//Fin del if
   	
}//Fin de la función dialogo
/**************************/

/*********************************/
/*Función que asigna los tooltips*/
/*********************************/
$.fn.toolTips = function(elemento){
    
	 //Agregamos tooltips
     $(elemento).tooltip({
		  show: null,
		  position: {
			my: "center bottom-10",
			at: "center top",
			using: function( position, feedback ) {
			  $( this ).css( position );
			  $( "<div>" )
				.addClass( "arrow" )
				.addClass( feedback.vertical )
				.addClass( feedback.horizontal )
				.appendTo( this );
			}
		  },
		  open: function( event, ui ) {
			ui.tooltip.animate({ top: ui.tooltip.position().top + 5 }, "fast" );
		  }
     });
		
}/*Fin de la función*/
/********************/
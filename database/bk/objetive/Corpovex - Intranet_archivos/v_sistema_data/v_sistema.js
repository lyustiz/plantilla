;
//Variables globales
var xhr = null;
var base_url =  null;
var doc_root =  null;

/***********************/
/*Evento document ready*/
/***********************/
$(document).ready(function(){
	
   //Expandimos el colorbox al tamaño del marco de la aplicación
   parent.$.fn.tamano_venata();
   //parent.$.colorbox.resize({width:"100%",height:"100%"});
   
   //Ocultamos el mensaje de carga
   $('.background_progressbar').hide();
   
   //Barra de progreso
   $("#progressbar").progressbar({
      value: false
   });
   
   //Función que muestra el contenido
   $.fn.contenido();
   
  base_url = $.fn.obtener_cookie('base_url');
  base_url = $.fn.url_cookie(base_url);
  //console.log(base_url);
  
  doc_root = $.fn.obtener_cookie('doc_root');
  doc_root = $.fn.url_cookie(doc_root);
 // console.log(doc_root);
   
});//Fin del document ready
/*************************/

/***********************************************************/
/* Función que muestra el contenido relacionado al sistema */
/***********************************************************/
$.fn.contenido = function(){
	
	
	var id_sistema  = $.fn.obtener_cookie("id_sistema");
	var path_inicio = $.fn.obtener_cookie("path_inicio");

	$.ajax({

	  url: "info_sistema",
	  type: "POST",
	  data:{'id_sistema' : id_sistema},
	  dataType: "json",
	  async:true,
	  beforeSend: function(objeto){
			
		  //Mostramos el mensaje de carga
		  $('.background_progressbar').show();	
		  
	  },
	  complete: function(objeto, exito){
	  },
	  contentType: "application/x-www-form-urlencoded;charset=ISO-8859-15",
	  error: function(objeto, quepaso, otroobj){
		  
		  //Ocultamos el mensaje de carga
		  $('.background_progressbar').hide();

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
			  
		  //Obtengo el nº de módulos
		  
		  
		  var numModulos = data['modulos'].length;
		  //Variable que contendrá los módulos y los menús
		  var menus = '';
		  numModulos = 1;
		  //Evaluo
		  if(numModulos > 0){
	        //alert(numModulos);
			  //Recorro para armar los módulos
			    console.log('data', data['modulos'])
				$.each( data['modulos'], function( i, item ) {
					
					console.log('ite',item);
					menus += '<ul>';
					menus += '  <li class="modulo">'+item.nb_modulo+'';
					menus += '    '+$.fn.menus(item.menus)+'';
					menus += '  </li>';
					menus += '</ul>';
				});
			  console.log( menus);
			  
		  }//Fin del if
		  
		  menus += '<ul>';
		  menus += '  <li id="salir">SALIR</li>';
		  menus += '</ul>';
		  
		  //Armamos el contenido
		  var contenido  = '<div class="header">';
		      contenido += '  <div class="menu_izq"></div>';
			  contenido += '  <div class="menu_centro">'+menus+'</div>';
			  contenido += '  <div class="menu_der"></div>';
			  contenido += '</div>';
		      contenido += '<div class="contenido_menu"></div>';
		  
		  //Mostramos el contenido
		  $('.capa_contenido').append(contenido)
		  
		  //Obtengo el ancho y alto de la venta
	      var ancho_ventana = $(window).width();
		  var alto_ventana  = $(window).height();
		  
	      //Seteo el css
	      $('.header > div:eq(1)').css({'width':ancho_ventana - 190});
		  $('.contenido_menu').css({'height':alto_ventana - 70});
		  
		  //Agregamos tooltips
		  $.fn.toolTips('.mensajito');
		
		  $.fn.eventos();
		  
		  	if(path_inicio != '0')
			{
				$('.contenido_menu').html("<iframe id='show_page' name='show_page' class='show_page' src='../../"+path_inicio+"'></iframe>");
				
			}
		  
	  }//Fin del success
	  
    });//Fin del ajax
	
}//Fin de la función
/******************/

/******************************************/
/*Función donde se especifican los eventos*/
/******************************************/
$.fn.eventos = function(){
   
   /***********************************/
   /*Evento keydown sobre el documento*/
   /***********************************/
   $(window).unbind('keydown');
   $(window).keydown(function(event){
   
	  if(event.keyCode == 13){//Tecla enter
		//alert(1);
         event.preventDefault();
         return false;
	  
	  }//Fin del if
	  
	  $.fn.eventos();
	  
   });//Fin del evento keydown
   /*************************/
   
   /**********************************/
   /* Evento resize sobre la ventana */
   /**********************************/
   $(window).unbind('resize');
   $(window).resize(function(){
     
	 //Obtengo el ancho y alto de la venta
	 var ancho_ventana = $(window).width();
	 var alto_ventana  = $(window).height();
	 
	 //Seteo el css
	 $('.header > div:eq(1)').css({'width':ancho_ventana - 190});
	 $('.contenido_menu').css({'height':alto_ventana - 70});
	   
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
   
   /*****************************************************/
   /*Evento mouseenter sobre el menú de las aplicaciones*/
   /*****************************************************/
   $('.modulo').unbind('mouseenter');
   $('.modulo').mouseenter(function(event){
		
		$(this).children('ul').stop(true,true);
		
		//Mostramos el menú
		$(this).children('ul').fadeIn(300,function(){
		
			$(this).children('ul').css('display','block')
			
		});
		
		$.fn.eventos()
		
   });/*Fin del evento mouseenter*/
   /******************************/
	
   /*****************************************************/
   /*Evento mouseleave sobre el menú de las aplicaciones*/
   /*****************************************************/
   $('.modulo').unbind('mouseleave');
   $('.modulo').mouseleave(function(){
		
		//Ocultamos el menú
		$(this).children('ul').fadeOut(300,function(){
		
		   $(this).children('ul').css('display','none');
		
		});
		
		$.fn.eventos()
		
   });//Fin del evento mouseleave
   /****************************/
   
   /*****************************************************/
   /* Evento click sobre los items los menus del módulo */
   /*****************************************************/
   $('.menu').unbind('click');
   $('.menu').click(function(event){
	  
	  //Evaluo si el evento pertenece al menú que le dimos click al principio
	  if(!(event.target === this)){
		  
		  //var padre = $(this).parent('ul').parent('li').attr('class');
		  //alert('no soy yo');
		  return;
		  
	  }else{
		  
		  //Obtengo la url
		  //var mostrar   = $(this).attr('mostrar');
		  var url = $(this).attr('url');
          //Mostramos el contenido
						//$('.contenido_menu').html("<iframe src='"+url+"'></iframe>");
						//return;
		  //Verificamos que le objeto xhr no venga vacio
		  if(xhr != null){
			  
			   //Abortamos la ultima petición ajax
			   xhr.abort();
			  
		  }//Fin del if
		 // url = 'http://sistema.casa.gob.ve';
		  //Ajax
		 /* xhr = $.ajax({
			   
					url:url,
					type:'HEAD',
					crossDomain: true,
					headers: {
						"Access-Control-Allow-Origin":"*"
					},
					beforeSend: function(objeto){
				       
					   //Limpiamos el contenido
					   $('.contenido_menu').html('');
					   
					   //Mostramos el mensaje de carga
		               $('.background_progressbar').show();	
					  
				    },//Fin del beforeSend
					error: function(){
						
						//Ocultamos el mensaje de carga
		                $('.background_progressbar').hide();	
						
						xhr = null;
						
					},//Fin del error
					statusCode: {
				   
					   //Pagina no encontrada
					   404: function(){
							 
			                 //Muestro el mss de error  
							 $('.contenido_menu').append('<img class="not_found" src="../../../assets/modules/intranet/images/404.png" width="500" height="382" />');
							 
					   },
					   
					   //Error interno de la aplicación
					   500: function(){
							 
							 //Muestro el mss de error  
							 $('.contenido_menu').append('<img class="not_found" src="../../../assets/modules/intranet/images/500.png" width="500" height="382" />');
							 
					   }
					   
				    },
					success: function(){
						
						//Ocultamos el mensaje de carga
		                $('.background_progressbar').hide();
						
						xhr = null;*/
						
						//Mostramos el contenido
						$('.contenido_menu').html("<iframe id='show_page' name='show_page' class='show_page' src='"+url+"'></iframe>");
						
					/*	$.fn.eventos();
						
					}//Fin del success
					
			    });//Fin del ajax*/
		  
	  }//Fin del if
	  
		  //Ocultamos el menu
		  /*$('.menu').children('ul').fadeOut(200,function(){
			
			$('.menu').children('ul').css('display','none');
	
		  });*/
		  
		 /* var ancho_ventana = $(window).width();
		  var alto_ventana  = $(window).height();
		  var alto_iframe   = alto_ventana - 100;
		  var ancho_iframe  = ancho_ventana;
		  
		  //Removemos el iframe anterior
	      $('.contenido_menu iframe').remove();
		  
		  //Verificamos que le objeto xhr no venga vacio
		  if(xhr != null){
			  
			   //Abortamos la ultima petición ajax
			   xhr.abort();
			  
		  }
		  
		  //Ocultamos el menú
		   $(this).children('ul').slideUp(function(){
				  
				$(this).parent('li').addClass('desplegar');
				$(this).parent('li').removeClass('replegar');
				$(this).parent('li').removeClass('seleccionado');
			    
		    })//Fin del slideUp
		  
		  xhr = $.ajax({
			
			  url: ruta_menu,
			  dataType : 'html',
			  async:false,
			  beforeSend: function(objeto){
				  
				  //Muestro el msj de carga
				  $('.contenido_menu').append('<div class="contenedor_msjCarga"><div class="icono_msjCarga"></div></div>');
			  },
			  statusCode: {
				   
				   //Pagina no encontrada
				   404: function(){
						 
						 //Borro el contenido anterior
				         $('.contenido_menu').html('');
					     
						 $('.contenido_menu').append('<img class="not_found" src="../../../../assets/modules/intranet/images/404.png" width="500" height="382" />');
						 
				   },
				   
				   //Error interno de la aplicación
				   500: function(){
						 
						 //Borro el contenido anterior
				         $('.contenido_menu').html('');
					     
						 $('.contenido_menu').append('<img class="not_found" src="../../../../assets/modules/intranet/images/500.png" width="500" height="382" />');
						 
				   }
				   
			  },
			  complete: function(objeto, exito){
			  },
			  contentType: "application/x-www-form-urlencoded;charset=ISO-8859-15",
			  error: function(objeto, quepaso, otroobj){
				  
				  //Borro el contenido anterior
				  $('.contenido_menu').html('');
				  
			  },
			  processData:true,
			  success: function(respuesta_bd){
				 
				  xhr = null;
				 
				  //Borro el contenido anterior
				  $('.contenido_menu').html('');
				  
				  //Armo el nuevo iframe
	              $(".contenido_menu").html("<iframe src='"+ruta_menu+"' frameborder='0' width='"+ancho_iframe+"' height='"+alto_iframe+"'></iframe>");
				  
				  $.fn.eventos();
				  
			  }
			  
		  })//Fin del ajax*/
		  
		
	  
   });//Fin del evento click
   /***********************/
   
   /**************************************/
   /* Evento click sobre la opción salir */
   /**************************************/
   $('#salir').unbind('click')
   $('#salir').click(function(){
	   
	   //Cerramos el colorbox
	   parent.$.fn.colorbox.close();
	   	   
	   $.fn.eventos()
	   
   });//Fin del evento click
   /***********************/
   
};//Fin de la función eventos
/***************************/

/*****************************************/
/* Función que arma el html de los menús */
/*****************************************/
$.fn.menus = function(data){
	
	//Obtengo el nº menús
	var numMenus = data.length;
	
	
	//Variable arma los menús
	var menus = '<ul>';

	
	
	$.each( data, function( i, item ) {
					
		menus += '  <li class="menu" url="../../'+item.tx_path+'">'+item.nb_menu+'</li>';

	});
	
	//Recorro los resultados
	for(var i = 0; i < numMenus; i++){
		
		//menus += '<ul>';
		
		
	}//Fin del for
	
	menus += '</ul>';
	
	return menus;
	
}//Fin de la función
/******************/

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

/***********************************/
/* limpia una url obtenida por cookie */
/***********************************/
$.fn.url_cookie = function(valor_url_cookie){
	
	valor_url_cookie = valor_url_cookie.replace('%3A',':');
	valor_url_cookie = valor_url_cookie.replace(/%2F/g,'/');
	return valor_url_cookie;
}


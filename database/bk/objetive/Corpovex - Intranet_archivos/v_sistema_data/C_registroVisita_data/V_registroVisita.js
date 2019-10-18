var url           = $.fn.get_url('control_visitas');
var base_url      = url.base_url;  
var full_url      = url.full_url;  

var img_path 	  = base_url+'/assets/modules/control_visitas/images/fotos-visitantes/';
var img_default   = base_url+'/assets/modules/intranet/images/fotos-empleados/sf.jpg';

var tomar_foto    = false;
var camara_activa = false;
var form          = false;
var validador     = false

$(document).ready(function() {
	
	form = $('#frm_registroVisitantes');
	
	$.fn.validar_frm();
	
	$.fn.eventos();
	
	$.fn.clear_fmr('inicio');
	
});

/************ VALIDACION  *****************/

$.fn.validar_frm = function(){
	
	$(form).formValidation({
        framework: 'bootstrap4',
		button: {
            selector: '#btn_registrar',
        },
        fields: {
			slt_nacionalidad: {
                validators: {
                    notEmpty: {
						message: 'Indicar la Nacionalidad.'
                    }
				},
				onStatus: function(e, data) {

					if(data.status=='VALID'){
						
						$('#txt_cedula').removeAttr( 'disabled' );
						$('#txt_cedula').focus();
						
					}else{
						
						$('#txt_cedula').attr( 'disabled', 'disabled');
						
					}
                }
            },
			txt_cedula: {
				excluded: false,
                validators: {
                    notEmpty: {
						message: ' Indicar Cedula/Pasaporte'
                    },
                    stringLength: {
                        min: 6,
						message: 'Minima longitud de la Cedula/Pasaporte 6 Caracteres'						
					}
                },
				onStatus: function(e, data) {
                     
					 
					if(data.status=='VALID'){
						
						$('#btn_buscar').removeAttr('disabled');
						
					}else if(data.status=='INVALID'){
						
						$.fn.clear_fmr('busqueda_pers');
						
						$('#btn_buscar').attr('disabled','disabled'); 
						
					}
                }
            },
			txt_nombres_visitante: {
				excluded: false,
				validators: {
					notEmpty: {
						message: 'Indicar Nombre.'
					},
					stringLength: {
						min: 2,
						message: 'Indique al menos 2 caracteres para el nombre'							
					}
				}
            },
            txt_apellidos_visitante: {
				excluded: false,
				validators: {
					notEmpty: {
						message: ' Indicar Apellido.'
					},
					stringLength: {
						min: 2,
						message: 'Indique al menos 2 caracteres para el apellido'
					}
				}
            },
			slt_empresa: {
				excluded: false,
				validators: {
					notEmpty: {
						message: 'Indicar Empresa.'
					}
				}
            }, 
			slt_tipo_visitante: {
				excluded: false,
				validators: {
					notEmpty: {
						message: 'Indicar Tipo de Visitante.'
					},
				}
            }, 
			txt_cargo: {
				excluded: false,
				validators: {
					notEmpty: {
						message: 'Indicar Cargo de Visitante.'
					}
				}
            },
			txt_telefono: {
				excluded: false,
				validators: {
					notEmpty: {
						message: 'Indicar el Telefono'
					},
					numeric: {
						message: 'El telefono debe contener solo numeros'
					}
				}
            },
			slt_motivo: {
				excluded: false,
				validators: {
					notEmpty: {
						message: 'Indicar Motivo de la visita.'
					}
				}
            }, 
            slt_nb_empleado: {
				validators: {
					notEmpty: {
						message: 'Indicar empleado'
					}
				}
            },
			txt_nu_carnet: {
				excluded: false,
				validators: {
					notEmpty: {
						message: ' Indicar el Numero de carnet'
					},
					numeric: {
						message: 'El carnet debe contener solo numeros'
					},
					stringLength: {
                        min: 1,
						max: 5,
						message: 'El nromero del carnet debe tener entre 1 y 5 digitos'						
					}
				}
            },
			hdn_src_foto: {
				excluded: false,
				validators: {
					notEmpty: {
						message: '<i class="fa fa-camera fa-2x"></i> La foto es Obligatoria!'
					}
				}
            },
        }
    })

	validador = $(form).data('formValidation');
		
}

/****** EVENTOS *******/

$.fn.eventos = function(){

	$(form).on("keyup keypress", function(e) {
		var code = e.keyCode || e.which; 
		if (code === 13) {               
			e.preventDefault();
			return false;
		}
	});

	$('#btn_buscar').unbind();
	$('#btn_buscar').click(function(bnt){
	
		var nu_cedula = $('#txt_cedula').val();
		
		var tx_nac    = $('#slt_nacionalidad').val();
		
		var in_cedula_nac = tx_nac + '-' + nu_cedula;
		
		if(nu_cedula.length > 5)
		{
			$.fn.get_visitaCedula(in_cedula_nac);
			
		}else{
			
			validador.validateField('txt_cedula');
		}
		
	}).tooltip();
	
	$('#foto_visitante').unbind();
	$('#foto_visitante').click(function(bnt){
	
		if(tomar_foto)
		{
			$('#foto_modal').modal('show')
							.on('shown.bs.modal', function (e) {
									$.fn.camara();
							})
		}else{
			
			validador.validateField('txt_cedula');
			
		}
		
	});
	
	$("#slt_nb_empleado").select2()
		.on('select2:select', function (event) {
			
			var valores   = $(this).val().split('|');;
			
			var ubic      = valores[1];
			var cargo     = valores[2];
			var extens    = valores[3];
			var piso      = valores[4];
			var path      = valores[5];
			
			$.fn.clear_fmr('slt_empleado');
			
			$("#slt_UnidOrg")		.val(ubic);
			$("#txt_extension")		.val(extens);
			$("#txt_piso")			.val(piso);
			$('#foto_empleado img')	.attr('src', path);
			$('#txt_nu_carnet')		.focus();

		});
		
	$('.btn_add_item').unbind('click');
	$('.btn_add_item').on("click", function(e) {
	
		var boton 		= $(this).attr('id');
		
		var url_slt     = $(this).attr('url_slt'); 
		
		var id_slt      = $(this).attr('id_slt');
		
		var nb_item     = $(this).attr('nb_item'); 
		
		var url_reload  = $(this).attr('url_reload'); 
		
		$.fn.get_update_item(url_slt, url_reload, id_slt, nb_item);
	});
	
	$('.frm_button').unbind('click');
	$('.frm_button').on("click", function(e) {
		
		var boton 		= $(this).attr('id');
		
		var data_form   = $(form).serializeArray();
		
		switch(boton){
			
			case 'btn_registrar':
					
					var validacion = validador.validate();
	
					if(validacion.isValid()){
						
						var data_fmr = $(form).serializeArray();
				
						$.fn.dialogo(2, '¿Desea Registrar la Visita?', 'Confirmar', $.fn.ajax_set_registrarVisita, data_fmr, null, null, '');
						
						validador.disableSubmitButtons(false);
					}
				
				break;

			case 'btn_limpiar':
				
				$.fn.clear_fmr('inicio');
				
				break;
			
			default:
			
				return false;

		};
				
	});

}//Fin de eventos


$.fn.clear_fmr = function(tipo){
	
	var input_block = null;
	
	var input_free  = null;	

	switch (tipo) {
    
	case 'inicio':
        
		input_block = $('#txt_cedula, #txt_nombres_visitante, #txt_apellidos_visitante, #slt_empresa, \
					     #slt_tipo_visitante, #txt_cargo, #txt_telefono, #slt_motivo, #txa_observaciones, \
					     #slt_UnidOrg, #txt_extension, #txt_piso, #txt_nu_carnet, #btn_registrar');
		
		input_free  = $('#slt_nacionalidad, #slt_nb_empleado, #txt_src_foto, #txt_upd_foto');
		
		validador.resetForm(true);
		
		$('#foto_visitante img').attr('src', img_default);
		$('#foto_empleado img')	.attr('src', img_default);
		$('#hdn_src_foto')		.val(null);
		$('#hdn_upd_foto')		.val(null);
		$("#slt_nb_empleado")	.val('').trigger('select2:select').trigger('change.select2');
		$('#txt_nombres_visitante, #txt_apellidos_visitante').removeAttr('readonly');
		$('#slt_nacionalidad')	.focus();
		
		tomar_foto  = false;
		
        break;
	
	case 'busqueda_pers':
        
		input_block = $('#txt_nombres_visitante, #txt_apellidos_visitante, #slt_empresa, \
					     #slt_tipo_visitante, #txt_cargo, #txt_telefono, #slt_motivo, #txa_observaciones');
		
		input_free  = $('#nothing');
		
		$('#hdn_id_visitante')	 .val(null);
		$('#foto_visitante img') .attr('src', img_default);
		$('#foto_empleado img')	 .attr('src', img_default);
		
		tomar_foto  = true;
		
        break;
		
    case 'pers_existe':
       
		input_block = $('#nothing');
	   
	    input_free  = $('#slt_empresa, #slt_tipo_visitante, #txt_cargo, #txt_telefono, \
					     #slt_motivo, #txa_observaciones');
	   
		$('#foto_visitante img').attr('src', img_default);
		
		$('#txt_nombres_visitante, #txt_apellidos_visitante').removeAttr( 'disabled').attr( 'readonly', 'readonly');
		
		tomar_foto = true;
	   
        break;
	
	case 'alerta':
       
		input_block = $('#slt_empresa, #slt_tipo_visitante, #txt_cargo, #txt_telefono, \
					     #slt_motivo, #txa_observaciones, #slt_UnidOrg, #txt_extension, \
					     #txt_piso, #txt_nu_carnet, #btn_registrar');
	   
	    input_free  = $('#nothing');
	
		tomar_foto = false;
	   
        break;
	
	case 'pers_noExiste':
		
		input_block = $('#nothing')
		
		input_free  = $('#btn_buscar, #txt_nombres_visitante,  #txt_apellidos_visitante, #slt_empresa,\
						 #slt_tipo_visitante, #txt_cargo, #txt_telefono, #slt_motivo, #txa_observaciones');
		
		$('#foto_visitante img').attr('src', img_default);
		
		$('#txt_nombres_visitante, #txt_apellidos_visitante').removeAttr('readonly');
		
		tomar_foto = true;
		
		break;
	
	case 'slt_empleado':
		
		input_block = $('#slt_UnidOrg, #txt_extension, #txt_piso')
		
		input_free  = $('#txt_nu_carnet');
		
		$('#foto_empleado img')	 .attr('src', img_default);
		
		break;
		
    default:
	
        return;
		
	} 
	
		input_block.each(function(i, item) {
			
			$(item).val(null).attr( 'disabled', 'disabled' );
			
			validador.resetField($(item).attr('name'));
    	
		});
	
		input_free.each(function(i, item) {
			
			$(item).val(null).removeAttr('disabled');

			validador.resetField($(item).attr('name'));			
			
		});

} 


$.fn.mostrar_alerta = function(data){
	
	var tx_imagen = data.tx_imagen;
	var classMsj  = null;
	var msj       = null;
	var tx_accion = data.tx_accion;
	var tipoalert = 'ALERTA ' + data.nb_tipo_alerta;
	var motialert = 'ALERTA ' + data.tx_motivo_alerta;

	switch (data.nu_nivel_alerta) {
    
		case '1':
			
			classMsj  = 'info'
			break;
		
		case '2':
	
			classMsj  = 'alerta';
			break;
			
		case '3':
			
			classMsj  = 'error';
			break;	
		
		default:
	
			return;
		
	} 
	
	msj = '<div class="justify-content-center align-items-center" align="center">   \
			<div class="'+ tx_imagen +'"><i class="fa fa-exclamation-triangle fa-5x"></i></div> \
			<div>' + tipoalert + '</div> \
			<div> Motivo: ' + motialert + '</div> \
			<div> Accion: ' + tx_accion + '</div> \
		  <div>';
		  
	msj  = $.fn.get_msj(classMsj, msj );
		
	$.fn.dialogo(1, msj, 'Alerta!!!', '', '', '', '', '');

}


$.fn.get_update_item = function(url_slt, url_reload, id_slt, nb_item){
	
	$.colorbox({
		 width:"100%", 
		 height:"100%", 
		 iframe:true,
		 initialWidth:"10px",
		 initialHeight:"10px",
		 escKey:false,
		 scrolling:true,
		 overlayClose: false,
		 title: 'Agregar '+nb_item ,
		 close: '<button type="button" class="btn btn-sm btn-danger" title="Cerrar"><i class="fa fa-close"></i></button>',
		 href: full_url+url_slt,
		 onOpen: function(){
			
		 },
		 onClosed: function(){
			 
			 $.fn.ajax_get_upd_item(url_reload, id_slt);
			 
		 }//Fin del evento onClosed
	});
}

/********* AJAX ***********/
$.fn.ajax_get_upd_item = function(url_reload, id_slt){

	$.fn.ajaxSend(full_url+url_reload, 'json', null, $.fn.resp_get_upd_item, true, true);

}
$.fn.resp_get_upd_item = function(respuesta){

	$('#'+respuesta.id_slt).attr('disabled');
	
	$('#'+respuesta.id_slt).replaceWith(respuesta.slt);
	
    validador.addField(respuesta.id_slt,({
					validators: {
						notEmpty: {
						}
					}
				}));
	
	$.fn.eventos();
}

$.fn.get_visitaCedula = function(in_cedula_nac){

	var data_send = {'in_cedula_nac': in_cedula_nac};
	
	$('#btn_buscar i').removeClass('fa-search').addClass('fa-spinner fa-spin');
	
	$.fn.ajaxSend(full_url+'C_registroVisita/get_visitaCedula', 'json', data_send, $.fn.resp_visitanteCedula, true, true);

}
$.fn.resp_visitanteCedula = function(respuesta){
	
	console.log(respuesta);
	
	var codresp  	= respuesta.cod;
	
	$('#btn_buscar i').removeClass('fa-spinner fa-spin').addClass('fa-search');
	
	if(codresp == 1){
		
		$.fn.clear_fmr('pers_existe');
		
		$('#txt_nombres_visitante')  .val(respuesta.data.tx_nombres);
		$('#txt_apellidos_visitante').val(respuesta.data.tx_apellidos);
		$('#txt_telefono')			 .val(respuesta.data.txt_telefono);
		$('#slt_empresa')			 .val(respuesta.data.id_empresa);
		$('#slt_tipo_visitante')	 .val(respuesta.data.id_tipo_visitante);
		$('#txt_cargo')			 	 .val(respuesta.data.tx_cargo);
		$('#txt_telefono')			 .val(respuesta.data.tx_telefono);
		$('#foto_visitante img') 	 .attr('src', img_path + respuesta.data.tx_foto);
		
		if(respuesta.data.id_visitante_alerta === null)
		{
		
			$('#hdn_id_visitante')		 .val(respuesta.data.id_visitante);
			$('#hdn_src_foto')			 .val(img_path+respuesta.data.tx_foto);
			$('#hdn_upd_foto')			 .val(null);
			
			validador.revalidateField('txt_nombres_visitante');
			validador.revalidateField('txt_apellidos_visitante');
			validador.revalidateField('slt_tipo_visitante');
			validador.revalidateField('slt_empresa');
			validador.revalidateField('txt_cargo');
			validador.revalidateField('txt_telefono');
			
			$('#slt_motivo').focus();
			
		}else{
			
			$.fn.clear_fmr('alerta');
			
			$.fn.mostrar_alerta(respuesta.data);
			
			validador.disableSubmitButtons(true);
		}

		
	}else if(codresp == 0){

		$.fn.clear_fmr('pers_noExiste');
		
		$('#hdn_id_visitante')		 .val(null);
		$('#hdn_src_foto')			 .val(null);
		$('#hdn_upd_foto')			 .val(null);
		$('#txt_nombres_visitante')  .focus();
		
	}else{

		classMsj = "alerta";
		
		msj 	 = $.fn.get_msj(classMsj, 'Error al consultar Cedula' );
		
		console.log(msj);
		
		$.fn.dialogo(1, msj, 'Informacion', '', '', '', '', '');
		
	}

}


$.fn.ajax_set_registrarVisita = function(data_fmr){
	
	$.fn.ajaxSend(full_url+'C_registroVisita/set_registarVisita', 'json', data_fmr, $.fn.resp_set_registrarVisita, true, true);

}
$.fn.resp_set_registrarVisita = function(respuesta){
	
	console.log(respuesta);
	
	var codresp = respuesta.cod;
	
	if(codresp == '1'){
		
		classMsj = "exito";
		$.fn.clear_fmr('inicio');
		console.log('resetear');
		
	}else{
		
		classMsj = "alerta";
		
	}
	
	msj = $.fn.get_msj(classMsj, respuesta.msj );
	
	$.fn.dialogo(1, msj, 'Informacion', '', '', '', '', '');	
	
}



/************ CAMARA  *****************/

$.fn.camara = function(){
	
	borrarFoto();
	
	$('#canvas').hide();
	
	window.taken = 0;
	
	var streaming  =  false;
	
	var canvas     = document.getElementById('canvas'); 
	
	var contex 	   = $('#canvas')[0].getContex	var foto       = $('#foto_camara');
	
	var btnFoto    = $('#btnFoto');
	
	var btnSalir   = $('#btnSalir');
	
	var video      = $('#video');
	
		video      = video[0];
		
	var width 	   = 332;
	
	var height 	   = 250;
	
	/*navigator.getMedia = ( 	navigator.getUserMedia 		|| 
							navigator.webkitGetUserMedia||
							navigator.mediaDevices 	||
							navigator.msGetUserMedia	);*/
	
	if(!camara_activa){  



		/*if (!tieneSoporteUserMedia()) {
			alert("Lo siento. Tu navegador no soporta esta característica");
			$estado.innerHTML = "Parece que tu navegador no soporta esta característica. Intenta actualizarlo.";
			return;
		}
		//Aquí guardaremos el stream globalmente
		let stream;
	
		navigator.getMedia(
		
			{ 
				audio: false,
				video: {width: width, height: height}
			},
			
			function(stream) {
				
				if (navigator.mozGetUserMedia) { 
				
					video.mozSrcObject = stream;
					
				} else {
					
					var vendorURL = window.URL || window.webkitURL;
					video.src = vendorURL ? vendorURL.createObjectURL(stream) : stream;
					
				}
				
				window.error = 0;
				camara_activa = true;
				video.play();
			},
			
			function(err) {
				
				window.error = 1;
				$.fn.dialogo(1, 'No es posible iniciar dispositivo de Camara: '+ err, 'Informacion', '', '', '', '', '');
			}
		)*/
	}
	
	$(video).on('canplay', function(bnt){
		
		if (!streaming) {
			

			streaming = true;
			video.setAttribute('width', width);
			video.setAttribute('height', height);
			canvas.setAttribute('width', 218);
			canvas.setAttribute('height', 249);

		}
	});
	
	$(btnFoto).unbind();
	$(btnFoto).on('click', function(bnt){
		
		if(window.error == 0){
		  
		  //contex.strokeRect(5, 5, width-10, height-10)
		  tomarFoto();
		  window.taken = 1;
		  
		}
		
	});
	
	$(btnSalir).unbind();
	$(btnSalir).on('click', function(bnt){
		
		if(window.taken == 1){ 
			
			$('#foto_visita').attr('src', window.data);
			$('#hdn_src_foto').val(window.data);
			$('#hdn_upd_foto').val('si');
			validador.revalidateField('hdn_src_foto');

		} 
		$('#foto_modal').modal('hide');
		
	});

	function tieneSoporteUserMedia() {
		return !!(navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia)
	}
	function _getUserMedia() {
		return (navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia).apply(navigator, arguments);
	}
	


	function tomarFoto() {
		
		//contex.drawImage(video, 80, 20, 700, 460, 0, 0, 700, 460);
		contex.drawImage(video, 60, 0, 211, 242, 0, 0, 218, 249);
		
		window.data = canvas.toDataURL('image/png');
		
		$(foto).attr('src', window.data);
		
		window.taken = 1;
		
	}
	
	function borrarFoto() {
		
		$(foto).attr('src', img_default);
	}

}//Fin del function
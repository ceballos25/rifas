<!-- este archivo procesa las respuestas segun sea el caso de la transaccion -->
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Respuesta Transacción</title>
  <!-- Bootstrap -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../css/style.css">
  

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body>
  <div class="container">
    <div class="row" style="margin-top:20px">
      <div class="col-lg-8 col-lg-offset-2 ">
        <h3 style="text-align:center"> Respuesta de la Transacción </h3>
        <hr>
      </div>
      <div class="col-lg-8 col-lg-offset-2 ">
        <div class="table-responsive">
          <table class="table table-bordered">
            <tbody>
              <tr>
                <td>Referencia</td>
                <td id="referencia"></td>
              </tr>
              <tr>
                <td class="bold">Fecha</td>
                <td id="fecha" class=""></td>
              </tr>
              <tr>
                <td>Respuesta</td>
                <td id="respuesta"></td>
              </tr>
              <tr>
                <td>Motivo</td>
                <td id="motivo"></td>
              </tr>
              <tr>
                <td class="bold">Banco</td>
                <td class="" id="banco">
              </tr>
              <tr>
                <td class="bold">Recibo</td>
                <td id="recibo"></td>
              </tr>
              <tr>
                <td class="bold">Total</td>
                <td class="" id="total">
                </td>
              </tr>
              <tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

<!-- Modal confirmación transaccion-->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalTransaccionAceptada" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-main">
        <h2 class="modal-title text-center" id="exampleModalLabel">La transacción fue aprobada</h2>
      </div>
      <div class="modal-body">
        En los próximos minutos recibirá al correo electrónico, los números de su sorteo y toda la información relacionada al mismo.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-btn-principal" data-dismiss="modal">De acuerdo</button>
      </div>
    </div>
  </div>
</div>
<!-- fin modal confirmacion -->


<!-- Modal transaccion rechazada-->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalTransaccionRechazada" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-rechazada">
        <h2 class="modal-title text-center" id="exampleModalLabel">Transacción Rechazada</h2>
      </div>
      <div class="modal-body">
      Por favor, intentelo nuevamente
    </div>
      <div class="modal-footer">
        <a type="button" class="btn btn-outline-secondary" data-dismiss="modal">Salir</a>
        <a type="button" href="../index.php" class="btn btn-btn-principal">Volver a Intertar</a>
      </div>
    </div>
  </div>
</div>
<!-- fin modal transaccion rechazada -->

<!-- Modal transaccion pendiente-->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalTransaccionPendiente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-main">
        <h2 class="modal-title text-center" id="exampleModalLabel">Transacción PENDIENTE</h2>
      </div>
      <div class="modal-body">
      Su transación fue recibida y se encuentra en estado pendiente de APROBACIÓN, una vez sea aprobada el sistema le enviará la confirmación.
    </div>
      <div class="modal-footer">
        <a type="button" href="../index.php" class="btn btn-btn-principal" data-dismiss="modal">De acuerdo</a>
      </div>
    </div>
  </div>
</div>
<!-- fin modal transaccion pendiente -->

<!-- Modal transaccion fallida-->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalTransaccionFallida" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-rechazada">
        <h2 class="modal-title text-center" id="exampleModalLabel">La transacción falló</h2>
      </div>
      <div class="modal-body">
      Por favor, intentelo nuevamente
    </div>
      <div class="modal-footer">
        <a type="button" href="../index.php" class="btn btn-btn-principal">Volver a Intertar</a>
      </div>
    </div>
  </div>
</div>
<!-- fin modal transaccion fallida -->

  <footer>
    <div class="row">
      <div class="container">
        <div class="col-lg-8 col-lg-offset-2">
          <img src="https://369969691f476073508a-60bf0867add971908d4f26a64519c2aa.ssl.cf5.rackcdn.com/btns/epayco/pagos_procesados_por_epayco_260px.png" style="margin-top:10px; float:left"> <img src="https://369969691f476073508a-60bf0867add971908d4f26a64519c2aa.ssl.cf5.rackcdn.com/btns/epayco/credibancologo.png"
            height="40px" style="margin-top:10px; float:right">
        </div>
      </div>
    </div>
  </footer>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
    function getQueryParam(param) {
      location.search.substr(1)
        .split("&")
        .some(function(item) { // returns first occurence and stops
          return item.split("=")[0] == param && (param = item.split("=")[1])
        })
      return param
    }
    $(document).ready(function() {
      //llave publica del comercio

      //Referencia de payco que viene por url
      var ref_payco = getQueryParam('ref_payco');
      //Url Rest Metodo get, se pasa la llave y la ref_payco como paremetro
      var urlapp = "https://secure.epayco.co/validation/v1/reference/" + ref_payco;

      //aqui es necesario guardar la variable de refpyco porque es con la que se vconsulta luego los estados
      id_ref_payco = ref_payco;

      $.get(urlapp, function(response) {

        if (response.success) {
          //la transaccion fue aprobada
          if (response.data.x_cod_response == 1) {
              // Enviar datos al servidor
            $.ajax({
                type: "GET",
                url: "success.php", 
                data: {
                    ref_payco: response.data.x_ref_payco,
                    id_ref_payco: id_ref_payco,
                    respuesta: response.data.x_response,
                    motivo: response.data.x_response_reason_text,
                    banco: response.data.x_bank_name,
                    recibo: response.data.x_transaction_id,
                    total: response.data.x_amount + ' ' + response.data.x_currency_code,
                    fecha: response.data.x_transaction_date,
                    nombre_cliente: response.data.x_xextra1,
                    cedula_cliente: response.data.x_xextra2,
                    correo_cliente: response.data.x_xextra3,
                    celular_cliente: response.data.x_xextra4,
                    total_numeros: response.data.x_xextra5  
                },
                success: function (data) {
                  $('#modalTransaccionAceptada').modal('show')
                },
                error: function () {
                  console.error('Error al enviar datos al servidor');
                }
            });
          }
          //Transaccion Rechazada
          if (response.data.x_cod_response == 2) {
              // Enviar datos al servidor
              $.ajax({
                type: "GET",
                url: "success.php", 
                data: {
                    ref_payco: response.data.x_ref_payco,
                    id_ref_payco: id_ref_payco,
                    respuesta: response.data.x_response,
                    motivo: response.data.x_response_reason_text,
                    banco: response.data.x_bank_name,
                    recibo: response.data.x_transaction_id,
                    total: response.data.x_amount + ' ' + response.data.x_currency_code,
                    fecha: response.data.x_transaction_date,
                    nombre: response.data.x_extra1,
                    cedula: response.data.x_extra2,
                    correo: response.data.x_extra3,
                    celular: response.data.x_extra4,
                    totalNumeros: response.data.x_extra5
                    
                    
                },
                success: function (data) {
                  
                  $('#modalTransaccionRechazada').modal('show')
                },
                error: function () {
                    console.error('Error al enviar datos al servidor');
                }
            });
          }

          //Transaccion Pendiente
          if (response.data.x_cod_response == 3) {
              // Enviar datos al servidor
              $.ajax({
                type: "GET",
                url: "success.php", 
                data: {
                    ref_payco: response.data.x_ref_payco,
                    id_ref_payco: id_ref_payco,
                    respuesta: response.data.x_response,
                    motivo: response.data.x_response_reason_text,
                    banco: response.data.x_bank_name,
                    recibo: response.data.x_transaction_id,
                    total: response.data.x_amount + ' ' + response.data.x_currency_code,
                    fecha: response.data.x_transaction_date,
                    nombre: response.data.x_extra1,
                    cedula: response.data.x_extra2,
                    correo: response.data.x_extra3,
                    celular: response.data.x_extra4,
                    totalNumeros: response.data.x_extra5
                    
                    
                },
                success: function (data) {
                  $('#modalTransaccionPendiente').modal('show')
                },
                error: function () {
                  console.error('Error al enviar datos al servidor');
                }
            });
          }
          //Transaccion Fallida
          if (response.data.x_cod_response == 4) {
            $('#modalTransaccionFallida').modal('show')

          }

          $('#fecha').html(response.data.x_transaction_date);
          $('#respuesta').html(response.data.x_response);
          $('#referencia').text(response.data.x_id_invoice);
          $('#motivo').text(response.data.x_response_reason_text);
          $('#recibo').text(response.data.x_transaction_id);
          $('#banco').text(response.data.x_bank_name);
          $('#autorizacion').text(response.data.x_approval_code);
          $('#total').text(response.data.x_amount + ' ' + response.data.x_currency_code);
          $('#nombre_cliente').text(response.data.x_extra1);
          $('#cedula').text(response.data.x_extra2);
          $('#correo').text(response.data.x_extra3);
          $('#celular').text(response.data.x_extra4);
          $('#totalNumeros').text(response.data.x_extra5);

        } else {
          alert("Error consultando la información");
        }
      });

    });
  </script>
</body>

</html>

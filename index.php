<?php
session_start();

// Verifica si ya existe un token CSRF en la sesión
if (!isset($_SESSION['csrf_token'])) {
    // Si no existe, genera un nuevo token y almacénalo en la sesión
    $csrf_token = bin2hex(random_bytes(32)); // Generar un nuevo token CSRF
    $_SESSION['csrf_token'] = $csrf_token;
} else {
    // Si ya existe un token CSRF en la sesión, usa el existente
    $csrf_token = $_SESSION['csrf_token'];
}

include 'includes/header.php';
include 'config/config_bd.php';

$conn = obtenerConexion();

      
$sql = "SELECT ROUND((COUNT(numero) / 10000) * 100) AS porcentaje FROM numeros_vendidos;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $porcentaje = $row["porcentaje"];
    $procentajeReal = $porcentaje .'%';
} else {
    $porcentaje = 0;
}

$conn->close();
?>
   
   <span class="ir-arriba"></span>
   <!-- banner -->
   <!-- whatsapp -->
   <div class="btn-whatsapp">
  <a href="https://wa.link/2u006f" target="_blank">
      <img src="images/whatsapp.png" alt="boton_whatsapp">
  </a>
    </div>

    <section class="banner_main mb-5 contenido">
  <div id="banner1" class="animate__animated animate__zoomInDown">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="container">
          <h1 class="pb-1 text-center text-bg titulo-pequeno">
            <span class="text-decoration yellow">Gánate una</span>
            <br>
            <span class="yellow">Yamaha MT-15</span>
          </h1>
          <div class="row direction">
            <div class="col-md-6">
              <div class="text-bg">
                <h1 class="pb-1 text-center titulo-grande">
                  <span class="text-decoration yellow">Gánate una</span>
                  <br>
                  <span class="yellow">Yamaha MT-15</span>
                </h1>
                <p class="text-center mb-0 mt-2">Por tan solo $6.000 (cada número) puedes participar y ganarte una espectacular Moto 0 KM.</p>
                <div class="mt-5">
                <p class="mb-1 text-center fs-6">Números vendidos:</p>
                <div class="progress" style="height: 26px; position: relative;">
                <div id="progress-bar" class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" aria-valuenow="<?php echo $porcentaje; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $porcentaje; ?>%;">
                </div>
                <span class="progress-bar-text texto-barra"><?php echo $procentajeReal; ?></span>
            </div>
            </div>
              </div>
              <div class="text-bg mt-4">
                <h2 class="yellow text-center">¿Dudas?</h2>
                <div class="p-3 mx-3">
                  <div class="accordion" id="accordionExample">
                    <div class="card card-dudas">
                      <div class="card-header bg-dark m-0 p-1" id="headingOne">
                        <h2 class="mb-0 p-0">
                          <button class="btn btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <h3 class="text-white">¿Cuándo es el Sorteo? <i class="fa-solid fa-chevron-down mr-auto"></i></h3>
                          </button>
                        </h2>
                      </div>

                      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body fs-5">
                        Jugará con las (4) cifras de la L0t3teria de Medellín. Al completar el <b>80%</b> de los números, anunciaremos la fecha del sorteo en nuestro sitio Web y redes sociales.  
                      </div>
                      </div>
                    </div>

                    <div class="card card-dudas mt-1">
                      <div class="card-header bg-dark p-1" id="headingThree">
                        <h2 class="mb-0 p-0">
                          <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <h3 class="text-white">¿A dónde me puedo comunicar? <i class="fa-solid fa-chevron-down mr-auto"></i></h3>
                          </button>
                        </h2>
                      </div>

                      <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                          Puedes hacerlo a través de:
                          <ol>
                            <li><i class="fa-brands fa-whatsapp"></i> <a href="https://wa.link/2u006f">311 645 9275</a></li>
                            <li><i class="fa-brands fa-instagram"></i> <a href="https://instagram.com/jorgeherreraoficial" target="_blank">jorgeherreraoficial</a></li>
                            <li><i class="fa-solid fa-envelope"></i> info@eldiadetusuerte.com</li>
                          </ol>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6 img-fluid moto position-relative">
            <div class="contenedor__img-sorteo">
              <img class="img__sorteo" src="images/fondo.jpg" width="100%" alt="rifa-moto">
              <div class="numeros-premiados" data-aos="zoom-in">
                <span class="text-bg p text-center">
                <p class="text-premiados pb-2">Tenemos cinco (5) números premiados por <span class="paqute-200">$200.000</span> cada uno.</p>
                <div class="text-center">
                <span id="paquete-premios-numeros" class="paqute fondo-numero-premiado">4015</span> <span class="paqute fondo-numero-premiado">1250</span> <span class="paqute fondo-numero-premiado">3590</span> <span class="paqute fondo-numero-premiado">9478</span> <span class="paqute fondo-numero-premiado">5845</span>

                </div>
              </span>

              </div>
            </div>

        <div class="d-flex justify-content-center mt-5 mb-4">
        <button class="read_more" data-toggle="modal" data-target="#modalRifa">¡Participar! <span class="img-logo"><img src="images/haga-clic-aqui.png" alt=""></span></button>
        </div>
    </div>


          </div>
        </div>
      </div>
    </div>
  </div>
</section>

   <!-- end banner -->


      <section data-aos="zoom-in">
     <div class="text-bg text-center mt-5">
       <h2 class="h2">
         <span class="yellow"> Paquete de Oportunidades</span>
         <p>Escoge el paquete de oportunidades que mejor se adapte a ti. Recuerda que entre más números compres, más oportunidades tienes de ganar.</p>
       </h2>
    </div>
   </section>

   <div class="contenedor-cards">
      <div class="card1" data-aos="flip-left">
        <div class="promocion">
          <h2>x2</h2>
        </div>

        <div class="precio">
          <h2>$12.000</h2>
          <i>Pesos colombianos</i>
          
        </div>
        <div class="cta-buy">
          <button onclick="modal_x2()">COMPRAR <span class="img-logo"><img src="images/haga-clic-aqui.png" alt=""></span></button>
          
        </div>
      </div>

      <div class="card1" data-aos="flip-left">
        <div class="promocion">
          <h2>x4</h2>
        </div>

        <div class="precio">
          <h2>$24.000</h2>
          <i>Pesos colombianos</i>
          
        </div>
        <div class="cta-buy">
          <button onclick="modal_x4()">COMPRAR <span class="img-logo"><img src="images/haga-clic-aqui.png" alt=""></span></button>
          
        </div>
      </div>
   </div>

   <div class="espaciado">
     <span class="espaciado"></span>
   </div>


   <div class="contenedor-cards">
      <div class="card1" data-aos="flip-left">
        <div class="promocion">
          <h2>x6</h2>
        </div>

        <div class="precio">
          <h2>$36.000</h2>
          <i>Pesos colombianos</i>
          
        </div>
        <div class="cta-buy">
          <button onclick="modal_x6()">COMPRAR <span class="img-logo"><img src="images/haga-clic-aqui.png" alt=""></span></button>
          
        </div>
      </div>

      <div class="card1"data-aos="flip-left">
        <div class="promocion">
          <h2>x10</h2>
        </div>

        <div class="precio">
          <h2>$60.000</h2>
          <i>Pesos colombianos</i>
          
        </div>
        <div class="cta-buy">
          <button onclick="modal_x10()">COMPRAR <span class="img-logo"><img src="images/haga-clic-aqui.png" alt=""></span></button>
          
        </div>
      </div>

      <div class="card1"data-aos="flip-left">
        <div class="m-2">
          <p>Puedes digitar la Cantidad:</p>
          <input type="number" required min="2" leng="830" placeholder="Aquí:" id="input_manual" class="pb-4 input-manual" oninput="actualizarTotalManual()">
        </div>

        <div class="precio">
          <h2 id="totalManual">$0</h2>
          <i>Pesos colombianos</i>
          
        </div>
        <div class="cta-buy">
          <button onclick="modal_xotro()">COMPRAR <span class="img-logo"><img src="images/haga-clic-aqui.png" alt=""></span></button>          
        </div>
      </div>
   </div>

      <!-- start Modals-Moto -->
      <div class="modal fade bd-example-modal-lg" id="modalRifa" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">  
     <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
         <div class="modal-header bg-main">
           <h2 class="modal-title title-rifa-modal" id="exampleModalLabel"> Espectacular Sorteo Moto 0 KM</h2>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <form method="POST" action="functions/mercadopago/pagar.php" id="formulario" class="formulario" autocompleate="off">
             <div class="container">
               <div class="row">
                 <div class="col-md-6">
                   <p class="mb-2">Tu información:</p>
                   <div class="form-group">
                     <div class="input-group mb-3">
                       <div class="input-group-prepend">
                         <span class="input-group-text" id="nombre">
                           <i class="fa-solid fa-user"></i>
                         </span>
                       </div>
                       <input type="text" class="form-control" minlength="5" placeholder="Nombre:" aria-label="Nombre" aria-describedby="nombre" required name="nombre" title="Por favor, completa tu nombre">
                     </div>
                   </div>
                   <div class="form-group">
                     <div class="input-group mb-3">
                       <div class="input-group-prepend">
                         <span class="input-group-text" id="cedula">
                           <i class="fa-solid fa-address-card"></i>
                         </span>
                       </div>                       
                       <input type="number" required class="form-control" min="10"  placeholder="Cedula:" aria-label="Cedula" aria-describedby="Cedula" name="cedula">
                     </div>
                   </div>
                   <div class="form-group">
                     <div class="input-group mb-3">
                       <div class="input-group-prepend">
                         <span class="input-group-text" id="correo">
                           <i class="fa-solid fa-envelope"></i>
                         </span>
                       </div>
                       <input type="email" class="form-control" placeholder="Correo:" aria-label="Correo" aria-describedby="correo" required name="correo">
                     </div>
                   </div>
                   <div class="form-group">
                     <div class="input-group mb-3">
                       <div class="input-group-prepend">
                         <span class="input-group-text" id="celular">
                           <i class="fa-solid fa-mobile-retro"></i>
                         </span>
                       </div>
                       <input type="number" class="form-control" min="10" placeholder="Celular:" aria-label="Celular" aria-describedby="Celular" required name="celular">
                     </div>

                     <div class="input-group mb-3">
                       <div class="input-group-prepend">
                         <span class="input-group-text">
                           <i class="fa-solid fa-list"></i>
                         </span>
                       </div>

                       <select class="custom-select" id="usp-custom-departamento-de-residencia" name="departamento" required>
                        <option value="">Departamento</option>
                        <option value="Antioquía">ANTIOQUIA</option>
                        <option value="Amazonas">AMAZONAS</option>
                        <option value="Arauca">ARAUCA</option>
                        <option value="Atlántico">ATLÁNTICO</option>
                        <option value="Bolívar">BOLÍVAR</option>
                        <option value="Boyacá">BOYACÁ</option>
                        <option value="Caldas">CALDAS</option>
                        <option value="Caquetá">CAQUETÁ</option>
                        <option value="Casanare">CASANARE</option>
                        <option value="Cauca">CAUCA</option>
                        <option value="Cesar">CESAR</option>
                        <option value="Chocó">CHOCÓ</option>
                        <option value="Córdoba">CÓRDOBA</option>
                        <option value="Cundinamarca">CUNDINAMARCA</option>
                        <option value="Guainía">GUAINÍA</option>
                        <option value="Guaviare">GUAVIARE</option>
                        <option value="Huila">HUILA</option>
                        <option value="La Guajira">LA GUAJIRA</option>
                        <option value="Magdalena">MAGDALENA</option>
                        <option value="Meta">META</option>
                        <option value="Nariño">NARIÑO</option>
                        <option value="Norte de Santander">NORTE DE SANTANDER</option>
                        <option value="Putumayo">PUTUMAYO</option>
                        <option value="Quindío">QUINDÍO</option>
                        <option value="Risaralda">RISARALDA</option>
                        <option value="San Andrés y Providencia">SAN ANFRÉS Y PROVIDENCIA</option>
                        <option value="Santander">SANTANDER</option>
                        <option value="Sucre">SUCRE</option>
                        <option value="Tolima">TOLIMA</option>
                        <option value="Valle del Cauca">VALL DEL CAUCA</option>
                        <option value="Vaupés">VAUPÉS</option>
                        <option value="Vichada">VICHADA</option>
                       </select>                      
                     </div>

                     <div class="input-group mb-3">
                       <div class="input-group-prepend">
                         <span class="input-group-text" id="">
                           <i class="fa-solid fa-list"></i>
                         </span>
                       </div>
                       <select class="custom-select" id="usp-custom-municipio-ciudad" name="ciudad" required>
                       <option value="" disabled selected>Seleccionar..</option>
                       </select>
                     </div>
                     
                     <div class="input-group mb-3">
                       <div class="input-group-prepend">
                         <span class="input-group-text" id="">
                           <i class="fa-solid fa-list"></i>
                         </span>
                       </div>
                       <select class="custom-select" id="opciones_boletas" name="opciones_boletas">
                         <option value="Cantidad de Oportunidades" required>Oportunidades</option>
                         <option value="2">x2 = $12.000</option>
                         <option value="4">x4 = $24.000</option>
                         <option value="6">x6 = $36.000</option>
                         <option value="10">x10 = $60.000</option>
                         <option value="Otro">Otro</option>
                       </select>
                     </div>
                     
                     <div class="input-otro">
                       <div class="input-group mb-3 ">
                         <div class="input-group-prepend">
                           <span class="input-group-text" id="cantidad">
                             <i class="fa-solid fa-hashtag"></i>
                           </span>
                         </div>
                         <input type="number" class="form-control" placeholder="Especifica la cantidad:" aria-label="Celular" aria-describedby="Numero" id="otroInput" name="otroInput">
                       </div>
                     </div>
                     <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
 
                       <div class="input-group mb-3 ">
                          <div class="form-check input-group-prepend">
                          <input class="form-check-input" type="checkbox" value="Acepto" id="habeasData" required>
                            <label class="form-check-label" for="habeasData">
                              Acepto la Política de Protección de Datos Personales. <a class="habeas" target="_blank" href="docs/politica de proteccion de datos personale.pdf">(Consultar)</a>
                            </label>
                          </div>
                     </div>
  
                       

                      <!-- Contenedor de totales -->
                     <div class="d-flex">
                       <p>Números a Jugar: <strong>
                           <span></span>
                         </strong>
                       </p>
                       <input type="text" class="ml-1 w-50 input-total-numeros" name="totalNumeros" id="totalNumeros" value="0" readonly>
                     </div>
                     <p>Total a Pagar: <strong>$ <span id="totalPagar">0</span>
                       </strong>
                     </p>
                   </div>
                 </div>
                 <div class="col-sm mt-4">
                   <img src="images/fondo__.png" alt="">
                   <div class="alert alert-success mt-2 efecto" id="success-alert" role="alert">
                     <p class="text-sm">
                       <i class="fa-solid fa-circle-info"></i> Tenga en cuenta:
                     </p>
                     <span>Recibirá por correo electrónico todos los detalles del sorteo, los números asignados y la fecha oficial del sorteo.</span>
                   </div>
                 </div>
               </div>
             </div>
         </div>
         <div class="modal-footer">
           <div class="d-flex justify-content-between">
             <div class="ml-4">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

               <button class="btn btn-secondary btn-pay btn-loading" type="submit" id="btn-pay">
                Pagar <i class="fas fa-shopping-cart"></i>
                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>              
              </button>

             </div>
           </div>
         </div>
         </form>
       </div>
     </div>
   </div>
   <!-- end service section -->
   <!-- start include footer -->
    <?php include 'includes/footer.php' ?>
   <!-- end include footer -->
  </body>
   </html>
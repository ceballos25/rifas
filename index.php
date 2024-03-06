   <!-- start include  -->
   <?php include 'includes/header.php'?>
   <!-- end include -->
   
   <!-- banner -->
   <section class="banner_main animate__fadeInDownBig mb-5">
      <div id="banner1" class="carousel slide" data-ride="carousel">
         <ol class="carousel-indicators">
            <li data-target="#banner1" data-slide-to="0" class="active"></li>
            <li data-target="#banner1" data-slide-to="1"></li>
            <li data-target="#banner1" data-slide-to="2"></li>
         </ol>
         <div class="carousel-inner">
            <div class="carousel-item active">
               <div class="container">
                  <div class="carousel-caption">
                     <div class="row">
                        <div class="col-md-7">
                           <div class="text-bg">
                              <h1> <span class="yellow animate__animated animate__delay-1s animate__fadeInRightBig">
                                    Gánate una </span> <br
                                    class="animate__animated animate__delay-1s animate__fadeInDownBig"><span
                                    class="animate__animated animate__delay-1s animate__fadeInDownBig">Moto 0 km</span>
                              </h1>
                              <p class="animate__animated animate__delay-1s animate__fadeInRightBig">Aquí va el texto de
                                 enchanche </p>
                              <button
                                 class="read_more animate__animated animate__delay-1s animate__fadeInUpBig animate__tada"
                                 data-toggle="modal" data-target="#modalRifa">¡La quiero!
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="carousel-item">
               <div class="container">
                  <div class="carousel-caption">
                     <div class="row">
                        <div class="col-md-7">
                           <div class="text-bg">
                              <h1> <span class="yellow animate__animated animate__delay-1s animate__fadeInRightBig">
                                    Gánate una </span> <br
                                    class="animate__animated animate__delay-1s animate__fadeInDownBig"><span
                                    class="animate__animated animate__delay-1s animate__fadeInDownBig">Moto 0 km</span>
                              </h1>
                              <p class="animate__animated animate__delay-1s animate__fadeInRightBig">Aquí va el texto de
                                 enchanche </p>
                              <button
                                 class="read_more animate__animated animate__delay-1s animate__fadeInUpBig animate__tada"
                                 data-toggle="modal" data-target="#modalRifa">¡La quiero!
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="carousel-item">
               <div class="container">
                  <div class="carousel-caption">
                     <div class="row">
                        <div class="col-md-7">
                           <div class="text-bg">
                              <h1> <span class="yellow animate__animated animate__delay-1s animate__fadeInRightBig">
                                    Gánate una </span> <br
                                    class="animate__animated animate__delay-1s animate__fadeInDownBig"><span
                                    class="animate__animated animate__delay-1s animate__fadeInDownBig">Moto 0 km</span>
                              </h1>
                              <p class="animate__animated animate__delay-1s animate__fadeInRightBig">Aquí va el texto de
                                 enchanche </p>
                              <button
                                 class="read_more animate__animated animate__delay-1s animate__fadeInUpBig animate__tada"
                                 data-toggle="modal" data-target="#modalRifa">¡La quiero!
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <a class="carousel-control-prev" href="#banner1" role="button" data-slide="prev">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
         </a>
         <a class="carousel-control-next" href="#banner1" role="button" data-slide="next">
            <i class="fa fa-angle-right" aria-hidden="true"></i>
         </a>
      </div>
   </section>
   <!-- end banner -->
   
   <!-- start Modals Rifa-Moto -->
   <div class="modal fade bd-example-modal-lg" id="modalRifa" tabindex="-1" role="dialog" data-backdrop="static"
      aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header bg-main">
               <h2 class="modal-title text-center title-rifa-modal" id="exampleModalLabel">Gran Rifa Moto Pulsar NS-200 0KM</h2>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form method="POST" action="functions/proces-pay.php" id="formulario" class="formulario">
               <div class="container">
                  <div class="row">
                     <div class="col-md-6">
                        <p class="mb-2">Tu información:</p>
                        <div class="form-group">
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text" id="nombre"><i class="fa-solid fa-user"></i></span>
                              </div>
                              <input type="text" class="form-control" placeholder="Nombre:" aria-label="Nombre"
                                 aria-describedby="nombre" required name="nombre">
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text" id="cedula"><i class="fa-solid fa-address-card"></i></span>
                              </div>
                              <input type="number" class="form-control" placeholder="Cedula:" aria-label="Cedula"
                                 aria-describedby="Cedula" required name="cedula">
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text" id="correo"><i class="fa-solid fa-envelope"></i></span>
                              </div>
                              <input type="email" class="form-control" placeholder="Correo:" aria-label="Correo"
                                 aria-describedby="correo" required name="correo">
                           </div>
                        </div>

                        <div class="form-group">
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text" id="celular"><i
                                       class="fa-solid fa-mobile-retro"></i></span>
                              </div>
                              <input type="number" class="form-control" placeholder="Celular:" aria-label="Celular"
                                 aria-describedby="Celular" required name="celular">
                           </div>

                           <div class="input-group mb-3">
                           <div class="input-group-prepend">
                              <span class="input-group-text" id=""><i class="fa-solid fa-list"></i></span>
                           </div>
                           <select class="custom-select" id="opciones_boletas" name="opciones_boletas">
                              <option value="Cantidad de Oportunidades">Cantidad de Oportunidades</option>                                 
                              <option value="2">2 = $10.000</option>
                              <option value="4">4 = $20.000</option>
                              <option value="6">6 = $30.000</option>
                              <option value="10">10 = $50.000</option>
                              <option value="Otro">Otro</option>
                           </select>
                        </div>
                              <div class="input-otro">
                              <div class="input-group mb-3 ">
                              <div class="input-group-prepend">
                                 <span class="input-group-text" id="cantidad"><i class="fa-solid fa-hashtag"></i></span>
                              </div>

                              <input type="number" class="form-control" placeholder="Especifica la cantidad:" aria-label="Celular"
                                 aria-describedby="Numero" id="otroInput" name="otroInput">
                                 
                           </div>
                              </div>
                                 <!-- Contenedor de totales -->
                                 <div class="d-flex">
                                    <p>Total número a Jugar: <strong></span></strong></p>
                                    <input type="text" class="ml-1 w-50 input-total-numeros" name="totalNumeros" id="totalNumeros" value="0" readonly>
                                 </div>
                                 <p>Total a Pagar: <strong>$<span id="totalPagar">0</span></strong></p>                           
                        </div>
                     </div>

                     <div class="col-sm mt-4">
                        <img src="images/moto.png" alt="">
                        <div class="alert alert-success mt-2 efecto" id="success-alert" role="alert">
                           <p class="text-sm"><i class="fa-solid fa-circle-info"></i> Tenga en cuenta:</p>
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
                     <button class="btn btn-secondary" type="submit">Pagar</button>
                  </div>
               </div>
            </div>
         </form>
         </div>
      </div>
   </div>
   <!-- end modals -->
   <!-- service section -->
   <div class="premios" id="premios" style="margin-top:5%">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="titlepage">
                  <h2 class="text-center"><img src="images/heading_icon.png" alt="#">Pulsar NS 200 <p></p>
                  </h2>
               </div>
            </div>
         </div>

      </div>
   </div>

   <div id="carouselExampleControls" class="carousel slide mt-5" data-ride="carousel">
      <div class="carousel-inner">
         <div class="carousel-item active">
            <img class="d-block w-100 img-fluid fixed-size-image" src="images/moto.png" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
               <a class="read_more read_premios animate__animated animate__delay-0.2s animate__fadeInUpBig"
                  href="#">La Quiero</a>
            </div>
         </div>

         <div class="carousel-item">
            <img class="d-block w-100 img-fluid fixed-size-image" src="images/moto-2.png" alt="Second slide">
            <div class="carousel-caption d-none d-md-block">
               <a class="read_more read_premios animate__animated animate__delay-0.2s animate__fadeInUpBig"
                  href="#">La quiero</a>
            </div>
         </div>

         <div class="carousel-item">
            <img class="d-block w-100 img-fluid fixed-size-image" src="images/moto-3.png" alt="Third slide">
            <div class="carousel-caption d-none d-md-block">
               <a class="read_more read_premios animate__animated animate__delay-0.2s animate__fadeInUpBig"
                  href="#">La Quiero</a>
            </div>
         </div>
      </div>

      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
         <span class="carousel-control-prev-icon" id="controls-prev" aria-hidden="true"></span>
         <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
         <span class="carousel-control-next-icon h-25" id="controls-next" aria-hidden="true"></span>
         <span class="sr-only">Next</span>
      </a>
   </div>



   <!-- end service section -->
   <!-- about section -->
   <div id="about" class="about animate__animated animate__bounceInDown">
      <div class="container">
         <div class="row">
            <div class="col-md-10 offset-md-1 mb-3">
               <div class="titlepage">
                  <h2>Sigue estos Pasos</h2>
               </div>
            </div>
            <div class="card-group">
               <div class="card borde-top m-2 animate__animated animate__bounceInDown">
                  <div class="text-center pt-3">
                     <img src="images/numero-1.png" class="card-img-top" alt="paso 2">
                  </div>
                  <div class="card-body">
                     <h4 class="card-title">Escoge Tu premio</h4>
                     <p class="card-text">Contamos con diferentes premios, más texto</p>
                  </div>
               </div>
               <div class="card borde-top m-2 borde animate__animated animate__bounceInDown">
                  <div class="text-center pt-3">
                     <img src="images/numero-2.png" class="card-img-top" alt="paso 2">
                  </div>
                  <div class="card-body">
                     <h4 class="card-title">Escoge tu número Ganador</h4>
                     <p class="card-text">Puedes escoger de manera dinámica el número ganador</p>
                  </div>
               </div>
               <div class="card borde m-2 borde-top animate__animated animate__bounceInDown">
                  <div class="text-center pt-3">
                     <img src="images/numero-3.png" class="card-img-top" alt="paso 3">
                  </div>
                  <div class="card-body">
                     <h4 class="card-title">Finaliza tu compra</h4>
                     <p class="card-text">Paga con nuestros diferentes medios de pago, de manera fácil, rápida y segura.
                     </p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- about section -->

   <!-- start include footer -->
   <?php include 'includes/footer.php' ?>
   <!-- end include footer -->

</body>

</html>
   <!-- start include  <?php include 'includes/header.php'?>
   <!-- end include -->
   <span class="ir-arriba"></span>
   <!-- banner -->
   <!-- whatsapp -->
   <div class="btn-whatsapp">
        <a href="https://api.whatsapp.com/send?phone=+573245894268&amp;text=Hola,%20Quiero%20vi%20realizar%20una%20compra%20" target="_blank">
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
                <p class="text-center mb-0">Por tan solo $6.000 (cada número) puedes participar y ganarte una espectacular Moto 0 KM</p>
                <div class="mt-5">
                  <p class="mb-1 text-center fs-6">Números vendidos:</p>
                  <div class="progress" style="height: 26px;">
                    <div id="progress-bar" class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>              
                  </div>                
                </div>
              </div>
              <section class="premios-header"> 
            <span><h2 class="yellow text-center mt-5 h2">¡Y eso no es todo...!</h2></span>
            <span class="text-bg p text-center">
              <p>Tenemos cinco (5) números premiados por <span class="paqute">$200.000</span> cada uno.</p>
            </span>
            <div class="container">
              <div class="row">
                <div class="col-sm position-relative">
                  <img src="images/ticket.png" alt="" class="img-ticket premios-img-header">
                  <p class="parrafo-sobre-imagen">4015</p>
                </div>
                <div class="col-sm position-relative">
                  <img src="images/ticket.png" alt="" class="img-ticket premios-img-header">
                  <p class="parrafo-sobre-imagen">1250</p>
                </div>
                <div class="col-sm position-relative">
                  <img src="images/ticket.png" alt="" class="img-ticket premios-img-header">
                  <p class="parrafo-sobre-imagen">3590</p>
                </div>
                <div class="col-sm position-relative">
                  <img src="images/ticket.png" alt="" class="img-ticket premios-img-header">
                  <p class="parrafo-sobre-imagen">9478</p>
                </div>
                <div class="col-sm position-relative">
                  <img src="images/ticket.png" alt="" class="img-ticket premios-img-header">
                  <p class="parrafo-sobre-imagen">5845</p>
                </div>
              </div>
            </div>    
          </section>
            </div>
            <div class="col-md-6 img-fluid moto">
              <div class="contenedor__img-sorteo">
                <img class="img__sorteo" src="images/fondo.jpg" width="100%" alt="rifa-moto">
              </div>
              <div class="btn-formulario text-center mt-3">
                <button class="read_more mb-3" data-toggle="modal" data-target="#modalRifa">¡La quiero!</button>
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
     <div class="text-bg text-center">
       <h2 class="h2">
         <span class="yellow"> Paquete de Oportunidades</span>
       </h2>
       <p>Escoge el paquete de oportunidades que mejor se adpte a ti. Recuerda que entre más números compres, más oportunidades tienes de ganar.</p>
    </div>
      </div>
   </section>
   <!-- start Modals Rifa-Moto -->
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
           <form method="POST" action="functions/proces-pay" id="formulario" class="formulario">
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
                       <input type="text" class="form-control" placeholder="Nombre:" aria-label="Nombre" aria-describedby="nombre" required name="nombre">
                     </div>
                   </div>
                   <div class="form-group">
                     <div class="input-group mb-3">
                       <div class="input-group-prepend">
                         <span class="input-group-text" id="cedula">
                           <i class="fa-solid fa-address-card"></i>
                         </span>
                       </div>
                       <input type="number" class="form-control" placeholder="Cedula:" aria-label="Cedula" aria-describedby="Cedula" required name="cedula">
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
                       <input type="number" class="form-control" placeholder="Celular:" aria-label="Celular" aria-describedby="Celular" required name="celular">
                     </div>

                     <div class="input-group mb-3">
                       <div class="input-group-prepend">
                         <span class="input-group-text">
                           <i class="fa-solid fa-list"></i>
                         </span>
                       </div>
                       <select class="custom-select" id="departamento" name="departamento" required>
                        <option value="">Departamento</option>
                        <option value="Amazonas">Amazonas</option>
                        <option value="Antioquia">Antioquia</option>
                        <option value="Arauca">Arauca</option>
                        <option value="Atlántico">Atlántico</option>
                        <option value="Bogotá, D.C.">Bogotá, D.C.</option>
                        <option value="Bolívar">Bolívar</option>
                        <option value="Boyacá">Boyacá</option>
                        <option value="Caldas">Caldas</option>
                        <option value="Caquetá">Caquetá</option>
                        <option value="Casanare">Casanare</option>
                        <option value="Cauca">Cauca</option>
                        <option value="Cesar">Cesar</option>
                        <option value="Chocó">Chocó</option>
                        <option value="Córdoba">Córdoba</option>
                        <option value="Cundinamarca">Cundinamarca</option>
                        <option value="Guainía">Guainía</option>
                        <option value="Guaviare">Guaviare</option>
                        <option value="Huila">Huila</option>
                        <option value="La Guajira">La Guajira</option>
                        <option value="Magdalena">Magdalena</option>
                        <option value="Meta">Meta</option>
                        <option value="Nariño">Nariño</option>
                        <option value="Norte de Santander">Norte de Santander</option>
                        <option value="Putumayo">Putumayo</option>
                        <option value="Quindío">Quindío</option>
                        <option value="Risaralda">Risaralda</option>
                        <option value="San Andrés y Providencia">San Andrés y Providencia</option>
                        <option value="Santander">Santander</option>
                        <option value="Sucre">Sucre</option>
                        <option value="Tolima">Tolima</option>
                        <option value="Valle del Cauca">Valle del Cauca</option>
                        <option value="Vaupés">Vaupés</option>
                        <option value="Vichada">Vichada</option>
                       </select>
                     </div>

                     <div class="input-group mb-3">
                       <div class="input-group-prepend">
                         <span class="input-group-text" id="">
                           <i class="fa-solid fa-list"></i>
                         </span>
                       </div>
                       <select class="custom-select" id="ciudad" name="ciudad" required>
                         <option value="">Ciudad</option>
                        <!-- Amazonas -->
                        <option value="Leticia">Leticia</option>
                        <option value="Puerto Nariño">Puerto Nariño</option>
                        <!-- Antioquia -->
                        <option value="Medellín">Medellín</option>
                        <option value="Envigado">Envigado</option>
                        <option value="Itagüí">Itagüí</option>
                        <!-- Arauca -->
                        <option value="Arauca">Arauca</option>
                        <option value="Saravena">Saravena</option>
                        <!-- Atlántico -->
                        <option value="Barranquilla">Barranquilla</option>
                        <option value="Soledad">Soledad</option>
                        <option value="Malambo">Malambo</option>
                        <!-- Bogotá, D.C. -->
                        <option value="Bogotá">Bogotá</option>
                        <!-- Bolívar -->
                        <option value="Cartagena">Cartagena</option>
                        <option value="Turbaco">Turbaco</option>
                        <!-- Boyacá -->
                        <option value="Tunja">Tunja</option>
                        <option value="Duitama">Duitama</option>
                        <!-- Caldas -->
                        <option value="Manizales">Manizales</option>
                        <option value="La Dorada">La Dorada</option>
                        <!-- Caquetá -->
                        <option value="Florencia">Florencia</option>
                        <!-- Casanare -->
                        <option value="Yopal">Yopal</option>
                        <!-- Cauca -->
                        <option value="Popayán">Popayán</option>
                        <option value="Santander de Quilichao">Santander de Quilichao</option>
                        <!-- Cesar -->
                        <option value="Valledupar">Valledupar</option>
                        <!-- Chocó -->
                        <option value="Quibdó">Quibdó</option>
                        <!-- Córdoba -->
                        <option value="Montería">Montería</option>
                        <!-- Cundinamarca -->
                        <option value="Soacha">Soacha</option>
                        <option value="Girardot">Girardot</option>
                        <!-- Guainía -->
                        <option value="Puerto Inírida">Puerto Inírida</option>
                        <!-- Guaviare -->
                        <option value="San José del Guaviare">San José del Guaviare</option>
                        <!-- Huila -->
                        <option value="Neiva">Neiva</option>
                        <!-- La Guajira -->
                        <option value="Riohacha">Riohacha</option>
                        <!-- Magdalena -->
                        <option value="Santa Marta">Santa Marta</option>
                        <option value="Ciénaga">Ciénaga</option>
                        <!-- Meta -->
                        <option value="Villavicencio">Villavicencio</option>
                        <option value="Acacías">Acacías</option>
                        <!-- Nariño -->
                        <option value="Pasto">Pasto</option>
                        <option value="Tumaco">Tumaco</option>
                        <!-- Norte de Santander -->
                        <option value="Cúcuta">Cúcuta</option>
                        <option value="Ocaña">Ocaña</option>
                        <!-- Putumayo -->
                        <option value="Mocoa">Mocoa</option>
                        <!-- Quindío -->
                        <option value="Armenia">Armenia</option>
                        <!-- Risaralda -->
                        <option value="Pereira">Pereira</option>
                        <option value="Dosquebradas">Dosquebradas</option>
                        <!-- San Andrés y Providencia -->
                        <option value="San Andrés">San Andrés</option>
                        <!-- Santander -->
                        <option value="Bucaramanga">Bucaramanga</option>
                        <option value="Floridablanca">Floridablanca</option>
                        <!-- Sucre -->
                        <option value="Sincelejo">Sincelejo</option>
                        <!-- Tolima -->
                        <option value="Ibagué">Ibagué</option>
                        <!-- Valle del Cauca -->
                        <option value="Cali">Cali</option>
                        <option value="Buenaventura">Buenaventura</option>
                        <!-- Vaupés -->
                        <option value="Mitú">Mitú</option>
                        <!-- Vichada -->
                        <option value="Puerto Carreño">Puerto Carreño</option>
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
               <button class="btn btn-secondary btn-pay" type="submit">Finalizar Compra <i class="fas fa-shopping-cart"></i></button>
             </div>
           </div>
         </div>
         </form>
       </div>
     </div>
   </div>

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
   </div>

      <section class="mt-5 mb-5 premios-footer"> 
      <span><h2 class="yellow text-center mt-5 h2" data-aos="zoom-in">¡Y eso no es todo...!</h2></span>
      <span class="text-bg p text-center" data-aos="zoom-in">
        <p>Tenemos cinco (5) números premiados por <span class="paqute">$200.000</span> cada uno.</p>
      </span>
      <div class="container"data-aos="flip-left">
      <div class="row">
                <div class="col-sm position-relative relative-footer">
                  <img src="images/ticket.png" alt="" class="img-ticket premios-img-footer">
                  <p class="parrafo-sobre-imagen-footer">4015</p>
                </div>
                <div class="col-sm position-relative relative-footer">
                  <img src="images/ticket.png" alt="" class="img-ticket premios-img-footer">
                  <p class="parrafo-sobre-imagen-footer">1250</p>
                </div>
                <div class="col-sm position-relative relative-footer">
                  <img src="images/ticket.png" alt="" class="img-ticket premios-img-footer">
                  <p class="parrafo-sobre-imagen-footer">3590</p>
                </div>
                <div class="col-sm position-relative relative-footer">
                  <img src="images/ticket.png" alt="" class="img-ticket premios-img-footer">
                  <p class="parrafo-sobre-imagen-footer">9478</p>
                </div>
                <div class="col-sm position-relative relative-footer">
                  <img src="images/ticket.png" alt="" class="img-ticket premios-img-footer">
                  <p class="parrafo-sobre-imagen-footer">5845</p>
                </div>
              </div>
      </div>    
    </section>
 

   <!-- end service section -->
   <!-- start include footer --> <?php include 'includes/footer.php' ?>
   <!-- end include footer -->
   </body>
   </html> -->
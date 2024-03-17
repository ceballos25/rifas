   <!-- start include  --> <?php include 'includes/header.php'?>
   <!-- end include -->
   <span class="ir-arriba"></span>
   <!-- banner -->
   <section class="banner_main animate__fadeInDownBig mb-5 contenido">
     <div id="banner1">
       <div class="carousel-inner">
         <div class="carousel-item active">
           <div class="container">
             <div class="carousel-caption">
               <div class="row">
                 <div class="col-md-8 img-fluid moto">
                   <img id="img" src="images/fondo.png" width="100%" alt="rifa-moto">
                   <button class="read_more animate__animated animate__delay-1s animate__fadeInUpBig animate__tada mt-3 mb-3 float-center" data-toggle="modal" data-target="#modalRifa">¡La quiero! </button>
                 </div>
                 <div class="col-md-4">
                   <div class="text-bg mb-0">
                     <h1 class="pb-1 text-center">
                       <span class="text-deration yellow animate__animated animate__delay-1s animate__fadeInRightBig"> Gánate una </span>
                       <br class="animate__animated animate__delay-1s animate__fadeInDownBig">
                       <span class="animate__animated animate__delay-1s animate__fadeInDownBig mb-0 texto-con-mancha">Yamaha MT-15</span>
                     </h1>
                     <p class="text-center animate__animated animate__delay-1s animate__fadeInRightBig mb-0">Por tan solo $6.000 (cada número) puedes participar y ganarte una espectacular Moto 0km</p>
                     <div class="animate__animated animate__delay-1s animate__fadeInDownBig mt-5">
                       <p class="mb-1 text-center fs-6">Números vendidos:</p>
                       <div class="progress" style="height: 26px;">
                         <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">10%</div>
                       </div>
                     </div>
                   </div>
                 </div>
               </div>
             </div>
           </div>
         </div>
       </div>
   </section>
   <!-- end banner -->
   <section>
     <div class="text-bg text-center">
       <h2 class="h2">
         <span class="yellow animate__animated animate__delay-1s animate__fadeInRightBig"> Paquete de Oportunidades</span>
       </h2>
       <p class="animate__animated animate__delay-1s animate__fadeInRightBig">Escoge el paquete que mejor se adapte a ti, tenemos 5 números premiados por <span style="background-color: #00FF00; border-radius: 50%; font-weight: 600; font-size: 22px; color:#000; padding:10px; font-style: oblique">$200.000</span>
         <span> cada uno
       </p>
     </div>
   </section>
   <!-- start Modals Rifa-Moto -->
   <div class="modal fade bd-example-modal-lg" id="modalRifa" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
         <div class="modal-header bg-main">
           <h2 class="modal-title text-center title-rifa-modal" id="exampleModalLabel">Gran Rifa Moto Pulsar NS-200 0KM</h2>
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
                         <span class="input-group-text" id="">
                           <i class="fa-solid fa-list"></i>
                         </span>
                       </div>
                       <select class="custom-select" id="departamento" name="departamento">
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
                       <select class="custom-select" id="ciudad" name="ciudad">
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
                         <option value="Cantidad de Oportunidades">Oportunidades</option>
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
                           </span>
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
                   <img src="images/fondo.png" alt="">
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
               <button class="btn btn-secondary" type="submit">Pagar</button>
             </div>
           </div>
         </div>
         </form>
       </div>
     </div>
   </div>
   <!-- end modals -->
   <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="500000">
     <ol class="carousel-indicators">
       <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
       <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
       <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
     </ol>
     <div class="carousel-inner">
       <div class="carousel-item active">
         <div class="card-group text-center">
           <div class="card m-2 animate__animated animate__bounceInDown">
             <a type="button" data-toggle="modal" data-target="#modalRifa" onclick="modal_x2()">
               <div class="card-body d-grid">
                 <img src="images/x2.png" alt="" class="img-fluid rounded-lg-img animate__animated animate__bounceInDown">
               </div>
             </a>
           </div>
           <div class="card m-2 borde animate__animated animate__bounceInDown">
           <a type="button" data-toggle="modal" data-target="#modalRifa" onclick="modal_x4()">
               <div class="card-body">
                 <img src="images/x4.png" alt="" class="img-fluid rounded-lg-img animate__animated animate__bounceInDown">
               </div>
             </a>
           </div>
         </div>
       </div>
       <div class="carousel-item">
         <div class="card-group text-center">
           <div class="card m-2 animate__animated animate__bounceInDown">
           <a type="button" data-toggle="modal" data-target="#modalRifa" onclick="modal_x6()">
               <div class="card-body">
                 <img src="images/x6.png" alt="" class="img-fluid rounded-lg-img">
               </div>
             </a>
           </div>
           <div class="card m-2 borde animate__animated animate__bounceInDown">
           <a type="button" data-toggle="modal" data-target="#modalRifa" onclick="modal_x10()">
               <div class="card-body">
                 <img src="images/x10.png" alt="" class="img-fluid rounded-lg-img">
               </div>
             </a>
           </div>
         </div>
       </div>
       <div class="carousel-item">
         <div class="card-group text-center">
           <div class="card m-2 animate__animated animate__bounceInDown">
             <a type="button">
               <div class="card-body">
                 <img src="images/x2.png" alt="" class="img-fluid rounded-lg-img">
               </div>
             </a>
           </div>
           <div class="card m-2 borde animate__animated animate__bounceInDown">
             <a type="button">
               <div class="card-body">
                 <img src="images/x4.png" alt="" class="img-fluid rounded-lg-img">
               </div>
             </a>
           </div>
         </div>
       </div>
     </div>
     <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators" data-slide="prev">
       <span class="carousel-control-prev-icon" aria-hidden="true"></span>
       <span class="sr-only">Previous</span>
     </button>
     <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators" data-slide="next">
       <span class="carousel-control-next-icon" aria-hidden="true"></span>
       <span class="sr-only">Next</span>
     </button>
   </div>
   <!-- end service section -->
   <!-- start include footer --> <?php include 'includes/footer.php' ?>
   <!-- end include footer -->
   </body>
   </html>
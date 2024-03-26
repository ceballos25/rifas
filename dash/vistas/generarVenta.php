<?php
    include '../include/header.php';
    include '../config/config_db.php';
    $conn = obtenerConexion();

    $conn->close();
?>


<!-- termina header -->

<!-- inicia plantilla -->
<?php

    include 'plantilla.php';
?>
<!-- termina plantilla -->
 

<!-- inicia contenido -->
            <div id="layoutSidenav_content">
                <main>
                <h1 class="mt-4 mb-4 mx-4">Generar una Venta</h1>
                    <div class="container-fluid px-4">
                    <form class="row g-3" method="POST" action="../functions/prueba.php" id="formulario">
                        <div class="col-md-4">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control text-capitalice" id="nombre" name="nombre" required>
                        </div>
                        <div class="col-md-4">
                            <label for="inputPassword4" class="form-label">Cédula:</label>
                            <input type="number" class="form-control" id="cedula" name="cedula" required>
                        </div>
                        <div class="col-md-4">
                            <label for="correo" class="form-label">Correo</label>
                            <input type="email" class="form-control" id="correo" name="correo" required>
                        </div>
                        <div class="col-md-4">
                            <label for="inputAddress2" class="form-label">Celular:</label>
                            <input type="celular" class="form-control" id="celular" name="celular" required>
                        </div>
                        <div class="col-md-4">
                            <label for="inputState" class="form-label">Departamento:</label>
                            <select class="custom-select form-control" id="usp-custom-departamento-de-residencia" name="departamento" required>
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
                        <div class="col-md-4">
                            <label for="inputState" class="form-label">Ciudad:</label>
                            <select class="custom-select form-control" id="usp-custom-municipio-ciudad" name="ciudad" required>
                       <option value="" disabled selected>Seleccionar..</option>
                       </select>
                        </div>

                        <div class="col-md-4">
                            <label for="inputAddress2" class="form-label">Comprobante de pago:</label>
                            <input type="text" class="form-control" id="comprobante" name="comprobante" required>
                        </div>

                        <div class="col-md-4">
                            <label for="inputAddress2" class="form-label">Cantidad de números:</label>
                            <input type="number" class="form-control" id="oportunidades" name="oportunidades" required>
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" id="btn-submit" class="btn btn-success">Generar</button>
                        </div>
                        </form>
                    </div>
                </main>
<!-- termina contenido -->

<!-- inicia footer -->
<?php
include '../include/footer.php';
?>
<!-- termina footer -->
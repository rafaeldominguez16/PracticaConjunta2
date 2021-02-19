<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous">
        <link rel="stylesheet" href="../../css/gestion/css.css">
        <link rel="stylesheet" href="../../css/gestion/estilo.css">
        <link rel="shortcut icon" href="../../img/favicon.ico" type="image/x-icon">
        <title>Nuevas Profesiones</title>
    </head>

    <body>
        <?php session_start();?>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="../principal.php"><img src="../../img/np.png"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto ">
                        <li class="nav-item active dropdown">
                            <a class="nav-link dropdown-toggle" href="" data-toggle="dropdown">Gestión</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="../gestion/gestion-materiales.php">Materiales</a>
                                <a class="dropdown-item" href="./gestion/gestion-usuarios.php">Usuarios</a>
                            </div>
                        </li>

                        <li class="nav-item ml-2 active dropdown">
                            <a class="nav-link dropdown-toggle" href="" data-toggle="dropdown">Préstamos</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="usuario-entrega.php">Entrega</a>
                                <a class="dropdown-item" href="usuario-devolucion.php">Devolución</a>
                            </div>
                        </li>

                        <li class="nav-item ml-2 active dropdown">
                            <a class="nav-link dropdown-toggle" href="" data-toggle="dropdown">Consultas</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="../consultas/prestamos.php">Prestamos</a>
                                <a class="dropdown-item" href="../consultas/materiales.php">Materiales</a>
                                <a class="dropdown-item" href="../consultas/usuarios.php">Usuarios</a>
                                <a class="dropdown-item" href="../consultas/morosos.php">Morosos</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container titulhr">
            <h2 class="titulo">Préstamos | Prestar Materiales</h2>    
        </div>
           
        <form action="entrega.php" method="POST">
            <div class="container">
                <div class="row">
                    <div class="col-xl-2 col-lg-2 col-md-2 col-dm-2 col-12 text-center">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipoObjeto" value="camara" id="flexRadioDefault1" checked>
                            <label class="form-check-label" for="flexRadioDefault1">Cámara</label>
                        </div>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2 col-dm-2 col-12 text-center">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipoObjeto" value="microfono" id="flexRadioDefault2">
                            <label class="form-check-label" for="flexRadioDefault2">Micrófono</label>
                        </div>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2 col-dm-2 col-12 text-center">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipoObjeto" value="auricular" id="flexRadioDefault2">
                            <label class="form-check-label" for="flexRadioDefault2">Auriculares</label>
                        </div>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2 col-dm-2 col-12 text-center">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipoObjeto" value="tripode" id="flexRadioDefault2">
                            <label class="form-check-label" for="flexRadioDefault2">Trípode</label>
                        </div>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2 col-dm-2 col-12 text-center">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipoObjeto" value="cable" id="flexRadioDefault2">
                            <label class="form-check-label" for="flexRadioDefault2">Cable</label>
                        </div>
                    </div>


                    <div class="col-xl-2 col-lg-2 col-md-2 col-dm-2 col-12 text-center">
                        <button type="submit" name="botonBuscar" class="btn btn-outline-primary">Buscar</button>
                    </div>
                </div>
           
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-dm-12 col-12 my-5 text-center">
                        <select class="form-select form-select-sm w-50 caract" aria-label="form-select-sm example" name="material">
                            <?php
                                error_reporting(0);
                                $conexionBD = mysqli_connect("localhost", "root", "", "bd_prestamos");
                                
                                
                                if (isset($_POST["botonBuscar"])){
                                    $material = $_POST["tipoObjeto"];
                                    $SQL = "SELECT num_serie, marca, modelo FROM materiales WHERE estado = 'stock' AND nombre_materiales = '$material'";
                                    $consulta = mysqli_query($conexionBD, $SQL);
                                    
                                    while ($columna = mysqli_fetch_array($consulta, MYSQLI_ASSOC)){
                                        $numSerie = $columna["num_serie"];
                                        $modelo = $columna["modelo"];
                                        $marca = $columna["marca"];
                                                                            
                                        $value = $numSerie . "-" . date("Y/m/d") . "-" . date("Y/m/d",strtotime(date("Y/m/d")."+ 15 day"));
                                        
                                        echo "<option value='$value'> $numSerie - $marca, $modelo</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-outline-primary m-auto" name="botonPrestar">Prestar</button>
                </div>
                
                <?php
                    if (isset($_POST["botonPrestar"])) {
                        $prestamoMaterial = $_POST["material"];
                        $array = explode("-", $prestamoMaterial);

                        $num_serie = $array[0];

                        $fecha_prestamo = strtotime($array[1]);
                        $fecha_prestamo_formato = date('Y-m-d', $fecha_prestamo);

                        $fecha_maxima = strtotime($array[2]);
                        $fecha_maxima_formato = date('Y-m-d', $fecha_maxima);

                        session_start();
                        $dni = $_SESSION["dni"];
                        
                        if ($resultadod = mysqli_query($conexionBD, "SELECT dni FROM prestamos WHERE dni = '$dni'")) { 
                            if (mysqli_num_rows($resultadod) < 3){
                                $prestar = "INSERT INTO prestamos (dni, num_serie, fecha_prestamo, fecha_devolucion, fecha_maxima) VALUES ('$dni', '$num_serie', '$fecha_prestamo_formato', NULL, '$fecha_maxima_formato')";
                        
                                if (mysqli_query($conexionBD, $prestar)) {
                                    $actualizar = "UPDATE materiales SET estado = 'prestamo' WHERE num_serie = '$num_serie'";
                                    if (mysqli_query($conexionBD, $actualizar)) {
                                        $SQL1 = "SELECT num_objetos FROM usuarios WHERE dni = '$dni'";
                                        $consulta = mysqli_query($conexionBD, $SQL1);
                                        $columna = mysqli_fetch_array($consulta, MYSQLI_ASSOC);
                                        $resultado = $columna["num_objetos"] + 1;

                                        $actualizar2 = "UPDATE usuarios SET num_objetos = '" . $resultado . "' WHERE dni = '$dni'";
                                        mysqli_query($conexionBD, $actualizar2);
                                        echo "<div class='alert alert-success' role='alert' style='width: 50%;margin: auto;margin-top: 2rem;text-align: center;'>Se le ha asignado al usuario con DNI '$dni' el material con número de serie '$num_serie'.<br><br> Su fecha máxima de entrega es: " . $fecha_maxima_formato . ".</div>";
                                    }
                                } else {
                                    echo "<div class='alert alert-danger' role='alert' style='width: 50%;margin: auto;margin-top: 2rem;text-align: center;'>El material seleccionado no se encuentra en stock.</div>";
                                }
                            } else {
                                echo "<div class='alert alert-danger' role='alert' style='width: 50%;margin: auto;margin-top: 2rem;text-align: center;'>El usuario no puede optar a más prestamos hasta que no haga alguna devolución.</div>";
                            }
                        }                         
                    }
                ?>
            </div>
        </div>
        </form>
   
           
     
        <footer class="site-footer">
            <div class="container">
              <div class="row">
                <div class="col-lg-4">
                  <h6>Dirección</h6>
                  <p class="text-justify">Calle Isabela, 1, 41013 Sevilla</p>
                </div>
       
                <div class="col-lg-4">
                  <h6>Teléfono</h6>
                  <p class="text-justify">954 23 03 73</p>
                </div>
       
                <div class="col-lg-4">
                  <h6>Correo</h6>
                  <p class="text-justify">info@fpnuevasprofesiones.es</p>
                </div>
              </div>
              <hr>
            </div>
            <div class="container">
              <div class="row">
                <div class="col-md-8 col-sm-6 col-xs-12">
                  <p class="copyright-text">Copyright &copy; 2021
                    <a href="https://fpnuevasprofesiones.es/">Nuevas Profesiones.com</a>.
                  </p>
                </div>
       
                <div class="col-md-4 col-sm-6 col-xs-12">
                  <ul class="social-icons">
                    <li><a class="facebook" href="#"><i class="fab fa-facebook"></i></a></li>
                    <li><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
                    <li><a class="dribbble" href="#"><i class="fab fa-dribbble"></i></a></li>
                    <li><a class="linkedin" href="#"><i class="fab fa-linkedin"></i></a></li>
                  </ul>
                </div>
              </div>
            </div>
        </footer>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    </body>
</html>
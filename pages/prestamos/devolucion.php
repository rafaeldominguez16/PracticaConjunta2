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
        <?php session_start(); ?>
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
            <h2 class="titulo">Préstamos | Devolución Materiales</h2>    
        </div>

        <form action="devolucion.php" method="POST">
            <div class="container">
                <div class="row">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">MATERIAL</th>
                                <th scope="col">NUM. SERIE</th>
                                <th scope="col">MARCA</th>
                                <th scope="col">MODELO</th>
                                <th scope="col">SELECCIONAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                    error_reporting(0);
                                    $conexionBD = mysqli_connect("localhost", "root", "", "bd_prestamos");

                                    $contador = 0;
                                    
                                    session_start();
                                    $dni = $_SESSION["dni"];

                                    $SQL = "SELECT fecha_prestamo, num_serie, fecha_maxima FROM prestamos WHERE dni = '$dni' AND fecha_devolucion IS NULL";
                                    $consulta = mysqli_query($conexionBD, $SQL);

                                    while ($columna = mysqli_fetch_array($consulta, MYSQLI_ASSOC)) {
                                        $contador++;

                                        $fechaPrestamo = $columna["fecha_prestamo"];
                                        $numSerie = $columna["num_serie"];
                                        $fechaMaxima = $columna["fecha_maxima"];

                                        $SQL2 = "SELECT marca, modelo, nombre_materiales FROM materiales WHERE num_serie = '$numSerie'";
                                        $consulta2 = mysqli_query($conexionBD, $SQL2);
                                        $columna2 = mysqli_fetch_array($consulta2, MYSQLI_ASSOC);

                                        $material = $columna2["nombre_materiales"];
                                        $marca = $columna2["marca"];
                                        $modelo = $columna2["modelo"];

                                        echo "<td>".strtoupper($material)."</td>";
                                        echo "<td>$numSerie</td>";
                                        echo "<td>$marca</td>";
                                        echo "<td>$modelo</td>";

                                        echo "<td><div class=\"form-check\">";
                                        echo "<input class=\"form-check-input\" type=\"checkbox\" value=\"$numSerie\" name=\"checkBox".$contador."\">";
                                        echo "</div></td></tr>";
                                    }
                                ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="container my-5">
                <div class="row">
                    <button type="submit" class="btn btn-outline-primary m-auto" name="botonDevolver">Devolución</button>
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

            <?php
                if (isset($_POST["botonDevolver"])){
                    session_start();
                    $dni = $_SESSION["dni"];

                    if(isset($_POST["checkBox1"])){
                        $numSerie1 = $_POST["checkBox1"];

                        //Miramos el número de objetos que tiene.
                            $SQL1 = "SELECT num_objetos FROM usuarios WHERE dni = '$dni'";
                            $consulta = mysqli_query($conexionBD, $SQL1);
                            $columna = mysqli_fetch_array($consulta, MYSQLI_ASSOC);

                            if ($columna["num_objetos"] != 0){
                                $resultado = $columna["num_objetos"] - 1;

                                //Si es diferente de 0, le restamos uno y actualizamos ese campo.
                                $SQL3 = "UPDATE usuarios SET num_objetos = '$resultado' WHERE dni = '$dni'";
                                mysqli_query($conexionBD, $SQL3);

                                //Introduzco la fecha de devolución al prestamo.
                                $SQL4 = "UPDATE prestamos SET fecha_devolucion = '" . date("Y/m/d") . "' WHERE prestamos.dni = '$dni' AND prestamos.num_serie = '$numSerie1'";
                                mysqli_query($conexionBD, $SQL4);

                                //Como ya ha sido entregado, pongo ese objeto en stock.
                                $SQL5 = "UPDATE materiales SET estado = 'stock' WHERE num_serie = '$numSerie1'";
                                mysqli_query($conexionBD, $SQL5);

                                //Si lo entrega y era moroso, dejará de ser moroso.
                                $SQL7 = "UPDATE usuarios SET moroso = 0 WHERE dni = '$dni'";
                                mysqli_query($conexionBD, $SQL7);          
                            } 
                    }

                    if(isset($_POST["checkBox2"])){
                        $numSerie2 = $_POST["checkBox2"];

                        //Miramos el número de objetos que tiene.
                            $SQL1 = "SELECT num_objetos FROM usuarios WHERE dni = '$dni'";
                            $consulta = mysqli_query($conexionBD, $SQL1);
                            $columna = mysqli_fetch_array($consulta, MYSQLI_ASSOC);

                            if ($columna["num_objetos"] != 0){
                                $resultado = $columna["num_objetos"] - 1;

                                //Si es diferente de 0, le restamos uno y actualizamos ese campo.
                                $SQL3 = "UPDATE usuarios SET num_objetos = '$resultado' WHERE dni = '$dni'";
                                mysqli_query($conexionBD, $SQL3);

                                //Introduzco la fecha de devolución al prestamo.
                                $SQL4 = "UPDATE prestamos SET fecha_devolucion = '" . date("Y/m/d") . "' WHERE prestamos.dni = '$dni' AND prestamos.num_serie = '$numSerie2'";
                                mysqli_query($conexionBD, $SQL4);

                                //Como ya ha sido entregado, pongo ese objeto en stock.
                                $SQL5 = "UPDATE materiales SET estado = 'stock' WHERE num_serie = '$numSerie2'";
                                mysqli_query($conexionBD, $SQL5);

                                //Si lo entrega y era moroso, dejará de ser moroso.
                                $SQL7 = "UPDATE usuarios SET moroso = 0 WHERE dni = '$dni'";
                                mysqli_query($conexionBD, $SQL7);                 
                            } 
                    }

                    if(isset($_POST["checkBox3"])){
                        $numSerie3 = $_POST["checkBox3"];

                        //Miramos el número de objetos que tiene.
                            $SQL1 = "SELECT num_objetos FROM usuarios WHERE dni = '$dni'";
                            $consulta = mysqli_query($conexionBD, $SQL1);
                            $columna = mysqli_fetch_array($consulta, MYSQLI_ASSOC);

                            if ($columna["num_objetos"] != 0){
                                $resultado = $columna["num_objetos"] - 1;

                                //Si es diferente de 0, le restamos uno y actualizamos ese campo.
                                $SQL3 = "UPDATE usuarios SET num_objetos = '$resultado' WHERE dni = '$dni'";
                                mysqli_query($conexionBD, $SQL3);

                                //Introduzco la fecha de devolución al prestamo.
                                $SQL4 = "UPDATE prestamos SET fecha_devolucion = '" . date("Y/m/d") . "' WHERE prestamos.dni = '$dni' AND prestamos.num_serie = '$numSerie3'";
                                mysqli_query($conexionBD, $SQL4);

                                //Como ya ha sido entregado, pongo ese objeto en stock.
                                $SQL5 = "UPDATE materiales SET estado = 'stock' WHERE num_serie = '$numSerie3'";
                                mysqli_query($conexionBD, $SQL5);

                                //Si lo entrega una vez pasada la fecha es moroso.
                                $SQL6 = "SELECT fecha_maxima FROM prestamos WHERE num_serie = '$numSerie3'";
                                $consulta = mysqli_query($conexionBD, $SQL6);
                                $columna = mysqli_fetch_array($consulta, MYSQLI_ASSOC);

                                $date1 = new DateTime($columna["fecha_maxima"]);
                                $date2 = new DateTime("NOW");
                                $diff = $date1->diff($date2);

                                //Si lo entrega y era moroso, dejará de ser moroso.
                                $SQL7 = "UPDATE usuarios SET moroso = 0 WHERE dni = '$dni'";
                                mysqli_query($conexionBD, $SQL7);                   
                            } 
                    }
                    
                    echo "<script>location.href='devolucion.php';</script>";
                }
            ?>
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
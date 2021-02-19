<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/principal/css.css">
        <link rel="stylesheet" href="../css/principal/estilo.css">
        <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
        <title>Nuevas Profesiones</title>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="principal.php"><img src="../img/np.png"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto ">
                        <li class="nav-item active dropdown">
                            <a class="nav-link dropdown-toggle" href="" data-toggle="dropdown">Gestión</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="gestion/gestion-materiales.php">Materiales</a>
                                <a class="dropdown-item" href="gestion/gestion-usuarios.php">Usuarios</a>
                            </div>
                        </li>

                        <li class="nav-item ml-2 active dropdown">
                            <a class="nav-link dropdown-toggle" href="" data-toggle="dropdown">Préstamos</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="prestamos/usuario-entrega.php">Entrega</a>
                                <a class="dropdown-item" href="prestamos/usuario-devolucion.php">Devolución</a>
                            </div>
                        </li>

                        <li class="nav-item ml-2 active dropdown">
                            <a class="nav-link dropdown-toggle" href="" data-toggle="dropdown">Consultas</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="consultas/prestamos.php">Prestamos</a>
                                <a class="dropdown-item" href="consultas/materiales.php">Materiales</a>
                                <a class="dropdown-item" href="consultas/usuarios.php">Usuarios</a>
                                <a class="dropdown-item" href="consultas/morosos.php">Morosos</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <h1 class="titulo">ÚLTIMOS MATERIALES PRESTADOS</h1>
            <div class="row">

            <?php  
                error_reporting(0);
                //Conexión con la BD.
                    $servername = "localhost";
                    $database = "bd_prestamos";
                    $username = "root";
                    $password = "";

                //Crear conexión
                    $conn = mysqli_connect($servername, $username, $password, $database);

                //Solicitud de datos preparada para resistir inyección SQL.
                    if ($conn) {
                        $resPrestamos = mysqli_query($conn, "SELECT * FROM prestamos ORDER BY fecha_prestamo DESC LIMIT 3");
                        $numSerie = "";

                        while ($columna = mysqli_fetch_array($resPrestamos, MYSQLI_ASSOC)) {
                            $numSerie = $columna["num_serie"];
                            $marca = "";
                            $modelo = "";
                            $resMateriales = mysqli_query($conn, "SELECT marca, modelo, ruta FROM materiales WHERE num_serie = '$numSerie'");

                            echo "<br>";

                            while ($columnaMateriales = mysqli_fetch_array($resMateriales, MYSQLI_ASSOC)) {
                                $marca = $columnaMateriales["marca"];
                                $modelo = $columnaMateriales["modelo"];
                                $ruta = $columnaMateriales["ruta"];

                                echo "<div class=\"col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 d-flex justify-content-center align-items-center\">";
                                echo "<div class=\"card\" class=\"bloqueItem\">";
                                echo "<img src=\"../$ruta\" class=\"card-img-top\" alt=\"...\">";
                                echo "<div class=\"card\" style=\"width: 18rem;\">";
                                echo "<ul class=\"list-group list-group-flush\">";
                                echo "<div class=\"row mt-3\">";
                                echo "<div class=\"col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6\">";
                                echo "<li class=\"list-group-item ttle\"><b>Nº SERIE:</b></li>";
                                echo "</div>";
                                echo "<div class=\"col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6\">";
                                echo "<li class=\"list-group-item text-right\">" . $numSerie . "</li>";
                                echo "</div>";
                                echo "</div>";
                                echo "<div class=\"row\">";
                                echo "<div class=\"col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6\">";
                                echo "<li class=\"list-group-item ttle\"><b>MARCA:</b></li>";
                                echo "</div>";
                                echo "<div class=\"col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6\">";
                                echo "<li class=\"list-group-item text-right\">" . $marca . "</li>";
                                echo "</div>";
                                echo "</div>";
                                echo "<div class=\"row\">";
                                echo "<div class=\"col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6\">";
                                echo "<li class=\"list-group-item ttle\"><b>MODELO:</b></li>";
                                echo "</div>";
                                echo "<div class=\"col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6\">";
                                echo "<li class=\"list-group-item text-right\">" . $modelo . "</li>";
                                echo "</div>";
                                echo "</div>";
                                echo "</ul>";
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                            }
                        }
                    }

                    mysqli_close($conn);
            ?>
                
            </div>
        </div>

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
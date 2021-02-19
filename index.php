<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">	
        <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
        <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
        <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
        <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
        <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">	
        <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
        <link rel="icon" type="image/png" href="img/favicon.ico"/>
        <link rel="stylesheet" type="text/css" href="css/index/util.css">
        <link rel="stylesheet" type="text/css" href="css/index/main.css">
        <title>Nuevas Profesiones</title>
    </head>

    <body>
        <div class="limiter">
            <div class="container-login100" style="background-image: url('img/edificio_logo.jpg');">
                <div class="wrap-login100">
                    <form action="index.php" method="POST" class="login100-form validate-form">
                        <span class="login100-form-logo"><img src="img/np.png" width="120px" opacity></span>
                        <span class="login100-form-title p-b-34 p-t-27">Nuevas Profesiones</span>

                        <div class="wrap-input100 validate-input" data-validate = "Enter username">
                            <input class="input100" type="text" name="username" placeholder="Usuario" id="usuario" autocomplete="off">
                            <span class="focus-input100" data-placeholder="&#xf207;"></span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate="Enter password">
                            <input class="input100" type="password" name="pass" placeholder="Contraseña" id="contraseña" autocomplete="off">
                            <span class="focus-input100" data-placeholder="&#xf191;"></span>
                        </div>

                        <div class="container-login100-form-btn p-t-10">
                            <button class="login100-form-btn" type="submit" name="submit">Acceder</button>
                        </div>

                        <div class="text-center p-t-30 ">
                            <a class="txt1" href="#">Acceso Alumnos</a>
                        </div>
                    </form>

                    <?php
                        error_reporting(0);
                        if (isset($_POST['submit'])) {
                            //Conexión con la Base de Datos.
                                $servername = "localhost";
                                $database = "bd_prestamos";
                                $username = "root";
                                $password = "";

                            //Crear conexión
                                $conn = mysqli_connect($servername, $username, $password, $database);

                            //Cogemos los datos de los inputs mediante el método POST
                                if (isset($_POST['username']) and isset($_POST['pass'])) {
                                    $usuario = $_POST['username'];
                                    $contrasenia = $_POST['pass'];
                                }

                            //Solicitud de datos preparada para resistir inyección SQL.
                                if ($stmt = mysqli_prepare($conn, "SELECT nombre_usuarios FROM usuarios WHERE nombre_usuarios = ? AND contrasenia = ?")) {
                                    mysqli_stmt_bind_param($stmt, "ss", $usuario, $contrasenia);

                                    mysqli_stmt_execute($stmt);
                                    mysqli_stmt_bind_result($stmt, $res);
                                    mysqli_stmt_fetch($stmt);

                                    if ($res != "") {
                                        header('Location: pages/principal.php');
                                    } else {
                                        echo "<div class='alert alert-danger mt-3 text-center' role='alert'>El usuario introducido <b>no existe</b>.</div>";
                                    }

                                    mysqli_stmt_close($stmt);
                                }

                                mysqli_close($conn);
                        }
                        
                        $SQL6 = "SELECT fecha_maxima FROM prestamos WHERE num_serie = '$numSerie1'";
                        $consulta = mysqli_query($conn, $SQL6);
                        $columna = mysqli_fetch_array($consulta, MYSQLI_ASSOC);

                        $date1 = new DateTime($columna["fecha_maxima"]);
                        $date2 = new DateTime("NOW");
                        $diff = $date1->diff($date2);

                        if ($diff > 0) {
                            $SQL7 = "UPDATE usuarios SET moroso = 1 WHERE dni = '$dni'";
                            mysqli_query($conexionBD, $SQL7);
                        }
?>
                </div>
            </div>
        </div>

        <div id="dropDownSelect1"></div>

        <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
        <script src="vendor/animsition/js/animsition.min.js"></script>
        <script src="vendor/bootstrap/js/popper.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="vendor/select2/select2.min.js"></script>
        <script src="vendor/daterangepicker/moment.min.js"></script>
        <script src="vendor/daterangepicker/daterangepicker.js"></script>
        <script src="vendor/countdowntime/countdowntime.js"></script>
        <script src="js/index/main.js"></script>
    </body>
</html>
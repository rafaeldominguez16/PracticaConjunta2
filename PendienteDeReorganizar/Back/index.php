<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login V3</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--===============================================================================================-->	
        <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
        <!--===============================================================================================-->	
        <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
        <!--===============================================================================================-->	
        <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="css/util.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <!--===============================================================================================-->
    </head>
    <body>

        <div class="limiter">
            <div class="container-login100" style="background-image: url('images/edificio_logo.jpg');">
                <div class="wrap-login100">
                    <form action="index.php" method="POST" class="login100-form validate-form">
                        <span class="login100-form-logo">
                            <img src="images/np.png" width="120px" opacity>
                        </span>

                        <span class="login100-form-title p-b-34 p-t-27">
                            Nuevas Profesiones
                        </span>

                        <div class="wrap-input100 validate-input" data-validate = "Enter username">
                            <input class="input100" type="text" name="username" placeholder="Usuario" id="usuario">
                            <span class="focus-input100" data-placeholder="&#xf207;"></span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate="Enter password">
                            <input class="input100" type="password" name="pass" placeholder="Contraseña" id="contrasenia">
                            <span class="focus-input100" data-placeholder="&#xf191;"></span>
                        </div>



                        <div class="container-login100-form-btn p-t-10">
                            <button name="submit" type="submit" class="login100-form-btn">
                                Acceder
                            </button>
                        </div>

                        <div class="text-center p-t-30 ">
                            <a class="txt1" href="#">
                                Acceso Alumnos
                            </a>
                        </div>
                    </form>
                    
                    <?php
                        if (isset($_POST['submit'])) {

                            //CONEXION A LA BBDD
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

                                    echo "<div class='alert alert-success' role='alert'><b>Se inició sesión correctamente</b>.</div>";
                                } else {

                                    echo "<div class='alert alert-danger' role='alert'>El usuario introducido <b>no existe</b>.</div>";
                                }

                                mysqli_stmt_close($stmt);
                            }

                            mysqli_close($conn);
                        }
                    ?>
                </div>
            </div>
        </div>

        

        <div id="dropDownSelect1"></div>

        <!--===============================================================================================-->
        <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
        <!--===============================================================================================-->
        <script src="vendor/animsition/js/animsition.min.js"></script>
        <!--===============================================================================================-->
        <script src="vendor/bootstrap/js/popper.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
        <!--===============================================================================================-->
        <script src="vendor/select2/select2.min.js"></script>
        <!--===============================================================================================-->
        <script src="vendor/daterangepicker/moment.min.js"></script>
        <script src="vendor/daterangepicker/daterangepicker.js"></script>
        <!--===============================================================================================-->
        <script src="vendor/countdowntime/countdowntime.js"></script>
        <!--===============================================================================================-->
        <script src="js/main.js"></script>

    </body>
</html>
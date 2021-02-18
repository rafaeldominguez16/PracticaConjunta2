<!DOCTYPE html>
<html lang="en">
    <?php $session_start; ?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">	
        <link rel="stylesheet" type="text/css" href="../../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../../fonts/iconic/css/material-design-iconic-font.min.css">
        <link rel="stylesheet" type="text/css" href="../../vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../../vendor/animate/animate.css">
        <link rel="stylesheet" type="text/css" href="../../vendor/css-hamburgers/hamburgers.min.css">
        <link rel="stylesheet" type="text/css" href="../../vendor/animsition/css/animsition.min.css">
        <link rel="stylesheet" type="text/css" href="../../vendor/select2/select2.min.css">	
        <link rel="stylesheet" type="text/css" href="../../vendor/daterangepicker/daterangepicker.css">
        <link rel="icon" type="image/png" href="../../img/favicon.ico"/>
        <link rel="stylesheet" type="text/css" href="../../css/index/util.css">
        <link rel="stylesheet" type="text/css" href="../../css/index/main.css">
        <title>Nuevas Profesiones</title>
    </head>

    <body>
        <form class="login100-form validate-form" action="POST" method="index.php">
            <div class="limiter">
                <div class="container-login100">
                    <div class="wrap-login100">

                        <span class="login100-form-logo"><img src="../../img/np.png" width="120px" opacity></span>
                        <span class="login100-form-title p-b-34 p-t-27">Nuevas Profesiones</span>


                        <div class="wrap-input100 validate-input" data-validate = "Enter serial number">
                            <input class="input100" type="text" name="num_serie" placeholder="Número de serie" id="num_serie" autocomplete="off">
                            <span class="focus-input100" data-placeholder="&#xf207;"></span>
                        </div>

                        <div class="container-login100-form-btn p-t-10">
                            <button class="login100-form-btn" name="acceder">
                                Acceder
                            </button>
                        </div>

                        <div class="text-center p-t-30 ">
                            <a class="txt1" href="../../#">
                                Acceso Alumnos
                            </a>
                        </div>

                    </div>
                </div>
            </div>

        </form>

        <div id="dropDownSelect1"></div>

        <script src="../../vendor/jquery/jquery-3.2.1.min.js"></script>
        <script src="../../vendor/animsition/js/animsition.min.js"></script>
        <script src="../../vendor/bootstrap/js/popper.js"></script>
        <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="../../vendor/select2/select2.min.js"></script>
        <script src="../../vendor/daterangepicker/moment.min.js"></script>
        <script src="../../vendor/daterangepicker/daterangepicker.js"></script>
        <script src="../../vendor/countdowntime/countdowntime.js"></script>
        <script src="../../js/index/main.js"></script>
    </body>
    <?php
    $conexionBD = mysqli_connect("localhost", "root", "", "bd_prestamos");
    $consulta = mysqli_query($conexionBD, "SELECT num_serie FROM materiales ");
    $columna = mysqli_fetch_array($consulta, MYSQLI_ASSOC);


    if (isset($_POST["acceder"])) {
        if ($_POST["num_serie"] == null) {
            echo "El nº de serie esta vacio";
        } elseif (in_array($_POST["num_serie"], $columna)) {
            echo "El nº de serie existe";
        } else {
            $vbledni = $_POST["dni"];
            $_SESSION["dni"] = $vbledni;
        }
    }
    ?>



</html>
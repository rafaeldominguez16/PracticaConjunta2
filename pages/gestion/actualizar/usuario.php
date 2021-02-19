<!DOCTYPE html>
<html lang="en">
    <?php $session_start; ?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">	
        <link rel="stylesheet" type="text/css" href="../../../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../../../fonts/iconic/css/material-design-iconic-font.min.css">
        <link rel="stylesheet" type="text/css" href="../../../vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../../../vendor/animate/animate.css">
        <link rel="stylesheet" type="text/css" href="../../../vendor/css-hamburgers/hamburgers.min.css">
        <link rel="stylesheet" type="text/css" href="../../../vendor/animsition/css/animsition.min.css">
        <link rel="stylesheet" type="text/css" href="../../../vendor/select2/select2.min.css">	
        <link rel="stylesheet" type="text/css" href="../../../vendor/daterangepicker/daterangepicker.css">
        <link rel="icon" type="image/png" href="../../../img/favicon.ico"/>
        <link rel="stylesheet" type="text/css" href="../../../css/index/util.css">
        <link rel="stylesheet" type="text/css" href="../../../css/index/main.css">
        <title>Nuevas Profesiones</title>
    </head>

    <body>
        <form class="login100-form validate-form" action="usuario.php" method="POST">
            <div class="limiter">
                <div class="container-login100">
                    <div class="wrap-login100">
                        <span class="login100-form-logo"><img src="../../../img/np.png" width="120px" opacity></span>
                        <span class="login100-form-title p-b-34 p-t-27">Nuevas Profesiones</span>

                        <div class="wrap-input100 validate-input" data-validate = "Enter serial number">
                            <input class="input100" type="text" name="dni" placeholder="DNI" id="dni" autocomplete="off">
                            <span class="focus-input100" data-placeholder="&#xf207;"></span>
                        </div>

                        <div class="container-login100-form-btn p-t-10">
                            <button class="login100-form-btn" name="continuar">Continuar</button>
                        </div>
                        
                        <?php
                            error_reporting(0);
                            if (isset($_POST["continuar"])){
                                $conn = mysqli_connect("localhost", "root", "", "bd_prestamos");
                                $dni = $_POST["dni"];

                                if ($resultado = mysqli_query($conn, "SELECT dni FROM usuarios WHERE dni = '$dni'")) {
                                    $numcolumnas = mysqli_num_rows($resultado);
                                }

                                if ($numcolumnas != 0){
                                    session_start();
                                    $_SESSION["dni"] = $dni;
                                    echo "<script>location.href='actualizar-usuarios.php';</script>";
                                } else {
                                    echo "<div class='alert alert-danger' role='alert' style='margin: auto;margin-top: 2rem;text-align: center;'>El usuario introducido no está registrado.</div>";
                                }

                                mysqli_close($conn);
                            }
                        ?>
                    </div>
                </div>
            </div>
        </form>
        
        <script src="../../../vendor/jquery/jquery-3.2.1.min.js"></script>
        <script src="../../../vendor/animsition/js/animsition.min.js"></script>
        <script src="../../../vendor/bootstrap/js/popper.js"></script>
        <script src="../../../vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="../../../vendor/select2/select2.min.js"></script>
        <script src="../../../vendor/daterangepicker/moment.min.js"></script>
        <script src="../../../vendor/daterangepicker/daterangepicker.js"></script>
        <script src="../../../vendor/countdowntime/countdowntime.js"></script>
        <script src="../../../js/index/main.js"></script>
    </body>
</html>
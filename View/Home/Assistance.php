<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="<?= PATH ?>/wwwroot/assets/css/cam.css">
    <title>Capturar asistencia</title>
    <?php
    include_once 'View/Shared/_Header.php';
    ?>
</head>

<body class="login-body">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-end m-4">
                <?php
                if (!isset($_SESSION["user"])) {
                ?>
                    <span id="loginBtn" class="login-title mx-4">Iniciar Sesión</span>
                    <span class="login-title">Registrarse</span>
                <?php
                } else {
                ?>
                    <span id="logout" class="login-title mx-4">Cerrar Sesión</span>
                    <span id="return" class="login-title">Regresar</span>
                <?php
                }
                ?>
            </div>
            <div class="col-12  d-flex justify-content-center">
                <h1 class="title-general">Bienvenido</h1>
            </div>
            <div class="col-12 d-flex justify-content-center" style="z-index: 1;">
                <div class="assistance-box">
                    <form action="<?= PATH ?>/Home/Assistance" method="POST" id="assistanceFrm" enctype="multipart/form-data">
                        <h2>Ingrese su código de empleado</h2>
                        <div class="form-group d-flex justify-content-center">
                            <div class="col-8">
                                <input type="text" class="form-control" placeholder="Código de Empleado" name="code" value="<?= isset($_SESSION['user']) ? $_SESSION['user']['codigoUsuario'] : '' ?>" <?= isset($_SESSION['user']) ? 'readonly' : '' ?> required>
                            </div>
                        </div>
                        <div class="col-12">
                            <!-- Camera !-->
                            <div class="container-fluid" id='camcam'>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="wrap">
                                            <div id="cont">
                                                <div id="vid" class="son">
                                                    <video id="video" style="height: 300px;"></video>
                                                </div>
                                                <div id="capture" class="son" hidden>
                                                    <canvas id="canvas"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Camera !-->
                            <input type="text" name="capture" hidden />
                        </div>
                        <div class="form-group d-flex justify-content-center">
                            <div class="col-8">
                                <input type="submit" class="btn btn-primary" value="Capturar" name="submit">
                            </div>
                        </div>
                        <p class="text-danger" style="height: 2em;"><?= isset($error_log['invalid_credentials']) ? $error_log['invalid_credentials'] : '' ?></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= PATH ?>/wwwroot/assets/js/cam.js"></script>
    <script>
        $(document).ready(function() {
            $('#loginBtn').on('click', function() {
                window.location = "<?= PATH ?>/Home/Login";
            });
            $('#logout').on('click', function() {
                window.location = "<?= PATH ?>/Home/Logout";
            });
            $('#return').on('click', function() {
                window.location = "<?= PATH ?>/Client/Index";
            });
        });
    </script>
    <?php
    if (isset($assistance_result)) {
    ?>
        <script>
            Swal.fire(
                '<?= $assistance_result ? 'Ehnorabuena!' : 'Error!' ?>',
                '<?= $assistance_result ? 'Se ha registrado su asistencia con éxito' : 'El código ingresado no existe' ?>',
                '<?= $assistance_result ? 'success' : 'warning' ?>'
            );
        </script>
    <?php
    }
    ?>
</body>

</html>
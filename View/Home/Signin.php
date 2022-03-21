<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <?php
    include_once 'View/Shared/_Header.php';
    ?>
</head>

<body class="login-body">
    <div class="container">
        <div class="row">
            <div class="col-md-3 offset-md-9">
                <div class="row m-4">
                    <div class="col-12">
                        <span id="loginBtn" class="login-title">Iniciar Sesión</span>
                    </div>
                </div>
            </div>
            <div class="col-9" style="z-index: 1;">
                <div class="signin-box">
                    <form action="<?=PATH?>/Home/Signin" method="POST">
                        <h1>Registrarse</h1>
                        <div class="form-group d-flex justify-content-center">
                            <div class="col-1 icon"><i class="fa fa-user"></i></div>
                            <div class="col-8">
                                <input type="text" class="form-control" placeholder="Código de Empleado" name="code" value="<?=isset($temp_data) ? $temp_data['code'] : ''?>" required>
                            </div>
                        </div>
                        <div class="form-group d-flex justify-content-center">
                            <div class="col-1 icon"><i class="fa fa-lock"></i></div>
                            <div class="col-8">
                                <input type="password" class="form-control" placeholder="Contraseña" name="password" required>
                            </div>
                        </div>
                        <div class="form-group d-flex justify-content-center">
                            <div class="col-1 icon"><i class="fa fa-lock"></i></div>
                            <div class="col-8">
                                <input type="password" class="form-control" placeholder="Repetir contraseña" name="passwordRepeat" required>
                            </div>
                        </div>
                        <div class="form-group d-flex justify-content-center">
                            <div class="col-8">
                                <input type="submit" class="btn btn-primary" value="Registrarse" name="submit">
                            </div>
                        </div>
                        <p class="text-danger" style="height: 2em;"><?=isset($error_log['error']) ? $error_log['error'] : '' ?></p>
                    </form>
                </div>
            </div>
            <div class="col-3">
                <img src="<?= PATH ?>/wwwroot/assets/img/login_bg.png" class="login-bg-img">
            </div>
        </div>
    </div>
    <script>
        $('#loginBtn').on('click', function () {
            window.location = "<?=PATH?>/Home/Login";
        });
    </script>
</body>

</html>
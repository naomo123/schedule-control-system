<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <?php
    include_once 'View/Shared/_Header.php';
    ?>
</head>

<body class="g-sidenav-show bg-gray-100">
    <!-- Sidebar -->
    <?php
    include_once 'View/Shared/_Sidebar.php';
    ?>
    <!-- End Sidebar -->

    <main class="main-content position-relative border-radius-lg ">
        <!-- Navbar -->
        <?php
        include_once 'View/Shared/_Navbar.php';
        ?>
        <!-- End Navbar -->

        <!-- Page Content -->
        <div class="containter-fluid py-4">
            <div class="row">
                <div class="col-12 px-5">
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h6>Lista de empleados</h6>
                            <a href="" class="badge badge-sm bg-primary createOpt">Crear nuevo</a>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-secondary text-xxs font-weight-bolder opacity-7">Código de Empleado</th>
                                            <th class="text-secondary text-xxs font-weight-bolder opacity-7">Empleado</th>
                                            <th class="text-center text-secondary text-xxs font-weight-bolder opacity-7">Puesto</th>
                                            <th class="text-center text-secondary text-xxs font-weight-bolder opacity-7">DUI</th>
                                            <th class="text-center text-secondary text-xxs font-weight-bolder opacity-7">Fecha de Nacimiento</th>
                                            <th class="text-secondary text-xxs font-weight-bolder opacity-7">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($usuarios as $usuario) {
                                            if ($usuario["idUsuario"] != $_SESSION["user"]["idUsuario"]) {
                                        ?>
                                                <tr>
                                                    <td>
                                                        <p class="text-xs font-weight-bold px-3"><?= $usuario["codigoUsuario"] ?></p>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm"><?= utf8_encode($usuario["nombre"]) . ' ' . utf8_encode($usuario["apellido"]) ?></h6>
                                                                <p class="text-xs text-secondary mb-0"><?= $usuario["email"] ?></p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <span class="badge badge-sm bg-gradient-primary"><?= $usuario["puesto"] ?></span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="text-secondary text-xs font-weight-bold"><?= $usuario["dui"] ?></span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="text-secondary text-xs font-weight-bold"><?= $usuario["fechaNacimiento"] ?></span>
                                                    </td>
                                                    <td class="align-middle">
                                                        <a href="" class="badge badge-sm bg-warning editOpt">Editar</a>
                                                        <a href="" class="badge badge-sm bg-danger deleteOpt">Eliminar</a>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Content -->


        <!-- Footer -->
        <?php
        include_once 'View/Shared/_Footer.php';
        ?>
        <!-- End Footer -->
    </main>
    <!-- Footer Scripts -->
    <?php
    include_once 'View/Shared/_FooterScripts.php';
    ?>
    <!-- End Footer Scripts -->
</body>

</html>
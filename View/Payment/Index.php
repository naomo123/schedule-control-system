<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagos</title>
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
                            <h6>Pagos realizados</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-secondary text-xxs font-weight-bolder opacity-7">ID Pago</th>
                                            <th class="text-center text-secondary text-xxs font-weight-bolder opacity-7">Fecha de pago</th>
                                            <th class="text-center text-secondary text-xxs font-weight-bolder opacity-7">Monto</th>
                                            <th class="text-center text-secondary text-xxs font-weight-bolder opacity-7">ISSS</th>
                                            <th class="text-center text-secondary text-xxs font-weight-bolder opacity-7">Renta</th>
                                            <th class="text-center text-secondary text-xxs font-weight-bolder opacity-7">Monto final</th>
                                            <th class="text-center text-secondary text-xxs font-weight-bolder opacity-7">Tipo de pago</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($pagos as $pago) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <p class="text-secondary text-xs font-weight-bold px-3 pt-3"><?= sprintf('A%05d', $pago["idPagos"]) ?></p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span class="text-secondary text-xs font-weight-bold"><?= $pago["fechaPago"] ?></span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">$ <?= $pago["monto"] ?></span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">$ <?= $pago["isss"] ?></span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">$ <?= $pago["renta"] ?></span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">$ <?= $pago["montoFinal"] ?></span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="badge badge-sm bg-default"><?= $pago["tipopago"] ?></span>
                                                </td>
                                            </tr>
                                        <?php
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
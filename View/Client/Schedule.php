<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horario</title>
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
                            <h6>Horario del día</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <tbody>
                                        <?php
                                        foreach ($horarios as $horario) {
                                            $horaInicio = new DateTime($horario["horaInicio"]);
                                        ?>
                                            <tr>
                                                <td style="border: none;" class="py-4 align-middle text-center d-flex align-items-center justify-content-center">
                                                    <i class="fa fa-clock" style="font-size: 3em;"></i>
                                                    <span style="font-size: 2em !important;" class="text-secondary text-xs font-weight-bold">&nbsp;&nbsp;<?= $horaInicio->format('h:i:s A') ?></span>
                                                </td>
                                                <td style="border: none;" class="align-middle text-center text-sm">
                                                    <span style="font-size: 2em !important;"  class="text-secondary text-xs font-weight-bold"><?= utf8_encode($horario["nombre"]) ?></span>
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
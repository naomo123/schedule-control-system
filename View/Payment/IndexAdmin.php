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
        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="Create" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Generar pago</h5>
                    </div>
                    <form id="createFrm" action="<?= PATH ?>/Payment/Create" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="col-form-label">Usuario:</label>
                                <select class="form-control" name="idUsuario">
                                    <option value="">Seleccione...</option>
                                    <?php
                                    foreach ($usuarios as $usuario) {
                                        if ($usuario['idPuesto'] != 1) {
                                    ?>
                                            <option value="<?= $usuario['idUsuario'] ?>"><?= $usuario['nombre'] . ' ' . $usuario['apellido'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <p class="text-danger"><?= isset($error_log["idUsuario_error"]) ? $error_log["idUsuario_error"] : "" ?></p>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Tipo de pago:</label>
                                        <select class="form-control" name="idTipoPago">
                                            <option value="">Seleccione...</option>
                                            <?php
                                            foreach ($tipopagos as $tipopago) {
                                            ?>
                                                <option value="<?= $tipopago['idTipoPago'] ?>"><?= $tipopago['nombre'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <p class="text-danger"><?= isset($error_log["idTipoPago_error"]) ? $error_log["idTipoPago_error"] : "" ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Fecha de pago:</label>
                                        <input type="date" class="form-control" name="fechaPago" value="<?= isset($data_temp["fechaPago"]) ? $data_temp["fechaPago"] : "" ?>">
                                        <p class="text-danger"><?= isset($error_log["fechaPago_error"]) ? $error_log["fechaPago_error"] : "" ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Monto:</label>
                                        <div class="row">
                                            <div class="col-2 d-flex align-items-center">
                                                <span style="font-weight: bold; font-size: large;">$</span>
                                            </div>
                                            <div class="col-10">
                                                <input type="number" step=".01" class="form-control" name="monto" value="<?= isset($data_temp["monto"]) ? $data_temp["monto"] : "" ?>">
                                            </div>
                                        </div>
                                        <p class="text-danger"><?= isset($error_log["monto_error"]) ? $error_log["monto_error"] : "" ?></p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">ISSS:</label>
                                        <div class="row">
                                            <div class="col-2 d-flex align-items-center">
                                                <span style="font-weight: bold; font-size: large;">$</span>
                                            </div>
                                            <div class="col-10">
                                                <input type="number" step=".01" class="form-control" name="isss" value="<?= isset($data_temp["isss"]) ? $data_temp["isss"] : "" ?>">
                                            </div>
                                        </div>
                                        <p class="text-danger"><?= isset($error_log["isss_error"]) ? $error_log["isss_error"] : "" ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Renta:</label>
                                        <div class="row">
                                            <div class="col-2 d-flex align-items-center">
                                                <span style="font-weight: bold; font-size: large;">$</span>
                                            </div>
                                            <div class="col-10">
                                                <input type="number" step=".01" class="form-control" name="renta" value="<?= isset($data_temp["renta"]) ? $data_temp["renta"] : "" ?>">
                                            </div>
                                        </div>
                                        <p class="text-danger"><?= isset($error_log["renta_error"]) ? $error_log["renta_error"] : "" ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Monto Final:</label>
                                        <div class="row">
                                            <div class="col-2 d-flex align-items-center">
                                                <span style="font-weight: bold; font-size: large;">$</span>
                                            </div>
                                            <div class="col-10">
                                                <input type="number" class="form-control" name="montoFinal" value="<?= isset($data_temp["montoFinal"]) ? $data_temp["montoFinal"] : "" ?>" readonly>
                                            </div>
                                        </div>
                                        <p class="text-danger"><?= isset($error_log["montoFinal_error"]) ? $error_log["montoFinal_error"] : "" ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" name="cancel">Cancelar</button>
                            <button type="submit" class="btn btn-primary" name="save">Pagar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="containter-fluid py-4">
            <div class="row">
                <div class="col-12 px-5">
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h6>Pagos realizados</h6>
                            <a href="#createModal" class="badge badge-sm bg-primary createOpt">Generar pago</a>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-secondary text-xxs font-weight-bolder opacity-7">ID Pago</th>
                                            <th class="text-center text-secondary text-xxs font-weight-bolder opacity-7">Empleado</th>
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
                                                    <span class="text-secondary text-xs font-weight-bold"><?= $pago["usuario"] ?></span>
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
    <script>
        var getUrl = window.location;
        var baseUrl = getUrl.protocol + "//" + getUrl.host + "<?= PATH ?>/";
        $(document).ready(function() {
            $('.createOpt').on('click', function() {
                $('#createModal').modal('show');
            });
            $('#createFrm button[name=cancel]').on('click', function() {
                $('#createModal').modal('hide');
            });
            $('#createFrm input[name=monto], #createFrm input[name=isss], #createFrm input[name=renta]').on('input', function() {
                try {
                    var monto = parseFloat($('#createFrm input[name=monto]').val());
                    var isss = parseFloat($('#createFrm input[name=isss]').val());
                    var renta = parseFloat($('#createFrm input[name=renta]').val());
                    $('#createFrm input[name=montoFinal]').val(monto - isss - renta);
                } catch (error) {

                }
            });
        });
    </script>
    <?php
    if (isset($data_temp["open_create"]) && $data_temp["open_create"]) {
    ?>
        <script>
            $(document).ready(function() {
                $('#createModal').modal('show');
            });
        </script>
    <?php
    }
    if (isset($data_temp["idUsuario"])) {
    ?>
        <script>
            $(document).ready(function() {
                $('#createFrm select[name=idUsuario]').val('<?=$data_temp["idUsuario"]?>');
            });
        </script>
    <?php
    }
    if (isset($data_temp["idTipoPago"])) {
    ?>
        <script>
            $(document).ready(function() {
                $('#createFrm select[name=idTipoPago]').val('<?=$data_temp["idTipoPago"]?>');
            });
        </script>
    <?php
    }
    ?>
    <!-- End Footer Scripts -->
</body>

</html>
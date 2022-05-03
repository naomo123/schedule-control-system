<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horarios - Administración</title>
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
                        <h5 class="modal-title">Crear horario</h5>
                    </div>
                    <form id="createFrm" action="<?= PATH ?>/Schedule/Create" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="col-form-label">Nombre de horario:</label>
                                <input type="text" class="form-control" name="nombre" value="<?= isset($data_temp["nombre"]) ? $data_temp["nombre"] : "" ?>">
                                <p class="text-danger"><?= isset($error_log["nombre_error"]) ? $error_log["nombre_error"] : "" ?></p>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Hora de inicio:</label>
                                <input type="time" class="form-control" name="horaInicio" value="<?= isset($data_temp["horaInicio"]) ? $data_temp["horaInicio"] : "" ?>">
                                <p class="text-danger"><?= isset($error_log["horaInicio_error"]) ? $error_log["horaInicio_error"] : "" ?></p>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Hora fin:</label>
                                <input type="time" class="form-control" name="horaFin" value="<?= isset($data_temp["horaFin"]) ? $data_temp["horaFin"] : "" ?>">
                                <p class="text-danger"><?= isset($error_log["horaFin_error"]) ? $error_log["horaFin_error"] : "" ?></p>
                            </div>
                            <div id="multipleDiv" class="form-group">
                                <label class="col-form-label">Días:</label>
                                <div class="row">
                                    <div class="col-12">
                                        <select style="width: 100%;" class="form-control" name="days[]" multiple=multiple>
                                            <option value="1">Lunes</option>
                                            <option value="2">Martes</option>
                                            <option value="3">Miércoles</option>
                                            <option value="4">Jueves</option>
                                            <option value="5">Viernes</option>
                                            <option value="6">Sábado</option>
                                            <option value="7">Domingo</option>
                                        </select>
                                    </div>
                                </div>
                                <p class="text-danger"><?= isset($error_log["days_error"]) ? $error_log["days_error"] : "" ?></p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" name="cancel">Cancelar</button>
                            <button type="submit" class="btn btn-primary" name="save">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="Edit" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Horario</h5>
                    </div>
                    <form id="editFrm" action="<?= PATH ?>/Schedule/Edit<?= isset($data_temp[0]["idHorario"]) ? "/" . $data_temp[0]["idHorario"] : "" ?>" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="col-form-label">Nombre de horario:</label>
                                <input type="text" class="form-control" name="nombre" value="<?= isset($data_temp[0]["nombre"]) ? $data_temp[0]["nombre"] : "" ?>">
                                <p class="text-danger"><?= isset($error_log["nombre_error"]) ? $error_log["nombre_error"] : "" ?></p>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Hora de inicio:</label>
                                <input type="time" class="form-control" name="horaInicio" value="<?= isset($data_temp[0]["horaInicio"]) ? $data_temp[0]["horaInicio"] : "" ?>">
                                <p class="text-danger"><?= isset($error_log["horaInicio_error"]) ? $error_log["horaInicio_error"] : "" ?></p>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Hora fin:</label>
                                <input type="time" class="form-control" name="horaFin" value="<?= isset($data_temp[0]["horaFinal"]) ? $data_temp[0]["horaFinal"] : "" ?>">
                                <p class="text-danger"><?= isset($error_log["horaFin_error"]) ? $error_log["horaFin_error"] : "" ?></p>
                            </div>
                            <div id="multipleDiv2" class="form-group">
                                <label class="col-form-label">Días:</label>
                                <div class="row">
                                    <div class="col-12">
                                        <select style="width: 100%;" class="form-control" name="days[]" multiple=multiple>
                                            <option value="1">Lunes</option>
                                            <option value="2">Martes</option>
                                            <option value="3">Miércoles</option>
                                            <option value="4">Jueves</option>
                                            <option value="5">Viernes</option>
                                            <option value="6">Sábado</option>
                                            <option value="7">Domingo</option>
                                        </select>
                                    </div>
                                </div>
                                <p class="text-danger"><?= isset($error_log["days_error"]) ? $error_log["days_error"] : "" ?></p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" name="cancel">Cancelar</button>
                            <button type="submit" class="btn btn-primary" name="save">Guardar</button>
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
                            <h6>Lista de horarios</h6>
                            <a href="#createModal" class="badge badge-sm bg-primary createOpt">Crear nuevo</a>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-secondary text-xxs font-weight-bolder opacity-7">Nombre</th>
                                            <th class="text-secondary text-xxs font-weight-bolder opacity-7">Días</th>
                                            <th class="text-secondary text-xxs font-weight-bolder opacity-7">Hora Inicio</th>
                                            <th class="text-secondary text-xxs font-weight-bolder opacity-7">Hora Fin</th>
                                            <th class="text-secondary text-xxs font-weight-bolder opacity-7">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($horarios as $horario) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <p class="text-xs font-weight-bold px-3"><?= $horario["nombre"] ?></p>
                                                </td>
                                                <td>
                                                    <?php
                                                    $daysC = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'];
                                                    $days = explode(",", $horario["dia"]);
                                                    $daysS = "";
                                                    foreach ($days as $day) {
                                                        $daysS .= $daysC[$day - 1] . ", ";
                                                    }
                                                    $daysS = substr($daysS, 0, strlen($daysS) - 2)
                                                    ?>
                                                    <p class="mb-0 text-sm"><?= $daysS ?></p>
                                                </td>
                                                <td>
                                                    <p class="mb-0 text-sm"><?= $horario["horaInicio"] ?></p>
                                                </td>
                                                <td>
                                                    <p class="mb-0 text-sm"><?= $horario["horaFinal"] ?></p>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="<?= PATH ?>/Schedule/Edit/<?= $horario["idHorario"] ?>" class="badge badge-sm bg-warning editOpt">Editar</a>
                                                    <span data-id="<?= $horario["idHorario"] ?>" href="" style="cursor: pointer;" class="badge badge-sm bg-danger deleteOpt">Eliminar</span>
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
            $('#createFrm select').select2({
                dropDownParent: $('#multipleDiv'),
                placeholder: 'Seleccione...'
            });
            $('#editFrm select').select2({
                dropDownParent: $('#multipleDiv2'),
                placeholder: 'Seleccione...'
            });
            $('.createOpt').on('click', function() {
                $('#createModal').modal('show');
            });
            $('#createFrm button[name=cancel]').on('click', function() {
                $('#createModal').modal('hide');
            });
            $('.deleteOpt').on('click', function() {
                Swal.fire({
                    title: 'Seguro que quieres eliminar este registro?',
                    showDenyButton: true,
                    confirmButtonText: 'Sí',
                    denyButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = baseUrl + "Schedule/Delete/" + $(this).attr('data-id');
                    }
                })
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
    if (isset($data_temp["open_edit"]) && $data_temp["open_edit"]) {
    ?>
        <script>
            $(document).ready(function() {
                $('#editModal').modal('show');
            });
        </script>
    <?php
    }
    if (isset($data_temp["days"])) {
    ?>
        <script>
            var days = '<?=implode(',', $data_temp["days"])?>';
            days = days.split(',');
            $('#createFrm select').val(days);
        </script>
    <?php
    }
    if (isset($data_temp[0]["dia"])) {
    ?>
        <script>
            var days = '<?=$data_temp[0]["dia"]?>';
            days = days.split(',');
            $('#editFrm select').val(days);
        </script>
    <?php
    }
    ?>
    <!-- End Footer Scripts -->
</body>

</html>
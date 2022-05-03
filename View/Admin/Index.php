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
        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="Create" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Crear Usuario</h5>
                    </div>
                    <form id="createFrm" action="<?= PATH ?>/Admin/Create" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="col-form-label">ID empleado:</label>
                                <input type="text" class="form-control" name="id" value="<?= isset($data_temp["id"]) ? $data_temp["id"] : "" ?>">
                                <p class="text-danger"><?= isset($error_log["id_error"]) ? $error_log["id_error"] : "" ?></p>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Nombre:</label>
                                <input type="text" class="form-control" name="name" value="<?= isset($data_temp["name"]) ? $data_temp["name"] : "" ?>">
                                <p class="text-danger"><?= isset($error_log["name_error"]) ? $error_log["name_error"] : "" ?></p>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Apellido:</label>
                                <input type="text" class="form-control" name="lastName" value="<?= isset($data_temp["lastName"]) ? $data_temp["lastName"] : "" ?>">
                                <p class="text-danger"><?= isset($error_log["lastName_error"]) ? $error_log["lastName_error"] : "" ?></p>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Fecha de nacimiento:</label>
                                <input type="date" class="form-control" name="birthdate" value="<?= isset($data_temp["birthdate"]) ? $data_temp["birthdate"] : "" ?>">
                                <p class="text-danger"><?= isset($error_log["birthdate_error"]) ? $error_log["birthdate_error"] : "" ?></p>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Email:</label>
                                <input type="email" class="form-control" name="email" value="<?= isset($data_temp["email"]) ? $data_temp["email"] : "" ?>">
                                <p class="text-danger"><?= isset($error_log["email_error"]) ? $error_log["email_error"] : "" ?></p>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Telefono:</label>
                                <input type="text" class="form-control" name="telephone" value="<?= isset($data_temp["telephone"]) ? $data_temp["telephone"] : "" ?>">
                                <p class="text-danger"><?= isset($error_log["telephone_error"]) ? $error_log["telephone_error"] : "" ?></p>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">DUI:</label>
                                <input type="text" class="form-control" name="dui" value="<?= isset($data_temp["dui"]) ? $data_temp["dui"] : "" ?>">
                                <p class="text-danger"><?= isset($error_log["dui_error"]) ? $error_log["dui_error"] : "" ?></p>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Pago por hora ($):</label>
                                <input type="number" step=".01" class="form-control" name="extraHours" value="<?= isset($data_temp["extraHours"]) ? $data_temp["extraHours"] : "" ?>">
                                <p class="text-danger"><?= isset($error_log["extraHours_error"]) ? $error_log["extraHours_error"] : "" ?></p>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Puesto:</label>
                                <select class="form-control" name="positionId">
                                    <option value="">Seleccionar...</option>
                                </select>
                                <p class="text-danger"><?= isset($error_log["positionId_error"]) ? $error_log["positionId_error"] : "" ?></p>
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
                        <h5 class="modal-title">Editar Usuario</h5>
                    </div>
                    <form id="editFrm" action="<?= PATH ?>/Admin/Edit<?= isset($data_temp[0]["idUsuario"]) ? "/" . $data_temp[0]["idUsuario"] : "" ?>" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="col-form-label">ID empleado:</label>
                                <input type="text" class="form-control" name="id" value="<?= isset($data_temp[0]["codigoUsuario"]) ? $data_temp[0]["codigoUsuario"] : "" ?>" readonly>
                                <p class="text-danger"><?= isset($error_log["id_error"]) ? $error_log["id_error"] : "" ?></p>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Nombre:</label>
                                <input type="text" class="form-control" name="name" value="<?= isset($data_temp[0]["nombre"]) ? $data_temp[0]["nombre"] : "" ?>">
                                <p class="text-danger"><?= isset($error_log["name_error"]) ? $error_log["name_error"] : "" ?></p>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Apellido:</label>
                                <input type="text" class="form-control" name="lastName" value="<?= isset($data_temp[0]["apellido"]) ? $data_temp[0]["apellido"] : "" ?>">
                                <p class="text-danger"><?= isset($error_log["lastName_error"]) ? $error_log["lastName_error"] : "" ?></p>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Fecha de nacimiento:</label>
                                <input type="date" class="form-control" name="birthdate" value="<?= isset($data_temp[0]["fechaNacimiento"]) ? date("Y-m-d", strtotime($data_temp[0]["fechaNacimiento"])) : "" ?>">
                                <p class="text-danger"><?= isset($error_log["birthdate_error"]) ? $error_log["birthdate_error"] : "" ?></p>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Email:</label>
                                <input type="email" class="form-control" name="email" value="<?= isset($data_temp[0]["email"]) ? $data_temp[0]["email"] : "" ?>" readonly>
                                <p class="text-danger"><?= isset($error_log["email_error"]) ? $error_log["email_error"] : "" ?></p>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Telefono:</label>
                                <input type="text" class="form-control" name="telephone" value="<?= isset($data_temp[0]["telefono"]) ? $data_temp[0]["telefono"] : "" ?>">
                                <p class="text-danger"><?= isset($error_log["telephone_error"]) ? $error_log["telephone_error"] : "" ?></p>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">DUI:</label>
                                <input type="text" class="form-control" name="dui" value="<?= isset($data_temp[0]["dui"]) ? $data_temp[0]["dui"] : "" ?>">
                                <p class="text-danger"><?= isset($error_log["dui_error"]) ? $error_log["dui_error"] : "" ?></p>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Pago por hora ($):</label>
                                <input type="number" step=".01" class="form-control" name="extraHours" value="<?= isset($data_temp[0]["pagoHoras"]) ? $data_temp[0]["pagoHoras"] : "" ?>">
                                <p class="text-danger"><?= isset($error_log["extraHours_error"]) ? $error_log["extraHours_error"] : "" ?></p>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Puesto:</label>
                                <select class="form-control" name="positionId">
                                    <option value="">Seleccionar...</option>
                                </select>
                                <p class="text-danger"><?= isset($error_log["positionId_error"]) ? $error_log["positionId_error"] : "" ?></p>
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
                            <h6>Lista de empleados</h6>
                            <a href="#createModal" class="badge badge-sm bg-primary createOpt">Crear nuevo</a>
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
                                                        <span class="text-secondary text-xs font-weight-bold"><?= date("d/m/Y", strtotime($usuario["fechaNacimiento"])) ?></span>
                                                    </td>
                                                    <td class="align-middle">
                                                        <a href="<?= PATH ?>/Admin/Edit/<?= $usuario["idUsuario"] ?>" class="badge badge-sm bg-warning editOpt">Editar</a>
                                                        <span data-id="<?= $usuario["codigoUsuario"] ?>" href="" style="cursor: pointer;" class="badge badge-sm bg-danger deleteOpt">Eliminar</span>
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
    <script>
        var getUrl = window.location;
        var baseUrl = getUrl.protocol + "//" + getUrl.host + "<?= PATH ?>/";
        var selectedPosition1 = '';
        var selectedPosition2 = '';
        $(document).ready(function() {
            $.ajax({
                url: baseUrl + "Position/Get",
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    response.forEach(function(position) {
                        $('select[name=positionId]').append('<option value="' + position.idPuesto + '">' + position.nombre + '</option>');
                    });
                    $('#createFrm select[name=positionId]').val(selectedPosition1);
                    $('#editFrm select[name=positionId]').val(selectedPosition2);
                }
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
                        window.location.href = baseUrl + "Admin/Delete/" + $(this).attr('data-id');
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
    if (isset($data_temp["positionId"])) {
    ?>
        <script>
            selectedPosition1 = '<?= $data_temp["positionId"] ?>';
        </script>
    <?php
    }
    if (isset($data_temp[0]["idPuesto"])) {
    ?>
        <script>
            selectedPosition2 = '<?= $data_temp[0]["idPuesto"] ?>';
        </script>
    <?php
    }
    ?>
    <!-- End Footer Scripts -->
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puestos - Administración</title>
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
                        <h5 class="modal-title">Crear puesto</h5>
                    </div>
                    <form id="createFrm" action="<?= PATH ?>/Position/Create" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="col-form-label">Nombre del puesto:</label>
                                <input type="text" class="form-control" name="nombre" value="<?= isset($data_temp["nombre"]) ? $data_temp["nombre"] : "" ?>">
                                <p class="text-danger"><?= isset($error_log["nombre_error"]) ? $error_log["nombre_error"] : "" ?></p>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Descripcion:</label>                                
                                <textarea type="time" class="form-control" name="descripcion"><?= isset($data_temp["descripcion"]) ? $data_temp["descripcion"] : "" ?></textarea>
                                <p class="text-danger"><?= isset($error_log["descripcion_error"]) ? $error_log["descripcion_error"] : "" ?></p>
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
                        <h5 class="modal-title">Editar puesto</h5>
                    </div>
                    <form id="editFrm" action="<?= PATH ?>/Position/Edit<?= isset($data_temp[0]["idPuesto"]) ? "/" . $data_temp[0]["idPuesto"] : "" ?>" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="col-form-label">Nombre del puesto:</label>
                                <input type="text" class="form-control" name="nombre" value="<?= isset($data_temp[0]["nombre"]) ? $data_temp[0]["nombre"] : "" ?>">
                                <p class="text-danger"><?= isset($error_log["nombre_error"]) ? $error_log["nombre_error"] : "" ?></p>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Descripcion:</label>
                                <textarea type="time" class="form-control" name="descripcion"><?= isset($data_temp[0]["descripcion"]) ? $data_temp[0]["descripcion"] : "" ?></textarea>
                                <p class="text-danger"><?= isset($error_log["descripcion_error"]) ? $error_log["descripcion_error"] : "" ?></p>
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
                            <h6>Lista de puestos</h6>
                            <a href="#createModal" class="badge badge-sm bg-primary createOpt">Crear nuevo</a>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-secondary text-xxs font-weight-bolder opacity-7">Nombre</th>
                                            <th class="text-secondary text-xxs font-weight-bolder opacity-7">Descripción</th>
                                            <th class="text-secondary text-xxs font-weight-bolder opacity-7">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($puestos as $puesto) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <p class="text-xs font-weight-bold px-3"><?= $puesto["nombre"] ?></p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold px-3"><?= $puesto["descripcion"] ?></p>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="<?= PATH ?>/Position/Edit/<?= $puesto["idPuesto"] ?>" class="badge badge-sm bg-warning editOpt">Editar</a>
                                                    <span data-id="<?= $puesto["idPuesto"] ?>" href="" style="cursor: pointer;" class="badge badge-sm bg-danger deleteOpt">Eliminar</span>
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
            $('.deleteOpt').on('click', function() {
                Swal.fire({
                    title: 'Seguro que quieres eliminar este registro?',
                    showDenyButton: true,
                    confirmButtonText: 'Sí',
                    denyButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = baseUrl + "Position/Delete/" + $(this).attr('data-id');
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
    ?>
    <!-- End Footer Scripts -->
</body>

</html>
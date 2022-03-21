<?php
function isSelected($controller, $action)
{
    $cssClass = '';
    $router = new Routing();
    if ($controller == str_replace('Controller', '', $router->controller) && $action == $router->method)
        $cssClass = "active";
    return $cssClass;
}
?>
<div class="min-height-300 bg-primary position-absolute w-100"></div>
<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="">
            <span class="ms-1 font-weight-bold"><?= utf8_encode($_SESSION["user"]["nombre"] . ' ' . $_SESSION["user"]["apellido"]) ?></span>
            <br><small class="ms-1"><?= utf8_encode($_SESSION["user"]["puesto"]) ?></small>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <?php
            if ($_SESSION["user"]["idPuesto"] == 1) {
            ?>
                <li class="nav-item">
                    <a class="nav-link <?=isSelected('Admin','Index')?>" href="<?= PATH ?>/Admin/Index">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-users text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Empleados</span>
                    </a>
                </li>
            <?php
            } else {
            ?>
                <li class="nav-item">
                    <a class="nav-link <?=isSelected('Client','Index')?>" href="<?= PATH ?>/Client/Index">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-clipboard text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Actividades</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=isSelected('Assistance','Index')?>" href="<?= PATH ?>/Assistance/Index">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-pen-nib text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Asistencias</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=isSelected('Payment','Index')?>" href="<?= PATH ?>/Payment/Index">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-file-invoice-dollar text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Pagos</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=isSelected('Client','Schedule')?>" href="<?= PATH ?>/Client/Schedule">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-calendar-week text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Horario</span>
                    </a>
                </li>
            <?php
            }
            ?>
        </ul>
    </div>
    <?php
    if ($_SESSION["user"]["idPuesto"] != 1) {
    ?>
        <div class="sidenav-footer mx-3 d-flex align-items-end" style="height: 30%;">
            <a href="<?= PATH ?>/Home/Assistance" class="btn btn-dark btn-sm w-100 mb-3">Registrar Asistencia</a>
        </div>
    <?php
    }
    ?>
</aside>
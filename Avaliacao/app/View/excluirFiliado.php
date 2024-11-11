<?php
require_once __DIR__ . "/../../Config/MoobiDataBase.php";
require_once __DIR__ . "/../Controller/FiliadoController.php";

$filiadoController = new FiliadoController();
$filiadoController->delete($_POST['id']);

require_once __DIR__ . "/../View/ListaFiliados.php";
exit();


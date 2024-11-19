<?php
require_once __DIR__ . '/Config/Rota.php';

$aDados = array_merge($_POST, $_GET);
Rota::rotear($aDados);
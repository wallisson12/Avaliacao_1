<?php
require_once __DIR__ . "/../../Config/Session_Handler.php";
abstract class ControllerAbstract
{
    public function __construct()
    {
        if(!Session_Handler::existirSessao('usuario'))
        {
            $this->indexLogin();
            exit();
        }

    }

    private function indexLogin(array $aDados = null)
    {
        require_once __DIR__ . "/../View/LoginUsuario.php";
    }
}
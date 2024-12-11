<?php

/**
 * Class ${LoginUsuarioController}
 * @version 1.0.0 Versionamento inicial da classe
 */
class LoginUsuarioController
{
	/**
	 * Responsável por realizar o redirecionamento para a pagina de login
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function index() : void
    {
        require_once __DIR__ . "/../View/LoginUsuario.php";
    }
}
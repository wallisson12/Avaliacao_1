<?php
require_once __DIR__ . "/../../Config/Session_Handler.php";

/**
 * Class ${ControllerAbstract}
 * @version 1.0.0 Versionamento inicial da classe
 */
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

	/**
	 * Responsável por realizar o redirecionamento para a pagina de login
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param array|null $aDados Array merge do post e get
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 *
	 */
    private function indexLogin(array $aDados = null) : void
    {
        require_once __DIR__ . "/../View/LoginUsuario.php";
    }
}
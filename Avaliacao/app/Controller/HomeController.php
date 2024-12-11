<?php

/**
 * Class ${HomeController}
 * @version 1.0.0 Versionamento inicial da classe
 */
class HomeController
{

	/**
	 * Responsável por realizar o redirecionamento para a pagina home
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param array|null $aDados Array merge do post e get
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 *
	 */
    public function index(array $aDados = null) : void
    {
        require_once __DIR__ . "/../View/Home.php";
    }

}
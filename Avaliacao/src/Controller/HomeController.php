<?php
namespace Moobi\Avaliacao\Controller;

/**
 * Class HomeController
 * @package Moobi\Avaliacao\Controller
 * @version 1.0.0 Versionamento inicial da classe
 */
class HomeController {
	
	/**
	 * Responsável por realizar o redirecionamento para a pagina home
	 *
	 * @param array|null $aDados Array merge do post e get
	 * @return void
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 *
	 */
	public function index(array $aDados = null): void {
		require_once __DIR__ . "/../View/Home.php";
	}

}
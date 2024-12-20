<?php
namespace Moobi\Avaliacao\Controller;

/**
 * Class LoginUsuarioController
 * @package Moobi\Avaliacao\Controller
 * @version 1.0.0 Versionamento inicial da classe
 */
class LoginUsuarioController {

	/**
	 * Responsável por realizar o redirecionamento para a pagina de login
	 *
	 * @return void
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	public function index(): void {
		require_once __DIR__ . "/../View/Usuario/LoginUsuario.php";
	}
}
<?php
namespace Moobi\Avaliacao\Controller;
use Moobi\Avaliacao\Config\Session_Handler;

/**
 * Class ${ControllerAbstract}
 * @package ${Moobi\Avaliacao\Controller}
 * @version 1.0.0 Versionamento inicial da classe
 */
abstract class ControllerAbstract {
	public function __construct() {
		if (!Session_Handler::existirSessao('usuario')) {
			$this->indexLogin();
			exit();
		}
	}

	/**
	 * Responsável por realizar o redirecionamento para a pagina de login
	 *
	 * @param array|null $aDados Array merge do post e get
	 * @return void
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 *
	 */
	private function indexLogin(array $aDados = null): void {
		require_once __DIR__ . "/../View/Usuario/LoginUsuario.php";
	}
}
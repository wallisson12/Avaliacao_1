<?php
namespace Moobi\Avaliacao\Config;
require_once __DIR__ . "/../../vendor/autoload.php";
use Moobi\Avaliacao\Controller\HomeController;

/**
 * Class Rota
 * @package Moobi\Avaliacao\Config
 * @version 1.0.0 Versionamento inicial da classe
 */
class Rota {

	/**
		* Separa o que vem da url em controller e metodo e faz o redirecionamento
		*
		* Faz a leitura do que esta na url do htaccess e separa em controller e metodo
		* Caso o que for digitado nao exista, vai carregar uma pagina padrao do sistema
		*
		* @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
		*
		* @param array $aDados merge do post e get
		* @return void
		*
		* @since 1.0.0 - Definição do versionamento da função
		*
	*/
	public static function rotear(array $aDados): void {
		$aUrl = strip_tags(filter_input(INPUT_GET, 'url', FILTER_DEFAULT));

		$sVerificacao = (!empty($aUrl)) ? $aUrl : 'home/index';

		$aUrl = array_filter(explode('/', $sVerificacao));

		$sControllerClass = "Moobi\\Avaliacao\\Controller\\" . ucfirst($aUrl[0]) . 'Controller';

		$sMetodo = $aUrl[1];

		if (class_exists($sControllerClass) && method_exists($sControllerClass, $sMetodo)) {
			$oController = new $sControllerClass();
			$oController->$sMetodo($aDados);
		} else {
			$oController = new HomeController();
			$oController->index($aDados);
		}

	}

}



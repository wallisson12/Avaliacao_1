<?php
namespace Moobi\Avaliacao\Config;
require_once __DIR__ . "/../../vendor/autoload.php";
use Moobi\Avaliacao\Controller\HomeController;

/**
 * Class Rota
 * @package ${Moobi\Avaliacao\Config}
 * @version 1.0.0 Versionamento inicial da classe
 */
class Rota {
	/*
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

		$controllerClass = "Moobi\\Avaliacao\\Controller\\" . ucfirst($aUrl[0]) . 'Controller';

		$metodo = $aUrl[1];

		var_dump($controllerClass,$metodo);

		if (class_exists($controllerClass) && method_exists($controllerClass, $metodo)) {
			var_dump('aq');
			$controller = new $controllerClass();
			$controller->$metodo($aDados);
		} else {
			var_dump('la');
			$controller = new HomeController();
			$controller->index($aDados);
		}

	}

}



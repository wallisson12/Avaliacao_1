<?php
namespace Moobi\Avaliacao\Config;

/*
 * Class DataBaseConfig
 * @package Moobi\Avaliacao\Config
 * @version 1.0.0 Versionamento inicial da classe
 */
abstract class DataBaseConfig {
	
	private array $aConfiguracao;

	public function __construct() {
		$this->aConfiguracao = json_decode(file_get_contents(__DIR__ . "/../Config/ConfiguracaoBanco.json"), true);
	}

	/*
	* Retorna a configuracão do banco no arquivo json
	*
	* Retorna em array as informacoes escritas no arquivo json
	*
	* @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	*
	* @return array
	*
	* @since 1.0.0 - Definição do versionamento da função
	*
	*/
	public function getConfiguracao(): array {
		return $this->aConfiguracao['dataBase'];
	}


}


<?php
namespace Moobi\Avaliacao\Config;
use Moobi\Avaliacao\Config\DataBaseConfig;
use PDO;
use PDOException;

/**
 * Class ${MoobiDataBase}
 * @package ${Moobi\Avaliacao\Config}
 * @version 1.0.0 Versionamento inicial da classe
 */
class MoobiDataBase extends DataBaseConfig {
	public PDO $oPdo;

	public function __construct() {
		parent::__construct();
		$aConfig = $this->getConfiguracao();

		$this->oPdo = new PDO("mysql:host={$aConfig['Host']};port={$aConfig['Porta']};dbname={$aConfig['Banco']}", $aConfig['Usuario'], $aConfig['Senha']);
	}

	/**
	 * Responsavel por realizar consultas no banco de dados
	 * No array passar os valores dos paramentos da query que esta sendo realizada
	 * Percorrer o arry e colocar em cada '?' no sql o valor que esta no array
	 * Na parte de +1 esse mais 1, é so para o bindvalue, mas o valor do array ja esta sendo passado na posicao certa
	 *
	 * @param string $sSql query sql
	 * @param array $aParams array onde pode ou nao ter parametros do sql
	 * @return array
	 * @author Wallisson De Jesus wallissondejesus@moobi.com.br
	 *
	 */
	public function query(string $sSql, array $aParams = []): array {
		try {
			$PDOStatement = $this->oPdo->prepare($sSql);

			if (!empty($aParams)) {
				foreach ($aParams as $sKey => $sValue) {
					$PDOStatement->bindValue($sKey + 1, $sValue, is_int($sValue) ? PDO::PARAM_INT : PDO::PARAM_STR);
				}
			}

			$PDOStatement->execute();
			return $PDOStatement->fetchAll(PDO::FETCH_ASSOC);

		} catch (PDOException $e) {
			echo $e->getMessage();
			return [];
		}

	}

	/**
	 * Responsavel por inserir e atualizar
	 * No array passar os valores dos paramentos da query que esta sendo realizada
	 * Percorrer o arry e colocar em cada '?' no sql o valor que esta no array
	 * Na parte de +1 esse mais 1, eh so para o bindvalue, mas o valor do araay ja esta sendo passado na posicao certa
	 *
	 * @param string $sSql query sql
	 * @param array $aParams array onde pode ou nao ter parametros do sql
	 * @return void
	 * @author Wallisson De Jesus wallissondejesus@moobi.com.br
	 *
	 */
	public function execute(string $sSql, array $aParams = []): void {
		try {
			$PDOStatement = $this->oPdo->prepare($sSql);

			if (!empty($aParams)) {
				foreach ($aParams as $sKey => $sValue) {
					$PDOStatement->bindValue($sKey + 1, $sValue);
				}
			}

			$PDOStatement->execute();

		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
}


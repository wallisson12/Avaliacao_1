<?php
namespace Moobi\Avaliacao\Services\Dependente;
use Moobi\Avaliacao\Model\Filiado\FiliadoDAO;

/**
 * Class ${DependenteService}
 * @package ${Moobi\Avaliacao\Services\Dependente}
 * @version 1.0.0 Versionamento inicial da classe
 */
class DependenteService {

	/**
	 * Responsável por atualizar a data de atualizacao do filiado
	 *
	 * Vai ser chamada toda vez que o dependente que possuir um filiado for alterado
	 *
	 * @param int $iIdFiliado Id do filiado que vai ser alterado
	 * @param FiliadoDAO $oFiliadoDao Objeto dao do filiado para poder atualizar
	 * @return void
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	public static function atualizaDataAtualizacaoFiliado(int $iIdFiliado,FiliadoDAO $oFiliadoDao) : void {
		$oFiliadoDao->updateDataAtualizacao($iIdFiliado);
	}

}
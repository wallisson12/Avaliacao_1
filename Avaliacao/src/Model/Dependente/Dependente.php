<?php
namespace Moobi\Avaliacao\Model\Dependente;
use Moobi\Avaliacao\Model\Dependente\GrauParentesco;
use DateTime;

/**
 * Class Dependente
 * @package Moobi\Avaliacao\Model\Dependente
 * @version 1.0.0 Versionamento inicial da classe
 */
class Dependente {

	private int $iIdDependente;
	private int $iIdFiliado;
	private string $sNome;
	private DateTime $oDataNascimento;
	private ?GrauParentesco $oGrauParentesco;

	public function __construct(int $iIdDependente, int $iIdFiliado, string $sNome, string $sDataNascimento,
	                            string $sGrauParentesco) {
		$this->iIdDependente = $iIdDependente;
		$this->iIdFiliado = $iIdFiliado;
		$this->sNome = $sNome;
		$this->oDataNascimento = DateTime::createFromFormat('Y-m-d', $sDataNascimento);
		$this->oGrauParentesco = $this->verificarGrauParentesco($sGrauParentesco);
	}

	/**
	 * Responsável por criar o objeto dependente
	 *
	 * Pega os dados para criar o objeto atraves do array merge
	 * do post e get
	 *
	 * @param array $aDados Array merge do post e get
	 * @return Dependente
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	public static function formarObjetoDependente(array $aDados): Dependente {
		return new Dependente
		(
			$aDados['dpe_id'],
			$aDados['flo_id'],
			$aDados['dpe_nome'],
			$aDados['dpe_data_de_nascimento'],
			$aDados['dpe_grau_de_parentesco']
		);
	}

	/**
	 * Responsável por retornar o id do dependente
	 *
	 * @return int
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	public function getIdDependente(): int {
		return $this->iIdDependente;
	}

	/**
	 * Responsável por retornar o id do filiado
	 *
	 * @return int
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	public function getIdFiliado(): int {
		return $this->iIdFiliado;
	}

	/**
	 * Responsável por retornar o nome do dependente
	 *
	 * @return string
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	public function getNome(): string {
		return $this->sNome;
	}

	/**
	 * Responsável por retornar a data de nascimento do dependente
	 *
	 * @return string
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	public function getDataNascimento(): string {
		return $this->oDataNascimento->format('d/m/Y');
	}

	/**
	 * Responsável por retornar o grau de parentesco do dependente
	 *
	 * @return string
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	public function getGrauParentesco(): string {
		return $this->oGrauParentesco->value;
	}

	/**
	 * Responsável por verificar o grau de parentesco do dependente
	 *
	 * Caso nao for nenhum dos casos, ele lanca uma excecao
	 *
	 * @param string $sGrauParentesco Grau de parentenco para ser validado
	 * @return GrauParentesco|null
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	private function verificarGrauParentesco(string $sGrauParentesco): ?GrauParentesco {
		switch ($sGrauParentesco) {
			case 'Conjuge':
				return GrauParentesco::Conjuge;

			case 'Filho':
				return GrauParentesco::Filho;

			case 'Pai':
				return GrauParentesco::Pai;

			case 'Mae':
				return GrauParentesco::Mae;

			default:
				return null;
		}
	}

}
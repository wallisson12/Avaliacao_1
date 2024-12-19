<?php
namespace Moobi\Avaliacao\Model\Dependente;
use Moobi\Avaliacao\Model\Dependente\Grau_Parentesco;
use DateTime;

/**
 * Class ${Dependente}
 * @package ${Moobi\Avaliacao\Model\Dependente}
 * @version 1.0.0 Versionamento inicial da classe
 */
class Dependente {
	private int $iIdDependente;
	private int $iIdFiliado;
	private string $sNome;
	private DateTime $oDataNascimento;
	private ?Grau_Parentesco $oGrauParentesco;

	public function __construct(int $iIdDependente, int $iIdFiliado, string $sNome, string $sDataNascimento,
	                            string $sGrauParentesco) {
		$this->iIdDependente = $iIdDependente;
		$this->iIdFiliado = $iIdFiliado;
		$this->sNome = $sNome;
		$this->oDataNascimento = $this->dataNascimentoFormatada($sDataNascimento);
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
	 * @return Grau_Parentesco|null
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	private function verificarGrauParentesco(string $sGrauParentesco): ?Grau_Parentesco {
		switch ($sGrauParentesco) {
			case 'Conjuge':
				return Grau_Parentesco::Conjuge;
				break;

			case 'Filho':
				return Grau_Parentesco::Filho;
				break;

			case 'Pai':
				return Grau_Parentesco::Pai;
				break;

			case 'Mae':
				return Grau_Parentesco::Mae;
				break;

			default:
				return null;
		}
	}

	/**
	 * Responsável criar o formato da data de nascimento do dependente
	 *
	 * @param string $sDataNascimento Data de nascimento para ser formatada
	 * @return DateTime
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	private function dataNascimentoFormatada(string $sDataNascimento): DateTime {
		return DateTime::createFromFormat('Y-m-d', $sDataNascimento);
	}
}
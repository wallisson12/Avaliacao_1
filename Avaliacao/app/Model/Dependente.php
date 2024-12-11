<?php
require_once __DIR__ . "/../Model/Grau_Parentesco.php";

/**
 * Class ${Dependente}
 * @version 1.0.0 Versionamento inicial da classe
 */
class Dependente {
    private int $iIdDependente;
    private int $iIdFiliado;
    private string $sNome;
    private DateTime $oDataNascimento;
    private Grau_Parentesco $oGrauParentesco;

    public function __construct(int $iIdDependente,int $iIdFiliado,string $sNome,string $sDataNascimento, string $sGrauParentesco) {
        $this->iIdDependente = $iIdDependente;
        $this->iIdFiliado = $iIdFiliado;
        $this->sNome = $sNome;
        $this->oDataNascimento = $this->setDataNascimento($sDataNascimento);
        $this->oGrauParentesco = $this->setGrauParentesco($sGrauParentesco);
    }

	/**
	 * Responsável por criar o objeto dependente
	 *
	 * Pega os dados para criar o objeto atraves do array merge
	 * do post e get
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param array $aDados Array merge do post e get
	 * @return Dependente
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
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @return int
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function getIdDependente(): int {
        return $this->iIdDependente;
    }

	/**
	 * Responsável por retornar o id do filiado
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @return int
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function getIdFiliado() : int {
        return $this->iIdFiliado;
    }

	/**
	 * Responsável por retornar o nome do dependente
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @return string
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function getNome(): string {
        return $this->sNome;
    }

	/**
	 * Responsável por retornar a data de nascimento do dependente
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @return string
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function getDataNascimento() : string {
        return $this->oDataNascimento->format('d/m/Y');
    }

	/**
	 * Responsável por retornar o grau de parentesco do dependente
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @return string
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function getGrauParentesco():string {
        return $this->oGrauParentesco->value;
    }

	/**
	 * Responsável por verificar o grau de parentesco do dependente
	 *
	 * Caso nao for nenhum dos casos, ele lanca uma excecao
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param string  $sGrauParentesco Grau de parentenco para ser validado
	 * @return Grau_Parentesco
	 * @throws Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    private function setGrauParentesco(string $sGrauParentesco) : Grau_Parentesco {
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
                throw new InvalidArgumentException("Grau De Parentesco Nao Definido");
        }
    }

	/**
	 * Responsável criar o formato da data de nascimento do dependente
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param string $sDataNascimento Data de nascimento para ser formatada
	 * @return DateTime
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    private function setDataNascimento(string $sDataNascimento) : DateTime {
       return DateTime::createFromFormat('Y-m-d', $sDataNascimento);
    }
}
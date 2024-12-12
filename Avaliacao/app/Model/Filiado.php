<?php
require_once "Situacao.php";

/**
 * Class ${Filiado}
 * @version 1.0.0 Versionamento inicial da classe
 */
class Filiado {
    private int $iId;
    private string $sNome;
    private string $sCpf;
    private string $sRg;
    private DateTime $oDataNascimento;
    private int $iIdade;
    private ?string $sEmpresa;
    private ?string $sCargo;
    private ?Situacao $oSituacao;
    private string $sTelefoneResidencial;
    private string $sCelular;
    private DateTime $oDataUltimaAtualizacao;

    public function __construct(?int $iId,string $sNome,string $sCpf,string $sRg,string $sDataNascimento,int $iIdade,
                                ?string $sEmpresa,?string $sCargo,?string $sSituacao,string $sTelefoneResidencial,string $sCelular,string $sDataUltimaAtualizacao)
    {

        $this->iId = $iId;
        $this->sNome = $sNome;
        $this->sCpf = $sCpf;
        $this->sRg = $sRg;
        $this->oDataNascimento = $this->DataNascimentoFormatada($sDataNascimento);
        $this->iIdade = $iIdade;
        $this->sEmpresa = $sEmpresa;
        $this->sCargo = $sCargo;
        $this->oSituacao = $this->ValidarTipoSituacao($sSituacao);
        $this->sTelefoneResidencial = $sTelefoneResidencial;
        $this->sCelular = $sCelular;
        $this->oDataUltimaAtualizacao = $this->DataAtualizacaoFormatada($sDataUltimaAtualizacao);

    }

	/**
	 * Responsável por criar o objeto filiado
	 *
	 * Pega os dados para criar o objeto atraves do array merge
	 * do post e get
	 *
	 * @param array $aDados Array merge do post e get
	 * @return Filiado
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public static function FormarObjetoFiliado(array $aDados) : Filiado {
        return new Filiado(
            $aDados["flo_id"],
            $aDados['flo_nome'],
            $aDados['flo_cpf'],
            $aDados['flo_rg'],
            $aDados['flo_data_de_nascimento'],
            $aDados['flo_idade'],
            $aDados['flo_empresa'],
            $aDados['flo_cargo'],
            $aDados['flo_situacao'],
            $aDados['flo_telefone_residencial'],
            $aDados['flo_celular'],
            $aDados['flo_data_ultima_atualizacao'],
        );
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
    public function getId(): int {
        return $this->iId;
    }

	/**
	 * Responsável por retornar o nome do filiado
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
	 * Responsável por retornar o cpf do filiado
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @return string
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function getCpf(): string {
        return $this->sCpf;
    }

	/**
	 * Responsável por retornar o rg do filiado
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @return string
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function getRg(): string {
        return $this->sRg;
    }

	/**
	 * Responsável por retornar a data de nascimento do filiado
	 * ja formatada
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @return string
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function getDataNascimento(): string {
        return $this->oDataNascimento->format('d/m/Y');
    }

	/**
	 * Responsável por retornar a idade do filiado
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @return int
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function getIdade(): int {
        return $this->iIdade;
    }

	/**
	 * Responsável por retornar a empresa do filiado
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @return string|null
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function getEmpresa(): ?string {
        return $this->sEmpresa;
    }

	/**
	 * Responsável por retornar o cargo do filiado
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @return string|null
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function getCargo(): ?string {
        return $this->sCargo;
    }

	/**
	 * Responsável por retornar a situacao do filiado
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @return string|null
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function getSituacao(): ?string {
        return $this->oSituacao->value;
    }

	/**
	 * Responsável por retornar o telefone do filiado
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @return string
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function getTelefoneResidencial(): string {
        return $this->sTelefoneResidencial;
    }

	/**
	 * Responsável por retornar o celular do filiado
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @return string
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function getCelular(): string {
        return $this->sCelular;
    }

	/**
	 * Responsável por retornar a data da ultima atualizacao do filiado
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @return string
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function getDataUltimaAtualizacao(): string {
        return $this->oDataUltimaAtualizacao->format('d/m/Y');
    }

	/**
	 * Responsável por verificar o tipo de situacao do filiado
	 *
	 * Faz a verificacao de qual situacao é o filiado, caso contrario
	 * retorna null
	 *
	 * @param string|null $sSituacao Tipo situacao a ser verificada
	 * @return Situacao|null
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    private function ValidarTipoSituacao(?string $sSituacao): ?Situacao {
        switch ($sSituacao) {
            case "Ativo":
                return Situacao::Ativo;
                break;

            case "Aposentado":
                return Situacao::Aposentado;
                break;

            case "Licenciado":
                return Situacao::Licenciado;
                break;

            default:
                return null;
        }
    }

	/**
	 * Responsável por realizar o formatacao da data da ultima atualizacao
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param string $sDataUltimaAtualizacao Data para ser formatada
	 * @return DateTime
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    private  function DataAtualizacaoFormatada(string $sDataUltimaAtualizacao) : DateTime {
        return DateTime::createFromFormat('Y-m-d H:i:s',$sDataUltimaAtualizacao);
    }

	/**
	 * Responsável por realizar a formatacao da data de nascimento
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param string $sDataNascimento Data para ser formatada
	 * @return DateTime
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public static function DataNascimentoFormatada(string $sDataNascimento) : DateTime {
        return DateTime::createFromFormat('Y-m-d',$sDataNascimento);
    }

	/**
	 * Responsável por realizar a atualizacao da data da ultima atualizacao
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @return string
	 * @throws
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public static function AtualizarDataAtualizacao() : string {
        $oDataAgora = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
        return $oDataAgora->format('Y-m-d H:i:s');
    }

}
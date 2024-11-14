<?php
require_once "Situacao.php";
class Filiado
{
    private int $iId;
    private string $sNome;
    private string $sCpf;
    private string $sRg;
    private DateTime $dDataNascimento;
    private int $iIdade;
    private ?string $sEmpresa;
    private ?string $sCargo;
    private ?Situacao $sSituacao;
    private string $sTelefoneResidencial;
    private string $sCelular;
    private DateTime $dDataUltimaAtualizacao;

    public function __construct(?int $iId,string $sNome,string $sCpf,string $sRg,string $dDataNascimento,int $iIdade,
                                ?string $sEmpresa,?string $sCargo,?string $sSituacao,string $sTelefoneResidencial,string $sCelular,string $dDataUltimaAtualizacao)
    {

        $this->iId = $iId;
        $this->sNome = $sNome;
        $this->sCpf = $sCpf;
        $this->sRg = $sRg;
        $this->dDataNascimento = $this->setDataNascimento($dDataNascimento);
        $this->iIdade = $iIdade;
        $this->sEmpresa = $sEmpresa;
        $this->sCargo = $sCargo;
        $this->sSituacao = $this->setTipo_Situacao($sSituacao);
        $this->sTelefoneResidencial = $sTelefoneResidencial;
        $this->sCelular = $sCelular;
        $this->dDataUltimaAtualizacao = $this->setDataAtualizacao($dDataUltimaAtualizacao);

    }

    public function getId(): int
    {
        return $this->iId;
    }
    public function getNome(): string
    {
        return $this->sNome;
    }

    public function getCpf(): string
    {
        return $this->sCpf;
    }

    public function getRg(): string
    {
        return $this->sRg;
    }

    public function getDataNascimento(): string
    {
        return $this->dDataNascimento->format('d/m/Y');
    }

    public function getIdade(): int
    {
        return $this->iIdade;
    }

    public function getEmpresa(): ?string
    {
        return $this->sEmpresa;
    }

    public function getCargo(): ?string
    {
        return $this->sCargo;
    }

    public function getSituacao(): ?string
    {
        return $this->sSituacao->value;
    }
    public function getTelefoneResidencial(): string
    {
        return $this->sTelefoneResidencial;
    }

    public function getCelular(): string
    {
        return $this->sCelular;
    }

    public function getDataUltimaAtualizacao(): string
    {
        return $this->dDataUltimaAtualizacao->format('d/m/Y');
    }

    private function setTipo_Situacao(?string $sSituacao): ?Situacao
    {
        switch ($sSituacao)
        {
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

    private  function setDataAtualizacao(string $sDataUltimaAtualizacao) : DateTime
    {
        return DateTime::createFromFormat('Y-m-d H:i:s',$sDataUltimaAtualizacao);
    }

    public static function setDataNascimento(string $sDataNascimento) : DateTime
    {
        return DateTime::createFromFormat('Y-m-d',$sDataNascimento);
    }

    public static function atualizaDataAtualizacao():string
    {
        $dataAgora = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
        return $dataAgora->format('Y-m-d H:i:s');
    }

}
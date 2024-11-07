<?php
require_once "Model/Situacao.php";
class Filiado
{
    private string $sNome;
    private string $sCpf;
    private string $sRg;
    private DateTime $dDataNascimento;
    private int $iIdade;
    private string $sEmpresa;
    private string $sCargo;
    private Situacao $sSituacao;
    private string $sTelefoneResidencial;
    private string $sCelular;
    private DateTime $dDataUltimaAtualizacao;

    public function __construct(string $sNome,string $sCpf,string $sRg,DateTime $dDataNascimento,int $iIdade,
                                string $sEmpresa,string $sCargo,string $sSituacao,string $sTelefoneResidencial,string $sCelular,DateTime $dDataUltimaAtualizacao)
    {
        $this->sNome = $sNome;
        $this->sCpf = $sCpf;
        $this->sRg = $sRg;
        $this->dDataNascimento = $dDataNascimento;
        $this->iIdade = $iIdade;
        $this->sEmpresa = $sEmpresa;
        $this->sCargo = $sCargo;
        $this->sSituacao = $this->setTipo_Situacao($sSituacao);
        $this->sTelefoneResidencial = $sTelefoneResidencial;
        $this->sCelular = $sCelular;
        $this->dDataUltimaAtualizacao = $dDataUltimaAtualizacao;
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

    public function getDataNascimento(): DateTime
    {
        return $this->dDataNascimento;
    }

    public function getIdade(): int
    {
        return $this->iIdade;
    }

    public function getEmpresa(): string
    {
        return $this->sEmpresa;
    }

    public function getCargo(): string
    {
        return $this->sCargo;
    }

    public function getSituacao(): Situacao
    {
        return $this->sSituacao;
    }

    private function setTipo_Situacao(string $sSituacao): Situacao
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
                throw new InvalidArgumentException("Tipo Situacao nao definido");
        }
    }

    public function getTelefoneResidencial(): string
    {
        return $this->sTelefoneResidencial;
    }

    public function getCelular(): string
    {
        return $this->sCelular;
    }

    public function getDataUltimaAtualizacao(): DateTime
    {
        return $this->dDataUltimaAtualizacao;
    }

}
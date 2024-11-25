<?php
require_once __DIR__ . "/../Model/Grau_Parentesco.php";
class Dependente
{
    private int $iIdDependente;
    private int $iIdFiliado;
    private string $sNome;
    private DateTime $dDataNascimento;
    private Grau_Parentesco $sGrauParentesco;

    public function __construct(int $iIdDependente,int $iIdFiliado,string $sNome,string $dDataNascimento, string $sGrauParentesco)
    {
        $this->iIdDependente = $iIdDependente;
        $this->iIdFiliado = $iIdFiliado;
        $this->sNome = $sNome;
        $this->dDataNascimento = $this->setDataNascimento($dDataNascimento);
        $this->sGrauParentesco = $this->setGrauParentesco($sGrauParentesco);
    }

    public static function formarObjetoDependente(array $aDados): Dependente
    {
        return new Dependente
        (
            $aDados['dpe_Id'],
            $aDados['flo_Id'],
            $aDados['dpe_Nome'],
            $aDados['dpe_Data_De_Nascimento'],
            $aDados['dpe_Grau_De_parentesco']
        );
    }

    public function getIdDependente(): int
    {
        return $this->iIdDependente;
    }
    public function getIdFiliado() : int
    {
        return $this->iIdFiliado;
    }
    public function getNome(): string
    {
        return $this->sNome;
    }

    public function getDataNascimento() : string
    {
        return $this->dDataNascimento->format('d/m/Y');
    }

    public function getGrauParentesco():string
    {
        return $this->sGrauParentesco->value;
    }

    private function setGrauParentesco(string $sGrauParentesco) : Grau_Parentesco
    {
        switch ($sGrauParentesco)
        {
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

    private function setDataNascimento(string $sDataNascimento) : DateTime
    {
       return DateTime::createFromFormat('Y-m-d', $sDataNascimento);
    }

}
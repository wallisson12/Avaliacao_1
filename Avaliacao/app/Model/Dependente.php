<?php

class Dependente
{
    private string $sNome;
    private int $iIdFiliado;
    private DateTime $dDataNascimento;
    private string $sGrauParentesco;

    public function __construct(string $sNome,int $iIdFiliado,DateTime $dDataNascimento, string $sGrauParentesco)
    {
        $this->sNome = $sNome;
        $this->iIdFiliado = $iIdFiliado;
        $this->dDataNascimento = $dDataNascimento;
        $this->sGrauParentesco = $sGrauParentesco;
    }

    public function getNome(): string
    {
        return $this->sNome;
    }

    public function getIdFiliado() : int
    {
        return $this->iIdFiliado;
    }

    public function getDataNascimento() : DateTime
    {
        return $this->dDataNascimento;
    }

    public function getGrauParentesco():string
    {
        return $this->sGrauParentesco;
    }



}
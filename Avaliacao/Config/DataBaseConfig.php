<?php
require_once __DIR__ . "/../Config/ConfiguracaoBanco.json";
abstract class DataBaseConfig
{
    private array $aConfiguracao;
    public function __construct()
    {
        $this->aConfiguracao = json_decode(file_get_contents(__DIR__ . "/../Config/ConfiguracaoBanco.json"),true);
    }

    public function getConfiguracao():array
    {
        return $this->aConfiguracao['dataBase'];
    }


}


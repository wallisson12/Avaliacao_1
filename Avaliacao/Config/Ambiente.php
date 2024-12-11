<?php

/**
 * Class ${Ambiente}
 * @version 1.0.0 Versionamento inicial da classe
 */
class Ambiente
{
	/**
	 * Responsável por retornar o caminho absoluto junto com a acao necessaria
	 *
	 * Podendo retornar a string ou fazendo o echo do caminho
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param string $sCaminho Caminho da acao que deseja realizar
	 * @param bool $bPrint Controla o retorno da funcao
	 * @return string
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public static function getUrl(string $sCaminho,bool $bPrint = false) : string
    {
        if($bPrint)
        {
            echo "http://localhost:5000/Avaliacao/{$sCaminho}";
        }

        return "http://localhost:5000/Avaliacao/{$sCaminho}";
    }
}
<?php

class Ambiente
{
    public static function getUrl(string $sCaminho,bool $bPrint = false) : string
    {
        if($bPrint)
        {
            echo "http://localhost:5000/Avaliacao/{$sCaminho}";
        }

        return "http://localhost:5000/Avaliacao/{$sCaminho}";
    }
}
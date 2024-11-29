<?php

class Session_Handler
{
    //Responsavel por iniciar uma sessao
    private static function iniciarSessao()
    {
        if(session_status() == PHP_SESSION_NONE)
        {
            session_start();
        }

    }

    //Responsavel por definir uma sesao, passando chave e valor que quer ser salvo
    public static function definirSessao (string $sChave, string $sValor)
    {
        self::iniciarSessao();
        $_SESSION[$sChave] = $sValor;
    }

    //Responsavel por obter o valor da sessao guardado em uma determinada chave
    public static function obterSessao(string $sChave) : string
    {
        self::iniciarSessao();
        return $_SESSION[$sChave];
    }

    //Responsavel por destruir a sessao, passando a chave
    public static function removerSessao(string $sChave)
    {
        self::iniciarSessao();
        unset($_SESSION[$sChave]);
    }

    public static function destruirSessao()
    {
        self::iniciarSessao();
        $_SESSION = array();
        session_destroy();
    }

    //Responsavel por verificar se uma determinada sessao existe
    public static function existirSessao(string $sChave) : bool
    {
        self::iniciarSessao();
        return isset($_SESSION[$sChave]);
    }

}
<?php

class Session_Handler
{
	/**
	 * Responsavel por iniciar uma sessao
	 *
	 * Faz a iniciação da session
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    private static function iniciarSessao() : void
    {
        if(session_status() == PHP_SESSION_NONE)
        {
            session_start();
        }

    }

	/**
	 * Responsavel por definir uma sesao, passando chave e valor que quer ser salvo
	 *
	 * Salva um valor na sessão, passando chave e valor
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param string $sChave Indice para acessar o valor
	 * @param string $sValor Valor para ser guardado
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public static function definirSessao (string $sChave, string $sValor) : void
    {
        self::iniciarSessao();
        $_SESSION[$sChave] = $sValor;
    }

	/**
	 * Responsavel por obter o valor da sessão guardada em uma determinada chave
	 *
	 * Recupera o valor guardado na sessão, passando a chave determinada
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param string $sChave Indice para acessar o valor
	 * @return string | null
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public static function obterSessao(string $sChave) : ?string
    {
        self::iniciarSessao();
        return $_SESSION[$sChave];
    }

	/**
	 * Responsavel por remover o valor guardado na sessão
	 *
	 * Passando a chave determinada, realiza a limpeza do valor
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param string $sChave Indice para acessar o valor
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public static function removerSessao(string $sChave) : void
    {
        self::iniciarSessao();
        unset($_SESSION[$sChave]);
    }

	/**
	 * Responsavel por destruir a sessao
	 *
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public static function destruirSessao() : void
    {
        self::iniciarSessao();
        $_SESSION = array();
        session_destroy();
    }

	/**
	 * Responsavel por remover o valor guardado na sessão de filtros
	 *
	 * Passando a chave determinada, realiza a limpeza do valor
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param string $sChave Indice para acessar o valor
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public static function destruirSessaoFiltros(string $sChave) : void
    {
        self::iniciarSessao();
        unset($_SESSION[$sChave]);
    }

	/**
	 * Responsavel por verificar se uma determinada sessão existe
	 *
	 * Passando a chave determinada, realiza a existencia
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param string $sChave Indice para acessar o valor
	 * @return bool
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public static function existirSessao(string $sChave) : bool
    {
        self::iniciarSessao();
        return isset($_SESSION[$sChave]);
    }



}
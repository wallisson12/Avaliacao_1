<?php

	/*
	* Responsável por fazer o autoload das classes
	*
    * Faz o carregamento dos controllers e models que vao
    * ser utilizadas naquele momento, vai procurar do diretorio
    * model e controller
	*
	* @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	*
	* @param string $class A classe que estou tentando acessar
	* @return string
	*
	* @since 1.0.0 - Definição do versionamento da função
	*
	*/
	spl_autoload_register(function ($class)
	{
	    $diretorios = ['Controller/','Model/'];

	    foreach($diretorios as $diretorio)
	    {
	        $file = __DIR__ . "/../app/$diretorio$class.php";
	        if(file_exists($file))
	        {
	            require_once $file;
	            return;
	        }

	    }

	});

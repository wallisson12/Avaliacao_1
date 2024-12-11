<?php
require_once __DIR__ . '/Config/Rota.php';

	/**
	 * Responsável por realizar o merge das super globais post e get
	 *
	 * Inicia o roteamento passando o merge das super globais
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param array $_POST Super Global post
	 * @param array $_GET Super Global get
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	$aDados = array_merge($_POST, $_GET);
	Rota::rotear($aDados);
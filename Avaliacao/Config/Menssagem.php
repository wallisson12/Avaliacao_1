<?php
require_once __DIR__ . "/../../Avaliacao/Config/Session_Handler.php";
class Menssagem
{
	public static function addMensagem(string $sTextoMensagem, ) :void {
		Session_Handler::definirSessao('mensagem', $sTextoMensagem);
	}

	public static function getMensagem() :string {
		$stexto = Session_Handler::obterSessao('mensagem');
		Session_Handler::removerSessao('mensagem');
		return $stexto ?? '';
	}

}
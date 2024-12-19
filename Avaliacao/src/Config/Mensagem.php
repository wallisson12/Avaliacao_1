<?php
namespace Moobi\Avaliacao\Config;
use Moobi\Avaliacao\Config\Session_Handler;

/**
 * Class ${Mensagem}
 * @package ${Moobi\Avaliacao\Config}
 * @version 1.0.0 Versionamento inicial da classe
 */
class Mensagem {

	/**
	 * Responsável por salvar a mensagem que vai ser exibida na sessao
	 *
	 * @param string $sTextoMensagem Mensagem
	 * @return void
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	public static function addMensagem(string $sTextoMensagem): void {
		Session_Handler::definirSessao('mensagem', $sTextoMensagem);
	}

	/**
	 * Responsável por exibir a mensagem salva na sessao
	 *
	 * @return string
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	public static function getMensagem(): string {
		$stexto = Session_Handler::obterSessao('mensagem');
		Session_Handler::removerSessao('mensagem');
		return "<span>" . $stexto . "</span>";
	}
}
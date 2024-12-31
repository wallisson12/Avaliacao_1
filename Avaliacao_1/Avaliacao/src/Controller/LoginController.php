<?php
namespace Moobi\Avaliacao\Controller;
use Moobi\Avaliacao\Model\Usuario\UsuarioDAO;
use Moobi\Avaliacao\Config\Mensagem;
use Moobi\Avaliacao\Utils\Validacoes;
use Exception;

/**
 * Class LoginController
 * @package Moobi\Avaliacao\Controller
 * @version 1.0.0 Versionamento inicial da classe
 */
class LoginController {

	/**
	 * Responsável por realizar o login no sistema
	 *
	 * Faz a comparacao se existe o usuario no banco, caso nao
	 * Ele irá lançar uma exceção, se sim carrega a pagina de dashborad
	 *
	 * @param array|null $aDados Array merge do post e get
	 * @return void
	 * @throws Exception
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 *
	 */
	public function logar(array $aDados = null): void {
		try {
			if (isset($aDados['login'])) {

				$aDados['nome'] = Validacoes::validarNome($aDados['nome']);

				$oUsuarioDAO = new UsuarioDAO();

				if ($oUsuarioDAO->findUsuarioAdm($aDados['nome'], $aDados['senha'])) {
					$this->indexDashborad();
					exit();
				} else {
					throw new Exception('Usuario ou Senha Incorreto!');
				}

			} else {
				throw new Exception('Usuario ou Senha Incorreto!');
			}
		} catch (Exception $e) {
			Mensagem::addMensagem($e->getMessage());
			$this->indexLogin();
		}
	}


	/**
	 * Responsável por realizar o redirecionamento para a pagina de login
	 *
	 * @param array|null $aDados Array merge do post e get
	 * @return void
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	public function indexLogin(array $aDados = null): void {
		require_once __DIR__ . "/../View/Usuario/LoginUsuario.php";
	}

	/**
	 * Responsável por realizar o redirecionamento para a pagina de dashborad
	 *
	 * @param array|null $aDados Array merge do post e get
	 * @return void
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	public function indexDashborad(array $aDados = null): void {
		require_once __DIR__ . "/../View/Dashboard.php";
	}
}
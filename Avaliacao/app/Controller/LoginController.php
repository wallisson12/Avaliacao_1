<?php
require_once __DIR__ . "/../Model/UsuarioDAO.php";
require_once __DIR__ . "/../../Utils/Validacoes.php";
require_once __DIR__ . "/../../Config/Mensagem.php";

/**
 * Class ${LoginController}
 * @version 1.0.0 Versionamento inicial da classe
 */
class LoginController
{
	/**
	 * Responsável por realizar o login no sistema
	 *
	 * Faz a comparacao se existe o usuario no banco, caso nao
	 * Ele irá lançar uma exceção, se sim carrega a pagina de dashborad
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param array|null $aDados Array merge do post e get
	 * @return void
	 * @throws Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 *
	 */
    public function logar(array $aDados = null) : void {
        try {
            if(isset($aDados['login'])) {

                $aDados['nome'] = Validacoes::validarNome($aDados['nome']);

                $oUsuarioDAO = new UsuarioDAO();

                if($oUsuarioDAO->findUsuarioAdm($aDados['nome'],$aDados['senha'])) {
                    $this->indexDashborad();
                    exit();
                }
                else {
                    throw new Exception('Usuario ou Senha Incorreto!');
                }

            }
            else {
                throw new Exception('Usuario ou Senha Incorreto!');
            }


        }catch (Exception $e) {

	        Mensagem::addMensagem($e->getMessage());
            $this->indexLogin();
        }
    }


	/**
	 * Responsável por realizar o redirecionamento para a pagina de login
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param array|null $aDados Array merge do post e get
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function indexLogin(array $aDados = null) : void {
        require_once __DIR__ . "/../View/LoginUsuario.php";
    }

	/**
	 * Responsável por realizar o redirecionamento para a pagina de dashborad
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param array|null $aDados Array merge do post e get
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function indexDashborad(array $aDados = null) : void {
        require_once __DIR__ . "/../View/Dashboard.php";
    }
}
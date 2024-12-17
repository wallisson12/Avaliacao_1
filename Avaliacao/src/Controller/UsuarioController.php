<?php
namespace Moobi\Avaliacao\Controller;
use Moobi\Avaliacao\Config\Ambiente;
use Moobi\Avaliacao\Config\Mensagem;
use Moobi\Avaliacao\Config\Session_Handler;
use Moobi\Avaliacao\Controller\ControllerAbstract;
use Exception;
use Moobi\Avaliacao\Model\Usuario\UsuarioDAO;
use Moobi\Avaliacao\Utils\Validacoes;

/**
 * Class ${UsuarioController}
 * @package ${Moobi\Avaliacao\Controller}
 * @version 1.0.0 Versionamento inicial da classe
 */
class UsuarioController extends ControllerAbstract
{
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Responsável por realizar o cadastro do usuario
	 *
	 * Faz a comparacao se existe o usuario no banco, caso sim
	 * Ele irá lançar uma exceção, caso contrario ele ira realizar o cadastro
	 * Depois realiza o redirecionamento
	 *
	 * @param array|null $aDados Array merge do post e get
	 * @return void
	 * @throws Exception
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	public function cadastrar(array $aDados = null): void {
		try {
			if (isset($aDados['cadastrar'])) {
				$aDados['nome'] = Validacoes::validarNome($aDados['nome']);

				$oUsuarioDAO = new UsuarioDAO();

				if ($oUsuarioDAO->isUsuarioExiste($aDados['nome'])) {
					throw new Exception('Usuario ja existe!');
				}

				$oUsuarioDAO->insert($aDados['nome'], $aDados['senha'], $aDados['tipo']);

				Mensagem::addMensagem("Cadastro Realizado Com Sucesso!");
				$this->indexCadastrar();
			}

		} catch (Exception $e) {
			Mensagem::addMensagem($e->getMessage());
			$this->indexCadastrar();
		}
	}

	/**
	 * Responsável por realizar a listagem dos usuarios
	 *
	 * Quando realiza a listagem de todos os usuarios, vai fazer o
	 * redirecionamento da pagina para lista de usuarios
	 *
	 * @param array|null $aDados Array merge do post e get
	 * @return void
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	public function listar(array $aDados = null): void {
		try {
			$oUsuarioDAO = new UsuarioDAO();
			$aUsuarios = $oUsuarioDAO->findAllUsuarios();
			require_once __DIR__ . "/../View/Usuario/ListaUsuarios.php";
		} catch (Exception $e) {
			Mensagem::addMensagem($e->getMessage());
			$this->indexLogin();
		}
	}

	/**
	 * Responsável por realizar a edicao do usuario
	 *
	 * Vai buscar o usuario dependendo do id passado e
	 * faz o redirecionamento para a pagina de edicao
	 *
	 * @param array|null $aDados Array merge do post e get
	 * @return void
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	public function editar(array $aDados = null): void {
		try {
			if (isset($aDados["id"])) {
				$oUsuarioDAO = new UsuarioDAO();
				$aUsuarios = $oUsuarioDAO->find($aDados['id']);
				require_once __DIR__ . "/../View/Usuario/Editar_Usuario.php";
			} else {
				$this->indexLogin();
			}

		} catch (Exception $e) {
			Mensagem::addMensagem($e->getMessage());
		}
	}

	/**
	 * Responsável por atualizar os dados do usuario
	 *
	 * Vai buscar o usuario dependendo do id passado e
	 * faz a atualizacao, fazendo depois o redirecionamento para a pagina de listagem
	 *
	 * @param array|null $aDados Array merge do post e get
	 * @return void
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	public function atualizar(array $aDados = null): void {
		if (isset($aDados["id"])) {
			$oUsuarioDAO = new UsuarioDAO();
			$oUsuarioDAO->update($aDados['id'], $aDados['nome'], $aDados['tipo']);

			$sPath = Ambiente::getUrl('Usuario/listar');
			Mensagem::addMensagem("Usuario Editado Com Sucesso!");
			header("Location: {$sPath}");
		}
	}

	/**
	 * Responsável por excluir o usuario
	 *
	 * Vai buscar o usuario dependendo do id passado e
	 * depois realiza o redirecionamento para a pagina de listagem
	 *
	 * @param array|null $aDados Array merge do post e get
	 * @return void
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	public function excluir(array $aDados = null): void {
		if (isset($aDados['id'])) {
			$oUsuarioDAO = new UsuarioDAO();
			$oUsuarioDAO->delete($aDados['id']);

			$sPath = Ambiente::getUrl('Usuario/listar');
			Mensagem::addMensagem("Usuario Deletado Com Sucesso!");
			header("Location: {$sPath}");
		}
	}

	/**
	 * Responsável realizar o logout do usuario
	 *
	 * Vai destruir a sessao e faz o redirecionamento para a pagina de login
	 *
	 * @param array|null $aDados Array merge do post e get
	 * @return void
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	public function logout(array $aDados = null): void {
		Session_Handler::destruirSessao();
		$this->indexLogin();
	}

	/**
	 * Responsável realizar o redirecionamento para cadastro usuario
	 *
	 *
	 * @param array|null $aDados Array merge do post e get
	 * @return void
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	public function indexCadastrar(array $aDados = null): void {
		require_once __DIR__ . "/../View/Usuario/CadastroUsuario.php";
	}

	/**
	 * Responsável realizar o redirecionamento para login usuario
	 *
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
	 * Responsável realizar o redirecionamento para dashborad usuario
	 *
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
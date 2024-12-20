<?php
namespace Moobi\Avaliacao\Controller;
use Moobi\Avaliacao\Config\Ambiente;
use Moobi\Avaliacao\Config\Mensagem;
use Moobi\Avaliacao\Config\MoobiDataBase;
use Moobi\Avaliacao\Controller\ControllerAbstract;
use Exception;
use Moobi\Avaliacao\Model\Dependente\DependenteDAO;
use Moobi\Avaliacao\Model\Filiado\Filiado;
use Moobi\Avaliacao\Model\Filiado\FiliadoDAO;
use Moobi\Avaliacao\Utils\Validacoes;

/**
 * Class DependenteController
 * @package Moobi\Avaliacao\Controller
 * @version 1.0.0 Versionamento inicial da classe
 */
class DependenteController extends ControllerAbstract {

	public function __construct() {
		parent::__construct();
	}

	/**
	 * Responsável por listar os dependentes relacionados a um filiado
	 *
	 * Faz a listagem e depois faz o redirecionamento para lista de dependentes
	 * Caso contrario vai para lista de filiados
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
			$oDependenteDAO = new DependenteDAO();

			$loDependentes = $oDependenteDAO->findByIdFiliado($aDados["id"]);
			$iIdFiliado = $aDados["id"];

			require_once __DIR__ . "/../View/Dependente/ListaDependentes.php";

		} catch (Exception $e) {
			$sPath = Ambiente::getUrl('Filiado/listar');
			Mensagem::addMensagem($e->getMessage());
			header("Location: {$sPath}");
		}
	}

	/**
	 * Responsável por cadastrar os dependentes relacionados a um filiado
	 *
	 * Faz o cadastro atraves dos dados do array merge do post e get
	 * Realiza a validacao dos dados que vao ser cadastrados e redireciona
	 * para lista de dependente
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
			if (isset($aDados["cadastrar"])) {
				foreach ($aDados["dependentes"] as $campo => $valor) {
					Validacoes::validarDataNascimento($valor['data_nascimento']);
					Validacoes::validarNomeDependente($valor['nome']);

					$oDependenteDAO = new DependenteDAO();
					$oDependenteDAO->insert($aDados['id'], $valor['nome'], $valor['data_nascimento'], $valor['grau_parentesco']);
					FiliadoDao::updateDataAtualizacao($aDados['id'],new MoobiDataBase());
				}

				$sPath = Ambiente::getUrl('Dependente/listar');
				Mensagem::addMensagem("Dependente Cadastrado Com Sucesso");
				header("Location: {$sPath}?id={$aDados['id']}");
			}
		} catch (Exception $e) {
			$sPath = Ambiente::getUrl('Filiado/listar');
			Mensagem::addMensagem($e->getMessage());
			header("Location: {$sPath}");
		}

	}

	/**
	 * Responsável por editar um dependentes relacionados a um filiado
	 *
	 * Faz a edicao atraves dos dados do array merge do post e get
	 * E faz o redirecionamento para editar dependente
	 *
	 * @param array|null $aDados Array merge do post e get
	 * @return void
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	public function editar(array $aDados = null): void {
		if (isset($aDados["id"])) {
			$oDependenteDAO = new DependenteDAO();
			$aDependente = $oDependenteDAO->find($aDados["id"]);

			require_once __DIR__ . "/../View/Dependente/Editar_Dependente.php";
		}
	}

	/**
	 * Responsável por atualizar os dados de um dependente relacionado
	 * a um filiado
	 *
	 * Faz o redirecionamento para lista de dependente do filiado associado
	 * caso contratio, faz o redirecionamento para lista de filiados
	 *
	 * @param array|null $aDados Array merge do post e get
	 * @return void
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	public function atualizar(array $aDados = null): void {
		try {
			if (isset($aDados["editar"])) {
				$oDependenteDAO = new DependenteDAO();
				$oDependenteDAO->update($aDados['id'], $aDados['nome'], $aDados['data_nascimento'], $aDados['parentesco']);
				FiliadoDao::updateDataAtualizacao($aDados['idF'],new MoobiDataBase());

				$sPath = Ambiente::getUrl('Dependente/listar');
				Mensagem::addMensagem("Dependente Editado Com Sucesso");
				header("Location: {$sPath}?id={$aDados['idF']}");
			}
		} catch (Exception $e) {
			$sPath = Ambiente::getUrl('Filiado/listar');
			Mensagem::addMensagem($e->getMessage());
			header("Location: {$sPath}");
		}

	}

	/**
	 * Responsável por excluir um dependente relacionado a um filiado
	 *
	 * Faz o redirecionamento para lista de dependente do filiado associado
	 *
	 * @param array|null $aDados Array merge do post e get
	 * @return void
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	public function excluir(array $aDados = null): void {
		if (isset($aDados["idD"])) {
			$oDependenteDAO = new DependenteDAO();
			$oDependenteDAO->delete($aDados['idD']);
			FiliadoDao::updateDataAtualizacao($aDados['idF'],new MoobiDataBase());

			$sPath = Ambiente::getUrl('Dependente/listar');
			Mensagem::addMensagem("Dependente Deletado Com Sucesso");
			header("Location: {$sPath}?id={$aDados['idF']}");
		}
	}
}


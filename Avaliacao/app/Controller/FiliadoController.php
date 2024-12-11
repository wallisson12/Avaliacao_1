<?php
require_once __DIR__  . "/../Model/FiliadoDAO.php";
require_once __DIR__  . "/../../Utils/Validacoes.php";
require_once __DIR__ . "/../../Config/Ambiente.php";
require_once __DIR__  . "/../../Config/Session_Handler.php";

/**
 * Class ${FiliadoController}
 * @version 1.0.0 Versionamento inicial da classe
 */
class FiliadoController extends ControllerAbstract {
    public function __construct() {
		parent::__construct();
    }

	/**
	 * Responsável por listar os filiados no banco com ou sem filtros
	 *
	 * Obtem os dados do filtro e salva na sessao, realiza o calculo da
	 * paginacao e faz a busca dos filiados e faz o redirecionamento para
	 * lista de filiados
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param array|null $aDados Array merge do post e get
	 * @return void
	 * @throws Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function listar(array $aDados = null) : void {
        try {
            $aFiltros = Session_Handler::obterSessao('filtros') ?? '';

            if (!is_array($aFiltros)) {
                $aFiltros = json_decode($aFiltros, true) ?? [];
            }


            if (!empty($aDados['filtros'])) {
                $aFiltros = array_merge($aFiltros, $aDados['filtros']);
                Session_Handler::definirSessao('filtros', json_encode($aFiltros));
            }

            $iPagina = (isset($aDados['pagina'])) ? $aDados['pagina'] : 1;
            $iLimite = 5;
            $iOffSet = ($iPagina - 1) * $iLimite;

            $aDadosPaginacao = [];
            $aDadosPaginacao['limit'] = $iLimite;
            $aDadosPaginacao['offset'] = $iOffSet;

            Validacoes::validarFiltros($aDados['filtros']['nome']);

            $oFiliadoDAO = new FiliadoDAO();
            $aFiliados = $oFiliadoDAO->findByFiltros($aDados['filtros'],$aDadosPaginacao);

            $iTotalFiliados = $oFiliadoDAO->TotalFiliados();

            $iTotalPaginas = ceil($iTotalFiliados/ $iLimite);

            require_once __DIR__ . "/../View/ListaFiliados.php";

        }catch (Exception $e) {
            echo"<script>alert('{$e->getMessage()}')</script>";
        }
    }

	/**
	 * Responsável por limpar os filtros e destruindo a sessao
	 *
	 * Faz o redirecionamento para a lista de filiados
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function limparFiltros() : void {
        Session_Handler::destruirSessaoFiltros('filtros');
        $sPath = Ambiente::getUrl('Filiado/listar');
        header("Location: $sPath");
    }

	/**
	 * Responsável por editar um filiado no banco passando o id
	 *
	 * E realiza o redirecionamento para a pagina de editar filiado
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param array|null $aDados Array merge do post e get
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function editar(array $aDados = null) : void {
        if(isset($aDados['id'])) {
            $oFiliadoDAO = new FiliadoDAO();
            $oFiliado = $oFiliadoDAO->find($aDados['id']);

            require_once __DIR__ . "/../View/Editar_Filiado.php";
        }
    }

	/**
	 * Responsável por excluir um filiado no banco passando o id
	 *
	 * E faz o redirecionamento para lista de filiados
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param array|null $aDados Array merge do post e get
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function excluir(array $aDados = null) : void {
        if(isset($aDados['id'])) {
            $oFiliadoDAO = new FiliadoDAO();
            $oFiliadoDAO->delete($aDados['id']);

            $sPath = Ambiente::getUrl('Filiado/listar');

            echo "<script>
                    alert('Filiado Deletado Com Sucesso!')
                    window.location.href='{$sPath}';
                  </script>";
        }
    }

	/**
	 * Responsável por atualizar dados de um filiado no banco passando o id
	 *
	 * E faz o redirecionamento para lista de filiados
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param array|null $aDados Array merge do post e get
	 * @return void
	 * @throws Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function atualizar(array $aDados = null) : void {
        if(isset($aDados['editar'])) {
            $sEmpresa = Validacoes::validarDadosEmpresa($aDados['empresa']);
            $sCargo = Validacoes::validarDadosEmpresa($aDados['cargo']);
            $sSituacao = Validacoes::validarDadosEmpresa($aDados['situacao']);

            $oFiliadoDAO = new FiliadoDAO();
            $oFiliadoDAO->update($aDados['id'],$sEmpresa, $sCargo, $sSituacao,$aDados['data']);

            $sPath = Ambiente::getUrl('Filiado/listar');

            echo "<script>
                        alert('Filiado Editado Com Sucesso!')
                        window.location.href='{$sPath}';
                  </script>";
        }
    }

	/**
	 * Responsável por cadastrar dados de um filiado no banco
	 *
	 * Verifica se o filiado ja existe, caso sim, lanca uma excecao, caso contrario
	 * Faz o redirecionamento para lista de filiados
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param array|null $aDados Array merge do post e get
	 * @return void
	 * @throws Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function cadastrar(array $aDados = null) : void {
        try {
            if(isset($aDados["cadastrar"])) {
                $sEmpresa = Validacoes::validarDadosEmpresa($aDados['empresa']);
                $sCargo = Validacoes::validarDadosEmpresa($aDados['cargo']);
                $sSituacao = Validacoes::validarDadosEmpresa($aDados['situacao']);


                $aDados['cpf'] = Validacoes::validarCpf($aDados["cpf"]);

                Validacoes::validarDataNascimento($aDados['data_nascimento']);
				$iIdade = $this->CalcularIdade($aDados['data_nascimento']);

                Validacoes::validarTelefoneResidencial($aDados['telefone']);

                Validacoes::validarCelular($aDados['celular']);

                Validacoes::validarRg($aDados['rg']);


                $oFiliadoDAO = new FiliadoDAO();

                if($oFiliadoDAO->isFiliadoExiste($aDados['cpf'])) {
                    throw new Exception('Filiado ja existe!');
                }

                $oFiliadoDAO->insert($aDados['nome'],
                    $aDados['cpf'],
                    $aDados['rg'],
                    $aDados['data_nascimento'],
                    $iIdade,
                    $sEmpresa,
                    $sCargo,
                    $sSituacao,
                    $aDados['telefone'],
                    $aDados['celular']);

                $sPath = Ambiente::getUrl('Filiado/listar');

                echo"<script>
                        alert('Filiado Cadastrado Com Sucesso!');
                        window.location = '{$sPath}';
                     </script>";
            }

        }catch (Exception $e) {
            echo"<script>alert('{$e->getMessage()}')</script>";
            $this->indexCadastrar();
        }
    }

	/**
	 * Responsável por calcular a idade de um filiado
	 *
	 * E faz o redirecionamento para lista de filiados, caso for menor de idade
	 * lanca uma excecao
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param string $sDataNascimento Data de nascimento para calcular a idade
	 * @return int
	 * @throws Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	private function CalcularIdade(string $sDataNascimento) : int {
		$oDataHoje = new DateTime('now',new DateTimeZone('America/Sao_Paulo'));
		$oDataHojeFormatada = $oDataHoje->format('Y-m-d');

		$sDataNascimento = Filiado::setDataNascimento($sDataNascimento);

		$iIntervalo = $oDataHoje->diff($sDataNascimento);

		if($iIntervalo->format('%y') >= 18) {
			return $iIntervalo->format('%y');
		}
		else {
			throw new Exception("Idade minima para cadastro, é 18 anos");
		}
	}

	/**
	 * Responsável por redirecionar para pagina de cadastro filiado
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param array|null $aDados Array merge do post e get
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function indexCadastrar(array $aDados = null) : void {
        require_once __DIR__ . "/../View/CadatroFiliado.php";
    }
}
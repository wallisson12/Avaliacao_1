<?php
require_once __DIR__ . "/../Model/DependenteDAO.php";
require_once __DIR__ . "/../../Utils/Validacoes.php";
require_once __DIR__ . "/../../Config/Ambiente.php";

/**
 * Class ${DependenteController}
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
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param array|null $aDados Array merge do post e get
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function listar(array $aDados = null) : void {
        try {
            $oDependenteDAO = new DependenteDAO();

            $loDependentes = $oDependenteDAO->findByIdFiliado($aDados["id"]);
            $iIdFiliado = $aDados["id"];

            require_once __DIR__ . "/../View/ListaDependentes.php";

        }catch (Exception $e) {
            $sPath = Ambiente::getUrl('Filiado/listar');

            echo"<script>
                    alert('{$e->getMessage()}')
                    window.location.href='{$sPath}';
                 </script>";
        }
    }

	/**
	 * Responsável por cadastrar os dependentes relacionados a um filiado
	 *
	 * Faz o cadastro atraves dos dados do array merge do post e get
	 * Realiza a validacao dos dados que vao ser cadastrados e redireciona
	 * para lista de dependente
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
                foreach ($aDados["dependentes"] as $campo => $valor) {
                    Validacoes::validarDataNascimento($valor['data_nascimento']);
                    Validacoes::validarNomeDependente($valor['nome']);

                    $oDependenteDAO = new DependenteDAO();
                    $oDependenteDAO->insert($aDados['id'],$valor['nome'],$valor['data_nascimento'],$valor['grau_parentesco']);
                }

                $sPath = Ambiente::getUrl('Dependente/listar');

                echo "<script>
                        alert('Dependente Cadastrado Com Sucesso')
                        window.location.href='{$sPath}?id={$aDados['id']}';
                      </script>";
            }


        }catch (Exception $e) {
            $sPath = Ambiente::getUrl('Filiado/listar');

            echo"<script>
                    alert('{$e->getMessage()}')
                    window.location.href='{$sPath}';
                 </script>";
        }

    }

	/**
	 * Responsável por editar um dependentes relacionados a um filiado
	 *
	 * Faz a edicao atraves dos dados do array merge do post e get
	 * E faz o redirecionamento para editar dependente
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param array|null $aDados Array merge do post e get
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function editar(array $aDados = null) : void {
        if(isset($aDados["id"])) {
            $oDependenteDAO = new DependenteDAO();
            $aDependente = $oDependenteDAO->find($aDados["id"]);

            require_once __DIR__ . "/../View/Editar_Dependente.php";
        }
    }

	/**
	 * Responsável por atualizar os dados de um dependente relacionado
	 * a um filiado
	 *
	 * Faz o redirecionamento para lista de dependente do filiado associado
	 * caso contratio, faz o redirecionamento para lista de filiados
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param array|null $aDados Array merge do post e get
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function atualizar(array $aDados = null) : void {
        try {
            if(isset($aDados["editar"])) {
                $oDependenteDAO = new DependenteDAO();
                $oDependenteDAO->update($aDados['id'],$aDados['nome'],$aDados['data_nascimento'],$aDados['parentesco']);

                $sPath = Ambiente::getUrl('Dependente/listar');
                echo "<script>
                            alert('Dependente Editado Com Sucesso')
                            window.location.href='{$sPath}?id={$aDados['idF']}';
                          </script>";
            }
        }catch (Exception $e) {
            $sPath = Ambiente::getUrl('Filiado/listar');

            echo"<script>
                    alert('{$e->getMessage()}')
                    window.location.href='{$sPath}';
                 </script>";
        }

    }

	/**
	 * Responsável por excluir um dependente relacionado a um filiado
	 *
	 * Faz o redirecionamento para lista de dependente do filiado associado
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param array|null $aDados Array merge do post e get
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function excluir(array $aDados = null) : void {
        if(isset($aDados["idD"])) {
            $oDependenteDAO = new DependenteDAO();
            $oDependenteDAO->delete($aDados['idD']);

            $sPath = Ambiente::getUrl('Dependente/listar');

            echo "<script>
                    alert('Dependente Deletado Com Sucesso!')
                    window.location.href='{$sPath}?id={$aDados['idF']}';
                  </script>";
        }
    }
}


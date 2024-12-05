<?php
require_once __DIR__  . "/../Model/FiliadoDAO.php";
require_once __DIR__  . "/../../Utils/Validacoes.php";
require_once __DIR__ . "/../../Config/Ambiente.php";
class FiliadoController extends ControllerAbstract
{
    public function __construct()
    {
        parent::__construct();
    }

    //Responsavel por pegar os dados que vem de get ou post
    //Responsavel por chamar o dao especifico no modelo para buscar os dados no banco
    public function listar(array $aDados = null)
    {
        $iPagina = (isset($aDados['pagina'])) ? $aDados['pagina'] : 1;
        $iLimite = 5;
        $iOffSet = ($iPagina - 1) * $iLimite;

        $aDadosPaginacao = [];
        $aDadosPaginacao['limit'] = $iLimite;
        $aDadosPaginacao['offset'] = $iOffSet;

        $filiadoDAO = new FiliadoDAO();
        $aFiliados = $filiadoDAO->findAllFiliados($aDadosPaginacao);

        $iTotalFiliados = $filiadoDAO->TotalFiliados();

        $iTotalPaginas = ceil($iTotalFiliados/ $iLimite);

        require_once __DIR__ . "/../View/ListaFiliados.php";
    }

    //Responsavel por pegar os dados que vem de get ou posta
    //Responsavel por chamar o dao especifico no modelo para buscar os dados no banco
    public function editar(array $aDados = null)
    {
        if(isset($aDados['id']))
        {
            $filiadoDAO = new FiliadoDAO();
            $oFiliado = $filiadoDAO->find($aDados['id']);

            require_once __DIR__ . "/../View/Editar_Filiado.php";
        }
    }

    //Responsavel por pegar os dados que vem de get ou post
    //Responsavel por chamar o dao especifico no modelo para buscar os dados no banco
    public function excluir(array $aDados = null)
    {
        if(isset($aDados['id']))
        {
            $filiadoDAO = new FiliadoDAO();
            $filiadoDAO->delete($aDados['id']);

            $path = Ambiente::getUrl('Filiado/listar');

            echo "<script>
                    alert('Filiado Deletado Com Sucesso!')
                    window.location.href='{$path}';
                  </script>";
        }
    }

    //Responsavel por pegar os dados que vem de get ou post
    //Responsavel por chamar o dao especifico no modelo para buscar os dados no banco

    //Fazer a validacao do campos antes de salvar no banco e permitir o cadastro remover e atualizar
    //Os dados, empresa, situacao, cargo
    public function atualizar(array $aDados = null)
    {
        if(isset($aDados['editar']))
        {
            //Faz a validacao dos dados de empresa
            $sEmpresa = Validacoes::validarDadosEmpresa($aDados['empresa']);
            $sCargo = Validacoes::validarDadosEmpresa($aDados['cargo']);
            $sSituacao = Validacoes::validarDadosEmpresa($aDados['situacao']);

            $filiadoDAO = new FiliadoDAO();
            $filiadoDAO->update($aDados['id'],$sEmpresa, $sCargo, $sSituacao,$aDados['data']);

            $path = Ambiente::getUrl('Filiado/listar');

            echo "<script>
                        alert('Filiado Editado Com Sucesso!')
                        window.location.href='{$path}';
                  </script>";
        }
    }


    //Responsavel por fazer a validacao dos dados antes de inserir no banco
    public function cadastrar(array $aDados = null)
    {
        try
        {
            if(isset($aDados["cadastrar"]))
            {
                //Faz a validacao dos dados de empresa
                $sEmpresa = Validacoes::validarDadosEmpresa($aDados['empresa']);
                $sCargo = Validacoes::validarDadosEmpresa($aDados['cargo']);
                $sSituacao = Validacoes::validarDadosEmpresa($aDados['situacao']);

                //Validacao do Cpf
                Validacoes::validarCpf($aDados["cpf"]);

                //Validacao Idade
                $iIdade = Validacoes::validarIdadeDataNascimento($aDados['data_nascimento']);

                //Validacao Telefone Residencial
                Validacoes::validarTelefoneResidencial($aDados['telefone']);

                //Validacao Celular
                Validacoes::validarCelular($aDados['celular']);

                //Validacao RG
                Validacoes::validarRg($aDados['rg']);

                $filiadoDAO = new FiliadoDAO();

                if($filiadoDAO->isFiliadoExiste($aDados['cpf']))
                {
                    throw new Exception('Filiado ja existe!');
                }


                $filiadoDAO->insert($_POST['nome'],
                    $aDados['cpf'],
                    $aDados['rg'],
                    $aDados['data_nascimento'],
                    $iIdade,
                    $sEmpresa,
                    $sCargo,
                    $sSituacao,
                    $aDados['telefone'],
                    $aDados['celular']);

                $path = Ambiente::getUrl('Filiado/listar');

                echo"<script>
                        alert('Filiado Cadastrado Com Sucesso!');
                        window.location = '{$path}';
                     </script>";
            }

        }catch (Exception $e)
        {
            echo"<script>alert('{$e->getMessage()}')</script>";
            $this->indexCadastrar();
        }
    }

    public function filtros(array $aDados = null)
    {
        try
        {
            //Validacao do filtro nome
            Validacoes::validarFiltros($aDados['filtros']['nome']);

            $filiadoDAO = new FiliadoDAO();
            $aFiliados = $filiadoDAO->findByFiltros($aDados['filtros']);

            require_once __DIR__ . "/../View/ListaFiliados.php";

        }catch (Exception $e)
        {
            echo"<script>alert('{$e->getMessage()}')</script>";
        }
    }

    //**Indexs**
    public function indexListar(array $aDados = null)
    {
        header("Location: http://localhost:5000/Avaliacao/Filiado/listar");
    }
    public function indexDashborad(array $aDados = null)
    {
        require_once __DIR__ . "/../View/Dashboard.php";
    }

    public function indexCadastrar(array $aDados = null)
    {
        require_once __DIR__ . "/../View/CadatroFiliado.php";
    }
}
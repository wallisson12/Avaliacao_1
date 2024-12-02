<?php
require_once __DIR__ . "/../Model/DependenteDAO.php";
require_once __DIR__ . "/../../Utils/Validacoes.php";
require_once __DIR__ . "/../../Config/Ambiente.php";
class DependenteController extends ControllerAbstract
{
    public function __construct()
    {
        parent::__construct();
    }

    //Responsavel por pegar os dados que vem de get ou post na rota por array merge
    //Responsavel por chamar o dao especifica para buscar os dados no banco
    //Responsavel por carregar a view apropriada
    public function listar(array $aDados = null)
    {
        try
        {
            $dependenteDAO = new DependenteDAO();
            $aDependentes = $dependenteDAO->findByIdFiliado($aDados["id"]);
            $iIdFiliado = $aDados["id"];

            require_once __DIR__ . "/../View/ListaDependentes.php";

        }catch (Exception $e)
        {
            $path = Ambiente::getUrl('Filiado/listar');

            echo"<script>
                    alert('{$e->getMessage()}')
                    window.location.href='{$path}';
                 </script>";
        }
    }

    public function cadastrar(array $aDados = null)
    {
        try
        {
            if(isset($aDados["cadastrar"]))
            {
                foreach ($aDados["dependentes"] as $campo => $valor)
                {
                    //Validacao Data Nascimento
                    Validacoes::validarDataNascimentoDependente($valor['data_nascimento']);

                    //Validacao Nome
                    Validacoes::validarNomeDependente($valor['nome']);

                    $dependenteDAO = new DependenteDAO();
                    $dependenteDAO->insert($aDados['id'],$valor['nome'],$valor['data_nascimento'],$valor['grau_parentesco']);
                }

                $path = Ambiente::getUrl('Dependente/listar');

                echo "<script>
                        alert('Dependente Cadastrado Com Sucesso')
                        window.location.href='{$path}?id={$aDados['id']}';
                      </script>";
            }


        }catch (Exception $e)
        {
            $path = Ambiente::getUrl('Filiado/listar');

            echo"<script>
                    alert('{$e->getMessage()}')
                    window.location.href='{$path}';
                 </script>";
        }

    }

    public function editar(array $aDados = null)
    {
        if(isset($aDados["id"]))
        {
            $dependenteDAO = new DependenteDAO();
            $aDependente = $dependenteDAO->find($aDados["id"]);

            require_once __DIR__ . "/../View/Editar_Dependente.php";
        }
    }

    public function atualizar(array $aDados = null)
    {
        try
        {
            if(isset($aDados["editar"]))
            {
                $dependenteDAO = new DependenteDAO();
                $dependenteDAO->update($aDados['id'],$aDados['nome'],$aDados['data_nascimento'],$aDados['parentesco']);

                $path = Ambiente::getUrl('Dependente/listar');
                echo "<script>
                            alert('Dependente Editado Com Sucesso')
                            window.location.href='{$path}?id={$aDados['idF']}';
                          </script>";
            }
        }catch (Exception $e)
        {
            $path = Ambiente::getUrl('Filiado/listar');

            echo"<script>
                    alert('{$e->getMessage()}')
                    window.location.href='{$path}';
                 </script>";
        }

    }

    public function excluir(array $aDados = null)
    {
        if(isset($aDados["idD"]))
        {
            $dependenteDAO = new DependenteDAO();
            $dependenteDAO->delete($aDados['idD']);

            $path = Ambiente::getUrl('Dependente/listar');

            echo "<script>
                    alert('Dependente Deletado Com Sucesso!')
                    window.location.href='{$path}?id={$aDados['idF']}';
                  </script>";
        }
    }
}


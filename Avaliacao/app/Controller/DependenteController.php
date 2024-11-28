<?php
require_once __DIR__ . "/../Model/DependenteDAO.php";
require_once __DIR__ . "/../../Utils/Validacoes.php";
class DependenteController
{

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
            echo"<script>
                    alert('{$e->getMessage()}')
                    window.location.href='http://localhost:5000/Avaliacao/Filiado/listar';
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

                echo "<script>
                        alert('Dependente Cadastrado Com Sucesso')
                        window.location.href='http://localhost:5000/Avaliacao/Filiado/listar';
                      </script>";
            }


        }catch (Exception $e)
        {
            echo"<script>
                    alert('{$e->getMessage()}')
                    window.location.href='http://localhost:5000/Avaliacao/Filiado/listar';
                 </script>";
        }

    }

    public function excluir(array $aDados = null)
    {
        if(isset($aDados["idD"]))
        {
            $dependenteDAO = new DependenteDAO();
            $dependenteDAO->delete($aDados['idD']);

            echo "<script>
                    alert('Dependente Deletado Com Sucesso!')
                    window.location.href='http://localhost:5000/Avaliacao/Filiado/listar';
                  </script>";
        }
    }
}


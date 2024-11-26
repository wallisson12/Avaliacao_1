<?php
require_once __DIR__ . "/../Model/DependenteDAO.php";
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
                    $dependenteDAO = new DependenteDAO();
                    $dependenteDAO->insert($aDados['id'],$valor['nome'],$valor['data_nascimento'],$valor['grau_parentesco']);
                }

                header("Location: http://localhost:5000/Avaliacao/Dependente/listar");
            }


        }catch (Exception $e)
        {
            echo"<script>alert('{$e->getMessage()}')</script>";
        }

    }

    //**Indexs**
}


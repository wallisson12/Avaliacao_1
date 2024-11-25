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
            if(isset($aDados["id"]))
            {
                $dependenteDAO = new DependenteDAO();
                $aDependentes = $dependenteDAO->findByIdFiliado($aDados["id"]);

                if($aDependentes != null)
                {
                    require_once __DIR__ . "/../View/ListaDependentes.php";
                }
                else
                {
                    throw new Exception("Nenhum Dependente Encontrado!");
                }
            }

        }catch (Exception $e)
        {
            echo"<script>
                    alert('{$e->getMessage()}')
                    window.location.href='http://localhost:5000/Avaliacao/Filiado/listar';
                 </script>";
        }
    }

    //**Indexs**
}


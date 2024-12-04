<?php
require_once __DIR__ . "/../Model/UsuarioDAO.php";
require_once __DIR__ . "/../../Utils/Validacoes.php";
class LoginController
{
    public function logar(array $aDados = null)
    {
        //Responsavel por fazer a validacao
        //Responsavel por pegar os dados que vem de get ou post
        //Responsavel por chamar o dao especifico no modelo para buscar os dados no banco
        try
        {
            if(isset($aDados['login']))
            {

                //Validacao login usuario
                $aDados['nome'] = Validacoes::validarNome($aDados['nome']);
                $oUsuarioDAO = new UsuarioDAO();

                if($oUsuarioDAO->findUsuarioAdm($aDados['nome'],$aDados['senha']))
                {
                    //Faco o redirecionamento
                    //Carrega a view Dashboard
                    $this->indexDashborad();
                    exit();
                }
                else
                {
                    throw new Exception('Usuario ou Senha Incorreto!');
                }

            }
            else
            {
                throw new Exception('Usuario ou Senha Incorreto!');
            }


        }catch (Exception $e)
        {

            echo"<script>alert('{$e->getMessage()}')</script>";
            $this->indexLogin();
        }
    }


    public function indexLogin(array $aDados = null)
    {
        require_once __DIR__ . "/../View/LoginUsuario.php";
    }
    public function indexDashborad(array $aDados = null)
    {
        require_once __DIR__ . "/../View/Dashboard.php";
    }
}
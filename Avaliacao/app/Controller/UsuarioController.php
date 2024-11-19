<?php
require_once __DIR__  . "/../../Config/MoobiDataBase.php";
require_once __DIR__ . "/../Model/UsuarioDAO.php";
class UsuarioController
{
    private PDO $pdo;

    public function __construct()
    {
        $mobiDataBase = new MoobiDataBase();
        $this->pdo = $mobiDataBase->pdo;
    }


    //Responsavel por fazer a validacao
    //Responsavel por pegar os dados que vem de get ou post
    //Responsavel por chamar o dao especifico no modelo para buscar os dados no banco
    public function autenticar(array $aDados = null)
    {
        if(isset($aDados['login']))
        {
            $oUsuarioDAO = new UsuarioDAO();
            $oUsuarioDAO->findUsuarioAdm($aDados['nome'],$aDados['senha']);
        }
    }

    //Responsavel por fazer a validacao
    //Responsavel por pegar os dados que vem de get ou post
    //Responsavel por chamar o dao especifico no modelo para buscar os dados no banco
    public function cadastrar(array $aDados = null)
    {
        try
        {
            if(isset($aDados['cadastrar']))
            {
                $oUsuarioDAO = new UsuarioDAO();
                if($oUsuarioDAO->isUsuarioExiste($aDados['nome']))
                {
                    throw new Exception('Usuario ja existe!');
                }

                $oUsuarioDAO->insert($aDados['nome'],$aDados['senha'],$aDados['tipo']);
                //Criar o metodo para levar para o listar usuario
                //header("Location: http://localhost:5000/Avaliacao/Usuario/");
            }


        }catch (Exception $e)
        {
            echo"<script>alert('{$e->getMessage()}')</script>";
            $this->indexCadastrar();

        }

    }

    //Responsavel por fazer a validacao
    //Responsavel por pegar os dados que vem de get ou post
    //Responsavel por chamar o dao especifico no modelo para buscar os dados no banco
    public function logoutAdm(array $aDados = null)
    {
        Session_Handler::removerSessao('admin');
        header('Location: http://localhost:5000/Avaliacao/home/index');
    }


    //Responsavel por fazer a validacao
    //Responsavel por pegar os dados que vem de get ou post
    //Responsavel por chamar o dao especifico no modelo para buscar os dados no banco
    public function logoutComun(array $aDados = null)
    {
        Session_Handler::removerSessao('comun');
        header('Location: http://localhost:5000/Avaliacao/home/index');
    }

    //**Indexs**

    public function indexCadastrar(array $aDados = null)
    {
        require_once __DIR__ . "/../View/CadastroUsuario.php";
    }

    public function indexAdmDashborad(array $aDados = null)
    {
        require_once __DIR__ . "/../View/AdminDashboard.php";
    }

}
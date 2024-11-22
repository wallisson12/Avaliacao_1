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
        try
        {
            //Validacao login usuario
            $aDados['nome'] = $this->validarNome($aDados['nome']);

            if(isset($aDados['login']))
            {
                $oUsuarioDAO = new UsuarioDAO();
                $oUsuarioDAO->findUsuarioAdm($aDados['nome'],$aDados['senha']);
            }

        }catch (Exception $e)
        {

            echo"<script>alert('{$e->getMessage()}')</script>";
            $this->indexLogin();

        }
    }

    //Responsavel por fazer a validacao
    //Responsavel por pegar os dados que vem de get ou post
    //Responsavel por chamar o dao especifico no modelo para buscar os dados no banco
    public function cadastrar(array $aDados = null)
    {
        try
        {
            //Validacao Do Nome
            $aDados['nome'] = $this->validarNome($aDados['nome']);


            if(isset($aDados['cadastrar']))
            {
                $oUsuarioDAO = new UsuarioDAO();

                if($oUsuarioDAO->isUsuarioExiste($aDados['nome']))
                {
                    throw new Exception('Usuario ja existe!');
                }

                $oUsuarioDAO->insert($aDados['nome'],$aDados['senha'],$aDados['tipo']);

                //Cadastro realizado com sucesso
                echo"<script>alert('Cadastro Realizado Com Sucesso!')</script>";
                $this->indexCadastrar();

            }


        }catch (Exception $e)
        {
            echo"<script>alert('{$e->getMessage()}')</script>";
            $this->indexCadastrar();

        }

    }

    public function listar(array $aDados = null)
    {
        $usuarioDAO = new UsuarioDAO();
        $usuarios = $usuarioDAO->findAllUsuarios();

        require_once __DIR__  . "/../View/ListaUsuarios.php";
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

    public function indexLogin(array $aDados = null)
    {
        require_once __DIR__ . "/../View/LoginUsuario.php";
    }
    public function indexAdmDashborad(array $aDados = null)
    {
        require_once __DIR__ . "/../View/AdminDashboard.php";
    }


    //**Validacao**

    public function validarNome(string $sNome) : string
    {
        //Verifica se possui numero
        if(preg_match('/\d/', $sNome) == 1)
        {
            throw new Exception('Nome Do Usuario Invalido!');
        }
        else
        {
            //Retira caracteres especiais
            $sNome = preg_replace('/[^[:alpha:]_]/','',$sNome);
            return $sNome;
        }

    }

}
<?php
require_once __DIR__ . "/../Model/UsuarioDAO.php";
require_once __DIR__ . "/../../Utils/Validacoes.php";
require_once __DIR__ . "/../../Config/Ambiente.php";
class UsuarioController extends ControllerAbstract
{
    public function __construct()
    {
        parent::__construct();
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
                //Validacao Do Nome
                $aDados['nome'] = Validacoes::validarNome($aDados['nome']);

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
            echo " <script>
                    alert('{$e->getMessage()}')
                 </script> ";

            $this->indexLogin();
        }
    }

    public function listar(array $aDados = null)
    {
        try
        {
            $usuarioDAO = new UsuarioDAO();
            $usuarios = $usuarioDAO->findAllUsuarios();

            require_once __DIR__  . "/../View/ListaUsuarios.php";

        }catch (Exception $e)
        {
            echo " <script>
                    alert('{$e->getMessage()}')
                 </script> ";

            $this->indexLogin();
        }
    }

    public function editar(array $aDados = null)
    {
        try
        {
            if(isset($aDados["id"]))
            {
               $oUsuarioDAO = new UsuarioDAO();
               $aUsuarios = $oUsuarioDAO->find($aDados['id']);

               require_once __DIR__  . "/../View/Editar_Usuario.php";
            }
            else
            {
                $this->indexLogin();
            }

        }catch (Exception $e)
        {
            echo " <script>
                    alert('{$e->getMessage()}')
                 </script> ";
        }
    }

    public function atualizar(array $aDados = null)
    {
        if(isset($aDados["id"]))
        {
            $oUsuarioDAO = new UsuarioDAO();
            $oUsuarioDAO->update($aDados['id'],$aDados['nome'],$aDados['tipo']);

            $path = Ambiente::getUrl('Usuario/listar');

            echo "<script>
                        alert('Dependente Editado Com Sucesso')
                        window.location.href = '{$path}';
                  </script>";

        }
    }

    public function excluir(array $aDados = null)
    {
        if(isset($aDados['id']))
        {
            $oUsuarioDAO = new UsuarioDAO();
            $oUsuarioDAO->delete($aDados['id']);

            $path = Ambiente::getUrl('Usuario/listar');

            echo "<script>
                    alert('Usuario Deletado Com Sucesso!')
                    window.location.href='{$path}';
                  </script>";
        }
    }

    //Responsavel por fazer a validacao
    //Responsavel por pegar os dados que vem de get ou post
    //Responsavel por chamar o dao especifico no modelo para buscar os dados no banco
    public function logout(array $aDados = null)
    {
        Session_Handler::destruirSessao();
        $this->indexLogin();
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
    public function indexDashborad(array $aDados = null)
    {
        require_once __DIR__ . "/../View/Dashboard.php";
    }

}
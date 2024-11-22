<?php
require_once __DIR__  . "/../../Config/MoobiDataBase.php";
require_once __DIR__ . "/../Model/Usuario.php";
require_once __DIR__ . "/../../Config/Session_Handler.php";
class UsuarioDAO
{
    private PDO $pdo;

    public function __construct()
    {
        $mobiDataBase = new MoobiDataBase();
        $this->pdo = $mobiDataBase->pdo;
    }


    public function findUsuarioAdm(string $sNome,string $sSenha) : void
    {
        $slq = "SELECT * FROM usuarios WHERE uso_Nome = ? AND uso_Tipo_Usuario = 'Administrador'";
        $stmt = $this->pdo->prepare($slq);
        $stmt->bindValue(1, $sNome);
        $stmt->execute();

        $aUsuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($aUsuario)
        {
            if($aUsuario["uso_Nome"] == $sNome && password_verify($sSenha,$aUsuario["uso_Senha"]))
            {
                if(Usuario::formarObjetoUsuario($aUsuario) != null)
                {
                    //Salva o usuario que esta logado
                    Session_Handler::definirSessao('usuario',$sNome);
                    Session_Handler::definirSessao('tipo','Administrador');

                    //Carrega a view Dashboard
                    require_once __DIR__ . "/../View/Dashboard.php";
                    exit();
                }
            }
        }
        else
        {
            $this->findUsuarioComun($sNome,$sSenha);
        }

        require __DIR__ . "/../View/LoginUsuario.php";
        exit();

    }


    private function findUsuarioComun(string $sNome,string $sSenha)
    {
        $slq = "SELECT * FROM usuarios WHERE uso_Nome = ? AND uso_Tipo_Usuario = 'Comum'";
        $stmt = $this->pdo->prepare($slq);
        $stmt->bindValue(1, $sNome);
        $stmt->execute();

        $aUsuarioComun = $stmt->fetch(PDO::FETCH_ASSOC);

        if($aUsuarioComun)
        {
            if($aUsuarioComun["uso_Nome"] == $sNome && password_verify($sSenha,$aUsuarioComun["uso_Senha"]))
            {
                if(Usuario::formarObjetoUsuario($aUsuarioComun) != null)
                {
                    //Salva o usuario que esta logado
                    Session_Handler::definirSessao('usuario',$sNome);
                    Session_Handler::definirSessao('tipo','Comum');

                    //Carrega a view ComunDashboard
                    require_once __DIR__ . "/../View/Dashboard.php";
                    exit();

                }
            }

        }

        throw new Exception('Usuario nao encontrado!');

    }

    public function insert(string $sNome,string $sSenha,string $sTipo) : void
    {
        $sql = "INSERT INTO usuarios (uso_Nome,uso_Senha,uso_Tipo_Usuario) VALUES (?,?,?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1,$sNome);
        $stmt->bindValue(2,password_hash($sSenha,PASSWORD_DEFAULT));
        $stmt->bindValue(3,$sTipo);
        $stmt->execute();
    }

    public function findAllUsuarios() : array
    {
        $slq = "SELECT * FROM usuarios";
        $stmt = $this->pdo->query($slq);
        $stmt->execute();

        $aUsuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $aUsuariosComuns = array_map(function ($aUsuario)
        {
            return Usuario::formarObjetoUsuario($aUsuario);
        }, $aUsuarios);

        return $aUsuariosComuns;
    }

    public function delete(int $idUsuario) : void
    {
        $sql = "DELETE FROM usuarios WHERE uso_Id = ? ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1,$idUsuario);
        $stmt->execute();
    }



    //Usar na hora do cadastro
    public function isUsuarioExiste(string $sNome) : bool
    {
        $sql = "SELECT * FROM usuarios WHERE uso_Nome = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1,$sNome);
        $stmt->execute();

        $aUsuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(count($aUsuarios) != 0)
        {
            return true;
        }
        else
        {
            return false;
        }

    }
}
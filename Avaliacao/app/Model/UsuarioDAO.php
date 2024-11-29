<?php
require_once __DIR__  . "/../../Config/MoobiDataBase.php";
require_once __DIR__ . "/../Model/Usuario.php";
require_once __DIR__ . "/../../Config/Session_Handler.php";
class UsuarioDAO
{
    private MoobiDataBase $moobiDataBase;

    public function __construct()
    {
        $this->moobiDataBase = new MoobiDataBase();
    }


    public function findUsuarioAdm(string $sNome,string $sSenha) : void
    {
        $slq = "SELECT * FROM uss_usuarios WHERE uso_Nome = ? AND uso_Tipo_Usuario = 'Administrador'";
        $parametro = [$sNome];

        $aUsuario = $this->moobiDataBase->query($slq, $parametro);

        if ($aUsuario[0])
        {
            if($aUsuario[0]["uso_Nome"] == $sNome && password_verify($sSenha,$aUsuario[0]["uso_Senha"]))
            {
                if(Usuario::formarObjetoUsuario($aUsuario[0]) != null)
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
        $slq = "SELECT * FROM uss_usuarios WHERE uso_Nome = ? AND uso_Tipo_Usuario = 'Comum'";
        $parametro = [$sNome];

        $aUsuarioComun = $this->moobiDataBase->query($slq,$parametro);

        if($aUsuarioComun[0])
        {
            if($aUsuarioComun[0]['uso_Nome'] == $sNome && password_verify($sSenha,$aUsuarioComun[0]["uso_Senha"]))
            {
                if(Usuario::formarObjetoUsuario($aUsuarioComun[0]) != null)
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
        $sql = "INSERT INTO uss_usuarios (uso_Nome,uso_Senha,uso_Tipo_Usuario) VALUES (?,?,?)";
        $parametro = [$sNome,password_hash($sSenha,PASSWORD_DEFAULT),$sTipo];

        $this->moobiDataBase->execute($sql,$parametro);
    }

    public function findAllUsuarios() : array
    {
        $slq = "SELECT * FROM uss_usuarios";
        $aUsuarios = $this->moobiDataBase->query($slq);

        $aUsuariosComuns = array_map(function ($aUsuario)
        {
            return Usuario::formarObjetoUsuario($aUsuario);
        }, $aUsuarios);

        return $aUsuariosComuns;
    }
    public function find(int $iIdUsuario): array
    {
        $sql = "SELECT * FROM uss_usuarios WHERE uso_Id = ?";
        $parametro = [$iIdUsuario];

        $aUsuario = $this->moobiDataBase->query($sql,$parametro);

        return array_map(function ($ausuario){
            return Usuario::formarObjetoUsuario($ausuario);
        },$aUsuario);
    }

    public function update(int $iIdUsuario,string $sNome,string $sTipo)
    {
        $sql = "UPDATE uss_usuarios SET uso_Nome = ?, uso_Tipo_Usuario = ? WHERE uso_Id = ?";
        $parametro = [$sNome,$sTipo,$iIdUsuario];

        $this->moobiDataBase->execute($sql,$parametro);
    }

    public function delete(int $idUsuario) : void
    {
        $sql = "DELETE FROM uss_usuarios WHERE uso_Id = ? ";
        $parametro =[$idUsuario];

        $this->moobiDataBase->execute($sql,$parametro);
    }



    //Usar na hora do cadastro
    public function isUsuarioExiste(string $sNome) : bool
    {
        $sql = "SELECT * FROM uss_usuarios WHERE uso_Nome = ?";
        $parametro =[$sNome];

        $aUsuarios = $this->moobiDataBase->query($sql,$parametro);

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
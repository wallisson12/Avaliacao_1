<?php
session_start();
require_once __DIR__  . "/../../Config/MoobiDataBase.php";
require_once __DIR__ . "/../Model/Tipo_Usuario.php";
require_once __DIR__ . "/../Model/Usuario.php";
class AutenticarController
{
    private PDO $pdo;

    public function __construct()
    {
        $mobiDataBase = new MoobiDataBase();
        $this->pdo = $mobiDataBase->pdo;
    }

    private function formaObjetoUsuario(array $aDados) : Usuario
    {
        return new Usuario($aDados['uso_Nome'],$aDados['uso_Tipo_Usuario']);
    }

    public function findUsuarioAdm(string $sNome,string $sSenha)
    {
        $slq = "SELECT * FROM usuarios WHERE uso_Tipo_Usuario = 'Administrador'";
        $stmt = $this->pdo->query($slq);
        $aUsuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if($aUsuario["uso_Nome"] == $sNome && password_verify($sSenha,$aUsuario["uso_Senha"]))
        {
           if($this->formaObjetoUsuario($aUsuario) != null)
           {
               //Salva o usuario que esta logado
               $_SESSION['admin'] = $sNome;
               //Carrega a view AdminDashboard
               require_once __DIR__ . "/../View/AdminDashboard.php";
               header('Location:../View/AdminDashboard.php');
               exit();
           }
        }
        else
        {
            $this->findUsuarioComun($sNome,$sSenha);
        }
    }

    private function findUsuarioComun(string $sNome,string $sSenha)
    {
        $slq = "SELECT * FROM usuarios WHERE uso_Tipo_Usuario = 'Comum'";
        $stmt = $this->pdo->query($slq);
        $aUsuariosComuns = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($aUsuariosComuns as $aUsuarioComun)
        {
            if($aUsuarioComun["uso_Nome"] == $sNome && password_verify($sSenha,$aUsuarioComun["uso_Senha"]))
            {
                //Salva o usuario que esta logado
                $_SESSION['usuarioComun'] = $sNome;
                //Carrega a view ComunDashboard
                require_once __DIR__ . "/../View/ComunDashboard.php";
                header('Location:../View/ComunDashboard.php');
                exit();
            }
        }

    }
    
}
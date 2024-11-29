<?php
require_once __DIR__ . "/../Model/Tipo_Usuario.php";
class Usuario
{
    private int $iId;
    private string $Nome;
    private Tipo_Usuario $Tipo_Usuario;

    public function __construct(?int $iId,string $Nome,string $sTipo_Usuario)
    {
        $this->iId = $iId;
        $this->Nome = $Nome;
        $this->Tipo_Usuario = $this->setTipo_Usuario($sTipo_Usuario);
    }

    public static function formarObjetoUsuario(array $aDados) : Usuario
    {
        return new Usuario($aDados['uso_Id'],$aDados['uso_Nome'],$aDados['uso_Tipo_Usuario']);
    }

    public function getNome(): string
    {
        return $this->Nome;
    }

    public function getTipo_Usuario(): string
    {
        return $this->Tipo_Usuario->value;
    }

    public function getId(): int
    {
        return $this->iId;
    }
    public function setTipo_Usuario(string $Tipo_Usuario) : Tipo_Usuario
    {
        //Aqui vou fazer a conversao da string que vem do banco para o tipo enum, e ja adcionar no parametro $Tipo_Usuario
        switch ($Tipo_Usuario)
        {
            case "Administrador":
                return Tipo_Usuario::Administrador;
                break;

                case "Comum":
                    return Tipo_Usuario::Comum;
                    break;

                    default:
                        throw new InvalidArgumentException("Tipo Usuario nao definido");
        }
    }

}
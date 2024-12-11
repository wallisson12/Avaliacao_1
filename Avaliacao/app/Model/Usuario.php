<?php
require_once __DIR__ . "/../Model/Tipo_Usuario.php";

/**
 * Class ${Usuario}
 * @version 1.0.0 Versionamento inicial da classe
 */
class Usuario {
    private int $iId;
    private string $Nome;
    private Tipo_Usuario $oTipo_Usuario;

    public function __construct(?int $iId,string $Nome,string $sTipo_Usuario) {
        $this->iId = $iId;
        $this->Nome = $Nome;
        $this->oTipo_Usuario = $this->setTipo_Usuario($sTipo_Usuario);
    }

	/**
	 * Responsável por criar o objeto usuario
	 *
	 * Pega os dados para criar o objeto atraves do array merge
	 * do post e get
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param array $aDados Array merge do post e get
	 * @return Usuario
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public static function formarObjetoUsuario(array $aDados) : Usuario {
        return new Usuario($aDados['uso_Id'],$aDados['uso_Nome'],$aDados['uso_Tipo_Usuario']);
    }

	/**
	 * Responsável por retornar o nome do usuario
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @return string
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function getNome(): string {
        return $this->Nome;
    }

	/**
	 * Responsável por retornar o tipo do usuario
	 *
	 * Retorna um tipo de usuario, enum
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @return string
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function getTipo_Usuario(): string {
        return $this->oTipo_Usuario->value;
    }

	/**
	 * Responsável por retornar o id do usuario
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @return int
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function getId(): int {
        return $this->iId;
    }

	/**
	 * Responsável por retornar o tipo enum de tipo usuario
	 *
	 * Faz a verificacao de qual tipo é o usuario, caso contrario lanca
	 * uma exceção
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @return Tipo_Usuario
	 * @param string $Tipo_Usuario
	 * @throws Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function setTipo_Usuario(string $Tipo_Usuario) : Tipo_Usuario {
        switch ($Tipo_Usuario) {
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
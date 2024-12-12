<?php
require_once __DIR__ . "/../Model/Tipo_Usuario.php";

/**
 * Class ${Usuario}
 * @version 1.0.0 Versionamento inicial da classe
 */
class Usuario {
    private int $iId;
    private string $Nome;
    private ?Tipo_Usuario $oTipoUsuario;

    public function __construct(?int $iId,string $Nome,string $sTipoUsuario) {
        $this->iId = $iId;
        $this->Nome = $Nome;
        $this->oTipoUsuario = $this->ValidarTipoUsuario($sTipoUsuario);
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
    public function getTipoUsuario(): string {
        return $this->oTipoUsuario->value;
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
	 * @return Tipo_Usuario|null
	 * @param string $TipoUsuario
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function ValidarTipoUsuario(string $TipoUsuario) : ?Tipo_Usuario {
        switch ($TipoUsuario) {
            case "Administrador":
                return Tipo_Usuario::Administrador;
                break;

                case "Comum":
                    return Tipo_Usuario::Comum;
                    break;

                    default:
                        return null;
        }
    }

}
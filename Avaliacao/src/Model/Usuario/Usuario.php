<?php
namespace Moobi\Avaliacao\Model\Usuario;
use Moobi\Avaliacao\Model\Usuario\Tipo_Usuario;

/**
 * Class ${Usuario}
 * @package ${Moobi\Avaliacao\Model\Usuario}
 * @version 1.0.0 Versionamento inicial da classe
 */
class Usuario{
	private int $iId;
	private string $Nome;
	private ?Tipo_Usuario $oTipoUsuario;

	public function __construct(?int $iId, string $Nome, string $sTipoUsuario) {
		$this->iId = $iId;
		$this->Nome = $Nome;
		$this->oTipoUsuario = $this->validarTipoUsuario($sTipoUsuario);
	}

	/**
	 * Responsável por criar o objeto usuario
	 *
	 * Pega os dados para criar o objeto atraves do array merge
	 * do post e get
	 *
	 * @param array $aDados Array merge do post e get
	 * @return Usuario
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	public static function formarObjetoUsuario(array $aDados): Usuario {
		return new Usuario($aDados['uso_Id'], $aDados['uso_Nome'], $aDados['uso_Tipo_Usuario']);
	}

	/**
	 * Responsável por retornar o nome do usuario
	 *
	 * @return string
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
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
	 * @return string
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	public function getTipoUsuario(): string {
		return $this->oTipoUsuario->value;
	}

	/**
	 * Responsável por retornar o id do usuario
	 *
	 * @return int
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
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
	 * @param string $TipoUsuario
	 *
	 * @return Tipo_Usuario|null
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	public function validarTipoUsuario(string $TipoUsuario): ?Tipo_Usuario {
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
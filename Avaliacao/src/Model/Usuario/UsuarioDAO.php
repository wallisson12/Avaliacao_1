<?php
namespace Moobi\Avaliacao\Model\Usuario;
use Moobi\Avaliacao\Config\MoobiDataBase;
use Moobi\Avaliacao\Model\Usuario\Usuario;
use Moobi\Avaliacao\Config\Session_Handler;

/**
 * Class UsuarioDAO
 * @package Moobi\Avaliacao\Model\Usuario
 * @version 1.0.0 Versionamento inicial da classe
 */
class UsuarioDAO {

	private MoobiDataBase $oMoobiDataBase;

	public function __construct() {
		$this->oMoobiDataBase = new MoobiDataBase();
	}

	/**
	 * Responsável por buscar o usuario no banco e verificar se ele é adm
	 *
	 * Busca no banco de dados se existe um usuario com o nome e senha passados no parametro
	 * Caso sim, ele salva o usuario na sessao e retorna true. Caso não for adm ele busca por usuario comum
	 *
	 * @param string $sNome Nome para ser comparado
	 * @param string $sSenha Senha para ser comparada
	 * @return bool
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	public function findUsuarioAdm(string $sNome, string $sSenha): bool {
		$sSlq = "SELECT * 
				 FROM uss_usuarios 
				 WHERE uso_Nome = ? 
				 AND uso_Tipo_Usuario = 'Administrador'";

		$aParametro = [$sNome];
		$aUsuario = $this->oMoobiDataBase->query($sSlq, $aParametro);
		if (isset($aUsuario[0])) {
			if ($aUsuario[0]["uso_Nome"] == $sNome && password_verify($sSenha, $aUsuario[0]["uso_Senha"])) {
				if (Usuario::formarObjetoUsuario($aUsuario[0]) != null) {
					Session_Handler::definirSessao('usuario', $sNome);
					Session_Handler::definirSessao('tipo', 'Administrador');

					return true;
				}
			}
		}

		return $this->findUsuarioComum($sNome, $sSenha);

	}

	/**
	 * Responsável por buscar o usuario no banco e verificar se ele é comum
	 *
	 * Busca no banco de dados se existe um usuario com o nome e senha passados no parametro
	 * Caso sim, ele salva o usuario na sessao. Caso não retorna false
	 *
	 * @param string $sNome Nome para ser comparado
	 * @param string $sSenha Senha para ser comparada
	 * @return bool
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	private function findUsuarioComum(string $sNome, string $sSenha): bool {
		$sSlq = "SELECT * 
				 FROM uss_usuarios 
				 WHERE uso_Nome = ? 
				 AND uso_Tipo_Usuario = 'Comum'";

		$aParametro = [$sNome];
		$aUsuarioComun = $this->oMoobiDataBase->query($sSlq, $aParametro);

		if (isset($aUsuarioComun[0])) {
			if ($aUsuarioComun[0]['uso_Nome'] == $sNome && password_verify($sSenha, $aUsuarioComun[0]["uso_Senha"])) {
				if (Usuario::formarObjetoUsuario($aUsuarioComun[0]) != null) {
					Session_Handler::definirSessao('usuario', $sNome);
					Session_Handler::definirSessao('tipo', 'Comum');

					return true;
				}
			}

		}

		return false;
	}

	/**
	 * Responsável por realizar o cadastro do usuario no banco
	 *
	 * Faz a comparacao se existe o usuario no banco, caso sim
	 * Ele irá lançar uma exceção, caso contrario ele ira realizar o cadastro
	 * Depois realiza o redirecionamento
	 *
	 * @param string $sNome Nome para ser inserido
	 * @param string $sSenha Senha para ser inserida
	 * @param string $sTipo Tipo do usuario para ser inserido
	 * @return void
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	public function insert(string $sNome, string $sSenha, string $sTipo): void {
		$sSql = "INSERT INTO uss_usuarios 
    			(uso_Nome,uso_Senha,uso_Tipo_Usuario) 
				VALUES (?,?,?)";

		$aParametro = [$sNome, password_hash($sSenha, PASSWORD_DEFAULT), $sTipo];
		$this->oMoobiDataBase->execute($sSql, $aParametro);
	}

	/**
	 * Responsável por listar todos os usuarios do banco
	 *
	 * @return array
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	public function findAllUsuarios(): array {
		$sSlq = "SELECT * 
				 FROM uss_usuarios";

		$aUsuarios = $this->oMoobiDataBase->query($sSlq);

		$aUsuariosComuns = array_map(function ($aUsuario) {
			return Usuario::formarObjetoUsuario($aUsuario);
		}, $aUsuarios);

		return $aUsuariosComuns;
	}

	/**
	 * Responsável por buscar um usuario por seu id no banco
	 *
	 * @param int $iIdUsuario Id para ser procurado
	 * @return array
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	public function find(int $iIdUsuario): array {
		$sSql = "SELECT * 
				 FROM uss_usuarios 
				 WHERE uso_Id = ?";

		$aParametro = [$iIdUsuario];
		$aUsuarios = $this->oMoobiDataBase->query($sSql, $aParametro);

		return array_map(function ($aUsuario) {
			return Usuario::formarObjetoUsuario($aUsuario);
		}, $aUsuarios);
	}

	/**
	 * Responsável por atualizar o nome e o tipo de usuario do banco, passando o id
	 *
	 * @param int $iIdUsuario Id para ser buscado
	 * @param string $sNome Nome para ser inserido
	 * @param string $sTipo Tipo do usuario para ser inserido
	 * @return void
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	public function update(int $iIdUsuario, string $sNome, string $sTipo): void {
		$sSql = "UPDATE uss_usuarios 
				 SET uso_Nome = ?, uso_Tipo_Usuario = ? 
				 WHERE uso_Id = ?";

		$aParametro = [$sNome, $sTipo, $iIdUsuario];
		$this->oMoobiDataBase->execute($sSql, $aParametro);
	}

	/**
	 * Responsável por deletar o usuario do banco, passando o id
	 *
	 * @param int $iIdUsuario Id para ser buscado
	 * @return void
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	public function delete(int $iIdUsuario): void {
		$sSql = "DELETE FROM uss_usuarios 
       			WHERE uso_Id = ? ";

		$aParametro = [$iIdUsuario];
		$this->oMoobiDataBase->execute($sSql, $aParametro);
	}

	/**
	 * Responsável por verificar se o usuario existe no banco, passando o nome
	 *
	 * @param string $sNome Nome para ser buscado
	 * @return bool
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	public function isUsuarioExiste(string $sNome): bool {
		$sSql = "SELECT * 
				 FROM uss_usuarios 
				 WHERE uso_Nome = ?";

		$aParametro = [$sNome];
		$aUsuarios = $this->oMoobiDataBase->query($sSql, $aParametro);

		if (count($aUsuarios) != 0) {
			return true;
		} else {
			return false;
		}
	}
}
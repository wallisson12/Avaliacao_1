<?php
namespace Moobi\Avaliacao\Model\Filiado;
use Moobi\Avaliacao\Config\MoobiDataBase;
use Moobi\Avaliacao\Model\Filiado\Filiado;

/**
 * Class FiliadoDAO
 * @package Moobi\Avaliacao\Model\Filiado
 * @version 1.0.0 Versionamento inicial da classe
 */
class FiliadoDAO {

	private MoobiDataBase $oMoobiDataBase;

	public function __construct() {
		$this->oMoobiDataBase = new MoobiDataBase();
	}

	/**
	 * Responsável por buscar a quantidade de filiados no banco
	 *
	 * Faz o retorno da quantidade de filiados no banco
	 *
	 * @param array|null $aFiltro Filtro passado
	 * @return int
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	public function totalFiliados(?array $aFiltro): int {
		$sSql = "SELECT COUNT(*) 
    			 AS total 
				 FROM flo_filiado WHERE 1=1";

		$aParametros =[];

		if (!empty($aFiltro['nome'])) {
			$sSql .= " AND flo_Nome LIKE ?";
			$aParametros[] = "%" . $aFiltro['nome'] . "%";
		}

		if (!empty($aFiltro['mes'])) {
			$sSql .= " AND MONTH(flo_Data_De_Nascimento) = ?";
			$aParametros[] = intval($aFiltro['mes']);
		}

		$aListaFiliados = $this->oMoobiDataBase->query($sSql,$aParametros);
		return $aListaFiliados[0]['total'];
	}

	/**
	 * Responsável por buscar um filiado por id
	 *
	 * @param int $iIdFiliado Id do filiado para ser buscado
	 * @return array
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	public function find(int $iIdFiliado): array {
		$sSql = "SELECT * 
				 FROM flo_filiado 
				 WHERE flo_id = ?";

		$aParametro = [$iIdFiliado];
		$aFiliados = $this->oMoobiDataBase->query($sSql, $aParametro);

		return array_map(function ($aFiliado) {
			return Filiado::formarObjetoFiliado($aFiliado);
		}, $aFiliados);
	}

	/**
	 * Responsável por verificar se um filiado existe por cpf
	 *
	 * @param string $sCpf Cpf para ser buscado
	 * @return bool
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	public function isFiliadoExiste(string $sCpf): bool {
		$sCpf = preg_replace('/[^0-9]/', '', $sCpf);

		$sSql = "SELECT * 
				 FROM flo_filiado 
				 WHERE flo_cpf = ?";

		$aParametro = [$sCpf];
		$aFiliado = $this->oMoobiDataBase->query($sSql, $aParametro);

		if ($aFiliado[0]) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Responsável por apagar um filiado por id
	 *
	 * @param int $iIdFiliado Id do filiado para ser apagado
	 * @return void
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	public function delete(int $iIdFiliado): void {
		$sSql = "UPDATE flo_filiado SET flo_deletado=1 WHERE flo_id = ?";
		$aParametro = [$iIdFiliado];
		$this->oMoobiDataBase->execute($sSql, $aParametro);
	}

	/**
	 * Responsável por atualizar dados de um filiado por id
	 *
	 * Empresa, Cargo e Situacao
	 *
	 * @param int $iId Id do filiado para ser atualizado
	 * @param string|null $sEmpresa Empresa para ser atualizada
	 * @param string|null $sCargo Cargo para ser atualizado
	 * @param string|null $sSituacao Situacao para ser atualizada
	 * @param string $sData Data para ser atualizada
	 * @return void
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	public function update(int $iId, ?string $sEmpresa, ?string $sCargo, ?string $sSituacao, string $sData): void {
		$sSql = "UPDATE flo_filiado 
				 SET flo_empresa = ?,flo_cargo = ?,flo_situacao = ?, flo_data_ultima_atualizacao = ?
                 WHERE flo_id = ?";

		$aParametro = [$sEmpresa, $sCargo, $sSituacao, Filiado::atualizarDataAtualizacao(), $iId];
		$this->oMoobiDataBase->execute($sSql, $aParametro);
	}

	/**
	 * Responsável por atualizar a data da ultima atualizacao
	 *
	 * @param int $iIdFiliado Id do filiado para ser atualizado
	 * @param MoobiDataBase $oMoobiDataBase Referencia do banco
	 * @return void
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	public static function updateDataAtualizacao(int $iIdFiliado,MoobiDataBase $oMoobiDataBase): void {
		$sSql = "UPDATE flo_filiado
				 SET flo_data_ultima_atualizacao = ? 
				 WHERE flo_id = ?";

		$aParametro = [Filiado::atualizarDataAtualizacao(), $iIdFiliado];
		$oMoobiDataBase->execute($sSql, $aParametro);
	}

	/**
	 * Responsável por cadastrar os dados de um filiado
	 *
	 *
	 * @param string $sNome Nome do filiado para ser cadastrado
	 * @param string $sCpf Cpf para ser cadastrado
	 * @param string $sRg Rg para ser cadastrado
	 * @param string $dDataNascimento Data de nascimento para ser cadastrada
	 * @param int $iIdade Idade para ser cadastrada
	 * @param string|null $sEmpresa Empresa para ser cadastrada
	 * @param string|null $sCargo Cargo para ser cadastrado
	 * @param string|null $sSituacao Situacao para ser cadastrada
	 * @param string $sTelefoneResidencial Telefone para ser cadastrado
	 * @param string $sCelular Celular para ser cadastrado
	 * @param int $iDeletado Verifica se foi deletado
	 * @return void
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	public function insert(string  $sNome, string $sCpf, string $sRg, string $dDataNascimento, int $iIdade,
	                       ?string $sEmpresa, ?string $sCargo, ?string $sSituacao,
	                       string  $sTelefoneResidencial,
	                       string  $sCelular,int $iDeletado): void {

		$sSql = "INSERT INTO flo_filiado 
    			 (flo_nome,flo_cpf,flo_rg,flo_data_de_nascimento,flo_idade,flo_empresa,flo_cargo,
    			 flo_situacao,flo_telefone_residencial,flo_celular,flo_data_ultima_atualizacao,flo_deletado)  
                 VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";

		$aParametro = [$sNome, $sCpf, $sRg, $dDataNascimento, $iIdade, $sEmpresa, $sCargo, $sSituacao,
						$sTelefoneResidencial,$sCelular, Filiado::atualizarDataAtualizacao(),$iDeletado];
		$this->oMoobiDataBase->execute($sSql, $aParametro);
	}

	/**
	 * Responsável por fazer a busca dos filiados no banco
	 *
	 * @param array|null $aFiltro Arrray com as infromacoes do filtro
	 * @param array|null $aDados Arrray merge do post e get
	 * @return array
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
	public function findByFiltros(?array $aFiltro, array $aDados = null): array {
		$sSql = "SELECT * 
				FROM flo_filiado 
				WHERE flo_deletado=2";

		$aParametros = [];

		if (!empty($aFiltro['nome'])) {
			$sSql .= " AND flo_Nome LIKE ?";
			$aParametros[] = "%" . $aFiltro['nome'] . "%";
		}

		if (!empty($aFiltro['mes'])) {
			$sSql .= " AND MONTH(flo_Data_De_Nascimento) = ?";
			$aParametros[] = intval($aFiltro['mes']);
		}

		if (!empty($aDados['limit'])) {
			$sSql .= " LIMIT ?";
			$aParametros[] = intval($aDados['limit']);
		}

		if (!empty($aDados['offset'])) {
			$sSql .= " OFFSET ?";
			$aParametros[] = intval($aDados['offset']);
		}

		$aFiliados = $this->oMoobiDataBase->query($sSql, $aParametros);
		return array_map(function ($aFiliado) {
			return Filiado::formarObjetoFiliado($aFiliado);
		}, $aFiliados);
	}
}
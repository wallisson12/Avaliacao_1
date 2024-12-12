<?php
require_once __DIR__  . "/../../Config/MoobiDataBase.php";
require_once __DIR__  . "/../Model/Filiado.php";

/**
 * Class ${FiliadoDAO}
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
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @return int
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function TotalFiliados() : int {
        $sSql = "SELECT COUNT(*) AS total FROM flo_filiado";
        $aListaFiliados = $this->oMoobiDataBase->query($sSql);
        return $aListaFiliados[0]["total"];
    }

	/**
	 * Responsável por buscar um filiado por id
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param int $iIdFiliado Id do filiado para ser buscado
	 * @return array
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function find(int $iIdFiliado): array {
        $sSql = "SELECT * FROM flo_filiado WHERE flo_id = ?";
        $aParametro = [$iIdFiliado];

        $aFiliados = $this->oMoobiDataBase->query($sSql,$aParametro);

        return array_map(function ($aFiliado){
            return Filiado::FormarObjetoFiliado($aFiliado);
        },$aFiliados);
    }

	/**
	 * Responsável por verificar se um filiado existe por cpf
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param string $sCpf Cpf para ser buscado
	 * @return bool
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function isFiliadoExiste(string $sCpf) : bool {
	    $sCpf = preg_replace('/[^0-9]/', '', $sCpf);

        $sSql = "SELECT * FROM flo_filiado WHERE flo_cpf = ?";
        $aParametro = [$sCpf];

        $aFiliado = $this->oMoobiDataBase->query($sSql,$aParametro);

        if($aFiliado[0]) {
            return true;
        }
        else {
            return false;
        }
    }

	/**
	 * Responsável por apagar um filiado por id
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param int $iIdFiliado Id do filiado para ser apagado
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function delete(int $iIdFiliado) : void {
        $sSql = "DELETE FROM flo_filiado WHERE flo_id = ?";
        $aParametro = [$iIdFiliado];

        $this->oMoobiDataBase->execute($sSql,$aParametro);
    }

	/**
	 * Responsável por atualizar dados de um filiado por id
	 *
	 * Empresa, Cargo e Situacao
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param int $iId Id do filiado para ser atualizado
	 * @param string|null $sEmpresa Empresa para ser atualizada
	 * @param string|null $sCargo Cargo para ser atualizado
	 * @param string|null $sSituacao Situacao para ser atualizada
	 * @param string $sData Data para ser atualizada
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function update(int $iId,?string $sEmpresa,?string $sCargo,?string $sSituacao,string $sData) : void {
        $sSlq = "UPDATE flo_filiado SET flo_empresa = ?,flo_cargo = ?,flo_situacao = ?, flo_data_ultima_atualizacao = ?
                WHERE flo_id = ?";

        $aParametro = [$sEmpresa,$sCargo,$sSituacao,Filiado::AtualizarDataAtualizacao(),$iId];

        $this->oMoobiDataBase->execute($sSlq,$aParametro);
    }

	/**
	 * Responsável por cadastrar os dados de um filiado
	 *
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
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
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function insert(string $sNome,string $sCpf,string $sRg,string $dDataNascimento,int $iIdade,
                              ?string $sEmpresa,?string $sCargo,?string $sSituacao,
                              string $sTelefoneResidencial,
                              string $sCelular) : void
    {

            $sSql = "INSERT INTO flo_filiado (flo_nome,flo_cpf,flo_rg,flo_data_de_nascimento,flo_idade,flo_empresa,flo_cargo,
                          flo_situacao,flo_telefone_residencial,flo_celular,flo_data_ultima_atualizacao)  
                    VALUES (?,?,?,?,?,?,?,?,?,?,?)";

            $aParametro = [$sNome,$sCpf,$sRg,$dDataNascimento,$iIdade,$sEmpresa,$sCargo,$sSituacao,$sTelefoneResidencial,
                          $sCelular,Filiado::AtualizarDataAtualizacao()];

            $this->oMoobiDataBase->execute($sSql,$aParametro);
    }

	/**
	 * Responsável por fazer a busca dos filiados no banco
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param array|null $aFiltro Arrray com as infromacoes do filtro
	 * @param array|null $aDados Arrray merge do post e get
	 * @return array
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function findByFiltros(?array $aFiltro,array $aDados = null): array {
        $sSql = "SELECT * FROM flo_filiado WHERE 1=1";
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
            $aParametros[] = intval(isset($aDados['offset']) ? $aDados['offset'] : 0);
        }

        $aFiliados = $this->oMoobiDataBase->query($sSql, $aParametros);

        return array_map(function($aFiliado){
            return Filiado::FormarObjetoFiliado($aFiliado);
        },$aFiliados);

    }
}
<?php
require_once __DIR__ . "/../../Config/MoobiDataBase.php";
require_once __DIR__ . "/../Model/DependenteDAO.php";
require_once __DIR__ . "/../Model/Dependente.php";

/**
 * Class ${DependenteDAO}
 * @version 1.0.0 Versionamento inicial da classe
 */
class DependenteDAO {
    private MoobiDataBase $oMoobiDataBase;

    public function __construct() {
        $this->oMoobiDataBase = new MoobiDataBase();
    }

	/**
	 * Responsável por buscar todos os dependente no banco associado ao filiado
	 *
	 * Busca no banco o dependente passando o id fo filiado
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param int $iFiliadoid Id do filiado para buscar os dependentes
	 * @return array
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function findByIdFiliado(int $iFiliadoid) : array {
        $sSql = "SELECT * FROM dpe_dependente WHERE flo_id = ?";
        $aParametro = [$iFiliadoid];

        $aDependentes = $this->oMoobiDataBase->query($sSql, $aParametro);

        $loTodosOsDados = array_map(function ($aDependente){
            return Dependente::FormarObjetoDependente($aDependente);
        },$aDependentes);

        return $loTodosOsDados;
    }

	/**
	 * Responsável por cadastrar um dependente relacionado a um filiado por id no banco
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param int $iFiliadoId Id do filiado para o dependente se associar
	 * @param string $sNome Nome do dependente
	 * @param string $sDataNascimento Data de nascimento do dependente
	 * @param string $sGrauParentesco Grau de parentesco do dependente
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function insert(int $iFiliadoId,string $sNome,string $sDataNascimento,string $sGrauParentesco) : void {
        $sSlq = "INSERT INTO dpe_dependente (flo_id,dpe_nome,dpe_data_de_nascimento,dpe_grau_de_parentesco)
                VALUES (?,?,?,?)";

        $aParametro = [$iFiliadoId,$sNome,$sDataNascimento,$sGrauParentesco];

        $this->oMoobiDataBase->execute($sSlq,$aParametro);
    }

	/**
	 * Responsável por buscar apenas um dependente por seu id no banco
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param int $iDependenteId Id do dependente para ser buscado
	 * @return array
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function find(int $iDependenteId) : array {
        $sSql = "SELECT * FROM dpe_dependente WHERE dpe_id = ?";
        $aParametro = [$iDependenteId];

        $aDependentes = $this->oMoobiDataBase->query($sSql, $aParametro);

        return array_map(function ($aDependente){
            return Dependente::FormarObjetoDependente($aDependente);
        },$aDependentes);
    }

	/**
	 * Responsável por atualizar apenas um dependente por seu id no banco
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param int $iIdDependente Id do dependente para ser atualizado
	 * @param string $sNome Nome do dependente para ser atualizado
	 * @param string $sDataNascimento Data de nascimento do dependente para ser atualizado
	 * @param string $sGrauParentesco Grau de parentesco do dependente para ser atualizado
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function update(int $iIdDependente,string $sNome,string $sDataNascimento,string $sGrauParentesco) : void {
        $sSql = "UPDATE dpe_dependente SET dpe_nome = ?, dpe_data_de_nascimento = ?, dpe_grau_de_parentesco = ? WHERE dpe_id = ?";

        $aParametro = [$sNome,$sDataNascimento,$sGrauParentesco,$iIdDependente];

        $this->oMoobiDataBase->execute($sSql,$aParametro);
    }

	/**
	 * Responsável por apagar um dependente por seu id no banco
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param int $iDependenteId Id do dependente para ser apagado
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function delete(int $iDependenteId) : void {
        $sSlq = "DELETE FROM dpe_dependente WHERE dpe_id = ?";
        $aParametro = [$iDependenteId];

        $this->oMoobiDataBase->execute($sSlq, $aParametro);
    }

}
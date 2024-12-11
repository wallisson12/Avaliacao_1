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
	 * @param int $iFiliado_id Id do filiado para buscar os dependentes
	 * @return array
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function findByIdFiliado(int $iFiliado_id) : array {
        $sSql = "SELECT * FROM dpe_dependente WHERE flo_id = ?";
        $aParametro = [$iFiliado_id];

        $aDependentes = $this->oMoobiDataBase->query($sSql, $aParametro);

        $oTodosOsDados = array_map(function ($aDependente){
            return Dependente::formarObjetoDependente($aDependente);
        },$aDependentes);

        return $oTodosOsDados;
    }

	/**
	 * Responsável por cadastrar um dependente relacionado a um filiado por id no banco
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param int $iFiliado_Id Id do filiado para o dependente se associar
	 * @param string $sNome Nome do dependente
	 * @param string $sData_Nascimento Data de nascimento do dependente
	 * @param string $sGrau_Parentesco Grau de parentesco do dependente
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function insert(int $iFiliado_Id,string $sNome,string $sData_Nascimento,string $sGrau_Parentesco) : void {
        $sSlq = "INSERT INTO dpe_dependente (flo_id,dpe_nome,dpe_data_de_nascimento,dpe_grau_de_parentesco)
                VALUES (?,?,?,?)";

        $aParametro = [$iFiliado_Id,$sNome,$sData_Nascimento,$sGrau_Parentesco];

        $this->oMoobiDataBase->execute($sSlq,$aParametro);
    }

	/**
	 * Responsável por buscar apenas um dependente por seu id no banco
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param int $iDependente_Id Id do dependente para ser buscado
	 * @return array
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function find(int $iDependente_Id) : array {
        $sSql = "SELECT * FROM dpe_dependente WHERE dpe_id = ?";
        $aParametro = [$iDependente_Id];

        $aDependentes = $this->oMoobiDataBase->query($sSql, $aParametro);

        return array_map(function ($aDependente){
            return Dependente::formarObjetoDependente($aDependente);
        },$aDependentes);
    }

	/**
	 * Responsável por atualizar apenas um dependente por seu id no banco
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param int $iId_Dependente Id do dependente para ser atualizado
	 * @param string $sNome Nome do dependente para ser atualizado
	 * @param string $sData_Nascimento Data de nascimento do dependente para ser atualizado
	 * @param string $sGrau_Parentesco Grau de parentesco do dependente para ser atualizado
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function update(int $iId_Dependente,string $sNome,string $sData_Nascimento,string $sGrau_Parentesco) : void {
        $sSql = "UPDATE dpe_dependente SET dpe_nome = ?, dpe_data_de_nascimento = ?, dpe_grau_de_parentesco = ? WHERE dpe_id = ?";

        $aParametro = [$sNome,$sData_Nascimento,$sGrau_Parentesco,$iId_Dependente];

        $this->oMoobiDataBase->execute($sSql,$aParametro);
    }

	/**
	 * Responsável por apagar um dependente por seu id no banco
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @param int $iDependente_Id Id do dependente para ser apagado
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 */
    public function delete(int $iDependente_Id) : void {
        $sSlq = "DELETE FROM dpe_dependente WHERE dpe_id = ?";
        $aParametro = [$iDependente_Id];

        $this->oMoobiDataBase->execute($sSlq, $aParametro);
    }

}
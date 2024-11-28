<?php
require_once __DIR__ . "/../../Config/MoobiDataBase.php";
require_once __DIR__ . "/../Model/DependenteDAO.php";
require_once __DIR__ . "/../Model/Dependente.php";
class DependenteDAO
{
    private MoobiDataBase $moobiDataBase;

    public function __construct()
    {
        $this->moobiDataBase = new MoobiDataBase();
    }

    public function findByIdFiliado(int $iFiliado_id) : array
    {
        $sql = "SELECT * FROM dps_dependentes WHERE flo_Id = ?";
        $parametro = [$iFiliado_id];

        $aDependentes = $this->moobiDataBase->query($sql, $parametro);

        $oTodosOsDados = array_map(function ($dependentes){
            return Dependente::formarObjetoDependente($dependentes);
        },$aDependentes);

        return $oTodosOsDados;
    }

    public function insert(int $iFiliado_Id,string $sNome,string $sData_Nascimento,string $sGrau_Parentesco)
    {
        $slq = "INSERT INTO dps_dependentes (flo_Id,dpe_Nome,dpe_Data_De_Nascimento,dpe_Grau_De_parentesco)
                VALUES (?,?,?,?)";

        $parametro = [$iFiliado_Id,$sNome,$sData_Nascimento,$sGrau_Parentesco];

        $this->moobiDataBase->execute($slq,$parametro);
    }

    public function delete(int $iDependente_Id)
    {
        $slq = "DELETE FROM dps_dependentes WHERE dpe_Id = ?";
        $parametro = [$iDependente_Id];

        $this->moobiDataBase->execute($slq, $parametro);
    }

}
<?php
require_once __DIR__ . "/../../Config/MoobiDataBase.php";
require_once __DIR__ . "/../Model/DependenteDAO.php";
require_once __DIR__ . "/../Model/Dependente.php";
class DependenteDAO
{
    private $pdo;

    public function __construct()
    {
        $mobbiDataBase = new MoobiDataBase();
        $this->pdo = $mobbiDataBase->pdo;
    }

    public function findByIdFiliado(int $iFiliado_id) : array
    {
        $sql = "SELECT * FROM dps_dependentes WHERE flo_Id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $iFiliado_id);
        $stmt->execute();

        $aDependentes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $oTodosOsDados = array_map(function ($dependentes){
            return Dependente::formarObjetoDependente($dependentes);
        },$aDependentes);

        return $oTodosOsDados;
    }

    public function insert(int $iFiliado_Id,string $sNome,string $sData_Nascimento,string $sGrau_Parentesco)
    {
        var_dump($iFiliado_Id);
        var_dump($sNome);
        var_dump($sData_Nascimento);
        var_dump($sGrau_Parentesco);

        $slq = "INSERT INTO dps_dependentes (flo_Id,dpe_Nome,dpe_Data_De_Nascimento,dpe_Grau_De_parentesco)
                VALUES (?,?,?,?)";

        $stmt = $this->pdo->prepare($slq);
        $stmt->bindValue(1, $iFiliado_Id);
        $stmt->bindValue(2, $sNome);
        $stmt->bindValue(3, $sData_Nascimento);
        $stmt->bindValue(4, $sGrau_Parentesco);
        $stmt->execute();
    }

}
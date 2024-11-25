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

    public function findByIdFiliado(int $filiado_id) : array
    {
        $sql = "SELECT * FROM dps_dependentes WHERE flo_Id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $filiado_id);
        $stmt->execute();

        $aDependentes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $oTodosOsDados = array_map(function ($dependentes){
            return Dependente::formarObjetoDependente($dependentes);
        },$aDependentes);

        return $oTodosOsDados;
    }

}
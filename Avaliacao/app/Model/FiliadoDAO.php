<?php
require_once __DIR__  . "/../../Config/MoobiDataBase.php";
require_once __DIR__  . "/../Model/Filiado.php";
class FiliadoDAO
{
    private $pdo;

    public function __construct()
    {
        $moobiDataBase = new MoobiDataBase();
        $this->pdo = $moobiDataBase->pdo;
    }

    public function finAllFiliados() : array
    {
        $sql = "SELECT * FROM fls_filiados";
        $stmt = $this->pdo->query($sql);
        $aListaFiliados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $oTodosOsDados = array_map(function ($filiado){
            return Filiado::formarObjetoFiliado($filiado);
        },$aListaFiliados);

        return $oTodosOsDados;
    }

    public function find(int $iIdFiliado): Filiado
    {
        $sql = "SELECT * FROM fls_filiados WHERE flo_Id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1,$iIdFiliado);
        $stmt->execute();

        $aFiliado = $stmt->fetch(PDO::FETCH_ASSOC);

        return Filiado::formarObjetoFiliado($aFiliado);
    }

    public function isFiliadoExiste(string $cpf) : bool
    {
        $sql = "SELECT * FROM fls_filiados WHERE flo_CPF = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1,$cpf);
        $stmt->execute();

        $aFiliado = $stmt->fetch(PDO::FETCH_ASSOC);
        var_dump($aFiliado);

        if($aFiliado)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function delete(int $iIdFiliado) : void
    {
        $slq = "DELETE FROM fls_filiados WHERE flo_Id = ?";
        $stmt = $this->pdo->prepare($slq);
        $stmt->bindValue(1,$iIdFiliado);
        $stmt->execute();
    }

    public function update(int $iId,?string $sEmpresa,?string $sCargo,?string $sSituacao,string $sData):void
    {
        $slq = "UPDATE fls_filiados SET flo_Empresa = ?,flo_Cargo = ?,flo_Situacao = ?, flo_Data_Ultima_Atualizacao = ?
                WHERE flo_Id = ?";


        $stmt = $this->pdo->prepare($slq);
        $stmt->bindValue(1,$sEmpresa);
        $stmt->bindValue(2,$sCargo);
        $stmt->bindValue(3,$sSituacao);
        $sData = Filiado::atualizaDataAtualizacao();
        $stmt->bindValue(4,$sData);
        $stmt->bindValue(5,$iId);
        $stmt->execute();
    }


    public function insert(string $sNome,string $sCpf,string $sRg,string $dDataNascimento,int $iIdade,
                              ?string $sEmpresa,?string $sCargo,?string $sSituacao,
                              string $sTelefoneResidencial,
                              string $sCelular) : void
    {

            $sql = "INSERT INTO fls_filiados (flo_Nome,flo_CPF,flo_RG,flo_Data_De_Nascimento,flo_Idade,flo_Empresa,flo_Cargo,
                          flo_Situacao,flo_Telefone_Residencial,flo_Celular,flo_Data_Ultima_Atualizacao)  
                    VALUES (?,?,?,?,?,?,?,?,?,?,?)";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1,$sNome);
            $stmt->bindValue(2,$sCpf);
            $stmt->bindValue(3,$sRg);
            $stmt->bindValue(4,$dDataNascimento);
            $stmt->bindValue(5,$iIdade);
            $stmt->bindValue(6,$sEmpresa);
            $stmt->bindValue(7,$sCargo);
            $stmt->bindValue(8,$sSituacao);
            $stmt->bindValue(9,$sTelefoneResidencial);
            $stmt->bindValue(10,$sCelular);
            $stmt->bindValue(11,Filiado::atualizaDataAtualizacao());
            $stmt->execute();
    }

}
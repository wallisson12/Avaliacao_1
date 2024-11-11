<?php
require_once __DIR__  . "/../../Config/MoobiDataBase.php";
require_once __DIR__  . "/../../app/Model/Filiado.php";
class FiliadoController
{
    private PDO $pdo;
    public function __construct()
    {
        $mobiDataBase = new MoobiDataBase();
        $this->pdo = $mobiDataBase->pdo;
    }

    private function formaObjetoFiliado($aDados) : Filiado
    {
        return new Filiado(

           $aDados["flo_Id"],
           $aDados['flo_Nome'],
           $aDados['flo_CPF'],
           $aDados['flo_RG'],
           $aDados['flo_Data_De_Nascimento'],
           $aDados['flo_Idade'],
           $aDados['flo_Empresa'],
           $aDados['flo_Cargo'],
           $aDados['flo_Situacao'],
           $aDados['flo_Telefone_Residencial'],
           $aDados['flo_Celular'],
           $aDados['flo_Data_Ultima_Atualizacao'],
        );

    }


    public function findAllFiliados() : array
    {
        $sql = "SELECT * FROM filiados";
        $stmt = $this->pdo->query($sql);
        $aListaFiliados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $oTodosOsDados = array_map(function ($filiado){
            return $this->formaObjetoFiliado($filiado);
        },$aListaFiliados);

        return $oTodosOsDados;
    }

    public function find(int $iIdFiliado): Filiado
    {
        $sql = "SELECT * FROM filiados WHERE flo_Id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1,$iIdFiliado);
        $stmt->execute();

        $aFiliado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $this->formaObjetoFiliado($aFiliado);
    }

    public function cadastrar(string $sNome,string $sCpf,string $sRg,string $dDataNascimento,int $iIdade,
                              string $sEmpresa,string $sCargo,string $sSituacao,string $sTelefoneResidencial,
                              string $sCelular) : void
    {
        $sql = "INSERT INTO filiados (flo_Nome,flo_CPF,flo_RG,flo_Data_De_Nascimento,flo_Idade,flo_Empresa,flo_Cargo,
                      flo_Situacao,flo_Telefone_Residencial,flo_Celular,flo_Data_Ultima_Atualizacao) 
                VALUES (?,?,?,?,?,?,?,?,?,?,?)";

        //Verificar os tipo data, pois no banco a data de nascimento eh date e a outra timestamp, e como estou recebendo string
        //Como faco para fazer o bind dos valores digitados no input, para colocar no banco
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1,$sNome);
        $stmt->bindValue(2,$sCpf);
        $stmt->bindValue(3,$sRg);
        $stmt->bindValue(4,Filiado::setDataNascimento($dDataNascimento));
        $stmt->bindValue(5,$iIdade);
        $stmt->bindValue(6,$sEmpresa);
        $stmt->bindValue(7,$sCargo);
        $stmt->bindValue(8,$sSituacao);
        $stmt->bindValue(9,$sTelefoneResidencial);
        $stmt->bindValue(10,$sCelular);
        $stmt->bindValue(11,Filiado::atualizaDataAtualizacao());
        $stmt->execute();

        require_once __DIR__ . "/../View/ListaFiliados.php";

    }

    public function atualizar(int $iId,string $sEmpresa,string $sCargo,string $sSituacao,string $sData):void
    {
        $slq = "UPDATE filiados SET flo_Empresa = ?,flo_Cargo = ?,flo_Situacao = ?, flo_Data_Ultima_Atualizacao = ?
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

    public function delete(int $iIdFiliado) : void
    {
        $slq = "DELETE FROM filiados WHERE flo_Id = ?";
        $stmt = $this->pdo->prepare($slq);
        $stmt->bindValue(1,$iIdFiliado);
        $stmt->execute();
    }


}
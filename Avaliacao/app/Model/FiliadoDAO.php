<?php
require_once __DIR__  . "/../../Config/MoobiDataBase.php";
require_once __DIR__  . "/../Model/Filiado.php";
class FiliadoDAO
{
    private MoobiDataBase $moobiDataBase;

    public function __construct()
    {
        $this->moobiDataBase = new MoobiDataBase();
    }

    public function TotalFiliados() : int
    {
        $sql = "SELECT COUNT(*) AS total FROM fls_filiados";
        $aListaFiliados = $this->moobiDataBase->query($sql);
        return $aListaFiliados[0]["total"];
    }

    public function find(int $iIdFiliado): array
    {
        $sql = "SELECT * FROM fls_filiados WHERE flo_Id = ?";
        $parametro = [$iIdFiliado];

        $aFiliado = $this->moobiDataBase->query($sql,$parametro);

        return array_map(function ($filiado){
            return Filiado::formarObjetoFiliado($filiado);
        },$aFiliado);
    }

    public function isFiliadoExiste(string $cpf) : bool
    {
        $sql = "SELECT * FROM fls_filiados WHERE flo_CPF = ?";
        $parametro = [$cpf];

        $aFiliado = $this->moobiDataBase->query($sql,$parametro);

        if($aFiliado[0])
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
        $sql = "DELETE FROM fls_filiados WHERE flo_Id = ?";
        $parametro = [$iIdFiliado];

        $this->moobiDataBase->execute($sql,$parametro);
    }

    public function update(int $iId,?string $sEmpresa,?string $sCargo,?string $sSituacao,string $sData):void
    {
        $slq = "UPDATE fls_filiados SET flo_Empresa = ?,flo_Cargo = ?,flo_Situacao = ?, flo_Data_Ultima_Atualizacao = ?
                WHERE flo_Id = ?";


        $parametro = [$sEmpresa,$sCargo,$sSituacao,Filiado::atualizaDataAtualizacao(),$iId];

        $this->moobiDataBase->execute($slq,$parametro);
    }


    public function insert(string $sNome,string $sCpf,string $sRg,string $dDataNascimento,int $iIdade,
                              ?string $sEmpresa,?string $sCargo,?string $sSituacao,
                              string $sTelefoneResidencial,
                              string $sCelular) : void
    {

            $sql = "INSERT INTO fls_filiados (flo_Nome,flo_CPF,flo_RG,flo_Data_De_Nascimento,flo_Idade,flo_Empresa,flo_Cargo,
                          flo_Situacao,flo_Telefone_Residencial,flo_Celular,flo_Data_Ultima_Atualizacao)  
                    VALUES (?,?,?,?,?,?,?,?,?,?,?)";

            $parametro = [$sNome,$sCpf,$sRg,$dDataNascimento,$iIdade,$sEmpresa,$sCargo,$sSituacao,$sTelefoneResidencial,
                          $sCelular,Filiado::atualizaDataAtualizacao()];

            $this->moobiDataBase->execute($sql,$parametro);
    }

    public function findByFiltros(?array $aFiltro,array $aDados = null): array
    {
        $sSql = "SELECT * FROM fls_filiados WHERE 1=1";
        $parametros = [];

        if (!empty($aFiltro['nome'])) {
            $sSql .= " AND flo_Nome LIKE ?";
            $parametros[] = "%" . $aFiltro['nome'] . "%";
        }

        if (!empty($aFiltro['mes'])) {
            $sSql .= " AND MONTH(flo_Data_De_Nascimento) = ?";
            $parametros[] = intval($aFiltro['mes']);
        }

        if (!empty($aDados['limit'])) {
            $sSql .= " LIMIT ?";
            $parametros[] = intval($aDados['limit']);
        }

        if (!empty($aDados['offset'])) {
            $sSql .= " OFFSET ?";
            $parametros[] = intval(isset($aDados['offset']) ? $aDados['offset'] : 0);
        }


        $aFiliados = $this->moobiDataBase->query($sSql, $parametros);

        return array_map(function($filiado){
            return Filiado::formarObjetoFiliado($filiado);
        },$aFiliados);

    }
}
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


    public function cadastrar(string $sNome,string $sCpf,string $sRg,string $dDataNascimento,
                              ?string $sEmpresa,?string $sCargo,?string $sSituacao,
                              string $sTelefoneResidencial,
                              string $sCelular) : void
    {

        try
        {


            //Validacao do Cpf
            $this->validarCpf($sCpf);

            //Validacao Idade
            $iIdade = $this->validarIdadeDataNascimento($dDataNascimento);

            //Validacao Telefone Residencial
            $this->validarTelefoneResidencial($sTelefoneResidencial);

            //Validacao Celular
            $this->validarCelular($sCelular);

            //Validacao RG
            $this->validarRg($sRg);


            $sql = "INSERT INTO filiados (flo_Nome,flo_CPF,flo_RG,flo_Data_De_Nascimento,flo_Idade,flo_Empresa,flo_Cargo,
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

            require_once __DIR__ . "/../View/ListaFiliados.php";
            exit();

        }catch (Exception $exception)
        {
            echo"<script>alert('{$exception->getMessage()}')</script>";
        }
    }

    //Fazer a validacao do campos antes de salvar no banco e permitir o cadastro remover e atualizar
    //Os dados, empresa, situacao, cargo
    public function atualizar(int $iId,?string $sEmpresa,?string $sCargo,?string $sSituacao,string $sData):void
    {
        $slq = "UPDATE filiados SET flo_Empresa = ?,flo_Cargo = ?,flo_Situacao = ?, flo_Data_Ultima_Atualizacao = ?
                WHERE flo_Id = ?";

        //Faz a validacao dos dados de empresa
        $sEmpresa = $this->validacaoDadosEmpresa($sEmpresa);
        $sCargo = $this->validacaoDadosEmpresa($sCargo);
        $sSituacao = $this->validacaoDadosEmpresa($sSituacao);

        $stmt = $this->pdo->prepare($slq);
        $stmt->bindValue(1,$sEmpresa);
        $stmt->bindValue(2,$sCargo);
        $stmt->bindValue(3,$sSituacao);
        $sData = Filiado::atualizaDataAtualizacao();
        $stmt->bindValue(4,$sData);
        $stmt->bindValue(5,$iId);
        $stmt->execute();

        require_once __DIR__ . "/../View/ListaFiliados.php";
        exit();

    }

    public function delete(int $iIdFiliado) : void
    {
        $slq = "DELETE FROM filiados WHERE flo_Id = ?";
        $stmt = $this->pdo->prepare($slq);
        $stmt->bindValue(1,$iIdFiliado);
        $stmt->execute();
    }



    //***VALIDACOES***

    private function validacaoDadosEmpresa(string $sDado) : ?string
    {
        return !empty($sDado) ? $sDado : null;
    }

    private function validarIdadeDataNascimento(string $sDataNascimento) : ?int
    {
        if(preg_match('/^\d{4}-\d{2}-\d{2}$/',$sDataNascimento))
        {
            $oDataHoje = new DateTime('now',new DateTimeZone('America/Sao_Paulo'));
            $oDataHojeFormatada = $oDataHoje->format('Y-m-d');

            $sDataNascimento = Filiado::setDataNascimento($sDataNascimento);

            $intervalo = $oDataHoje->diff($sDataNascimento);

            if($intervalo->format('%y') >= 18)
            {
                return $intervalo->format('%y');
            }
            else
            {
                throw new Exception("Idade minima para cadastro, é 18 anos");
            }
        }
        else
        {
            throw new Exception("Formato da data incorreto! EX (AAAA-MM-DD)");
        }
    }

    private function validarCpf(string $sCpf) : void
    {
        $sCpf = preg_replace('/[^0-9]/is', '', $sCpf);

        if (strlen($sCpf) != 11 || preg_match('/(\d)\1{10}/', $sCpf))
        {
            throw new Exception("Formato De CPF Incorreto! EX (xxx.xxx.xxx-xx)");
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $sCpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($sCpf[$c] != $d) {
                throw new Exception("CPF Incorreto! EX (xxx.xxx.xxx-xx)");
            }
        }
    }

    private function validarTelefoneResidencial(string $sTelefoneResidencial):void
    {
        if (!preg_match('/^\(?\d{2}\)? ?\d{4}-?\d{4}$/',$sTelefoneResidencial))
        {
            throw new Exception("Formato De Telefone Residencial Incorreto. EX: (XX) XXXX-XXXX");
        }

    }

    private function validarCelular(string $sCelular):void
    {
        if(!preg_match('/^\(?\d{2}\)? ?9\d{4}-?\d{4}$/',$sCelular))
        {
            throw new Exception("Formato De Celular Incorreto. EX: (XX) 9XXXX-XXXX");
        }

    }

    private function validarRg($sRg):void
    {
        if(!preg_match('/^\d{2}\.?\d{3}\.?\d{3}-?\d{1}$/',$sRg))
        {
            throw new Exception("Formato De RG Incorreto. EX: XX.XXX.XXX-X");
        }

    }





}
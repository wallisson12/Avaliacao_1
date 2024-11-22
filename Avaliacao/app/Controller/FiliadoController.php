<?php
require_once __DIR__  . "/../../Config/MoobiDataBase.php";
require_once __DIR__  . "/../Model/FiliadoDAO.php";
class FiliadoController
{
    private PDO $pdo;
    public function __construct()
    {
        $mobiDataBase = new MoobiDataBase();
        $this->pdo = $mobiDataBase->pdo;
    }


    //Responsavel por pegar os dados que vem de get ou post
    //Responsavel por chamar o dao especifico no modelo para buscar os dados no banco
    public function listar(array $aDados = null)
    {
        $filiadoDAO = new FiliadoDAO();
        $aFiliados = $filiadoDAO->finAllFiliados();

        require_once __DIR__ . "/../View/ListaFiliados.php";
    }

    //Responsavel por pegar os dados que vem de get ou posta
    //Responsavel por chamar o dao especifico no modelo para buscar os dados no banco
    public function editar(array $aDados = null)
    {
        if(isset($aDados['id']))
        {
            $filiadoDAO = new FiliadoDAO();
            $oFiliado = $filiadoDAO->find($aDados['id']);

            require_once __DIR__ . "/../View/Editar_Filiado.php";
        }
    }

    //Responsavel por pegar os dados que vem de get ou post
    //Responsavel por chamar o dao especifico no modelo para buscar os dados no banco
    public function excluir(array $aDados = null)
    {
        if(isset($aDados['id']))
        {
            $filiadoDAO = new FiliadoDAO();
            $filiadoDAO->delete($aDados['id']);

            header("Location: http://localhost:5000/Avaliacao/Filiado/listar");
        }
    }

    //Responsavel por pegar os dados que vem de get ou post
    //Responsavel por chamar o dao especifico no modelo para buscar os dados no banco

    //Fazer a validacao do campos antes de salvar no banco e permitir o cadastro remover e atualizar
    //Os dados, empresa, situacao, cargo
    public function atualizar(array $aDados = null)
    {
        if(isset($aDados['editar']))
        {
            //Faz a validacao dos dados de empresa
            $sEmpresa = $this->validacaoDadosEmpresa($aDados['empresa']);
            $sCargo = $this->validacaoDadosEmpresa($aDados['cargo']);
            $sSituacao = $this->validacaoDadosEmpresa($aDados['situacao']);

            $filiadoDAO = new FiliadoDAO();
            $filiadoDAO->update($aDados['id'],$sEmpresa, $sCargo, $sSituacao,$aDados['data']);

          header("Location: http://localhost:5000/Avaliacao/Filiado/listar");

        }
    }


    //Responsavel por fazer a validacao dos dados antes de inserir no banco
    public function cadastrar(array $aDados = null)
    {
        try
        {
            if(isset($aDados["cadastrar"]))
            {
                //Faz a validacao dos dados de empresa
                $sEmpresa = $this->validacaoDadosEmpresa($aDados['empresa']);
                $sCargo = $this->validacaoDadosEmpresa($aDados['cargo']);
                $sSituacao = $this->validacaoDadosEmpresa($aDados['situacao']);

                //Validacao do Cpf
                $this->validarCpf($aDados["cpf"]);

                //Validacao Idade
                $iIdade = $this->validarIdadeDataNascimento($aDados['data_nascimento']);

                //Validacao Telefone Residencial
                $this->validarTelefoneResidencial($aDados['telefone']);

                //Validacao Celular
                $this->validarCelular($aDados['celular']);

                //Validacao RG
                $this->validarRg($aDados['rg']);

                $filiadoDAO = new FiliadoDAO();

                if($filiadoDAO->isFiliadoExiste($aDados['cpf']))
                {
                    throw new Exception('Filiado ja existe!');
                }


                $filiadoDAO->insert($_POST['nome'],
                    $aDados['cpf'],
                    $aDados['rg'],
                    $aDados['data_nascimento'],
                    $iIdade,
                    $sEmpresa,
                    $sCargo,
                    $sSituacao,
                    $aDados['telefone'],
                    $aDados['celular']);


                header("Location: http://localhost:5000/Avaliacao/Filiado/listar");

            }

        }catch (Exception $e)
        {
            echo"<script>alert('{$e->getMessage()}')</script>";
            $this->indexCadastrar();
        }
    }


    //**Indexs**
    public function indexListar(array $aDados = null)
    {
        header("Location: http://localhost:5000/Avaliacao/Filiado/listar");
    }
    public function indexDashborad(array $aDados = null)
    {
        require_once __DIR__ . "/../View/Dashboard.php";
    }

    public function indexCadastrar(array $aDados = null)
    {
        require_once __DIR__ . "/../View/CadatroFiliado.php";
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
            throw new Exception("Formato da data incorreto! EX (YYYY-MM-DD)");
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
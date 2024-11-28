<?php

class Validacoes
{
    //**Usuario**
    public static function validarNome(string $sNome) : string
    {
        //Verifica se possui numero
        if(preg_match('/\d/', $sNome) == 1)
        {
            throw new Exception('Nome Do Usuario Invalido!');
        }
        else
        {
            //Retira caracteres especiais
            $sNome = preg_replace('/[^[:alpha:]_]/','',$sNome);
            return $sNome;
        }
    }

    //**Filiado**
    public static function validarDadosEmpresa(string $sDado) : ?string
    {
        return !empty($sDado) ? $sDado : null;
    }

    public static function validarIdadeDataNascimento(string $sDataNascimento) : ?int
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

    public static function validarCpf(string $sCpf) : void
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

    public static function validarTelefoneResidencial(string $sTelefoneResidencial):void
    {
        if (!preg_match('/^\(?\d{2}\)? ?\d{4}-?\d{4}$/',$sTelefoneResidencial))
        {
            throw new Exception("Formato De Telefone Residencial Incorreto. EX: (XX) XXXX-XXXX");
        }

    }

    public static function validarCelular(string $sCelular):void
    {
        if(!preg_match('/^\(?\d{2}\)? ?9\d{4}-?\d{4}$/',$sCelular))
        {
            throw new Exception("Formato De Celular Incorreto. EX: (XX) 9XXXX-XXXX");
        }

    }

    public static function validarRg($sRg):void
    {
        if(!preg_match('/^\d{2}\.?\d{3}\.?\d{3}-?\d{1}$/',$sRg))
        {
            throw new Exception("Formato De RG Incorreto. EX: XX.XXX.XXX-X");
        }
    }

    public static function validarFiltros(?string $sNome)
    {
        if (empty($sNome))
        {
            return;
        }

        if(!preg_match('/^[a-zA-ZÀ-ÿ\s]+$/u', $sNome))
        {
            throw new Exception("Formato Do Nome Incorreto!");
        }
    }


    //**Dependentes**

    public static function validarNomeDependente(string $sNome)
    {
        if(!preg_match('/^[a-zA-ZÀ-ÿ\s]+$/u', $sNome))
        {
            throw new Exception("Formato Do Nome Incorreto!");
        }
    }

    public static function validarDataNascimentoDependente(string $sDataNascimento)
    {
        if(!preg_match('/^\d{4}-\d{2}-\d{2}$/',$sDataNascimento))
        {
            throw new Exception("Formato Da Data Incorreto! EX (YYYY-MM-DD)");
        }
    }


}
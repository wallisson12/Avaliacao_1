<?php
namespace Moobi\Avaliacao\Utils;
use Exception;

/**
 * Class ${Validacoes}
 * @package ${Moobi\Avaliacao\Utils}
 * @version 1.0.0 Versionamento inicial da classe
 */
class Validacoes {

	/**
	 * Responsável por fazer a validacão do nome aceitando apenas letras, com regex
	 *
	 * Caso possua algum número, ele irá lançar uma exceção
	 *
	 * @param string $sNome Nome para ser validado
	 * @return string
	 * @throws Exception
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 *
	 */
	public static function validarNome(string $sNome): string {
		if (preg_match('/\d/', $sNome) == 1) {
			throw new Exception('Nome Do Usuario Invalido!');
		} else {
			$sNome = preg_replace('/[^[:alpha:]_]/', '', $sNome);
			return $sNome;
		}
	}

	/**
	 * Responsável por fazer a validacão do nome, cargo e situação da empresa
	 *
	 * Caso nao for passado nenhuma string ele adciona null
	 *
	 * @param string $sDado dado a ser validado
	 * @return string | null
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 *
	 */
	public static function validarDadosEmpresa(string $sDado): ?string {
		return !empty($sDado) ? $sDado : null;
	}

	/**
	 * Responsável por fazer a validacao da data de nascimento
	 *
	 * Verifica o formato da data de nascimento, com regex
	 * Caso contrário retorna uma exceção
	 *
	 * @param string $sDataNascimento Data para ser validada
	 * @return void
	 * @throws Exception
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 *
	 */
	public static function validarDataNascimento(string $sDataNascimento): void {
		if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $sDataNascimento)) {
			throw new Exception("Formato da data incorreto! EX (YYYY-MM-DD)");
		}
	}

	/**
	 * Responsável por fazer a validacao do cpf
	 *
	 * Verifica o formato do cpf e se é uma sequência de números repetidos, com regex
	 * Caso não for um cpf válido, vai ser lançada uma exceção
	 *
	 * @param string $sCpf cpf para ser validado
	 * @return string
	 * @throws Exception
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 *
	 */
	public static function validarCpf(string $sCpf): string {
		$sCpf = preg_replace('/[^0-9]/is', '', $sCpf);

		if (strlen($sCpf) != 11 || preg_match('/(\d)\1{10}/', $sCpf)) {
			throw new Exception("Formato De CPF Incorreto! EX (xxx.xxx.xxx-xx)");
		}

		for ($t = 9; $t < 11; $t++) {
			$d = 0;
			for ($c = 0; $c < $t; $c++) {
				$d += $sCpf[$c] * (($t + 1) - $c);
			}
			$d = ((10 * $d) % 11) % 10;

			if ($sCpf[$t] != $d) {
				throw new Exception("CPFt Incorreto! EX (xxx.xxx.xxx-xx)");
			}
		}

		return $sCpf;
	}

	/**
	 * Responsável por fazer a validacao do Telefone Residencial
	 *
	 * Verifica o formato do telefone, com regex
	 * Caso não for um telefone válido, vai ser lançada uma exceção
	 *
	 * @param string $sTelefoneResidencial Telefone para ser validado
	 * @return void
	 * @throws Exception
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 *
	 */
	public static function validarTelefoneResidencial(string $sTelefoneResidencial): void {
		if (!preg_match('/^\(?\d{2}\)? ?\d{4}-?\d{4}$/', $sTelefoneResidencial)) {
			throw new Exception("Formato De Telefone Residencial Incorreto. EX: (XX) XXXX-XXXX");
		}

	}

	/**
	 * Responsável por fazer a validacao do celular
	 *
	 * Verifica o formato do celular, com regex
	 * Caso não for um celular válido, vai ser lançada uma exceção
	 *
	 * @param string $sCelular Celular para ser validado
	 * @return void
	 * @throws Exception
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 *
	 */
	public static function validarCelular(string $sCelular): void {
		if (!preg_match('/^\(?\d{2}\)? ?9\d{4}-?\d{4}$/', $sCelular)) {
			throw new Exception("Formato De Celular Incorreto. EX: (XX) 9XXXX-XXXX");
		}

	}

	/**
	 * Responsável por fazer a validacao do rg
	 *
	 * Verifica o formato do rg, com regex
	 * Caso não for um rg válido, vai ser lançada uma exceção
	 *
	 * @param string $sRg RG para ser validado
	 * @return void
	 * @throws Exception
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 *
	 */
	public static function validarRg(string $sRg): void {
		if (!preg_match('/^\d{2}\.?\d{3}\.?\d{3}-?\d{1}$/', $sRg)) {
			throw new Exception("Formato De RG Incorreto. EX: XX.XXX.XXX-X");
		}
	}

	/**
	 * Responsável por fazer a validacao do nome no filtro
	 *
	 * Verifica o formato do nome, com regex
	 * Caso o nome não for válido, vai ser lançada uma exceção
	 *
	 * @param string | null $sNome Nome para ser validado
	 * @return void
	 * @throws Exception
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 *
	 */
	public static function validarFiltros(?string $sNome): void {
		if (empty($sNome)) {
			return;
		}

		if (!preg_match('/^[a-zA-ZÀ-ÿ\s]+$/u', $sNome)) {
			throw new Exception("Formato Do Nome Incorreto!");
		}
	}


	/**
	 * Responsável por fazer a validacao do nome de um dependente
	 *
	 * Verifica o formato do nome, com regex
	 * Caso o nome não for válido, vai ser lançada uma exceção
	 *
	 * @param string $sNome Nome para ser validado
	 * @return void
	 * @throws Exception
	 *
	 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
	 *
	 * @since 1.0.0 - Definição do versionamento da função
	 *
	 */
	public static function validarNomeDependente(string $sNome): void {
		if (!preg_match('/^[a-zA-ZÀ-ÿ\s]+$/u', $sNome)) {
			throw new Exception("Formato Do Nome Incorreto!");
		}
	}
}
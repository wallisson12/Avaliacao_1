<?php
namespace Moobi\Avaliacao\Model\Filiado;

/**
 * Enum Situacao
 * @package Moobi\Avaliacao\Model\Filiado
 * @version 1.0.0 Versionamento inicial da classe
 */
enum Situacao: string {
	
	case Ativo = 'Ativo';
	case Aposentado = 'Aposentado';
	case Licenciado = 'Licenciado';
}

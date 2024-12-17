<?php
namespace Moobi\Avaliacao\Model\Dependente;

/**
 * Enum ${Grau_Parentesco}
 * @package ${Moobi\Avaliacao\Model\Dependente}
 * @version 1.0.0 Versionamento inicial da classe
 */
enum Grau_Parentesco: string {
	case Conjuge = 'Conjuge';
	case Filho = 'Filho';
	case Pai = 'Pai';
	case Mae = 'Mae';
}

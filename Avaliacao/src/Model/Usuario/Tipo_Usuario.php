<?php
namespace Moobi\Avaliacao\Model\Usuario;

/**
 * Enum ${Tipo_Usuario}
 * @package ${Moobi\Avaliacao\Model\Usuario}
 * @version 1.0.0 Versionamento inicial da classe
 */
enum Tipo_Usuario: string
{
	case Administrador = 'Administrador';
	case Comum = 'Comum';
}

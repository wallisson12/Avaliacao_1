<?php
namespace Moobi\Avaliacao\Model\Usuario;

/**
 * Enum TipoUsuario
 * @package Moobi\Avaliacao\Model\Usuario
 * @version 1.0.0 Versionamento inicial da classe
 */
enum TipoUsuario: string {
	case Administrador = 'Administrador';
	case Comum = 'Comum';
}

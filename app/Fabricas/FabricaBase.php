<?php declare(strict_types=1);
/**
 * Modelo base de uma fábrica de objetos
 */

namespace App\Fabricas;

abstract class FabricaBase {
	private static $idContador = 0;

	/**
	 * Retorna um datetime atual
	 * utils para atribuir à data de criação
	 * @return string
	 */
	protected static function getDatetimeAtual() : string {
		return date('Y-m-d H:i:s');
	}

	/**
	 * Retorna uma nova id, e acrescenta ao contador estático
	 * @return int
	 */
	protected static function getNovoId() : int {
		return self::$idContador++;
	}
}

?>

<?php declare(strict_types=1);
/**
 * Fábrica de Aliancas
 */

namespace App\Fabricas;

use App\Objetos\Alianca;
use App\Objetos\Usuario;
use App\Fabricas\FabricaBase;
use App\Interfaces\FabricaInterface;

abstract class FabricaAlianca extends FabricaBase implements FabricaInterface {
	/**
	 * Retorna um objeto Alianca novo
	 * @param  int          $usuarioId
	 * @param  string       $nome
	 * @return Alianca
	 */
	public static function criar(int $usuarioId = 0, string $nome = '') : Alianca {
		return new Alianca(
			self::getNovoId(),
			self::getDatetimeAtual(),
			$usuarioId,
			$nome
		);
	}
}

?>

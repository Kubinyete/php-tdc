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
	// $contador

	/**
	 * Retorna um objeto Alianca novo
	 * @param  Usuario|null
	 * @param  string       $nome
	 * @return Alianca
	 */
	public static function criar(?Usuario $usuario = null, string $nome = '') : Alianca {
		return new Alianca(
			parent::getNovoId(),
			parent::getDatetimeAtual(),
			$usuario,
			$nome
		);
	}
}

?>

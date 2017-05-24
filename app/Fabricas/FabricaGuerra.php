<?php declare(strict_types=1);
/**
 * Retorna um novo objeto de Guerra
 */

namespace App\Fabricas;

use App\Objetos\Guerra;
use App\Objetos\Alianca;
use App\Fabricas\FabricaBase;
use App\Interfaces\FabricaInterface;

abstract class FabricaGuerra extends FabricaBase implements FabricaInterface {
	// $contador
	
	public static function criar(?Alianca $alianca = null, string $nomeAdversario = '', bool $vitoria = true) : Guerra {
		return new Guerra(
			self::getNovoId(),
			self::getDatetimeAtual(),
			$alianca,
			$nomeAdversario,
			$vitoria
		);
	}
}

?>

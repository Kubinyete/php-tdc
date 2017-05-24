<?php declare(strict_types=1);
/**
 * Fábrica de Grupos
 */

namespace App\Fabricas;

use App\Objetos\Grupo;
use App\Objetos\Alianca;
use App\Fabricas\FabricaBase;
use App\Interfaces\FabricaInterface;

abstract class FabricaGrupo extends FabricaBase implements FabricaInterface {
	// $contador

	public static function criar(?Alianca $alianca = null, ?string $nome = '') : Grupo {
		return new Grupo(
			self::getNovoId(),
			self::getDatetimeAtual(),
			$alianca,
			$nome
		);
	}
}

?>

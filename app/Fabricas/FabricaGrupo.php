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
	/**
	 * Retorna um Grupo novo
	 * @param  int          $aliancaId
	 * @param  string|null  $nome
	 * @return Grupo
	 */
	public static function criar(int $aliancaId = 0, ?string $nome = null) : Grupo {
		return new Grupo(
			self::getNovoId(),
			self::getDatetimeAtual(),
			$aliancaId,
			$nome
		);
	}
}

?>

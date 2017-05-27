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
	/**
	 * Retorna uma nova Guerra
	 * @param  int          $aliancaId        
	 * @param  string       $nomeAdversario 
	 * @param  bool|boolean $vitoria        
	 * @return Guerra                       
	 */
	public static function criar(int $aliancaId = 0, string $nomeAdversario = '', bool $vitoria = true) : Guerra {
		return new Guerra(
			self::getNovoId(),
			self::getDatetimeAtual(),
			$aliancaId,
			$nomeAdversario,
			$vitoria
		);
	}
}

?>

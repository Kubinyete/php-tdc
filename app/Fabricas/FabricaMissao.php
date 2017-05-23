<?php declare(strict_types=1);
/**
 * Responsável pela criação de Missoes
 */

namespace App\Fabricas;

use App\Objetos\Missao;
use App\Objetos\Alianca;
use App\Objetos\Mapa;
use App\Fabricas\FabricaBase;
use App\Interfaces\FabricaInterface;

abstract class FabricaMissao extends FabricaBase implements FabricaInterface {
	// $contador
	
	public static function criar(?Alianca $alianca, ?Mapa $mapa, bool $vitoria = true, int $percentualExplorado = 100) : Missao {
		return new Missao(
			parent::getNovoId(),
			parent::getDatetimeAtual(),
			$alianca,
			$mapa,
			$vitoria,
			$percentualExplorado
		);
	} 
}

?>

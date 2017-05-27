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
	/**
	 * Retorna uma nova Missao
	 * @param  int          $aliancaId             
	 * @param  int          $mapaId                
	 * @param  bool|boolean $vitoria             
	 * @param  int|integer  $percentualExplorado 
	 * @return Missao                            
	 */
	public static function criar(int $aliancaId = 0, int $mapaId = 0, bool $vitoria = true, int $percentualExplorado = 100) : Missao {
		return new Missao(
			self::getNovoId(),
			self::getDatetimeAtual(),
			$aliancaId,
			$mapaId,
			$vitoria,
			$percentualExplorado
		);
	} 
}

?>

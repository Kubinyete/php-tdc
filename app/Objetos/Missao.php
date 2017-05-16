<?php declare(strict_types=1);
/**
 * Classe responsável por representar uma Missão em nossa aplicação
 */

namespace App\Objetos;

use App\Objetos\Objeto;
use App\Objetos\Mapa;
use App\Objetos\Alianca;

final class Missao extends Objeto {
	// $id
	// $dataCriacao
	private $alianca;
	private $mapa;
	private $vitoria;
	private $percentualExplorado;

	public function __construct(int $id, string $dataCriacao, ?Alianca $alianca, ?Mapa $mapa, bool $vitoria, float $percentualExplorado) {
		parent::__construct($id, $dataCriacao);

		$this->setAlianca($alianca);
		$this->setMapa($mapa);
		$this->setVitoria($vitoria);
		$this->setPercentualExplorado($percentualExplorado);
	}

	/**
	 * Getters
	 */
	
	public function getAlianca() : ?Alianca {
		return $this->alianca;
	}

	public function getMapa() : ?Mapa {
		return $this->mapa;
	}

	
	
	/**
	 * Setters
	 */
}

?>
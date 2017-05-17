<?php declare(strict_types=1);
/**
 * Classe responsável por representar uma Missão em nossa aplicação
 */

namespace App\Objetos;

use App\Objetos\Objeto;
use App\Objetos\Mapa;
use App\Objetos\Alianca;

class Missao extends Objeto {
	// $id
	// $dataCriacao
	protected $alianca;
	protected $mapa;
	protected $vitoria;
	protected $percentualExplorado;

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

	public function getVitoria() : bool {
		return $this->vitoria;
	}

	public function getPercentualExplorado() : float {
		return $this->percentualExplorado;
	}
	
	/**
	 * Setters
	 */
	
	public function setAlianca(?Alianca $valor) {
		$this->alianca = $valor;
	}

	public function setMapa(?Mapa $valor) {
		$this->mapa = $valor;
	}

	public function setVitoria(bool $valor) {
		$this->vitoria = $valor;
	}

	public function setPercentualExplorado(float $valor) {
		$this->percentualExplorado = ($valor > 1.0) ? 1.0 : ($valor < 0.0) ? 0.0 : $valor;
	}
}

?>
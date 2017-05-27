<?php declare(strict_types=1);
/**
 * Classe responsável por representar uma Missão em nossa aplicação
 */

namespace App\Objetos;

use App\Objetos\Objeto;

class Missao extends Objeto {
	// $id
	// $dataCriacao
	protected $aliancaId;
	protected $mapaId;
	protected $vitoria;
	protected $percentualExplorado;

	public function __construct(int $id, string $dataCriacao, int $aliancaId, int $mapaId, bool $vitoria, int $percentualExplorado) {
		parent::__construct($id, $dataCriacao);

		$this->setAliancaId($aliancaId);
		$this->setMapaId($mapaId);
		$this->setVitoria($vitoria);
		$this->setPercentualExplorado($percentualExplorado);
	}

	/**
	 * Getters
	 */
	
	public function getAliancaId() : int {
		return $this->aliancaId;
	}

	public function getMapaId() : int {
		return $this->mapaId;
	}

	public function getVitoria() : bool {
		return $this->vitoria;
	}

	public function getPercentualExplorado() : int {
		return $this->percentualExplorado;
	}
	
	/**
	 * Setters
	 */
	
	public function setAliancaId(int $valor) {
		$this->aliancaId = $valor;
	}

	public function setMapaId(int $valor) {
		$this->mapaId = $valor;
	}

	public function setVitoria(bool $valor) {
		$this->vitoria = $valor;
	}

	public function setPercentualExplorado(int $valor) {
		$this->percentualExplorado = (($valor > 100) ? 100 : ($valor < 0) ? 0 : $valor);
	}
}

?>

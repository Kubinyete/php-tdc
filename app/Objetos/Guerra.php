<?php declare(strict_types=1);
/**
 * Classe responsável por representar uma Guerra em nossa aplicação
 */

namespace App\Objetos;

use App\Objetos\Objeto;
use App\Objetos\Alianca;

class Guerra extends Objeto {
	// $id
	// $dataCriacao
	protected $alianca;
	protected $nomeAdversario;
	protected $vitoria;

	public function __construct(int $id, string $dataCriacao, ?Alianca $alianca, string $nomeAdversario, bool $vitoria) {
		parent::__construct($id, $dataCriacao);

		$this->setAlianca($alianca);
		$this->setNomeAdversario($nomeAdversario);
		$this->setVitoria($vitoria);
	}

	/**
	 * Getters
	 */
	
	public function getAlianca() : ?Alianca {
		return $this->alianca;
	}

	public function getNomeAdversario() : string {
		return $this->nomeAdversario;
	}

	public function getVitoria() : bool {
		return $this->vitoria;
	}
	
	/**
	 * Setters
	 */
	
	public function setAlianca(?Alianca $valor) {
		$this->alianca = $valor;
	}

	public function setNomeAdversario(string $valor) {
		$this->nomeAdversario = $valor;
	}

	public function setVitoria(bool $valor) {
		$this->vitoria = $valor;
	}
}

?>
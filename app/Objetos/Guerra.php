<?php declare(strict_types=1);
/**
 * Classe responsável por representar uma Guerra em nossa aplicação
 */

namespace App\Objetos;

use App\Objetos\Objeto;

final class Guerra extends Objeto {
	// $id
	// $dataCriacao
	protected $aliancaId;
	protected $nomeAdversario;
	protected $vitoria;

	public function __construct(int $id, string $dataCriacao, int $aliancaId, string $nomeAdversario, bool $vitoria) {
		parent::__construct($id, $dataCriacao);

		$this->setAliancaId($aliancaId);
		$this->setNomeAdversario($nomeAdversario);
		$this->setVitoria($vitoria);
	}

	/**
	 * Getters
	 */
	
	public function getAliancaId() : int {
		return $this->aliancaId;
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
	
	public function setAliancaId(int $valor) {
		$this->aliancaId = $valor;
	}

	public function setNomeAdversario(string $valor) {
		$this->nomeAdversario = $valor;
	}

	public function setVitoria(bool $valor) {
		$this->vitoria = $valor;
	}
}

?>

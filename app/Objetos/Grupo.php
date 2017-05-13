<?php declare(strict_types=1);
/**
 * Classe responsável por representar um Grupo de jogadores em uma Aliança
 */

namespace App\Objetos;

use App\Objetos\Objeto;
use App\Objetos\Alianca;

class Grupo extends Objeto {
	// $id
	// $dataCriacao
	private $nome;
	private $alianca;

	public function __construct(int $id, string $dataCriacao, ?Alianca $alianca, string $nome) {
		parent::__construct($id, $dataCriacao);

		$this->setAlianca($alianca);
		$this->setNome($nome);
	}

	/**
	 * Getters
	 */

	public function getNome() : string {
		return $this->nome;
	}
	
	public function getAlianca() : ?Alianca {
		return $this->alianca;
	}

	/**
	 * Setters
	 */

	public function setNome(string $valor) {
		$this->nome = $valor;
	}
	
	public function setAlianca(?Alianca $valor) {
		$this->alianca = $valor;
	}
}

?>
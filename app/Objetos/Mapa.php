<?php declare(strict_types=1);
/**
 * Classe responsável por representar um Mapa em nossa aplicação
 */

namespace App\Objetos;

use App\Objetos\Objeto;

class Mapa extends Objeto {
	// $id
	// $dataCriacao
	private $nome;

	public function __construct(int $id, string $dataCriacao, string $nome) {
		parent::__construct($id, $dataCriacao);

		$this->setNome($nome);
	}

	/**
	 * Getters
	 */

	public function getNome() : string {
		return $this->nome;
	}

	/**
	 * Setters
	 */
	
	public function setNome(string $valor) {
		$this->nome = $valor;
	}
}

?>
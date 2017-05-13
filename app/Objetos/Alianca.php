<?php declare(strict_types=1);
/**
 * Classe responsável por representar uma Aliança em nossa aplicação.
 */

namespace App\Objetos;

use App\Objetos\Objeto;

class Alianca extends Objeto {
	// $id
	// $dataCriacao
	private $nome;

	public function __construct(int $id, string $dataCriacao, string $nome) {
		parent::__construct($id, $dataCriacao);

		$this->setNome($nome);
	}

	public function getNome() : string { return $this->nome; }
	
	public function setNome(string $valor) { $this->nome = $valor; }
}

?>
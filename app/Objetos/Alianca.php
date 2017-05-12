<?php
/**
 * Classe responsável por representar uma Aliança em nossa aplicação.
 */

namespace App\Objetos;

use App\Objetos\Objeto;

class Alianca extends Objeto {
	// $id
	// $dataCriacao
	private $nome;

	public function __construct($id, $dataCriacao, $nome) {
		parent::__construct($id, $dataCriacao);

		$this->setNome($nome);
	}

	public function getNome() { return $this->nome; }
	
	public function setNome($valor) { $this->nome = $valor; }
}

?>
<?php
/**
 * Classe responsável por representar um Objeto mestre, base de todos os outros objetos em nossa aplicação.
 */

namespace App\Objetos;

class Objeto {
	private $id;
	private $dataCriacao;

	public function __construct($id, $dataCriacao) {
		$this->setId($id);
		$this->setDataCriacao($dataCriacao);
	}

	public function getId() { return $this->id; }
	public function getDataCriacao { return $this->dataCriacao; }

	public function setId($valor) { $this->id = $valor; }
	public function setDataCriacao($valor) { $this->dataCriacao = $valor; }
}

?>
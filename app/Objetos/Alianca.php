<?php declare(strict_types=1);
/**
 * Classe responsável por representar uma Aliança em nossa aplicação.
 */

namespace App\Objetos;

use App\Objetos\Objeto;
use App\Objetos\Usuario;

class Alianca extends Objeto {
	// $id
	// $dataCriacao
	protected $nome;
	protected $usuario;

	public function __construct(int $id, string $dataCriacao, ?Usuario $usuario, string $nome) {
		parent::__construct($id, $dataCriacao);

		$this->setNome($nome);
		$this->setUsuario($usuario);
	}

	/**
	 * Getters
	 */

	public function getNome() : string {
		return $this->nome;
	}

	public function getUsuario() : ?Usuario {
		return $this->usuario;
	}
	
	/**
	 * Setters
	 */

	public function setNome(string $valor) {
		$this->nome = $valor;
	}

	public function setUsuario(?Usuario $valor) {
		$this->usuario = $valor;
	}
}

?>
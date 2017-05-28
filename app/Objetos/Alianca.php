<?php declare(strict_types=1);
/**
 * Classe responsável por representar uma Aliança em nossa aplicação.
 */

namespace App\Objetos;

use App\Objetos\Objeto;

final class Alianca extends Objeto {
	// $id
	// $dataCriacao
	protected $nome;
	protected $usuarioId;

	public function __construct(int $id, string $dataCriacao, int $usuarioId, string $nome) {
		parent::__construct($id, $dataCriacao);

		$this->setNome($nome);
		$this->setUsuarioId($usuarioId);
	}

	/**
	 * Getters
	 */

	public function getNome() : string {
		return $this->nome;
	}

	public function getUsuarioId() : int {
		return $this->usuarioId;
	}
	
	/**
	 * Setters
	 */

	public function setNome(string $valor) {
		$this->nome = $valor;
	}

	public function setUsuarioId(int $valor) {
		$this->usuarioId = $valor;
	}
}

?>

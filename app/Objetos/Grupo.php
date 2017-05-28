<?php declare(strict_types=1);
/**
 * Classe responsável por representar um Grupo de jogadores em uma Aliança
 */

namespace App\Objetos;

use App\Objetos\Objeto;

final class Grupo extends Objeto {
	// $id
	// $dataCriacao
	protected $nome;
	protected $aliancaId;

	public function __construct(int $id, string $dataCriacao, int $aliancaId, ?string $nome) {
		parent::__construct($id, $dataCriacao);

		$this->setAliancaId($aliancaId);
		$this->setNome($nome);
	}

	/**
	 * Getters
	 */

	public function getNome() : ?string {
		return $this->nome;
	}
	
	public function getAliancaId() : int {
		return $this->aliancaId;
	}

	/**
	 * Setters
	 */

	public function setNome(?string $valor) {
		$this->nome = $valor;
	}
	
	public function setAliancaId(int $valor) {
		$this->aliancaId = $valor;
	}
}

?>

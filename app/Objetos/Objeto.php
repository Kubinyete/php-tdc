<?php declare(strict_types=1);
/**
 * Classe responsável por representar um Objeto mestre, base de todos os outros objetos em nossa aplicação.
 */

namespace App\Objetos;

use App\Uteis\Uteis;

abstract class Objeto {
	protected $id;
	protected $dataCriacao;

	public function __construct(int $id, string $dataCriacao) {
		$this->setId($id);
		$this->setDataCriacao($dataCriacao);
	}

	/**
	 * Getters
	 */

	public function getId() : int {
		return $this->id;
	}

	public function getDataCriacao(bool $formatar = false) : string {
		return ($formatar) ? self::formatarDataAmigavel($this->dataCriacao) : $this->dataCriacao;
	}

	/**
	 * Setters
	 */

	public function setId(int $valor) {
		$this->id = $valor;
	}
	
	public function setDataCriacao(string $valor){
		$this->dataCriacao = $valor;
	}

	public function __toString() : string {
		return print_r($this, true);
	}

	/**
	 * Funções
	 */
	
	private static function formatarDataAmigavel(string $data) : string {
		$itens = explode(' ', $data);
		$data = implode(' às ', $itens);

		return $data;
	}
}

?>

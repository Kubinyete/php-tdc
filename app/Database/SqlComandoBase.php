<?php declare(strict_types=1);
/**
 * Classe base responsável por atribuir as características padrões de um objeto SqlComando
 */

namespace App\Database;

abstract class SqlComandoBase {
	protected $textoComando;

	public function __construct(?string $sqlComando) {
		$this->setTextoComando($sqlComando);
	}

	/**
	 * Getters
	 */
	
	public function getTextoComando() : string {
		return $this->textoComando;
	}
	
	/**
	 * Setters
	 */
	
	public function setTextoComando(?string $valor) {
		$this->textoComando = ($valor !== null) ? $valor : ''; 
	}

	/**
	 * Funções
	 */

	/**
	 * Chama uma função passando como argumento o próprio objeto
	 * @param  callable $funcao
	 * @return SqlComando
	 */
	public function then(callable $funcao) {
		$funcao($this);

		return $this;
	}

	public function toString() {
		echo '<h1>'.
			'SqlComando::toString()'.
		'</h1>'.
		'<p>'.
			$this->textoComando.
		'</p>';
	}
}

?>
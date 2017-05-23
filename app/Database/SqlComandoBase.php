<?php declare(strict_types=1);
/**
 * Classe base responsável por atribuir as características padrões de um objeto SqlComando
 */

namespace App\Database;

use App\Database\SqlComando;

abstract class SqlComandoBase {
	protected $textoComando;

	public function __construct(?string $sqlComando = null) {
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
		$this->textoComando = $valor ?? '';
	}

	/**
	 * Funções
	 */

	/**
	 * Concatena a string sql atual com o valor passado
	 * @param  string $valor
	 */
	public function acrescentarTextoComando(string $valor) {
		$this->textoComando .= $valor;
	}

	/**
	 * Chama uma função passando como argumento o próprio objeto
	 * @param  callable $funcao
	 * @return SqlComando
	 */
	public function then(callable $funcao) : SqlComando {
		$funcao($this);

		return $this;
	}

	public function __toString() : string {
		return '<h1>'.
			'SqlComandoBase::__toString()'.
		'</h1>'.
		'<p>'.
			$this->textoComando.
		'</p>'.
		'<pre>'.
			print_r($this, true).
		'</pre>';
	}
}

?>

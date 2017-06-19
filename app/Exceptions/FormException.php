<?php declare(strict_types=1);
/**
 * Uma Exception utilizada para validação de formulário
 */

namespace App\Exceptions;

use \Exception;

class FormException extends Exception {
	protected $erros;

	/**
	 * Cria uma FormException utilizando um array de erros com chave & valor
	 * @param array $erros
	 */
	public function __construct(?array $erros = null) {
		$this->erros = [];
		
		if ($erros !== null)
			$this->adicionarErros($erros);
	}

	/**
	 * Adiciona um array de chave & valor ao nosso array de erros de formulário
	 * @param  array  $erros
	 */
	public function adicionarErros(array $erros) {
		foreach ($erros as $key => $value) {
			$this->erros[$key] = $value;
		}
	}

	/**
	 * Retorna a chave desejada
	 * @param  string $chave
	 * @return mixed|null
	 */
	public function obter(string $chave) {
		return $this->erros[$chave] ?? null;
	}

	/**
	 * Retorna se já ocorreram erros neste formulário
	 * @return bool
	 */
	public function ocorreuErro() : bool {
		return count($this->erros) > 0;
	}
}

?>
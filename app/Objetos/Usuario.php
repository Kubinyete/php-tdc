<?php declare(strict_types=1);
/**
 * Classe responsável por representar um Usuário em nossa aplicação
 */

namespace App\Objetos;

use App\Objetos\Objeto;

class Usuario extends Objeto {
	// $id
	// $dataCriacao
	protected $login;
	protected $senha;
	protected $hash_senha;

	public function __construct(int $id, string $dataCriacao, string $login, string $senha, bool $criarHash = false) {
		parent::__construct($id, $dataCriacao);

		$this->setLogin($login);
		$this->setSenha($senha, $criarHash);
	}

	/**
	 * Getters
	 */

	public function getLogin() : string {
		return $this->login;
	}

	public function getSenha() : string {
		return $this->senha;
	}

	public function getHashSenha() : ?string {
		return $this->hash_senha;
	}

	/**
	 * Setters
	 */
	
	public function setLogin(string $valor) {
		$this->login = $valor;
	}

	public function setSenha(string $valor, bool $criarHash = false) {
		$this->senha = $valor;
		// TODO: Obter o algoritmo de hash através de um arquivo de configurações,
		// facilitando a troca do algoritmo de hash futuramente sem precisar modificar o código fonte
		($criarHash) ? $this->hash_senha = hash('sha256', $valor);
	}
}

?>
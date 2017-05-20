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
	protected $nickname;

	public function __construct(int $id, string $dataCriacao, string $login, string $senha, string $nickname, bool $criarHash = true, string $algoritmoHash = null) {
		parent::__construct($id, $dataCriacao);

		$this->setLogin($login);
		$this->setSenha($senha, $criarHash, $algoritmoHash);
		$this->setNickname($nickname);
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

	public function getNickname() : string {
		return $this->nickname;
	}

	/**
	 * Setters
	 */
	
	public function setLogin(string $valor) {
		$this->login = $valor;
	}

	public function setSenha(string $valor, bool $criarHash = true, ?string $algoritmoHash = null) {
		$this->senha = $valor;
		
		if ($criarHash)
			$this->hash_senha = hash($algoritmoHash ?? 'sha256', $valor);
	}

	public function setNickname(string $valor) {
		$this->nickname = $valor;
	}
}

?>
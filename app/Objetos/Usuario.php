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

	protected $hashSenha;
	protected $hashAlgoritmo;

	public function __construct(int $id, string $dataCriacao, string $login, string $senha, ?string $hashAlgoritmo = null) {
		parent::__construct($id, $dataCriacao);

		$this->hashAlgoritmo = $hashAlgoritmo;

		$this->setLogin($login);
		$this->setSenha($senha);
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

	public function getHashSenha() : string {
		return $this->hashSenha;
	}

	/**
	 * Setters
	 */
	
	public function setLogin(string $valor) {
		$this->login = $valor;
	}


	public function setSenha(string $valor) {
		$this->senha = $valor;

		// Se temos um algoritmo de hash informado, vamos assumir que queremos transforamar a senha
		// cru em uma hash que pode ser obtida atrabés do getHashSenha(), se não for informado um
		// algoritmo, vamos então assumir que a senha obtida ja está em forma de hash, então apenas
		// copie seu valor para ser obtido atrabés do getHashSenha()
		$this->hashSenha = ($this->hashAlgoritmo !== null) ? hash($this->hashAlgoritmo, $valor) : $valor;
	}
}

?>

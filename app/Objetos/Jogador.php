<?php declare(strict_types=1);
/**
 * Classe responsável por representar um Jogador em nossa aplicação
 */

namespace App\Objetos;

use App\Objetos\Objeto;
use App\Objetos\Alianca;

class Jogador extends Objeto {
	// $id
	// $dataCriacao
	protected $alianca;
	protected $nome;
	protected $nickname;
	protected $nivel;
	protected $telefone;
	protected $email;
	protected $tipo;
	protected $status;
	protected $observacoes;

	public function __construct(int $id, string $dataCriacao, ?Alianca $alianca, ?string $nome, string $nickname, int $nivel, ?string $telefone, string $email, int $tipo, bool $status, ?string $observacoes) {
		parent::__construct($id, $dataCriacao);

		$this->setAlianca($alianca);
		$this->setNome($nome);
		$this->setNickname($nickname);
		$this->setNivel($nivel);
		$this->setTelefone($telefone);
		$this->setEmail($email);
		$this->setTipo($tipo);
		$this->setStatus($status);
		$this->setObservacoes($observacoes);
	}

	/**
	 * Getters
	 */

	public function getAlianca() : ?Alianca {
		return $this->alianca;
	}
	
	public function getNome() : ?string {
		return $this->nome;
	}
	
	public function getNickname() : string {
		return $this->nickname;
	}

	public function getNivel() : int {
		return $this->nivel;
	}

	public function getTelefone() : ?string {
		return $this->telefone;
	}

	public function getEmail() : string {
		return $this->email;
	}

	public function getTipo() : int {
		return $this->tipo;
	}

	public function getStatus() : bool {
		return $this->status;
	}

	public function getObservacoes() : ?string {
		return $this->observacoes;
	}

	/**
	 * Setters
	 */
	
	public function setAlianca(?Alianca $valor) {
		$this->alianca = $valor;
	}

	public function setNome(?string $valor) {
		$this->nome = $valor;
	}

	public function setNickname(string $valor) {
		$this->nickname = $valor;
	}

	public function setNivel(int $valor) {
		$this->nivel = $valor;
	}

	public function setTelefone(?string $valor) {
		$this->telefone = $valor;
	}

	public function setEmail(string $valor) {
		$this->email = $valor;
	}

	public function setTipo(int $valor) {
		$this->tipo = $valor;
	}

	public function setStatus(bool $valor) {
		$this->status = $valor;
	}

	public function setObservacoes(?string $valor) {
		$this->observacoes = $valor;
	}
}

?>
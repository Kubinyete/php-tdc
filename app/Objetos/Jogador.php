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

	public function __construct(int $id, string $dataCriacao, ?Alianca $alianca, string $nome, string $nickname, int $nivel, string $telefone, string $email, int $tipo, bool $status, string $observacoes) {
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
	
	public function getNome() : string {
		return $this->nome;
	}
	
	public function getNickname() : string {
		return $this->nickname;
	}

	/**
	 * Setters
	 */
}

?>
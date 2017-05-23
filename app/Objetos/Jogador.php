<?php declare(strict_types=1);
/**
 * Classe responsável por representar um Jogador em nossa aplicação
 */

namespace App\Objetos;

use App\Objetos\Objeto;
use App\Objetos\Alianca;
use App\Objetos\Grupo;
use App\Objetos\Missao;
use App\Objetos\Guerra;

class Jogador extends Objeto {
	// $id
	// $dataCriacao
	protected $alianca;
	protected $grupo;
	protected $nome;
	protected $nickname;
	protected $nivel;
	protected $telefone;
	protected $email;
	protected $tipo;
	protected $status;
	protected $observacoes;
	protected $dataAdicionado;
	protected $missao;
	protected $guerra;
	protected $pontuacao;

	public function __construct(int $id, string $dataCriacao, ?Alianca $alianca, ?Grupo $grupo, string $dataAdicionado, ?Missao $missao, ?Guerra $guerra, int $pontuacao, ?string $nome, string $nickname, int $nivel, ?string $telefone, string $email, int $tipo, bool $status, ?string $observacoes) {
		parent::__construct($id, $dataCriacao);

		$this->setAlianca($alianca);
		$this->setGrupo($grupo);
		$this->setNome($nome);
		$this->setNickname($nickname);
		$this->setNivel($nivel);
		$this->setTelefone($telefone);
		$this->setEmail($email);
		$this->setTipo($tipo);
		$this->setStatus($status);
		$this->setObservacoes($observacoes);
		$this->setDataAdicionado($dataAdicionado);
		$this->setMissao($missao);
		$this->setGuerra($guerra);
		$this->setPontuacao($pontuacao);
	}

	/**
	 * Getters
	 */

	public function getAlianca() : ?Alianca {
		return $this->alianca;
	}

	public function getGrupo() : ?Grupo {
		return $this->grupo;
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

	public function getDataAdicionado() : string {
		return $this->dataAdicionado;
	}

	public function getMissao() : ?Missao {
		return $this->missao;
	}

	public function getGuerra() : ?Guerra {
		return $this->guerra;
	}

	public function getPontuacao() : int {
		return $this->pontuacao;
	}

	/**
	 * Setters
	 */
	
	public function setAlianca(?Alianca $valor) {
		$this->alianca = $valor;
	}

	public function setGrupo(?Grupo $valor) {
		$this->grupo = $valor;
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

	public function setDataAdicionado(string $valor) {
		$this->dataAdicionado = $valor;
	}

	public function setMissao(?Missao $valor) {
		$this->missao = $valor;
	}

	public function setGuerra(?Guerra $valor) {
		$this->guerra = $valor;
	}

	public function setPontuacao(int $valor) {
		$this->pontuacao = ($valor < 0) ? 0 : $valor;
	}
}

?>

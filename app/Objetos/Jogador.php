<?php declare(strict_types=1);
/**
 * Classe responsável por representar um Jogador em nossa aplicação
 */

namespace App\Objetos;

use App\Objetos\Objeto;

final class Jogador extends Objeto {
	// $id
	// $dataCriacao
	protected $aliancaId;
	protected $grupoId;
	protected $nome;
	protected $nickname;
	protected $nivel;
	protected $telefone;
	protected $email;
	protected $tipo;
	protected $status;
	protected $observacoes;
	protected $dataAdicionado;
	protected $missaoId;
	protected $guerraId;
	protected $pontuacao;

	public function __construct(int $id, string $dataCriacao, int $aliancaId, int $grupoId, string $dataAdicionado, int $missaoId, int $guerraId, int $pontuacao, ?string $nome, string $nickname, int $nivel, ?string $telefone, string $email, int $tipo, bool $status, ?string $observacoes) {
		parent::__construct($id, $dataCriacao);

		$this->setAliancaId($alianca);
		$this->setGrupoId($grupo);
		$this->setNome($nome);
		$this->setNickname($nickname);
		$this->setNivel($nivel);
		$this->setTelefone($telefone);
		$this->setEmail($email);
		$this->setTipo($tipo);
		$this->setStatus($status);
		$this->setObservacoes($observacoes);
		$this->setDataAdicionado($dataAdicionado);
		$this->setMissaoId($missao);
		$this->setGuerraId($guerra);
		$this->setPontuacao($pontuacao);
	}

	/**
	 * Getters
	 */

	public function getAliancaId() : int {
		return $this->aliancaId;
	}

	public function getGrupoId() : int {
		return $this->grupoId;
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

	public function getMissaoId() : int {
		return $this->missaoId;
	}

	public function getGuerraId() : int {
		return $this->guerraId;
	}

	public function getPontuacao() : int {
		return $this->pontuacao;
	}

	/**
	 * Setters
	 */
	
	public function setAliancaId(int $valor) {
		$this->aliancaId = $valor;
	}

	public function setGrupoId(int $valor) {
		$this->grupoId = $valor;
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

	public function setMissaoId(int $valor) {
		$this->missaoId = $valor;
	}

	public function setGuerraId(int $valor) {
		$this->guerraId = $valor;
	}

	public function setPontuacao(int $valor) {
		$this->pontuacao = ($valor < 0) ? 0 : $valor;
	}
}

?>

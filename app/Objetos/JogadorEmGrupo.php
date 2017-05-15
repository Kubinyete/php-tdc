<?php declare(strict_types=1);
/**
 * Classe responsável por representar um JogadorEmGrupo, com uma DataAdicionavel
 * Obs: Veja a tabela SQL JogadoresEmGrupo
 */

namespace App\Objetos;

use App\Objetos\Jogador;
use App\Objetos\Alianca;
use App\Objetos\Grupo;

final class JogadorEmGrupo extends Jogador {
	// $id
	// $dataCriacao
	// $alianca;
	// $nome;
	// $nickname;
	// $nivel;
	// $telefone;
	// $email;
	// $tipo;
	// $status;
	// $observacoes;
	private $dataAdicionado;
	private $grupo;

	public function __construct(int $id, string $dataCriacao, ?Alianca $alianca, ?Grupo $grupo, ?string $nome, string $nickname, int $nivel, ?string $telefone, string $email, int $tipo, bool $status, ?string $observacoes, string $dataAdicionado) {
		parent::__construct($id, $dataCriacao, $alianca, $nome, $nickname, $nivel, $telefone, $email, $tipo, $status, $observacoes);

		$this->setDataAdicionado($dataAdicionado);
		$this->setGrupo($grupo);
	}

	/**
	 * Getters
	 */

	public function getDataAdicionado() : string {
		return $this->dataAdicionado;
	}

	public function getGrupo() : ?Grupo {
		return $this->grupo;
	}

	/**
	 * Setters
	 */

	public function setDataAdicionado(string $valor) {
		$this->dataAdicionado = $valor;
	}

	public function setGrupo(?Grupo $valor) {
		$this->grupo = $valor;
	}
}

?>
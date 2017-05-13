<?php declare(strict_types=1);
/**
 * Classe responsável por representar um JogadorEmGrupo, com uma DataAdicionavel
 * Obs: Veja a tabela SQL JogadoresEmGrupo
 */

namespace App\Objetos;

use App\Objetos\Jogador;
use App\Objetos\iDataAdicionavel;

final class JogadorEmGrupo extends Jogador implements iDataAdicionavel {
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

	public function __construct(int $id, string $dataCriacao, ?Alianca $alianca, ?string $nome, string $nickname, int $nivel, ?string $telefone, string $email, int $tipo, bool $status, ?string $observacoes, string $dataAdicionado) {
		parent::__construct($id, $dataCriacao, $alianca, $nome, $nickname, $nivel, $telefone, $email, $tipo, $status, $observacoes);

		$this->setDataAdicionado($dataAdicionado);
	}

	/**
	 * Getters
	 */

	public function getDataAdicionado() : string {
		return $this->dataAdicionado;
	}

	/**
	 * Setters
	 */

	public function setDataAdicionado(string $valor) {
		$this->dataAdicionado = $valor;
	}
}

?>
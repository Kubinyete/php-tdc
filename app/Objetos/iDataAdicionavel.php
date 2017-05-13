<?php declare(strict_types=1);
/**
 * Interface responsável por encaixar os métodos de get & set para uma data adicionavel
 * Ex: Tabela de JogadoresEmGrupos
 */

namespace App\Objetos;

interface iDataAdicionavel {
	public function getDataAdicionado() : string;

	public function setDataAdicionado(string $valor);
}

?>
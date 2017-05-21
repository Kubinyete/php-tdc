<?php declare(strict_types=1);
/**
 * Interface responsável por representar os acessos ao banco de dados CRUD
 * Criar        criar
 * Ler          obter
 * Atualizar    atualizar
 * Deletar      deletar
 */

namespace App\Database;

use App\Objetos\Objeto;

interface iDalCrud {
	public function criar(Objeto $objeto) : bool;

	public function obter(int $id) : ?Objeto;

	public function atualizar(Objeto $objeto) : bool;

	public function deletar(Objeto $objeto) : bool;
}

?>
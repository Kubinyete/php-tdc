<?php declare(strict_types=1);
/**
 * Interface responsável por representar os acessos ao banco de dados CRUD
 * Criar        criar
 * Ler          obter
 * Atualizar    atualizar
 * Deletar      deletar
 */

namespace App\Interfaces;

interface CrudInterface {
	// Cria um objeto no banco de dados
	public function criar($objeto) : bool;

	// Retorna um objeto do banco de dados
	public function obter(int $id);

	// Atualiza um objeto no banco de dados
	public function atualizar($objeto) : bool;

	// Deleta um objeto do banco de dados
	public function deletar($objeto) : bool;
}

?>

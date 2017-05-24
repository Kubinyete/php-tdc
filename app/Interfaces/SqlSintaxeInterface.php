<?php declare(strict_types=1);
/**
 * Interface responsável por ditar as funções necessárias em um SqlComando
 */

namespace App\Interfaces;

use App\Database\SqlComando;

interface SqlSintaxeInterface {
	public function select() : SqlComando;

	public function from(string $tabela) : SqlComando;

	public function where(string $attr, string $expr, ?string $alvo) : SqlComando;

	public function semicolon() : SqlComando;

	public function insert(string $tabela, array $atributosEValores) : SqlComando;

	public function update(string $tabela, array $atributosEValores) : SqlComando;

	public function delete(string $tabela) : SqlComando;

	public function order(string $atributo) : SqlComando;

	public function as(string $apelido) : SqlComando;

	public function or() : SqlComando;

	public function and() : SqlComando;

	public function expr(string $attr, string $expr, ?string $alvo) : SqlComando;

	public function like(string $likeExpr) : SqlComando;

	public function limit(int $numero) : SqlComando;
}

?>

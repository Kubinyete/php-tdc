<?php declare(strict_types=1);
/**
 * Interface responsável por ditar as funções necessárias em um SqlComando
 */

namespace App\Database;

use App\Database\SqlComando;

interface iSqlSintaxe {
	// Deve retornar uma string filtrada, sem escape strings
	protected static function filtrarString(string $texto) : string;

	// Deve traduzir um tipo (Ex: true, false, null, string)
	// para (Ex: '1', '0', 'NULL', 'Lorem Ipsum')
	protected static function traduzirTipo($tipo) : string;


	public function select(string $attr = '*') : SqlComando;

	public function from(string $tabela) : SqlComando;

	public function where(string $attr, string $expr, ?string $alvo) : SqlComando;

	public function semicolon() : SqlComando;

	public function insert(string $tabela, array $atributosEValores) : SqlComando;

	public function update(string $tabela, array $atributosEValores) : SqlComando;

	public function delete(string $tabela) : SqlComando;

	public function order(string $atributo, bool $crescente = true) : SqlComando;

	public function as(string $apelido) : SqlComando;

	public function or() : SqlComando;

	public function and() : SqlComando;

	public function expr(string $attr, string $expr, ?string $alvo) : SqlComando;

	public function limit(int $numero) : SqlComando;
}

?>
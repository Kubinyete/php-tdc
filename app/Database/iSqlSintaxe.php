<?php declare(strict_types=1);
/**
 * Interface responsável por ditar as funções necessárias em um SqlComando
 */

namespace App\Database;

interface iSqlSintaxe {
	protected static function filtrarString(string $texto);

	public function select(string $attr = '*');

	public function from(string $tabela);

	public function where(string $attr, string $expr, ?string $alvo);

	public function semicolon();

	public function insert(string $tabela, array $atributosEValores);

	public function update(string $tabela, array $atributosEValores);

	public function delete(string $tabela);

	public function order(string $atributo, string $ordem);

	public function as(string $apelido);

	public function or();

	public function and();

	public function expr(string $attr, string $expr, ?string $alvo);

	public function limit(int $numero);
}

?>
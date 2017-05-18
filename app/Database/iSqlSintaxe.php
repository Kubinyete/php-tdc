<?php declare(strict_types=1);
/**
 * Interface responsável por ditar as funções necessárias em um SqlComando
 */

namespace App\Database;

interface iSqlSintaxe {
	public function select(string $attr = '*');

	public function from(string $tabela);

	public function where(string $attr, string $expr, ?string $alvo);
}

?>
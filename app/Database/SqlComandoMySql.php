<?php declare(strict_types=1);
/**
 * Classse responsável por representar um SqlComando utilizado pelas camadas de acesso ao banco de dados
 * Sintaxe -> MySQL
 */

namespace App\Database;

use App\Database\SqlComandoBase;
use App\Database\iSqlSintaxe;

abstract class SqlComandoMySql extends SqlComandoBase implements iSqlSintaxe {
	// $textoComando
	protected const SQL_STR_DELIMITADOR = "'";

	/**
	 * Implementação da interface
	 * Em: MySQL
	 */

	/**
	 * Filtra uma string em um comando SQL
	 * se a mesma conter um SQL_STR_DELIMITADOR
	 * @param  string $texto
	 * @return string
	 */
	protected static function filtrarString(string $texto) {
		return str_replace(self::SQL_STR_DELIMITADOR, self::SQL_STR_DELIMITADOR.self::SQL_STR_DELIMITADOR, $texto);
	}

	/**
	 * Equivalente ao comando SELECT tabela
	 * @param  string $attr
	 * @return SqlComando
	 */
	public function select(string $attr = '*')
	{
		$this->textoComando .= 'SELECT '.$attr.' ';

		return $this; 
	}

	/**
	 * Equivalente ao comando FROM tabela
	 * @param  string $tabela
	 * @return SqlComando
	 */
	public function from(string $tabela) {
		$this->textoComando .= 'FROM '.$tabela.' ';

		return $this;
	}

	/**
	 * Equivalente ao comando WHERE atributo operador alvo
	 * @param  string $attr 
	 * @param  string $expr 
	 * @param  string $alvo
	 * @param  bool   $filtrarAlvo 
	 * @return SqlComando
	 */
	public function where(string $attr, string $expr, ?string $alvo, bool $filtrarAlvo = true) {
		$this->textoComando .= 'WHERE '.$attr.$expr.(($alvo !== null) ? (($filtrarAlvo) ? self::filtrarString($alvo) : $alvo) : 'NULL').' ';

		return $this; 
	}

	/**
	 * Adiciona um ; (seperador de comandos) ao comando SQL
	 * @return SqlComando
	 */
	public function semicolon() {
		$this->textoComando .= '; ';

		return $this; 
	}

	public function insert(string $tabela, array $atributosEValores) {
		// TODO
	}
}

?>
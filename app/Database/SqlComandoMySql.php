<?php declare(strict_types=1);
/**
 * Classse responsável por representar um SqlComando utilizado pelas camadas de acesso ao banco de dados
 * Sintaxe -> MySQL
 */

namespace App\Database;

use App\Database\SqlComandoBase;
use App\Database\iSqlSintaxe;
use App\Database\SqlComando;

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
	protected static function filtrarString(string $texto) : string {
		return str_replace(self::SQL_STR_DELIMITADOR, self::SQL_STR_DELIMITADOR.self::SQL_STR_DELIMITADOR, $texto);
	}

	/**
	 * Traduz o tipo informado para suas respectivas formas em SQL,
	 * se o mesmo ja for uma string, filtre ela.
	 * @param  mixed  $tipo
	 * @param  boolean $filtrarCasoString
	 * @return string
	 */
	protected static function traduzirTipo($tipo, $filtrarCasoString = true) : string {
		switch ($tipo) {
			case true:
				return '1';
			case false:
				return '0';
			case null:
				return 'NULL';
			default:
				if ($filtrarCasoString)
					return self::SQL_STR_DELIMITADOR.self::filtrarString(strval($texto)).self::SQL_STR_DELIMITADOR;
				else
					return strval($tipo);
		}
	}

	/**
	 * Equivalente ao comando SELECT atributo
	 * @param  string $attr
	 * @return SqlComando
	 */
	public function select(string $attr = '*') : SqlComando {
		$this->textoComando .= 'SELECT '.$attr.' ';

		return $this; 
	}

	/**
	 * Equivalente ao comando FROM tabela
	 * @param  string $tabela
	 * @return SqlComando
	 */
	public function from(string $tabela) : SqlComando {
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
	public function where(string $attr, string $expr, ?string $alvo, bool $filtrarAlvo = true) : SqlComando {
		$this->textoComando .= 'WHERE '.$attr.$expr.(($alvo !== null) ? (($filtrarAlvo) ? self::filtrarString($alvo) : $alvo) : 'NULL').' ';

		return $this; 
	}

	/**
	 * Adiciona um ; (seperador de comandos) ao comando SQL
	 * @return SqlComando
	 */
	public function semicolon() : SqlComando {
		$this->textoComando .= '; ';

		return $this; 
	}

	/**
	 * Equivalente ao comando INSERT INTO Tabela(attr, attr2) VALUES('attr', 'attr2') 
	 * @param  string $tabela
	 * @param  array  $atributosEValores
	 * @return SqlComando
	 */
	public function insert(string $tabela, array $atributosEValores) : SqlComando {
		// Recebe a contagem de atributosEValores
		// se o tamanho dele não for suficiente para completar a operação
		// retorne uma Exception;
		$e = count($atributosEValores);

		if ($e <= 0)
			return false;

		$cmd = 'INSERT INTO '.$tabela;
		$atributos = '(';
		$valores = ' VALUES(';

		$i = 0;
		foreach ($atributosEValores as $atributo => $valor) {
			$ultimo = ($i >= $e - 1);

			$atributos .= $atributo.(($ultimo) ? ') ' : ', ');
			$valores .= self::traduzirTipo($valor).(($ultimo) ? ') ' : ', ');

			$i++;
		}

		// = INSERT INTO Tabela(attr, attr2) VALUES(1, 2) 
		$this->textoComando .= $cmd.$atributos.$valores;

		return $this;
	}
}

?>
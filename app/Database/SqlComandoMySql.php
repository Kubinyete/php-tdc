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
	private const SQL_STR_DELIMITADOR = "'";
	private const SQL_TIP0_TRUE = '1';
	private const SQL_TIP0_FALSE = '0';
	private const SQL_TIP0_NULL = 'NULL';

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
	private static function filtrarString(string $texto) : string {
		return str_replace(self::SQL_STR_DELIMITADOR, self::SQL_STR_DELIMITADOR.self::SQL_STR_DELIMITADOR, $texto);
	}

	/**
	 * Traduz o tipo informado para suas respectivas formas em SQL,
	 * se o mesmo ja for uma string, filtre ela.
	 * @param  mixed  $tipo
	 * @param  boolean $filtrarCasoString
	 * @return string
	 */
	private static function traduzirTipo($tipo, $filtrarCasoString = true) : string {
		switch ($tipo) {
			case true:
				return self::SQL_TIP0_TRUE;
			case false:
				return self::SQL_TIP0_FALSE;
			case null:
				return self::SQL_TIP0_NULL;
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
		$this->acrescentarTextoComando('SELECT '.$attr.' ');

		return $this; 
	}

	/**
	 * Equivalente ao comando FROM tabela
	 * @param  string $tabela
	 * @return SqlComando
	 */
	public function from(string $tabela) : SqlComando {
		$this->acrescentarTextoComando('FROM '.$tabela.' ');

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
		$this->acrescentarTextoComando('WHERE ');

		return $this->expr($attr, $expr, $alvo, $filtrarAlvo);
	}

	/**
	 * Adiciona um ; (seperador de comandos) ao comando SQL
	 * @return SqlComando
	 */
	public function semicolon() : SqlComando {
		$this->acrescentarTextoComando('; ');

		return $this; 
	}

	/**
	 * Equivalente ao comando INSERT INTO Tabela(attr, attr2) VALUES('attr', 'attr2') 
	 * @param  string $tabela
	 * @param  array  $atributosEValores
	 * @return SqlComando
	 * @return false
	 */
	public function insert(string $tabela, array $atributosEValores) : SqlComando {
		// Recebe a contagem de atributosEValores
		// se o tamanho dele não for suficiente para completar a operação
		// retorne uma Exception;
		$e = count($atributosEValores);

		if ($e <= 0)
			return $this;

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
		$this->acrescentarTextoComando($cmd.$atributos.$valores);

		return $this;
	}

	/**
	 * Equivalente ao comando UPDATE Tabela SET attr=value
	 * @param  string $tabela
	 * @param  array  $atributosEValores
	 * @return SqlComando
	 */
	public function update(string $tabela, array $atributosEValores) : SqlComando {
		$e = count($atributosEValores);

		if ($e <= 0)
			return $this;

		$cmd = 'UPDATE '.$tabela;
		$valores = 'SET ';

		$i = 0;
		foreach ($atributosEValores as $atributo => $valor) {
			$ultimo = ($i >= $e - 1);

			$valores .= $atributo.'='.self::traduzirTipo($valor).(($ultimo) ? ' ' : ', ');

			$i++;
		}

		$this->acrescentarTextoComando($cmd.$valores);

		return $this;
	}

	/**
	 * Equivalente ao comando DELETE FROM Tabela 
	 * @param  string $tabela
	 * @return SqlComando
	 */
	public function delete(string $tabela) : SqlComando {
		$this->acrescentarTextoComando('DELETE FROM '.$tabela.' ');

		return $this;
	}

	/**
	 * Equivalente ao comando ORDER BY attr ASC/DESC
	 * @param  string       $attr
	 * @param  bool|boolean $crescente
	 * @return SqlComando
	 */
	public function order(string $attr, bool $crescente = true) : SqlComando {
		$this->acrescentarTextoComando('ORDER BY '.$attr.' '.(($crescente) ? 'ASC' : 'DESC').' ');

		return $this;
	}

	/**
	 * Equivalente ao comando AS
	 * @return SqlComando
	 */
	public function as() : SqlComando {
		$this->acrescentarTextoComando('AS ');

		return $this;
	}

	/**
	 * Equivalente ao comando AND
	 * @return SqlComando
	 */
	public function and() : SqlComando {
		$this->acrescentarTextoComando('AND ');

		return $this;
	}

	/**
	 * Equivalente ao comando OR
	 * @return SqlComando
	 */
	public function or() : SqlComando {
		$this->acrescentarTextoComando('OR ');

		return $this;
	}

	/**
	 * Equivalente a uma expressão de comparação
	 * Ex: Attr=NULL
	 * @param  string       $attr
	 * @param  string       $expr
	 * @param  string       $alvo
	 * @param  bool|boolean $filtrarAlvo
	 * @return SqlComando
	 */
	public function expr(string $attr, string $expr, ?string $alvo, bool $filtrarAlvo = true) : SqlComando {
		$this->acrescentarTextoComando($attr.$expr.self::traduzirTipo($alvo, $filtrarAlvo).' ');

		return $this;
	}

	/**
	 * Equivalente ao comando LIMIT n
	 * @param  int    $limite
	 * @return SqlComando
	 */
	public function limit(int $limite) : SqlComando {
		$this->acrescentarTextoComando('LIMIT '.$limite.' ');

		return $this;
	}
}

?>
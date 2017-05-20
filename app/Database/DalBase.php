<?php declare(strict_types=1);
/**
 * Classe responsável por definir características padrões de um objeto do tipo Dal
 */

namespace App\Database;

use App\Database\Conexao;
use App\Database\SqlComando;
use PDO;

abstract class DalBase {
	protected $conexao;

	public function __construct(?Conexao $conexao = null) {
		$this->conexao = $conexao ?? new Conexao();
	}

	/**
	 * Getters
	 */
	
	protected function getConexao() : ?Conexao {
		return $this->conexao;
	}

	/**
	 * Setters
	 */
	
	protected function setConexao(?Conexao $valor) {
		$this->conexao = $valor;
	}

	/**
	 * Funções
	 */
	
	/**
	 * Encapsulamento da função Conexao::executar
	 * Automaticamente pega o texto de um objeto SqlComando e passa como argumento para 
	 * Conexao::executar
	 * @param  SqlComando $sqlComando
	 * @return PDOStatement|null
	 */
	protected function executar(SqlComando $sqlComando) : ?PDOStatement {
		return $this->getConexao()->executar($sqlComando->getTextoComando());
	}

	/**
	 * Encapsulamento da função Conexao::exec
	 * Automaticamente pega o texto de um objeto SqlComando e passa como argumento para 
	 * Conexao::exec
	 * @param  SqlComando $sqlComando
	 * @return PDOStatement|null
	 */
	protected function exec(sqlComando $sqlComando) : int {
		return $this->getConexao()->exec($sqlComando->getTextoComando());
	}

	/**
	 * Automaticamente faça o processo de rodar um comando, obter os resultados em um array,
	 * criar os objetos apartir desse array e retornar ao usuário os objetos de App\Objetos
	 * @param  SqlComando $sqlComando
	 * @param  callable   $manipuladorAtribuicao
	 * @return array
	 */
	protected function getObjetos(SqlComando $sqlComando, callable $manipuladorAtribuicao) : array {
		$query = $this->executar($sqlComando);
		$retornoObjetos = [];

		if ($query !== null) {
			$query = $query->fetchAll(PDO::FETCH_ASSOC);

			// $atualObjeto é um array de chave => valor
			// tabela_campo => valor_retornado
			foreach ($query as $atualObjeto) {
				array_push($retornoObjetos, $manipuladorAtribuicao($atualObjeto));
			}
		}

		return $retornoObjetos;
	}
}

?>
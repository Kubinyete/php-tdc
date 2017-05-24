<?php declare(strict_types=1);
/**
 * Classe responsável por definir características padrões de um objeto do tipo Dal
 */

namespace App\Database;

use \PDO;
use \PDOStatement;
use App\Database\Conexao;
use App\Database\SqlComando;

abstract class DalBase {
	protected $conexao;

	public function __construct(?Conexao $conexao = null) {
		$this->conexao = $conexao ?? new Conexao();
	}

	/**
	 * Prevenção: se todas as referências deste objeto Conexao forem apagadas, vamos apagar nosso
	 * objeto de conexão, que tambêm irá cortar a conexão com o banco de dados
	 */
	public function __destruct() {
		$this->desconectar();
	}
	
	/**
	 * Getters
	 */
	
	protected function getConexao() : Conexao {
		return $this->conexao;
	}

	/**
	 * Funções
	 */
	
	/**
	 * Estabelece a conexão com o banco de dados
	 */
	protected function conectar() {
		$this->getConexao()->conectar();
	}

	/**
	 * Fecha a conexão atual, se estiver ativa
	 */
	protected function desconectar() {
		$this->getConexao()->desconectar();
	}

	/**
	 * Desliga o salvamento automático das modificações no banco
	 * @return bool
	 */
	protected function iniciarTransacao() : bool {
		return $this->getConexao()->iniciarTransacao();
	}

	/**
	 * Volta todas as modificações na transação atual e ativa novamente o salvamento automático das
	 * modificações
	 * @return bool
	 */
	protected function descartarTransacao() : bool {
		return $this->getConexao()->descartarTransacao();
	}

	/**
	 * Salva as modificações em uma transação e ativa novamente o salvamento automático das
	 * modificações
	 * @return bool
	 */
	protected function salvarTransacao() : bool {
		return $this->getConexao()->salvarTransacao();
	}

	/**
	 * Retorna se a conexão está rodando uma transação
	 * @return bool
	 */
	protected function emTransacao() : bool {
		return $this->getConexao()->emTransacao();
	}
	
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
	 * ATENÇÃO: esse método não abre automaticamente a conexão com o banco, apenas faz a execução
	 * do comando passdo e retorna os resultados
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

<?php declare(strict_types=1);
/**
 * Classe responsável por representar uma conexão com o banco de dados,
 * aonde é possível ler, gravar dados e salvar modificações
 */

namespace App\Database;

use PDO;
use PDOException;
use PDOStatement;
use App\Config;

class Conexao {
	private $conexao;

	/**
	 * Inicializa uma conexão com o banco de dados
	 * Se não for especificado pelomenos uma stringConexao nos argumentos
	 * os dados de conexão padrões do arquivo de configurações será utilizado
	 * @param string|null $stringConexao
	 * @param string      $usuario
	 * @param string      $senha
	 */
	public function __construct(?string $stringConexao = null, string $usuario = '', string $senha = '') {
		try {
			if ($stringConexao !== null) {
				$this->conexao = new PDO($stringConexao, $usuario, $senha);
			} else {
				/**
				 * Obtenha as carácteristicas padrões de uma conexão definida no arquivo de configurações
				 */
				
				$this->conexao = new PDO(
					Config::get('Database.StringConexao'),
					Config::get('Database.Usuario'),
					Config::get('Database.Senha')
				);
			}
		} catch (PDOException $e) {
			exit(
				'Não foi possível estabelecer uma conexão com o banco de dados.'.
				'<br>'.
				'<strong>PDOException:</strong> <em>"'.$e->getMessage().'"</em>.'
			);
		}
	}

	public function __destruct() {
		$this->conexao = null;
	}

	/**
	 * Desliga o salvamento automático das modificações no banco
	 * @return bool
	 */
	public function iniciarTransacao() : bool {
		return $this->conexao->beginTransaction();
	}

	/**
	 * Volta todas as modificações na transação atual e ativa novamente o salvamento automático das
	 * modificações
	 * @return bool
	 */
	public function descartarTransacao() : bool {
		return $this->conexao->rollBack();
	}

	/**
	 * Salva as modificações em uma transação e ativa novamente o salvamento automático das
	 * modificações
	 * @return bool
	 */
	public function salvarTransacao() : bool {
		return $this->conexao->commit();
	}

	/**
	 * Retorna se a conexão está rodando uma transação
	 * @return bool
	 */
	public function emTransacao() : bool {
		return $this->conexao->inTransaction();
	}

	/**
	 * Executa uma string de comandos SQL em uma conexão PDO
	 * Retorna um PDOStatement
	 * Em caso de falha, retorna null
	 * @param  string $sql
	 * @return PDOStatement|null
	 */
	public function executar(string $sql) : ?PDOStatement {
		$query = $this->conexao->query($sql);

		return (!$query) ? null : $query;
	}

	/**
	 * Executa uma string de comandos SQL e retorna o número de linhas afetadas
	 * Em caso de falha, retornará 0
	 * @param  string $sql
	 * @return int
	 */
	public function exec(string $sql) : int {
		return $this->conexao->exec($sql);
	}
}

?>
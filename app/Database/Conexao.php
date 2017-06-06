<?php declare(strict_types=1);
/**
 * Classe responsável por representar uma conexão com o banco de dados,
 * aonde é possível ler, gravar dados e salvar modificações
 */

namespace App\Database;

use \PDO;
use \PDOException;
use \PDOStatement;
use App\Database\SqlComando;
use App\Config\AppConfig;
use App\Log\AppLog;
use App\Log\Notificacao;

final class Conexao {
	private $conexao;

	private $stringConexao;
	private $usuario;
	private $senha;

	/**
	 * Inicializa uma conexão com o banco de dados
	 * Se não for especificado pelomenos uma stringConexao nos argumentos
	 * os dados de conexão padrões do arquivo de configurações será utilizado
	 * @param string|null $stringConexao
	 * @param string|null $usuario
	 * @param string|null $senha
	 */
	public function __construct(?string $stringConexao = null, ?string $usuario = null, ?string $senha = null) {
		/**
		 * Obtenha as carácteristicas padrões de uma conexão definida no arquivo de configurações
		 */
		
		$this->stringConexao = $stringConexao ?? AppConfig::obter('Database.StringConexao');
		$this->usuario = $usuario ?? AppConfig::obter('Database.Usuario');
		$this->senha = $senha ?? AppConfig::obter('Database.Senha');
	}

	/**
	 * Prevenção: se todas as referências deste objeto Conexao forem apagadas, vamos apagar nosso
	 * objeto de conexão, que tambêm irá cortar a conexão com o banco de dados
	 */
	public function __destruct() {
		$this->desconectar();
	}

	/**
	 * Pequena adição, se tentarmos invocar o objeto como se fosse uma função, estabeleca a conexão
	 */
	public function __invoke() {
		$this->conectar();
	}

	/**
	 * Estabelece a conexão com o banco de dados
	 */
	public function conectar() {
		try {
			if ($this->conexao !== null)
				throw new Exception('Não é possível iniciar uma nova conexão enquanto a atual estiver ativa.');
			else
				$this->conexao = new PDO($this->stringConexao, $this->usuario, $this->senha);

				AppLog::adicionar(new Notificacao(Notificacao::INFO, 'Conexão com o banco de dados estabelecida'));
		} catch (Exception $e) {
			self::abortar($e);
		} catch (PDOException $e) {
			self::abortar($e);
		}
	}

	/**
	 * Fecha a conexão atual, se estiver ativa
	 */
	public function desconectar() {
		if ($this->conexao !== null) {
			$this->conexao = null;

			AppLog::adicionar(new Notificacao(Notificacao::INFO, 'Conexão com o banco de dados destruída'));
		}
	}

	/**
	 * Desliga o salvamento automático das modificações no banco
	 * @return bool
	 */
	public function iniciarTransacao() : bool {
		AppLog::adicionar(new Notificacao(Notificacao::INFO, 'Transação iniciada'));

		return $this->conexao->beginTransaction();
	}

	/**
	 * Volta todas as modificações na transação atual e ativa novamente o salvamento automático das
	 * modificações
	 * @return bool
	 */
	public function descartarTransacao() : bool {
		AppLog::adicionar(new Notificacao(Notificacao::INFO, 'Transação descartada'));

		return $this->conexao->rollBack();
	}

	/**
	 * Salva as modificações em uma transação e ativa novamente o salvamento automático das
	 * modificações
	 * @return bool
	 */
	public function salvarTransacao() : bool {
		AppLog::adicionar(new Notificacao(Notificacao::INFO, 'Transação salva'));

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
	 * @param  SqlComando $sql
	 * @return PDOStatement|null
	 */
	public function executar(SqlComando $sql) : ?PDOStatement {
		AppLog::adicionar(new Notificacao(Notificacao::INFO, 'SqlComando: '.$sql->getTextoComando()));

		$query = $this->conexao->query($sql->getTextoComando());
		return (!$query) ? null : $query;
	}

	/**
	 * Executa uma string de comandos SQL e retorna o número de linhas afetadas
	 * Em caso de falha, retornará 0
	 * @param  SqlComando $sql
	 * @return int
	 */
	public function exec(SqlComando $sql) : int {
		AppLog::adicionar(new Notificacao(Notificacao::INFO, 'SqlComando: '.$sql->getTextoComando()));

		$linhasAfetadas = $this->conexao->exec($sql->getTextoComando());

		AppLog::adicionar(new Notificacao(Notificacao::INFO, 'Linhas afetadas: '.$linhasAfetadas));

		return (!$linhasAfetadas) ? 0 : $linhasAfetadas;
	}

	/**
	 * Aborta a inicialização da conexão com o banco de dados devido à algum erro
	 * @param  Exception $e
	 */
	private function abortar($e) {
		$this->desconectar();

		exit(
			'Não foi possível estabelecer uma conexão com o banco de dados.'.
			'<br>'.
			'<strong>'.(($e instanceof PDOException) ? 'PDOException' : 'Exception').':</strong> <em>"'.$e->getMessage().'"</em>.'
		);
	}
}

?>

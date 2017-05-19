<?php declare(strict_types=1);
/**
 * Classe responsável por representar uma conexão com o banco de dados,
 * aonde é possível ler, gravar dados e salvar modificações
 */

namespace App\Database;

use PDO;
use PDOException;
use App\Config;

class Conexao {
	private $conexao;

	public function __construct(?string $stringConexao = null, ?string $usuario, ?string $senha) {
		try {
			if ($stringConexao !== null) {
				$this->conexao = new PDO($stringConexao, $usuario ?? '', $senha ?? '');
			} else {
				/**
				 * Obtenha as carácteristicas padrões de uma conexão definida no arquivo de configurações
				 */
				
				$this->conexao = new PDO(
					Config::get('database.stringConexao'),
					Config::get('database.usuario'),
					Config::get('database.senha')
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

	public function query(string $sql) : ?array {
		$query = $this->conexao->query($sql);

		return (!$query) ? null : $query;
	}
}

?>
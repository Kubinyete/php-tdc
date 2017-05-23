<?php declare(strict_types=1);
/**
 * Classe responsável por deixar disponível valores de configurações
 */

namespace App\Config;

use Exception;

abstract class AppConfig {
	// Delimitador de acesso às propriedades na string de get(string $caminhoAcesso)
	private const GET_DELIMITADOR = '.';
	// O arquivo de configurações, um array de chaves e valores
	private static $configuracoes;

	/**
	 * Carrega um arquivo de configurações JSON
	 * @param  string $arquivo
	 */
	public static function carregar(string $arquivo) {
		try {
			if (file_exists($arquivo))
				self::$configuracoes = json_decode(file_get_contents($arquivo), true);
			else
				throw new Exception('Não foi possível carregar o arquivo de configurações <strong>"'.$arquivo.'"</strong>.');
		} catch (Exception $e) {
			self::abortar($e);
		}
	}

	/**
	 * Retorna uma referência ao item informado através do caminho de acesso
	 * Ex: Database.StringConexao
	 * Ex: Alianca.LimiteDeAliancas
	 * @param  string $caminhoAcesso
	 * @return mixed
	 */
	public static function obter(string $caminhoAcesso) {
		$retorno = null;
		$array = explode(self::GET_DELIMITADOR, $caminhoAcesso);

		foreach ($array as $chave) {
			if ($retorno === null) {
				$retorno = &self::$configuracoes[$chave];
			} else {
				// Talvez não necessário o uso do operador '??', adicionado para previnir ou
				// facilitar a leitura desta linha
				$retorno = &$retorno[$chave] ?? null;
				
				if ($retorno === null)
					break;
			}
		}

		return $retorno;
	}

	/**
	 * Aborta o carregamento do arquivo de configurações devido à uma falha
	 * @param  Exception $e
	 */
	private static function abortar(Exception $e) {
		exit($e->getMessage());
	}
}

?>

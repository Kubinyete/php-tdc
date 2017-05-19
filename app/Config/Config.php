<?php declare(strict_types=1);
/**
 * Classe responsável por deixar disponível valores de configurações
 */

namespace App\Config;

use Exception;

abstract class Config {
	private const GET_DELIMITADOR = '.';
	
	private static $configuracoes;

	/**
	 * Carrega um arquivo de configurações JSON
	 * @param  string $arquivo
	 */
	public static function carregar(string $arquivo) {
		if (file_exists($arquivo))
			$this->configuracoes = json_decode(file_get_contents($arquivo));
		else
			exit('Não foi possível carregar o arquivo de configurações <strong>"'.$arquivo.'"</strong>.');
	}

	/**
	 * Retorna uma referência ao item informado através do caminho de acesso
	 * Ex: Database.StringConexao
	 * Ex: Alianca.LimiteDeAliancas
	 * @param  string $caminhoAcesso
	 * @return mixed
	 */
	public static function get(string $caminhoAcesso) {
		$retorno = null;
		$array = explode(self::GET_DELIMITADOR, $caminhoAcesso);

		foreach ($array as $chave) {
			if ($retorno === null) {
				$retorno = &self::$configuracoes[$chave];
			} else {
				$retorno = &$retorno[$chave];
			}
		}

		return $retorno;
	}
}
?>
<?php declare(strict_types=1);
/**
 * Classe responsável por conter métodos de resposta HTTP customizados
 */

namespace App\Http;

abstract class Resposta {
	/**
	 * Encapsulamento da função header()
	 * @param  string   $chave
	 * @param  string   $valor
	 * @param  int|null $httpCodigo
	 */
	public static function header(string $chave, string $valor, ?int $httpCodigo = null) {
		$chaveEValor = $chave.': '.$valor;

		if ($httpCodigo === null)
			header($chaveEValor, true);
		else
			header($chaveEValor, true, $httpCodigo);
	}

	/**
	 * Altera o status do pacote HTTP
	 * @param  int    $httpCodigo
	 */
	public static function status(int $httpCodigo) {
		self::header('Status', strval($httpCodigo), $httpCodigo);
	}

	/**
	 * Redireciona a resposta atual para uma localização especificada em $url
	 * @param  string       $url
	 * @param  bool|boolean $pararExecucao
	 */
	public static function redirecionar(string $url, bool $pararExecucao = true) {
		self::header('Location', $url, 302);

		if ($pararExecucao)
			exit();
	}
}

?>

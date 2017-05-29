<?php declare(strict_types=1);
/**
 * Classe responsável por representar um pedido HTTP
 * utilizado para obter e testar valores dos pedidos GET e POST
 */

namespace App\Http;

abstract class Pedido {
	// Automático
	public const AUTO = 0;
	// Referente aos valores de $_GET
	public const GET = 1;
	// Referente aos valores de $_POST
	public const POST = 3;
	// Referente aos valores de $_FILES
	public const FILE = 4;

	/**
	 * Retorna se determinada chave existe
	 * @param  string      $chave
	 * @param  int|integer $metodo
	 * @return bool
	 */
	public static function existe(string $chave, int $metodo) : bool {
		switch ($metodo) {
			case self::GET:
				if (isset($_GET[$chave]))
					return true;
				else
					return false;
				break;
			case self::POST:
				if (isset($_POST[$chave]))
					return true;
				else
					return false;
				break;
			case self::FILE:
				if (isset($_FILES[$chave]))
					return true;
				else
					return false;
				break;
			default:
				return false;
				break;
		}
	}

	/**
	 * Traduzir o um tipo de Pedido::<TIPO> para uma referência ao array original
	 * EDIT: e tenta obter a chave informada
	 * @param  int    $metodo
	 * @return mixed|null
	 */
	private static function traduzirEObter(string $chave, int $metodo) {
		if ($metodo === self::GET)
			return $_GET[$chave];
		else if ($metodo === self::POST)
			return $_POST[$chave];
		else if ($metodo === self::FILE)
			return $_FILES[$chave];
		else
			return null;
	}

	/**
	 * Retorna a chave específicada caso ela exista
	 * @param  string      $chave
	 * @param  int|integer $metodo
	 * @return mixed|null
	 */
	public static function obter(string $chave, int $metodo) {
		if (self::existe($chave, $metodo))
			return self::traduzirEObter($chave, $metodo);
		else
			return null;
	}
}

?>
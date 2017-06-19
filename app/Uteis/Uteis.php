<?php declare(strict_types=1);
/**
 * Classe responsável por disponibilizar diversas funções úteis para o nosso
 * aplicativo
 */

namespace App\Uteis;

use App\Config\AppConfig;

abstract class Uteis {
	/**
	 * Retorna um caminho web completo
	 * Ex: $reqRelativa = 'static/teste.txt'
	 * => http://WEB_HOST.WEB_BASE.static/teste.txt => http://localhost/static/teste.txt
	 * @param  string       $reqRelativa
	 * @param  bool|boolean $utilizarPrefixoHttp
	 * @param bool|boolean  $utilizarHost
	 * @return string
	 */
	public static function obterCaminhoWebCompleto(string $reqRelativa = '', bool $utilizarPrefixoHttp = true, bool $utilizarHost = true) : string {
		return (($utilizarPrefixoHttp) ? 'http://' : '').(($utilizarHost) ? WEB_HOST : '').WEB_BASE.$reqRelativa;
	}

	/**
	 * Substitui todos os espaços numa string para o caráctere '+'
	 * > Utilizado em ViewBase para transformar o nome de uma fonte em uma versão
	 * amigável para URL
	 * @param  string $fnt
	 * @return string
	 */
	public static function filtrarNomeFonte(string $fnt) : string {
		return str_replace(' ', '+', $fnt);
	}

	/**
	 * Filtra uma string de entidades HTML, que poderiam possibilitar a execução
	 * de scripts maniciosos
	 * @param  string $str
	 * @return string
	 */
	public static function filtrarEntidadesHtml(string $str) : string {
		return htmlspecialchars($str);
	}

	/**
	 * Retorna se determinada $str contêm carácteres inválidos
	 * @param  string $str
	 * @return bool
	 */
	public static function contemCaracteresInvalidos(string $str) : bool {
		$strlen = strlen($str);

		for ($i = 0; $i < $strlen; $i++) {
			// Verificando por carácteres inválidos

			if (ord($str[$i]) <= 47 || ord($str[$i]) >= 58 && ord($str[$i]) <= 64 || ord($str[$i]) >= 91 && ord($str[$i]) <= 96 || ord($str[$i]) >= 123) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Retorna se determinada string contém apenas string
	 * @param  string $str
	 * @return bool
	 */
	public static function contemApenasNumeros(string $str) : bool {
		$strlen = strlen($str);

		for ($i = 0; $i < $strlen; $i++) {
			$ascii = ord($str[$i]);

			// Se for algo além de números
			if ($ascii < 48 || $ascii > 57) {
				return false;
			}
		}

		return true;
	}

	/**
	 * Retorna se determinada string contém apenas letras maiúsculas
	 * @param  string $str
	 * @param  bool   $ignorarEspacos
	 * @return bool
	 */
	public static function contemApenasLetrasMaiusculas(string $str, bool $ignorarEspacos = true) : bool {
		$strlen = strlen($str);

		for ($i = 0; $i < $strlen; $i++) {
			$ascii = ord($str[$i]);

			// Se for algo além de números
			
			// Se for um espaço ignore
			if ($ascii == 32 && $ignorarEspacos)
				continue;


			if ($ascii < 65 || $ascii > 90) {
				return false;
			}
		}

		return true;
	}

	/**
	 * Retorna se determinada string é um email válido
	 * @param  string $str
	 * @return bool
	 */
	public static function emailValido(string $str) : bool {
		return preg_match('/([A-Za-z0-9\.]+)@([a-z]+)\.([a-z]+)/', $str) > 0;
	}
}

?>

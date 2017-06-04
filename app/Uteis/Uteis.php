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
}

?>
<?php declare(strict_types=1);
/**
 * Fábrica de Usuarios
 */

namespace App\Fabricas;

use App\Objetos\Usuario;
use App\Config\AppConfig;
use App\Fabricas\FabricaBase;
use App\Interfaces\FabricaInterface;

abstract class FabricaUsuario extends FabricaBase implements FabricaInterface {
	/**
	 * Retorna um novo objeto Usuario
	 * @param  string  $login
	 * @param  string  $senha
	 * @param  string  $nickname
	 * @return Usuario
	 */
	public static function criar(string $login = '', string $senha = '') : Usuario {
		return new Usuario(
			self::getNovoId(),
			self::getDatetimeAtual(),
			$login,
			$senha,
			AppConfig::obter('Usuarios.AlgoritmoHash')
		);
	}

	/**
	 * Retorna uma hash de uma string utilizando o algoritmo especificado em todos os usuários
	 * @param  string $str
	 * @return string
	 */
	public static function criarHash(string $str) : string {
		return hash(AppConfig::obter('Usuarios.AlgoritmoHash'), $str);
	}
}

?>

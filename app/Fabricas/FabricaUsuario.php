<?php declare(strict_types=1);
/**
 * Fábrica de Usuarios
 */

namespace App\Fabricas;

use App\Objetos\Usuario;
use App\Config\Config;
use App\Fabricas\iFabrica;

abstract class FabricaUsuario extends FabricaBase implements iFabrica {
	// $contador

	/**
	 * Cria um novo objeto Usuario
	 * @param  string|null  $login
	 * @param  string|null  $senha
	 * @param  string|null  $nickname
	 * @return Usuario
	 */
	public static function criar(string $login = '', string $senha = '', string $nickname = '') : Usuario {
		return new Usuario(
			parent::getNovoId(),
			parent::getDatetimeAtual(),
			$login,
			$senha,
			$nickname,
			Config::get('Usuarios.algoritmoHash')
		);
	}
}

?>
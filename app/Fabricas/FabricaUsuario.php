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
	// $contador

	/**
	 * Cria um novo objeto Usuario
	 * @param  string  $login
	 * @param  string  $senha
	 * @param  string  $nickname
	 * @return Usuario
	 */
	public static function criar(string $login = '', string $senha = '', string $nickname = '') : Usuario {
		return new Usuario(
			parent::getNovoId(),
			parent::getDatetimeAtual(),
			$login,
			$senha,
			$nickname,
			AppConfig::obter('Usuarios.algoritmoHash')
		);
	}
}

?>

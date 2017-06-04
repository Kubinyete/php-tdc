<?php declare(strict_types=1);
/**
 * Camada de processamento e consulta ao banco de dados
 */

namespace App\Models;

use App\Models\ModelBase;
use App\Objetos\Usuario;
use App\Views\LoginView;

final class LoginModel extends ModelBase {
	public function __invoke(?Usuario $usuario = null) {
		return new LoginView($usuario);
	}

	// TODO: Login
}

?>
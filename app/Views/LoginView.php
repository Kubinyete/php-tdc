<?php declare(strict_types=1);
/**
 * Representa a visualização da página de login da aplicação
 */

namespace App\Views;

use App\Objetos\Usuario;

final class LoginView extends ViewBase {
	public function __construct(?Usuario $usuario = null, ?string $usuario = null, ?string $senha = null) {
		parent::__construct($usuario, ['login'], ['log-usuario' => $usuario, 'log-senha' => $senha]);
	}
}

?>

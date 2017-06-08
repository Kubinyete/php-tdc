<?php declare(strict_types=1);
/**
 * Controller reponsável pela lógica de login
 */

namespace App\Controllers;

use App\Controllers\ControllerBase;

final class LoginController extends ControllerBase {
	public function __invoke(?string $login = null, ?string $senha = null) {
		if ($login === null && $senha === null)
			return $this->getModel()();
		else
			return $this->getModel()->logar($login, $senha);
	}
}

?>

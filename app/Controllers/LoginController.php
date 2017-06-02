<?php declare(strict_types=1);
/**
 * Controller reponsável pela lógica de login
 */

namespace App\Controllers;

final class LoginController extends ControllerBase {
	public function __invoke(?string $Login = null, ?string $senha = null) {
		if ($login === null && $senha === null)
			$this->getModel()($this->getUsuarioLogado());
		else
			$this->getModel()->logar($this->getUsuarioLogado(), $login, $senha);
	}
}

?>

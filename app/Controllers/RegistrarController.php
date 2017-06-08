<?php declare(strict_types=1);
/**
 * Controller reponsável pela lógica da página de registrar usuários
 */

namespace App\Controllers;

use App\Controllers\ControllerBase;

final class RegistrarController extends ControllerBase {
	public function __invoke(?string $login = null, ?string $senha = null, ?string $confirmaSenha = null) {
		if ($login === null && $senha === null && $confirmaSenha === null)
			return $this->getModel()();
		else
			return $this->getModel()->registrar($login, $senha, $confirmaSenha);
	}
}

?>

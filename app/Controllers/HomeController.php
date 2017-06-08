<?php declare(strict_types=1);
/**
 * Controlador da página principal de um usuário logado
 */

namespace App\Controllers;

use App\Controllers\ControllerBase;

final class HomeController extends ControllerBase {
	public function __invoke() {
		return $this->getModel()($this->getUsuarioLogado());
	}
}

?>
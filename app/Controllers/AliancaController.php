<?php declare(strict_types=1);
/**
 * Controlador responsável por processar o pedido de uma página de Aliança
 */

namespace App\Controllers;

use App\Controllers\ControllerBase;

final class AliancaController extends ControllerBase {
	public function __invoke(?string $aliancaId = null) {
		$aliancaId = intval($aliancaId);

		if ($aliancaId > 0)
			return $this->getModel()($aliancaId);
		else
			return $this->getModel()->notfound();
	}
}

?>
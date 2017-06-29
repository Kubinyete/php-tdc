<?php declare(strict_types=1);
/**
 * Controller reponsável pela lógica da requisição grupo
 */

namespace App\Controllers;

use App\Controllers\ControllerBase;

final class GrupoController extends ControllerBase {
	public function __invoke(?string $aliancaId = null, ?string $grupoId = null) {
		$aliancaId = intval($aliancaId);
		$grupoId = intval($grupoId);

		if ($aliancaId > 0 && $grupoId > 0)
			return $this->getModel()($aliancaId, $grupoId);
		else
			return $this->getModel()->notfound();
	}
}

?>

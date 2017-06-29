<?php declare(strict_types=1);
/**
 * Representa a visualização da página de grupo
 */

namespace App\Views;

use App\Views\ViewBase;
use App\Objetos\Usuario;
use App\Objetos\Alianca;
use App\Objetos\Grupo;
use App\Uteis\Uteis;

final class GrupoView extends ViewBase {
	public function __construct(?Usuario $usuario = null, ?Alianca $alianca = null, ?Grupo $grupo = null, array $jogadores = []) {
		parent::__construct($usuario, ['header', 'grupo'], [
			'grupo-alianca' => $alianca,
			'grupo-grupo' => $grupo,
			'grupo-jogadores' => $jogadores,

			'grupo-icone' => Uteis::obterCaminhoWebCompleto('static/resources/grupo-%c-icone.png', false, false)
		]);
	}
}

?>

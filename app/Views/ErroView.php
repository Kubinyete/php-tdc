<?php declare(strict_types=1);
/**
 * Visualização de uma página de erro
 */

namespace App\Views;

use App\Views\ViewBase;
use App\Uteis\Uteis;

final class ErroView extends ViewBase {
	public function __construct(string $titulo, array $paragrafos) {
		parent::__construct(null, ['erro'], [
			'erro-icone' => Uteis::obterCaminhoWebCompleto('static/resources/atencao-icone.png', false, false),
			'erro-titulo' => $titulo,
			'erro-paragrafos' => $paragrafos,
			'erro-home' => Uteis::obterCaminhoWebCompleto()
		]);
	}
}

?>
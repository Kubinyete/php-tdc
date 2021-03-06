<?php declare(strict_types=1);
/**
 * Visualização de uma página de erro
 */

namespace App\Views;

use App\Views\ViewBase;
use App\Uteis\Uteis;
use App\Objetos\Usuario;

final class ErroView extends ViewBase {
	public function __construct(?Usuario $usuario, string $titulo, array $paragrafos) {
		parent::__construct($usuario, ['erro'], [
			'erro-icone' => Uteis::obterCaminhoWebCompleto('static/resources/atencao-icone.png', false, false),
			'erro-titulo' => $titulo,
			'erro-paragrafos' => $paragrafos,
			'erro-home' => Uteis::obterCaminhoWebCompleto()
		]);
	}
}

?>
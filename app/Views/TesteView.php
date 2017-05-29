<?php declare(strict_types=1);
/**
 * Visualização para testes
 */

namespace App\Views;

use App\Views\ViewBase;

final class TesteView extends ViewBase {
	public function __construct(string $mensagem) {
		parent::__construct(null, ['teste'], ['mensagem' => $mensagem]);
	}
}

?>
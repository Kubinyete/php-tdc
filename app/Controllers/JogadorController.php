<?php declare(strict_types=1);
/**
 * Controlador responsável por processar o pedido de uma página de Jogador
 */

/**
 * FIXME: Código duplicado de AliancaController
 */

namespace App\Controllers;

use App\Controllers\ControllerBase;

final class JogadorController extends ControllerBase {
	public function __invoke(?string $aliancaId = null, ?string $jogadorId = null, ?string $nomeJogador = null, ?string $nicknameJogador = null, ?string $nivelJogador = null, ?string $telefoneJogador = null, ?string $emailJogador = null, ?string $tipoJogador = null, ?string $statusJogador = null, ?string $observacoesJogador = null) {
		$aliancaId = intval($aliancaId);
		$jogadorId = intval($jogadorId);

		if ($aliancaId > 0 && $jogadorId > 0) {
			// Se o usuário enviou algo em um dos campos
			// (enviou o formulário de alguma maneira)
			if ($nomeJogador !== null ||
				$nicknameJogador !== null ||
				$nivelJogador !== null ||
				$telefoneJogador !== null ||
				$emailJogador !== null ||
				$tipoJogador !== null ||
				$statusJogador !== null ||
				$observacoesJogador !== null
				)
			{
				$nivelJogador = intval($nivelJogador);
				$tipoJogador = intval($tipoJogador);
				$statusJogador = boolval($statusJogador);

				return $this->getModel()->atualizarJogador($aliancaId, $jogadorId, $nomeJogador, $nicknameJogador, $nivelJogador, $telefoneJogador, $emailJogador, $tipoJogador, $statusJogador, $observacoesJogador);
			}

			return $this->getModel()($aliancaId, $jogadorId);
		} else {
			return $this->getModel()->notfound();
		}
	}
}

?>
<?php declare(strict_types=1);
/**
 * Controlador responsável por processar o pedido de uma página de Aliança
 */

namespace App\Controllers;

use App\Controllers\ControllerBase;

final class AliancaController extends ControllerBase {
	public function __invoke(?string $aliancaId = null, ?string $nomeJogador = null, ?string $nicknameJogador = null, ?string $nivelJogador = null, ?string $telefoneJogador = null, ?string $emailJogador = null, ?string $tipoJogador = null, ?string $statusJogador = null, ?string $observacoesJogador = null) {
		$aliancaId = intval($aliancaId);

		if ($aliancaId > 0) {
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

				return $this->getModel()->adicionarJogador($aliancaId, $nomeJogador, $nicknameJogador, $nivelJogador, $telefoneJogador, $emailJogador, $tipoJogador, $statusJogador, $observacoesJogador);
			}

			return $this->getModel()($aliancaId);
		} else {
			return $this->getModel()->notfound();
		}
	}
}

?>
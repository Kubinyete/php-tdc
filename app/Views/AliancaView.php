<?php declare(strict_types=1);
/**
 * Página que mostrará as informações de determinada Aliança
 */

namespace App\Views;

use App\Views\ViewBase;
use App\Objetos\Usuario;
use App\Objetos\Alianca;
use App\Uteis\Uteis;
use App\Config\AppConfig;

final class AliancaView extends ViewBase {
	public function __construct(?Usuario $usuarioLogado = null, ?Alianca $alianca = null, int $contagemJogadores = 0, int $contagemMissoes = 0, int $contagemGuerras = 0) {
		parent::__construct(
			$usuarioLogado,
			['header', 'alianca'],
			[
				'alianca-alianca' => $alianca,
				'alianca-icone' => Uteis::obterCaminhoWebCompleto('static/resources/aliancas-icone.png'),
				'alianca-jogadores-limite' => AppConfig::obter('Jogadores.LimitePorAlianca'),
				'alianca-jogadores-contagem' => $contagemJogadores,
				'alianca-missoes-contagem' => $contagemMissoes,
				'alianca-guerras-contagem' => $contagemGuerras,
			]
		);
	}
}

?>
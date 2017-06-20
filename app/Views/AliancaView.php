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
	public function __construct(?Usuario $usuarioLogado = null, ?Alianca $alianca = null, array $jogadores = [], int $contagemMissoes = 0, int $contagemGuerras = 0, ?string $nome = null, ?string $nickname = null, ?int $nivel = null, ?string $telefone = null, ?string $email = null, ?int $tipo = null, ?bool $status = null, ?string $obs = null, ?string $nomeErro = null, ?string $nomeErro2 = null, ?string $nomeErro3 = null, ?string $apelidoErro = null, ?string $apelidoErro2 = null, ?string $nivelErro = null, ?string $telefoneErro = null, ?string $emailErro = null, ?string $emailErro2 = null, ?string $tipoErro = null, ?string $obsErro = null) {
		parent::__construct(
			$usuarioLogado,
			['header', 'alianca'],
			[
				'alianca-alianca' => $alianca,
				'alianca-icone' => Uteis::obterCaminhoWebCompleto('static/resources/aliancas-icone.png', false, false),
				'alianca-jogadores-limite' => AppConfig::obter('Jogadores.LimitePorAlianca'),
				'alianca-jogadores-contagem' => count($jogadores),
				'alianca-jogadores-icone' => Uteis::obterCaminhoWebCompleto('static/resources/jogador-icone.png', false, false),
				'alianca-jogadores-href' => Uteis::obterCaminhoWebCompleto('?r=jogador&aid='.$alianca->getId().'&id=%i', false, false),
				'alianca-jogadores-campo-inexistente' => '(NÃO INFORMADO)',
				'alianca-missoes-contagem' => $contagemMissoes,
				'alianca-guerras-contagem' => $contagemGuerras,

				'alianca-jogadoresform-action' => Uteis::obterCaminhoWebCompleto('?r=alianca&id='.$alianca->getId(), false, false),

				'alianca-jogadoresform-nom' => ($nome !== null) ? Uteis::filtrarEntidadesHtml($nome) : $nome,
				'alianca-jogadoresform-nom-maxlength' => AppConfig::obter('Jogadores.NomeTamanhoLimite'),
				'alianca-jogadoresform-nom-erro' => $nomeErro,
				'alianca-jogadoresform-nom-erro-2' => $nomeErro2,
				'alianca-jogadoresform-nom-erro-3' => $nomeErro3,

				'alianca-jogadoresform-nic' => ($nickname !== null) ? Uteis::filtrarEntidadesHtml($nickname) : $nickname,
				'alianca-jogadoresform-nic-maxlength' => AppConfig::obter('Jogadores.ApelidoTamanhoLimite'),
				'alianca-jogadoresform-nic-erro' => $apelidoErro,
				'alianca-jogadoresform-nic-erro-2' => $apelidoErro2,

				'alianca-jogadoresform-niv' => $nivel,
				'alianca-jogadoresform-niv-max' => AppConfig::obter('Jogadores.NivelLimite'),
				'alianca-jogadoresform-niv-erro' => $nivelErro,

				'alianca-jogadoresform-tel' => ($telefone !== null) ? Uteis::filtrarEntidadesHtml($telefone) : $telefone,
				'alianca-jogadoresform-tel-maxlength' => AppConfig::obter('Jogadores.TelefoneTamanho'),
				'alianca-jogadoresform-tel-erro' => $telefoneErro,

				'alianca-jogadoresform-ema' => ($email !== null) ? Uteis::filtrarEntidadesHtml($email) : $email,
				'alianca-jogadoresform-ema-maxlength' => AppConfig::obter('Jogadores.EmailTamanhoLimite'),
				'alianca-jogadoresform-ema-erro' => $emailErro,
				'alianca-jogadoresform-ema-erro-2' => $emailErro2,

				'alianca-jogadoresform-tip' => $tipo,
				'alianca-jogadoresform-tip-tipos' => AppConfig::obter('Jogadores.Tipos'),
				'alianca-jogadoresform-tip-erro' => $tipoErro,

				'alianca-jogadoresform-sta' => $status,

				'alianca-jogadoresform-obs' => ($obs !== null) ? Uteis::filtrarEntidadesHtml($obs) : $obs,
				'alianca-jogadoresform-obs-maxlength' => AppConfig::obter('Jogadores.ObservacoesTamanhoLimite'),
				'alianca-jogadoresform-obs-erro' => $obsErro,

				'alianca-jogadores' => $jogadores,
				'alianca-jogadores-erro' => 'Aparentemente você não tem nenhum Jogador adicionado nesta Aliança, experimente utilizar o formulário acima para adicionar a qualquer momento!'
			]
		);
	}
}

?>
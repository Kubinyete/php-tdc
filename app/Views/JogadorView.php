<?php declare(strict_types=1);
/**
 * Página que mostrará as informações de determinado Jogador
 */

/**
 * FIXME: Código duplicado de AliancaView
 */

namespace App\Views;

use App\Views\ViewBase;
use App\Objetos\Usuario;
use App\Objetos\Alianca;
use App\Objetos\Jogador;
use App\Uteis\Uteis;
use App\Config\AppConfig;

final class JogadorView extends ViewBase {
	public function __construct(?Usuario $usuarioLogado = null, ?Alianca $alianca = null, ?Jogador $jogador = null, ?string $nome = null, ?string $nickname = null, ?int $nivel = null, ?string $telefone = null, ?string $email = null, ?int $tipo = null, ?bool $status = null, ?string $obs = null, ?string $nomeErro = null, ?string $nomeErro2 = null, ?string $nomeErro3 = null, ?string $apelidoErro = null, ?string $apelidoErro2 = null, ?string $nivelErro = null, ?string $telefoneErro = null, ?string $emailErro = null, ?string $emailErro2 = null, ?string $tipoErro = null, ?string $obsErro = null, ?string $statusErro = null) {
		parent::__construct(
			$usuarioLogado,
			['header', 'jogador'],
			[
				'jogador-alianca' => $alianca,
				'jogador-jogador' => $jogador,
				'jogador-icone' => Uteis::obterCaminhoWebCompleto('static/resources/jogador-icone.svg', false, false),

				'jogadoresform-action' => Uteis::obterCaminhoWebCompleto('?r=jogador&aid='.$alianca->getId().'&id='.$jogador->getId(), false, false),

				'jogadoresform-nom' => ($nome !== null) ? Uteis::filtrarEntidadesHtml($nome) : $jogador->getNome(true),
				'jogadoresform-nom-maxlength' => AppConfig::obter('Jogadores.NomeTamanhoLimite'),
				'jogadoresform-nom-erro' => $nomeErro,
				'jogadoresform-nom-erro-2' => $nomeErro2,
				'jogadoresform-nom-erro-3' => $nomeErro3,

				'jogadoresform-nic' => ($nickname !== null) ? Uteis::filtrarEntidadesHtml($nickname) : $jogador->getNickname(true),
				'jogadoresform-nic-maxlength' => AppConfig::obter('Jogadores.ApelidoTamanhoLimite'),
				'jogadoresform-nic-erro' => $apelidoErro,
				'jogadoresform-nic-erro-2' => $apelidoErro2,

				'jogadoresform-niv' => ($nivel !== null) ? $nivel : $jogador->getNivel(),
				'jogadoresform-niv-max' => AppConfig::obter('Jogadores.NivelLimite'),
				'jogadoresform-niv-erro' => $nivelErro,

				'jogadoresform-tel' => ($telefone !== null) ? Uteis::filtrarEntidadesHtml($telefone) : $jogador->getTelefone(),
				'jogadoresform-tel-maxlength' => AppConfig::obter('Jogadores.TelefoneTamanho'),
				'jogadoresform-tel-erro' => $telefoneErro,

				'jogadoresform-ema' => ($email !== null) ? Uteis::filtrarEntidadesHtml($email) : $jogador->getEmail(),
				'jogadoresform-ema-maxlength' => AppConfig::obter('Jogadores.EmailTamanhoLimite'),
				'jogadoresform-ema-erro' => $emailErro,
				'jogadoresform-ema-erro-2' => $emailErro2,

				'jogadoresform-tip' => ($tipo !== null) ? $tipo : $jogador->getTipo(),
				'jogadoresform-tip-tipos' => AppConfig::obter('Jogadores.Tipos'),
				'jogadoresform-tip-erro' => $tipoErro,

				'jogadoresform-sta' => ($status !== null) ? $status : $jogador->getStatus(),
				'jogadoresform-sta-erro' => $statusErro,

				'jogadoresform-obs' => ($obs !== null) ? Uteis::filtrarEntidadesHtml($obs) : $jogador->getObservacoes(true),
				'jogadoresform-obs-maxlength' => AppConfig::obter('Jogadores.ObservacoesTamanhoLimite'),
				'jogadoresform-obs-erro' => $obsErro
			]
		);
	}
}

?>
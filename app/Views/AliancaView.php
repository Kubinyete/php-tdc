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
	public function __construct(?Usuario $usuarioLogado = null, ?Alianca $alianca = null, array $jogadores = [], int $contagemMissoes = 0, int $contagemGuerras = 0, array $grupos = [], ?string $nome = null, ?string $nickname = null, ?int $nivel = null, ?string $telefone = null, ?string $email = null, ?int $tipo = null, ?bool $status = null, ?string $obs = null, ?string $nomeErro = null, ?string $nomeErro2 = null, ?string $nomeErro3 = null, ?string $apelidoErro = null, ?string $apelidoErro2 = null, ?string $nivelErro = null, ?string $telefoneErro = null, ?string $emailErro = null, ?string $emailErro2 = null, ?string $tipoErro = null, ?string $obsErro = null) {
		parent::__construct(
			$usuarioLogado,
			['header', 'alianca'],
			[
				'alianca-alianca' => $alianca,
				'alianca-icone' => Uteis::obterCaminhoWebCompleto('static/resources/alianca-icone.svg', false, false),
				'alianca-jogadores-limite' => AppConfig::obter('Jogadores.LimitePorAlianca'),
				'alianca-jogadores-contagem' => count($jogadores),
				'alianca-jogadores-icone' => Uteis::obterCaminhoWebCompleto('static/resources/jogador-icone.svg', false, false),
				'alianca-jogadores-href' => Uteis::obterCaminhoWebCompleto('?r=jogador&aid='.$alianca->getId().'&id=%i', false, false),
				'alianca-jogadores-campo-inexistente' => '(NÃO INFORMADO)',
				'alianca-missoes-contagem' => $contagemMissoes,
				'alianca-guerras-contagem' => $contagemGuerras,

				'alianca-grupos' => $grupos,
				'alianca-grupo-icone' => Uteis::obterCaminhoWebCompleto('static/resources/grupo-%c-icone.png', false, false),
				'alianca-grupo-href' => Uteis::obterCaminhoWebCompleto('?r=grupo&aid='.$alianca->getId().'&id=%i', false, false),

				'alianca-missoes-icone' => Uteis::obterCaminhoWebCompleto('static/resources/missao-icone.png', false, false),
				'alianca-guerras-icone' => Uteis::obterCaminhoWebCompleto('static/resources/guerra-icone.png', false, false),

				'jogadoresform-action' => Uteis::obterCaminhoWebCompleto('?r=alianca&id='.$alianca->getId(), false, false),

				'jogadoresform-nom' => ($nome !== null) ? Uteis::filtrarEntidadesHtml($nome) : $nome,
				'jogadoresform-nom-maxlength' => AppConfig::obter('Jogadores.NomeTamanhoLimite'),
				'jogadoresform-nom-erro' => $nomeErro,
				'jogadoresform-nom-erro-2' => $nomeErro2,
				'jogadoresform-nom-erro-3' => $nomeErro3,

				'jogadoresform-nic' => ($nickname !== null) ? Uteis::filtrarEntidadesHtml($nickname) : $nickname,
				'jogadoresform-nic-maxlength' => AppConfig::obter('Jogadores.ApelidoTamanhoLimite'),
				'jogadoresform-nic-erro' => $apelidoErro,
				'jogadoresform-nic-erro-2' => $apelidoErro2,

				'jogadoresform-niv' => $nivel,
				'jogadoresform-niv-max' => AppConfig::obter('Jogadores.NivelLimite'),
				'jogadoresform-niv-erro' => $nivelErro,

				'jogadoresform-tel' => ($telefone !== null) ? Uteis::filtrarEntidadesHtml($telefone) : $telefone,
				'jogadoresform-tel-maxlength' => AppConfig::obter('Jogadores.TelefoneTamanho'),
				'jogadoresform-tel-erro' => $telefoneErro,

				'jogadoresform-ema' => ($email !== null) ? Uteis::filtrarEntidadesHtml($email) : $email,
				'jogadoresform-ema-maxlength' => AppConfig::obter('Jogadores.EmailTamanhoLimite'),
				'jogadoresform-ema-erro' => $emailErro,
				'jogadoresform-ema-erro-2' => $emailErro2,

				'jogadoresform-tip' => ($tipo !== null) ? $tipo : 0,
				'jogadoresform-tip-tipos' => AppConfig::obter('Jogadores.Tipos'),
				'jogadoresform-tip-erro' => $tipoErro,

				'jogadoresform-sta' => ($status !== null) ? $status : true,
				'jogadoresform-sta-erro' => null,

				'jogadoresform-obs' => ($obs !== null) ? Uteis::filtrarEntidadesHtml($obs) : $obs,
				'jogadoresform-obs-maxlength' => AppConfig::obter('Jogadores.ObservacoesTamanhoLimite'),
				'jogadoresform-obs-erro' => $obsErro,

				'alianca-jogadores' => $jogadores,
				'alianca-jogadores-erro' => 'Aparentemente você não tem nenhum Jogador adicionado nesta Aliança, experimente utilizar o formulário acima para adicionar a qualquer momento!'
			]
		);
	}
}

?>
<?php declare(strict_types=1);
/**
 * Representa a visualização da página principal de um usuário
 */

namespace App\Views;

use App\Views\ViewBase;
use App\Objetos\Usuario;
use App\Uteis\Uteis;
use App\Config\AppConfig;

final class HomeView extends ViewBase {
	public function __construct(?Usuario $usuario = null, ?array $aliancas = null, ?string $aliancaNome = null, ?string $aliancaNomeErro = null) {
		parent::__construct($usuario, ['header', 'home'], [
			'home-aliancas' => $aliancas,
			'home-aliancas-icone' => Uteis::obterCaminhoWebCompleto('static/resources/aliancas-icone.png', false, false),
			'home-aliancas-href' => Uteis::obterCaminhoWebCompleto('?r=alianca&id=%i', false, false),
			'home-aliancas-lista-erro' => 'Você não possui nenhuma Aliança no momento, experimente adicionar uma nova utilizando o formulário acima.',
			'home-aliancas-descricao' => ['Aqui estão listadas as suas <strong>Alianças</strong> criadas até o momento, elas são a base de gerenciamento deste aplicativo, aonde você poderá incluir <strong>Jogadores</strong>, organizar <strong>Grupos</strong>, adicionar <em>Eventos</em> como <strong>Guerras</strong> & <strong>Missões</strong>, entre outros.','Você poderá adicionar uma nova aliança sem esforços utilizando o simples formulário abaixo, apenas insira o nome dela utilizada em-jogo e começe já.'],
			'home-aliancasform-action' => Uteis::obterCaminhoWebCompleto('?r=home', false, false),
			'home-aliancasform-nom' => ($aliancaNomeErro !== null) ? Uteis::filtrarEntidadesHtml($aliancaNome) : $aliancaNome,
			'home-aliancasform-nom-erro' => $aliancaNomeErro,
			'home-aliancasform-nom-maxlength' => AppConfig::obter('Aliancas.NomeTamanhoLimite')
		]);
	}
}

?>

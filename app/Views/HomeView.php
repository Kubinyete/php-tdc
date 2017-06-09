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
	public function __construct(?Usuario $usuario = null, ?array $aliancas = null) {
		parent::__construct($usuario, ['header', 'home'], [
			'home-aliancas' => $aliancas,
			'home-aliancas-icone' => Uteis::obterCaminhoWebCompleto('static/resources/aliancas-icone.png', false, false),
			'home-aliancas-href' => Uteis::obterCaminhoWebCompleto('?r=alianca&id=%i', false, false),
			'home-aliancas-lista-erro' => 'Você não possui nenhuma Aliança no momento, experimente criar uma nova utilizando o formulário acima!',
			'home-aliancas-descricao' => ['Aqui estão listadas as suas <strong>alianças</strong> criadas até o momento, elas são a base de gerenciamento deste aplicativo, aonde você poderá incluir <strong>jogadores</strong>, organizar <strong>grupos</strong>, adicionar <em>eventos</em> como <strong>guerras</strong> & <strong>missões</strong>, entre outros.','Você pode criar uma nova aliança sem esforços utilizando simples formulário abaixo, apenas insira o nome dela utilizada em-jogo e começe já.']
		]);
	}
}

?>

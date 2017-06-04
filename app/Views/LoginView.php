<?php declare(strict_types=1);
/**
 * Representa a visualização da página de login da aplicação
 */

namespace App\Views;

use App\Views\ViewBase;
use App\Objetos\Usuario;
use App\Uteis\Uteis;
use App\Config\AppConfig;

final class LoginView extends ViewBase {
	public function __construct(?Usuario $usuario = null, ?string $login = null, ?string $senha = null) {
		parent::__construct($usuario, ['login'], [
			'log-logo' => Uteis::obterCaminhoWebCompleto('static/resources/makeindiegames-logo.png', false, false),
			'log-usuario' => $login,
			'log-log-maxlength' => AppConfig::obter('Usuarios.NomeTamanhoLimite'), 
			'log-senha' => $senha,
			'log-sen-maxlength' => AppConfig::obter('Usuarios.SenhaTamanhoLimite'),
			'log-action' => Uteis::obterCaminhoWebCompleto('?r=login', false, false),
			'log-pagina-registrar' => Uteis::obterCaminhoWebCompleto('?r=registrar', false, false)
		]);
	}
}

?>

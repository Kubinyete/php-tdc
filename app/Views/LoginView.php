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
	public function __construct(?Usuario $usuario = null, ?string $login = null, ?string $loginErro = null, ?string $senha = null, ?string $senhaErro = null) {
		parent::__construct($usuario, ['login'], [
			'log-logo' => Uteis::obterCaminhoWebCompleto('static/resources/makeindiegames-logo.png', false, false),
			'log-usuario' => ($login !== null) ? Uteis::filtrarEntidadesHtml($login) : $login,
			'log-usuario-erro' => $loginErro,
			'log-log-maxlength' => AppConfig::obter('Usuarios.NomeTamanhoLimite'),
			'log-senha' => ($senha !== null) ? Uteis::filtrarEntidadesHtml($senha) : $senha,
			'log-senha-erro' => $senhaErro,
			'log-sen-maxlength' => AppConfig::obter('Usuarios.SenhaTamanhoLimite'),
			'log-action' => Uteis::obterCaminhoWebCompleto('?r=login', false, false),
			'log-pagina-registrar' => Uteis::obterCaminhoWebCompleto('?r=registrar', false, false)
		]);
	}
}

?>

<?php declare(strict_types=1);
/**
 * Representa a visualização da página de registrar usuários da aplicação
 */

namespace App\Views;

use App\Views\ViewBase;
use App\Objetos\Usuario;
use App\Uteis\Uteis;
use App\Config\AppConfig;

final class RegistrarView extends ViewBase {
	public function __construct(?Usuario $usuario = null, ?string $login = null, ?string $loginErro = null, ?string $loginErro2 = null, ?string $senha = null, ?string $senhaErro = null, ?string $senhaErro2 = null, ?string $confirmaSenha = null, ?string $confirmaSenhaErro = null) {
		parent::__construct($usuario, ['registrar'], [
			'reg-logo' => Uteis::obterCaminhoWebCompleto('static/resources/makeindiegames-logo.png', false, false),
			'reg-usuario' => ($login !== null) ? Uteis::filtrarEntidadesHtml($login) : $login,
			'reg-usuario-erro' => $loginErro,
			'reg-usuario-erro2' => $loginErro2,
			'reg-log-maxlength' => AppConfig::obter('Usuarios.NomeTamanhoLimite'),
			'reg-senha' => ($senha !== null) ? Uteis::filtrarEntidadesHtml($senha) : $senha,
			'reg-senha-erro' => $senhaErro,
			'reg-senha-erro2' => $senhaErro2,
			'reg-sen-maxlength' => AppConfig::obter('Usuarios.SenhaTamanhoLimite'),
			'reg-consenha' => ($confirmaSenha !== null) ? Uteis::filtrarEntidadesHtml($confirmaSenha) : $confirmaSenha,
			'reg-consenha-erro' => $confirmaSenhaErro,
			'reg-con-maxlength' => AppConfig::obter('Usuarios.SenhaTamanhoLimite'),
			'reg-action' => Uteis::obterCaminhoWebCompleto('?r=registrar', false, false),
			'reg-pagina-login' => Uteis::obterCaminhoWebCompleto('?r=login', false, false)
		]);
	}
}

?>

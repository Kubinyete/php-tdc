<?php declare(strict_types=1);
/**
 * Uma Exception representando um erro ao registrar um usuário
 */

namespace App\Exceptions;

use \Exception;
use App\Config\AppConfig;

class RegistrarException extends Exception {
	protected $loginErro;
	protected $senhaErro;
	protected $confirmaSenhaErro;

	public function __construct(?string $loginErro = null, ?string $senhaErro = null, ?string $confirmaSenhaErro = null) {
		$this->loginErro = $loginErro;
		$this->senhaErro = $senhaErro;
		$this->confirmaSenhaErro = $confirmaSenhaErro;
	}

	public function getLoginErro() : ?string {
		if ($this->loginErro !== null) {
			return str_replace(
				['%m', '%M'], 
				[AppConfig::obter('Usuarios.NomeTamanhoMinimo'),
				 AppConfig::obter('Usuarios.NomeTamanhoLimite')], 
				$this->loginErro
			);
		} else {
			return null;
		}
		
	}

	public function getSenhaErro() : ?string {
		if ($this->senhaErro !== null) {
			return str_replace(
				['%m', '%M'], 
				[AppConfig::obter('Usuarios.SenhaTamanhoMinimo'), 
				AppConfig::obter('Usuarios.SenhaTamanhoLimite')], 
				$this->senhaErro
			);
		} else {
			return null;
		}
		
	}

	public function getConfirmaSenhaErro() : ?string {
		return $this->confirmaSenhaErro;
	}
}

?>
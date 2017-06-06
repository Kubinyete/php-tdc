<?php declare(strict_types=1);
/**
 * Uma Exception representando um erro de login
 */

namespace App\Exceptions;

use \Exception;

class LoginException extends Exception {
	protected $loginErro;
	protected $senhaErro;

	public function __construct(?string $loginErro = null, ?string $senhaErro = null) {
		$this->loginErro = $loginErro;
		$this->senhaErro = $senhaErro;
	}

	public function getLoginErro() : ?string {
		return $this->loginErro;
	}

	public function getSenhaErro() : ?string {
		return $this->senhaErro;
	}
}

?>
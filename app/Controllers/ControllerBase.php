<?php declare(strict_types=1);
/**
 * Classe responsável por representar um Controller de base em uma aplicação MVC
 */

namespace App\Controllers;

use App\Models\ModelBase;
use App\Objetos\Usuario;

abstract class ControllerBase {
	protected $model;
	protected $usuarioLogado;

	public function __construct($model, ?Usuario $usuarioLogado = null) {
		if ($model instanceof ModelBase) {
			$this->model = $model;
			$this->usuarioLogado = $usuarioLogado;
		} else {
			exit('Não é possível criar um Controller para manipular um objeto que não seja um Model em <strong>"'.static::class.'"</strong>.');
		}
	}

	/**
	 * Getters
	 */
	
	protected function getModel() {
		return $this->model;
	}

	protected function getUsuarioLogado() : ?Usuario {
		return $this->usuarioLogado;
	}

	// Todo Controller pode ser inicializado utilizando este método
	// os argumentos para rodar um Controller podem ser opcionais, tendo um valor já setado caso não
	// for informado
	public abstract function __invoke();
}

?>
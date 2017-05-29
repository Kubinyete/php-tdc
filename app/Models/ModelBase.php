<?php declare(strict_types=1);
/**
 * Classe responsável por representar um Model de base em uma aplicação MVC
 */

namespace App\Models;

use App\Database\Conexao;
use App\Objetos\Usuario;

abstract class ModelBase {
	protected $conexao;
	protected $usuarioLogado;

	public function __construct(Conexao $conexao, ?Usuario $usuarioLogado = null) {
		$this->conexao = $conexao;
		$this->usuarioLogado = $usuarioLogado;
	}

	/**
	 * Getters
	 */
	
	protected function getConexao() : Conexao {
		return $this->conexao;
	}

	protected function getUsuarioLogado() : ?Usuario {
		return $this->usuarioLogado;
	}

	// Todo Model deverá ter pelomenos um processo para retornar uma View
	// nesta função, você poderá consultar o banco de dados utilizando os objetos em App\Database
	// retornando valores para completar uma View com essas informações, após isso, retorne essa
	// View 'recheada' de informações
	public abstract function index();

	// Apelido para ::index()
	public abstract function __invoke();
}

?>
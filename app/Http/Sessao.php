<?php declare(strict_types=1);
/**
 * Objeto responsável por conter métodos de manipulação da sessão atual
 */
namespace App\Http;

use App\Objetos\Usuario;

abstract class Sessao {
	private const USUARIO_CHAVE = 'usrlgd';

	/**
	 * Inicializa a sessão atual
	 */
	public static function inicializar() {
		session_start();
	}

	/**
	 * Retorna o ID da sessão atual
	 * @return string
	 */
	public static function getId() : string {
		return session_id();
	}

	/**
	 * Retorna um valor guardado na sessão atual
	 * @param  [type] $string
	 * @return mixed
	 */
	public static function obter(string $chave) {
		if (!isset($_SESSION[$chave])) {
			return null;
		}

		return $_SESSION[$chave];
	}

	/**
	 * Atualiza um valor na sessão atual
	 * @param string $chave
	 * @param mixed $valor
	 */
	public static function set(string $chave, $valor) {
		$_SESSION[$chave] = $valor;
	}

	/**
	 * Usuário em sessão
	 */

	/**
	 * Retorna o Usuario logado na sessão atual
	 * @return Usuario|null
	 */
	public static function getUsuario() : ?Usuario {
		return self::obter(self::USUARIO_CHAVE);
	}

	/**
	 * Atualiza o Usuario logado na sessão atual
	 * @param Usuario $usuario
	 */
	public static function setUsuario(Usuario $usuario) {
		self::set(self::USUARIO_CHAVE, $usuario);
	}

	/**
	 * Retorna se a sessão atual é valida como ID, se ela conter um caráctere inválido a sessão não
	 * foi criada com sucesso
	 * @return bool
	 */
	public static function sessaoValida() : bool {
		$sessaoId = self::getId();

		if (strlen($sessaoId) < 1 || strlen($sessaoId) > 128) {
			return false;
		}

		$retorno = true;
		for ($i = 0; $i < strlen($sessaoId); $i++) {
			// Verificando por carácteres inválidos
			if (ord($sessaoId[$i]) <= 47 || ord($sessaoId[$i]) >= 58 && ord($sessaoId[$i]) <= 64 || ord($sessaoId[$i]) >= 91 && ord($sessaoId[$i]) <= 96 || ord($sessaoId[$i]) >= 123) {
				$retorno = false;
			}
		}

		return $retorno;
	}

	/**
	 * Valida e regenera uma nova sessão caso esta esteja inválida
	 */
	public static function validar() {
		if (!self::sessaoValida()) {
			self::regenerarId();
		}
	}

	/**
	 * Regenera o ID da sessão atual
	 */
	public static function regenerarId() {
		session_regenerate_id();
	}
}

?>
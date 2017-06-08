<?php declare(strict_types=1);
/**
 * Objeto responsável por segurar as informações, como se fosse um log de
 * processos que aconteceram nesta requisição de página, coisas como querys SQL,
 * modificações na sessão atual, parâmetros passados pela querystring, etc...
 */

namespace App\Log;

use App\Log\Notificacao;

abstract class AppLog {
	private static $notificacoes = [];

	/**
	 * Adiciona mais uma mensagem à nossa lista de notificações
	 * @param  Notificacao $notificacao
	 */
	private static function adicionar(Notificacao $notificacao) {
		array_push(self::$notificacoes, $notificacao);
	}
	
	/**
	 * Retorna uma lista de notificações
	 * @return array
	 */
	public static function getNotificacoes() : array {
		return self::$notificacoes;
	}

	/**
	 * Adiciona uma notificação ao nosso AppLog
	 *
	 * @param int $tipo
	 * @param string $mensagem
	 * @return void
	 */
	public static function log(int $tipo, string $mensagem) {
		if (APP_DEBUG)
			self::adicionar(new Notificacao($tipo, $mensagem));
	}
}

?>
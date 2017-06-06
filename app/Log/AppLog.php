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
	public function adicionar(Notificacao $notificacao) {
		if (APP_DEBUG)
			array_push(self::$notificacoes, $notificacao);
	}
	
	/**
	 * Retorna uma lista de notificações
	 * @return array
	 */
	public function getNotificacoes() : array {
		return self::$notificacoes;
	}
}

?>
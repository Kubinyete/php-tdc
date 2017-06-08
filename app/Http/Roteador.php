<?php declare(strict_types=1);
/**
 * Classe responsável por manipular e servir a requisição HTTP de acordo com os parâmetros passados
 * para o roteador
 */

namespace App\Http;

use \Exception;
use App\Views\ViewBase;
use App\Uteis\Uteis;
use App\Log\AppLog;
use App\Log\Notificacao;

abstract class Roteador {
	private const ROTA_STRING_LIMITE = 32;
	public const ROTA_NOTFOUND_PADRAO = 'notfound';

	private static $rotas = [];

	/**
	 * Registra um manipulador a uma rota de requisição
	 * @param  string   $req        
	 * @param  callable $manipulador'
	 */
	public static function registrar(string $req, callable $manipulador) {
		try {
			if (!isset(self::$rotas[$req]))
				self::$rotas[$req] = $manipulador;
			else
				throw new Exception('A rota de requisição já existe ao tentar registrar <strong>"'.$req.'"</strong>.');
		} catch (Exception $e) {
			self::abortar($e);
		}
	}

	/**
	 * Executa a rota desejada
	 * @param  string $req
	 */
	public static function servir(string $req) {
		$reqLen = strlen($req);
		$renderizavel = null;

		if ($reqLen > 0 && $reqLen <= self::ROTA_STRING_LIMITE && isset(self::$rotas[$req])) {
			AppLog::log(Notificacao::INFO, 'Roteador: Requisição "'.$req.'" encontrada');
			$renderizavel = self::$rotas[$req]();
		} else {
			AppLog::log(Notificacao::AVISO, 'Roteador: Requisição "'.$req.'" falhou');
			$renderizavel = self::$rotas[self::ROTA_NOTFOUND_PADRAO]();
		}

		try {
			if ($renderizavel instanceof ViewBase)
				$renderizavel();
			else
				throw new Exception('Visualização não renderizável retornada ao tentar servir o pedido'.(($renderizavel !== null) ? ' na rota <strong>"'.$req.'"</strong>.' : '.'));
		} catch (Exception $e) {
			self::abortar($e);
		}
	}

	/**
	 * Aborta a operação atual devido a um erro crítico
	 * @param  Exception $e
	 */
	private static function abortar(Exception $e) {
		exit($e->getMessage());
	}
}

?>

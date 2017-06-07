<?php declare(strict_types=1);
/**
 * Objeto que representa uma notificação utilizada por AppLog
 */

namespace App\Log;

use App\Uteis\Uteis;

final class Notificacao {
	// Desconhecido
	private const DESC = 0;
	// Utilizado para informar
	public const INFO = 1;
	// Avisar algo inesperado ou operação importante
	public const AVISO = 2;
	// Ao ocorrer um erro
	public const ERRO = 3;
	// Ao ocorrer algo relacionado ao banco de dados
	public const DB = 4;

	private const TIPOS = [
		self::DESC => [
			'string' => 'Erro desconhecido',
			'icone' => 'fa-question-circle'
		],

		self::INFO => [
			'string' => 'Informação',
			'icone' => 'fa-info-circle'
		],

		self::AVISO => [
			'string' => 'Aviso',
			'icone' => 'fa-exclamation'
		],

		self::ERRO => [
			'string' => 'Erro',
			'icone' => 'fa-exclamation-triangle'
		],

		self::DB => [
			'string' => 'Banco de dados',
			'icone' => 'fa-database'
		]
	];

	private $msg;
	private $tipo;

	public function __construct(int $tipo, string $msg) {
		$this->tipo = $tipo;
		$this->msg = Uteis::filtrarEntidadesHtml($msg);
	}

	public function getMensagem() : string {
		return $this->msg;
	}

	public function getTipoString() : string {
		return self::TIPOS[$this->tipo]['string'] ?? self::TIPOS[self::DESC]['string'];
	}

	public function getTipoIcone() : string {
		return self::TIPOS[$this->tipo]['icone'] ?? self::TIPOS[self::DESC]['icone'];
	}
}

?>
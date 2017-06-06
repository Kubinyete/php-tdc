<?php declare(strict_types=1);
/**
 * Objeto que representa uma notificação utilizada por AppLog
 */

namespace App\Log;

use App\Uteis\Uteis;

final class Notificacao {
	// Utilizado para informar
	public const INFO = 1;
	// Avisar algo inesperado ou operação importante
	public const AVISO = 2;
	// Ao ocorrer um erro
	public const ERRO = 3;
	// Ao ocorrer um erro crítico
	public const CRITICO = 4;

	// Representação dos tipos em string
	private const TIPO_STRING = [
		'Desconhecido',					#DESC
		'Info',							#INFO
		'Aviso',						#AVISO
		'Erro',							#ERRO
		'Crítico'						#CRITICO
	];

	// Ícones em Font Awesome
	private const TIPO_FA_ICONE = [
		'fa-question-circle',			#DESC
		'fa-info-circle',				#INFO
		'fa-exclamation',				#AVISO
		'fa-exclamation-triangle',		#ERRO
		'fa-power-off'					#CRITICO
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

	public function getTipoId() : int {
		return $this->tipo;
	}

	public function getTipoString() : string {
		return self::TIPO_STRING[$this->tipo] ?? self::TIPO_STRING[0];
	}

	public function getTipoIcone() : string {
		return self::TIPO_FA_ICONE[$this->tipo] ?? self::TIPO_FA_ICONE[0];
	}
}

?>
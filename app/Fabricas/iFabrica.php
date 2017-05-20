<?php declare(strict_types=1);
/**
 * Interface que impede a criação de fábricas sem um método criar
 */

namespace App\Fabricas;

interface iFabrica {
	// Retorna uma nova instância de determinado objeto
	// se nada for passado como argumentos, retorne um objeto genêrico para testes
	public static function criar();
}

?>
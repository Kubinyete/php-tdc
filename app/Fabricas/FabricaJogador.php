<?php declare(strict_types=1);
/**
 * Fábrica de Jogadores
 */

namespace App\Fabricas;

use App\Objetos\Jogador;
use App\Objetos\Alianca;
use App\Fabricas\FabricaBase;
use App\Interfaces\FabricaInterface;

abstract class FabricaJogador extends FabricaBase implements FabricaInterface {
	// $contador

	public static function criar(?Alianca $alianca = null, ?string $nome = null, string $nickname = '', int $nivel = 0, ?string $telefone = null, string $email = '', int $tipo = 0) : Jogador {
		$datetime = parent::getDatetimeAtual();

		return new Jogador(
			parent::getNovoId(),
			$datetime,
			$alianca,
			null,
			$datetime,
			null,
			null,
			0,
			$nome,
			$nickname,
			$nivel,
			$telefone,
			$email,
			$tipo,
			true,
			null
		);
	}
}

?>

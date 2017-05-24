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
	/**
	 * Retorna um novo Jogador
	 * @param  Alianca|null $alianca  
	 * @param  string|null  $nome     
	 * @param  string       $nickname 
	 * @param  int|integer  $nivel    
	 * @param  string|null  $telefone 
	 * @param  string       $email    
	 * @param  int|integer  $tipo     
	 * @return Jogador                 
	 */
	public static function criar(?Alianca $alianca = null, ?string $nome = null, string $nickname = '', int $nivel = 0, ?string $telefone = null, string $email = '', int $tipo = 0) : Jogador {
		$datetime = self::getDatetimeAtual();

		return new Jogador(
			self::getNovoId(),
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

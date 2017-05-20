<?php declare(strict_types=1);
/**
 * Fábrica de Usuarios
 */

namespace App\Fabricas;

use App\Objetos\Usuario;
use App\Config\Config;
use App\Fabricas\iFabrica;

abstract class FabricaUsuario extends FabricaBase implements iFabrica {
	// $contador

	/**
	 * Cria um novo objeto Usuario
	 * @param  string|null  $login
	 * @param  string|null  $senha
	 * @param  string|null  $nickname
	 * @param  bool|boolean $criarHash
	 * @param  string|null  $algoritmoHash
	 * @return Usuario
	 */
	public static function criar(?string $login = null, ?string $senha = null, ?string $nickname = null, bool $criarHash = true, ?string $algoritmoHash = null) : Usuario {
		return new Usuario(
			parent::getNovoId(),            // Não tem problema atribuir um id aqui e depois enviar
											// este usuário para o banco, pois todos os objetos do
											// banco apresentar um AUTO_INCREMENT em seu id, então
											// mesmo que tentassemos atribuir um id, ocorreria um
											// erro.
			parent::getDatetimeAtual(),
			$login ?? 'usuario',
			$senha ?? 'senha',
			$nickname ?? 'usuario',
			$criarHash,
			$algoritmoHash ?? Config::get('Usuarios.algoritmoHash') // Se não for especificado um
			                                                        // algorimo na chamada desta
			                                                        // função, utilize o algoritmo
			                                                        // especificado no arquivo
			                                                        // de configurações
		);
	}
}

?>
<?php declare(strict_types=1);
/**
 * Camada de acesso ao banco de dados para obter Mapas do banco de dados
 */

namespace App\Database;

use App\Database\SqlComando;
use App\Objetos\Mapa;

final class DalMapas extends DalBase {
	private const SQL_TABELA = 'Mapas';

	/**
	 * Retorna um Mapa do banco de dados
	 * @param  int    $id
	 * @return Mapa|null
	 */
	public function obter(int $id) : ?Mapa {
		$sql = new SqlComando();
		$sql->select()->from(self::SQL_TABELA)->where('map_id', '=', $id)->limit(1);

		$this->conectar();

		$lista = $this->getObjetos($sql, 
			function(array $arrayObjeto) : Mapa {
				return new Mapa(
					intval($arrayObjeto['map_id']),
					'', # Um Mapa não deve ter data de criação, para evitar criar outro objeto base Ex: ObjetoSemData, vamos apenas setar isso como vazio
					$arrayObjeto['map_nome']
				);
			}
		);

		$this->desconectar();

		if (count($lista) >= 1)
			return $lista[0];
		else
			return null;
	}
}

?>
<?php declare(strict_types=1);
/**
 * Camada de acesso ao banco de dados para manipular Missoes no banco de dados
 */

namespace App\Database;

use \PDO;
use App\Database\SqlComando;
use App\Objetos\Missao;

final class DalMissoes extends DalBase {
	private const SQL_TABELA = 'Missoes';

	/**
	 * Cria uma missao no banco de dados
	 * @param  Missao $missao
	 * @return bool
	 */
	public function criar(Missao $missao) : bool {
		$sucesso = false;

		$sql = new SqlComando();
		$sql->insert(self::SQL_TABELA,
			[
				'ali_id' => $missao->getAliancaId(),
				'map_id' => $missao->getMapaId(),
				'mis_vitoria' => $missao->getVitoria(),
				'mis_percentual_explorado' => $missao->getPercentualExplorado(),
				'mis_data_criacao' => $missao->getDataCriacao()
			]
		)->semicolon();

		$this->conectar();
		$this->iniciarTransacao();
		
		$linhasAfetadas = $this->exec($sql);

		if ($linhasAfetadas >= 1) {
			$this->salvarTransacao();

			$sql->setTextoComando(null);
			$sql->select('mis_id')->from(self::SQL_TABELA)->order('mis_id', false)->limit(1);

			$query = $this->executar($sql);

			if ($query !== null) {
				$query = $query->fetchAll(PDO::FETCH_ASSOC);
				
				if (count($query) >= 1) {
					$missao->setId(intval($query[0]['mis_id']));

					$sucesso = true;
				}
			}
		} else {
			$this->descartarTransacao();
		}

		$this->desconectar();

		return $sucesso;
	}

	/**
	 * Retorna uma Missao do banco de dados
	 * @param  int    $id
	 * @return Missao|null
	 */
	public function obter(int $id) : ?Missao {
		$sql = new SqlComando();
		$sql->select()->from(self::SQL_TABELA)->where('mis_id', '=', $id)->limit(1);

		$this->conectar();

		$lista = $this->getObjetos($sql, 
			function(array $arrayObjeto) : Missao {
				return new Missao(
					intval($arrayObjeto['mis_id']),
					$arrayObjeto['mis_data_criacao'],
					intval($arrayObjeto['ali_id']),
					intval($arrayObjeto['map_id']),
					$arrayObjeto['mis_vitoria'],
					intval($arrayObjeto['mis_percentual_explorado'])
				);
			}
		);

		$this->desconectar();

		if (count($lista) >= 1)
			return $lista[0];
		else
			return null;
	}

	/**
	 * Atualiza uma Missao no banco de dados
	 * @param  Missao $missao
	 * @return bool
	 */
	public function atualizar(Missao $missao) : bool {
		$sql = new SqlComando();

		return $this->modificar(
			$sql->update(self::SQL_TABELA, 
				[
					'map_id' => $missao->getMapaId(),
					'mis_vitoria' => $missao->getVitoria(),
					'mis_percentual_explorado' => $missao->getPercentualExplorado()
				]
			)->where('mis_id', '=', $missao->getId())->limit(1)
		);
	}

	/**
	 * Remove uma Missao do banco de dados
	 * @param  Missao $missao
	 * @return bool
	 */
	public function deletar(Missao $missao) : bool {
		$sql = new SqlComando();
		
		return $this->modificar(
			$sql->delete(self::SQL_TABELA)->where('mis_id', '=', $missao->getId())->limit(1)
		);
	}
}

?>

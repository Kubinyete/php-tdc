<?php declare(strict_types=1);
/**
 * Camada de acesso ao banco de dados para manipular Guerras no banco de dados
 */

namespace App\Database;

use App\Database\SqlComando;
use App\Objetos\Guerra;

final class DalGuerras extends DalBase {
	private const SQL_TABELA = 'Guerras';

	/**
	 * Cria uma guerra no banco de dados
	 * @param  Guerra $guerra
	 * @return bool
	 */
	public function criar(Guerra $guerra) : bool {
		$sucesso = false;

		$sql = new SqlComando();
		$sql->insert(self::SQL_TABELA,
			[
				'ali_id' => $guerra->getAliancaId(),
				'grr_nome_adversario' => $guerra->getNomeAdversario(),
				'grr_vitoria' => $guerra->getVitoria(),
				'grr_data_criacao' => $guerra->getDataCriacao()
			]
		)->semicolon();

		$this->conectar();
		$this->iniciarTransacao();
		
		$linhasAfetadas = $this->exec($sql);

		if ($linhasAfetadas >= 1) {
			$this->salvarTransacao();

			$sql->setTextoComando(null);
			$sql->select('grr_id')->from(self::SQL_TABELA)->order('grr_id', false)->limit(1);

			$query = $this->executar($sql);

			if ($query !== null) {
				$query = $query->fetchAll(PDO::FETCH_ASSOC);
				
				if (count($query) >= 1) {
					$guerra->setId(intval($query[0]['grr_id']));

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
	 * Retorna uma Guerra do banco de dados
	 * @param  int    $id
	 * @return Guerra|null
	 */
	public function obter(int $id) : ?Guerra {
		$sql = new SqlComando();
		$sql->select()->from(self::SQL_TABELA)->where('grr_id', '=', $id)->limit(1);

		$this->conectar();

		$lista = $this->getObjetos($sql, 
			function(array $arrayObjeto) : Guerra {
				return new Guerra(
					intval($arrayObjeto['grr_id']),
					$arrayObjeto['grr_data_criacao'],
					intval($arrayObjeto['ali_id']),
					$arrayObjeto['grr_nome_adversario'],
					$arrayObjeto['grr_vitoria']
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
	 * Atualiza uma Guerra no banco de dados
	 * @param  Guerra $guerra
	 * @return bool
	 */
	public function atualizar(Guerra $guerra) : bool {
		$sql = new SqlComando();

		return $this->modificar(
			$sql->update(self::SQL_TABELA, 
				[
					'grr_nome_adversario' => $guerra->getNomeAdversario(),
					'grr_vitoria' => $guerra->getVitoria()
				]
			)->where('grr_id', '=', $guerra->getId())->limit(1)
		);
	}

	/**
	 * Remove uma Guerra do banco de dados
	 * @param  Guerra $guerra
	 * @return bool
	 */
	public function deletar(Guerra $guerra) : bool {
		$sql = new SqlComando();
		
		return $this->modificar(
			$sql->delete(self::SQL_TABELA)->where('grr_id', '=', $guerra->getId())->limit(1)
		);
	}
}

?>

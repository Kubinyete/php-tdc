<?php declare(strict_types=1);
/**
 * Camada de acesso ao banco de dados para manipular Grupos no banco de dados
 */

namespace App\Database;

use \PDO;
use App\Database\SqlComando;
use App\Objetos\Grupo;
use App\Objetos\Alianca;

final class DalGrupos extends DalBase {
	private const SQL_TABELA = 'Grupos';

	/**
	 * Cria um Grupo no banco de dados
	 * @param  Grupo  $grupo
	 * @return bool
	 */
	public function criar(Grupo $grupo) : bool {
		$sucesso = false;

		$sql = new SqlComando();
		$sql->insert(self::SQL_TABELA,
			[
				'ali_id' => $grupo->getAliancaId(),
				'grp_nome' => $grupo->getNome(),
				'grp_data_criacao' => $grupo->getDataCriacao()
			]
		)->semicolon();

		$this->conectar();
		$this->iniciarTransacao();
		
		$linhasAfetadas = $this->exec($sql);

		if ($linhasAfetadas >= 1) {
			$this->salvarTransacao();

			$sql->setTextoComando(null);
			$sql->select('grp_id')->from(self::SQL_TABELA)->order('grp_id', false)->limit(1);

			$query = $this->executar($sql);

			if ($query !== null) {
				$query = $query->fetchAll(PDO::FETCH_ASSOC);
				
				if (count($query) >= 1) {
					$grupo->setId(intval($query[0]['grp_id']));

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
	 * Retorna um Grupo do banco de dados
	 * @param  int    $id
	 * @return Grupo|null
	 */
	public function obter(int $id) : ?Grupo {
		$sql = new SqlComando();
		$sql->select()->from(self::SQL_TABELA)->where('grp_id', '=', $id)->limit(1);

		$this->conectar();

		$lista = $this->getObjetos($sql, 
			function(array $arrayObjeto) : Grupo {
				return new Grupo(
					intval($arrayObjeto['grp_id']),
					$arrayObjeto['grp_data_criacao'],
					intval($arrayObjeto['ali_id']),
					$arrayObjeto['grp_nome']
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
	 * Retorna uma lista de Grupos de determinada $alianca
	 * @param  Alianca $alianca
	 * @return array|null
	 */
	public function obterTodosAlianca(Alianca $alianca) : ?array {
		$sql = new SqlComando();
		$sql->select()->from(self::SQL_TABELA)->where('ali_id', '=', $alianca->getId());

		$this->conectar();

		$lista = $this->getObjetos($sql,
			function(array $arrayObjeto) : Grupo {
				return new Grupo(
					intval($arrayObjeto['grp_id']),
					$arrayObjeto['grp_data_criacao'],
					intval($arrayObjeto['ali_id']),
					$arrayObjeto['grp_nome']
				);
			}
		);

		$this->desconectar();

		return $lista;
	}

	/**
	 * Atualiza um Grupo no banco de dados
	 * @param  Grupo  $grupo
	 * @return bool
	 */
	public function atualizar(Grupo $grupo) : bool {
		$sql = new SqlComando();

		return $this->modificar(
			$sql->update(self::SQL_TABELA, 
				[
					'grp_nome' => $grupo->getNome()
				]
			)->where('grp_id', '=', $grupo->getId())->limit(1)
		);
	}

	/**
	 * Deleta um Grupo do banco de dados
	 * @param  Grupo  $grupo
	 * @return bool
	 */
	public function deletar(Grupo $grupo) : bool {
		$sql = new SqlComando();

		return $this->modificar(
			$sql->delete(self::SQL_TABELA)->where('grp_id', '=', $grupo->getId())->limit(1)
		);
	}
}

?>
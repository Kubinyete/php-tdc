<?php declare(strict_types=1);
/**
 * Camada de acesso ao banco de dados para a manipulação de Alianças
 */

namespace App\Database;

use \PDO;
use App\Database\SqlComando;
use App\Objetos\Alianca;
use App\Objetos\Usuario;

final class DalAliancas extends DalBase {
	private const SQL_TABELA = 'Aliancas';

	/**
	 * Cria um objeto Alianca no banco de dados
	 * @param  Alianca $alianca
	 * @return bool
	 */
	public function criar(Alianca $alianca) : bool {
		$sucesso = false;

		$sql = new SqlComando();
		$sql->insert(self::SQL_TABELA,
			[
				'usr_id' => $alianca->getUsuarioId(),
				'ali_nome' => $alianca->getNome(),
				'ali_data_criacao' => $alianca->getDataCriacao()
			]
		)->semicolon();

		$this->conectar();
		$this->iniciarTransacao();

		$linhasAfetadas = $this->exec($sql);

		if ($linhasAfetadas >= 1) {
			$this->salvarTransacao();

			$sql->setTextoComando(null);
			$sql->select('ali_id')->from(self::SQL_TABELA)->order('ali_id', false)->limit(1);

			$query = $this->executar($sql);

			if ($query !== null) {
				$query = $query->fetchAll(PDO::FETCH_ASSOC);

				if (count($query) >= 1) {
					$alianca->setId(intval($query[0]['ali_id']));

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
	 * Retorna um objeto Alianca do banco de dados
	 * @param  int       $id
	 * @return Alianca|null
	 */
	public function obter(int $id) : ?Alianca {
		$sql = new SqlComando();
		$sql->select()->from(self::SQL_TABELA)->where('ali_id', '=', $id)->limit(1);

		$this->conectar();

		$lista = $this->getObjetos($sql,
			function (array $arrayObjetos) : Alianca {
				return new Alianca(
					intval($arrayObjetos['ali_id']),
					$arrayObjetos['ali_data_criacao'],
					intval($arrayObjetos['usr_id']),
					$arrayObjetos['ali_nome']
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
	 * Retorna uma lista de objetos Alianca de um Usuario do banco de dados
	 * @param  Usuario       $usuario
	 * @return array
	 */
	public function obterDeUmUsuario(Usuario $usuario) : array {
		$sql = new SqlComando();
		$sql->select()->from(self::SQL_TABELA)->where('usr_id', '=', $usuario->getId());

		$this->conectar();

		$lista = $this->getObjetos($sql,
			function (array $arrayObjetos) : Alianca {
				return new Alianca(
					intval($arrayObjetos['ali_id']),
					$arrayObjetos['ali_data_criacao'],
					intval($arrayObjetos['usr_id']),
					$arrayObjetos['ali_nome']
				);
			}
		);

		$this->desconectar();

		return $lista;
	}

	/**
	 * Retorna uma lista de objetos Alianca de um Usuario do banco de dados
	 * @param  int       $id
	 * @return array
	 */
	public function obterDeUmUsuarioId(int $id) : array {
		$sql = new SqlComando();
		$sql->select()->from(self::SQL_TABELA)->where('usr_id', '=', $id);

		$this->conectar();

		$lista = $this->getObjetos($sql,
			function (array $arrayObjetos) : Alianca {
				return new Alianca(
					intval($arrayObjetos['ali_id']),
					$arrayObjetos['ali_data_criacao'],
					intval($arrayObjetos['usr_id']),
					$arrayObjetos['ali_nome']
				);
			}
		);

		$this->desconectar();

		return $lista;
	}

	/**
	 * Retorna a contagem de Aliancas de determinado Usuário
	 * @param  Usuario       $usuario
	 * @return array
	 */
	public function obterContagemAliancasDeUmUsuario(Usuario $usuario) : int {
		$sql = new SqlComando();
		$sql->select('COUNT()')->as('contagem')->from(self::SQL_TABELA)->where('usr_id', '=', $usuario->getId());

		$this->conectar();

		$lista = $this->getObjetos($sql,
			function (array $arrayObjetos) : int {
				return intval($arrayObjetos['contagem']);
			}
		);

		$this->desconectar();

		if (count($lista) >= 1)
			return $lista[0];
		else
			return 0;
	}

	/**
	 * Atualiza as propriedades de uma Alianca no banco de dados
	 * @param  Alianca $alianca
	 * @return bool
	 */
	public function atualizar(Alianca $alianca) : bool {
		$sql = new SqlComando();

		return $this->modificar(
			$sql->update(self::SQL_TABELA,
				[
					'ali_nome' => $alianca->getNome()
				]
			)->where('ali_id', '=', $alianca->getId())->limit(1)
		);
	}

	/**
	 * Remove uma Alianca do banco de dados
	 * @param  Alianca $alianca
	 * @return bool
	 */
	public function deletar(Alianca $alianca) : bool {
		$sql = new SqlComando();

		return $this->modificar(
			$sql->delete(self::SQL_TABELA)->where('ali_id', '=', $alianca->getId())->limit(1)
		);
	}
}

?>

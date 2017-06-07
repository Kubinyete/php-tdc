<?php declare(strict_types=1);
/**
 * Camada de acesso ao banco de dados para a manipulação de Alianças
 */

namespace App\Database;

use \PDO;
use App\Database\SqlComando;
use App\Objetos\Alianca;

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
				'usr_id' => $alianca->getUsuario()->getId(),
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
					$arrayObjetos['ali_id'],
					$arrayObjetos['ali_data_criacao'],
					$arrayObjetos['usr_id'],
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
			)->where('ali_id', '=', $alianca->getId())->limit(1));
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
?>

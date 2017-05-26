<?php declare(strict_types=1);
/**
 * Camada de acesso ao banco de dados para a manipulação de Alianças
 */

namespace App\Database;

use \PDO;
use App\Database\SqlComando;
use App\Objetos\Usuario;
use App\Objetos\Alianca;

final class DalAlianca extends DalBase {
	// $conexao / get / set
	// executar()
	// exec()
	// iniciarTransacao()
	// descartarTransacao()
	// salvarTransacao()
	// emTransacao()
	// getObjetos()
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
	 * @param  int    $id
	 * @return Alianca|null
	 */
	public function obter(int $id) : ?Alianca {
		$sql = new SqlComando();
		$sql->select()->from(self::SQL_TABELA)->where('ali_id', '=', $id)->limit(1);

		$this->conectar();

		$lista = $this->getObjetos($sql,
			function (array $arrayObjetos) : Usuario {
				return new Alianca(
					$arrayObjetos['ali_id'],
					$arrayObjetos['ali_data_criacao'],

				);
			}
		);
	}
	public function atualizar();
	public function deletar();
?>

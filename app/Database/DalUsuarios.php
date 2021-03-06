<?php declare(strict_types=1);
/**
 * Camada de acesso ao banco de dados para manipular Usuarios no banco de dados
 */

namespace App\Database;

use \PDO;
use App\Database\SqlComando;
use App\Objetos\Usuario;

final class DalUsuarios extends DalBase {
	private const SQL_TABELA = 'Usuarios';

	/**
	 * Cria um usuário no banco de dados de acordo com o objeto Usuario informado
	 * @param  Usuario $usuario
	 * @return bool
	 */
	public function criar(Usuario $usuario) : bool {
		$sucesso = false;

		$sql = new SqlComando();
		$sql->insert(self::SQL_TABELA,
			[
				'usr_login' => $usuario->getLogin(),
				'usr_senha' => $usuario->getHashSenha(),
				'usr_data_criacao' => $usuario->getDataCriacao()
			]
		)->semicolon();

		$this->conectar();
		$this->iniciarTransacao();

		$linhasAfetadas = $this->exec($sql);

		if ($linhasAfetadas >= 1) {
			$this->salvarTransacao();

			$sql->setTextoComando(null);
			$sql->select('usr_id')->from(self::SQL_TABELA)->order('usr_id', false)->limit(1);

			$query = $this->executar($sql);

			if ($query !== null) {
				$query = $query->fetchAll(PDO::FETCH_ASSOC);

				if (count($query) >= 1) {
					$usuario->setId(intval($query[0]['usr_id']));

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
	 * Retorna um usuário do banco de dados de acordo com o id informado
	 * @param  int    $id
	 * @return Usuario|null
	 */
	public function obter(int $id) : ?Usuario {
		$sql = new SqlComando();
		$sql->select()->from(self::SQL_TABELA)->where('usr_id', '=', $id)->limit(1);

		$this->conectar();

		$lista = $this->getObjetos($sql,
			function(array $arrayObjeto) : Usuario {
				return new Usuario(
					intval($arrayObjeto['usr_id']),
					$arrayObjeto['usr_data_criacao'],
					$arrayObjeto['usr_login'],
					$arrayObjeto['usr_senha']
				);
			}
		);

		$this->desconectar();

		if (count($lista) >= 1)
			return $lista[0];
		else
			return null;
	}

	public function obterPeloNome(string $nome) : ?Usuario {
		$sql = new SqlComando();
		$sql->select()->from(self::SQL_TABELA)->where('usr_login', '=', $nome)->limit(1);

		$this->conectar();

		$lista = $this->getObjetos($sql,
			function(array $arrayObjeto) : Usuario {
				return new Usuario(
					intval($arrayObjeto['usr_id']),
					$arrayObjeto['usr_data_criacao'],
					$arrayObjeto['usr_login'],
					$arrayObjeto['usr_senha']
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
	 * Atualiza o estado de um usuario no banco de dados de acordo com as modificações efetuadas
	 * no objeto Usuario informado
	 * @param  Usuario $usuario
	 * @return bool
	 */
	public function atualizar(Usuario $usuario) : bool {
		$sql = new SqlComando();

		return $this->modificar(
			$sql->update(self::SQL_TABELA,
				[
					'usr_login' => $usuario->getLogin(),
					'usr_senha' => $usuario->getHashSenha()
				]
			)->where('usr_id', '=', $usuario->getId())->limit(1)
		);
	}

	/**
	 * Deleta um usuário do banco de daddos de caordo com o Usuario informado
	 * @param  Usuario $usuario
	 * @return bool
	 */
	public function deletar(Usuario $usuario) : bool {
		$sql = new SqlComando();

		return $this->modificar(
			$sql->delete(self::SQL_TABELA)->where('usr_id', '=', $usuario->getId())->limit(1)
		);
	}
}

?>

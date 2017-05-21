<?php declare(strict_types=1);
/**
 * Camada de acesso ao banco de dados para manipular Usuarios no banco de dados
 */

namespace App\Database;

use App\Database\SqlComando;
use App\Objetos\Usuario;
use App\Fabricas\FabricaUsuario;

final class DalUsuario extends DalBase implements iDalCrud {
	// $conexao / get / set
	// executar()
	// exec()
	// iniciarTransacao()
	// descartarTransacao()
	// salvarTransacao()
	// emTransacao()
	// getObjetos()
	private const TABELA = 'Usuarios';

	/**
	 * Cria um usuário no banco de dados de acordo com o objeto Usuario informado
	 * @param  Usuario $usuario
	 * @return bool
	 */
	public function criar(Usuario $usuario) : bool {
		$sucesso = false;

		$sql = new SqlComando();
		$sql->insert(self::TABELA,
			[
				'usr_login' => $usuario->getLogin(),
				'usr_senha' => $usuario->getHashSenha(),
				'usr_nickname' => $usuario->getNickname(),
				'usr_data_criacao' => $usuario->getDataCriacao()
			]
		)->semicolon()->select('usr_id')->from(self::TABELA)->order('usr_id', false)->limit(1);

		$this->iniciarTransacao();
		
		$query = $this->executar($sql);

		if ($query !== null) {
			$query = $query->fetchAll(PDO::FETCH_ASSOC);
			$usuario->setId($query[0]['usr_id']);

			$this->salvarTransacao();

			$sucesso = true;
		} else {
			$query->closeCursor();
			$this->descartarTransacao();
		}

		return $sucesso;
	}

	/**
	 * Retorna um usuário do banco de dados de acordo com o id informado
	 * @param  int    $id
	 * @return Usuario|null
	 */
	public function obter(int $id) : ?Usuario {
		$sql = new SqlComando();
		$sql->select()->from(self::TABELA)->where('usr_id', '=', $id)->limit(1);

		$lista = $this->getObjetos($sql, 
			function(array $arrayObjeto) : Usuario {
				return new Usuario(
					$arrayObjeto['usr_id'],
					$arrayObjeto['usr_data_criacao'],
					$arrayObjeto['usr_login'],
					$arrayObjeto['usr_senha'],
					$arrayObjeto['usr_nickname']
				);
			}
		);

		if (count($lista) >= 1)
			return $lista[0];
		else
			return;
	}

	/**
	 * Atualiza o estado de um usuario no banco de dados de acordo com as modificações efetuadas
	 * no objeto Usuario informado
	 * @param  Usuario $usuario 
	 * @return bool
	 */
	public function atualizar(Usuario $usuario) : bool {
		$sucesso = false;

		$sql = new SqlComando();
		$sql->update(self::TABELA, 
			[
				'usr_login' => $usuario->getLogin(),
				'usr_senha' => $usuario->getHashSenha(),
				'usr_nickname' => $usuário->getNickname()
			]
		)->where('usr_id', '=', $usuario->getId())->limit(1);

		$this->iniciarTransacao();
		$linhasAfetadas = $this->exec($sql);

		if ($linhasAfetadas === 1) {
			$this->salvarTransacao();
			$sucesso = true;
		} else {
			$this->descartarTransacao();
		}

		return $sucesso;
	}

	/**
	 * Deleta um usuário do banco de daddos de caordo com o Usuario informado
	 * @param  Usuario $usuario
	 * @return bool
	 */
	public function deletar(Usuario $usuario) : bool {
		$sucesso = false;

		$sql = new SqlComando();
		$sql->delete(self::TABELA)->where('usr_id', '=', $usuario->getId())->limit(1);

		$this->iniciarTransacao();
		$linhasAfetadas = $this->exec($sql);

		if ($linhasAfetadas === 1) {
			$this->salvarTransacao();
			$sucesso = true;
		} else {
			$this->descartarTransacao();
		}

		return $sucesso;
	}
}

?>
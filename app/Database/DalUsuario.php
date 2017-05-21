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
				'usr_senha' => $usuario->getSenha(),
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
}

?>
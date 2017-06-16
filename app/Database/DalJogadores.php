<?php declare(strict_types=1);
/**
 * Camada de acesso ao banco de dados para manipular Jogadores no banco de dados
 */

namespace App\Database;

use \PDO;
use App\Database\SqlComando;
use App\Objetos\Jogador;
use App\Objetos\Alianca;

final class DalJogadores extends DalBase {
	private const SQL_TABELA = 'Jogadores';

	/**
	 * Cria um Jogador no banco de dados
	 * @param  Jogador $jogador
	 * @return bool
	 */
	public function criar(Jogador $jogador) : bool {
		$sucesso = false;

		$sql = new SqlComando();
		$sql->insert(self::SQL_TABELA,
			[
				'ali_id' => $jogador->getAliancaId(),
				'jgd_nome' => $jogador->getNome(),
				'jgd_nickname' => $jogador->getNickname(),
				'jgd_nivel' => $jogador->getNivel(),
				'jgd_telefone' => $jogador->getTelefone(),
				'jgd_email' => $jogador->getEmail(),
				'jgd_tipo' => $jogador->getTipo(),
				'jgd_status' => $jogador->getStatus(),
				'jgd_observacoes' => $jogador->getObservacoes(),
				'jgd_data_criacao' => $jogador->getDataCriacao()
			]
		)->semicolon();

		$this->conectar();
		$this->iniciarTransacao();
		
		$linhasAfetadas = $this->exec($sql);

		if ($linhasAfetadas >= 1) {
			$this->salvarTransacao();

			$sql->setTextoComando(null);
			$sql->select('jgd_id')->from(self::SQL_TABELA)->order('jgd_id', false)->limit(1);

			$query = $this->executar($sql);

			if ($query !== null) {
				$query = $query->fetchAll(PDO::FETCH_ASSOC);
				
				if (count($query) >= 1) {
					$jogador->setId(intval($query[0]['jgd_id']));

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
	 * Retorna um Jogador do banco de dados
	 * @param  int    $id
	 * @return Jogador|null
	 */
	public function obter(int $id) : ?Jogador {
		$sql = new SqlComando();
		$sql->select()->from(self::SQL_TABELA)->where('jgd_id', '=', $id)->limit(1);

		$this->conectar();

		$lista = $this->getObjetos($sql, 
			function(array $arrayObjeto) : Jogador {
				return new Jogador(
					intval($arrayObjeto['jgd_id']),
					$arrayObjeto['jgd_data_criacao'],
					intval($arrayObjeto['ali_id']),
					0, # Não quero saber que grupo ele está
					'', # Não quero saber a data em que ele foi adicionado em um grupo
					0, # Não quero saber que missão ele está
					0, # Não quero saber que guerra ele está
					0, # Não quero saber sua pontuação em um evento
					$arrayObjeto['jgd_nome'],
					$arrayObjeto['jgd_nickname'],
					intval($arrayObjeto['jgd_nivel']),
					$arrayObjeto['jgd_telefone'],
					$arrayObjeto['jgd_email'],
					intval($arrayObjeto['jgd_tipo']),
					$arrayObjeto['jgd_status'],
					$arrayObjeto['jgd_observacoes']
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
	 * Retorna a contagem de jogadores de determinada Aliança
	 * @param  Alianca    $alianca
	 * @return Jogador|null
	 */
	public function obterContagemAlianca(Alianca $alianca) : int {
		$sql = new SqlComando();
		$sql->select('COUNT(*)')->as('contagem')->from(self::SQL_TABELA)->where('ali_id', '=', $alianca->getId());

		$this->conectar();

		$lista = $this->getObjetos($sql, 
			function(array $arrayObjeto) : int {
				return intval($arrayObjeto['contagem']);
			}
		);

		$this->desconectar();

		if (count($lista) >= 1)
			return $lista[0];
		else
			return 0;
	}

	/**
	 * Atualiza um Jogador do banco de dados
	 * @param  Jogador $jogador
	 * @return bool
	 */
	public function atualizar(Jogador $jogador) : bool {
		$sql = new SqlComando();

		return $this->modificar(
			$sql->update(self::SQL_TABELA, 
				[
					'jgd_nome' => $jogador->getNome(),
					'jgd_nickname' => $jogador->getNickname(),
					'jgd_nivel' => $jogador->getNivel(),
					'jgd_telefone' => $jogador->getTelefone(),
					'jgd_email' => $jogador->getEmail(),
					'jgd_tipo' => $jogador->getTipo(),
					'jgd_status' => $jogador->getStatus(),
					'jgd_observacoes' => $jogador->getObservacoes()
				]
			)->where('jgd_id', '=', $jogador->getId())->limit(1)
		);
	}

	/**
	 * Remove um Jogador do banco de dados
	 * @param  Jogador $jogador
	 * @return bool
	 */
	public function deletar(Jogador $jogador) : bool {
		$sql = new SqlComando();
		
		return $this->modificar(
			$sql->delete(self::SQL_TABELA)->where('jgd_id', '=', $jogador->getId())->limit(1)
		);
	}
}

?>
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
					boolval($arrayObjeto['jgd_status']),
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
	 * Retorna uma lista de Jogadores de determinada Aliança
	 * @param  Alianca    $alianca
	 * @return Jogador|null
	 */
	public function obterAlianca(Alianca $alianca, $incluirDesativados = false) : array {
		$sql = new SqlComando();
		$sql->select()->from(self::SQL_TABELA)->where('ali_id', '=', $alianca->getId());

		if (!$incluirDesativados)
			$sql->and()->expr('jgd_status', '=', true);

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
					boolval($arrayObjeto['jgd_status']),
					$arrayObjeto['jgd_observacoes']
				);
			}
		);

		$this->desconectar();

		return $lista;
	}

	public function obterJogadoresGrupoListaJogadoresInformacoes(array $info) : array {
		$sql = new SqlComando();
		$sql->select()->from(self::SQL_TABELA);

		$first = true;
		foreach ($info as $jogador) {
			if ($first) {
				$first = false;
				$sql->where('jgd_id', '=', $jogador->getId());
			} else {
				$sql->or()->expr('jgd_id', '=', $jogador->getId());
			}
		}

		$podeReceberInfo = count($info) > 0;

		$infoPorId = [];

		if ($podeReceberInfo) {
			foreach ($info as $i) {
				$infoPorId[$i['jgd_id']] = [];

				foreach ($i as $k => $v)
					$infoPorId[$i['jgd_id']][$k] = $v;
			}
		}

		$this->conectar();

		$lista = $this->getObjetos($sql, 
			function(array $arrayObjeto) use ($podeReceberInfo, $infoPorId) : Jogador {
				return new Jogador(
					intval($arrayObjeto['jgd_id']),
					$arrayObjeto['jgd_data_criacao'],
					intval($arrayObjeto['ali_id']),
					($podeReceberInfo) ? $infoPorId[$arrayObjeto['jgd_id']]['grp_id'] : 0,
					($podeReceberInfo) ? $infoPorId[$arrayObjeto['jgd_id']]['jeu_data_adicionado'] : '',
					0, # Não quero saber que missão ele está
					0, # Não quero saber que guerra ele está
					0, # Não quero saber sua pontuação em um evento
					$arrayObjeto['jgd_nome'],
					$arrayObjeto['jgd_nickname'],
					intval($arrayObjeto['jgd_nivel']),
					$arrayObjeto['jgd_telefone'],
					$arrayObjeto['jgd_email'],
					intval($arrayObjeto['jgd_tipo']),
					boolval($arrayObjeto['jgd_status']),
					$arrayObjeto['jgd_observacoes']
				);
			}
		);

		$this->desconectar();

		return $lista;
	}

	/**
	 * Retorna a contagem de jogadores de determinada Aliança
	 * @param  Alianca    $alianca
	 * @param  bool       $incluirDesativados
	 * @return int
	 */
	public function obterContagemAlianca(Alianca $alianca, bool $incluirDesativados = false) : int {
		return $this->obterContagemAliancaId($alianca->getId(), $incluirDesativados);
	}

	/**
	 * Retorna a contagem de jogadores de determinada Aliança através do seu Id
	 * @param  int        $id
	 * @param  bool       $incluirDesativados
	 * @return int
	 */
	public function obterContagemAliancaId(int $id, bool $incluirDesativados = false) : int {
		$sql = new SqlComando();
		$sql->select('COUNT(*)')->as('contagem')->from(self::SQL_TABELA)->where('ali_id', '=', $id);

		if (!$incluirDesativados)
			$sql->and()->expr('jgd_status', '=', true);

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
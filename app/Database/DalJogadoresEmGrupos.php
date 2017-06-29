<?php declare(strict_types=1);
/**
 * Camada de acesso ao banco de dados para manipular JogadoresEmGrupos no banco de dados
 */

namespace App\Database;

use App\Database\SqlComando;
use App\Objetos\Jogador;
use App\Objetos\Grupo;

final class DalJogadoresEmGrupos extends DalBase {
	private const SQL_TABELA = 'JogadoresEmGrupos';

	/**
	 * Adiciona um Jogador a um grupo no banco de dados
	 * @param  Jogador $jogador
	 * @return bool
	 */
	public function adicionar(Jogador $jogador) : bool {
		$sucesso = false;

		$sql = new SqlComando();
		$sql->insert(self::SQL_TABELA,
			[
				'grp_id' => $jogador->getGrupoId(),
				'jgd_id' => $jogador->getId(),
				'jeu_data_adicionado' => $jogador->getDataAdicionado()
			]
		)->semicolon();

		$this->conectar();
		$this->iniciarTransacao();

		$linhasAfetadas = $this->exec($sql);

		if ($linhasAfetadas >= 1) {
			$this->salvarTransacao();

			$sucesso = true;
		} else {
			$this->descartarTransacao();
		}

		$this->desconectar();

		return $sucesso;
	}

	public function obterListaJogadoresInformacoes(Grupo $grp, bool $incluirDesativados = false) : ?array {
		$sql = new SqlComando();
		$sql->select()->from(self::SQL_TABELA)->where('grp_id', '=', $grp->getId());

		if (!$incluirDesativados)
			$sql->and()->expr('jgd_status', '=', true);

		$this->conectar();

		$lista = $this->getObjetos($sql, 
			function(array $arrayObjeto) : array {
				return [
					'jgd_id' => intval($arrayObjeto['jgd_id']),
					'grp_id' => intval($arrayObjeto['grp_id']),
					'jeu_data_adicionado' => $arrayObjeto['jeu_data_adicionado']
				];
			}
		);

		$this->desconectar();

		return $lista;
	}

	/**
	 * Atualiza em que grupo o Jogador está & sua data em que foi adicionado ao grupo
	 * @param  Jogador $jogador
	 * @return bool
	 */
	public function atualizar(Jogador $jogador) : bool {
		$sql = new SqlComando();

		return $this->modificar(
			$sql->update(self::SQL_TABELA,
				[
					'grp_id' => $jogador->getGrupoId(),
					'jeu_data_adicionado' => $jogador->getDataAdicionado()
				]
			)->where('jgd_id', '=', $jogador->getId())->limit(1)
		);
	}

	/**
	 * Fixa os dados da tabela (como o grupo em que ele está e a data adicionada) ao objeto Jogador
	 * @param  Jogador $jogador
	 * @return bool
	 */
	public function injetar(Jogador $jogador) : bool {
		$sql = new SqlComando();
		$sql->select('grp_id, jeu_data_adicionado')->from(self::SQL_TABELA)->where('jgd_id', '=', $id)->limit(1);

		$this->conectar();

		$lista = $this->getObjetos($sql,
			function(array $arrayObjeto) : array {
				return $arrayObjeto;
			}
		);

		$this->desconectar();

		if (count($lista) >= 1) {
			$jogador->setGrupoId(intval($lista[0]['grp_id']));
			$jogador->setDataAdicionado($lista[0]['jeu_data_adicionado']);
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Retorna se o Jogador informado está em um grupo nesta tabela
	 * @param  Jogador $jogador
	 * @return bool
	 */
	public function existe(Jogador $jogador) : bool {
		$sql = new SqlComando();
		$sql->select('COUNT(*)')->as('contagem')->from(self::SQL_TABELA)->where('jgd_id', '=', $jogador->getId())->limit(1);

		$this->conectar();

		$lista = $this->getObjetos($sql,
			function(array $arrayObjeto) : array {
				return $arrayObjeto;
			}
		);

		$this->desconectar();

		if (count($lista) >= 1)
			return ($lista[0]['contagem'] >= 1);
		else
			return false;
	}

	/**
	 * Remove um jogador de um grupo
	 * @param  Jogador $jogador
	 * @return bool
	 */
	public function remover(Jogador $jogador) : bool {
		$sql = new SqlComando();

		return $this->modificar(
			$sql->delete(self::SQL_TABELA)->where('jgd_id', '=', $jogador->getId())->limit(1)
		);
	}
}

?>

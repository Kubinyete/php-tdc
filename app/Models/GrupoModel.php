<?php declare(strict_types=1);
/**
 * Camada de acesso ao banco de dados para obtenção de dados necessários para o retorno
 * de uma página de grupo completa
 */

namespace App\Models;

use App\Models\ModelBase;
use App\Database\DalAliancas;
use App\Database\DalGrupos;
use App\Database\DalJogadores;
use App\Database\DalJogadoresEmGrupos;
use App\Views\GrupoView;
use App\Views\ErroView;

final class GrupoModel extends ModelBase {
	public function __invoke(int $aliancaId = 0, int $grupoId = 0) {
		$dal = new DalAliancas($this->getConexao());

		$alianca = $dal->obter($aliancaId);

		if ($alianca === null) {
			return $this->notfound();
		} else if ($alianca->getUsuarioId() !== $this->getUsuarioLogado()->getId()) {
			return $this->notfound();
		} else {
			$dal = new DalGrupos($this->getConexao());

			$grupo = $dal->obter($grupoId);
		}

		// Grupo existe e é meu?

		if ($grupo === null) {
			return $this->notfound();
		} else if ($grupo->getAliancaId() !== $alianca->getId()) {
			return $this->notfound();
		} else {
			$dal = new DalJogadoresEmGrupos($this->getConexao());

			$jogadoresInfo = $dal->obterListaJogadoresInformacoes($grupo);

			$dal = new DalJogadores($this->getConexao());

			$jogadores = $dal->obterJogadoresGrupoListaJogadoresInformacoes($jogadoresInfo);
		}

		return new GrupoView(
			$this->getUsuarioLogado(),
			$alianca,
			$grupo,
			$jogadores
		);
	}

	/**
	 * Retorna uma página 404 de um grupo inexistente
	 * @return ErroView
	 */
	public function notfound() : ErroView {
		return new ErroView(
			$this->getUsuarioLogado(),
			'404 NOT FOUND',
			['O grupo que você está procurando não existe']
		);
	}
}

?>
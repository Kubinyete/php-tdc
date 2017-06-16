<?php declare(strict_types=1);
/**
 * Camada responsável por obter informações para a exibição de uma página de
 * Aliança
 */

namespace App\Models;

use App\Models\ModelBase;
use App\Views\AliancaView;
use App\Views\ErroView;
use App\Database\DalAliancas;
use App\Database\DalJogadores;
use App\Database\DalMissoes;
use App\Database\DalGuerras;

final class AliancaModel extends ModelBase {
	public function __invoke(int $aliancaId = 0) {
		$dal = new DalAliancas($this->getConexao());
		$alianca = $dal->obter($aliancaId);

		if ($alianca === null) {
			return $this->notfound();
		} else if ($alianca->getUsuarioId() !== $this->getUsuarioLogado()->getId()) {
			return $this->notfound();
		} else {
			$dal = new DalJogadores($this->getConexao());

			$contagemJogadores = $dal->obterContagemAlianca($alianca);

			$dal = new DalMissoes($this->getConexao());

			$contagemMissoes = $dal->obterContagemAlianca($alianca);

			$dal = new DalGuerras($this->getConexao());

			$contagemGuerras = $dal->obterContagemAlianca($alianca);

			return new AliancaView(
				$this->getUsuarioLogado(),
				$alianca,
				$contagemJogadores,
				$contagemMissoes,
				$contagemGuerras
			);			
		}
	}

	/**
	 * Retorna uma página 404 de uma aliança inexistente
	 * @return ErroView
	 */
	public function notfound() : ErroView {
		return new ErroView(
			$this->getUsuarioLogado(),
			'404 NOT FOUND',
			['A aliança que você está procurando não existe']
		);
	}
}

?>
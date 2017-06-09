<?php declare(strict_types=1);
/**
 * Camada de acesso ao banco de dados para obtenção de dados necessários para o retorno
 * de uma página home completa
 */

namespace App\Models;

use App\Models\ModelBase;
use App\Database\DalAliancas;
use App\Views\HomeView;

final class HomeModel extends ModelBase {
	public function __invoke() {
        $dal = new DalAliancas($this->getConexao());
        $aliancas = $dal->obterDeUmUsuario($this->getUsuarioLogado());

        return new HomeView(
            $this->getUsuarioLogado(),
            $aliancas
        );
    }
}

?>

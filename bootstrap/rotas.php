<?php declare(strict_types=1);
/**
 * Registra as rotas utilizadas pela nossa aplicação
 */

use App\Http\Roteador;
use App\Http\Pedido;
use App\Http\Resposta;
use App\Http\Sessao;

use App\Database\Conexao;

use App\Controllers\LoginController;
use App\Models\LoginModel;
use App\Views\LoginView;

Roteador::registrar('login', function() 
	{
		// Se o usuário já estiver logado, envie ele para a página principal
		if (Sessao::getUsuario() !== null)
			Resposta::appRedirecionar('home');

		$login = Pedido::obter('log', Pedido::POST);
		$senha = Pedido::obter('sen', Peido::POST);

		// Não sei se ficaria muito feio fazer isso, por enquanto vai ficar assim
		$controlador = new LoginController(
			new LoginModel(
				new Conexao()
			)
		);

		return $controlador($login, $senha);
	}
);

?>
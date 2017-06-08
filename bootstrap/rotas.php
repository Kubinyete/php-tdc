<?php declare(strict_types=1);
/**
 * Registra as rotas utilizadas pela nossa aplicação
 */

use App\Http\Roteador;
use App\Http\Pedido;
use App\Http\Resposta;
use App\Http\Sessao;

use App\Database\Conexao;

use App\Views\ErroView;

use App\Controllers\LoginController;
use App\Models\LoginModel;
use App\Views\LoginView;
use App\Controllers\RegistrarController;
use App\Models\RegistrarModel;
use App\Views\RegistrarView;

Roteador::registrar(Roteador::ROTA_NOTFOUND_PADRAO, function()
	{
		Resposta::status(404);
		return new ErroView(
			Sessao::getUsuario(),
			'404 NOT FOUND',
			['A página que você está procurando não existe']
		);
	}
);

Roteador::registrar('login', function() 
	{
		// Se o usuário já estiver logado, envie ele para a página principal
		if (Sessao::getUsuario() !== null)
			Resposta::appRedirecionar('home');

		$login = Pedido::obter('log', Pedido::POST);
		$senha = Pedido::obter('sen', Pedido::POST);

		// Não sei se ficaria muito feio fazer isso, por enquanto vai ficar assim
		$controlador = new LoginController(
			new LoginModel(
				new Conexao()
			, Sessao::getUsuario())
		, Sessao::getUsuario());

		// O controlador é obrigado a retornar uma view RENDERIZÁVEL para o Roteador,
		// para que o método Roteador::servir() lide corretamente com o pedido
		return $controlador($login, $senha);
	}
);

Roteador::registrar('registrar', function()
	{
		// Se o usuário já estiver logado, envie ele para a página principal
		if (Sessao::getUsuario() !== null)
			Resposta::appRedirecionar('home');

		$login = Pedido::obter('log', Pedido::POST);
		$senha = Pedido::obter('sen', Pedido::POST);
		$confirmaSenha = Pedido::obter('con', Pedido::POST);

		// Não sei se ficaria muito feio fazer isso, por enquanto vai ficar assim
		$controlador = new RegistrarController(
			new RegistrarModel(
				new Conexao()
			, Sessao::getUsuario())
		, Sessao::getUsuario());

		// O controlador é obrigado a retornar uma view RENDERIZÁVEL para o Roteador,
		// para que o método Roteador::servir() lide corretamente com o pedido
		return $controlador($login, $senha, $confirmaSenha);
	}
);

Roteador::registrar('home', function()
	{
		// Se o usuário não estiver logado, envie ele para a página de login
		if (Sessao::getUsuario() === null)
			Resposta::appRedirecionar('login');

		// TODO
	
		return new TesteView('Em construção...');
	}
);

?>
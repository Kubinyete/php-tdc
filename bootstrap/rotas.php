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

use App\Controllers\RegistrarController;
use App\Models\RegistrarModel;

use App\Controllers\HomeController;
use App\Models\HomeModel;

use App\Controllers\AliancaController;
use App\Models\AliancaModel;

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
		$sair =	intval(Pedido::obter('sair', Pedido::GET));

		// Se o usuário já estiver logado, envie ele para a página principal
		if (Sessao::getUsuario() !== null) {
			if ($sair > 0) {
				Sessao::setUsuario(null);
				Resposta::appRedirecionar('login');
			} else {
				Resposta::appRedirecionar('home');
			}
		}

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

		$nomeAlianca = Pedido::obter('nom', Pedido::POST);

		$controlador = new HomeController(
			new HomeModel(
				new Conexao()
			, Sessao::getUsuario())
		, Sessao::getUsuario());

		return $controlador($nomeAlianca);
	}
);

Roteador::registrar('alianca', function()
	{
		// Se o usuário não estiver logado, envie ele para a página de login
		if (Sessao::getUsuario() === null)
			Resposta::appRedirecionar('login');

		$aliancaId = Pedido::obter('id', Pedido::GET);

		// Formulário de adição de jogadores
		$nom = Pedido::obter('nom', Pedido::POST);
		$nic = Pedido::obter('nic', Pedido::POST);
		$niv = Pedido::obter('niv', Pedido::POST);
		$tel = Pedido::obter('tel', Pedido::POST);
		$ema = Pedido::obter('ema', Pedido::POST);
		$tip = Pedido::obter('tip', Pedido::POST);
		$sta = Pedido::obter('sta', Pedido::POST);
		$obs = Pedido::obter('obs', Pedido::POST);

		$controlador = new AliancaController(
			new AliancaModel(
				new Conexao()
			, Sessao::getUsuario())
		, Sessao::getUsuario());

		return $controlador(
			$aliancaId,
			$nom,
			$nic,
			$niv,
			$tel,
			$ema,
			$tip,
			$sta,
			$obs
		);
	}
);

?>

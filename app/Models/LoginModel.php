<?php declare(strict_types=1);
/**
 * Camada de processamento e consulta ao banco de dados
 */

namespace App\Models;

use App\Models\ModelBase;
use App\Objetos\Usuario;
use App\Fabricas\FabricaUsuario;
use App\Views\LoginView;
use App\Database\DalUsuarios;
use App\Exceptions\LoginException;
use App\Http\Sessao;
use App\Http\Resposta;

final class LoginModel extends ModelBase {
	private const LOGIN_NAO_INFORMADO = 'É preciso informar o nome do usuário.';
	private const SENHA_NAO_INFORMADA = 'É preciso informar a senha do usuário.';
	private const LOGIN_NAO_EXISTE = 'O nome de usuário informado está incorreto.';
	private const SENHA_INVALIDA = 'A senha informada está incorreta.';

	/**
	 * Retorna uma LoginView padrão
	 * @return LoginView
	 */
	public function __invoke() : LoginView {
		return new LoginView($this->getUsuarioLogado());
	}

	/**
	 * Tenta logar o usuário atual, em caso de falha, retorne uma LoginView com
	 * informações do erro
	 * @param  string  $login
	 * @param  string  $senha
	 * @return LoginView
	 */
	public function logar(?string $login, ?string $senha) : LoginView {
		try {
			// Opa, tentou enviar sem um nome de usuário
			if ($login === null)
				throw new LoginException(self::LOGIN_NAO_INFORMADO);

			// Opa, tentou enviar sem uma senha
			if ($senha === null)
				throw new LoginException(null, self::SENHA_NAO_INFORMADA);

			$dal = new DalUsuarios($this->getConexao());
			$localUsuario = $dal->obterPeloNome($login);

			// Este usuário não existe!
			if ($localUsuario === null)
				throw new LoginException(self::LOGIN_NAO_EXISTE);
			
			// Você errou a senha!
			if ($localUsuario->getHashSenha() !== FabricaUsuario::criarHash($senha)) {
				throw new LoginException(null, self::SENHA_INVALIDA);
			} else {
				// Vamos logar!
				Sessao::setUsuarioLogado($localUsuario);
				Sessao::appRedirecionar('home');
			}
		} catch (LoginException $e) {
			return new LoginView($this->getUsuarioLogado(), $login, $e->getLoginErro(), $senha, $e->getSenhaErro());
		}
	}
}

?>
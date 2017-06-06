<?php declare(strict_types=1);
/**
 * Camada de processamento e consulta ao banco de dados
 */

namespace App\Models;

use App\Models\ModelBase;
use App\Objetos\Usuario;
use App\Objetos\FabricaUsuarios;
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
	 * @param  Usuario|null $usuario
	 * @return LoginView
	 */
	public function __invoke(?Usuario $usuario = null) : LoginView {
		return new LoginView($usuario);
	}

	/**
	 * Tenta logar o usuário atual, em caso de falha, retorne uma LoginView com
	 * informações do erro
	 * @param  Usuario $usuario
	 * @param  string  $login
	 * @param  string  $senha
	 * @return LoginView
	 */
	public function logar(?Usuario $usuario, ?string $login, ?string $senha) : LoginView {
		try {
			// Opa, tentou enviar sem um nome de usuário
			if ($login === null)
				throw new LoginException(self::LOGIN_NAO_INFORMADO);

			// Opa, tentou enviar sem uma senha
			if ($senha === null)
				throw new LoginException(null, self::SENHA_NAO_INFORMADA);

			$dal = new DalUsuarios($this->getConexao());
			$usuario = $dal->obterPeloNome($login);

			// Este usuário não existe!
			if ($usuario === null)
				throw new LoginException(self::LOGIN_NAO_EXISTE);
			
			// Você errou a senha!
			if ($usuario->getHashSenha() !== FabricaUsuarios::criarHash($senha)) {
				throw new LoginException(null, self::SENHA_INVALIDA);
			} else {
				// Vamos logar!
				Sessao::setUsuarioLogado($usuario);
				Sessao::appRedirecionar('home');
			}
		} catch (LoginException $e) {
			return new LoginView($usuario, $login, $e->getLoginErro(), $senha, $e->getSenhaErro());
		}
	}
}

?>
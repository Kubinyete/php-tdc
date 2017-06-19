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
use App\Exceptions\FormException;
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
			// Estágio 1
			$validador = new FormException();

			// Opa, tentou enviar sem um nome de usuário
			if ($login === null)
				$validador->adicionarErros(['login-erro' => self::LOGIN_NAO_INFORMADO]);

			// Opa, tentou enviar sem uma senha
			if ($senha === null)
				$validador->adicionarErros(['login-erro' => self::SENHA_NAO_INFORMADA]);

			if ($validador->ocorreuErro()) {
				throw $validador;
			} else {
				// Estágio 2
				$dal = new DalUsuarios($this->getConexao());
				$localUsuario = $dal->obterPeloNome($login);

				// Este usuário não existe!
				if ($localUsuario === null) {
					$validador->adicionarErros(['login-erro' => self::LOGIN_NAO_EXISTE]);
					throw $validador;
				} else {
					// Estágio 3

					// Você errou a senha?
					if ($localUsuario->getHashSenha() !== FabricaUsuario::criarHash($senha)) {
						$validador->adicionarErros(['senha-erro' => self::SENHA_INVALIDA]);
						throw $validador;
					} else {
						// Vamos logar
						Sessao::setUsuario($localUsuario);
						Resposta::appRedirecionar('home');
					}
				}
			}
		} catch (FormException $e) {
			return new LoginView($this->getUsuarioLogado(), $login, $e->obter('login-erro'), $senha, $e->obter('senha-erro'));
		}
	}
}

?>

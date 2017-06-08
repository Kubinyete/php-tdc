<?php declare(strict_types=1);
/**
 * Camada de processamento e consulta ao banco de dados
 */

namespace App\Models;

use App\Models\ModelBase;
use App\Objetos\Usuario;
use App\Fabricas\FabricaUsuario;
use App\Views\RegistrarView;
use App\Database\DalUsuarios;
use App\Exceptions\RegistrarException;
use App\Http\Sessao;
use App\Http\Resposta;
use App\Uteis\Uteis;
use App\Config\AppConfig;

final class RegistrarModel extends ModelBase {
	private const LOGIN_NAO_INFORMADO = 'É preciso informar o nome do usuário.';
	private const SENHA_NAO_INFORMADA = 'É preciso informar a senha do usuário.';
	private const LOGIN_JA_EXISTE = 'O nome de usuário informado não está disponível.';

	private const LOGIN_CHAR_INVALIDO = 'O nome do usuário contém carácteres inválidos.';
	private const LOGIN_TAM_INVALIDO = 'O nome do usuário precisa ter entre %m à %M carácteres.';

	private const SENHA_CHAR_INVALIDO = 'A senha do usuário contém carácteres inválidos.';
	private const SENHA_TAM_INVALIDO = 'A senha do usuário precisa ter entre %m à %M carácteres.';

	private const CONFIRMASENHA_INVALIDA = 'A confirmação de senha não condiz com a senha informada anteriormente.';

	private const REF_LOGIN = 0;
	private const REF_SENHA = 1;

	/**
	 * Retorna uma RegistrarView padrão
	 * @return RegistrarView
	 */
	public function __invoke() : RegistrarView {
		return new RegistrarView($this->getUsuarioLogado());
	}

	/**
	 * Efetua o registro de um usuário
	 *
	 * @param string|null $login
	 * @param string|null $senha
	 * @param string|null $confirmaSenha
	 * @return RegistrarView
	 */
	public function registrar(?string $login, ?string $senha, ?string $confirmaSenha) : RegistrarView {
		try {
			// Informou os campos?

			if ($login === null)
				throw new RegistrarException(self::LOGIN_NAO_INFORMADO);

			if ($senha === null)
				throw new RegistrarException(null, self::SENHA_NAO_INFORMADA);
			
			// Login -> São válidos?

			if (self::contemCaracteresInvalidos($login))
				throw new RegistrarException(self::LOGIN_CHAR_INVALIDO);

			if (!self::tamanhoValido(self::REF_LOGIN, $login))
				throw new RegistrarException(self::LOGIN_TAM_INVALIDO);
				
			// Senha -> São válidos?
			
			if (self::contemCaracteresInvalidos($senha))
				throw new RegistrarException(null, self::SENHA_CHAR_INVALIDO);

			if (!self::tamanhoValido(self::REF_SENHA, $senha))
				throw new RegistrarException(null, self::SENHA_TAM_INVALIDO);

			// Confirmação de senha OK?

			if ($senha !== $confirmaSenha)
				throw new RegistrarException(null, null, self::CONFIRMASENHA_INVALIDA);

			$dal = new DalUsuarios($this->getConexao());
			$localUsuario = $dal->obterPeloNome($login);

			if ($localUsuario !== null)
				throw new RegistrarException(self::LOGIN_JA_EXISTE);
				
			$localUsuario = FabricaUsuario::criar($login, $senha);

			$dal->criar($localUsuario);

			Sessao::setUsuario($localUsuario);
			Resposta::appRedirecionar('home');

		} catch (RegistrarException $e) {
			return new RegistrarView($this->getUsuarioLogado(), $login, $e->getLoginErro(), $senha, $e->getSenhaErro(), $confirmaSenha, $e->getConfirmaSenhaErro());
		}
	}

	/**
	 * Retorna se determinada $str contêm carácteres inválidos
	 * @param  string $str
	 * @return bool
	 */
	private static function contemCaracteresInvalidos(string $str) : bool {
		return Uteis::contemCaracteresInvalidos($str);
	}

	/**
	 * Retorna se determinada $str de login ou senha tem o seu tamanho permitido
	 * @param  int    $tipo
	 * @param  string $str
	 * @return bool
	 */
	private static function tamanhoValido(int $tipo, string $str) : bool {
		$len = strlen($str);

		switch ($tipo) {
			case self::REF_LOGIN:
				return ($len >= AppConfig::obter('Usuarios.NomeTamanhoMinimo')
					&&
						$len <= AppConfig::obter('Usuarios.NomeTamanhoLimite'));
			case self::REF_SENHA:
				return ($len >= AppConfig::obter('Usuarios.SenhaTamanhoMinimo')
					&&
						$len <= AppConfig::obter('Usuarios.SenhaTamanhoLimite'));
			default:
				return false;
		}
	}
}

?>
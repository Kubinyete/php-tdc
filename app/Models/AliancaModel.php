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
use App\Database\DalGrupos;
use App\Exceptions\FormException;
use App\Fabricas\FabricaJogador;
use App\Config\AppConfig;
use App\Uteis\Uteis;

final class AliancaModel extends ModelBase {
	private const NOME_TAMANHO_INVALIDO = 'Se informado, o nome do Jogador precisa ter no mínimo %m e no máximo %M carácteres.';
	private const NOME_CHAR_INVALIDO = 'Se informado, o nome do Jogador não pode conter carácteres inválidos.';

	private const APELIDO_TAMANHO_INVALIDO = 'O apelido do Jogador precisa ter no mínimo %am e no máximo %aM carácteres.';
	private const APELIDO_CHAR_INVALIDO = 'O apelido do Jogador não pode conter carácteres inválidos.';

	private const NIVEL_INVALIDO = 'O nível do Jogador precisa estar entre %nm à %nM.';

	private const TELEFONE_INVALIDO = 'O telefone informado não é válido.';

	private const EMAIL_INVALIDO = 'O email informado não é válido.';
	private const EMAIL_TAMANHO_INVALIDO = 'O email do Jogador não pode ultrapassar %eM carácteres.';

	private const TIPO_INVALIDO = 'O tipo de Jogador informado é inválido.';

	private const ANTIGIDO_LIMITE_POR_ALIANCA = 'Você não pode adicionar mais um Jogador pois já antigiu o limite de %L Jogadores ativos.';

	private const OBSERVACOES_TAMANHO_INVALIDO = 'O texto enviado ultrapassa o limíte de %oM carácteres.';

	private const REF_NOME = 0;
	private const REF_APELIDO = 1;
	private const REF_TELEFONE = 2;
	private const REF_EMAIL = 3;
	private const REF_OBSERVACOES = 4;

	public function __invoke(int $aliancaId = 0, ?string $nome = null, ?string $nickname = null, ?int $nivel = null, ?string $telefone = null, ?string $email = null, ?int $tipo = null, ?bool $status = null, ?string $obs = null, ?string $nomeErro = null, ?string $nomeErro2 = null, ?string $nomeErro3 = null, ?string $apelidoErro = null, ?string $apelidoErro2 = null, ?string $nivelErro = null, ?string $telefoneErro = null, ?string $emailErro = null, ?string $emailErro2 = null, ?string $tipoErro = null, ?string $obsErro = null) {
		$dal = new DalAliancas($this->getConexao());
		$alianca = $dal->obter($aliancaId);

		if ($alianca === null) {
			return $this->notfound();
		} else if ($alianca->getUsuarioId() !== $this->getUsuarioLogado()->getId()) {
			return $this->notfound();
		} else {
			$dal = new DalJogadores($this->getConexao());

			$jogadores = $dal->obterAlianca($alianca);

			$dal = new DalMissoes($this->getConexao());

			$contagemMissoes = $dal->obterContagemAlianca($alianca);

			$dal = new DalGuerras($this->getConexao());

			$contagemGuerras = $dal->obterContagemAlianca($alianca);

			$dal = new DalGrupos($this->getConexao());

			$grupos = $dal->obterTodosAlianca($alianca);

			return new AliancaView(
				$this->getUsuarioLogado(),
				$alianca,
				$jogadores,
				$contagemMissoes,
				$contagemGuerras,
				$grupos,
				$nome,
				$nickname,
				$nivel,
				$telefone,
				$email,
				$tipo,
				$status,
				$obs,
				$nomeErro,
				$nomeErro2,
				$nomeErro3,
				$apelidoErro,
				$apelidoErro2,
				$nivelErro,
				$telefoneErro,
				$emailErro,
				$emailErro2,
				$tipoErro,
				$obsErro
			);
		}
	}

	/**
	 * Adiciona um Jogador em uma Aliança
	 * @param  int    $aliancaId
	 * @param  string $nome     
	 * @param  string $nickname 
	 * @param  int    $nivel    
	 * @param  string $telefone 
	 * @param  string $email    
	 * @param  int    $tipo     
	 * @param  int    $status   
	 * @param  string $obs                 
	 */
	public function adicionarJogador(int $aliancaId, ?string $nome, string $nickname, int $nivel, ?string $telefone, string $email, int $tipo, bool $status, ?string $obs) {
		try {
			// Estágio 1
			// Existe e pertence ao usuário logado?

			$dal = new DalAliancas($this->getConexao());

			$alianca = $dal->obter($aliancaId);

			unset($dal);

			if ($alianca === null || $alianca->getUsuarioId() !== $this->getUsuarioLogado()->getId()) {
				return $this->notfound();
			} else {
				// Estágio 2
				// Enviou os campos corretamente?
				
				$validador = new FormException();

				// OBS: Nome do Jogador é opcional
				if (self::campoEstaPresente($nome)) {
					$nome = strtoupper(trim($nome));

					if (!self::tamanhoValido(self::REF_NOME, $nome))
						$validador->adicionarErros(['nome-erro' => self::traduzirErroString(self::NOME_TAMANHO_INVALIDO)]);

					if (self::contemCaracteresInvalidos($nome, self::REF_NOME))
						$validador->adicionarErros(['nome-erro-2' => self::NOME_CHAR_INVALIDO]);
				} else {
					$nome = null;
				}

				// Apelido

				if (!self::tamanhoValido(self::REF_APELIDO, $nickname))
					$validador->adicionarErros(['apelido-erro' => self::traduzirErroString(self::APELIDO_TAMANHO_INVALIDO)]);

				if (self::contemCaracteresInvalidos($nickname, self::REF_APELIDO))
					$validador->adicionarErros(['apelido-erro-2' => self::APELIDO_CHAR_INVALIDO]);

				// Nível
				
				if ($nivel < AppConfig::obter('Jogadores.NivelMinimo') || $nivel > AppConfig::obter('Jogadores.NivelLimite'))
					$validador->adicionarErros(['nivel-erro' => self::traduzirErroString(self::NIVEL_INVALIDO)]);

				// Telefone

				if (self::campoEstaPresente($telefone)) {
					$telefone = trim($telefone);

					if (!self::tamanhoValido(self::REF_TELEFONE, $telefone))
						$validador->adicionarErros(['telefone-erro' => self::TELEFONE_INVALIDO]);

					if (self::contemCaracteresInvalidos($telefone, self::REF_TELEFONE))
						$validador->adicionarErros(['telefone-erro' => self::TELEFONE_INVALIDO]);
				} else {
					$telefone = null;
				}

				// Email
				
				if (!self::tamanhoValido(self::REF_EMAIL, $email))
					$validador->adicionarErros(['email-erro' => self::traduzirErroString(self::EMAIL_TAMANHO_INVALIDO)]);

				if (self::contemCaracteresInvalidos($email, self::REF_EMAIL))
					$validador->adicionarErros(['email-erro-2' => self::EMAIL_INVALIDO]);


				// Tipo
				
				if ($tipo < 0 || $tipo > count(AppConfig::obter('Jogadores.Tipos')) - 1)
					$validador->adicionarErros(['tipo-erro' => self::TIPO_INVALIDO]);

				// Observações

				if (self::campoEstaPresente($obs)) {
					$obs = trim($obs);

					if (!self::tamanhoValido(self::REF_OBSERVACOES, $obs))
						$validador->adicionarErros(['obs-erro' => self::traduzirErroString(self::OBSERVACOES_TAMANHO_INVALIDO)]);
				} else {
					$obs = null;
				}

				if ($validador->ocorreuErro()) {
					throw $validador;
				} else {
					// Estágio 3
					// Posso adicionar?

					$dal = new DalJogadores($this->getConexao());
					$contagemJogadores = $dal->obterContagemAlianca($alianca);

					if ($contagemJogadores >= AppConfig::obter('Jogadores.LimitePorAlianca')) {
						if ($status) {
							$validador->adicionarErros(['nome-erro-3' => self::traduzirErroString(self::ANTIGIDO_LIMITE_POR_ALIANCA)]);
							throw $validador;
						}
					}

					$localJogador = FabricaJogador::criar(
						$aliancaId,
						$nome,
						$nickname,
						$nivel,
						$telefone,
						$email,
						$tipo,
						$status,
						$obs
					);

					$dal->criar($localJogador);

					unset($dal);

					return $this->__invoke($aliancaId);
				}
			}
		} catch (FormException $e) {
			return $this->__invoke(
				$aliancaId,
				$nome,
				$nickname,
				$nivel,
				$telefone,
				$email,
				$tipo,
				$status,
				$obs,
				$e->obter('nome-erro'),
				$e->obter('nome-erro-2'),
				$e->obter('nome-erro-3'),
				$e->obter('apelido-erro'),
				$e->obter('apelido-erro-2'),
				$e->obter('nivel-erro'),
				$e->obter('telefone-erro'),
				$e->obter('email-erro'),
				$e->obter('email-erro-2'),
				$e->obter('tipo-erro'),
				$e->obter('obs-erro')
			);
		}
	}

	/**
	 * Retorna se determinado campo em string informado está presente
	 * @param  string $str
	 * @return bool
	 */
	private static function campoEstaPresente(string $str, bool $utilizarTrim = true) : bool {
		return ($str !== null && strlen(($utilizarTrim) ? trim($str) : $str) > 0);
	}

	/**
	 * Retorna se determinada string contém carácteres inválidos
	 * @param  string $str
	 * @return bool
	 */
	private static function contemCaracteresInvalidos(string $str, int $ref = 0) : bool {
		switch ($ref) {
			case self::REF_NOME:
				return !Uteis::contemApenasLetrasMaiusculas($str);
			case self::REF_APELIDO:
				return Uteis::contemCaracteresInvalidos($str);
			case self::REF_TELEFONE:
				return !Uteis::contemApenasNumeros($str);
			case self::REF_EMAIL:
				return !Uteis::emailValido($str);
			default:
				return Uteis::contemCaracteresInvalidos($str);
		}
	}

	/**
	 * Retorna se o tamanho de determinado campo do formulário está de acordo com a configuração do App 
	 * @param  int    $ref
	 * @param  string $str
	 * @return bool
	 */
	private static function tamanhoValido(int $ref, string $str) : bool {
		$strlen = strlen($str);

		switch ($ref) {
			case self::REF_NOME:
				return ($strlen >= AppConfig::obter('Jogadores.NomeTamanhoMinimo') && $strlen <= AppConfig::obter('Jogadores.NomeTamanhoLimite'));
			case self::REF_APELIDO:
				return ($strlen >= AppConfig::obter('Jogadores.ApelidoTamanhoMinimo') && $strlen <= AppConfig::obter('Jogadores.ApelidoTamanhoLimite'));
			case self::REF_TELEFONE:
				return ($strlen === AppConfig::obter('Jogadores.TelefoneTamanho'));
			case self::REF_EMAIL:
				return ($strlen <= AppConfig::obter('Jogadores.EmailTamanhoLimite'));
			case self::REF_OBSERVACOES:
				return ($strlen <= AppConfig::obter('Jogadores.ObservacoesTamanhoLimite'));
			default:
				return false;
		}
	}

	/**
	 * Acrescenta as informações necessárias em uma string de erro
	 * Ex: "Mínimo de %m à %M carácteres" -> "Mínimo de 3 à 6 carácteres"
	 * @param  string $erro
	 * @return string
	 */
	private static function traduzirErroString(string $erro) : string {
		return str_replace(
			['%m', '%M', '%am', '%aM', '%nm', '%nM', '%eM', '%L', '%oM'],
			[
				AppConfig::obter('Jogadores.NomeTamanhoMinimo'),
				AppConfig::obter('Jogadores.NomeTamanhoLimite'),
				AppConfig::obter('Jogadores.ApelidoTamanhoMinimo'),
				AppConfig::obter('Jogadores.ApelidoTamanhoLimite'),
				AppConfig::obter('Jogadores.NivelMinimo'),
				AppConfig::obter('Jogadores.NivelLimite'),
				AppConfig::obter('Jogadores.EmailTamanhoLimite'),
				AppConfig::obter('Jogadores.LimitePorAlianca'),
				AppConfig::obter('Jogadores.ObservacoesTamanhoLimite')
			], $erro);
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
<?php declare(strict_types=1);
/**
 * Classe responsável por representar uma View de base em uma aplicação MVC
 */

namespace App\Views;

use App\Objetos\Usuario;
use App\Config\AppConfig;
use App\Uteis\Uteis;
use App\Log\AppLog;
use App\Log\Notificacao;

abstract class ViewBase {
	private const GOOGLE_FONTS_API_QUERY = '?family=';
	private const TEMPLATE_EXTENSAO_PADRAO = '.php';

	// Templates necessárias antes do conteúdo
	private const PRE_TEMPLATES = [
		# Ex: header, cabecalho, menu_superior
		'cabecalho'
	];
	// Templates necessárias após o conteúdo
	private const POS_TEMPLATES = [
		# Ex: footer, rodape, scripts
		'rodape'
	];

	// Templates necessárias para renderizar o conteúdo dessa página
	protected $templates;
	// O usuário logado atualmente na sessão
	protected $usuarioLogado;
	// Os itens dinâmicos requeridos pelas templates para renderizar a página
	protected $itens;

	public function __construct(?Usuario $usuarioLogado = null, array $templates = [], array $itens = []) {
		$this->usuarioLogado = $usuarioLogado;

		// É possível especificar aqui algumas templates que já existem por padrão, não é
		// recomendável utilizar este campo para juntar templates necessárias, seria mais lógico
		// utilizar as constantes PRE_TEMPLATES e POS_TEMPLATES, já que não são dinâmicas
		// ---
		// Ao utilizar uma subclasse de ViewBase, é possível importar diferentes templates caso
		// à ela receba alguns dados adicionais, Exemplo: É possível importar uma template tipo
		// 'painel_usuario' caso o parâmetro $usuarioLogado não esteja nulo
		$this->templates = [];

		$apiReq = AppConfig::obter('Templates.Itens.Documento.GoogleFontsApiUrl').self::GOOGLE_FONTS_API_QUERY;
		$primeira = true;

		foreach (AppConfig::obter('Templates.Itens.Documento.Fontes') as $fonte) {
			$apiReq .= (($primeira) ? '' : '|').Uteis::filtrarNomeFonte($fonte);

			if ($primeira)
				$primeira = false;
		}

		// É possível especificar aqui alguns itens que já existem por padrão
		$this->itens = [
			// Documento
			'doc-titulo' => AppConfig::obter('Templates.Itens.Documento.Titulo'),
			'doc-palavraschave' => AppConfig::obter('Templates.Itens.Documento.PalavrasChave'),
			'doc-descricao' => AppConfig::obter('Templates.Itens.Documento.Descricao'),
			'doc-autor' => AppConfig::obter('Templates.Itens.Documento.Autor'),
			'doc-icone' => Uteis::obterCaminhoWebCompleto(AppConfig::obter('Templates.Itens.Documento.IconeUrl'), false, false),
			'doc-gfonts' => $apiReq,
			'doc-fa' => Uteis::obterCaminhoWebCompleto(AppConfig::obter('Templates.Itens.Documento.FontAwesomeUrl'), false, false),
			'doc-css' => Uteis::obterCaminhoWebCompleto(AppConfig::obter('Templates.Itens.Documento.StylesheetUrl'), false, false),
			'doc-jquery' => Uteis::obterCaminhoWebCompleto(AppConfig::obter('Templates.Itens.Documento.JqueryUrl'), false, false),
			'doc-js' => Uteis::obterCaminhoWebCompleto(AppConfig::obter('Templates.Itens.Documento.JavascriptUrl'), false, false),
			'doc-fundo' => Uteis::obterCaminhoWebCompleto('static/resources/fundo-encaixavel-preto.png', false, false),

			// Open Graph
			'og-imagem' => Uteis::obterCaminhoWebCompleto(AppConfig::obter('Templates.Itens.OpenGraph.ImagemUrl')),

			// Twitter Cards
			'twitter-card' => AppConfig::obter('Templates.Itens.TwitterCards.CardStyle'),
			'twitter-imagem' => Uteis::obterCaminhoWebCompleto(AppConfig::obter('Templates.Itens.TwitterCards.ImagemUrl')),

			// Debug
			'debug-icone' => Uteis::obterCaminhoWebCompleto('static/resources/modo-debug-icone.png', false, false),

			// Header
			'header-logo' => Uteis::obterCaminhoWebCompleto('static/resources/app-logo.png', false, false),
			'header-usuario' => ($usuarioLogado !== null) ? Uteis::filtrarEntidadesHtml($usuarioLogado->getLogin()) : $usuarioLogado,
			'header-sair' => Uteis::obterCaminhoWebCompleto('?r=login&sair=1', false, false),
			'header-home' => Uteis::obterCaminhoWebCompleto('?r=home', false, false)
		];

		$this->adicionarTemplates($templates);
		$this->adicionarItens($itens);
	}

	/**
	 * Adiciona um array templates à lista de templates já existente
	 * @param  array  $templates
	 */
	protected function adicionarTemplates(array $templates) {
		foreach ($templates as $tpl)
			array_push($this->templates, $tpl);
	}

	/**
	 * Adiciona ou sobrepôe valores à nossa lista de itens
	 * @param  array  $itens
	 */
	protected function adicionarItens(array $itens) {
		foreach ($itens as $item => $valor)
			$this->itens[$item] = $valor;
	}

	/**
	 * Importa todas as templates dessa visualização
	 */
	public function __invoke() {
		foreach (self::PRE_TEMPLATES as $tpl)
			self::importarTemplate($tpl);

		foreach ($this->templates as $tpl)
			self::importarTemplate($tpl);

		foreach (self::POS_TEMPLATES as $tpl)
			self::importarTemplate($tpl);
	}

	/**
	 * Imprime informações sobre a template atual (para debug)
	 * @param  string $origem
	 * @param  string $tpl
	 */
	private static function imprimirInfoTemplate(string $tpl) {
		self::imprimirComentario('Início de '.$tpl.(AppConfig::obter('Templates.Extensao') ?? self::TEMPLATE_EXTENSAO_PADRAO));
	}

	/**
	 * Imprimi um comentário na template atual
	 * @param  string $texto
	 */
	private static function imprimirComentario(string $texto) {
		?><?= PHP_EOL; ?><!-- <?= $texto; ?> --><?= PHP_EOL; ?><?php
	}

	/**
	 * Importa um arquivo de template com base no $tplNome informado
	 * @param  string $tplNome
	 */
	private function importarTemplate(string $tplNome) {
		$arquivo = APP_BASE.AppConfig::obter('Templates.Diretorio').DIRECTORY_SEPARATOR.$tplNome.(AppConfig::obter('Templates.Extensao') ?? self::TEMPLATE_EXTENSAO_PADRAO);

		if (file_exists($arquivo)) {
			if (APP_DEBUG) {
				self::imprimirInfoTemplate($tplNome);
				AppLog::log(Notificacao::INFO, 'Importando template '.$arquivo);
			}

			$_ = &$this->itens;
			$_USUARIO = &$this->usuarioLogado;

			// Uma template poderá importar outra template, e assim em diante...
			$_IMPORTAR = function(string $tpl) {
				$this->importarTemplate($tpl);
			};

			// É possível retornar todas as notificações guardadas no nosso log
			// do aplicativo, utilizando $_LOG() as $notificacao
			$_LOG = function() : array {
				return AppLog::getNotificacoes();
			};

			include $arquivo;
		} else {
			exit('Não foi possível importar a template <strong>"'.$arquivo.'"</strong>.');
		}
	}
}

?>

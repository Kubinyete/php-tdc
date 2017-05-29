<?php declare(strict_types=1);
/**
 * Classe responsável por representar uma View de base em uma aplicação MVC
 */

namespace App\Views;

use App\Objetos\Usuario;
use App\Config\AppConfig;

abstract class ViewBase {
	private const TEMPLATE_EXTENSAO_PADRAO = '.php';

	// Templates necessárias antes do conteúdo
	private const PRE_TEMPLATES = [
		# Ex: header, cabecalho, menu_superior
	];
	// Templates necessárias após o conteúdo
	private const POS_TEMPLATES = [
		# Ex: footer, rodape, scripts
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
		
		// É possível especificar aqui alguns itens que já existem por padrão
		$this->itens = [];

		$this->adicionarTemplates($templates);
		$this->adicionarItens($itens);
	}

	/**
	 * Apelido para ::renderizar()
	 */
	public function __invoke() {
		$this->renderizar();
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
	public function renderizar() {
		foreach (self::PRE_TEMPLATES as $tpl)
			self::importarTemplate($this->itens, $this->usuarioLogado, $tpl);

		foreach ($this->templates as $tpl)
			self::importarTemplate($this->itens, $this->usuarioLogado, $tpl);

		foreach (self::POS_TEMPLATES as $tpl)
			self::importarTemplate($this->itens, $this->usuarioLogado, $tpl);
	}

	/**
	 * Importa um arquivo de template com base no $tplNome informado
	 * @param  string $tplNome
	 */
	private static function importarTemplate(&$_, &$_USUARIO, string $tplNome) {
		$arquivo = APP_BASE.AppConfig::obter('Templates.Diretorio').DIRECTORY_SEPARATOR.$tplNome.(AppConfig::obter('Templates.Extensao') ?? self::TEMPLATE_EXTENSAO_PADRAO);

		if (file_exists($arquivo))
			include $arquivo;
		else
			exit('Não foi possível importar a template <strong>"'.$arquivo.'"</strong>.');
	}
}

?>
# php-tdc
###### Projeto final do módulo de programação - Senac Turma 39

# Tecnologias / Dependências utilizadas

* **Back-end**
	* PHP >= 7.1
	* MySQL - MariaDB 10.1.21 ou equivalente.
* **Front-end**
	* jQuery 3.2.1
	* Font Awesome 4.7.0

# Observações

O ambiente de testes e desenvolvimento para esta aplicação pode ser obtido através da instalação do [XAMPP](https://www.apachefriends.org/pt_br/download.html).

É recomendável a utilização do editor de textos [Sublime Text 3](https://sublimetext.com/3).

* **Lembrete** 
	* Escrever um documento simples contendo regras e padrões de desenvolvimento para esta aplicação como:
		* Nome de variáveis.
		* Estrutura relacional da ***D**atabase **A**ccess **L**ayer* (**DAL**).
		* Estrutura relacional do modelo ***M**odel, **V**iew e **C**ontroller* (**MVC**).
		* Classes necessárias.
	* Em caso de dúvidas utilize os padrões que já utilizei em [phpgallery](https://github.com/Kubinyete/phpgallery).

# Estruturação

* **Wireframes**
* **Sitemap**
* **MVC**
	* ![MVC](https://i.stack.imgur.com/Rk9Kr.png)
	```php
		/**
		 * Exemplo da sua utilização em código
		 */
			
		$conexao = new DalConexao();            // Objeto de conexão utilizado para conectar ao banco de dados.
		$controlador = new HomeController();    // Controlador que manipulará um modelo com base no pedido recebido.
		$modelo = new HomeModel($conexao);      // Modelo que será responsável por conectar ao banco, obter informações e retornar uma View contendo estas informações necessárias.

		$retornoView = $controlador->rodar();   // Retornando uma View.
		$retornoView->renderizar();             // Vamos 'renderizar/incluir' a resposta recebida para que o usuário veja a página.
	```

# Guias

* **Front-end**
	* Organização da folha de estilos seguindo os padrões ***B**lock, **E**lement e **M**odifier* [BEM](http://getbem.com/introduction/).
		* Elementos independentes são nomeados como:
		* **Exemplos**: container, centralizador, artigo, conteudo, etc.
		* Elementos que fazem parte de um bloco são nomeados como:
		* **Exemplos**: artigo__imagem, conteudo__botao, __botao, formulario__campo, etc.
		* Elementos que podem modificar seu próprio estado são nomeados como:
		* **Exemplos**: header--mobile, nav--flutuando, botao--desativado, botao--destaque, etc.
* **Back-end**
	* Favor nomear as variáveis para fácil compreensão, Exemplo:
	```php
		$controlador = new Controller();

		$contadorUsuarios = 0;

		// Váriaveis curtas como $i / $x / $y, poderão ser utilizadas em loops / for
		for ($i = 0; $i < 99; $i++) {
			echo '> '.$i;
		}
	```
	* Nome de classes
	```php
		// Válido
		class ObjetoNumeroUm { }

		// Válido
		class Usuario { }

		// Inválido
		class minhaclasse { }

		// Inválido
		class um_objeto { }

		// Inválido
		class classeEstranha { }
	```

	* Nome de métodos
	```php
		class DemonstraMetodos {
			// Válido
			public function obterUsuario(string $nome, int $id=0) {

			}

			// Válido
			public static function rodarFuncao(callable $funcao) {
				$funcao();
			}

			// Inválido
			public function MeuMetodo() { 

			}

			// Inválido
			public function metodonumeroum(int $algo) {

			}
		}
	```

	* Sempre inicialize os scripts da seguinte maneira
	```php
		<?php declare(strict_types=1);
			/**
			 * Digite aqui o que esse script está fazendo,
			 * ou o que ele irá processar, etc.
			 */
			
			// Favor definir o namespace deste script
			namespace Aplicativo\Teste;

			// Chame aqui os objetos que esse script erá utilizar
			use Exception;
			use Aplicativo\Objetos\ObjetoTeste;

			// Se esse script só processará algo, não defina classes ou estruturas,
			// Se esse script (Ex: Imprimir.php) está definindo uma classe, então não
			// processe nada, apenas defina a classe

			class Imprimir {
				public static function imprimirObjeto($algo) {
					var_dump($algo);
				}
			}
		?>
	```

	* Sempre indente seu código corretamente, utilize somente Tabs ao invés de espaços
	```php
		// Porfavor não faça isso, é feio e acima de tudo dificulta a visualização e compreensão do código.
		function main() {
			echo "Olá mundo";
		  echo "Isso está posicionado incorretamente.";

		         $conteudo = file_get_contents("arquivo.txt");


		       }

		     echo $conteudo;
		}

		// Mantenha seu código posicionado corretamente
		function main() {
			echo "Olá mundo";
			echo "Quanta perfeição.";

			$conteudo = file_get_contents("arquivo.txt");

			echo $conteudo;
			exit();
		}
	```

	* E por ultimo, procure sempre comentar o que certa função faz ou como você está processando essa parte do código
	```php
		<?php
		/**
		 * Define uma classe contendo funções úteis para utilização em todo o projeto.
		 */
		
		namespace Aplicativo\Uteis;

		use Aplicativo\Config\LeitorConfiguracao;

		abstract class Uteis {
			// Retorna a versão desta aplicação
			// Especificada no arquivo de configurações .json
			public static function obterVersao() : string {
				$config = new LeitorConfiguracao();

				return $config->obterPropriedade("Aplicativo.VERSAO");
			}

			// Para a execução do script e finaliza o pedido atual
			// Se for especificado uma $mensagem, vamos rodar a função exit()
			// passando juntamente uma mensagem final
			public static function finalizar($mensagem=null) {
				if ($mensagem !== null) {
					exit($mensagem);
				} else {
					exit();
				}
			}
		}

		?>
	```
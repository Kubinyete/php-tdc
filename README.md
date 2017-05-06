# php-tdc
###### Projeto final do módulo de programação - Senac Turma 39

# Técnologias utilizadas

* **Back-end**
	* PHP >= 7.x
	* MySQL - MariaDB 10.1.21 ou equivalente.
* **Front-end**
	* jQuery 3.2.1
	* Font Awesome 4.7.0

O ambiente de testes e desenvolvimento para esta aplicação pode ser obtido através da instalação do [XAMPP](https://www.apachefriends.org/pt_br/download.html).

# Estruturação

* **(TODO)** : Wireframe das páginas.
* **(TODO)** : Mapa da aplicação.
* **(TODO)** : Escrever um documento simples contendo regras e padrões de desenvolvimento para esta aplicação como:
	* Nome de variáveis.
	* Estrutura relacional da ***D**atabase **A**ccess **L**ayer* (**DAL**).
	* Estrutura relacional do modelo ***M**odel, **V**iew e **C**ontroller* (**MVC**).
	* Classes necessárias.
	* Em caso de dúvidas utilize os padrões que já utilizei em [phpgallery](https://github.com/Kubinyete/phpgallery).
* MVC
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

# **(WIP)** Guias

* **Front-end**
	* Organização da folha de estilos seguindo os padrões ***B**lock, **E**lement e **M**odifier* [BEM](http://getbem.com/introduction/).
		* Elementos independentes são nomeados como:
		* **Exemplos**: container, centralizador, artigo, conteudo, etc.
		* Elementos que fazem parte de um bloco são nomeados como:
		* **Exemplos**: artigo__imagem, conteudo__botao, __botao, formulario__campo, etc.
		* Elementos que podem modificar seu próprio estado são nomeados como:
		* **Exemplos**: header--mobile, nav--flutuando, botao--desativado, botao--destaque, etc.
* **(TODO) Back-end**
	
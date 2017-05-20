<?php declare(strict_types=1);
/**
 * Arquivo de entrada da aplicação
 * responsável por chamar todos os outros scripts
 * e servir a requisição
 */

// Define uma constante global contendo o caminho base da aplicação
define('DIR_BASE', __DIR__.DIRECTORY_SEPARATOR);

// Carregue nosso importador de classes
require DIR_BASE.'bootstrap'.DIRECTORY_SEPARATOR.'autoload.php';

// Carregue nosso arquivo de configurações na memória
App\Config\Config::carregar(DIR_BASE.'bootstrap'.DIRECTORY_SEPARATOR.'config.json');

/**
 * TODO: Fazer uma classe como espécie de fábrica para criação de objetos genéricos
 * TODO: Fazer método que cria todos os objetos da aplicação e chama seus respectivos ::__toString()
 * para que seja possível detectar algum erro no código
 */

?>
<h1>Olá mundo!</h1>
<hr>
<p>Se esta página não estiver com erros, parabéns, sua versão do <strong>PHP</strong> (<em>Maior ou igual a <strong>7.1</strong></em>) é compatível com essa aplicação!</p>

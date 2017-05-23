<?php declare(strict_types=1);
/**
 * Arquivo de entrada da aplicação
 * responsável por chamar todos os outros scripts
 * e servir a requisição
 */

// Define o tempo inicial de execução
define('APP_INICIO', microtime(true));

// Define uma constante global contendo o caminho base da aplicação
define('DIR_BASE', __DIR__.DIRECTORY_SEPARATOR);

// Carregue nosso importador de classes
require DIR_BASE.'bootstrap'.DIRECTORY_SEPARATOR.'autoload.php';

// Carregue nosso arquivo de configurações na memória
App\Config\AppConfig::carregar(DIR_BASE.'bootstrap'.DIRECTORY_SEPARATOR.'config.json');


$testeUsuario = App\Fabricas\FabricaUsuario::criar();


?>

<h1>Olá mundo!</h1>
<hr>
<p>Se esta página não estiver com erros, parabéns, sua versão do <strong>PHP</strong> (<em>Maior ou igual a <strong>7.1</strong></em>) é compatível com essa aplicação!</p>

<?php

echo $testeUsuario;

?>

<hr>
<p>Tempo de execução do script: <strong><?php echo microtime(true) - APP_INICIO; ?> segundos</strong></p>

<?php declare(strict_types=1);
/**
 * Arquivo de entrada da aplicação
 * responsável por chamar todos os outros scripts
 * e servir a requisição
 */

// Define uma constante global contendo o caminho base da aplicação
define('APP_BASE', __DIR__.DIRECTORY_SEPARATOR);

// Carregue nosso importador de classes
require APP_BASE.'bootstrap'.DIRECTORY_SEPARATOR.'autoload.php';

// Carregue nosso arquivo de configurações na memória
App\Config\AppConfig::carregar(APP_BASE.'bootstrap'.DIRECTORY_SEPARATOR.'config.json');

// Define de modo global se estamos com o modo debug ativado
define('APP_DEBUG', App\Config\AppConfig::obter('App.ModoDebug') ?? false);

?>

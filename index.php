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
define('APP_DEBUG', App\Config\AppConfig::obter('App.Debug') ?? false);

// Define a string global de versão do aplicativo
define('APP_VER', App\Config\AppConfig::obter('App.Versao') ?? '1.0.0');

// Define o url aonde o servidor está
define('WEB_HOST', App\Config\AppConfig::obter('App.WebHost') ?? 'localhost');

// Define a base web de requisições
define('WEB_BASE', App\Config\AppConfig::obter('App.WebBase') ?? '/');

// Registra todas as rotas utilizadas pela aplicação
require APP_BASE.'bootstrap'.DIRECTORY_SEPARATOR.'rotas.php';

####################################################################################################

// Como o programa vai gerar as datas de criação dos objetos, devemos setar a timezone correta
// para que a função date() retorne corretamente
date_default_timezone_set('America/Sao_Paulo');

App\Http\Resposta::header('Content-Type', 'text/html; charset=UTF-8');
App\Http\Resposta::header('Content-Language', 'pt-BR');
App\Http\Resposta::header('X-UA-Compatible', 'IE=Edge, chrome=1');

App\Http\Sessao::inicializar();
App\Http\Sessao::validar();

####################################################################################################

App\Log\AppLog::adicionar(new App\Log\Notificacao(App\Log\Notificacao::INFO, 'APP_BASE: '.APP_BASE));

App\Log\AppLog::adicionar(new App\Log\Notificacao(App\Log\Notificacao::INFO, 'APP_VER: '.APP_VER));

App\Log\AppLog::adicionar(new App\Log\Notificacao(App\Log\Notificacao::INFO, 'WEB_HOST: '.WEB_HOST));

App\Log\AppLog::adicionar(new App\Log\Notificacao(App\Log\Notificacao::INFO, 'WEB_BASE: '.WEB_BASE));

// Sirva nosso pedido HTTP com base na querystring ?r=<pagina>
// se o valor de 'r' for null, quer dizer que o usuário fez uma simples requisição '/', então assuma
// que ele queira acessar a página de login
App\Http\Roteador::servir(App\Http\Pedido::obter('r', App\Http\Pedido::GET) ?? 'login');

?>

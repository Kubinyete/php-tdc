<?php declare(strict_types=1);
/**
 * Fornecedor do arquivo robots.txt
 */

 // Define uma constante global contendo o caminho base da aplicação
 define('APP_BASE', __DIR__.DIRECTORY_SEPARATOR);

 // Carregue nosso importador de classes
 require APP_BASE.'bootstrap'.DIRECTORY_SEPARATOR.'autoload.php';

 // Carregue nosso arquivo de configurações na memória
 App\Config\AppConfig::carregar(APP_BASE.'bootstrap'.DIRECTORY_SEPARATOR.'config.json');

 // Define o url aonde o servidor está
 define('WEB_HOST', App\Config\AppConfig::obter('App.WebHost') ?? 'localhost');

 // Define a base web de requisições
 define('WEB_BASE', App\Config\AppConfig::obter('App.WebBase') ?? '/');

App\Http\Resposta::header('Content-Type', 'text/plain');

// Lista de URLs bloqueados por padrão
const ROBOTS_BLOCKED_PADRAO = [
    'home',
    'static',
    'static/*'
];

?>
User-agent: <?= App\Config\AppConfig::obter('Robots.UserAgent') ?? '*' ?>

<?php foreach(App\Config\AppConfig::obter('Robots.Blocked') ?? ROBOTS_BLOCKED_PADRAO as $caminho): ?>
Disallow: <?= App\Uteis\Uteis::obterCaminhoWebCompleto($caminho, false, false).PHP_EOL ?>
<?php endforeach; ?>

Sitemap: <?= App\Uteis\Uteis::obterCaminhoWebCompleto(App\Config\AppConfig::obter('Robots.Sitemap') ?? 'sitemap.xml', false, false); ?>

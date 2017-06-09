<?php declare(strict_types=1);
/**
 * Fornecedor do arquivo sitemap.xml
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

 // Registra todas as rotas utilizadas pela aplicação
 require APP_BASE.'bootstrap'.DIRECTORY_SEPARATOR.'rotas.php';

App\Http\Resposta::header('Content-Type', 'text/xml');

?>
<?= '<?xml' ?> version="1.0" encoding="utf-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<?php foreach(App\Http\Roteador::getListaRotas() as $url): if ($url !== App\Http\Roteador::ROTA_NOTFOUND_PADRAO): ?>
	<url>
		<loc><?= App\Uteis\Uteis::obterCaminhoWebCompleto($url, false) ?></loc>
	</url>
<?php endif; endforeach; ?>
</urlset>

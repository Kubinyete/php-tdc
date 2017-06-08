<?php declare(strict_types=1);
/**
 * Fornecedor do arquivo sitemap.xml
 */

const ALWAYS = 'always';
const HOURLY = 'hourly';
const DAILY = 'daily';
const WEEKLY = 'weekly';
const MONTHLY = 'monthly';
const ANUAL = 'anual';
const NEVER = 'never';

const SITEMAP_URLS = [
	[
		'loc' => 'login',
		'lastmod' => '2017-06-08',
		'changefreq' => MONTHLY,
		'priority' => .7
	],
	[
		'loc' => 'registrar',
		'lastmod' => '2017-06-08',
		'changefreq' => MONTHLY,
		'priority' => .7
	],
	[
		'loc' => 'home',
		'lastmod' => '2017-06-08',
		'changefreq' => MONTHLY,
		'priority' => .9
	],
	[
		'loc' => 'login',
		'lastmod' => '2017-06-08',
		'changefreq' => MONTHLY,
		'priority' => .9
	]
];

?>
<?xml version="1.0" encoding="utf-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

	<?php foreach(SITEMAP_URLS as $url): ?>
	
	<url>
		<loc><?= WEB_HOST.WEB_BASE.$url['loc'] ?></loc>
		<lastmod><?= $url['lastmod'] ?></lastmod>
		<changefreq><?= $url['changefreq'] ?></changefreq>
		<priority><?= $url['priority'] ?></priority> 
	</url>
	
	<?php endforeach; ?>

</urlset>

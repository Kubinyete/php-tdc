<?php declare(strict_types=1);
/**
 * Fornecedor do arquivo robots.txt
 */

// Alvo
const ROBOTS_USERAGENT = '*';

// Lista de caminhos bloqueados
const ROBOTS_BLOCKED = [
    'home',
    'static',
    'static/*'
];

// Lista de caminhos permitidos
const ROBOTS_ALLOWED = [
    'login',
    'registrar'
];

// Local do sitemap
const ROBOTS_SITEMAP = 'sitemap.xml'

?>
User-agent: <?= ROBOTS_USERAGENT ?><?php foreach(ROBOTS_BLOCKED as $caminho): ?>
Disallow: <?= WEB_BASE.$caminho ?>
<?php endforeach; ?><?php foreach(ROBOTS_ALLOWED as $caminho): ?>
Allow: <?= WEB_BASE.$caminho ?>
<?php endforeach; ?><?= ROBOTS_SITEMAP ?>

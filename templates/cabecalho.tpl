<!DOCTYPE html>
<html lang="pt-br">
<head>
	<!-- Documento -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge, chrome=1">

	<title><?= $_['doc-titulo']; ?></title>

	<!-- Mobile -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="theme-color" content="#333333">
	<meta name="msapplication-navbutton-color" content="#333333">
	<meta name="apple-mobile-web-app-status-bar-style" content="#333333">

	<!-- Google -->
	<meta name="keywords" content="<?= $_['doc-palavraschave']; ?>">
	<meta name="description" content="<?= $_['doc-descricao']; ?>">
	<meta name="author" content="<?= $_['doc-autor']; ?>">

	<!-- Open Graph (Facebook) -->
	<meta property="og:title" content="<?= $_['doc-titulo']; ?>">
	<meta property="og:description" content="<?= $_['doc-descricao']; ?>">
	<meta property="og:image" content="<?= $_['og-imagem']; ?>">
	<meta property="og:type" content="website">
	<meta property="og:site_name" content="<?= $_['doc-titulo']; ?>">
	<meta property="og:locale" content="pt_BR">

	<!-- Twitter Cards (Twitter) -->
	<meta name="twitter:card" content="<?= $_['twitter-card'] ?>">
	<meta name="twitter:title" content="<?= $_['doc-titulo'] ?>">
	<meta name="twitter:description" content="<?= $_['doc-descricao'] ?>">
	<meta name="twitter:image" content="<?= $_['twitter-imagem'] ?>">
	<meta name="twitter:image:alt" content="<?= $_['doc-descricao'] ?>">

	<!-- Relações -->
	<link rel="shortcut icon" href="<?= $_['doc-icone']; ?>">
	<link rel="icon" href="<?= $_['doc-icone']; ?>">
	<link rel="stylesheet" href="<?= $_['doc-gfonts']; ?>">
	<link rel="stylesheet" href="<?= $_['doc-fa']; ?>">
	<link rel="stylesheet" href="<?= $_['doc-css']; ?>">

	<!-- Scripts -->
	<script src="<?= $_['doc-jquery']; ?>"></script>
	<script src="<?= $_['doc-js']; ?>"></script>
</head>
<body style="background-image: url('<?= $_['doc-fundo'] ?>');">

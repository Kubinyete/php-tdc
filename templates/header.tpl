<header>
	<div class="logo-container"
		<img src="<?= ['header-logo'] ?>" alt="Logo do Aplicativo" draggable="false">
	</div>
	<div class="logo-texto-container">
		<h1>Torneio de Campeões</h1>
		<h2>Gerenciador de Alianças</h1>
	</div>

	<div class="usuario-container">
		<div class="usuario-container__centralizador">
			<p>Olá <span style="color: <?= $_['header-usuario-color'] ?>"><?= $_['header-usuario']; ?></span></p>
		</div>
		<div class="usuario-container__botao-container">
			<a class="botao" href="<?= $_['header-sair'] ?>">Sair</a>
		</div>
	</div>
</header>

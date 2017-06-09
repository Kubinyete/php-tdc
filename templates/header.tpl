<header>
	<div class="header__centralizador">
		<div class="logo-container">
			<a href="<?= $_['header-home'] ?>">
				<img src="<?= $_['header-logo'] ?>" alt="Logo do Aplicativo" draggable="false">
			</a>
		</div>
		<div class="logo-texto-container">
			<h1>Torneio de Campeões</h1>
			<h2>Sistema Gerenciador de Alianças</h1>
		</div>

		<div class="usuario-container">
			<div class="usuario-container__centralizador">
				<p>Olá, <span><?= $_['header-usuario']; ?></span></p>
			</div>

			<div class="usuario-container__centralizador botao-container">
				<a class="botao" href="<?= $_['header-sair'] ?>">Sair</a>
			</div>
		</div>

		<div class="cfix"></div>
	</div>
</header>

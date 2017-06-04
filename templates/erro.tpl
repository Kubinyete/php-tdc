<main class="erro-pag">
	<div class="erro-pag">
		<div class="erro-pag__icone" style="background-image: url('<?= $_['erro-icone']; ?>');"></div>
		<h1>Aparentemente algo deu errado...</h1>
		<h2><?= $_['erro-titulo']; ?></h2>
		
		<div class="erro-pag__texto">
			<?php
			foreach ($_['erro-paragrafos'] as $p):
			?>
			<p><?= $p ?></p>
			<?php
			endforeach;
			?>
			Clique <a href="<?= $_['erro-home']; ?>">aqui</a> para retornar a página principal
		</div>
	</div>
</main>

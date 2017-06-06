<main class="login-form">
	<div class="login-form">
		<div class="login-form__logo" style="background-image: url('<?= $_['log-logo']; ?>');"></div>

		<form method="POST" autocomplete="off" action="<?= $_['log-action']; ?>">
			<label for="log">Nome do usuário</label>
			<br>
			<input id="log" type="text" name="log" maxlength="<?= $_['log-log-maxlength']; ?>" placeholder="Usuário" required value="<?= $_['log-usuario'] ?? '' ?>">
			<br>
			
			<?php
			// Se temos um erro relacionado ao nome do usuário
			if ($_['log-usuario-erro'] !== null):
			?>
			<span class="login-form__erro"><?= $_['log-usuario-erro'] ?></span>
			<br>
			<?php
			endif;
			?>

			<label for="sen">Senha</label>
			<br>
			<input id="sen" type="password" name="sen" maxlength="<?= $_['log-sen-maxlength']; ?>" placeholder="Senha" required>
			<br>

			<?php
			// Se temos um erro relacionado à senha do usuário
			if ($_['log-senha-erro'] !== null):
			?>
			<span class="login-form__erro"><?= $_['log-senha-erro'] ?></span>
			<br>
			<?php
			endif;
			?>

			<div class="login-form__texto">
				<span>Não possui uma conta? Clique <a href="<?= $_['log-pagina-registrar']; ?>">aqui</a>.</span>
			</div>
			<br>
			<div class="login-form__centralizador">
				<button class="login-form__botao" type="submit">Entrar</button>
			</div>
		</form>
	</div>
</main>

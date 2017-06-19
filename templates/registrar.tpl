<main class="login-form">
	<div class="login-form">
		<div class="login-form__logo" style="background-image: url('<?= $_['reg-logo']; ?>');"></div>

		<form method="POST" autocomplete="off" action="<?= $_['reg-action']; ?>">
			<label for="log">Nome do usuário</label>
			<br>
			<input id="log" type="text" name="log" maxlength="<?= $_['reg-log-maxlength']; ?>" placeholder="Usuário" required value="<?= $_['reg-usuario'] ?? '' ?>">
			<br>
			
			<?php
			// Se temos um erro relacionado ao nome do usuário
			if ($_['reg-usuario-erro'] !== null):
			?>
			<span class="login-form__erro"><?= $_['reg-usuario-erro'] ?></span>
			<br>
			<?php
			endif;
			?>

			<?php
			if ($_['reg-usuario-erro2'] !== null):
			?>
			<span class="login-form__erro"><?= $_['reg-usuario-erro2'] ?></span>
			<br>
			<?php
			endif;
			?>

			<label for="sen">Senha</label>
			<br>
			<input id="sen" type="password" name="sen" maxlength="<?= $_['reg-sen-maxlength']; ?>" placeholder="Senha" required>
			<br>

			<?php
			// Se temos um erro relacionado à senha do usuário
			if ($_['reg-senha-erro'] !== null):
			?>
			<span class="login-form__erro"><?= $_['reg-senha-erro'] ?></span>
			<br>
			<?php
			endif;
			?>

			<?php
			if ($_['reg-senha-erro2'] !== null):
			?>
			<span class="login-form__erro"><?= $_['reg-senha-erro2'] ?></span>
			<br>
			<?php
			endif;
			?>

			<label for="con">Confirmação de senha</label>
			<br>
			<input id="con" type="password" name="con" maxlength="<?= $_['reg-con-maxlength']; ?>" placeholder="Digite sua senha novamente" required>
			<br>

			<?php
			// Se temos um erro relacionado à confirmação de senha do usuário
			if ($_['reg-consenha-erro'] !== null):
			?>
			<span class="login-form__erro"><?= $_['reg-consenha-erro'] ?></span>
			<br>
			<?php
			endif;
			?>

			<div class="login-form__texto">
				<span>Já possui uma conta? Clique <a href="<?= $_['reg-pagina-login']; ?>">aqui</a>.</span>
			</div>
			<br>
			<div class="login-form__centralizador">
				<button class="login-form__botao" type="submit">Registrar</button>
			</div>
		</form>
	</div>
</main>

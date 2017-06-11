<main class="home">
    <article class="home">
    	<section class="generic aliancas-header">
    		<div class="generic__icone" style="background-image: url('<?= $_['home-aliancas-icone'] ?>');"></div>
    		<div class="generic__right-container">
    			<h3>Suas Alianças</h3>
    			<?php foreach ($_['home-aliancas-descricao'] as $p): ?>
    			<p><?= $p ?></p>
    			<?php endforeach; ?>
    		</div>
    		<div class="cfix"></div>
    	</section>

    	<section class="generic-form">
    		<form method="POST" action="<?= $_['home-aliancasform-action'] ?>" autocomplete="off">
    			<label for="nom">Aliança</label>
    			<input type="text" id="nom" name="nom" placeholder="Nome da Aliança" required value="<?= $_['home-aliancasform-nom'] ?? '' ?>">

    			<?php if ($_['home-aliancasform-nom-erro'] !== null): ?>
    			<span class="generic-form__erro"><?= $_['home-aliancasform-nom-erro'] ?></span>
				<br>
				<?php endif; ?>
    			
    			<button type="submit">Adicionar</button>
    		</form>
    	</section>
    	
    	<section class="generic-lista aliancas-lista">
    		<h3>Listagem de Alianças</h3>
    		<?php if (count($_['home-aliancas']) > 0): ?>
    		<ul>
    			<?php foreach ($_['home-aliancas'] as $a): ?>
    			
    			<li>
    				<div style="background-image: url('<?= $_['home-aliancas-icone'] ?>');" class="generic-lista__icone"></div>
    				<a href="<?= $_['home-aliancas-href'] ?>"><?= $a->getNome() ?></a>
    			</li>
    			
    			<?php endforeach; ?>
    		</ul>
    		
    		<?php else: ?>
    		
    		<p class="generic-lista__erro"><?= $_['home-aliancas-lista-erro'] ?></p>
    		
    		<?php endif; ?>
    	</section>
    </article>
</main>

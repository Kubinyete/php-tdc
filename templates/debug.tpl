<?php
if (APP_DEBUG):
?>

<div id="modoDebugIcone" style="background-image: url('<?= $_['debug-icone']; ?>');"></div>

<!-- LogPainel -->
<div id="modoDebugLogPainel">

	<?php
	foreach ($_LOG() as $n):
	?>

	<div class="modoDebugLogPainel__notificacao">
		<p><i class="fa <?= $n->getTipoIcone() ?>"></i> <strong><?= $n->getTipoString() ?></strong></p>
		<hr>
		<span><?= $n->getMensagem() ?></span>
	</div>

	<?php
	endforeach;
	?>

</div>

<?php
endif; 
?>

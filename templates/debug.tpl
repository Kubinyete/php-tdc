<?php
if (APP_DEBUG):
?>

<div id="modoDebugIcone" style="background-image: url('<?= $_['debug-icone']; ?>');"></div>

<!-- LogPainel -->
<div id="modoDebugLogPainel">
	<h2>Log</h2>
	<?php
	$id = 0;
	foreach ($_LOG() as $n):
	?>

	<div id="notificacao-<?= $id ?>"class="modoDebugLogPainel__notificacao">
		<p><i class="fa <?= $n->getTipoIcone() ?>"></i> <strong><?= $n->getTipoString() ?></strong></p>
		<hr>
		<span><?= $n->getMensagem() ?></span>
		<button class="notificacao__fechar" onclick="phptdc.fecharNotificacao('notificacao-<?= $id ?>');"><i class="fa fa-close"></i></button>
	</div>

	<?php
	$id++;
	endforeach;
	?>

</div>

<?php
endif; 
?>

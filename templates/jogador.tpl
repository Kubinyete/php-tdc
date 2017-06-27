<main class="generic">
    <article class="jogador">
        <section class="generic">
            <div class="generic__icone" style="background-image: url('<?= $_['jogador-icone'] ?>');"></div>
            <div class="generic__right-container">
                <h3><?= ($_['jogador-jogador']->getNome() !== null) ? $_['jogador-jogador']->getNome(true) : $_['jogador-jogador']->getNickname() ?></h3>
                <p><strong>Aliança:</strong> <?= $_['jogador-alianca']->getNome(true) ?></p>
                <p><strong>Adicionado em</strong>: <?= $_['jogador-jogador']->getDataCriacao(true) ?></p>
                <hr>
            </div>
            <div class="cfix"></div>
        </section>
        <section class="generic-form">
            <h3>Atualize as informações deste Jogador</h3>
            <?php $_IMPORTAR('jogadoresform'); ?>
        </section>
    </article>
</main>

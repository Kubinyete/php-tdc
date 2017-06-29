<main class="generic">
    <article class="grupo">
        <section class="generic">
            <div class="generic__icone" style="background-image: url('<?= str_replace('%c', strtolower($_['grupo-grupo']->getNome()[-1]), $_['grupo-icone']) ?>');"></div>
            <div class="generic__right-container">
                <h3><?= $_['grupo-grupo']->getNome() ?></h3>
                <p><strong>Aliança:</strong> <?= $_['grupo-alianca']->getNome(true) ?></p>
                <p><strong>Adicionado em</strong>: <?= $_['grupo-grupo']->getDataCriacao(true) ?></p>
                <hr>
            </div>
            <div class="cfix"></div>
        </section>
    </article>
</main>

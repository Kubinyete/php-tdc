<main class="generic">
    <article class="alianca">
        <section class="generic">
            <div class="generic__icone" style="background-image: url('<?= $_['alianca-icone'] ?>');"></div>
            <div class="generic__right-container">
                <h3><?= $_['alianca-alianca']->getNome(true) ?></h3>
                <p><strong>Administrador</strong> <?= $_USUARIO->getLogin(true) ?></p>
                <p><strong>Adicionada em</strong> <?= $_['alianca-alianca']->getDataCriacao(true) ?></p>
                <hr>
                <p><strong>Jogadores:</strong> <?= $_['alianca-jogadores-contagem'] ?>/<?= $_['alianca-jogadores-limite'] ?></p>
                <p><strong>Missões realizadas:</strong> <?= $_['alianca-missoes-contagem'] ?></p>
                <p><strong>Guerras realizadas:</strong> <?= $_['alianca-guerras-contagem'] ?></p>
            </div>
            <div class="cfix"></div>
        </section>
    </article>
</main>

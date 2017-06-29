<main class="generic">
    <article class="alianca">
        <section class="generic">
            <div class="generic__icone" style="background-image: url('<?= $_['alianca-icone'] ?>');"></div>
            <div class="generic__right-container">
                <h3><?= $_['alianca-alianca']->getNome(true) ?></h3>
                <p><strong>Administrador</strong>: <?= $_USUARIO->getLogin(true) ?></p>
                <p><strong>Adicionada em</strong>: <?= $_['alianca-alianca']->getDataCriacao(true) ?></p>
                <hr>
                <p><strong>Jogadores:</strong> <?= $_['alianca-jogadores-contagem'] ?>/<?= $_['alianca-jogadores-limite'] ?></p>
                <p><strong>Missões realizadas:</strong> <?= $_['alianca-missoes-contagem'] ?></p>
                <p><strong>Guerras realizadas:</strong> <?= $_['alianca-guerras-contagem'] ?></p>
            </div>
            <div class="cfix"></div>
        </section>
        <section class="generic generic--triple">
            <h3>Divisão de Grupos da Aliança</h3>
            <?php 
            $c = 97;
            foreach($_['alianca-grupos'] as $g):
            ?>
            <a href="<?= str_replace('%i', $g->getId(), $_['alianca-grupo-href']) ?>">
                <div class="generic__icone generic__icone--triple" style="background-image: url('<?= str_replace('%c', chr($c++), $_['alianca-grupo-icone']) ?>');"></div>
            </a>
            <?php endforeach; ?>
            <div class="cfix"></div>
        </section>
         <section class="generic generic--double">
            <h3>Eventos</h3>
            <div class="generic__icone generic__icone--double" style="background-image: url('<?= $_['alianca-missoes-icone'] ?>');"></div>
            <div class="generic__icone generic__icone--double" style="background-image: url('<?= $_['alianca-guerras-icone'] ?>');"></div>
            <div class="cfix"></div>
        </section>
        <section class="generic-form">
            <h3>Adicione um novo Jogador</h3>
            <?php $_IMPORTAR('jogadoresform'); ?>
        </section>
        <section class="generic-lista jogadores-lista">
            <h3>Jogadores nesta Aliança</h3>
            <?php if (count($_['alianca-jogadores']) > 0): ?>
            <ul>
                <?php foreach ($_['alianca-jogadores'] as $j): ?>

                <li>
                    <div style="background-image: url('<?= $_['alianca-jogadores-icone'] ?>');" class="generic-lista__icone"></div>
                    <div class="generic-lista__nome">
                        <p><?= ($j->getNome() !== null) ? $j->getNome(true) : $j->getNickname() ?> (<?= $j->getNickname(true) ?>)</p>
                        <div class="generic-lista__descricao">
                            <p><strong>Nível</strong>: <?= $j->getNivel() ?></p>
                            <p><strong>Telefone</strong>: <?= ($j->getTelefone() !== null) ? $j->getTelefone() : $_['alianca-jogadores-campo-inexistente'] ?></p>
                            <p><strong>Email</strong>: <?= $j->getEmail() ?></p>
                            <p><strong>Tipo</strong>: <?= $j->getTipo(true) ?></p>
                        </div>
                    </div>
                    <div class="generic-lista__botao">
                        <a href="<?= str_replace('%i', $j->getId(), $_['alianca-jogadores-href']) ?>">Editar Informações</a>
                    </div>

                    <div class="cfix"></div>
                </li>

                <?php endforeach; ?>
            </ul>

            <?php else: ?>

            <p class="generic-lista__erro"><?= $_['alianca-jogadores-erro'] ?></p>

            <?php endif; ?>
        </section>
    </article>
</main>

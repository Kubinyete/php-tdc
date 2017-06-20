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
        <section class="generic-form">
            <h3>Adicione um novo Jogador</h3>
            <form method="POST" action="<?= $_['alianca-jogadoresform-action'] ?>" autocomplete="off">
                <label for="nom">Nome do Jogador</label>
                <input type="text" id="nom" name="nom" placeholder="Nome do Jogador" value="<?= $_['alianca-jogadoresform-nom'] ?? '' ?>" maxlength="<?= $_['alianca-jogadoresform-nom-maxlength'] ?>">

                <?php if ($_['alianca-jogadoresform-nom-erro'] !== null): ?>
                <span class="generic-form__erro"><?= $_['alianca-jogadoresform-nom-erro'] ?></span>
                <br>
                <?php endif; ?>

                <?php if ($_['alianca-jogadoresform-nom-erro-2'] !== null): ?>
                <span class="generic-form__erro"><?= $_['alianca-jogadoresform-nom-erro-2'] ?></span>
                <br>
                <?php endif; ?>

                <?php if ($_['alianca-jogadoresform-nom-erro-3'] !== null): ?>
                <span class="generic-form__erro"><?= $_['alianca-jogadoresform-nom-erro-3'] ?></span>
                <br>
                <?php endif; ?>

                <label for="nic">Apelido do Jogador</label>
                <input type="text" id="nic" name="nic" placeholder="Apelido do Jogador" required value="<?= $_['alianca-jogadoresform-nic'] ?? '' ?>" maxlength="<?= $_['alianca-jogadoresform-nic-maxlength'] ?>">

                <?php if ($_['alianca-jogadoresform-nic-erro'] !== null): ?>
                <span class="generic-form__erro"><?= $_['alianca-jogadoresform-nic-erro'] ?></span>
                <br>
                <?php endif; ?>

                <?php if ($_['alianca-jogadoresform-nic-erro-2'] !== null): ?>
                <span class="generic-form__erro"><?= $_['alianca-jogadoresform-nic-erro-2'] ?></span>
                <br>
                <?php endif; ?>

                <label for="niv">Nível do Jogador</label>
                <input type="number" id="niv" name="niv" required value="<?= $_['alianca-jogadoresform-niv'] ?? '0' ?>" min="0" max="<?= $_['alianca-jogadoresform-niv-max'] ?>">

                <?php if ($_['alianca-jogadoresform-niv-erro'] !== null): ?>
                <span class="generic-form__erro"><?= $_['alianca-jogadoresform-niv-erro'] ?></span>
                <br>
                <?php endif; ?>

                <label for="tel">Telefone do Jogador</label>
                <input type="tel" id="tel" name="tel" placeholder="Telefone do Jogador" value="<?= $_['alianca-jogadoresform-tel'] ?? '' ?>" maxlength="<?= $_['alianca-jogadoresform-tel-maxlength'] ?>">

                <?php if ($_['alianca-jogadoresform-tel-erro'] !== null): ?>
                <span class="generic-form__erro"><?= $_['alianca-jogadoresform-tel-erro'] ?></span>
                <br>
                <?php endif; ?>

                <label for="ema">Email do Jogador</label>
                <input type="email" id="ema" name="ema" placeholder="usuário@serviço.com" value="<?= $_['alianca-jogadoresform-ema'] ?? '' ?>" maxlength="<?= $_['alianca-jogadoresform-ema-maxlength'] ?>">

                <?php if ($_['alianca-jogadoresform-ema-erro'] !== null): ?>
                <span class="generic-form__erro"><?= $_['alianca-jogadoresform-ema-erro'] ?></span>
                <br>
                <?php endif; ?>

                <?php if ($_['alianca-jogadoresform-ema-erro-2'] !== null): ?>
                <span class="generic-form__erro"><?= $_['alianca-jogadoresform-ema-erro-2'] ?></span>
                <br>
                <?php endif; ?>

                <label for="tip">Tipo do Jogador</label><br>
                <select name="tip" id="tip">
                    
                    <?php foreach ($_['alianca-jogadoresform-tip-tipos'] as $k => $v): ?>
                    <option value="<?= $k ?>"><?= $v ?></option>
                    <?php endforeach; ?>
                
                </select><br>

                <?php if ($_['alianca-jogadoresform-tip-erro'] !== null): ?>
                <span class="generic-form__erro"><?= $_['alianca-jogadoresform-tip-erro'] ?></span>
                <br>
                <?php endif; ?>

                <label for="sta">Status do Jogador</label><br>
                <select name="sta" id="sta">
                    <option value="0">Desativado</option>
                    <option value="1" selected>Ativado</option>
                </select><br>

                <label for="obs">Observações do Jogador</label>
                <textarea name="obs" id="obs"><?= $_['alianca-jogadoresform-obs'] ?? '' ?></textarea>

                <?php if ($_['alianca-jogadoresform-obs-erro'] !== null): ?>
                <span class="generic-form__erro"><?= $_['alianca-jogadoresform-obs-erro'] ?></span>
                <br>
                <?php endif; ?>

                <button type="submit">Adicionar</button>
            </form>
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

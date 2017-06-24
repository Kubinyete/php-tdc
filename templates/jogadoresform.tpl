<form method="POST" action="<?= $_['jogadoresform-action'] ?>" autocomplete="off">
    <label for="nom">Nome do Jogador</label>
    <input type="text" id="nom" name="nom" placeholder="Nome do Jogador" value="<?= $_['jogadoresform-nom'] ?? '' ?>" maxlength="<?= $_['jogadoresform-nom-maxlength'] ?>">

    <?php if ($_['jogadoresform-nom-erro'] !== null): ?>
    <span class="generic-form__erro"><?= $_['jogadoresform-nom-erro'] ?></span>
    <br>
    <?php endif; ?>

    <?php if ($_['jogadoresform-nom-erro-2'] !== null): ?>
    <span class="generic-form__erro"><?= $_['jogadoresform-nom-erro-2'] ?></span>
    <br>
    <?php endif; ?>

    <?php if ($_['jogadoresform-nom-erro-3'] !== null): ?>
    <span class="generic-form__erro"><?= $_['jogadoresform-nom-erro-3'] ?></span>
    <br>
    <?php endif; ?>

    <label for="nic">Apelido do Jogador</label>
    <input type="text" id="nic" name="nic" placeholder="Apelido do Jogador" required value="<?= $_['jogadoresform-nic'] ?? '' ?>" maxlength="<?= $_['jogadoresform-nic-maxlength'] ?>">

    <?php if ($_['jogadoresform-nic-erro'] !== null): ?>
    <span class="generic-form__erro"><?= $_['jogadoresform-nic-erro'] ?></span>
    <br>
    <?php endif; ?>

    <?php if ($_['jogadoresform-nic-erro-2'] !== null): ?>
    <span class="generic-form__erro"><?= $_['jogadoresform-nic-erro-2'] ?></span>
    <br>
    <?php endif; ?>

    <label for="niv">Nível do Jogador</label>
    <input type="number" id="niv" name="niv" required value="<?= $_['jogadoresform-niv'] ?? '0' ?>" min="0" max="<?= $_['jogadoresform-niv-max'] ?>">

    <?php if ($_['jogadoresform-niv-erro'] !== null): ?>
    <span class="generic-form__erro"><?= $_['jogadoresform-niv-erro'] ?></span>
    <br>
    <?php endif; ?>

    <label for="tel">Telefone do Jogador</label>
    <input type="tel" id="tel" name="tel" placeholder="Telefone do Jogador" value="<?= $_['jogadoresform-tel'] ?? '' ?>" maxlength="<?= $_['jogadoresform-tel-maxlength'] ?>">

    <?php if ($_['jogadoresform-tel-erro'] !== null): ?>
    <span class="generic-form__erro"><?= $_['jogadoresform-tel-erro'] ?></span>
    <br>
    <?php endif; ?>

    <label for="ema">Email do Jogador</label>
    <input type="email" id="ema" name="ema" placeholder="usuário@serviço.com" value="<?= $_['jogadoresform-ema'] ?? '' ?>" maxlength="<?= $_['jogadoresform-ema-maxlength'] ?>">

    <?php if ($_['jogadoresform-ema-erro'] !== null): ?>
    <span class="generic-form__erro"><?= $_['jogadoresform-ema-erro'] ?></span>
    <br>
    <?php endif; ?>

    <?php if ($_['jogadoresform-ema-erro-2'] !== null): ?>
    <span class="generic-form__erro"><?= $_['jogadoresform-ema-erro-2'] ?></span>
    <br>
    <?php endif; ?>

    <label for="tip">Tipo do Jogador</label><br>
    <select name="tip" id="tip">
        
        <?php foreach ($_['jogadoresform-tip-tipos'] as $k => $v): ?>
        <option value="<?= $k ?>" <?= ($k === $_['jogadoresform-tip']) ? 'selected' : '' ?>><?= $v ?></option>
        <?php endforeach; ?>

    </select><br>

    <?php if ($_['jogadoresform-tip-erro'] !== null): ?>
    <span class="generic-form__erro"><?= $_['jogadoresform-tip-erro'] ?></span>
    <br>
    <?php endif; ?>

    <label for="sta">Status do Jogador</label><br>
    <select name="sta" id="sta">
        <option value="0" <?= ($_['jogadoresform-sta']) ? '' : 'selected' ?>>Desativado</option>
        <option value="1" <?= ($_['jogadoresform-sta']) ? 'selected' : '' ?>>Ativado</option>
    </select><br>

    <?php if ($_['jogadoresform-sta-erro'] !== null): ?>
    <span class="generic-form__erro"><?= $_['jogadoresform-sta-erro'] ?></span>
    <br>
    <?php endif; ?>

    <label for="obs">Observações do Jogador</label>
    <textarea name="obs" id="obs"><?= $_['jogadoresform-obs'] ?? '' ?></textarea>

    <?php if ($_['jogadoresform-obs-erro'] !== null): ?>
    <span class="generic-form__erro"><?= $_['jogadoresform-obs-erro'] ?></span>
    <br>
    <?php endif; ?>

    <button type="submit">Enviar</button>
</form>
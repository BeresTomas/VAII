<?php

// Vytvorene s pomocou AI (Claude).
// Formular odpovede - vklada sa do add.view.php (nova odpoved s chybami) a edit.view.php (uprava odpovede).

/** @var \Framework\Support\LinkGenerator $link */
/** @var array $formErrors */
/** @var \App\Models\Post $post */
/** @var \App\Models\Topic[] $topics */
?>

<?php if (isset($formErrors)) { ?>
    <ul class="form-errors">
        <?php foreach ($formErrors as $error) { ?>
            <li><?= e($error) ?></li>
        <?php } ?>
    </ul>
<?php } ?>

<form method="post" action="<?= $link->url('post.save') ?>">
    <!-- Skryte id - pri novej odpovedi je prazdne, pri uprave obsahuje id upravovanej odpovede -->
    <input type="hidden" name="id" value="<?= e($post->getId()) ?>">

    <!-- Vyber temy, do ktorej odpoved patri. Vybrana je aktualna tema odpovede. -->
    <label for="topic_id">Téma</label>
    <select id="topic_id" name="topic_id" required>
        <option value="">-- vyberte tému --</option>
        <?php foreach ($topics as $topicOption) { ?>
            <option value="<?= $topicOption->getId() ?>" <?= $topicOption->getId() == $post->getTopicId() ? 'selected' : '' ?>>
                <?= e($topicOption->getTitle()) ?>
            </option>
        <?php } ?>
    </select>

    <label for="text">Text odpovede</label>
    <textarea id="text" name="text" rows="8" required minlength="5" maxlength="5000"><?= e($post->getText()) ?></textarea>

    <button type="submit" class="btn btn-primary">Uložiť</button>
</form>

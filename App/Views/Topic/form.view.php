<?php

// Vytvorene s pomocou AI (Claude).
// Spolocny formular pre pridanie aj upravu temy - vklada sa do add.view.php a edit.view.php.

/** @var \Framework\Support\LinkGenerator $link */
/** @var array $formErrors */
/** @var \App\Models\Topic $topic */

// Pri novej teme $topic este neexistuje, preto su polia prazdne
$id = isset($topic) ? $topic->getId() : '';
$title = isset($topic) ? $topic->getTitle() : '';
$text = isset($topic) ? $topic->getText() : '';
?>

<?php if (isset($formErrors)) { ?>
    <ul class="form-errors">
        <?php foreach ($formErrors as $error) { ?>
            <li><?= e($error) ?></li>
        <?php } ?>
    </ul>
<?php } ?>

<form method="post" action="<?= $link->url('topic.save') ?>">
    <!-- Skryte id - pri novej teme je prazdne, pri uprave obsahuje id upravovanej temy -->
    <input type="hidden" name="id" value="<?= e($id) ?>">

    <label for="title">Názov témy</label>
    <input type="text" id="title" name="title" value="<?= e($title) ?>" required minlength="5" maxlength="150">

    <label for="text">Text príspevku</label>
    <textarea id="text" name="text" rows="8" required minlength="10"><?= e($text) ?></textarea>

    <button type="submit" class="btn btn-primary">Uložiť</button>
</form>

<?php

// Vytvorene s pomocou AI (Claude).

/** @var \Framework\Support\LinkGenerator $link */
/** @var \App\Models\Topic $topic */
?>

<nav class="breadcrumb">
    <a href="<?= $link->url('forum.index') ?>">Fórum</a> /
    <a href="<?= $link->url('forum.index') ?>">Voľná debata</a> /
    <a href="<?= $link->url('forum.topic', ['id' => $topic->getId()]) ?>"><?= e($topic->getTitle()) ?></a> /
    <span>Úprava</span>
</nav>

<section class="card reply-form">
    <h1>Úprava témy</h1>
    <?php require 'form.view.php' ?>
</section>

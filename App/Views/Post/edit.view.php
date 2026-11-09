<?php

/** @var \Framework\Support\LinkGenerator $link */
/** @var \App\Models\Post $post */
?>

<nav class="breadcrumb">
    <a href="<?= $link->url('forum.index') ?>">Fórum</a> /
    <a href="<?= $link->url('forum.index') ?>">Voľná debata</a> /
    <a href="<?= $link->url('forum.topic', ['id' => $post->getTopicId()]) ?>">Téma</a> /
    <span>Úprava odpovede</span>
</nav>

<section class="card reply-form">
    <h1>Úprava odpovede</h1>
    <?php require 'form.view.php' ?>
</section>

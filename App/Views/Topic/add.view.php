<?php

// Vytvorene s pomocou AI (Claude).

/** @var \Framework\Support\LinkGenerator $link */
?>

<nav class="breadcrumb">
    <a href="<?= $link->url('forum.index') ?>">Fórum</a> /
    <a href="<?= $link->url('forum.index') ?>">Voľná debata</a> /
    <span>Nová téma</span>
</nav>

<section class="card reply-form">
    <h1>Nová téma</h1>
    <?php require 'form.view.php' ?>
</section>

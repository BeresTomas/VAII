<?php

/** @var \Framework\Support\LinkGenerator $link */
/** @var \Framework\Auth\AppUser $user */

// Neprihlaseneho posielaju tlacidla Odpovedat, Dakujem a Sledovat na Login
$replyUrl = $user->isLoggedIn() ? '#odpoved' : App\Configuration::LOGIN_URL;
$actionUrl = $user->isLoggedIn() ? '#' : App\Configuration::LOGIN_URL;
?>
<!-- Detail temy - staticky obsah, neskor sa nacita z databazy.
     Generovane s pomocou AI (Claude) a upravene. -->

<!-- Omrvinkova navigacia -->
<nav class="breadcrumb">
    <a href="<?= $link->url('forum.index') ?>">Fórum</a> /
    <a href="<?= $link->url('forum.index') ?>">Voľná debata</a> /
    <span>Primiešavate aj vy štipku soli do sirupu?</span>
</nav>

<!-- Zahlavie temy: nazov, udaje a tlacidla -->
<section class="card category-header">
    <!-- Moderator menu by bolo tu napravo, ale je skryte (role zatial nemame) -->
    <h1>Primiešavate aj vy štipku soli do sirupu?</h1>
    <p class="category-meta">
        Založil <a href="<?= $link->url('profile.index') ?>">Jožo</a>
        <time datetime="2026-10-20">20. 10. 2026</time> · 3 odpovede · 214 zobrazení
    </p>

    <div class="topics-toolbar topic-toolbar">
        <div class="topic-buttons">
            <a href="<?= $replyUrl ?>" class="btn btn-primary">Odpovedať</a>
            <a href="<?= $actionUrl ?>" class="btn">Sledovať tému</a>
        </div>
        <!-- Stranka je zatial len jedna -->
        <nav class="pagination">
            <a href="#" class="active">1</a>
        </nav>
    </div>
</section>

<?php

/** @var \Framework\Support\LinkGenerator $link */
?>
<!-- Profil pouzivatela - staticky obsah, neskor sa nacita z databazy.
     Generovane s pomocou AI (Claude) a upravene. -->

<!-- Omrvinkova navigacia -->
<nav class="breadcrumb">
    <a href="<?= $link->url('forum.index') ?>">Fórum</a> / <span>Používatelia</span> / <span>Jožo</span>
</nav>

<!-- Hlavicka profilu: banner, fotka, meno, udaje, tlacidla a statistiky -->
<section class="card profile-header">
    <!-- Banner - zatial len farebny pas namiesto fotky (napr. vcelnica pouzivatela) -->
    <div class="profile-banner"></div>

    <div class="profile-top">
        <img src="<?= $link->asset('images/logo.svg') ?>" alt="Profilová fotka – Jožo" width="96" height="96"
             class="avatar profile-photo">

        <div class="profile-info">
            <h1>Jožo</h1>
            <p>
                <span class="badge">Skúsený včelár</span>
                <span class="badge">Moderátor</span>
            </p>
            <p class="muted">Člen od 12. 3. 2021 · Naposledy online pred 2 hodinami · Liptovský Mikuláš</p>
        </div>

        <!-- Akcne tlacidla - zatial len vizualne, bez funkcie -->
        <div class="profile-actions">
            <button type="button" class="btn btn-primary">Poslať správu</button>
            <button type="button" class="btn">Sledovať</button>
            <button type="button" class="btn" aria-label="Ďalšie možnosti">⋯</button>
        </div>
    </div>

    <!-- Pas so statistikami -->
    <ul class="profile-stats">
        <li><strong>340</strong> príspevkov</li>
        <li><strong>12</strong> tém</li>
        <li><strong>85</strong> „Ďakujem“</li>
        <li><strong>18</strong> fotiek</li>
    </ul>
</section>

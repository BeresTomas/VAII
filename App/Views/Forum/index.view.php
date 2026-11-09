<?php

/** @var \Framework\Support\LinkGenerator $link */
/** @var \App\Models\Topic[] $topics */
/** @var \Framework\Auth\AppUser $user */

// Neprihlaseneho posle tlacidlo Pridat novu temu na Login (rovnako ako v detaile temy)
$addUrl = $user->isLoggedIn() ? $link->url('topic.add') : App\Configuration::LOGIN_URL;
?>
<!-- Stranka kategorie fora "Volna debata" - obsah prevzaty z html/forum.html (Uloha 4, generovane s pomocou AI a upravene). -->

<!-- Omrvinkova navigacia -->
<nav class="breadcrumb">
    <a href="<?= $link->url('forum.index') ?>">Fórum</a> / <span>Voľná debata</span>
</nav>

<!-- Hlavicka kategorie v samostatnom boxe, oddelena od zvysku stranky -->
<section class="card category-header">
    <!-- Moderator menu by bolo tu napravo, ale je skryte (pouzivatel nie je prihlaseny) -->
    <h1>Voľná debata</h1>
    <p class="category-meta">9 tém · 120 príspevkov</p>

    <p class="category-desc">
        Priestor na voľnú diskusiu o všetkom okolo včiel a včelárenia – skúsenosti,
        otázky, tipy aj bežné rozhovory medzi včelármi.
    </p>

    <!-- Vyhladavaci riadok s filtrom -->
    <form class="forum-search">
        <input type="search" placeholder="Sem píšte hľadaný výraz">
        <button type="button" class="btn">Filtre</button>
        <button type="submit" class="btn btn-primary">Vyhľadaj</button>
    </form>
</section>

<!-- Podfora - prekliky na hlbsie zanorene kategorie -->
<section class="card section-box">
    <h2 class="section-title">Fórum</h2>
    <div class="section-body">
        <table class="forum-table">
            <thead>
            <tr>
                <th>Fórum</th>
                <th class="count">Témy</th>
                <th class="count">Príspevky</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <a href="#">Slovenský Zväz Včelárov</a>
                    <div class="muted">Oficiálne oznamy a diskusie zväzu</div>
                </td>
                <td class="count"><span class="badge">4</span></td>
                <td class="count"><span class="badge">42</span></td>
            </tr>
            <tr>
                <td>
                    <a href="#">Tipy a triky</a>
                    <div class="muted">Praktické rady od skúsených včelárov</div>
                </td>
                <td class="count"><span class="badge">5</span></td>
                <td class="count"><span class="badge">78</span></td>
            </tr>
            </tbody>
        </table>
    </div>
</section>

<!-- Nastroje nad temami: pridanie novej temy + zoradenie -->
<div class="topics-toolbar">
    <a href="<?= $addUrl ?>" class="btn btn-primary">Pridať novú tému</a>
    <div class="sort">
        <span class="sort-label">Zoradiť podľa:</span>
        <button type="button" class="btn">Dátum</button>
        <button type="button" class="btn">Počet odpovedí</button>
    </div>
</div>

<!-- Tabulka tem -->
<section class="card section-box">
    <h2 class="section-title">Témy</h2>
    <div class="section-body">
        <table class="topics-table">
            <thead>
            <tr>
                <th>Autor</th>
                <th>Téma</th>
                <th class="count">Odpovede</th>
                <th>Posledná odpoveď</th>
            </tr>
            </thead>
            <tbody>
            <!-- Riadky tem sa nacitaju z DB. Vytvorene s pomocou AI (Claude). -->
            <?php foreach ($topics as $topic) { ?>
                <?php $lastPost = $topic->getLastPost(); ?>
                <tr>
                    <td class="author">
                        <img src="<?= $link->asset('images/logo.svg') ?>" alt="Avatar" width="32" height="32" class="avatar">
                        <a href="<?= $link->url('profile.index') ?>"><?= e($topic->getAuthor()) ?></a>
                    </td>
                    <td>
                        <a href="<?= $link->url('forum.topic', ['id' => $topic->getId()]) ?>"><?= e($topic->getTitle()) ?></a>
                        <div class="muted">Pridané <?= date('j. n. Y', strtotime($topic->getCreatedAt())) ?></div>
                    </td>
                    <td class="count"><span class="badge"><?= $topic->getPostCount() ?></span></td>
                    <!-- Ziadna odpoved -> posledna odpoved sa nezobrazuje -->
                    <td class="last-reply">
                        <?php if ($lastPost != null) { ?>
                            <a href="<?= $link->url('forum.topic', ['id' => $topic->getId()]) ?>#odpoved-<?= $lastPost->getId() ?>" class="last-reply-link">
                                <img src="<?= $link->asset('images/logo.svg') ?>" alt="Avatar" width="24" height="24" class="avatar">
                                <span>od <?= e($lastPost->getAuthor()) ?></span>
                            </a>
                            <div class="muted"><?= date('j. n. Y', strtotime($lastPost->getCreatedAt())) ?></div>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>

        <!-- Strankovanie -->
        <nav class="pagination">
            <a href="#" class="active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
        </nav>
    </div>
</section>

<!-- Spodna info lista -->
<div class="info-bar">
    <span>Aktuálne je prihlásených: 26 užívateľov</span>
    <span>Meniny má dnes: Adrián</span>
</div>


<?php

/** @var \Framework\Support\LinkGenerator $link */
/** @var \Framework\Auth\AppUser $user */
/** @var \App\Models\Topic $topic */
/** @var \App\Models\Post[] $posts */

// Neprihlaseneho posielaju tlacidla Odpovedat, Dakujem a Sledovat na Login
$replyUrl = $user->isLoggedIn() ? '#odpoved' : App\Configuration::LOGIN_URL;
$actionUrl = $user->isLoggedIn() ? '#' : App\Configuration::LOGIN_URL;

// Upravit a zmazat temu moze jej autor alebo admin (rovnaka kontrola je aj v TopicController::authorize).
// Roly zatial nemame, admin je testovaci ucet s menom Admin.
$canManage = $user->isLoggedIn() && ($user->getName() == 'Admin' || $user->getName() == $topic->getAuthor());
?>
<!-- Detail temy - tema aj jej odpovede su z DB.
     Generovane s pomocou AI (Claude) a upravene. -->

<!-- Omrvinkova navigacia -->
<nav class="breadcrumb">
    <a href="<?= $link->url('forum.index') ?>">Fórum</a> /
    <a href="<?= $link->url('forum.index') ?>">Voľná debata</a> /
    <span><?= e($topic->getTitle()) ?></span>
</nav>

<!-- Tlacidla k teme a strankovanie -->
<div class="topics-toolbar">
    <div class="topic-buttons">
        <a href="<?= $replyUrl ?>" class="btn btn-primary">Odpovedať</a>
        <a href="<?= $actionUrl ?>" class="btn">Sledovať tému</a>
    </div>
    <!-- Stranka je zatial len jedna -->
    <nav class="pagination topic-pagination">
        <a href="#" class="active">1</a>
    </nav>
</div>

<!-- Tema: nazov a uvodny prispevok autora su jeden blok -->
<article class="card section-box post-first" id="prispevok-1">
    <div class="category-header topic-title">
        <!-- Moderator menu by bolo tu napravo, ale je skryte (role zatial nemame) -->
        <h1><?= e($topic->getTitle()) ?></h1>
        <p class="category-meta">Odpovede: <?= count($posts) ?> · 214 zobrazení</p>
    </div>

    <div class="post">
        <div class="post-author">
            <img src="<?= $link->asset('images/logo.svg') ?>" alt="Profilová fotka – <?= e($topic->getAuthor()) ?>" width="64" height="64" class="avatar">
            <div>
                <h2><a href="<?= $link->url('profile.index') ?>"><?= e($topic->getAuthor()) ?></a></h2>
                <span class="badge">Autor témy</span>
            </div>
        </div>
        <div class="post-body">
            <div class="post-head">
                <time datetime="<?= date('Y-m-d\TH:i', strtotime($topic->getCreatedAt())) ?>"><?= date('j. n. Y, G:i', strtotime($topic->getCreatedAt())) ?></time>
                <a href="#prispevok-1">#1</a>
            </div>
            <!-- nl2br zmeni konce riadkov z formulara na <br> -->
            <p><?= nl2br(e($topic->getText())) ?></p>
            <div class="post-foot">
                <div class="post-actions">
                    <a href="<?= $actionUrl ?>" class="btn">Ďakujem</a>
                    <a href="<?= $replyUrl ?>" class="btn">Odpovedať</a>
                    <!-- Menu ⋯ - details/summary sa otvori a zatvori klikom na ⋯.
                         Rovnake menu (bez Upravit a Zmazat) je aj pri odpovediach. Pridane s pomocou AI (Claude). -->
                    <details class="post-menu">
                        <summary class="btn" aria-label="Ďalšie možnosti">⋯</summary>
                        <ul class="post-menu-list">
                            <li><a href="<?= $replyUrl ?>">Citovať</a></li>
                            <li><a href="#prispevok-1">Odkaz na príspevok</a></li>
                            <li><a href="<?= $actionUrl ?>">Nahlásiť</a></li>
                            <!-- Upravit a zmazat temu moze jej autor alebo admin.
                                 confirm() sa pred zmazanim opyta, ci to pouzivatel naozaj chce - Zrusit odkaz zastavi. -->
                            <?php if ($canManage) { ?>
                                <li><a href="<?= $link->url('topic.edit', ['id' => $topic->getId()]) ?>">Upraviť</a></li>
                                <li><a href="<?= $link->url('topic.delete', ['id' => $topic->getId()]) ?>"
                                       onclick="return confirm('Naozaj chcete zmazať túto tému?')">Zmazať</a></li>
                            <?php } ?>
                        </ul>
                    </details>
                </div>
            </div>
        </div>
    </div>
</article>

<!-- Zoznam odpovedi - pruh s nazvami stlpcov a pod nim kazda odpoved ako samostatny box -->
<div class="posts-list">
    <div class="section-title posts-head">
        <span class="posts-head-author">Autor</span>
        <span>Príspevok</span>
        <button type="button" class="btn">Zoradiť podľa</button>
    </div>

    <!-- Odpovede z DB. Cislo #2, #3, ... je poradie odpovede v teme (#1 je uvodny prispevok). -->
    <?php if (count($posts) == 0) { ?>
        <div class="post">
            <div class="post-body">
                <p class="muted">Zatiaľ tu nie sú žiadne odpovede.</p>
            </div>
        </div>
    <?php } ?>
    <?php $number = 1; ?>
    <?php foreach ($posts as $post) { ?>
        <?php $number++; ?>
        <article class="post" id="odpoved-<?= $post->getId() ?>">
            <div class="post-author">
                <img src="<?= $link->asset('images/logo.svg') ?>" alt="Profilová fotka – <?= e($post->getAuthor()) ?>" width="64" height="64" class="avatar">
                <div>
                    <h2><a href="<?= $link->url('profile.index') ?>"><?= e($post->getAuthor()) ?></a></h2>
                    <?php if ($post->getAuthor() == $topic->getAuthor()) { ?>
                        <span class="badge">Autor témy</span>
                    <?php } ?>
                </div>
            </div>
            <div class="post-body">
                <div class="post-head">
                    <time datetime="<?= date('Y-m-d\TH:i', strtotime($post->getCreatedAt())) ?>"><?= date('j. n. Y, G:i', strtotime($post->getCreatedAt())) ?></time>
                    <a href="#odpoved-<?= $post->getId() ?>">#<?= $number ?></a>
                </div>
                <p><?= nl2br(e($post->getText())) ?></p>
                <div class="post-foot">
                    <div class="post-actions">
                        <a href="<?= $actionUrl ?>" class="btn">Ďakujem</a>
                        <a href="<?= $replyUrl ?>" class="btn">Odpovedať</a>
                        <details class="post-menu">
                            <summary class="btn" aria-label="Ďalšie možnosti">⋯</summary>
                            <ul class="post-menu-list">
                                <li><a href="<?= $replyUrl ?>">Citovať</a></li>
                                <li><a href="#odpoved-<?= $post->getId() ?>">Odkaz na príspevok</a></li>
                                <li><a href="<?= $actionUrl ?>">Nahlásiť</a></li>
                            </ul>
                        </details>
                    </div>
                </div>
            </div>
        </article>
    <?php } ?>
</div>

<!-- Rovnake tlacidla aj pod zoznamom, aby sa po docitani nemuselo rolovat hore -->
<div class="topics-toolbar">
    <div class="topic-buttons">
        <a href="<?= $replyUrl ?>" class="btn btn-primary">Odpovedať</a>
        <a href="<?= $actionUrl ?>" class="btn">Sledovať tému</a>
    </div>
    <div class="sort">
        <span class="muted">Príspevkov v téme: <?= count($posts) + 1 ?></span>
        <nav class="pagination topic-pagination">
            <a href="#" class="active">1</a>
        </nav>
    </div>
</div>

<!-- Formular na odpoved vidia len prihlaseni. Zatial je len vizualny, odosielanie pribudne s databazou. -->
<?php if ($user->isLoggedIn()) { ?>
    <section class="card reply-form" id="odpoved">
        <h2>Napísať odpoveď</h2>
        <form>
            <label for="reply-text">Text odpovede</label>
            <textarea id="reply-text" rows="5"></textarea>
            <button type="button" class="btn btn-primary">Odoslať odpoveď</button>
        </form>
    </section>
<?php } ?>

<!-- Podobne temy z tej istej sekcie - tabulka ako vo vypise fora -->
<section class="card section-box">
    <h2 class="section-title">Podobné témy</h2>
    <div class="section-body">
        <table class="forum-table">
            <thead>
            <tr>
                <th>Téma</th>
                <th class="count">Odpovede</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><a href="<?= $link->url('forum.topic', ['id' => 2]) ?>">Som zlý človek, ak nemám rád včely?</a></td>
                <td class="count"><span class="badge">12</span></td>
            </tr>
            <tr>
                <td><a href="<?= $link->url('forum.topic', ['id' => 3]) ?>">Odporučíte spoľahlivý medomet?</a></td>
                <td class="count"><span class="badge">0</span></td>
            </tr>
            <tr>
                <td><a href="<?= $link->url('forum.topic', ['id' => 4]) ?>">Najlepšie miesto na úľ v záhrade</a></td>
                <td class="count"><span class="badge">7</span></td>
            </tr>
            </tbody>
        </table>
    </div>
</section>

<!-- Spodna info lista - rovnaka ako na stranke fora, navyse pocet ludi v teme -->
<div class="info-bar">
    <span>Aktuálne je prihlásených: 26 užívateľov · Tému si práve prezerajú: 3</span>
    <span>Meniny má dnes: Adrián</span>
</div>

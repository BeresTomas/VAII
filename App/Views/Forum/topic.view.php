<?php

/** @var \Framework\Support\LinkGenerator $link */
/** @var \Framework\Auth\AppUser $user */
/** @var \App\Models\Topic $topic */

// Neprihlaseneho posielaju tlacidla Odpovedat, Dakujem a Sledovat na Login
$replyUrl = $user->isLoggedIn() ? '#odpoved' : App\Configuration::LOGIN_URL;
$actionUrl = $user->isLoggedIn() ? '#' : App\Configuration::LOGIN_URL;
?>
<!-- Detail temy - nazov, datum a text uvodneho prispevku su z DB, odpovede su zatial staticke.
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
        <p class="category-meta">3 odpovede · 214 zobrazení</p>
    </div>

    <div class="post">
        <div class="post-author">
            <img src="<?= $link->asset('images/logo.svg') ?>" alt="Profilová fotka – Jožo" width="64" height="64" class="avatar">
            <div>
                <h2><a href="<?= $link->url('profile.index') ?>">Jožo</a></h2>
                <span class="badge">Autor témy</span>
                <span class="badge">Moderátor</span>
                <p class="muted">Skúsený včelár · 340 príspevkov</p>
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
                <span class="muted">Ďakujú: Anka, Fero a 3 ďalší</span>
                <div class="post-actions">
                    <a href="<?= $actionUrl ?>" class="btn">Ďakujem (5)</a>
                    <a href="<?= $replyUrl ?>" class="btn">Odpovedať</a>
                    <!-- Upravit temu moze len prihlaseny (role zatial nemame). Pridane s pomocou AI (Claude). -->
                    <?php if ($user->isLoggedIn()) { ?>
                        <a href="<?= $link->url('topic.edit', ['id' => $topic->getId()]) ?>" class="btn">Upraviť</a>
                    <?php } ?>
                    <button type="button" class="btn" aria-label="Ďalšie možnosti">⋯</button>
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

    <article class="post" id="prispevok-2">
        <div class="post-author">
            <img src="<?= $link->asset('images/logo.svg') ?>" alt="Profilová fotka – Fero" width="64" height="64" class="avatar">
            <div>
                <h2><a href="<?= $link->url('profile.index') ?>">Fero</a></h2>
                <p class="muted">Začínajúci včelár · 28 príspevkov</p>
            </div>
        </div>
        <div class="post-body">
            <div class="post-head">
                <time datetime="2026-10-20T20:15">20. 10. 2026, 20:15</time>
                <a href="#prispevok-2">#2</a>
            </div>
            <p>Ja soľ nedávam, kŕmim len čistým sirupom a včelám nič nechýba.</p>
            <div class="post-foot">
                <span class="muted">Ďakuje: Jožo</span>
                <div class="post-actions">
                    <a href="<?= $actionUrl ?>" class="btn">Ďakujem (1)</a>
                    <a href="<?= $replyUrl ?>" class="btn">Odpovedať</a>
                    <button type="button" class="btn" aria-label="Ďalšie možnosti">⋯</button>
                </div>
            </div>
        </div>
    </article>

    <article class="post" id="prispevok-3">
        <div class="post-author">
            <img src="<?= $link->asset('images/logo.svg') ?>" alt="Profilová fotka – Jožo" width="64" height="64" class="avatar">
            <div>
                <h2><a href="<?= $link->url('profile.index') ?>">Jožo</a></h2>
                <span class="badge">Autor témy</span>
                <span class="badge">Moderátor</span>
                <p class="muted">Skúsený včelár · 340 príspevkov</p>
            </div>
        </div>
        <div class="post-body">
            <div class="post-head">
                <time datetime="2026-10-21T09:30">21. 10. 2026, 9:30</time>
                <a href="#prispevok-3">#3</a>
            </div>
            <p>Dnes ráno som skúsil prvú várku, takto vyzerá kŕmidlo aj sirup.</p>
            <!-- Prilozene fotky - zatial sive stvorce, rovnako ako na uvodnej stranke -->
            <div class="gallery-mini">
                <span class="photo"></span>
                <span class="photo"></span>
            </div>
            <div class="post-foot">
                <span class="muted">Ďakuje: Anka</span>
                <div class="post-actions">
                    <a href="<?= $actionUrl ?>" class="btn">Ďakujem (1)</a>
                    <a href="<?= $replyUrl ?>" class="btn">Odpovedať</a>
                    <button type="button" class="btn" aria-label="Ďalšie možnosti">⋯</button>
                </div>
            </div>
        </div>
    </article>

    <article class="post" id="prispevok-4">
        <div class="post-author">
            <!-- Anka nema profilovu fotku - namiesto nej je prve pismeno mena -->
            <span class="avatar-letter">A</span>
            <div>
                <h2><a href="<?= $link->url('profile.index') ?>">Anka</a></h2>
                <p class="muted">Včelárka · 112 príspevkov</p>
            </div>
        </div>
        <div class="post-body">
            <div class="post-head">
                <time datetime="2026-10-21T17:05">21. 10. 2026, 17:05</time>
                <a href="#prispevok-4">#4</a>
            </div>
            <blockquote class="post-quote">
                <strong>Jožo napísal:</strong>
                Koľko soli dávate na liter sirupu?
            </blockquote>
            <p>Ja dávam naozaj len štipku na päť litrov. Viac by som nedávala, včelám to škodí.</p>
            <div class="post-foot">
                <span class="muted">Ďakujú: Jožo, Fero</span>
                <div class="post-actions">
                    <a href="<?= $actionUrl ?>" class="btn">Ďakujem (2)</a>
                    <a href="<?= $replyUrl ?>" class="btn">Odpovedať</a>
                    <button type="button" class="btn" aria-label="Ďalšie možnosti">⋯</button>
                </div>
            </div>
        </div>
    </article>
</div>

<!-- Rovnake tlacidla aj pod zoznamom, aby sa po docitani nemuselo rolovat hore -->
<div class="topics-toolbar">
    <div class="topic-buttons">
        <a href="<?= $replyUrl ?>" class="btn btn-primary">Odpovedať</a>
        <a href="<?= $actionUrl ?>" class="btn">Sledovať tému</a>
    </div>
    <div class="sort">
        <span class="muted">Zobrazené príspevky 1–4 zo 4</span>
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

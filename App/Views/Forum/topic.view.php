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

<!-- Zoznam prispevkov -->
<div class="card section-box">
    <div class="section-title posts-head">
        <span class="posts-head-author">Autor</span>
        <span>Príspevok</span>
        <button type="button" class="btn">Zoradiť podľa</button>
    </div>

    <!-- Prvy prispevok od autora temy je jemne zvyrazneny -->
    <article class="post post-first" id="prispevok-1">
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
                <time datetime="2026-10-20T18:42">20. 10. 2026, 18:42</time>
                <a href="#prispevok-1">#1</a>
            </div>
            <p>
                Čítal som, že štipka soli v cukrovom sirupe prospieva včelám, lebo im dodá minerály.
                Skúšal to už niekto z vás? Koľko soli dávate na liter sirupu a pozorovali ste nejaký rozdiel?
            </p>
            <div class="post-foot">
                <span class="muted">Ďakujú: Anka, Fero a 3 ďalší</span>
                <div class="post-actions">
                    <a href="<?= $actionUrl ?>" class="btn">Ďakujem (5)</a>
                    <a href="<?= $replyUrl ?>" class="btn">Odpovedať</a>
                    <button type="button" class="btn" aria-label="Ďalšie možnosti">⋯</button>
                </div>
            </div>
        </div>
    </article>

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

<!-- Pocet prispevkov a strankovanie pod zoznamom -->
<div class="topics-toolbar">
    <span class="muted">Zobrazené príspevky 1–4 zo 4</span>
    <nav class="pagination topic-pagination">
        <a href="#" class="active">1</a>
    </nav>
</div>

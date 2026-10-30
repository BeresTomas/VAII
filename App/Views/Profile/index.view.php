<?php

/** @var \Framework\Support\LinkGenerator $link */
/** @var \Framework\Auth\AppUser $user */
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

<!-- Dvojstlpcove rozlozenie: vlavo bocny panel, vpravo hlavny obsah -->
<div class="layout">

    <!-- Lavy stlpec: informacie o pouzivatelovi -->
    <aside class="sidebar">
        <section class="card section-box">
            <h2 class="section-title">O mne</h2>
            <div class="section-body">
                <p class="profile-bio">
                    Včelárim od roku 2009, začínal som s dvomi úľmi po starom otcovi.
                    Najradšej riešim chov matiek a jarný rozvoj včelstiev.
                </p>
                <!-- Zoznam udajov "popis: hodnota" - kazda dvojica je v div, aby bola na jednom riadku -->
                <dl class="profile-details">
                    <div><dt>Lokalita</dt><dd>Liptovský Mikuláš</dd></div>
                    <div><dt>Prax</dt><dd>17 rokov</dd></div>
                    <div><dt>Počet včelstiev</dt><dd>24</dd></div>
                    <div><dt>Typ úľov</dt><dd>Langstroth</dd></div>
                    <div><dt>Plemeno včiel</dt><dd>Kranská včela</dd></div>
                    <div><dt>Organizácia</dt><dd>SZV, ZO Liptovský Mikuláš</dd></div>
                </dl>
            </div>
        </section>

        <section class="card section-box">
            <h2 class="section-title">Kontakt</h2>
            <div class="section-body">
                <!-- Kontakt vidia len prihlaseni pouzivatelia (rovnaky if ako v layoute Vaiicka) -->
                <?php if ($user->isLoggedIn()) { ?>
                    <dl class="profile-details">
                        <div><dt>E-mail</dt><dd><a href="mailto:jozo@example.com">jozo@example.com</a></dd></div>
                        <div><dt>Telefón</dt><dd>+421 900 123 456</dd></div>
                        <div><dt>Web</dt><dd><a href="#">Včelárstvo Jožo</a></dd></div>
                        <div><dt>Predaj medu</dt><dd>áno</dd></div>
                    </dl>
                <?php } else { ?>
                    <p class="muted profile-note">Kontaktné údaje vidia len prihlásení používatelia.</p>
                <?php } ?>
            </div>
        </section>

        <section class="card section-box">
            <h2 class="section-title">Najaktívnejší v</h2>
            <div class="section-body">
                <ul class="profile-active">
                    <li><a href="#">Tipy a triky</a> <span class="badge">128</span></li>
                    <li><a href="<?= $link->url('forum.index') ?>">Voľná debata</a> <span class="badge">96</span></li>
                    <li><a href="#">Choroby včiel</a> <span class="badge">54</span></li>
                </ul>
            </div>
        </section>
    </aside>

    <!-- Pravy stlpec: zalozky a aktivita pouzivatela -->
    <div class="content">
        <!-- Zalozky - zatial len vizualne, aktivna je Aktivita (prepinanie by potrebovalo JS) -->
        <div class="profile-toolbar">
            <nav class="profile-tabs">
                <a href="#" class="active">Aktivita</a>
                <a href="#">Témy (12)</a>
                <a href="#">Príspevky (340)</a>
                <a href="#">Galéria (18)</a>
            </nav>
            <button type="button" class="btn">Zoradiť podľa</button>
        </div>

        <!-- Casova os aktivity - kazda polozka je samostatna karta -->
        <article class="card activity-item">
            <div class="activity-head">
                <span>Založil tému vo <a href="<?= $link->url('forum.index') ?>">Voľná debata</a></span>
                <span>Pred 2 dňami</span>
            </div>
            <h3><a href="<?= $link->url('forum.topic') ?>">Primiešavate aj vy štipku soli do sirupu?</a></h3>
            <p class="activity-meta">3 odpovede · 214 zobrazení · 12 „Ďakujem“</p>
        </article>

        <article class="card activity-item">
            <div class="activity-head">
                <span>Odpovedal v sekcii <a href="#">Tipy a triky</a></span>
                <span>Pred 3 dňami</span>
            </div>
            <h3><a href="#">Ako pripraviť včelstvá na zimu?</a></h3>
            <p class="activity-excerpt">
                Ja kŕmim do konca augusta a potom už len kontrolujem zásoby. Dôležité je mať
                silné včelstvo a dobre utesnený úľ, aby neťahalo.
            </p>
            <p class="activity-meta">4 „Ďakujem“</p>
        </article>

        <article class="card activity-item">
            <div class="activity-head">
                <span>Pridal fotky do <a href="#">Galérie</a></span>
                <span>Pred týždňom</span>
            </div>
            <h3><a href="#">Jarná prehliadka včelnice</a></h3>
            <!-- Nahlady fotiek - zatial sive stvorce, rovnako ako na uvodnej stranke -->
            <div class="gallery-mini">
                <span class="photo"></span>
                <span class="photo"></span>
                <span class="photo"></span>
                <span class="photo"></span>
            </div>
            <p class="activity-meta">4 fotky · 9 „Ďakujem“</p>
        </article>

        <article class="card activity-item">
            <div class="activity-head">
                <span>Publikoval návod v <a href="#">Pre začiatočníkov</a></span>
                <span>Pred 2 týždňami</span>
            </div>
            <h3><a href="#">Návod: prvá jarná prehliadka krok za krokom</a></h3>
            <p class="activity-excerpt">
                Prvú prehliadku robte za teplého dňa nad 15 °C. Skontrolujte, či má včelstvo
                matku, plod a dostatok zásob.
            </p>
            <p class="activity-meta">18 odpovedí · 1 024 zobrazení · 47 „Ďakujem“</p>
        </article>

        <!-- Strankovanie - rovnake ako vo vypise fora -->
        <nav class="pagination profile-pagination">
            <a href="#" class="active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
        </nav>

        <!-- Posledne fotky pouzivatela z galerie -->
        <section class="card section-box">
            <h2 class="section-title profile-gallery-title">
                Z galérie
                <a href="#">Zobraziť všetky (18)</a>
            </h2>
            <div class="section-body">
                <!-- Nahlady - zatial sive stvorce namiesto fotiek -->
                <div class="profile-gallery">
                    <span class="photo"></span>
                    <span class="photo"></span>
                    <span class="photo"></span>
                    <span class="photo"></span>
                    <span class="photo"></span>
                    <span class="photo"></span>
                </div>
            </div>
        </section>
    </div>

</div>

<!-- Spodna info lista - rovnaka ako na stranke fora -->
<div class="info-bar">
    <span>Aktuálne je prihlásených: 26 užívateľov</span>
    <span>Meniny má dnes: Adrián</span>
</div>

<?php

/** @var \Framework\Support\LinkGenerator $link */
?>
<!-- Uvodna stranka - obsah prevzaty z html/index.html (Uloha 4, generovane s pomocou AI a upravene). -->

<!-- Hero / privitanie -->
<section class="hero">
    <h1>ApiForum</h1>
    <p>Diskusné fórum pre každého včelára.</p>
</section>

<!-- Dvojstlpcove rozlozenie: obsah + bocny panel -->
<div class="layout">

    <!-- Lavy stlpec: hlavny obsah -->
    <div class="content">
        <article class="card">
            <h2>Vitajte v komunite</h2>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent
                commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed
                odio dui. Vivamus sagittis lacus vel augue laoreet rutrum faucibus.
            </p>
        </article>

        <div class="block-row">
            <article class="card">
                <h3><a href="#">Pre začiatočníkov</a></h3>
                <p>Nulla vitae elit libero, a pharetra augue. Morbi leo risus.</p>
            </article>
            <article class="card">
                <h3><a href="#">Choroby včiel</a></h3>
                <p>Cras mattis consectetur purus sit amet fermentum. Aenean lacinia.</p>
            </article>
        </div>

        <!-- Trending temy -->
        <section class="card">
            <h2>Trending Témy</h2>
            <ul class="topic-list">
                <li><a href="<?= $link->url('forum.index') ?>">Primiešavate aj vy štipku soli do sirupu?</a></li>
                <li><a href="<?= $link->url('forum.index') ?>">Som zlý človek, ak nemám rád včely?</a></li>
                <li><a href="<?= $link->url('forum.index') ?>">Najlepšie miesto na úľ v záhrade</a></li>
            </ul>
        </section>
    </div>

    <!-- Pravy stlpec: bocny panel -->
    <aside class="sidebar">
        <section class="card">
            <h3>Vyhľadávanie</h3>
            <form class="search-form">
                <input type="search" placeholder="Hľadať vo fóre...">
                <button type="submit">Hľadať</button>
            </form>
        </section>

        <section class="card">
            <h3>Najnovšie oznamy</h3>
            <ul class="notice-list">
                <li>Letná sezóna sa blíži – pripravte úle</li>
                <li>Nové tlačivá na stiahnutie v sekcii Viac</li>
            </ul>
        </section>

        <section class="card">
            <h3><a href="#">Galéria</a></h3>
            <div class="gallery-mini">
                <span class="photo"></span>
                <span class="photo"></span>
                <span class="photo"></span>
                <span class="photo"></span>
                <span class="photo"></span>
                <span class="photo"></span>
            </div>
        </section>
    </aside>

</div>

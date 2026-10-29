<?php

/** @var string $contentHTML */
/** @var \Framework\Auth\AppUser $user */
/** @var \Framework\Support\LinkGenerator $link */
?>
<!DOCTYPE html>
<!-- ApiForum - spolocne rozlozenie (hlavicka, navigacia, paticka). VAII, 5. tyzden. -->
<!-- Prevzate z html/index.html, ktore bolo generovane s pomocou AI (Claude) a upravene. -->
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= App\Configuration::APP_NAME ?> – Diskusné fórum pre včelárov</title>
    <link rel="icon" type="image/svg+xml" href="<?= $link->asset('images/logo.svg') ?>">
    <link rel="stylesheet" href="<?= $link->asset('css/style.css') ?>">
</head>
<body>

<!-- Hlavicka s logom a navigaciou -->
<header class="site-header">
    <div class="container header-inner">
        <a class="logo" href="<?= $link->url('home.index') ?>">
            <img src="<?= $link->asset('images/logo.svg') ?>" alt="Logo ApiForum" width="40" height="40">
            <span class="logo-text">ApiForum</span>
        </a>
        <nav class="main-nav">
            <ul>
                <li><a href="<?= $link->url('forum.index') ?>">Fórum</a></li>
                <li><a href="#">Oznamy</a></li>
                <li><a href="#">Galéria</a></li>
                <li><a href="#">Viac</a></li>
                <li><a href="<?= App\Configuration::LOGIN_URL ?>" class="nav-login">Login</a></li>
            </ul>
        </nav>
    </div>
</header>

<!-- Hlavny obsah stranky - sem framework vlozi vystup pohladu -->
<main class="container">
    <?= $contentHTML ?>
</main>

<!-- Paticka -->
<footer class="site-footer">
    <div class="container footer-inner">
        <ul class="footer-links">
            <li><a href="#">Podmienky používania</a></li>
            <li><a href="#">Ochrana osobných údajov</a></li>
            <li><a href="<?= $link->url('home.contact') ?>">Kontakty</a></li>
        </ul>
        <p class="copyright">© <?= date('Y') ?> ApiForum</p>
    </div>
</footer>

</body>
</html>

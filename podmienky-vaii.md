# Podmienky pre odovzdanie semestrálnej práce z predmetu VAII (2026/27)

Zhustený prehľad podstatných požiadaviek. Semestrálna práca musí byť **dynamická webová
aplikácia so serverovou časťou**.

## Hodnotenie

**Semestrálna práca (50 bodov)** sa hodnotí podľa:
- správne použitie git (postupný progres počas celého semestra)
- kvalita DB návrhu a architektúry aplikácie, programovací štýl
- kontrola všetkých vstupov na strane servera aj klienta
- zabezpečenie aplikácie
- 2x zmysluplné použitie AJAX
- viacero rolí + autorizácia
- práca so súbormi (upload, manažment)
- zložitosť, množstvo funkcií, celkový dojem

**Extra body (5) za nadštandard:** prepracovaný dizajn, JS framework (React, Vue…),
vlastné riešenie responzivity, less/sass/pokročilé CSS, externé API, HTML5 API,
pokročilá klientska kontrola formulárov.

## Povinné požiadavky (bez nich nemožno prácu obhajovať)

- serverová časť v **PHP** s frameworkom **VAJKO** (https://github.com/thevajko/vaiicko)
- aplikačná logika oddelená od prezentačnej vrstvy (**MVC** / OOP)
- min. **5 dynamických stránok**
- min. **50 vlastných riadkov** JavaScriptu (zmysluplne použitých)
- min. **20 vlastných CSS pravidiel** (mimo Bootstrap a pod.)
- min. **3 zmysluplné DB entity**, všetky použité (tabuľka `users` sa **nezapočítava**)
- aspoň jeden **1:N alebo M:N** vzťah medzi entitami
- **všetky CRUD** operácie (čítanie, vytváranie, úprava, mazanie) nad **dvomi** entitami
- časť aplikácie prístupná až **po prihlásení** (prihlasovací formulár)
- spustiteľnosť v **Dockeri**; pri prvom spustení import ukážkových dát

> Prevzaté a len mierne upravené časti (z cvičení, zbierky úloh) a frameworkom
> vygenerované entity/stránky/CSS/kód sa do povinných počtov **nerátajú**.

## Bezpečnosť

- kontrola vstupov na **dátový typ aj platnú hodnotu**, na serveri aj klientovi
- ošetrenie DB dopytov voči **SQL Injection**
- **heslá** nikdy neukladať ako obyčajný text
- pri SPA musia byť endpointy zabezpečené voči neautorizovanému prístupu

## AJAX (min. 2 z nasledujúceho)

odosielanie formulárov · in-place editovanie v tabuľke · prihlasovanie ·
filtrovanie záznamov · načítavanie obsahu tabuľky · stránkovanie ·
iné netriviálne volania.

## Databáza

- min. **3 entity** (asociačná tabuľka M:N, `users` a vygenerované tabuľky sa nerátajú)
- dodržaná **normalizácia** — žiadne duplicity ani tabuľky „do počtu"
  (role sa riešia stĺpcom v `users`, nie samostatnou tabuľkou per rola)
- aplikácia vykonáva nad DB vkladanie, čítanie, úpravu aj mazanie; využíva **všetky** entity

## Klient (GUI)

- min. **5 rôznych podstránok** s dynamickým obsahom
- **responzívny dizajn** prispôsobený rozlíšeniu displeja
- min. **20 CSS pravidiel**, vlastný skript min. **50 riadkov**
- pokročilá správa dát (nie napr. mazanie zadaním ID ručne)

## Proces a obhajoba

- AI nástroje možno používať bez obmedzenia, ale **AI-generované časti musia byť označené**
  a práci treba **dokonale rozumieť**
- zdrojové kódy dostupné cez **verejný GIT repozitár** počas celého semestra,
  s viditeľným **postupným progresom**
- prevzatý cudzí kód treba **okomentovať zdrojom**

# ApiForum

Tomáš Béreš

5ZYI31

## Stručný opis projektu
Projekt bude webová appka určená včelárom Slovenska / Česka, ktorá bude slúžiť ako fórum. Prihlásení používatelia budú môcť zakladať témy/topiky, odpisovať na topiky iných, čítať oznamy, reagovať na ne.
Bude predstavovať spoločné miesto, kde si budú online vymieňať názory, vedomosti, skúsenosti a plány na včelársku sezónu. 

## Role v projekte
- **Neprihlásený používateľ** - si môže prezerať verejnú časť fóra, nemôže však nič pridávať ani komunikovať s ostatnými.
- **Prihlásený používateľ** - už môže zakladať nové témy, pridávať príspevky, nahrávať fotografie do galérie a spravovať svoj profil. Toto by malo byť gro používateľov.
- **Moderátor** - zodpovedá za obsah vo fóre, môže editovať a mazať cudzie príspevky a témy, uzamykať témy a odstraňovať nevhodné fotografie z galérie. Budú mať spoločné skryté topiky, do ktorých vidia len privilegovaní.
- **Administrátor** - má najvyššie oprávnenia, spravuje používateľské kontá a role, vytvára a upravuje kategórie fóra a pridáva oznámenia pre celú komunitu, rieši technické problémy a zodpovedá za beh stránky.

## Prípady použitia podľa rolí
**Neprihlásený používateľ**
- prehliada si verejné kategórie, témy a príspevky vo fóre
- prezerá si galériu fotografií, oznámenia a kontakty
- zaregistruje sa, resp. sa prihlási do existujúceho konta

**Prihlásený používateľ**
- založí novú tému v rámci kategórie
- pridá príspevok do existujúcej témy
- upraví alebo zmaže svoj vlastný príspevok
- nahrá fotografiu do galérie
- upraví si svoj profil vrátane profilovej fotografie

**Moderátor**
- upraví alebo zmaže ľubovoľný príspevok, resp. tému
- uzamkne tému, do ktorej už nie je možné pridávať príspevky
- odstráni nevhodnú fotografiu z galérie
- rieši hlásenia na nevhodné príspevky od používateľov
- aktívne kontroluje obsah fóra

**Administrátor**
- spravuje používateľské kontá a prideľuje im role
- povyšuje aktívnych používateľov na moderátorov
- vytvára, upravuje a maže kategórie fóra vrátane ich zanorenia
- pridáva, upravuje a maže oznámenia pre celú komunitu
- rieši konflikty medzi moderátormi a spravuje technickú stránku fóra

## Plánované entity
- **Používateľ** – reprezentuje registrovaného návštevníka. Obsahuje prihlasovacie meno, e-mail, zahashované heslo, zobrazované meno, profilovú fotografiu a priradenú rolu (ako hodnotu atribútu, nie samostatnú entitu).
- **Kategória** – zoskupuje príbuzné témy fóra do logických celkov (Choroby včiel, Všeobecná diskusia, Žiadosti, Sťažnosti, Tlačivá...). Obsahuje názov, stručný popis a referenciu na nadradenú kategóriu (môže byť prázdna, ak ide o hlavnú kategóriu)
- **Téma** – reprezentuje samostatné vlákno v rámci kategórie. Obsahuje názov, dátum založenia, príznak uzamknutia, autora...
- **Príspevok** – jednotlivá správa pridaná v rámci témy. Obsahuje text, dátum pridania a referenciu na autora a tému.
- **Fotografia** – obrázok nahraný do galérie. Obsahuje názov , popis, dátum pridania a referenciu na autora.
- **Oznámenie** – príspevok od administrátora určený pre celú komunitu. Obsahuje nadpis, text, dátum zverejnenia a referenciu na autora.

## Vzťahy medzi entitami
- **Kategória – Kategória** (1:N, self-reference) – kategória môže obsahovať viacero podkategórií, každá podkategória má práve jednu nadradenú kategóriu (alebo žiadnu, ak je na najvyššej úrovni).
- **Kategória – Téma** (1:N) – kategória obsahuje viacero tém, každá téma patrí práve do jednej kategórie.
- **Téma – Príspevok** (1:N) – téma obsahuje viacero príspevkov, každý príspevok patrí práve jednej téme.
- **Používateľ – Téma** (1:N) – používateľ je autorom viacerých tém, každá téma má práve jedného autora.
- **Používateľ – Príspevok** (1:N) – používateľ je autorom viacerých príspevkov, každý príspevok patrí práve jednému autorovi.
- **Používateľ – Fotografia** (1:N) – používateľ môže nahrať viacero fotografií, každá fotografia má práve jedného autora.
- **Používateľ – Oznámenie** (1:N) – administrátor môže vytvoriť viacero oznámení, každé oznámenie má práve jedného autora.

## Hlavné stránky aplikácie
- **Úvodná stránka** – privítanie, prehľad najnovších oznámení a najaktívnejších tém.
- **Prehľad fóra** – zoznam hlavných kategórií s možnosťou prekliknúť sa do ich obsahu.
- **Obsah kategórie** – zobrazenie podkategórií a tém patriacich do zvolenej kategórie, s možnosťou založiť novú tému.
- **Detail témy** – zobrazenie konkrétnej témy spolu so všetkými príspevkami a formulárom na pridanie reakcie.
- **Prihlásenie a registrácia** – stránky na vytvorenie konta a prihlásenie existujúceho používateľa.
- **Profil používateľa** – zobrazenie a úprava informácií o používateľovi vrátane profilovej fotografie.
- **Galéria** – prehľad nahraných fotografií s možnosťou pridať novú a zobraziť detail.
- **Oznámenia** – zoznam oznámení od administrátorov zoradený od najnovších.
- **Kontakty** – statická stránka s kontaktnými údajmi.
- **Admin sekcia** – rozhranie pre správu používateľov, kategórií (vrátane ich zanorenia a typu) a oznámení.

## Rozdelenie funkcionality
**Základné funkcie**
- registrácia a prihlasovanie používateľov so zabezpečeným ukladaním hesiel
- správa používateľského profilu vrátane nahratia profilovej fotografie
- systém rolí a autorizácia prístupu k jednotlivým častiam aplikácie
- hierarchická štruktúra fóra s možnosťou zanárať kategórie do seba
- rôzne typy kategórií určujúce, kto v nich môže zakladať témy
- plné CRUD operácie nad témami a príspevkami
- galéria s možnosťou nahrávania a mazania vlastných fotografií
- oznámenia pre celú komunitu spravované administrátorom
- administračná sekcia
- moderátorské nástroje na úpravu a mazanie cudzieho obsahu, uzamykanie tém
- statická stránka s kontaktmi
- validácia používateľských vstupov
- asynchrónna komunikácia so serverom (AJAX) pri pridávaní príspevkov a ďalších vybraných akciách (napr. stránkovanie, filtrovanie, úprava profilu)

**Rozširujúce funkcie**
- rozšírený systém rolí (člen zväzu, predseda zväzu, vedenie fóra) so špecifickými oprávneniami
- interaktívna mapa výskytu chorôb a moru včelstiev s možnosťou pridávania hlásení
- živý chat medzi prihlásenými používateľmi
- notifikácie o nových príspevkoch v sledovaných témach
- vyhľadávanie v témach a príspevkoch
- komentáre a hodnotenie fotografií v galérii
- pokročilé moderátorské nástroje (presúvanie tém medzi kategóriami, dočasné obmedzenia pre používateľov)
- možnosť pripájať súbory k témam (napr. PDF tlačivá v oznamovacích kategóriách)

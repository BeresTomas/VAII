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
- upraví alebo zmaže príspevok
- uzamkne tému, do ktorej už nie je možné pridávať príspevky
- odstráni nevhodnú fotografiu z galérie
- edituje správy s nevhodným obsahom
- plánuje oznamy
- rieši sťažnosti na moderátorov, aktívne kontroluje fórum

**Administrátor**
- spravuje používateľské kontá a prideľuje im role
- spravuje moderátorov
- má najvyššiu právomoc, rieši konflikty medzi moderátormi
- spravuje technickú stránku fóra
- poriada nábor nových moderátorov

## Plánované entity
- **Používateľ** – reprezentuje registrovaného návštevníka. Obsahuje prihlasovacie meno, e-mail, zahashované heslo, zobrazované meno, profilovú fotografiu a priradenú rolu (ako hodnotu atribútu, nie samostatnú entitu).
- **Kategória** – zoskupuje príbuzné témy fóra do logických celkov (napr. Choroby včiel, Technika, Všeobecná diskusia). Obsahuje názov a stručný popis.
- **Téma** – reprezentuje samostatné vlákno v rámci kategórie. Obsahuje názov, dátum založenia, príznak uzamknutia a referenciu na autora a kategóriu.
- **Príspevok** – jednotlivá správa pridaná v rámci témy. Obsahuje text, dátum pridania a referenciu na autora a tému.
- **Fotografia** – obrázok nahraný do galérie. Obsahuje názov , popis, dátum pridania a referenciu na autora.
- **Oznámenie** – príspevok od administrátora určený pre celú komunitu. Obsahuje nadpis, text, dátum zverejnenia a referenciu na autora.


Navrhnite hlavné dátové entity aplikácie, ktoré budú reprezentované v databáze, napríklad Používateľ, Produkt, Objednávka alebo Rezervácia. Pri každej entite stručne uveďte jej účel, najdôležitejšie atribúty a základné vzťahy k ostatným entitám.

## Vzťahy medzi entitami
Stručne popíšte najdôležitejšie väzby medzi jednotlivými entitami, napríklad vzťahy 1:1, 1:N alebo M:N. Z opisu by malo byť zrejmé, ako spolu jednotlivé časti dátového modelu súvisia.

## Hlavné stránky aplikácie
Uveďte zoznam najdôležitejších stránok (min. 5) alebo obrazoviek aplikácie a stručne popíšte ich účel. Nie je potrebné pripravovať kompletný grafický návrh, postačuje základná predstava o štruktúre používateľského rozhrania.

## Rozdelenie funkcionality
Rozdeľte plánované funkcie na základné a rozširujúce. Základné funkcie predstavujú minimum potrebné na úspešné dokončenie projektu, zatiaľ čo rozširujúce funkcie môžu byť implementované navyše podľa Vašich časových možností.

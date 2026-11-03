SET NAMES utf8mb4;

DROP TABLE IF EXISTS `topics`;
CREATE TABLE `topics`
(
    `id`        int(11)      NOT NULL AUTO_INCREMENT,
    `title`     varchar(150) NOT NULL,
    `text`      text         NOT NULL,
    `createdAt` datetime     NOT NULL,
    `author`    varchar(100) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

INSERT INTO `topics` (`id`, `title`, `text`, `createdAt`, `author`)
VALUES (1, 'Primiešavate aj vy štipku soli do sirupu?',
        'Čítal som, že štipka soli v cukrovom sirupe prospieva včelám, lebo im dodá minerály. Skúšal to už niekto z vás? Koľko soli dávate na liter sirupu a pozorovali ste nejaký rozdiel?',
        '2026-10-20 18:42:00', 'Jožo'),
       (2, 'Som zlý človek, ak nemám rád včely?',
        'Zdedil som po dedovi tri úle, ale včely mám rád skôr z diaľky. Med je super, práca okolo nich ma však nebaví. Mám to skúsiť, alebo úle radšej predať?',
        '2026-10-15 20:10:00', 'Fero'),
       (3, 'Odporučíte spoľahlivý medomet?',
        'Chystám sa kúpiť nový medomet pre 20 včelstiev. Nerezový, ručný alebo elektrický? Ktorú značku máte overenú a čo by ste už druhýkrát nekúpili?',
        '2026-10-24 09:15:00', 'Anka'),
       (4, 'Najlepšie miesto na úľ v záhrade',
        'Na jar chcem postaviť prvý úľ do záhrady pri dome. Kam ho dať, aby mali včely ranné slnko a susedia neboli v ich letovej dráhe?',
        '2026-10-12 16:30:00', 'Jožo');

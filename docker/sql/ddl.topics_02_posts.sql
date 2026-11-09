SET NAMES utf8mb4;

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts`
(
    `id`        int(11)      NOT NULL AUTO_INCREMENT,
    `text`      text         NOT NULL,
    `createdAt` datetime     NOT NULL,
    `author`    varchar(100) NOT NULL,
    `topic_id`  int(11)      NOT NULL,
    PRIMARY KEY (`id`),
    KEY `posts_topics_id_fk` (`topic_id`),
    CONSTRAINT `posts_topics_id_fk` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

INSERT INTO `posts` (`id`, `text`, `createdAt`, `author`, `topic_id`)
VALUES (1, 'Ja soľ nedávam, kŕmim len čistým sirupom a včelám nič nechýba.',
        '2026-10-20 20:15:00', 'Fero', 1),
       (2, 'Dnes ráno som skúsil prvú várku so štipkou soli, včely ju zobrali bez problémov.',
        '2026-10-21 09:30:00', 'Jožo', 1),
       (3, 'Ja dávam naozaj len štipku na päť litrov. Viac by som nedávala, včelám to škodí.',
        '2026-10-21 17:05:00', 'Anka', 1),
       (4, 'Vôbec nie. Skús najprv chodiť k úľom so skúseným včelárom, možno ťa to chytí.',
        '2026-10-16 08:40:00', 'Jožo', 2),
       (5, 'Ak ťa to nebaví, radšej ich predaj niekomu, kto sa o ne postará. Včelám to len prospeje.',
        '2026-10-17 19:20:00', 'Anka', 2),
       (6, 'Úľ daj čeľusťou na juhovýchod a pred neho vysaď živý plot, včely potom vyletia vyššie nad susedov.',
        '2026-10-13 10:05:00', 'Fero', 4);

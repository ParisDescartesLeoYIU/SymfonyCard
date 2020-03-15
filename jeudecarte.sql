-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 15 mars 2020 à 23:19
-- Version du serveur :  5.7.26
-- Version de PHP :  7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `jeudecarte`
--

-- --------------------------------------------------------

--
-- Structure de la table `card`
--

DROP TABLE IF EXISTS `card`;
CREATE TABLE IF NOT EXISTS `card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `faction_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `health` int(11) DEFAULT NULL,
  `mana` int(11) NOT NULL,
  `atk` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rarity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'bronze',
  PRIMARY KEY (`id`),
  KEY `IDX_161498D34448F8DA` (`faction_id`),
  KEY `IDX_161498D3A76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `card`
--

INSERT INTO `card` (`id`, `faction_id`, `name`, `health`, `mana`, `atk`, `user_id`, `image`, `rarity`) VALUES
(19, 10, 'pusheen', 1, 1, 1, 1, 'card-5e6e80d412cdb.png', 'silver'),
(20, 15, 'Lancelot', 9, 7, 9, 1, 'card-5e6e810e045ea.png', 'gold'),
(21, 1, 'alca', 5, 5, 5, 1, 'card-5e6ea1d2c7eca.jpeg', 'legendary'),
(25, 1, 'carmell', 8, 8, 8, 1, 'card-5e6ea3fc32a51.gif', 'gold');

-- --------------------------------------------------------

--
-- Structure de la table `decks`
--

DROP TABLE IF EXISTS `decks`;
CREATE TABLE IF NOT EXISTS `decks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A3FCC632A76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `decks`
--

INSERT INTO `decks` (`id`, `name`, `user_id`) VALUES
(1, 'test', 1),
(2, 'test', 1),
(3, 'Chicken', 1),
(4, 'd', 1);

-- --------------------------------------------------------

--
-- Structure de la table `deck_cards`
--

DROP TABLE IF EXISTS `deck_cards`;
CREATE TABLE IF NOT EXISTS `deck_cards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `card_id` int(11) DEFAULT NULL,
  `deck_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C59FA2124ACC9A20` (`card_id`),
  KEY `IDX_C59FA212111948DC` (`deck_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `deck_cards`
--

INSERT INTO `deck_cards` (`id`, `card_id`, `deck_id`) VALUES
(1, 20, 1),
(2, 20, 1),
(3, 20, 1),
(4, 20, 1),
(5, 20, 1),
(6, 20, 1),
(7, 21, 4),
(8, 21, 4),
(9, 20, 4),
(10, 20, 4),
(12, 21, 4),
(13, 19, 4);

-- --------------------------------------------------------

--
-- Structure de la table `faction`
--

DROP TABLE IF EXISTS `faction`;
CREATE TABLE IF NOT EXISTS `faction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `faction`
--

INSERT INTO `faction` (`id`, `name`) VALUES
(1, 'Ange'),
(2, 'Dragon'),
(3, 'Poney'),
(9, 'Elf'),
(10, 'nain'),
(15, 'spectre');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20200304102209', '2020-03-04 10:22:35'),
('20200304142810', '2020-03-04 14:28:32'),
('20200304151021', '2020-03-04 15:10:35'),
('20200304152238', '2020-03-04 15:22:46'),
('20200305100630', '2020-03-05 10:06:54'),
('20200306102227', '2020-03-06 10:23:48'),
('20200306142033', '2020-03-06 14:20:41'),
('20200313153646', '2020-03-13 15:42:24'),
('20200313154436', '2020-03-13 15:44:45'),
('20200313154855', '2020-03-13 15:49:40'),
('20200314023822', '2020-03-14 02:38:32'),
('20200314115010', '2020-03-14 11:50:18'),
('20200315170205', '2020-03-15 17:02:29'),
('20200315173840', '2020-03-15 17:38:47');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `name`) VALUES
(1, 'ka@hotmail.fr', '[]', '$argon2id$v=19$m=65536,t=4,p=1$d2hwNEJKemxnNXE5LnZpWg$eQejaOxl3lbptasDykj6MxiCd1qa5bE3UIHfQTlnC2s', 'ka\r\n'),
(2, 'ksa@hotmail.fr', '[]', '$argon2id$v=19$m=65536,t=4,p=1$M05Ddmt6R01wUlpMVi5kRA$6vgr4nKTtlvyGyVqNNI3N/UIQIi5ta30xV3Y25Y4+as', 'ksa');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `card`
--
ALTER TABLE `card`
  ADD CONSTRAINT `FK_161498D34448F8DA` FOREIGN KEY (`faction_id`) REFERENCES `faction` (`id`),
  ADD CONSTRAINT `FK_161498D3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `decks`
--
ALTER TABLE `decks`
  ADD CONSTRAINT `FK_A3FCC632A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `deck_cards`
--
ALTER TABLE `deck_cards`
  ADD CONSTRAINT `FK_C59FA212111948DC` FOREIGN KEY (`deck_id`) REFERENCES `decks` (`id`),
  ADD CONSTRAINT `FK_C59FA2124ACC9A20` FOREIGN KEY (`card_id`) REFERENCES `card` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

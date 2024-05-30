-- phpMyAdmin SQL Dump
-- version 5.1.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 30 mai 2024 à 13:41
-- Version du serveur : 8.0.34-26
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dbfd0l8ogdmk2d`
--

-- --------------------------------------------------------

--
-- Structure de la table `Achats`
--

DROP TABLE IF EXISTS `Achats`;
CREATE TABLE IF NOT EXISTS `Achats` (
  `ach_id` int NOT NULL AUTO_INCREMENT,
  `ach_cat` varchar(20) NOT NULL,
  `ach_prix` decimal(4,2) NOT NULL,
  `ach_cle` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ach_uti_id` int DEFAULT NULL,
  PRIMARY KEY (`ach_id`),
  KEY `fk_ach_uti_id` (`ach_uti_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `Achats`
--

INSERT INTO `Achats` (`ach_id`, `ach_cat`, `ach_prix`, `ach_cle`, `ach_uti_id`) VALUES
(1, 'Solo', '18.00', '$2y$10$uiDF97ElqKUY25U8v/Rdje1xVRl3zO1zQkfhCC9/Mw3rSWv6BFVLa', 3),
(2, 'Familiale', '62.00', '$2y$10$TvQVKbstjKvSGZOTBm5UauijX4GSoUlvSRkSsnEC1WjmVtHQqk80C', 3),
(3, 'Brioche', '20.00', '$2y$10$2ypQ9cREm6GpbgjmoIPLNeklEZ5/pI2lMCH5LsrmLdM81XBPnZ60u', 3),
(4, 'Familiale', '62.00', '$2y$10$fT0NyWhhTjg7y0Eok841P.6YYzBOskydyk5lK7hzvFgntv6hyNvm2', 3),
(5, 'Brioche', '20.00', '$2y$10$3.RTxAltwli80e73IPKzs.8Cacuims8h65pc5H8iGvUhVM5y4jo4O', 3),
(6, 'Solo', '18.00', '$2y$10$0GOd78lfk9/zfV0ow0SEg.s5ghGPeHw5A5I3xmSFWc59.nnPGW9o6', NULL),
(7, 'Duo', '36.00', '$2y$10$lCOJnkZi83s.DbLQR4rvquifGeCZBErW0BBt5eI21B35mUrhpVDsa', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `Admins`
--

DROP TABLE IF EXISTS `Admins`;
CREATE TABLE IF NOT EXISTS `Admins` (
  `ad_id` int NOT NULL AUTO_INCREMENT,
  `ad_nom` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ad_prenom` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ad_email` varchar(23) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ad_mdp` varchar(60) NOT NULL,
  PRIMARY KEY (`ad_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `Admins`
--

INSERT INTO `Admins` (`ad_id`, `ad_nom`, `ad_prenom`, `ad_email`, `ad_mdp`) VALUES
(1, 'AdminTest', 'Le Magnifique', 'admin@gmail.com', '$2a$12$tcYti.0UW2P4d5BBkcjxXupjdE0DZAYFgBc5mxwjLbF8sKdSP9Rqe');

-- --------------------------------------------------------

--
-- Structure de la table `Offres`
--

DROP TABLE IF EXISTS `Offres`;
CREATE TABLE IF NOT EXISTS `Offres` (
  `off_id` int NOT NULL AUTO_INCREMENT,
  `off_cat` varchar(20) NOT NULL,
  `off_prix` decimal(4,2) NOT NULL,
  `off_descrip` varchar(100) NOT NULL,
  PRIMARY KEY (`off_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `Offres`
--

INSERT INTO `Offres` (`off_id`, `off_cat`, `off_prix`, `off_descrip`) VALUES
(1, 'Solo', '18.20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.'),
(2, 'Duo', '36.40', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.'),
(3, 'Familiale', '62.80', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.'),
(6, 'Brioche', '12.00', 'nouvelle brioche');

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateurs`
--

DROP TABLE IF EXISTS `Utilisateurs`;
CREATE TABLE IF NOT EXISTS `Utilisateurs` (
  `uti_id` int NOT NULL AUTO_INCREMENT,
  `uti_nom` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `uti_prenom` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `uti_email` varchar(23) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `uti_mdp` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `uti_cle` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`uti_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `Utilisateurs`
--

INSERT INTO `Utilisateurs` (`uti_id`, `uti_nom`, `uti_prenom`, `uti_email`, `uti_mdp`, `uti_cle`) VALUES
(3, 'Testuti', 'Le Testeur', 'testeurpro@gmail.com', '$2y$10$i50vDSBB1TkuNj0ZtOeWLOPbivclYINHlZZ7VZU/daR/Oa/n3fOpW', '$2y$10$72yGj7laHYAsizYSmnnK6.q3u0yOLvLEv5m9ynPFiuprrdETrZ6KC');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Achats`
--
ALTER TABLE `Achats`
  ADD CONSTRAINT `fk_ach_uti_id` FOREIGN KEY (`ach_uti_id`) REFERENCES `Utilisateurs` (`uti_id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

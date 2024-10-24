-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 23 oct. 2024 à 21:50
-- Version du serveur : 8.0.30
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `olympique`
--

-- --------------------------------------------------------

--
-- Structure de la table `achats`
--

CREATE TABLE `achats` (
  `ach_id` int NOT NULL,
  `ach_cat` varchar(20) NOT NULL,
  `ach_prix` decimal(4,2) NOT NULL,
  `ach_cle` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ach_uti_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `achats`
--

INSERT INTO `achats` (`ach_id`, `ach_cat`, `ach_prix`, `ach_cle`, `ach_uti_id`) VALUES
(1, 'Solo', '18.00', '$2y$10$uiDF97ElqKUY25U8v/Rdje1xVRl3zO1zQkfhCC9/Mw3rSWv6BFVLa', 3),
(2, 'Familiale', '62.00', '$2y$10$TvQVKbstjKvSGZOTBm5UauijX4GSoUlvSRkSsnEC1WjmVtHQqk80C', 3),
(4, 'Familiale', '62.00', '$2y$10$fT0NyWhhTjg7y0Eok841P.6YYzBOskydyk5lK7hzvFgntv6hyNvm2', 3);

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `ad_id` int NOT NULL,
  `ad_nom` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ad_prenom` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ad_email` varchar(23) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ad_mdp` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`ad_id`, `ad_nom`, `ad_prenom`, `ad_email`, `ad_mdp`) VALUES
(1, 'AdminTest', 'Le Magnifique', 'admin@gmail.com', '$2a$12$tcYti.0UW2P4d5BBkcjxXupjdE0DZAYFgBc5mxwjLbF8sKdSP9Rqe');

-- --------------------------------------------------------

--
-- Structure de la table `offres`
--

CREATE TABLE `offres` (
  `off_id` int NOT NULL,
  `off_cat` varchar(20) NOT NULL,
  `off_prix` decimal(4,2) NOT NULL,
  `off_descrip` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `offres`
--

INSERT INTO `offres` (`off_id`, `off_cat`, `off_prix`, `off_descrip`) VALUES
(1, 'Solo', '18.20', 'Offre pour 1 personne'),
(2, 'Duo', '36.40', 'Offre pour 2 personnes'),
(3, 'Familiale', '62.80', 'Offre pour 4 personnes');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `uti_id` int NOT NULL,
  `uti_nom` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `uti_prenom` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `uti_email` varchar(23) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `uti_mdp` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `uti_cle` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`uti_id`, `uti_nom`, `uti_prenom`, `uti_email`, `uti_mdp`, `uti_cle`) VALUES
(3, 'Testuti', 'Le Testeur', 'testeurpro@gmail.com', '$2y$10$i50vDSBB1TkuNj0ZtOeWLOPbivclYINHlZZ7VZU/daR/Oa/n3fOpW', '$2y$10$72yGj7laHYAsizYSmnnK6.q3u0yOLvLEv5m9ynPFiuprrdETrZ6KC');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `achats`
--
ALTER TABLE `achats`
  ADD PRIMARY KEY (`ach_id`),
  ADD KEY `fk_ach_uti_id` (`ach_uti_id`);

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`ad_id`);

--
-- Index pour la table `offres`
--
ALTER TABLE `offres`
  ADD PRIMARY KEY (`off_id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`uti_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `achats`
--
ALTER TABLE `achats`
  MODIFY `ach_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `admins`
--
ALTER TABLE `admins`
  MODIFY `ad_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `offres`
--
ALTER TABLE `offres`
  MODIFY `off_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `uti_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `achats`
--
ALTER TABLE `achats`
  ADD CONSTRAINT `fk_ach_uti_id` FOREIGN KEY (`ach_uti_id`) REFERENCES `utilisateurs` (`uti_id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

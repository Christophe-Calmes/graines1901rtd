-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : sam. 14 juin 2025 à 14:15
-- Version du serveur : 8.0.42-0ubuntu0.24.04.1
-- Version de PHP : 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `xgyd0647_rtdAssociation`
--

-- --------------------------------------------------------

--
-- Structure de la table `bilans`
--

CREATE TABLE `bilans` (
  `id` int NOT NULL,
  `openCompta` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `closeCompta` datetime DEFAULT NULL,
  `archive` tinyint NOT NULL DEFAULT '0',
  `valid` tinyint NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--

-- --------------------------------------------------------

--
-- Structure de la table `compta`
--

CREATE TABLE `compta` (
  `idActe` int NOT NULL,
  `dateActe` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_update` datetime DEFAULT NULL,
  `numeroTransaction` varchar(60) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `objet` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `montant` float NOT NULL,
  `formeBanquaire` tinyint(1) NOT NULL,
  `auteurActes` int NOT NULL,
  `auteurDel` int DEFAULT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '1',
  `bilan` tinyint(1) NOT NULL DEFAULT '0',
  `balance` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--

-- Structure de la table `events`
--

CREATE TABLE `events` (
  `id` int NOT NULL,
  `idOwner` int DEFAULT NULL,
  `nameEvent` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `objetEvent` text COLLATE utf8mb4_general_ci,
  `date` date NOT NULL,
  `hour` time NOT NULL,
  `numberParticipants` int DEFAULT NULL,
  `valid` tinyint(1) DEFAULT '1',
  `idNameGame` int DEFAULT NULL,
  `idLocation` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `linkGames_nameGames`
--

CREATE TABLE `linkGames_nameGames` (
  `idType` int NOT NULL,
  `idNameGame` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `link_events_participants`
--

CREATE TABLE `link_events_participants` (
  `idOwner` int NOT NULL,
  `idEvent` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `locations`
--

CREATE TABLE `locations` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `adress` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `zipCode` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `private` tinyint(1) DEFAULT '0',
  `idOwner` int DEFAULT NULL,
  `valid` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `nameGames`
--

CREATE TABLE `nameGames` (
  `id` int NOT NULL,
  `nameGame` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `valid` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `typeGames`
--

CREATE TABLE `typeGames` (
  `id` int NOT NULL,
  `typeGame` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `valid` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bilans`
--
ALTER TABLE `bilans`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `compta`
--
ALTER TABLE `compta`
  ADD PRIMARY KEY (`idActe`);

--
-- Index pour la table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_events_nameGames` (`idNameGame`),
  ADD KEY `fk_events_locations` (`idLocation`);

--
-- Index pour la table `linkGames_nameGames`
--
ALTER TABLE `linkGames_nameGames`
  ADD PRIMARY KEY (`idType`,`idNameGame`),
  ADD KEY `fk_link_nameGames` (`idNameGame`);

--
-- Index pour la table `link_events_participants`
--
ALTER TABLE `link_events_participants`
  ADD PRIMARY KEY (`idOwner`,`idEvent`),
  ADD KEY `fk_link_participants_event` (`idEvent`);

--
-- Index pour la table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `nameGames`
--
ALTER TABLE `nameGames`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `typeGames`
--
ALTER TABLE `typeGames`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bilans`
--
ALTER TABLE `bilans`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT pour la table `compta`
--
ALTER TABLE `compta`
  MODIFY `idActe` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT pour la table `events`
--
ALTER TABLE `events`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `nameGames`
--
ALTER TABLE `nameGames`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `typeGames`
--
ALTER TABLE `typeGames`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `fk_events_locations` FOREIGN KEY (`idLocation`) REFERENCES `locations` (`id`),
  ADD CONSTRAINT `fk_events_nameGames` FOREIGN KEY (`idNameGame`) REFERENCES `nameGames` (`id`);

--
-- Contraintes pour la table `linkGames_nameGames`
--
ALTER TABLE `linkGames_nameGames`
  ADD CONSTRAINT `fk_link_nameGames` FOREIGN KEY (`idNameGame`) REFERENCES `nameGames` (`id`),
  ADD CONSTRAINT `fk_link_typeGames` FOREIGN KEY (`idType`) REFERENCES `typeGames` (`id`);

--
-- Contraintes pour la table `link_events_participants`
--
ALTER TABLE `link_events_participants`
  ADD CONSTRAINT `fk_link_participants_event` FOREIGN KEY (`idEvent`) REFERENCES `events` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

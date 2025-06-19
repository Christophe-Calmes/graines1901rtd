-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 19 juin 2025 à 08:14
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
-- Base de données : `xgyd0647_rtdtech`
--

-- --------------------------------------------------------

--
-- Structure de la table `banIP`
--

CREATE TABLE `banIP` (
  `id` int NOT NULL,
  `BanIP` varchar(60) NOT NULL,
  `dateCreat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `dataSite`
--

CREATE TABLE `dataSite` (
  `idDataSite` int NOT NULL,
  `titre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sousTitre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `titreHTML` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `dataSite`
--

INSERT INTO `dataSite` (`idDataSite`, `titre`, `sousTitre`, `description`, `titreHTML`) VALUES
(1, 'Dragoon Wargame', 'Jeu de figurines &amp; seconde guerre mondial', 'blog, projet graines, php, développeur, recherche d&#039;emploi, développement de site web, saas', 'Jeu de figurines &amp; seconde guerre mondial');

-- --------------------------------------------------------

--
-- Structure de la table `family_link`
--

CREATE TABLE `family_link` (
  `idUser` int NOT NULL,
  `idFamily` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `family_link`
--

INSERT INTO `family_link` (`idUser`, `idFamily`) VALUES
(65, 64),
(65, 64),
(62, 61),
(65, 64),
(65, 64);

-- --------------------------------------------------------

--
-- Structure de la table `journaux`
--

CREATE TABLE `journaux` (
  `idConnexion` int NOT NULL,
  `ipUser` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idUser` int NOT NULL DEFAULT '0',
  `login` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `mdpHacker` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `dateHeure` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `okConnexion` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `journaux`
--

INSERT INTO `journaux` (`idConnexion`, `ipUser`, `idUser`, `login`, `mdpHacker`, `dateHeure`, `okConnexion`) VALUES
(1, '::1', 1, 'Admin', '0', '2025-05-22 16:50:20', 1),
(2, '::1', 58, 'Gestionnaire', '0', '2025-05-22 17:08:12', 1),
(3, '::1', 58, 'Gestionnaire', '0', '2025-05-22 17:08:50', 1),
(4, '::1', 1, 'Admin', '0', '2025-05-28 14:27:15', 1),
(5, '::1', 58, 'Gestionnaire', '0', '2025-05-28 14:28:28', 1),
(6, '::1', 58, 'Gestionnaire', '0', '2025-05-28 14:28:49', 1),
(7, '::1', 1, 'Admin', '0', '2025-05-28 14:39:18', 1),
(8, '::1', 0, 'Camille', 'christophe', '2025-05-28 14:44:33', 0),
(9, '::1', 60, 'Camille', '0', '2025-05-28 14:49:07', 1),
(10, '::1', 1, 'Admin', '0', '2025-05-28 14:50:02', 1),
(11, '::1', 58, 'Gestionnaire', '0', '2025-05-28 14:52:51', 1),
(12, '::1', 58, 'Gestionnaire', '0', '2025-05-28 15:00:32', 1),
(13, '::1', 1, 'Admin', '0', '2025-05-28 16:12:36', 1),
(14, '::1', 1, 'Admin', '0', '2025-05-28 17:48:32', 1),
(15, '::1', 1, 'Admin', '0', '2025-05-28 18:08:01', 1),
(16, '::1', 58, 'Gestionnaire', '0', '2025-05-28 18:08:06', 1),
(17, '::1', 1, 'Admin', '0', '2025-05-28 18:25:06', 1),
(18, '::1', 58, 'Gestionnaire', '0', '2025-05-28 18:25:30', 1),
(19, '::1', 1, 'Admin', '0', '2025-05-28 18:27:55', 1),
(20, '::1', 59, 'Aresh', '0', '2025-05-28 18:28:17', 1),
(21, '::1', 58, 'Gestionnaire', '0', '2025-05-28 18:28:23', 1),
(22, '::1', 58, 'Gestionnaire', '0', '2025-05-28 19:55:03', 1),
(23, '::1', 1, 'Admin', '0', '2025-05-28 19:55:26', 1),
(24, '::1', 58, 'Gestionnaire', '0', '2025-05-28 19:57:51', 1),
(25, '::1', 1, 'Admin', '0', '2025-05-28 20:28:01', 1),
(26, '::1', 58, 'Gestionnaire', '0', '2025-05-29 08:39:14', 1),
(27, '::1', 1, 'Admin', '0', '2025-05-29 08:54:19', 1),
(28, '::1', 58, 'Gestionnaire', '0', '2025-05-29 08:58:07', 1),
(29, '::1', 58, 'Gestionnaire', '0', '2025-05-29 10:59:04', 1),
(30, '::1', 58, 'Gestionnaire', '0', '2025-05-29 11:52:32', 1),
(31, '::1', 58, 'Gestionnaire', '0', '2025-05-30 16:46:32', 1),
(32, '::1', 58, 'Gestionnaire', '0', '2025-05-31 14:12:41', 1),
(33, '::1', 58, 'Gestionnaire', '0', '2025-06-04 21:35:02', 1),
(34, '::1', 58, 'Gestionnaire', '0', '2025-06-05 13:03:06', 1),
(35, '::1', 1, 'Admin', '0', '2025-06-05 13:04:10', 1),
(36, '::1', 58, 'Gestionnaire', '0', '2025-06-05 13:06:50', 1),
(37, '::1', 1, 'Admin', '0', '2025-06-05 13:17:33', 1),
(38, '::1', 58, 'Gestionnaire', '0', '2025-06-05 13:18:04', 1),
(39, '::1', 58, 'Gestionnaire', '0', '2025-06-05 13:21:19', 1),
(40, '::1', 58, 'Gestionnaire', '0', '2025-06-05 13:51:40', 1),
(41, '::1', 1, 'Admin', '0', '2025-06-05 14:18:03', 1),
(42, '::1', 58, 'Gestionnaire', '0', '2025-06-05 14:19:57', 1),
(43, '::1', 58, 'Gestionnaire', '0', '2025-06-05 15:27:50', 1),
(44, '::1', 58, 'Gestionnaire', '0', '2025-06-05 16:12:13', 1),
(45, '::1', 58, 'Gestionnaire', '0', '2025-06-05 19:49:43', 1),
(46, '::1', 58, 'Gestionnaire', '0', '2025-06-05 22:05:07', 1),
(47, '::1', 58, 'Gestionnaire', '0', '2025-06-06 09:11:32', 1),
(48, '::1', 1, 'Admin', '0', '2025-06-06 09:26:34', 1),
(49, '::1', 58, 'Gestionnaire', '0', '2025-06-06 09:32:16', 1),
(50, '::1', 58, 'Gestionnaire', '0', '2025-06-06 15:19:24', 1),
(51, '::1', 1, 'Admin', '0', '2025-06-06 16:24:07', 1),
(52, '::1', 58, 'Gestionnaire', '0', '2025-06-06 16:26:54', 1),
(53, '::1', 58, 'Gestionnaire', '0', '2025-06-10 15:17:24', 1),
(54, '::1', 58, 'Gestionnaire', '0', '2025-06-10 15:17:40', 1),
(55, '::1', 1, 'Admin', '0', '2025-06-10 15:55:30', 1),
(56, '::1', 58, 'Gestionnaire', '0', '2025-06-10 15:56:55', 1),
(57, '::1', 58, 'Gestionnaire', '0', '2025-06-11 08:26:40', 1),
(58, '::1', 1, 'Admin', '0', '2025-06-11 08:35:07', 1),
(59, '::1', 1, 'Admin', '0', '2025-06-11 08:38:14', 1),
(60, '::1', 58, 'Gestionnaire', '0', '2025-06-11 08:38:19', 1),
(61, '::1', 58, 'Gestionnaire', '0', '2025-06-11 10:24:38', 1),
(62, '::1', 1, 'Admin', '0', '2025-06-11 10:25:51', 1),
(63, '::1', 58, 'Gestionnaire', '0', '2025-06-11 10:26:28', 1),
(64, '::1', 58, 'Gestionnaire', '0', '2025-06-12 15:34:10', 1),
(65, '::1', 58, 'Gestionnaire', '0', '2025-06-12 18:24:24', 1),
(66, '::1', 1, 'Admin', '0', '2025-06-12 23:04:01', 1),
(67, '::1', 58, 'Gestionnaire', '0', '2025-06-12 23:05:18', 1),
(68, '::1', 61, 'Bernard', '0', '2025-06-12 23:05:38', 1),
(69, '::1', 58, 'Gestionnaire', '0', '2025-06-13 09:11:40', 1),
(70, '::1', 1, 'Admin', '0', '2025-06-13 09:11:56', 1),
(71, '::1', 58, 'Gestionnaire', '0', '2025-06-13 09:12:07', 1),
(72, '::1', 58, 'Gestionnaire', '0', '2025-06-14 08:18:06', 1),
(73, '::1', 1, 'Admin', '0', '2025-06-14 08:34:46', 1),
(74, '::1', 1, 'Admin', '0', '2025-06-14 08:35:14', 1),
(75, '::1', 58, 'Gestionnaire', '0', '2025-06-14 08:35:24', 1),
(76, '::1', 1, 'Admin', '0', '2025-06-14 08:41:29', 1),
(77, '::1', 58, 'Gestionnaire', '0', '2025-06-14 08:42:19', 1),
(78, '::1', 58, 'Gestionnaire', '0', '2025-06-14 16:12:51', 1),
(79, '::1', 0, 'Camille', 'christophe', '2025-06-14 16:21:01', 0),
(80, '::1', 0, 'Aresh', 'christophe', '2025-06-14 16:21:06', 0),
(81, '::1', 1, 'Admin', '0', '2025-06-14 16:21:10', 1),
(82, '::1', 61, 'Bernard', '0', '2025-06-14 16:21:22', 1),
(83, '::1', 66, 'Eric', '0', '2025-06-14 16:45:58', 1),
(84, '::1', 58, 'Gestionnaire', '0', '2025-06-14 16:48:28', 1),
(85, '::1', 66, 'Eric', '0', '2025-06-14 16:49:40', 1),
(86, '::1', 58, 'Gestionnaire', '0', '2025-06-16 08:24:52', 1),
(87, '::1', 61, 'Bernard', '0', '2025-06-16 08:25:06', 1),
(88, '::1', 58, 'Gestionnaire', '0', '2025-06-16 09:08:59', 1),
(89, '::1', 1, 'Admin', '0', '2025-06-16 09:09:07', 1),
(90, '::1', 1, 'Admin', '0', '2025-06-16 09:19:56', 1),
(91, '::1', 1, 'Admin', '0', '2025-06-16 09:20:48', 1),
(92, '::1', 58, 'Gestionnaire', '0', '2025-06-16 09:20:59', 1),
(93, '::1', 1, 'Admin', '0', '2025-06-16 09:30:57', 1),
(94, '::1', 58, 'Gestionnaire', '0', '2025-06-16 09:33:07', 1),
(95, '::1', 58, 'Gestionnaire', '0', '2025-06-16 10:14:20', 1),
(96, '::1', 58, 'Gestionnaire', '0', '2025-06-16 14:07:24', 1),
(97, '::1', 1, 'Admin', '0', '2025-06-16 14:09:55', 1),
(98, '::1', 58, 'Gestionnaire', '0', '2025-06-16 14:12:51', 1),
(99, '::1', 58, 'Gestionnaire', '0', '2025-06-16 20:16:31', 1),
(100, '::1', 1, 'Admin', '0', '2025-06-16 20:16:57', 1),
(101, '::1', 1, 'Admin', '0', '2025-06-16 20:18:30', 1),
(102, '::1', 58, 'Gestionnaire', '0', '2025-06-16 20:20:57', 1),
(103, '::1', 0, 'Bernard', 'camille', '2025-06-16 21:17:11', 0),
(104, '::1', 61, 'Bernard', '0', '2025-06-16 21:17:24', 1),
(105, '::1', 58, 'Gestionnaire', '0', '2025-06-16 21:18:12', 1),
(106, '::1', 58, 'Gestionnaire', '0', '2025-06-16 21:26:17', 1),
(107, '::1', 1, 'Admin', '0', '2025-06-16 21:53:57', 1),
(108, '::1', 58, 'Gestionnaire', '0', '2025-06-16 21:54:32', 1),
(109, '::1', 58, 'Gestionnaire', '0', '2025-06-17 11:29:35', 1),
(110, '::1', 1, 'Admin', '0', '2025-06-17 14:59:21', 1),
(111, '::1', 1, 'Admin', '0', '2025-06-17 15:01:48', 1),
(112, '::1', 61, 'Bernard', '0', '2025-06-17 15:02:57', 1),
(113, '::1', 61, 'Bernard', '0', '2025-06-18 08:20:20', 1),
(114, '::1', 58, 'Gestionnaire', '0', '2025-06-18 09:45:46', 1),
(115, '::1', 61, 'Bernard', '0', '2025-06-18 09:47:55', 1),
(116, '::1', 1, 'Admin', '0', '2025-06-18 09:49:51', 1),
(117, '::1', 61, 'Bernard', '0', '2025-06-18 09:50:40', 1),
(118, '::1', 61, 'Bernard', '0', '2025-06-19 08:24:03', 1),
(119, '::1', 1, 'Admin', '0', '2025-06-19 09:27:00', 1),
(120, '::1', 61, 'Bernard', '0', '2025-06-19 09:28:27', 1);

-- --------------------------------------------------------

--
-- Structure de la table `membership`
--

CREATE TABLE `membership` (
  `id` int NOT NULL,
  `MemberNumber` varchar(12) COLLATE utf8mb4_general_ci NOT NULL,
  `creat_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_users` int NOT NULL,
  `cotisation` tinyint(1) NOT NULL DEFAULT '0',
  `valid` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `membership`
--

INSERT INTO `membership` (`id`, `MemberNumber`, `creat_date`, `update_date`, `id_users`, `cotisation`, `valid`) VALUES
(22, '2025WLrGiEIz', '2025-06-05 13:59:41', '2025-06-16 19:23:11', 63, 2, 1),
(23, '20252Aif2luJ', '2025-06-05 13:59:43', '2025-06-14 14:13:15', 61, 0, 1),
(24, '2025I6jV4Yvw', '2025-06-05 13:59:44', '2025-06-14 14:13:42', 62, 0, 1),
(25, '2025TxI7tNlW', '2025-06-05 14:12:18', '2025-06-14 14:14:13', 64, 0, 1),
(26, '2025oNyVqQDz', '2025-06-05 14:12:18', '2025-06-14 14:14:20', 65, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `menuNav`
--

CREATE TABLE `menuNav` (
  `idMenuDeroulant` int NOT NULL,
  `titreMenu` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `menuNav`
--

INSERT INTO `menuNav` (`idMenuDeroulant`, `titreMenu`) VALUES
(1, 'Administration du site'),
(6, 'Administration User'),
(20, 'Firewall'),
(29, 'Admin blog'),
(31, 'Evénements'),
(32, 'Admin événements'),
(33, 'Adhérants'),
(34, 'Comptabilité'),
(35, 'Evenements'),
(36, 'Admin evenements');

-- --------------------------------------------------------

--
-- Structure de la table `modules`
--

CREATE TABLE `modules` (
  `id` int NOT NULL,
  `module` varchar(30) NOT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `modules`
--

INSERT INTO `modules` (`id`, `module`, `valide`) VALUES
(1, 'Graines', 1),
(16, 'Blog', 1),
(18, 'Evenement', 1),
(19, 'Membership', 1),
(20, 'Accounting', 1),
(21, 'events', 1);

-- --------------------------------------------------------

--
-- Structure de la table `navigation`
--

CREATE TABLE `navigation` (
  `idNav` int NOT NULL,
  `nomNav` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cheminNav` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `menuVisible` tinyint(1) NOT NULL,
  `zoneMenu` int NOT NULL,
  `ordre` tinyint NOT NULL,
  `niveau` tinyint(1) NOT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '1',
  `deroulant` tinyint NOT NULL DEFAULT '0',
  `targetRoute` varchar(22) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `idModule` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `navigation`
--

INSERT INTO `navigation` (`idNav`, `nomNav`, `cheminNav`, `menuVisible`, `zoneMenu`, `ordre`, `niveau`, `valide`, `deroulant`, `targetRoute`, `idModule`) VALUES
(72, 'connexion', 'modules/connexion/connexion.php', 1, 0, 10, 0, 1, 0, '8115637472316835', 1),
(73, 'inscription', 'modules/users/inscription.php', 0, 0, 0, 0, 1, 0, '10474957029951175364', 1),
(74, 'Deconnexion', 'modules/securiter/deconnexion.php', 1, 0, 20, 2, 1, 0, '98955486766', 1),
(75, 'Deconnexion', 'modules/securiter/deconnexion.php', 1, 0, 20, 1, 1, 0, '11662169526164', 1),
(76, 'Administration du site', 'modules/navigation/erreurNav.php', 1, 0, 1, 2, 1, 1, '55115544685', 1),
(77, 'Ajout lien de nav', 'modules/navigation/menuAdmin/creationNouveuMenu.php', 1, 1, 1, 2, 1, 0, '5681514976767', 1),
(78, 'Titres et SEO', 'modules/dataSite/titreInfo.php', 1, 1, 2, 2, 1, 0, '5686859414440', 1),
(81, 'Brassage des liens', 'modules/navigation/menuAdmin/dynamique.php', 1, 1, 2, 2, 1, 0, '6164478184413185', 1),
(82, 'Ajout menu déroulant', 'modules/navigation/menuAdmin/ajoutMenuDeroulant.php', 1, 1, 2, 2, 1, 1, '7533563623516894', 1),
(85, 'Administration User', 'modules/navigation/erreurNav.php', 1, 0, 1, 2, 1, 6, '365410550445', 1),
(86, 'Users Actif', 'modules/users/administration/droitUser.php', 1, 6, 1, 2, 1, 6, '589126694019', 1),
(87, 'Route Form', 'modules/navigation/menuAdmin/ajoutRouteForm.php', 1, 1, 2, 2, 1, 0, '15906465627969', 1),
(88, 'Users Anciens ', 'modules/users/administration/droitUserNonValide.php', 1, 6, 2, 2, 1, 0, '607516636674', 1),
(89, 'Profil', 'modules/users/administration/profilUser.php', 1, 0, 19, 1, 1, 0, '307414435560642', 1),
(90, 'Profil', 'modules/users/administration/profilUser.php', 1, 0, 1, 2, 1, 0, '1748406274441', 1),
(91, 'Journeaux de log', 'modules/journaux/journaux.php', 1, 20, 1, 2, 1, 0, '1927314512', 1),
(92, 'Admin nav', 'modules/navigation/menuAdmin/adminMenu.php', 1, 1, 2, 2, 1, 0, '01671655102', 1),
(93, 'modification lien nav', 'modules/navigation/menuAdmin/modificationNav.php', 0, 0, 0, 2, 1, 0, '554646861628846', 1),
(95, 'Admin modules', 'modules/navigation/menuAdmin/administrationModules.php', 1, 1, 7, 2, 1, 1, '433625450215', 1),
(99, 'Add roles', 'modules/users/administration/addRole.php', 1, 6, 3, 2, 1, 0, '33417464491165006626', 1),
(100, 'Deco', 'modules/securiter/deconnexion.php', 1, 0, 20, 3, 1, 0, '61437620881', 1),
(101, 'Profil', 'modules/users/administration/profilUser.php', 1, 0, 19, 3, 1, 0, '811359615657566', 1),
(104, 'cgu', 'modules/cgu/cgu.php', 0, 0, 0, 1, 1, 0, '5841545475941', 1),
(136, 'cgu', 'modules/cgu/cgu.php', 0, 0, 0, 0, 1, 0, '6004478660997940', 1),
(137, 'cguUser', 'modules/cgu/cgu.php', 0, 0, 0, 1, 1, 0, '145887415636154', 1),
(138, 'cguUser', 'modules/cgu/cgu.php', 0, 0, 0, 3, 1, 0, '36034669822', 1),
(140, 'Lost Password', 'modules/users/administration/lostPassword.php', 0, 0, 0, 0, 1, 0, '117554256971255', 1),
(141, 'Inscription', 'modules/users/inscription.php', 1, 0, 1, 0, 0, 0, '46902325427385654690', 1),
(148, 'Firewall', 'modules/navigation/erreurNav.php', 1, 0, 2, 2, 1, 20, '9699529468558', 1),
(150, 'IP ban panel', 'modules/journaux/ipBanPanel.php', 1, 20, 2, 2, 1, 0, '9520095251506595', 1),
(151, 'Accueil', 'modules/navigation/pageGeneral.php', 1, 0, 0, 0, 1, 0, '33561986820557', 1),
(152, 'Accueil', 'modules/navigation/pageGeneral.php', 1, 0, 0, 1, 1, 0, '68330289094', 1),
(153, 'Accueil', 'modules/navigation/pageGeneral.php', 1, 0, 0, 2, 1, 0, '02115283624378', 1),
(206, 'Admin blog', 'modules/navigation/erreurNav.php', 1, 0, 3, 3, 1, 29, '5337864953054946', 16),
(207, 'Add new article', 'modules/blog/administration/addNewArticle.php', 1, 29, 1, 3, 1, 0, '862329403034', 16),
(208, 'Add Categories', 'modules/blog/administration/addCategorie.php', 1, 29, 2, 3, 1, 0, '6643646550434462', 16),
(209, 'Acceuil', 'modules/navigation/pageGeneral.php', 1, 0, 1, 3, 1, 0, '52575730289645', 1),
(210, 'paginationArticle', 'modules/blog/public/paginationArticles.php', 0, 0, 0, 0, 1, 0, '50991583625', 16),
(211, 'paginationArticle', 'modules/blog/public/paginationArticles.php', 0, 0, 0, 1, 1, 0, '50489687065', 16),
(212, 'paginationArticle', 'modules/blog/public/paginationArticles.php', 0, 0, 0, 2, 1, 0, '6323656756824404', 16),
(213, 'paginationArticle', 'modules/blog/public/paginationArticles.php', 0, 0, 0, 3, 1, 0, '8541625261', 16),
(214, 'displayOneArticleOfBlog', 'modules/blog/public/displayOneArticle.php', 0, 0, 0, 0, 1, 0, '195653511506070', 16),
(215, 'displayOneArticleOfBlog', 'modules/blog/public/displayOneArticle.php', 0, 0, 0, 1, 1, 0, '2730646367', 16),
(216, 'displayOneArticleOfBlog', 'modules/blog/public/displayOneArticle.php', 0, 0, 0, 2, 1, 0, '65111424598541', 16),
(217, 'displayOneArticleOfBlog', 'modules/blog/public/displayOneArticle.php', 0, 0, 0, 3, 1, 0, '419974085524', 16),
(218, 'displayOneArticleOfBlog', 'modules/blog/administration/displayOneArticleAdmin.php', 0, 0, 0, 3, 1, 0, '4199740845698', 16),
(219, 'Add picture for blog', 'modules/blog/administration/addPictureBlog.php', 1, 29, 3, 3, 1, 0, '2733530154135364', 16),
(226, 'Article non publier', 'modules/blog/administration/paginationNoPublishArticles.php', 1, 29, 4, 3, 1, 0, '45712779065641345386', 16),
(227, 'Carrouselle', 'modules/blog/public/carrousel.php', 0, 0, 1, 0, 0, 0, '24661344386739268566', 16),
(228, 'Tous les articles publier', 'modules/blog/administration/paginationPublishArticles.php', 1, 29, 3, 3, 1, 0, '3957693867265130', 16),
(232, 'Profil', 'modules/users/administration/profilUser.php', 1, 0, 1, 4, 1, 0, '5503077785029621', 1),
(233, 'Déconnexion', 'modules/securiter/deconnexion.php', 1, 0, 1, 4, 1, 0, '6948913325965734', 1),
(234, 'Adhérants', 'modules/navigation/erreurNav.php', 1, 0, 2, 3, 1, 33, '15965405467490415070', 19),
(235, 'Adhérants', 'modules/Membership/Administration/Membership.php', 1, 33, 2, 3, 1, 0, '44656466260176764527', 19),
(236, 'Membre non adhérant', 'modules/Membership/Administration/subscription.php', 1, 33, 1, 3, 1, 0, '67032728687670527711', 19),
(237, 'cotisationMember', 'modules/accouting/administration/cotisationMember.php', 0, 0, 1, 3, 1, 0, '8264955628766379', 20),
(238, 'Comptabilité', 'modules/navigation/erreurNav.php', 1, 0, 4, 3, 1, 34, '38010730902471386785', 20),
(239, 'Comptabilité en cours', 'modules/accouting/administration/displayAccounting.php', 1, 34, 1, 3, 1, 0, '00129245934887694316', 20),
(240, 'Add actes', 'modules/accouting/administration/addActeAccounting.php', 1, 34, 2, 3, 1, 0, '5229149531055193', 20),
(241, 'Bilan', 'modules/accouting/administration/clotureBilan.php', 1, 34, 3, 3, 1, 0, '27019698217568054914', 20),
(242, 'ancien Bilan', 'modules/accouting/administration/oldBilan.php', 0, 0, 4, 3, 1, 0, '4281053785897573', 20),
(243, 'Evenements', 'modules/navigation/erreurNav.php', 1, 0, 0, 4, 1, 35, 'GkGiNHYewLBzWRkZ', 21),
(244, 'Evenements', 'modules/navigation/erreurNav.php', 1, 0, 5, 3, 1, 36, '02428474539644343452', 21),
(245, 'Admin jeux', 'sources/events/administration/addGame.php', 1, 36, 1, 3, 1, 0, '04559154576948278070', 21),
(246, 'admin Gamesheet', 'sources/events/administration/administrationGameSheet.php', 0, 0, 1, 3, 1, 0, '5606940833588267', 21),
(247, 'Ajouter lieux', 'sources/events/administration/addLocations.php', 1, 36, 2, 3, 1, 36, '3196960891968008', 21),
(248, 'Admin Location Sheet', 'sources/events/administration/administrationLocationSheet.php', 0, 0, 5, 3, 1, 0, '9067027182160922', 21),
(249, 'Ajouter événements', 'sources/events/public/addEvent.php', 1, 35, 1, 4, 1, 35, '95692395669580339302', 21),
(250, 'Mes événements', 'sources/events/public/myEvents.php', 1, 35, 2, 4, 1, 0, '5713351534563472', 21);

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `idRole` int NOT NULL,
  `typeRole` varchar(15) NOT NULL,
  `accreditation` tinyint DEFAULT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`idRole`, `typeRole`, `accreditation`, `valide`) VALUES
(1, 'Visiteur', 0, 1),
(4, 'Membre', 1, 1),
(6, 'Administrateur', 2, 1),
(9, 'Gestionnaire', 3, 1),
(10, 'Adhérents', 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `routageForm`
--

CREATE TABLE `routageForm` (
  `idForm` int NOT NULL,
  `chemin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `securiter` tinyint(1) NOT NULL DEFAULT '0',
  `valide` tinyint(1) NOT NULL DEFAULT '1',
  `route` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idModule` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `routageForm`
--

INSERT INTO `routageForm` (`idForm`, `chemin`, `securiter`, `valide`, `route`, `idModule`) VALUES
(1, 'modules/users/CUD/Create/inscriptionUser.php', 0, 1, '71511556420625', 1),
(2, 'modules/securiter/connexionUser.php', 0, 1, '3431764955490036175', 1),
(3, 'modules/users/CUD/Update/activationUser.php', 0, 1, '0837535135011909', 1),
(4, 'modules/navigation/CUD/Create/addLien.php', 2, 1, '64692018597640078', 1),
(5, 'modules/dataSite/CUD/Update/updateDataSite.php', 2, 1, '849831607267518', 1),
(6, 'modules/navigation/CUD/Create/addMenusDeroulant.php', 2, 1, '3886009129190629', 1),
(7, 'modules/navigation/CUD/Create/addRouteForm.php', 2, 1, '59642704113484847', 1),
(14, 'modules/users/CUD/Update/modAdminUser.php', 2, 1, '68439889929282', 1),
(16, 'modules/users/CUD/Update/emailUser.php', 1, 1, '064166501215741', 1),
(17, 'modules/users/CUD/Update/loginUser.php', 1, 1, '073565989824640', 1),
(18, 'modules/users/CUD/Update/mdpUser.php', 1, 1, '12669308932220940445', 1),
(19, 'modules/journaux/deleteLog.php', 2, 1, '98312270798917960', 1),
(20, 'modules/navigation/CUD/update/updateLienNav.php', 2, 1, '46061402111273554', 1),
(21, 'modules/navigation/CUD/Delete/deleteLienNav.php', 2, 1, '723946377896743', 1),
(22, 'modules/users/CUD/Update/desincriptionUser.php', 1, 1, '4767640977366987513', 1),
(23, 'modules/navigation/CUD/update/updateModule.php', 2, 1, '578258162519200691', 1),
(25, 'modules/navigation/CUD/Create/addModule.php', 2, 1, '244547015066171493', 1),
(29, 'modules/users/CUD/Create/addRoles.php', 2, 1, '491420113460824870', 1),
(56, 'modules/users/CUD/Update/sendToken.php', 0, 1, '919936052615291', 1),
(57, 'modules/users/CUD/Update/updatePassword.php', 0, 1, '4310834447337847190', 1),
(63, 'modules/journaux/CD/Delete/deleteBanIP.php', 2, 1, '997711066702986923', 1),
(64, 'modules/journaux/CD/Creat/addIPBAN.php', 2, 1, '48662382760604', 1),
(65, 'modules/journaux/CD/Creat/addIPBANfromJounaux.php', 2, 1, '92792823667028091', 1),
(129, 'modules/blog/CUD/creat/addNewArticle.php', 3, 1, '57380047722719387', 16),
(130, 'modules/blog/CUD/creat/addCategorie.php', 3, 1, '32820333043476094321', 16),
(131, 'modules/blog/CUD/update/updateCategorie.php', 3, 1, '49047139455462555014', 16),
(132, 'modules/blog/CUD/update/updateArticle.php', 3, 1, '327219091269093455', 16),
(133, 'modules/blog/CUD/Delete/deleteArticle.php', 3, 1, '2343300179638920', 16),
(134, 'modules/blog/CUD/creat/addPictureBlog.php', 3, 1, '6010953749934114337', 16),
(141, 'modules/blog/CUD/Delete/deletePictureBlog.php', 3, 1, '71502110382462757', 16),
(142, 'sources/events/cud/creat/creatEvent.php', 3, 1, '84905719441709958', 18),
(143, 'modules/Membership/CUD/creat/cotisationMember.php', 3, 1, '6269031155270307689', 19),
(144, 'modules/accouting/CUD/Update/adhesionMember.php', 3, 1, '46162666855790232285', 19),
(145, 'modules/Membership/CUD/update/contributFamily.php', 3, 1, '07366393382785117136', 19),
(146, 'modules/accouting/CUD/Creat/addActesAccounting.php', 3, 1, '73806083032310749814', 20),
(147, 'modules/accouting/CUD/Update/unvalideAccounting.php', 3, 1, '22306028867186345104', 20),
(148, 'modules/accouting/CUD/Update/clotureBilan.php', 3, 1, '09705190122494655051', 20),
(149, 'modules/accouting/CUD/Update/closeBilan.php', 3, 1, '44617866003323207774', 20),
(150, 'modules/accouting/CUD/Creat/startAccounting.php', 3, 1, '87235714624066908348', 20),
(151, 'sources/events/CUD/Creat/addGame.php', 3, 1, '31647858596363649827', 21),
(152, 'sources/events/CUD/Update/administrationGameSheet.php', 3, 1, '30655259562965808986', 21),
(153, 'sources/events/CUD/Creat/addLocation.php', 3, 1, '86367651746585431165', 21),
(154, 'sources/events/CUD/Update/updateLocation.php', 3, 1, '22350424109667718889', 21),
(155, 'sources/events/CUD/Creat/addEvents.php', 4, 1, '02045477816882008718', 21),
(156, 'sources/events/CUD/Delete/deleteEvent.php', 4, 1, '38578685817459536691', 21);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `idUser` int NOT NULL,
  `token` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prenom` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nom` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `login` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `mdp` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '1',
  `role` tinyint(1) NOT NULL DEFAULT '1',
  `dateCreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`idUser`, `token`, `email`, `prenom`, `nom`, `login`, `mdp`, `valide`, `role`, `dateCreation`) VALUES
(1, 'uAIUCYhACZ', 'christophe.calmes2020@laposte.net', 'Christophe', 'Calmes', 'Admin', '$2y$10$oADkGPsXhTD1m1.vawEEJevfSC1BwODMOuCHCntUrBQgpV5TmLy6S', 1, 2, '2022-06-12 14:26:13'),
(58, 'rEgaESwdFC', 'gestionnaire@gmail.com', 'Christophe', 'Calmes', 'Gestionnaire', '$2y$10$gIj/T1GuebPFWQwoR0GBcueEDa6Rc30/03E7.WE/Qp6rnbaZUy132', 1, 3, '2024-05-15 16:28:55'),
(61, 'uB5MQpVOPtamqGO7', 'utilisateur1@gmail.com', 'Bernard', 'Arnaud', 'Bernard', '$2y$10$BWJabOySv.dqsJ9YFZjZq.Yik4UplqemDAnwLxPdgyAdFgbQ8NXbG', 1, 4, '2025-06-05 13:20:51'),
(62, '912O9RIrND0qNJWw', 'utilisateur2@gmail.com', 'Jean', 'Arnaud', 'Jean', '$2y$10$dZDF1meunrmse4I4U5rJUeowOwb.nmXJ4Cb7aClZFTjLy2Dt.843q', 1, 4, '2025-06-05 13:51:36'),
(63, 'renb7nwZXp1MiErh', 'utilisateur3@gmail.com', 'Camille', 'Calmes', 'christophe', '$2y$10$nVKXRbmB1g/pUT1tolQKS.DP.uTSdn3rXV0DYuGUM/h.Rk1a9a9X2', 1, 4, '2025-06-05 15:27:48'),
(64, '5vBJ8BrXn8ioWE7R', 'utilisateur5@gmail.com', 'Jean-Philippe', 'Gasquet', 'JeanPhi', '$2y$10$sdI8S33v4KzWh5jKQa4jKOVSqAytY5Me7cHZpMvZB5R9dG8VM1Qbe', 1, 4, '2025-06-05 16:11:35'),
(65, 'dmyd0pf3FO5VOlDQ', 'utilisateur6@gmail.com', 'Christelle', 'Gasquet', 'Kriss', '$2y$10$MNO91eG3WIHx22hZ4LQ1pex0YML5Ks.keebOVdOMs2eWv2hnUKbJK', 1, 4, '2025-06-05 16:12:10'),
(66, 'J34m5BPhAfomK04v', 'Eric', 'Eric', 'Delpeche', 'Eric', '$2y$10$od0DneEMES1RtOlXycPEveldXWM5cC12/kyeXutqumYQSE2yH79sS', 1, 1, '2025-06-14 16:45:49');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `banIP`
--
ALTER TABLE `banIP`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `dataSite`
--
ALTER TABLE `dataSite`
  ADD PRIMARY KEY (`idDataSite`);

--
-- Index pour la table `journaux`
--
ALTER TABLE `journaux`
  ADD PRIMARY KEY (`idConnexion`);

--
-- Index pour la table `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `menuNav`
--
ALTER TABLE `menuNav`
  ADD PRIMARY KEY (`idMenuDeroulant`);

--
-- Index pour la table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `navigation`
--
ALTER TABLE `navigation`
  ADD PRIMARY KEY (`idNav`),
  ADD KEY `lierModule` (`idModule`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idRole`);

--
-- Index pour la table `routageForm`
--
ALTER TABLE `routageForm`
  ADD PRIMARY KEY (`idForm`),
  ADD KEY `lienModule` (`idModule`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `banIP`
--
ALTER TABLE `banIP`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `dataSite`
--
ALTER TABLE `dataSite`
  MODIFY `idDataSite` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `journaux`
--
ALTER TABLE `journaux`
  MODIFY `idConnexion` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT pour la table `membership`
--
ALTER TABLE `membership`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `menuNav`
--
ALTER TABLE `menuNav`
  MODIFY `idMenuDeroulant` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT pour la table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `navigation`
--
ALTER TABLE `navigation`
  MODIFY `idNav` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `idRole` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `routageForm`
--
ALTER TABLE `routageForm`
  MODIFY `idForm` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `navigation`
--
ALTER TABLE `navigation`
  ADD CONSTRAINT `lierModule` FOREIGN KEY (`idModule`) REFERENCES `modules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `routageForm`
--
ALTER TABLE `routageForm`
  ADD CONSTRAINT `lienModule` FOREIGN KEY (`idModule`) REFERENCES `modules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 15 déc. 2024 à 15:42
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `galeris`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_categorie` int(11) NOT NULL,
  `Nom_categorie` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `Nom_categorie`) VALUES
(2, 'Tableaux'),
(3, 'Scupltures');

-- --------------------------------------------------------

--
-- Structure de la table `code`
--

CREATE TABLE `code` (
  `ID` int(11) NOT NULL,
  `code` int(11) DEFAULT NULL,
  `date_expiration` datetime DEFAULT NULL,
  `ID_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `code`
--

INSERT INTO `code` (`ID`, `code`, `date_expiration`, `ID_user`) VALUES
(1, 789551, '2024-11-28 00:00:00', 6),
(2, 467518, '2024-11-28 21:55:06', 8),
(3, 158915, '2024-12-07 18:07:10', 6),
(4, 418626, '2024-12-07 18:09:40', 6),
(5, 638006, '2024-12-07 18:13:32', 6),
(6, 464135, '2024-12-07 18:15:11', 6),
(7, 726919, '2024-12-07 18:18:55', 6),
(8, 114853, '2024-12-07 18:20:44', 6),
(9, 268463, '2024-12-07 18:24:27', 6),
(10, 616024, '2024-12-07 18:26:57', 6),
(11, 598720, '2024-12-07 18:28:40', 6),
(12, 650337, '2024-12-07 18:30:44', 6),
(13, 731010, '2024-12-07 18:32:08', 6),
(14, 720782, '2024-12-07 18:33:31', 6),
(15, 556622, '2024-12-07 18:35:47', 6),
(16, 108315, '2024-12-07 18:39:34', 6),
(17, 723109, '2024-12-07 18:41:01', 6),
(18, 793663, '2024-12-07 18:49:52', 6),
(19, 555981, '2024-12-07 18:52:41', 6),
(20, 931497, '2024-12-07 18:54:15', 6),
(21, 867348, '2024-12-07 18:58:11', 6),
(22, 318040, '2024-12-07 19:06:10', 6),
(23, 910774, '2024-12-07 19:08:27', 6),
(24, 128631, '2024-12-07 19:12:14', 6),
(25, 691685, '2024-12-08 16:44:49', NULL),
(26, 161912, '2024-12-08 16:46:56', NULL),
(27, 878221, '2024-12-08 16:48:37', 6),
(28, 942713, '2024-12-08 16:50:32', 6),
(29, 502946, '2024-12-08 16:54:45', 6),
(30, 182535, '2024-12-08 16:54:58', 6),
(31, 371505, '2024-12-08 16:56:48', 6),
(32, 636136, '2024-12-08 16:56:59', 6),
(33, 659169, '2024-12-08 16:57:24', 6),
(34, 264346, '2024-12-08 17:36:30', 6),
(35, 313561, '2024-12-08 17:41:22', 6),
(36, 980392, '2024-12-08 17:42:15', 6),
(37, 108852, '2024-12-08 17:54:06', 6),
(38, 213628, '2024-12-08 17:56:30', 6),
(39, 144769, '2024-12-08 17:59:42', 6),
(40, 896299, '2024-12-08 17:59:56', 6),
(41, 206563, '2024-12-08 18:00:48', 6),
(42, 851906, '2024-12-09 10:39:15', 6),
(43, 640087, '2024-12-14 23:19:34', 10),
(44, 160831, '2024-12-15 00:00:15', 11),
(45, 546292, '2024-12-15 00:19:34', 12),
(46, 557644, '2024-12-15 00:19:42', 12),
(47, 345095, '2024-12-15 00:19:58', 12),
(48, 119510, '2024-12-15 00:23:18', NULL),
(49, 665382, '2024-12-15 00:25:13', NULL),
(50, 432365, '2024-12-15 00:25:58', NULL),
(51, 961362, '2024-12-15 00:33:20', 6),
(52, 334426, '2024-12-15 00:36:26', 6),
(53, 644999, '2024-12-15 00:38:47', 6),
(54, 939460, '2024-12-15 00:40:09', 6),
(55, 388001, '2024-12-15 00:40:32', 6),
(56, 899150, '2024-12-15 00:42:43', 6),
(57, 538422, '2024-12-15 00:44:42', 6),
(58, 365415, '2024-12-15 00:46:10', 6),
(59, 597902, '2024-12-15 00:47:14', 6),
(60, 870814, '2024-12-15 00:46:55', 6),
(61, 362887, '2024-12-15 00:49:03', 6),
(62, 154823, '2024-12-15 00:51:21', 6),
(63, 414412, '2024-12-15 01:12:25', 6),
(64, 788358, '2024-12-15 01:25:17', 6),
(65, 600480, '2024-12-15 01:26:48', 13),
(66, 966081, '2024-12-15 01:29:07', 13),
(67, 666974, '2024-12-15 01:31:54', 6),
(68, 103984, '2024-12-15 01:32:57', 13),
(69, 602335, '2024-12-15 01:35:51', 6),
(70, 345022, '2024-12-15 01:41:03', 6),
(71, 454676, '2024-12-15 01:41:46', 6),
(72, 858128, '2024-12-15 01:42:45', 6),
(73, 980795, '2024-12-15 01:45:49', 14),
(74, 843595, '2024-12-15 01:48:45', 14),
(75, 470082, '2024-12-15 01:54:08', 15),
(76, 589288, '2024-12-15 02:02:51', 16),
(77, 372047, '2024-12-15 02:04:26', 17),
(78, 805174, '2024-12-15 02:07:20', 18),
(79, 265376, '2024-12-15 02:12:28', 19),
(80, 332169, '2024-12-15 02:13:22', 20),
(81, 748074, '2024-12-15 02:19:12', 21),
(82, 696971, '2024-12-15 02:19:17', 21),
(83, 808994, '2024-12-15 02:19:53', 22),
(84, 569750, '2024-12-15 02:20:08', 22),
(85, 747581, '2024-12-15 02:21:43', 23),
(86, 466945, '2024-12-15 02:21:55', 23),
(87, 498381, '2024-12-15 02:23:07', 24),
(88, 294810, '2024-12-15 02:24:18', NULL),
(89, 291631, '2024-12-15 02:24:38', NULL),
(90, 882030, '2024-12-15 02:25:35', NULL),
(91, 160303, '2024-12-15 02:28:27', NULL),
(92, 912164, '2024-12-15 02:29:34', NULL),
(93, 285114, '2024-12-15 02:31:13', NULL),
(94, 391641, '2024-12-15 02:33:33', 6),
(95, 170378, '2024-12-15 02:36:28', 6),
(96, 767937, '2024-12-15 02:40:25', 6),
(97, 701307, '2024-12-15 02:41:09', 25),
(98, 399595, '2024-12-15 02:43:09', 6),
(99, 997600, '2024-12-15 02:48:39', 6),
(100, 773808, '2024-12-15 02:49:50', 26);

-- --------------------------------------------------------

--
-- Structure de la table `exposition`
--

CREATE TABLE `exposition` (
  `id_exhibition` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `statut` enum('refuse','en attente de validation','valide') DEFAULT 'en attente de validation'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `exposition`
--

INSERT INTO `exposition` (`id_exhibition`, `titre`, `description`, `date_debut`, `date_fin`, `user_id`, `statut`) VALUES
(1, 'test', '', '2024-12-14 00:00:00', '2024-12-28 00:00:00', 6, 'en attente de validation'),
(2, 'test', '', '2024-12-14 00:00:00', '2024-12-21 00:00:00', 6, 'en attente de validation'),
(3, 'sss', '', '2024-12-14 00:00:00', '2024-12-28 00:00:00', 6, 'en attente de validation'),
(4, 'sss', '', '2024-12-14 00:00:00', '2024-12-28 00:00:00', 6, 'en attente de validation'),
(5, 'sss', '', '2024-12-14 00:00:00', '2024-12-28 00:00:00', 6, 'en attente de validation'),
(6, 'ssss', 'sss', '2024-12-14 00:00:00', '2024-12-22 00:00:00', 6, 'en attente de validation'),
(7, 'ssss', 'sss', '2024-12-15 00:00:00', '2024-12-22 00:00:00', 6, 'en attente de validation'),
(8, 'akash', 'sss', '2024-12-15 00:00:00', '2024-12-22 00:00:00', 6, 'en attente de validation'),
(9, 'sss', 'ssss', '2024-12-15 00:00:00', '2024-12-22 00:00:00', 6, 'en attente de validation'),
(10, 'sss', 'sss', '2024-12-22 00:00:00', '2024-12-28 00:00:00', 6, 'en attente de validation'),
(11, 'sss', 'sss', '2024-12-15 00:00:00', '2024-12-28 00:00:00', 6, 'en attente de validation'),
(12, 'test', 'szzz', '2024-12-15 00:00:00', '2024-12-22 00:00:00', 6, 'en attente de validation'),
(13, 'test', 'szzz', '2024-12-15 00:00:00', '2024-12-20 00:00:00', 6, 'en attente de validation'),
(14, 'test', '', '2024-12-15 00:00:00', '2024-12-21 00:00:00', 6, 'en attente de validation'),
(15, 'test', '', '2024-12-15 00:00:00', '2024-12-21 00:00:00', 6, 'en attente de validation'),
(16, 'test', 'sss', '2024-12-15 00:00:00', '2024-12-27 00:00:00', 6, 'en attente de validation'),
(17, 'sss', 'sss', '2024-12-15 00:00:00', '2024-12-22 00:00:00', 6, 'en attente de validation'),
(18, 'sss', 'ss', '2024-12-15 00:00:00', '2024-12-28 00:00:00', 6, 'en attente de validation'),
(19, 'sss', 'sss', '2024-12-21 00:00:00', '2024-12-27 00:00:00', 6, 'en attente de validation'),
(20, 'sss', '', '2024-12-22 00:00:00', '2024-12-29 00:00:00', 6, 'en attente de validation'),
(21, 'test', 'sss', '2024-12-15 00:00:00', '2024-12-27 00:00:00', 6, 'en attente de validation'),
(22, 'test', 'ssss', '2024-12-25 00:00:00', '2024-12-28 00:00:00', 6, 'en attente de validation'),
(23, 'test', 'sss', '2024-12-15 00:00:00', '2024-12-20 00:00:00', 6, 'en attente de validation'),
(24, 'test', 'sss', '2024-12-15 00:00:00', '2024-12-28 00:00:00', 6, 'en attente de validation'),
(25, '50', '', '2024-12-16 00:00:00', '2024-12-19 00:00:00', NULL, 'en attente de validation'),
(26, 'sss', '', '2024-12-27 00:00:00', '2024-12-29 00:00:00', NULL, 'en attente de validation'),
(27, 'sss', '', '2024-12-16 00:00:00', '2024-12-27 00:00:00', NULL, 'en attente de validation');

-- --------------------------------------------------------

--
-- Structure de la table `exposition_images`
--

CREATE TABLE `exposition_images` (
  `id_exposition_images` int(11) NOT NULL,
  `chemin_image` varchar(100) DEFAULT NULL,
  `id_exposition` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `exposition_images`
--

INSERT INTO `exposition_images` (`id_exposition_images`, `chemin_image`, `id_exposition`) VALUES
(1, 'ImageBD/exposition/image_675dea7b7462c8.30624128.png', 17),
(2, 'ImageBD/exposition/image_675decac041c14.17469191.png', 21),
(3, 'ImageBD/exposition/image_675dece1a14e60.10690491.png', 22),
(4, 'ImageBD/exposition/image_675dfb6d563669.11897832.png', 24),
(5, 'ImageBD/exposition/image_675e2a7fbf7e38.22606091.png', 25),
(6, 'ImageBD/exposition/image_675e2ade814c53.27693642.png', 27),
(7, 'ImageBD/exposition/image_675e2ade839c37.02756374.png', 27),
(8, 'ImageBD/exposition/image_675e2ade89b509.90906819.png', 27);

-- --------------------------------------------------------

--
-- Structure de la table `oeuvre`
--

CREATE TABLE `oeuvre` (
  `id_oeuvre` int(11) NOT NULL,
  `Titre` varchar(50) NOT NULL,
  `Description` text DEFAULT NULL,
  `eco_responsable` tinyint(1) DEFAULT 0,
  `Date_debut` datetime DEFAULT current_timestamp(),
  `Date_fin` datetime NOT NULL,
  `Prix` decimal(10,2) DEFAULT NULL,
  `type_vente` enum('Vente','Enchere') NOT NULL,
  `est_vendu` tinyint(1) DEFAULT 0,
  `auteur` varchar(50) DEFAULT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  `id_categorie` int(11) DEFAULT NULL,
  `statut` enum('refuse','en attente de validation','accepte') DEFAULT 'en attente de validation'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `oeuvre`
--

INSERT INTO `oeuvre` (`id_oeuvre`, `Titre`, `Description`, `eco_responsable`, `Date_debut`, `Date_fin`, `Prix`, `type_vente`, `est_vendu`, `auteur`, `id_utilisateur`, `id_categorie`, `statut`) VALUES
(1, 'test', '', 0, '2024-12-14 19:29:22', '2025-01-13 19:29:22', 30.00, 'Enchere', 0, 'tets', NULL, 2, 'en attente de validation'),
(2, 'test', '', 0, '2024-12-14 19:30:34', '2025-01-13 19:30:34', 30.00, 'Vente', 0, 'auteuir', NULL, 2, 'en attente de validation'),
(3, 'test', '', 0, '2024-12-14 19:32:04', '2025-01-13 19:31:37', 30.00, 'Vente', 0, 'test', NULL, 3, 'en attente de validation'),
(4, 'test', '', 0, '2024-12-14 19:33:10', '2024-12-16 19:33:07', 30.00, 'Enchere', 0, 'bom', 6, 2, 'en attente de validation'),
(5, 'sss', '', 0, '2024-12-14 19:48:27', '2025-01-13 19:48:26', 50.00, 'Vente', 0, 'sss', 6, 2, 'en attente de validation'),
(6, 'test', '', 0, '2024-12-14 19:49:16', '2025-01-08 19:49:16', 30.00, 'Vente', 0, 'test', 6, 2, 'en attente de validation'),
(7, 's', '', 0, '2024-12-14 19:49:44', '2025-01-13 19:49:43', 30.00, 'Enchere', 0, 's', 6, 2, 'en attente de validation'),
(8, 'sss', '', 0, '2024-12-14 19:50:13', '2025-01-13 19:50:13', 50.00, 'Vente', 0, 'sss', 6, 3, 'en attente de validation'),
(9, 'test', 'test', 0, '2024-12-14 19:54:49', '2025-01-13 19:54:49', 30.00, 'Vente', 0, 'test', 6, 2, 'en attente de validation'),
(10, 'test', '', 0, '2024-12-14 19:56:03', '2024-12-16 19:56:03', 52.00, 'Enchere', 0, 'et', 6, 3, 'en attente de validation'),
(11, 'test', '', 0, '2024-12-14 19:57:15', '2025-01-13 19:57:15', 30.00, 'Enchere', 0, 'test', 6, 2, 'en attente de validation'),
(12, '20', '', 0, '2024-12-14 19:57:34', '2025-01-13 19:57:34', 30.00, 'Vente', 0, 'ss', 6, 3, 'en attente de validation'),
(13, 'test5', 'test', 0, '2024-12-14 19:58:56', '2025-01-13 19:58:56', 50.00, 'Vente', 0, 'sss', 6, 2, 'en attente de validation'),
(14, 'test', 'test', 0, '2024-12-14 20:01:20', '2025-01-03 20:01:20', 50.00, 'Enchere', 0, 'bom', 6, 2, 'en attente de validation'),
(15, 'test', '', 0, '2024-12-14 20:05:02', '2024-12-19 20:05:02', 50.00, 'Enchere', 0, 'test', 6, 2, 'en attente de validation'),
(16, 'test555588', '', 0, '2024-12-14 21:09:40', '2024-12-19 21:09:40', 50.00, 'Enchere', 0, 's', 6, 2, 'en attente de validation'),
(17, 'sss', '', 0, '2024-12-14 22:41:18', '2024-12-19 22:41:18', 50.00, 'Enchere', 0, 'ss', 6, 2, 'en attente de validation'),
(18, 'test', '', 0, '2024-12-15 01:59:13', '2024-12-17 01:59:13', 30.00, 'Enchere', 0, 'test', NULL, 3, 'en attente de validation'),
(19, 'sss', '', 0, '2024-12-15 01:59:41', '2024-12-20 01:59:41', 50.00, 'Enchere', 0, 'ss', NULL, 2, 'en attente de validation'),
(20, 'sss', '', 0, '2024-12-15 02:00:34', '2025-01-14 02:00:34', 50.00, 'Enchere', 0, 'sss', NULL, 3, 'en attente de validation'),
(21, 'sss', '', 0, '2024-12-15 02:00:59', '2024-12-19 02:00:59', 50.00, 'Enchere', 0, 'sss', NULL, 2, 'en attente de validation'),
(22, 'sss', '', 0, '2024-12-15 02:04:00', '2024-12-20 02:04:00', 30.00, 'Vente', 0, 'sss', NULL, 3, 'en attente de validation'),
(23, 'test', '', 0, '2024-12-15 14:53:39', '2024-12-20 14:53:39', 20.00, 'Enchere', 0, 'test', NULL, 2, 'en attente de validation');

-- --------------------------------------------------------

--
-- Structure de la table `oeuvre_images`
--

CREATE TABLE `oeuvre_images` (
  `id_photo` int(11) NOT NULL,
  `chemin_image` varchar(100) DEFAULT NULL,
  `id_oeuvre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `oeuvre_images`
--

INSERT INTO `oeuvre_images` (`id_photo`, `chemin_image`, `id_oeuvre`) VALUES
(1, 'ImageBD/Oeuvre/image_675dd4c34692e2.43883459.png', 10),
(2, 'ImageBD/Oeuvre/image_675dd4c34ce1e9.87412969.png', 10),
(3, 'ImageBD/Oeuvre/image_675dd4c354f065.34977982.png', 10),
(4, 'ImageBD/Oeuvre/image_675dd51e3671c6.99409343.png', 12),
(5, 'ImageBD/Oeuvre/image_675dd51e3e8067.63081218.png', 12),
(6, 'ImageBD/Oeuvre/image_675dd51e45e431.83167278.png', 12),
(7, 'ImageBD/Oeuvre/image_675dd570ef5956.85444746.png', 13),
(8, 'ImageBD/Oeuvre/image_675dd60043bf20.83251527.png', 14),
(9, 'ImageBD/Oeuvre/image_675dd6ded5a550.55231916.png', 15),
(10, 'ImageBD/Oeuvre/image_675de604c0d099.50850953.png', 16),
(11, 'ImageBD/Oeuvre/image_675dfb7e76c805.05592495.png', 17),
(12, 'ImageBD/Oeuvre/image_675e29fd1cf838.61963903.', 19),
(13, 'ImageBD/Oeuvre/image_675e29fd2507e3.50736208.', 19),
(14, 'ImageBD/Oeuvre/image_675e29fd2fd872.23676395.', 19),
(15, 'ImageBD/Oeuvre/image_675e2a320b7271.79659051.png', 20),
(16, 'ImageBD/Oeuvre/image_675e2a4b7d1178.97806146.png', 21),
(17, 'ImageBD/Oeuvre/image_675e2b0002e3b7.59881909.png', 22),
(18, 'ImageBD/Oeuvre/image_675e2b000a4e82.16214707.png', 22),
(19, 'ImageBD/Oeuvre/image_675e2b0011e184.44597221.png', 22),
(20, 'ImageBD/Oeuvre/image_675edf630944b0.85609227.png', 23);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `adresse` varchar(100) DEFAULT NULL,
  `roles` enum('Utilisateur','Admin') DEFAULT 'Utilisateur',
  `mot_de_passe` varchar(100) NOT NULL,
  `date_creation` date NOT NULL,
  `newsletter` tinyint(1) NOT NULL DEFAULT 0,
  `actif` tinyint(1) DEFAULT 0,
  `solde` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `nom`, `prenom`, `email`, `description`, `adresse`, `roles`, `mot_de_passe`, `date_creation`, `newsletter`, `actif`, `solde`) VALUES
(6, 'selvaratnam', 'akash', 'kaladevi549@gmail.com', '', '', 'Admin', '$2y$10$saQYwT.kQu4kvSLRhyNWR.nl8bXuUsJt1dfhnipCqaAZr7XR.ZTdS', '2024-11-26', 0, 1, 0.00),
(7, 'selvaratnam', 'akash', 'kaladevi549@gmail.ju', NULL, NULL, 'Utilisateur', '$2y$10$EMfeaZGsM4pt6A4676gI9u2ox6z4.PE14jaM8IAqXDbuEHwqBj4b2', '2024-11-28', 0, 1, 0.00),
(8, 'selvaratnam', 'akash', 'kaladevi549@gmail.pm', NULL, NULL, 'Utilisateur', '$2y$10$3YzJizisFI1S2EUCiFj0OeNkXgC3oyb2DeWGo4QMsu.QUSYRXI5OK', '2024-11-28', 0, 0, 0.00),
(10, 'selvaratnam', 'akash', 'kaladevi549@gmail.sss', NULL, NULL, 'Utilisateur', '$2y$10$.PR1AYeC0RqSjMi15T734.HhfPTIcgWVbev0krEkhs/l.kFXKahJO', '2024-12-08', 0, 1, 0.00),
(11, 'test', 'test', 'kaladevi549@gmail.ss', NULL, NULL, 'Utilisateur', '$2y$10$8DW5kMsF3FoTpAw3Nv8Yu.vVh5AGacSdGt31CnwilTvoG8SU79BEi', '2024-12-14', 0, 1, 0.00),
(12, 'selvaratnam', 'akash', 'kaladevi549@gmail.fr', NULL, NULL, 'Utilisateur', '$2y$10$NcJTvM4Mx4rsUg6P8dadlODcaFpPg0FjNKB7Gba0ALmccS6YhGoJW', '2024-12-14', 0, 1, 0.00),
(13, 'selvaratnam', 'akash', 'akash.sanchez.232303@gmail.com', NULL, NULL, 'Utilisateur', '$2y$10$5v3l6/C50pKDg1s8gc3Lq.2.P18eTNCgcnnUxY5PAjnwvUQshhIZ.', '2024-12-15', 0, 0, 0.00),
(14, 'selvaratnam', 'akash', 'kaladevi549@gmail.test', NULL, NULL, 'Utilisateur', '$2y$10$goC49551SR7FpPSHrqMMmOB.PMRqQKUKZ407gGBvFZ4p8OxMtjsRm', '2024-12-15', 0, 0, 0.00),
(15, 'selvaratnam', 'akash', 'kaladevi549@gmail.fss', NULL, NULL, 'Utilisateur', '$2y$10$kDabICy3dVktGIkK8QjzPOXgSE4oAqgbcXVppihqdEahBLQTQS9Hm', '2024-12-15', 0, 0, 0.00),
(16, 'selvaratnam', 'akash', 'kristian@gmail.com', NULL, NULL, 'Utilisateur', '$2y$10$X/Q1gHda6DL13hyL4m0z6O1McvjbO9fc4xjGMOoHoy7/MhYxE7Hu.', '2024-12-15', 0, 0, 0.00),
(17, 'selvaratnam', 'akash', 'kaladevi549@gmail.pd', NULL, NULL, 'Utilisateur', '$2y$10$WZLk2nuI8XoRlZv.wnaPmuruf3i1EihqRLsOVpdk8u5xLSLcVYkxG', '2024-12-15', 0, 0, 0.00),
(18, 'selvaratnam', 'akash', 'kalade@sjdj.sd', NULL, NULL, 'Utilisateur', '$2y$10$tECaO.3pXB8W4sfC4qHqs.wIaMXIpkvmD4cszTyvCxATCaF0KUKqi', '2024-12-15', 0, 0, 0.00),
(19, 'selvaratnam', 'akash', 'test@test.test', NULL, NULL, 'Utilisateur', '$2y$10$dwFMjtnoxe4NPSFNRabT2u0R83EwhmKqvHRIfpe5va8U9Rudg/Oqu', '2024-12-15', 0, 0, 0.00),
(20, 'selvaratnam', 'akash', 'test2@test2.com', NULL, NULL, 'Utilisateur', '$2y$10$w2/ZZZJ4/6Dq5nszny/OVOKvOFifX5FVy0QzKBQM6ifM6RI3k1/Yq', '2024-12-15', 0, 0, 0.00),
(21, 'selvaratnam', 'akash', 'test3@test3.ds', NULL, NULL, 'Utilisateur', '$2y$10$wICpYw4T26uoQHlZV5s5KOEYKHX6YNfQy7HxoSK6x1.ETkgWn1nJK', '2024-12-15', 0, 0, 0.00),
(22, 'selvaratnam', 'akash', 'test4@test4.sd', NULL, NULL, 'Utilisateur', '$2y$10$nrsWH7MUjjHomiDQvi4uYepUSvwhiUiyakBYU2oleO9O7TbUVU3im', '2024-12-15', 0, 0, 0.00),
(23, 'selvaratnam', 'akash', 'test5@test5.sdq', NULL, NULL, 'Utilisateur', '$2y$10$Yq3FKOr0R9petsy.q.nOJuDVC07ON7FbDMInxNPU.mCsT5jAXa7XC', '2024-12-15', 0, 0, 0.00),
(24, 'selvaratnam', 'akash', 'kaladevi549@gmail.csss', NULL, NULL, 'Utilisateur', '$2y$10$KgoBkF26LP1o1iQAGJ0T7eD8U2/bKiUX04ZsFURnx6HoAUynme2sm', '2024-12-15', 0, 0, 0.00),
(25, 'test', 'test', 'kaladevi559@gmail.com', NULL, NULL, 'Utilisateur', '$2y$10$IcF91b6iKtRkMaERjlcefO7swQiDFl6ImYTyJM0ry6qQuvGlspCbG', '2024-12-15', 0, 0, 0.00),
(26, 'abidi', 'bb', 'bb@bb.ss', NULL, NULL, 'Utilisateur', '$2y$10$KQZnwu39LE.hkGPdpo2CFOwjsQcrOA3mdZKwJ5nxvYEfaBk4BydpG', '2024-12-15', 0, 1, 0.00);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `code`
--
ALTER TABLE `code`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_user` (`ID_user`);

--
-- Index pour la table `exposition`
--
ALTER TABLE `exposition`
  ADD PRIMARY KEY (`id_exhibition`);

--
-- Index pour la table `exposition_images`
--
ALTER TABLE `exposition_images`
  ADD PRIMARY KEY (`id_exposition_images`);

--
-- Index pour la table `oeuvre`
--
ALTER TABLE `oeuvre`
  ADD PRIMARY KEY (`id_oeuvre`);

--
-- Index pour la table `oeuvre_images`
--
ALTER TABLE `oeuvre_images`
  ADD PRIMARY KEY (`id_photo`),
  ADD KEY `id_oeuvre` (`id_oeuvre`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `code`
--
ALTER TABLE `code`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT pour la table `exposition`
--
ALTER TABLE `exposition`
  MODIFY `id_exhibition` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `exposition_images`
--
ALTER TABLE `exposition_images`
  MODIFY `id_exposition_images` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `oeuvre`
--
ALTER TABLE `oeuvre`
  MODIFY `id_oeuvre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `oeuvre_images`
--
ALTER TABLE `oeuvre_images`
  MODIFY `id_photo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `code`
--
ALTER TABLE `code`
  ADD CONSTRAINT `code_ibfk_1` FOREIGN KEY (`ID_user`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `oeuvre_images`
--
ALTER TABLE `oeuvre_images`
  ADD CONSTRAINT `oeuvre_images_ibfk_1` FOREIGN KEY (`id_oeuvre`) REFERENCES `oeuvre` (`id_oeuvre`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

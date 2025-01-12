-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 07 jan. 2025 à 18:31
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
(100, 773808, '2024-12-15 02:49:50', 26),
(101, 884391, '2024-12-16 10:47:15', 27),
(102, 177880, '2024-12-18 20:06:05', NULL),
(103, 824761, '2024-12-18 20:06:07', NULL),
(104, 233993, '2024-12-18 20:19:54', 6),
(105, 144892, '2024-12-18 20:19:57', 6),
(106, 997893, '2024-12-18 20:57:18', 6),
(107, 853724, '2024-12-18 20:59:21', 6),
(108, 605022, '2024-12-18 21:01:54', NULL),
(109, 326455, '2024-12-18 21:02:58', NULL),
(110, 511791, '2024-12-18 21:04:01', 6),
(111, 225639, '2024-12-18 21:06:09', 6),
(112, 856193, '2024-12-18 21:09:47', 6),
(113, 616136, '2024-12-18 21:11:47', 6),
(114, 393684, '2024-12-18 21:13:25', 6),
(115, 695014, '2024-12-18 21:15:51', 6),
(116, 154130, '2024-12-18 21:23:15', 6),
(117, 259795, '2024-12-18 21:24:38', 6),
(118, 422469, '2024-12-18 21:25:27', 6),
(119, 287325, '2024-12-18 21:26:38', 6),
(120, 289380, '2024-12-18 21:27:40', 6),
(121, 329425, '2024-12-18 21:31:12', 6),
(122, 561740, '2024-12-18 21:34:21', 6),
(123, 425217, '2024-12-18 21:37:03', 28),
(124, 398915, '2024-12-18 21:40:50', 29),
(125, 124576, '2024-12-18 21:43:05', NULL),
(126, 530689, '2024-12-18 21:43:14', NULL),
(127, 361809, '2024-12-18 21:46:28', NULL),
(128, 118962, '2024-12-18 21:47:36', NULL),
(129, 226623, '2024-12-18 21:47:47', 28),
(130, 288439, '2024-12-18 21:48:31', 6),
(131, 103063, '2024-12-18 21:48:42', 6),
(132, 864117, '2024-12-18 21:48:45', 6),
(133, 778411, '2024-12-18 21:50:27', 6),
(134, 245747, '2024-12-18 21:50:39', 6),
(135, 193310, '2024-12-18 21:50:42', 6),
(147, 850630, '2025-01-06 10:10:36', 38),
(148, 665841, '2025-01-06 10:10:40', 38),
(149, 366535, '2025-01-06 20:56:24', 39),
(150, 933538, '2025-01-06 23:00:59', 13),
(151, 645784, '2025-01-06 23:01:01', 13),
(152, 994035, '2025-01-06 23:01:05', 13),
(153, 401683, '2025-01-06 23:02:38', 40);

-- --------------------------------------------------------

--
-- Structure de la table `enchere`
--

CREATE TABLE `enchere` (
  `id_enchere` int(11) NOT NULL,
  `id_oeuvre_enchere` int(11) NOT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  `id_offreur` int(11) DEFAULT NULL,
  `date_enchere` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `enchere`
--

INSERT INTO `enchere` (`id_enchere`, `id_oeuvre_enchere`, `prix`, `id_offreur`, `date_enchere`) VALUES
(4, 48, 50.00, 6, '2022-06-07 00:00:00'),
(5, 48, 55.00, 6, '2022-06-08 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `exposition`
--

CREATE TABLE `exposition` (
  `id_exhibition` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `statut` enum('refuse','en attente de validation','accepte') DEFAULT 'en attente de validation'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `exposition`
--

INSERT INTO `exposition` (`id_exhibition`, `titre`, `description`, `date_debut`, `date_fin`, `user_id`, `statut`) VALUES
(42, 'Autoportrait Van Gogh', 'Autoportrait de Van Gogh réalisé par Van Gogh lui même. Portée vers la droite peinture délicate', '2024-12-25 00:00:00', '2024-12-27 00:00:00', 6, 'accepte'),
(43, 'Exposition Napoléon Bonaparte', 'Tableaux de l\'empereur Napoléon réalisé par les plus grand peintres.', '2024-12-24 00:00:00', '2025-01-02 00:00:00', 6, 'accepte'),
(44, 'Exposition Van Gogh et Napoléon', 'Van Gogh et Napoléon réunis dans un seul et même endroits dans les locaux de Galeris. Venez voir, vous n\'allez pas être déçu.', '2024-12-22 00:00:00', '2024-12-29 00:00:00', 6, 'accepte'),
(45, 'test', 'test de l\'affichage de la map de notre local, a faire absolument', '2024-12-21 00:00:00', '2024-12-27 00:00:00', 6, 'refuse'),
(48, 'sssssssssssssssssssssssssss', 'ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss', '2024-12-29 00:00:00', '2024-12-31 00:00:00', NULL, 'en attente de validation'),
(49, 'sss', 'sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss', '2024-12-28 00:00:00', '2024-12-31 00:00:00', NULL, 'en attente de validation'),
(50, 'ssssssssssssssssssssssssssssssssssss', 'sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss', '2024-12-26 00:00:00', '2024-12-29 00:00:00', 6, 'refuse'),
(51, 's', 'ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss', '2024-12-29 00:00:00', '2024-12-30 00:00:00', 6, 'refuse'),
(52, 'sss', 'ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss', '2024-12-24 00:00:00', '2024-12-29 00:00:00', 6, 'refuse'),
(53, 'sss', 'ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss', '2024-12-24 00:00:00', '2024-12-29 00:00:00', 6, 'refuse'),
(54, 'sss', 'ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss', '2024-12-23 00:00:00', '2024-12-29 00:00:00', 6, 'refuse'),
(55, 'test van gogh', 'sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss', '2025-01-08 00:00:00', '2025-01-16 00:00:00', 6, 'accepte');

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
(26, 'ImageBD/exposition/image_67646aea617c94.34761246.jpeg', 42),
(27, 'ImageBD/exposition/image_67646b63215c10.83545964.jpeg', 43),
(28, 'ImageBD/exposition/image_67646fc7acd891.98112720.jpeg', 44),
(29, 'ImageBD/exposition/image_67646fc7af9037.03153777.jpeg', 44),
(30, 'ImageBD/exposition/image_67647e1e2bd0b0.99199497.jpeg', 45),
(33, 'ImageBD/exposition/image_67684d92ef7c23.68140965.jpeg', 48),
(34, 'ImageBD/exposition/image_6768504ae9f5a2.77346424.jpeg', 49),
(35, 'ImageBD/exposition/image_676850d3bcec46.75551948.jpeg', 50),
(36, 'ImageBD/exposition/image_67685113a6ebd2.21020732.jpeg', 51),
(37, 'ImageBD/exposition/image_676852648ffde4.59232398.jpeg', 52),
(38, 'ImageBD/exposition/image_676852685415c3.78190913.jpeg', 53),
(39, 'ImageBD/exposition/image_6768528db06623.12771135.jpeg', 54),
(40, 'ImageBD/exposition/image_677d3590c71032.45397649.jpeg', 55);

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

CREATE TABLE `favoris` (
  `id_favoris` int(11) NOT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  `id_oeuvre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `favoris`
--

INSERT INTO `favoris` (`id_favoris`, `id_utilisateur`, `id_oeuvre`) VALUES
(1, 38, 59);

-- --------------------------------------------------------

--
-- Structure de la table `livraison`
--

CREATE TABLE `livraison` (
  `id_livraison` int(11) NOT NULL,
  `nom` varchar(200) DEFAULT NULL,
  `prenom` varchar(200) DEFAULT NULL,
  `adresse` varchar(200) DEFAULT NULL,
  `codepostale` varchar(200) DEFAULT NULL,
  `ville` varchar(200) DEFAULT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  `pays` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `livraison`
--

INSERT INTO `livraison` (`id_livraison`, `nom`, `prenom`, `adresse`, `codepostale`, `ville`, `id_utilisateur`, `pays`) VALUES
(3, 'selvaratnam', 'akash', '110 rue brancion 75015 Paris', '75015', 'paris', 6, 'france');

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE `news` (
  `id_news` int(11) NOT NULL,
  `titre` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  `date_news` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `news`
--

INSERT INTO `news` (`id_news`, `titre`, `description`, `id_utilisateur`, `date_news`) VALUES
(4, 'ISEP', 'ISEP a ouvert une cagnotte de plus de 50 000 euros pour l\'ensemble des artiste de rue.', 6, '2025-01-07'),
(5, 'Van Gogh et napoleon', 'Napoléon serait l\'un des plus grand fan de Van Gogh WTF. Vrai ou faux ?', 6, '2025-01-08'),
(6, 'van gogh', 'sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss', 6, '2025-01-07'),
(7, 'Napoleon', 'Lorem ipsum odor amet, consectetuer adipiscing elit. Etiam pellentesque porta elit non venenatis tortor orci pellentesque. Morbi suscipit viverra netus phasellus ipsum. Diam ex faucibus lacinia finibus hendrerit tempor. Consequat posuere porta convallis montes; faucibus semper lobortis laoreet. Interdum parturient duis neque tellus consectetur enim lacus nam. Conubia efficitur metus morbi tristique finibus tristique egestas et. Habitant molestie dui eu cubilia phasellus iaculis convallis; accumsan faucibus. Aptent parturient convallis malesuada scelerisque; dolor adipiscing amet.\n\nSuscipit elementum lectus vitae dui nisi. Fermentum eleifend nisl ex vitae in porttitor taciti blandit praesent. Sociosqu odio eu cursus ligula faucibus. Vivamus sed dapibus, montes parturient posuere sed. Magna mauris etiam enim taciti risus magnis dolor nullam. Senectus nascetur pretium tristique finibus aliquam. Dolor condimentum nisl, primis quisque vitae in fermentum vulputate.\n\nParturient habitant interdum class faucibus; leo iaculis pharetra. Suscipit elit egestas elementum euismod proin eu. Integer praesent risus tristique habitant condimentum integer metus. Sit volutpat morbi dis nascetur, elementum ad ligula porttitor. Cras ut at lacinia malesuada facilisis mauris. Leo posuere finibus accumsan lectus; nunc turpis sollicitudin. Lectus commodo congue auctor cursus conubia volutpat.\n\nUrna vitae ex sociosqu mi auctor purus ut. Dis fermentum elit interdum placerat eu odio. Etiam inceptos tincidunt proin consequat risus class eu suspendisse quam. Ut ridiculus morbi finibus ullamcorper aliquam? Dignissim velit eu vehicula suspendisse mus sociosqu ullamcorper. Consectetur nostra montes, interdum ridiculus nibh interdum. Risus integer dictumst auctor mus turpis. Accumsan dictum egestas urna aliquet, velit viverra rutrum varius. Velit turpis enim faucibus donec molestie dapibus at.\n\nFacilisis montes molestie non porttitor integer mauris himenaeos. Libero nascetur posuere lacus; natoque consequat lorem volutpat mattis. Parturient lectus nullam quam class purus pretium? Pharetra nullam ante bibendum tristique sem mollis nibh imperdiet rutrum. Aliquam lacinia fringilla ante congue sagittis tempus. Rhoncus id sociosqu lectus vitae ultrices ut laoreet? Quisque tellus egestas vel erat efficitur efficitur phasellus. Nibh mus rhoncus aenean at vestibulum ex fermentum.\n\nLacinia arcu adipiscing natoque lobortis dictum. Hendrerit ante ex leo amet, tortor nunc scelerisque fringilla massa. Ad montes aliquet senectus dui eget quis. Netus tristique et nisl phasellus ac pretium feugiat cubilia ac. Non tellus justo iaculis accumsan sit egestas tristique. Vehicula odio nisl per a quis primis phasellus turpis ad. Faucibus parturient scelerisque; odio condimentum felis facilisis ipsum. Dignissim curabitur semper et sociosqu auctor ultrices platea nullam. Scelerisque finibus suscipit nulla; ligula aptent congue lectus aliquam felis. Litora suspendisse aliquam vestibulum odio molestie inceptos mi.\n\nNam vitae auctor lacinia litora condimentum eget netus volutpat. Volutpat non arcu condimentum tincidunt turpis ornare. Nostra rutrum sed turpis ligula metus at? Massa mattis ex; ultrices cras nisi habitant. Est nulla et, inceptos neque ut fusce. Sit a quis vivamus massa tellus. Imperdiet quis libero platea curae nec. Eleifend magnis primis sit dis at viverra suspendisse.\n\nMagna ultricies iaculis velit purus; enim semper curae curae. Magna vitae taciti suscipit donec fusce elit varius sapien libero. Vel maecenas sed elementum sed; cras tortor aliquam ut. Dapibus nullam arcu primis porta est justo morbi ut. Quam mi semper sagittis placerat varius duis mus nullam? Feugiat iaculis curabitur sagittis curabitur tellus? Mollis ipsum mattis tortor nam; eu tincidunt. Ullamcorper lacus libero mauris, ligula pellentesque montes.\n\nVitae nullam platea dis phasellus risus iaculis potenti. Ad dui porttitor fusce est pharetra turpis quam mus. Aptent dolor pulvinar praesent laoreet orci; id auctor. Sapien dapibus posuere torquent sociosqu mattis elit pharetra. Sem vitae rutrum vestibulum curabitur dolor congue viverra primis ante. Egestas nisi eleifend eleifend nec nisl nec. Dolor ac nulla himenaeos at rutrum. Pulvinar cubilia ornare ac commodo himenaeos sit. Orci placerat tincidunt blandit; lacinia auctor nulla donec a nisi.\n\nEuismod fringilla euismod fringilla dignissim ante odio phasellus. Curabitur aliquet cras sit habitasse in potenti erat est. Habitant phasellus mauris litora non mus condimentum, bibendum quis. Finibus posuere proin massa sagittis interdum. Amet viverra ullamcorper a sociosqu sollicitudin penatibus luctus a. Porta sagittis aenean vehicula eros posuere nostra. Nullam nostra nunc; porta eu sem et condimentum. Per habitant erat penatibus hendrerit in penatibus lectus felis accumsan? Turpis a inceptos litora fermentum amet cubilia quisque.\n\nNatoque fusce nulla natoque proin quam; scelerisque ligula dictum neque. Ultrices facilisis mus a vestibulum; lectus at etiam lacus. Dictum hac ante interdum volutpat fringilla! Sit nunc iaculis gravida netus maecenas vitae risus. Condimentum faucibus praesent egestas penatibus ad. Turpis primis amet adipiscing nibh lacus? Ac neque feugiat netus tempus faucibus pellentesque est mi. Orci blandit magna, est maximus feugiat himenaeos integer sit.\n\nNascetur venenatis curabitur dis ad dis, consequat sed. Posuere auctor velit nunc lobortis nisi adipiscing aptent tincidunt. Conubia felis amet et arcu platea nisl. Ut sit quis lacinia natoque aliquet imperdiet sociosqu fermentum sit. Litora tellus leo torquent urna torquent justo conubia odio. Feugiat vestibulum nascetur mus senectus efficitur tortor. Ultrices feugiat integer vivamus fames maximus tortor.\n\nLaoreet metus dui taciti leo quis semper. Velit interdum neque pharetra eleifend vel laoreet suscipit. Malesuada feugiat platea maecenas tristique posuere porta vitae maximus. Venenatis congue aliquam nec nostra ipsum mollis malesuada primis. Fusce magnis massa dictumst in nullam mauris. Dapibus ornare nec viverra maximus morbi erat penatibus. Nunc finibus rutrum justo faucibus cursus rutrum finibus. Quis etiam torquent amet, in non in?\n\nMetus adipiscing suspendisse, velit egestas odio sit cursus. Nullam ex scelerisque lectus nostra sollicitudin eget. Eget tempor finibus nibh enim risus iaculis ex lobortis mauris. Accumsan consectetur enim fames molestie; accumsan ut sem. Sapien nam consectetur orci erat magnis class aliquet. Class augue donec vestibulum posuere vulputate; ultricies eleifend netus. Gravida montes et diam rutrum tempus enim vehicula est nisi.\n\nAccumsan ullamcorper porttitor ante at amet senectus mollis quis. Euismod ultrices class sociosqu viverra odio inceptos dignissim. Facilisis justo hendrerit sociosqu egestas dignissim. Nisl mus enim varius consectetur placerat. Nascetur scelerisque quis ante; mattis odio duis elementum. Blandit mollis interdum vitae ante pellentesque ut.\n\nSapien viverra suspendisse velit non sem. Auctor auctor a sem odio dapibus. Bibendum dapibus justo adipiscing; rutrum enim tempus. Odio ligula viverra nostra enim litora. Aptent at praesent nulla auctor mattis urna enim per. Commodo vehicula at est convallis interdum curae. Himenaeos laoreet eleifend gravida libero pharetra augue commodo. Lobortis magna cursus consectetur nisl ullamcorper felis consequat mattis vestibulum.\n\nCongue sit maximus fames amet pharetra cras interdum ante donec. Diam lacus tellus nostra vestibulum netus tellus imperdiet. At tempus mus placerat volutpat lobortis vulputate dapibus maecenas. Sociosqu dignissim posuere maecenas sociosqu sed etiam nascetur. Phasellus imperdiet nisl consectetur imperdiet potenti. Velit arcu placerat quam pulvinar aliquet ultricies nisi. Duis fusce euismod aliquam elit felis mauris neque felis. Tempor tortor tincidunt; facilisis sagittis integer phasellus. Inceptos rutrum diam gravida amet id faucibus mus accumsan.\n\nUltricies suscipit elementum pellentesque risus urna dignissim. Netus ac cursus et primis magna faucibus. Mauris odio urna penatibus maximus aenean cras. Nunc placerat et lacinia condimentum laoreet dui hendrerit facilisis. Nulla morbi netus neque euismod volutpat nam praesent. Arcu gravida curabitur lacinia metus nisi elit fermentum ut. Ullamcorper ultricies viverra; finibus porttitor suspendisse odio. Molestie iaculis felis integer; proin cubilia parturient magnis feugiat arcu. Eleifend potenti lacus fermentum, ultrices tincidunt magna.\n\nAugue fermentum nullam pharetra sociosqu, eleifend magna curabitur nostra. Blandit class pharetra montes congue dui. Quisque viverra ut pharetra suspendisse lobortis varius tristique primis magnis. Netus est orci porttitor, vivamus porta porttitor torquent massa. Quisque maximus nunc, ex parturient dis quisque turpis. Dictum velit vivamus semper dis laoreet etiam nisi eget rhoncus. Malesuada taciti vitae tempus amet, nunc tempor taciti feugiat.\n\nVenenatis placerat praesent, facilisi tempor velit pulvinar. Dis justo libero neque penatibus quis inceptos tristique proin. Ligula parturient proin tincidunt rutrum sociosqu. Litora fringilla aliquam torquent praesent fames finibus magnis pharetra suspendisse. Mi turpis tellus nullam vestibulum velit aptent libero facilisi. Tortor parturient semper ullamcorper nunc platea. Dictum aptent placerat eu cursus facilisi ridiculus. Finibus vivamus elit quis at parturient consectetur. Feugiat class ac blandit est per venenatis arcu quisque nascetur.', 6, '2025-01-07');

-- --------------------------------------------------------

--
-- Structure de la table `news_images`
--

CREATE TABLE `news_images` (
  `id_news_images` int(11) NOT NULL,
  `chemin_image` text DEFAULT NULL,
  `id_news` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `news_images`
--

INSERT INTO `news_images` (`id_news_images`, `chemin_image`, `id_news`) VALUES
(1, 'ImageBD/news/image_677d2203bc8ad5.47530439.png', 1),
(2, 'ImageBD/news/image_677d22650b1a46.81117357.png', 2),
(3, 'ImageBD/news/image_677d22d86ec7c8.59535952.png', 3),
(4, 'ImageBD/news/image_677d28ce828c53.13949482.png', 4),
(5, 'ImageBD/news/image_677d2980b285d7.71501341.jpeg', 5),
(6, 'ImageBD/news/image_677d2980b7b465.87797676.jpeg', 5),
(7, 'ImageBD/news/image_677d598a9daac5.44108566.jpeg', 6),
(8, 'ImageBD/news/image_677d59b0dab212.54180355.jpeg', 7);

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
(34, 'Tableau Paysage', 'Cette œuvre reflète l’imagination débordante de l’artiste, mêlant subtilement couleurs et textures pour offrir une vision unique. Elle invite le spectateur à explorer un univers captivant, riche en émotions, où chaque détail raconte une histoire et inspire à la contemplation.', 0, '2024-12-16 10:03:59', '2025-01-15 10:03:59', 50.00, 'Vente', 1, 'Hugo Marchal', 27, 2, 'accepte'),
(35, 'Paysage d\'antan ', 'Cette œuvre reflète l’imagination débordante de l’artiste, mêlant subtilement couleurs et textures pour offrir une vision unique. Elle invite le spectateur à explorer un univers captivant, riche en émotions, où chaque détail raconte une histoire et inspire à la contemplation.', 0, '2024-12-16 10:04:41', '2025-01-15 10:04:41', 58.00, 'Vente', 1, 'Emma Lavaux', 27, 2, 'accepte'),
(36, 'Petite sculpture en pierre ', 'Cette œuvre reflète l’imagination débordante de l’artiste, mêlant subtilement couleurs et textures pour offrir une vision unique. Elle invite le spectateur à explorer un univers captivant, riche en émotions, où chaque détail raconte une histoire et inspire à la contemplation.', 0, '2024-12-16 10:05:33', '2025-01-15 10:05:33', 100.00, 'Vente', 0, 'Emma Lobineau', 27, 3, 'accepte'),
(37, 'Maison d\'enfance ', 'Cette œuvre reflète l’imagination débordante de l’artiste, mêlant subtilement couleurs et textures pour offrir une vision unique. Elle invite le spectateur à explorer un univers captivant, riche en émotions, où chaque détail raconte une histoire et inspire à la contemplation.', 0, '2024-12-16 10:06:16', '2025-01-15 10:06:16', 75.00, 'Vente', 1, 'Léa Garnier ', 27, 2, 'accepte'),
(38, 'Naturel', 'Cette œuvre reflète l’imagination débordante de l’artiste, mêlant subtilement couleurs et textures pour offrir une vision unique. Elle invite le spectateur à explorer un univers captivant, riche en émotions, où chaque détail raconte une histoire et inspire à la contemplation.', 0, '2024-12-16 10:06:46', '2025-01-15 10:06:46', 100.00, 'Vente', 1, 'Léa Garnier ', 27, 2, 'accepte'),
(39, 'l\'art pour tous', 'wow quelle oeuvre achetez ça me fait plaisir. Oh Oh Oh', 0, '2024-12-17 21:00:26', '2025-01-06 21:00:26', 50.00, 'Vente', 1, 'Boner', 6, 2, 'accepte'),
(44, 'test', 'tetstettetststetststetetstetetetstetetstetetstet', 0, '2024-12-20 09:20:38', '2025-01-09 09:20:38', 50.00, 'Enchere', 0, 'jean', 6, 2, 'refuse'),
(47, 'Solution du blocage de port', 'Pour une enchère débutant à 50 euros, je deviens prof pour savoir comment gérer les exceptions/erreurs sur Xampp. A vos marques prêts partez.', 0, '2024-12-24 15:30:05', '2024-12-24 15:35:05', 50.00, 'Enchere', 0, 'Akash Selvaratnam', 6, 3, 'accepte'),
(48, 'Vente oeuvre Van Gogh', 'Enchères des tableaux de Van Gogh Achetez svp j\'ai pas beaucoup d\'argent', 0, '2024-12-29 14:29:26', '2024-12-30 14:29:26', 30.00, 'Enchere', 1, 'Van Gogh', 6, 2, 'accepte'),
(49, 'test', 'sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss', 0, '2024-12-29 14:40:37', '2025-01-28 14:40:37', 30.00, 'Vente', 1, 'test', 6, 2, 'accepte'),
(51, 'ssssssssssssssssssssss', 'ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss', 0, '2024-12-29 16:40:11', '2025-01-28 16:40:11', 50.00, 'Vente', 1, 'ssssss', 6, 2, 'accepte'),
(52, 'test_enchere', 'eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', 0, '2024-12-30 17:53:26', '2025-01-29 17:53:26', 50.00, 'Enchere', 0, 'benjamin', 6, 2, 'accepte'),
(55, 'test-mail-paiement', 'paiement test ssssssssssssssssssssssssssssssssssssssssssss', 0, '2024-12-31 17:22:30', '2025-01-20 17:22:30', 100.00, 'Vente', 1, 'test', 6, 2, 'accepte'),
(56, 'napoleon', 'napoleon bonaparte nous vend son tableau le plus precieux', 0, '2024-12-31 17:27:26', '2025-01-25 17:27:26', 100.00, 'Vente', 1, 'nap', 6, 2, 'accepte'),
(57, 'test_enchere', 'Test de mon enchère avec un prix de depart à 10 euros', 0, '2024-12-31 17:50:13', '2024-12-31 17:50:13', 50.00, 'Enchere', 1, 'benjamin', 6, 2, 'accepte'),
(58, 'van goghe', 'enchere van goghee aya aya aya ta ta ta tam tam tam', 0, '2024-12-31 17:58:59', '2024-12-31 17:58:59', 50.00, 'Enchere', 1, 'benjamin', 6, 2, 'accepte'),
(59, 'Van gogh', 'vente de van gogh au prix le plus bas du marché. acheter', 0, '2024-12-31 18:03:37', '2025-01-10 18:03:37', 100.00, 'Vente', 0, 'Van gogh', 6, 2, 'accepte'),
(61, 'Napoleon', 'Napoleon, un tableau réalisé par Bonaparte, une main de maitre jamais égalé', 0, '2024-12-31 18:05:48', '2025-01-02 18:05:48', 50.00, 'Vente', 0, 'Le Bonaparte', 6, 2, 'accepte'),
(62, 'test', 'testetetseteteteteteeteteteteteteteteeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', 0, '2025-01-07 15:06:53', '2025-01-17 15:06:53', 50.00, 'Vente', 0, 'benjamin', 6, 2, 'accepte'),
(63, 'test_enchere', 'sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss', 0, '2025-01-07 15:08:39', '2025-01-27 15:08:39', 50.00, 'Vente', 0, 'benjamin', 6, 2, 'accepte'),
(64, 'vng', 'ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss', 0, '2025-01-07 15:09:54', '2025-01-17 15:09:54', 50.00, 'Vente', 0, 'vng', 6, 2, 'accepte');

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
(33, 'ImageBD/Oeuvre/image_675fecff445a41.97423138.png', 34),
(34, 'ImageBD/Oeuvre/image_675fecff4b7969.61541123.png', 34),
(35, 'ImageBD/Oeuvre/image_675fed29d7ed16.67414203.png', 35),
(38, 'ImageBD/Oeuvre/image_675feda6e9a416.81705887.png', 38),
(39, 'ImageBD/Oeuvre/image_6761d85ac85a51.58806564.png', 39),
(40, 'ImageBD/Oeuvre/image_6761d85ad06e69.37601475.jpeg', 39),
(45, 'ImageBD/Oeuvre/image_676528d628d778.30804993.jpeg', 44),
(48, 'ImageBD/Oeuvre/image_676ac56e00d2b1.36771869.png', 47),
(49, 'ImageBD/Oeuvre/image_67714eb6d5aad8.17266380.jpeg', 48),
(50, 'ImageBD/Oeuvre/image_67714eb6dbc1e1.18266037.jpeg', 48),
(51, 'ImageBD/Oeuvre/image_677151559b8931.94486066.jpeg', 49),
(53, 'ImageBD/Oeuvre/image_67716d5b357633.81323832.jpeg', 51),
(54, 'ImageBD/Oeuvre/image_6772d0064d7b41.22725957.jpeg', 52),
(58, 'ImageBD/Oeuvre/image_67741a46b52cc5.46339575.jpeg', 55),
(59, 'ImageBD/Oeuvre/image_67741b6e1064c0.77963486.jpeg', 56),
(60, 'ImageBD/Oeuvre/image_677420c52fcfa7.23079096.jpeg', 57),
(61, 'ImageBD/Oeuvre/image_677422d3b74222.09770159.jpeg', 58),
(62, 'ImageBD/Oeuvre/image_677423e991d264.85088622.jpeg', 59),
(64, 'ImageBD/Oeuvre/image_6774246c43ebc3.22438674.jpeg', 61),
(65, 'ImageBD/Oeuvre/image_677d34fd8a2474.22187134.jpeg', 62),
(66, 'ImageBD/Oeuvre/image_677d3567726541.69828845.jpeg', 63),
(67, 'ImageBD/Oeuvre/image_677d35b2d03620.52262699.jpeg', 64);

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id_panier` int(11) NOT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  `id_oeuvre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(6, 'selvaratnam', 'akash', 'kaladevi549@gmail.com', '', '', 'Admin', '$2y$10$lk08IJsZy7Oivka/WgY.pOLqDqnPhCtCs4sDqMY3KmkzPv57IDwm6', '2024-11-26', 1, 1, 1240.00),
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
(26, 'abidi', 'bb', 'bb@bb.ss', NULL, NULL, 'Utilisateur', '$2y$10$KQZnwu39LE.hkGPdpo2CFOwjsQcrOA3mdZKwJ5nxvYEfaBk4BydpG', '2024-12-15', 0, 1, 0.00),
(27, 'Pierret ', 'Jules', 'jupi63473@eleve.isep.fr', NULL, NULL, 'Utilisateur', '$2y$10$mhdJtYwHue6QyA0O8xouH.2oDTekGIC1GEf1M7P5JT3zUqO1AynlK', '2024-12-16', 0, 0, 283.00),
(28, 'selvaratnam', 'akash', 'larrykala@hotmail.fr', NULL, NULL, 'Utilisateur', '$2y$10$Upt78gmC9Qs5YtLrRAcCz.B4jcDdMbRgu.9UWz7IePanIsZ3nKVHS', '2024-12-18', 0, 1, 0.00),
(29, 'selvaratnam', 'akash', 'kaladevi549@gmail.sjsj', NULL, NULL, 'Utilisateur', '$2y$10$NgMyTRBFYFM5kKj6H.CEHednJtmRdfYN5M5yt00ZR8ZgduYiTDg3S', '2024-12-18', 0, 0, 0.00),
(38, 'selvaratnam', 'akash', 'akse63476@eleve.isep.fr', NULL, NULL, 'Utilisateur', '$2y$10$ChFmNGsx.fBocM3XdjjEJeNFY6hDpxfwd.qiTcAP3wtPejtzHDAzq', '2025-01-06', 0, 1, 0.00),
(39, 'selvaratnam', 'akash', 'sss@ssms.ss', NULL, NULL, 'Utilisateur', '$2y$10$iOxS1A7ugBNINWQGq15Uv.eGZP7LCmPZXQU0ELMipuFT0SoNPZrHe', '2025-01-06', 0, 0, 0.00),
(40, 'selvaratnam', 'akash', 'kaladevi549@gmail.cos', NULL, NULL, 'Utilisateur', '$2y$10$fOsSPA5qILMGULxtOlkiGOuruEMqN8Rtdet3ncDjXHkHfZeqttbYe', '2025-01-06', 0, 0, 0.00);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_image`
--

CREATE TABLE `utilisateur_image` (
  `id_photo` int(11) NOT NULL,
  `chemin_image` varchar(100) DEFAULT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur_image`
--

INSERT INTO `utilisateur_image` (`id_photo`, `chemin_image`, `id_utilisateur`) VALUES
(1, 'ImageBD/Profil/test1.png', 27),
(19, 'ImageBD/Profil/profile_6777f350840a70.32925958.png', 38),
(22, 'ImageBD/Profil/profile_67781f6dd261b9.43026680.jpg', 6);

-- --------------------------------------------------------

--
-- Structure de la table `vente`
--

CREATE TABLE `vente` (
  `id_vente` int(11) NOT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  `Date_vente` datetime DEFAULT current_timestamp(),
  `Type_vente` enum('vente','enchere') DEFAULT 'vente',
  `id_oeuvre` int(11) DEFAULT NULL,
  `id_utilisateur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `vente`
--

INSERT INTO `vente` (`id_vente`, `prix`, `Date_vente`, `Type_vente`, `id_oeuvre`, `id_utilisateur`) VALUES
(36, 50.00, '2024-12-30 18:27:42', 'vente', 48, 6),
(37, 55.00, '2024-12-30 18:27:42', 'vente', 48, 6),
(38, 50.00, '2024-12-30 18:29:02', 'vente', 48, 6),
(39, 55.00, '2024-12-30 18:29:02', 'vente', 48, 6),
(40, 50.00, '2024-12-30 18:29:25', 'vente', 48, 6),
(41, 55.00, '2024-12-30 18:30:10', 'vente', 48, 6),
(42, 55.00, '2024-12-30 18:35:15', 'vente', 48, 6),
(43, 55.00, '2024-12-30 18:39:02', 'vente', 48, 6),
(44, 55.00, '2024-12-30 18:42:17', 'vente', 48, 6),
(45, 50.00, '2024-12-31 15:57:48', 'vente', 51, 6),
(46, 30.00, '2024-12-31 16:11:57', 'vente', 49, 6),
(47, 100.00, '2024-12-31 17:23:38', 'vente', 55, 37),
(48, 100.00, '2024-12-31 17:28:39', 'vente', 56, 37),
(49, 55.00, '2024-12-31 17:54:02', 'vente', 57, 37),
(50, 55.00, '2024-12-31 18:02:02', 'vente', 58, 37);

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
-- Index pour la table `enchere`
--
ALTER TABLE `enchere`
  ADD PRIMARY KEY (`id_enchere`),
  ADD KEY `id_utilisateur` (`id_offreur`),
  ADD KEY `id_oeuvre_enchere` (`id_oeuvre_enchere`) USING BTREE;

--
-- Index pour la table `exposition`
--
ALTER TABLE `exposition`
  ADD PRIMARY KEY (`id_exhibition`);

--
-- Index pour la table `exposition_images`
--
ALTER TABLE `exposition_images`
  ADD PRIMARY KEY (`id_exposition_images`),
  ADD KEY `id_exposition` (`id_exposition`);

--
-- Index pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD PRIMARY KEY (`id_favoris`),
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `id_oeuvre` (`id_oeuvre`);

--
-- Index pour la table `livraison`
--
ALTER TABLE `livraison`
  ADD PRIMARY KEY (`id_livraison`);

--
-- Index pour la table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id_news`);

--
-- Index pour la table `news_images`
--
ALTER TABLE `news_images`
  ADD PRIMARY KEY (`id_news_images`);

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
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id_panier`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `utilisateur_image`
--
ALTER TABLE `utilisateur_image`
  ADD PRIMARY KEY (`id_photo`),
  ADD KEY `fk_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `vente`
--
ALTER TABLE `vente`
  ADD PRIMARY KEY (`id_vente`);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT pour la table `enchere`
--
ALTER TABLE `enchere`
  MODIFY `id_enchere` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `exposition`
--
ALTER TABLE `exposition`
  MODIFY `id_exhibition` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT pour la table `exposition_images`
--
ALTER TABLE `exposition_images`
  MODIFY `id_exposition_images` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `favoris`
--
ALTER TABLE `favoris`
  MODIFY `id_favoris` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `livraison`
--
ALTER TABLE `livraison`
  MODIFY `id_livraison` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `news`
--
ALTER TABLE `news`
  MODIFY `id_news` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `news_images`
--
ALTER TABLE `news_images`
  MODIFY `id_news_images` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `oeuvre`
--
ALTER TABLE `oeuvre`
  MODIFY `id_oeuvre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT pour la table `oeuvre_images`
--
ALTER TABLE `oeuvre_images`
  MODIFY `id_photo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id_panier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `utilisateur_image`
--
ALTER TABLE `utilisateur_image`
  MODIFY `id_photo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `vente`
--
ALTER TABLE `vente`
  MODIFY `id_vente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `code`
--
ALTER TABLE `code`
  ADD CONSTRAINT `code_ibfk_1` FOREIGN KEY (`ID_user`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `enchere`
--
ALTER TABLE `enchere`
  ADD CONSTRAINT `FK_oeuvre_enchere` FOREIGN KEY (`id_oeuvre_enchere`) REFERENCES `oeuvre` (`id_oeuvre`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `exposition_images`
--
ALTER TABLE `exposition_images`
  ADD CONSTRAINT `exposition_images_ibfk_1` FOREIGN KEY (`id_exposition`) REFERENCES `exposition` (`id_exhibition`);

--
-- Contraintes pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD CONSTRAINT `favoris_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE,
  ADD CONSTRAINT `favoris_ibfk_2` FOREIGN KEY (`id_oeuvre`) REFERENCES `oeuvre` (`id_oeuvre`) ON DELETE CASCADE;

--
-- Contraintes pour la table `oeuvre_images`
--
ALTER TABLE `oeuvre_images`
  ADD CONSTRAINT `FK_oeuvre_images` FOREIGN KEY (`id_oeuvre`) REFERENCES `oeuvre` (`id_oeuvre`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

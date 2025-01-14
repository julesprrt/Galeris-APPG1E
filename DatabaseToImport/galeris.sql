-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 14 jan. 2025 à 17:50
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
(147, 397944, '2025-01-14 17:45:51', 38);

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
(55, 'Exposition sur La Joconde de Léonard de Vinci', 'L’exposition immersive “La Joconde” est une expérience interactive et sensorielle qui permet aux visiteurs de redécouvrir le célèbre tableau de Léonard de Vinci. Cette exposition propose une approche innovante pour comprendre et apprécier ce tableau mythique.', '2025-01-15 00:00:00', '2025-01-27 00:00:00', 38, 'accepte'),
(56, 'Exposition Vincent Van Gogh - Un style unique', 'Cette expérience immersive propose une nouvelle façon de découvrir l’œuvre de Van Gogh. Les visiteurs peuvent plonger dans les chefs-d’œuvre de l’artiste grâce à des projections numériques à 360 degrés, des effets sonores et du mapping vidéo.', '2025-01-15 00:00:00', '2025-01-27 00:00:00', 38, 'accepte'),
(57, 'Exposition sur Gustave Courbet', 'Cette exposition met en lumière l’ensemble de l’œuvre de Courbet, des années 1840 à 1877, en réunissant cent vingt peintures, une trentaine d’œuvres graphiques et environ soixante photographies. Elle souligne la richesse et la complexité de son œuvre, ainsi que ses liens avec la réalité sociale et politique de son époque.', '2025-01-15 00:00:00', '2025-01-27 00:00:00', 38, 'accepte'),
(58, 'Exposition sur Rembrandt', 'Cette exposition présente une vingtaine de tableaux et une trentaine d’œuvres graphiques de Rembrandt. Elle met en lumière les multiples facettes de l’artiste, en confrontant ses tableaux à ses œuvres contemporaines.', '2025-01-15 00:00:00', '2025-01-27 00:00:00', 38, 'accepte'),
(59, 'Exposition sur Diego Velasquez', 'Cette exposition présente un panorama complet de son œuvre, incluant des portraits, des paysages et des peintures d’histoire, et met son œuvre en dialogue avec des toiles d’artistes de son temps.', '2025-01-15 00:00:00', '2025-01-27 00:00:00', 38, 'accepte');

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
(40, 'ImageBD/exposition/image_67868e94066fb9.40942203.png', 55),
(41, 'ImageBD/exposition/image_678690f938b485.37735221.png', 56),
(42, 'ImageBD/exposition/image_678690f93a4490.66956244.jpeg', 56),
(43, 'ImageBD/exposition/image_678690f9418000.84141612.png', 56),
(44, 'ImageBD/exposition/image_678692773b6573.89268625.png', 57),
(45, 'ImageBD/exposition/image_6786934eb96de6.85994061.png', 58),
(46, 'ImageBD/exposition/image_678693d78dbae6.19562655.png', 59);

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

CREATE TABLE `favoris` (
  `id_favoris` int(11) NOT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  `id_oeuvre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(8, 'La Vente du Siècle : “Le Cri\"', 'Dans les salles feutrées de la maison de ventes aux enchères les plus prestigieuse de Paris, un événement allait secouer le monde de l’art. “Le Cri”, un tableau attribué au génial Edvard Munch, a été vendu aux enchères, attirant ainsi l’attention de collectionneurs et de mécènes du monde entier.', 38, '2025-01-14');

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
(9, 'ImageBD/news/image_6786953dc90c08.04367014.png', 8);

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
(62, 'Arrangement en gris et noir n°1', 'Réalisée en 1871. Huile sur toile, également connue sous le nom de “Portrait de la mère de l’artiste”, représentant Anna Mathilda Whistler, la mère de l’artiste, assise de profil sur une chaise.', 0, '2025-01-14 16:49:16', '2025-02-03 16:49:16', 50000.00, 'Vente', 0, 'James Abbott McNeill Whistler', 38, 2, 'accepte'),
(63, 'Autoportrait au chapeau', 'Van Gogh a peint cet autoportrait lors de son séjour à Paris entre 1886 et 1888, faisant partie d’une série de 24 autoportraits qu’il a réalisés à cette période. Il est représenté portant un chapeau de paille à large bord, ce qui souligne son lien avec la nature et la simplicité rurale.', 0, '2025-01-14 16:54:40', '2025-02-04 16:54:40', 100000.00, 'Vente', 0, 'Vincent Van Gogh', 38, 2, 'accepte'),
(65, 'Impression soleil levant', 'Créée en 1872, cette huile sur toile de 50 x 65 cm représente le lever du soleil sur le port industriel du Havre, peint depuis la fenêtre de Monet dans une chambre d’hôtel située sur le Grand Quai.', 0, '2025-01-14 17:04:39', '2025-02-05 17:04:39', 180000.00, 'Vente', 0, 'Claude Monet', 38, 2, 'accepte'),
(66, 'La Cène', 'Peinte entre 1495 et 1498, cette œuvre célèbre est située dans l’église Santa Maria delle Grazie à Milan, en Italie. La fresque mesure 460 × 880 cm et représente le dernier repas de Jésus avec ses douze apôtres, un moment où Jésus annonce qu’un d’entre eux le trahira.', 0, '2025-01-14 17:08:08', '2025-02-06 17:08:08', 1000000.00, 'Vente', 0, 'Léonard de Vinci', 38, 2, 'accepte'),
(67, 'La jeune fille à la perle', 'Peint vers 1665. La toile mesure 44,5 x 39 cm. Au centre de l’œuvre se détache une jeune fille, peut-être adolescente, sur un fond sombre. Il s’agirait non pas d’un fond noir comme on l’a longtemps cru, mais d’un rideau vert.', 0, '2025-01-14 17:13:20', '2025-02-07 17:13:20', 200000.00, 'Vente', 0, 'Johannes Vermeer', 38, 2, 'accepte');

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
(65, 'ImageBD/Oeuvre/image_6786877ccc8909.95478143.png', 62),
(66, 'ImageBD/Oeuvre/image_678688c00fc853.27094730.jpeg', 63),
(67, 'ImageBD/Oeuvre/image_678689c2174b87.90603637.jpeg', 64),
(68, 'ImageBD/Oeuvre/image_67868b17045fb3.03968393.png', 65),
(69, 'ImageBD/Oeuvre/image_67868be8a71cf5.00543938.png', 66),
(70, 'ImageBD/Oeuvre/image_67868d20bba429.95169844.png', 67);

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
(38, 'Admin', 'Gabriel', 'gabrielelmohtassem2@gmail.com', NULL, NULL, 'Admin', '$2y$10$4yGn76Cc0neSV8LuBZwXW.p.91L1iTbHYK.vk/Pq6Be3kCZqyaKFO', '2025-01-14', 0, 1, 0.00);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_image`
--

CREATE TABLE `utilisateur_image` (
  `id_photo` int(11) NOT NULL,
  `chemin_image` varchar(100) DEFAULT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT pour la table `enchere`
--
ALTER TABLE `enchere`
  MODIFY `id_enchere` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `exposition`
--
ALTER TABLE `exposition`
  MODIFY `id_exhibition` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT pour la table `exposition_images`
--
ALTER TABLE `exposition_images`
  MODIFY `id_exposition_images` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT pour la table `favoris`
--
ALTER TABLE `favoris`
  MODIFY `id_favoris` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `livraison`
--
ALTER TABLE `livraison`
  MODIFY `id_livraison` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `news`
--
ALTER TABLE `news`
  MODIFY `id_news` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `news_images`
--
ALTER TABLE `news_images`
  MODIFY `id_news_images` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `oeuvre`
--
ALTER TABLE `oeuvre`
  MODIFY `id_oeuvre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT pour la table `oeuvre_images`
--
ALTER TABLE `oeuvre_images`
  MODIFY `id_photo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id_panier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

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
-- Contraintes pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD CONSTRAINT `favoris_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE,
  ADD CONSTRAINT `favoris_ibfk_2` FOREIGN KEY (`id_oeuvre`) REFERENCES `oeuvre` (`id_oeuvre`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 03 jan. 2025 à 18:34
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
(5, 48, 55.00, 6, '2022-06-08 00:00:00'),
(9, 52, 55.00, 37, '2024-12-31 17:38:59'),
(10, 57, 55.00, 37, '2024-12-31 17:51:05'),
(11, 58, 55.00, 37, '2024-12-31 17:59:56');

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
(1, 'ImageBD/exposition/La-Ronde-de-nuit-Rembrandt.png', 1),
(2, 'ImageBD/exposition/La-Tour-de-Babel-Bruegel-lancien.png', 2),
(3, 'ImageBD/exposition/LAbsinthe-Edgar-Degas.png', 3),
(4, 'ImageBD/exposition/Le-cri-Edvard-Munch.png', 4),
(5, 'ImageBD/exposition/Le-dejeuner-Claude-Monet.png', 5),
(6, 'ImageBD/exposition/Le-Desespere-Gustave-Courbet.png', 6),
(7, 'ImageBD/exposition/Le-Radeau-de-la-Meduse.png', 7),
(8, 'ImageBD/exposition/Lecole-dAthenes-Raphael.png', 8),
(9, 'ImageBD/exposition/LEnlevement-des-Sabines-Nicolas-Poussin.png', 9),
(10, 'ImageBD/exposition/Les-Joueurs-de-Cartes-Paul-Cezanne.png', 10),
(11, 'ImageBD/exposition/Les-Menines-Diego-Velazquez.png', 11),
(12, 'ImageBD/exposition/Les-Saisons-Giusepe-Arcimboldo.png', 12),
(13, 'ImageBD/exposition/Les-Tournesols-Van-Gogh.png', 13),
(14, 'ImageBD/exposition/Portrait-louis-XIV.png', 14),
(15, 'ImageBD/exposition/Terrasse-du-cafe-le-soir-Van-Gogh.png', 15),

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
(1, 'ImageBD/Oeuvre/Arrangement-en-gris-et-noir-n1-McNeil-Whistler.png', 1),
(2, 'ImageBD/Oeuvre/autoportrait-VanGogh.jpeg', 2),
(3, 'ImageBD/Oeuvre/Bonaparte-SaintGermain.jpeg', 3),
(4, 'ImageBD/Oeuvre/Composition-II-en-rouge-bleu-et-jaune-Piet-Mondrian.png', 4),
(5, 'ImageBD/Oeuvre/Des-Glaneuses-Jean-Francois-Millet.png', 5),
(6, 'ImageBD/Oeuvre/Guernica-Pablo-Picasso.png', 6),
(7, 'ImageBD/Oeuvre/Impression-soleil-levant-claude-monet.png', 7),
(8, 'ImageBD/Oeuvre/la_joconde_leonard_de_vinci.png', 8),
(9, 'ImageBD/Oeuvre/La-Cene-Leonard-de-Vinci.png', 9),
(10, 'ImageBD/Oeuvre/La-Creation-dAdam-Michel-Ange.png', 10),
(11, 'ImageBD/Oeuvre/La-Grande-Vague-de-Kanagawa-Katsuhika-Hokusai.png', 11),
(12, 'ImageBD/Oeuvre/La-Jeune-Fille-a-la-perle.png', 12),
(13, 'ImageBD/Oeuvre/La-Liberte-guidant-le-peuple-Delacroix.png', 13),
(14, 'ImageBD/Oeuvre/La-mort-de-Socrate-Jacques-Louis-David.png', 14),
(15, 'ImageBD/Oeuvre/La-Nuit-etoilee-Van-Gogh-.png', 15),

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id_panier` int(11) NOT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  `id_oeuvre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `panier`
--


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
-- Index pour la table `livraison`
--
ALTER TABLE `livraison`
  ADD PRIMARY KEY (`id_livraison`);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT pour la table `enchere`
--
ALTER TABLE `enchere`
  MODIFY `id_enchere` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `exposition`
--
ALTER TABLE `exposition`
  MODIFY `id_exhibition` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT pour la table `exposition_images`
--
ALTER TABLE `exposition_images`
  MODIFY `id_exposition_images` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `livraison`
--
ALTER TABLE `livraison`
  MODIFY `id_livraison` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `oeuvre`
--
ALTER TABLE `oeuvre`
  MODIFY `id_oeuvre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT pour la table `oeuvre_images`
--
ALTER TABLE `oeuvre_images`
  MODIFY `id_photo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id_panier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

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
-- Contraintes pour la table `oeuvre_images`
--
ALTER TABLE `oeuvre_images`
  ADD CONSTRAINT `FK_oeuvre_images` FOREIGN KEY (`id_oeuvre`) REFERENCES `oeuvre` (`id_oeuvre`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

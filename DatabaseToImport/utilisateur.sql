-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 25 nov. 2024 à 11:39
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

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
-- Structure de la table `code`
--

CREATE TABLE `code` (
  `ID` int(11) NOT NULL,
  `code` int(11) DEFAULT NULL,
  `date_expiration` date DEFAULT NULL,
  `ID_user` int(11) DEFAULT NULL
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
  `actif` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `nom`, `prenom`, `email`, `description`, `adresse`, `roles`, `mot_de_passe`, `date_creation`, `newsletter`, `actif`) VALUES
(2, 'selvaratnam', 'akash', 'kaladevi549@gmail.com', NULL, NULL, 'Utilisateur', '$2y$10$tf.E.4iL.x1OawpdW17..OyRPAyCX1U05vepN2Bke7qvrdtfJ3Gsq', '2024-11-18', 0, 1),
(4, 'selvaratnam', 'akash', 'kaladevi549@gmail.con', NULL, NULL, 'Utilisateur', '$2y$10$ifXiu6GfmRmEnUc.EX1cOOBQWnY/r6Io4JqlBRHU4PwYz0QcGNoaC', '2024-11-18', 0, 0),
(5, 'Roquigny', 'Yann', 'yann.roquigny.martin@gmail.com', NULL, NULL, 'Utilisateur', '$2y$10$dMsa8jxHhqB3wCfsCpYlie5c1PitBQS/w.OiGIFuUTEUs9u0gBsFi', '2024-11-19', 0, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `code`
--
ALTER TABLE `code`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_user` (`ID_user`);

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
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `code`
--
ALTER TABLE `code`
  ADD CONSTRAINT `code_ibfk_1` FOREIGN KEY (`ID_user`) REFERENCES `utilisateur` (`id_utilisateur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
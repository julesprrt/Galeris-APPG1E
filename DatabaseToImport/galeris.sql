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
  `id_oeuvre_enchere` int(11) NOT NULL REFERENCES oeuvre(id_oeuvre),
  `prix` decimal(10,2) DEFAULT NULL,
  `id_offreur` int(11) DEFAULT NULL REFERENCES utilisateur(id_utilisateur),
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
  `id_exposition` int(11) DEFAULT NULL REFERENCES exposition(id_exhibition)
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
(15, 'ImageBD/exposition/Terrasse-du-cafe-le-soir-Van-Gogh.png', 15);

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
INSERT INTO `oeuvre` (`id_oeuvre`, `Titre`, `Description`,`eco_responsable`,`Date_debut`,`Date_fin`,`Prix`,`type_vente`,`est_vendu`,`auteur`,`id_utilisateur`,`id_categorie`) VALUES
(1,"Arrangement en gris et noir n°1"," Réalisée en 1871 à Londres. Huile sur toile, mesurant 144,3 cm de hauteur et 163 cm de largeur, représentant la mère de l’artiste, Anna Mathilda Whistler, alors âgée de 67 ans. ",0,'2025-01-13','2025-01-25',50000,"Vente",0,"James Abbott McNeill Whistler",null,2);

-- --------------------------------------------------------

--
-- Structure de la table `oeuvre_images`
--

CREATE TABLE `oeuvre_images` (
  `id_photo` int(11) NOT NULL,
  `chemin_image` varchar(100) DEFAULT NULL,
  `id_oeuvre` int(11) NOT NULL REFERENCES oeuvre(id_oeuvre)
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
(15, 'ImageBD/Oeuvre/La-Nuit-etoilee-Van-Gogh-.png', 15);

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
-- Contraintes pour la table `code`
--
ALTER TABLE `code`
  ADD CONSTRAINT `code_ibfk_1` FOREIGN KEY (`ID_user`) REFERENCES `utilisateur` (`id_utilisateur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

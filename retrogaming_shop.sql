-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 23 août 2023 à 21:49
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `retrogaming_shop`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id_client` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(10) DEFAULT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `civilite` enum('homme','femme') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `adresse` text NOT NULL,
  `ville` varchar(20) NOT NULL,
  `cp` int NOT NULL,
  `telephone` int NOT NULL,
  `photo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `mdp` varchar(60) NOT NULL,
  `statut` int NOT NULL DEFAULT '0',
  `date_enregistrement` datetime NOT NULL,
  PRIMARY KEY (`id_client`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `pseudo`, `nom`, `prenom`, `civilite`, `adresse`, `ville`, `cp`, `telephone`, `photo`, `email`, `mdp`, `statut`, `date_enregistrement`) VALUES
(6, 'Flynn', 'Roy', 'Guillaume', '', '64 rue pasteur', 'conflans', 78700, 666251380, 'http://localhost/Mon-projet-de-titre-test/assets/photo/Flynn_e.jpg', 'royguillaume08@gmail.com', '$2y$10$oOvCqDAhCviSkogfavrCV.eRMU/tjfEbfdBhDmlcSRkI/OspAQgZ.', 1, '2023-04-25 20:20:51'),
(7, 'kira95', 'Roy', 'Guillaume', '', 'lmjniubguygvb', 'knuigtbybf', 79520, 356487554, '', 'miyavi14100@hotmail.fr', '$2y$10$C0XXue9vrUwGUV3YGqRhXeBJHo6kFScNONl3PJ4swvA1D/Eykyxsi', 0, '2023-06-06 10:51:57'),
(9, 'kiki', 'Roy', 'Guillaume', '', 'toibnhitflkop', 'conflans', 78700, 0, '/assets/photo/kiki_algo dés.png', 'royguillaume.dev@gmail.com', '$2y$10$rvRCyl0dDzZ1vu/9UdR85.ysYEy/dDVUCkPn4VJS1DfXL2lH5XSU6', 0, '2023-06-07 11:45:44'),
(10, 'momo', 'momo', 'momo', '', '12 rue du momo', 'paris', 45123, 0, '/assets/photo/momo_wp1.png.jpg', 'momo@momo.com', '$2y$10$IKXBXyeRQ/k2RI4FN17Rc.roDGMSRdz1vwzHqKKyfWQpBOBFh/xee', 0, '2023-06-07 11:54:22'),
(11, 'popo', 'popo', 'popo', '', '12 rue du popo', 'mimi', 56453, 0, 'http://localhost/Mon-projet-de-titre-test/assets/photo/popo_e.jpg', 'popo@popo.com', '$2y$10$ZVh8YyZtNg2tI7nSYz1/aeEnjttwV5/ifIcStvSJt3JOaSE2Hdt1K', 0, '2023-06-07 12:07:10'),
(12, 'celin', 'celin', 'celin', '', 'celinerohuer', 'conflans', 78700, 258745632, 'http://localhost/Mon-projet-de-titre-test/assets/photo/celin_voyage-incontournables-perou-machu-picchu-1280x800.jpg', 'gbrbcbgbgtvf@moncul.mabite', '$2y$10$k/OAy2fiV9PpobYtslxysuya6cJD9bGcnD3XXzXVUVOEfyXhnaYIq', 0, '2023-06-08 19:59:48'),
(13, 'Flynn78700', 'Roy', 'Guillaume', '', '7 rue du port', 'conflans', 78700, 666251380, 'http://localhost/Mon-projet-de-titre-test/assets/photo/Flynn78700_photocv.png', 'royguillaume.dev@gmail.com', '$2y$10$JsRUei0/iVb.orfX7I7CxOtJyhN8livvpbMhieVOpU2rl0ZNWpk0G', 0, '2023-08-07 17:39:10'),
(14, 'Flynn78700', 'Roy', 'Guillaume', '', '7 rue du port', 'Bogny sur Meuse', 8120, 666251380, NULL, 'gfng@gmail.com', '$2y$10$LxoKp4DX32ra0TIygMC43enXxM.pvVQUxro4.7Bq7Ij993pdwa6xq', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `editeur`
--

DROP TABLE IF EXISTS `editeur`;
CREATE TABLE IF NOT EXISTS `editeur` (
  `id_editeur` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Editeur',
  PRIMARY KEY (`id_editeur`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `editeur`
--

INSERT INTO `editeur` (`id_editeur`, `nom`) VALUES
(47, 'SQUARE ENIX'),
(48, 'nintendo'),
(49, 'Bandai Namco');

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `id_genre` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Genre',
  PRIMARY KEY (`id_genre`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`id_genre`, `nom`) VALUES
(6, 'RPG'),
(7, 'A-RPG');

-- --------------------------------------------------------

--
-- Structure de la table `plateforme`
--

DROP TABLE IF EXISTS `plateforme`;
CREATE TABLE IF NOT EXISTS `plateforme` (
  `id_plateforme` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Plateforme',
  PRIMARY KEY (`id_plateforme`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `plateforme`
--

INSERT INTO `plateforme` (`id_plateforme`, `nom`) VALUES
(18, 'PS5'),
(19, 'PS4'),
(20, 'Switch');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id_produit` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prix` int NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image` text COLLATE utf8mb4_general_ci NOT NULL,
  `Stock` int DEFAULT NULL,
  `id_genre` int NOT NULL,
  `id_plateforme` int NOT NULL,
  `id_editeur` int NOT NULL,
  PRIMARY KEY (`id_produit`),
  KEY `fk_id_plateforme` (`id_plateforme`),
  KEY `fk_id_editeur` (`id_editeur`),
  KEY `fk_id_genre` (`id_genre`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id_produit`, `nom`, `prix`, `description`, `image`, `Stock`, `id_genre`, `id_plateforme`, `id_editeur`) VALUES
(66, 'Scarlet Nexus', 50, 'tybehtghht', 'http://localhost/Mon-projet-de-titre-test/assets/images-produits/Scarlet Nexus_scarlet-nexus.jpg', 98, 7, 19, 49),
(67, 'Final Fantasy XVII', 90, 'vthnjeukrsghzi', '', 60, 6, 18, 47),
(68, 'pikmin', 45, 'fbhnytnjt', 'http://localhost/Mon-projet-de-titre-test/assets/images-produits/pikmin_wp1.png.jpg', 58, 7, 20, 48),
(71, 'fnf', 56, 'jgdfg', 'http://localhost/Projet-de-titre/assets/images-produits/fnf_ff16.webp', 2, 6, 18, 47);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `fk_id_editeur` FOREIGN KEY (`id_editeur`) REFERENCES `editeur` (`id_editeur`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_genre` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_plateforme` FOREIGN KEY (`id_plateforme`) REFERENCES `plateforme` (`id_plateforme`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

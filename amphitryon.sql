-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 25 mars 2022 à 13:08
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `amphitryon`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie_plat`
--

DROP TABLE IF EXISTS `categorie_plat`;
CREATE TABLE IF NOT EXISTS `categorie_plat` (
  `idCategorie` varchar(5) NOT NULL,
  `libelleCateg` char(5) DEFAULT NULL,
  PRIMARY KEY (`idCategorie`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `idCommande` varchar(5) NOT NULL,
  `Date_C` date NOT NULL,
  `heureCommande` int(11) DEFAULT NULL,
  `etatCommande` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idCommande`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `plat`
--

DROP TABLE IF EXISTS `plat`;
CREATE TABLE IF NOT EXISTS `plat` (
  `idPlat` varchar(5) NOT NULL,
  `idCategorie` varchar(5) NOT NULL,
  `nomPlat` char(20) DEFAULT NULL,
  `descriptifPlat` varchar(50) DEFAULT NULL,
  `prixPlat` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`idPlat`),
  KEY `FK_PLAT_CATEGORIE_PLAT` (`idCategorie`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `platcommander`
--

DROP TABLE IF EXISTS `platcommander`;
CREATE TABLE IF NOT EXISTS `platcommander` (
  `idCommande` varchar(5) NOT NULL,
  `idPlat` varchar(5) NOT NULL,
  `quantiteedemandee` int(11) DEFAULT NULL,
  `infosComplementaires` varchar(128) DEFAULT NULL,
  `etatPlat` char(5) DEFAULT NULL,
  PRIMARY KEY (`idCommande`,`idPlat`),
  KEY `FK_PLATCOMMANDER_PLAT` (`idPlat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `platproposer`
--

DROP TABLE IF EXISTS `platproposer`;
CREATE TABLE IF NOT EXISTS `platproposer` (
  `idPlat` varchar(5) NOT NULL,
  `idService` varchar(5) NOT NULL,
  `Date_P` date NOT NULL,
  `quantiteeProposee` int(11) DEFAULT NULL,
  `prixVente` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`idPlat`,`idService`,`Date_P`),
  KEY `FK_PLATPROPOSER_SERVICE` (`idService`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `serveur`
--

DROP TABLE IF EXISTS `serveur`;
CREATE TABLE IF NOT EXISTS `serveur` (
  `idUser` varchar(5) NOT NULL,
  `nom` char(50) DEFAULT NULL,
  `prenom` char(50) DEFAULT NULL,
  `tel` int(11) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `statut` char(50) DEFAULT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `idService` varchar(5) NOT NULL,
  `creneau` char(10) DEFAULT NULL,
  PRIMARY KEY (`idService`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `table_r`
--

DROP TABLE IF EXISTS `table_r`;
CREATE TABLE IF NOT EXISTS `table_r` (
  `idService` varchar(5) NOT NULL,
  `Date_T` date NOT NULL,
  `numTable` varchar(5) NOT NULL,
  `idUser` varchar(5) NOT NULL,
  `nbPlaces` int(11) DEFAULT NULL,
  PRIMARY KEY (`idService`,`Date_T`,`numTable`),
  KEY `FK_TABLE_R_SERVEUR` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `iduser` varchar(5) NOT NULL,
  `nom` char(50) DEFAULT NULL,
  `prenom` char(50) DEFAULT NULL,
  `tel` int(11) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `statut` char(50) DEFAULT NULL,
  `mdp` varchar(512) NOT NULL,
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`iduser`, `nom`, `prenom`, `tel`, `mail`, `statut`, `mdp`) VALUES
('1', 'legrand', 'etienne', 5, 'salle', 'salle', '098f6bcd4621d373cade4e832627b4f6'),
('2', 'nezout', 'marc', 6, 'cuisinier', 'cuisinier', '098f6bcd4621d373cade4e832627b4f6'),
('3', 'gubbiotti', 'paul', 8, 'serveur', 'serveur', '098f6bcd4621d373cade4e832627b4f6');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `plat`
--
ALTER TABLE `plat`
  ADD CONSTRAINT `plat_ibfk_1` FOREIGN KEY (`idCategorie`) REFERENCES `categorie_plat` (`idCategorie`);

--
-- Contraintes pour la table `platcommander`
--
ALTER TABLE `platcommander`
  ADD CONSTRAINT `platcommander_ibfk_1` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`idCommande`),
  ADD CONSTRAINT `platcommander_ibfk_2` FOREIGN KEY (`idPlat`) REFERENCES `plat` (`idPlat`);

--
-- Contraintes pour la table `platproposer`
--
ALTER TABLE `platproposer`
  ADD CONSTRAINT `platproposer_ibfk_1` FOREIGN KEY (`idPlat`) REFERENCES `plat` (`idPlat`),
  ADD CONSTRAINT `platproposer_ibfk_2` FOREIGN KEY (`idService`) REFERENCES `service` (`idService`);

--
-- Contraintes pour la table `serveur`
--
ALTER TABLE `serveur`
  ADD CONSTRAINT `serveur_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `utilisateur` (`iduser`);

--
-- Contraintes pour la table `table_r`
--
ALTER TABLE `table_r`
  ADD CONSTRAINT `table_r_ibfk_1` FOREIGN KEY (`idService`) REFERENCES `service` (`idService`),
  ADD CONSTRAINT `table_r_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `serveur` (`idUser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

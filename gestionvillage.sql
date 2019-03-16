-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Mar 20 Mai 2014 à 13:46
-- Version du serveur: 5.5.16
-- Version de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `gestionvillage`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `IdArticle` int(11) NOT NULL AUTO_INCREMENT,
  `NomArticle` varchar(35) NOT NULL,
  `QuantitéTotale` int(11) NOT NULL,
  `QuantitéDisponible` int(11) NOT NULL,
  PRIMARY KEY (`IdArticle`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
  `IdCommande` int(11) NOT NULL AUTO_INCREMENT,
  `Date` date NOT NULL,
  `Durée` int(11) NOT NULL,
  `IdUtilisateur` int(11) NOT NULL,
  PRIMARY KEY (`IdCommande`),
  KEY `IdUtilisateur` (`IdUtilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE IF NOT EXISTS `commentaire` (
  `IdCommentaire` int(11) NOT NULL AUTO_INCREMENT,
  `Date` date NOT NULL,
  `Contenu` varchar(500) NOT NULL,
  `IdUtilisateur` int(11) NOT NULL,
  PRIMARY KEY (`IdCommentaire`),
  KEY `idUtilisateur` (`IdUtilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `cotisations`
--

CREATE TABLE IF NOT EXISTS `cotisations` (
  `idCotisation` int(11) NOT NULL AUTO_INCREMENT,
  `Date` date NOT NULL,
  `Somme` int(11) NOT NULL,
  PRIMARY KEY (`idCotisation`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `lignedecommandes`
--

CREATE TABLE IF NOT EXISTS `lignedecommandes` (
  `IdLigne` int(11) NOT NULL AUTO_INCREMENT,
  `Quantité` int(11) NOT NULL,
  `IdCommande` int(11) NOT NULL,
  `IdArticle` int(11) NOT NULL,
  PRIMARY KEY (`IdLigne`),
  UNIQUE KEY `IdArticle` (`IdArticle`),
  KEY `IdCommande` (`IdCommande`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `IdUtilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(20) NOT NULL,
  `Prénom` varchar(20) NOT NULL,
  `Date_de_naissance` date NOT NULL,
  `Identifiant` varchar(30) NOT NULL,
  `Mot_de_passe` varchar(16) NOT NULL,
  PRIMARY KEY (`IdUtilisateur`),
  UNIQUE KEY `Identifiant` (`Identifiant`,`Mot_de_passe`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`IdUtilisateur`, `Nom`, `Prénom`, `Date_de_naissance`, `Identifiant`, `Mot_de_passe`) VALUES
(1, 'Azi', 'Nassim', '1992-05-03', 'azinassim', '03/05/1992');

-- --------------------------------------------------------

--
-- Structure de la table `ut_cot`
--

CREATE TABLE IF NOT EXISTS `ut_cot` (
  `IdUtilisateur` int(11) NOT NULL,
  `IdCotisation` int(11) NOT NULL,
  `EstConcerné` tinyint(1) NOT NULL,
  `Aeffectué` tinyint(1) NOT NULL,
  `DateDePayement` date NOT NULL,
  PRIMARY KEY (`IdUtilisateur`,`IdCotisation`),
  KEY `IdCotisation` (`IdCotisation`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ut_vol`
--

CREATE TABLE IF NOT EXISTS `ut_vol` (
  `IdUtilisateur` int(11) NOT NULL,
  `IdVolontariat` int(11) NOT NULL,
  `Est_Concerné` tinyint(1) NOT NULL,
  ` A_Participé` tinyint(1) NOT NULL,
  PRIMARY KEY (`IdUtilisateur`,`IdVolontariat`),
  KEY `IdVolontariat` (`IdVolontariat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `volontariat`
--

CREATE TABLE IF NOT EXISTS `volontariat` (
  `idVolontariat` int(11) NOT NULL AUTO_INCREMENT,
  `Date` date NOT NULL,
  PRIMARY KEY (`idVolontariat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`IdUtilisateur`) REFERENCES `utilisateurs` (`idUtilisateur`);

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`IdUtilisateur`) REFERENCES `utilisateurs` (`idUtilisateur`);

--
-- Contraintes pour la table `lignedecommandes`
--
ALTER TABLE `lignedecommandes`
  ADD CONSTRAINT `lignedecommandes_ibfk_2` FOREIGN KEY (`IdArticle`) REFERENCES `article` (`IdArticle`),
  ADD CONSTRAINT `lignedecommandes_ibfk_1` FOREIGN KEY (`IdCommande`) REFERENCES `commande` (`IdCommande`);

--
-- Contraintes pour la table `ut_cot`
--
ALTER TABLE `ut_cot`
  ADD CONSTRAINT `ut_cot_ibfk_2` FOREIGN KEY (`IdCotisation`) REFERENCES `cotisations` (`idCotisation`),
  ADD CONSTRAINT `ut_cot_ibfk_1` FOREIGN KEY (`IdUtilisateur`) REFERENCES `utilisateurs` (`idUtilisateur`);

--
-- Contraintes pour la table `ut_vol`
--
ALTER TABLE `ut_vol`
  ADD CONSTRAINT `ut_vol_ibfk_2` FOREIGN KEY (`IdVolontariat`) REFERENCES `volontariat` (`idVolontariat`),
  ADD CONSTRAINT `ut_vol_ibfk_1` FOREIGN KEY (`IdUtilisateur`) REFERENCES `utilisateurs` (`idUtilisateur`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

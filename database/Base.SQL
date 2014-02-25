-- phpMyAdmin SQL Dump
-- version 3.3.5
-- http://www.phpmyadmin.net
--
-- Serveur: 127.0.0.1
-- Généré le : Mer 04 Mai 2011 à 10:06
-- Version du serveur: 5.1.49
-- Version de PHP: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `multiwall`
--

-- --------------------------------------------------------

--
-- Structure de la table `connectes`
--

CREATE TABLE IF NOT EXISTS `connectes` (
  `IP` varchar(15) NOT NULL,
  `TIMESTAMP` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `connectes`
--

INSERT INTO `connectes` (`IP`, `TIMESTAMP`) VALUES
('127.0.0.1', 1302677027),
('192.168.9.51', 1302676929);

-- --------------------------------------------------------

--
-- Structure de la table `journal`
--

CREATE TABLE IF NOT EXISTS `journal` (
  `CODE_UTILISATEUR` int(2) NOT NULL,
  `CODE_SEQ` int(2) NOT NULL AUTO_INCREMENT,
  `DATE` date DEFAULT NULL,
  `HEURE` time DEFAULT NULL,
  `IP` varchar(255) DEFAULT NULL,
  `ACTION` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`CODE_UTILISATEUR`,`CODE_SEQ`),
  KEY `I_FK_JOURNAL_UTILISATEUR` (`CODE_UTILISATEUR`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `journal`
--

INSERT INTO `journal` (`CODE_UTILISATEUR`, `CODE_SEQ`, `DATE`, `HEURE`, `IP`, `ACTION`) VALUES
(1, 1, '2011-04-27', '14:10:00', '127.0.0.1', 'Connexion');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `CODE_UTILISATEUR_EMETTEUR` int(2) NOT NULL,
  `CODE_MESSAGE` int(2) NOT NULL AUTO_INCREMENT,
  `CODE_UTILISATEUR_DESTINATAIRE` int(2) NOT NULL,
  `DATE` date DEFAULT NULL,
  `HEURE` time DEFAULT NULL,
  `MESSAGE` longtext,
  PRIMARY KEY (`CODE_UTILISATEUR_EMETTEUR`,`CODE_MESSAGE`),
  KEY `I_FK_MESSAGE_UTILISATEUR` (`CODE_UTILISATEUR_DESTINATAIRE`),
  KEY `I_FK_MESSAGE_UTILISATEUR2` (`CODE_UTILISATEUR_EMETTEUR`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `message`
--

INSERT INTO `message` (`CODE_UTILISATEUR_EMETTEUR`, `CODE_MESSAGE`, `CODE_UTILISATEUR_DESTINATAIRE`, `DATE`, `HEURE`, `MESSAGE`) VALUES
(2, 1, 1, '2011-04-04', '17:53:00', 'Salut'),
(1, 1, 2, '2011-04-08', '21:29:00', 'Bonjour'),
(1, 2, 2, '2011-04-13', '08:42:00', 'Comment vas tu ?');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `CODE_UTILISATEUR` int(2) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(128) DEFAULT NULL,
  `PRENOM` varchar(128) DEFAULT NULL,
  `PSEUDO` varchar(128) DEFAULT NULL,
  `MOT_DE_PASSE` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`CODE_UTILISATEUR`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`CODE_UTILISATEUR`, `NOM`, `PRENOM`, `PSEUDO`, `MOT_DE_PASSE`) VALUES
(1, 'Vigneron', 'Jean-Baptiste', 'jbplay', 'e7d0214b1afea8c83dde9b752f885194f5ce6d61'),
(2, 'Julbute', 'Raoul', 'test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3');

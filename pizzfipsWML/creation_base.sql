-- phpMyAdmin SQL Dump
-- version 2.10.1
-- http://www.phpmyadmin.net
-- 
-- Serveur: localhost
-- Généré le : Dim 06 Janvier 2008 à 14:55
-- Version du serveur: 5.0.45
-- Version de PHP: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Base de données: `crepes`
-- 

-- --------------------------------------------------------

-- 
-- Structure de la table `client`
-- 

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL auto_increment,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `codepostal` int(11) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `telephone` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Contenu de la table `client`
-- 

INSERT INTO `client` (`id`, `login`, `password`, `nom`, `prenom`, `adresse`, `codepostal`, `ville`, `telephone`) VALUES 
(0, 'henry', 'henry', 'henry', 'jennifer', 'kefqebsc', 4567, 'xvjuk;', 345);

-- --------------------------------------------------------

-- 
-- Structure de la table `commandes`
-- 

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `id` int(11) NOT NULL auto_increment,
  `client` int(11) NOT NULL,
  `date` date NOT NULL,
  `heure` time NOT NULL,
  `livre` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Contenu de la table `commandes`
-- 

INSERT INTO `commandes` (`id`, `client`, `date`, `heure`, `livre`) VALUES 
(0, 0, '2008-01-05', '10:00:00', 0),
(1, 0, '2008-01-05', '09:09:09', 0);

-- --------------------------------------------------------

-- 
-- Structure de la table `crepesperso`
-- 

DROP TABLE IF EXISTS `crepesperso`;
CREATE TABLE IF NOT EXISTS `crepesperso` (
  `crepeperso` varchar(255) NOT NULL,
  `ingredient` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `crepesperso`
-- 

INSERT INTO `crepesperso` (`crepeperso`, `ingredient`) VALUES 
('specialJen', 'fromage'),
('specialJen', 'tomate');

-- --------------------------------------------------------

-- 
-- Structure de la table `itemscommandes`
-- 

DROP TABLE IF EXISTS `itemscommandes`;
CREATE TABLE IF NOT EXISTS `itemscommandes` (
  `commande` int(11) NOT NULL,
  `item` varchar(255) NOT NULL,
  `quantite` int(11) NOT NULL,
  `pret` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `itemscommandes`
-- 

INSERT INTO `itemscommandes` (`commande`, `item`, `quantite`, `pret`) VALUES 
(1, 'specialJen', 3, 1),
(1, 'Nutella', 1, 1),
(0, 'Nutella', 2, 1),
(1, 'Coca', 2, 0);

-- --------------------------------------------------------

-- 
-- Structure de la table `stocks`
-- 

DROP TABLE IF EXISTS `stocks`;
CREATE TABLE IF NOT EXISTS `stocks` (
  `ingredient` varchar(255) NOT NULL,
  `quantite` int(11) NOT NULL,
  `seuil` int(11) NOT NULL,
  `crepable` tinyint(1) NOT NULL,
  PRIMARY KEY  (`ingredient`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `stocks`
-- 


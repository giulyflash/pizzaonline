﻿-- phpMyAdmin SQL Dump
-- version 2.10.1
-- http://www.phpmyadmin.net
-- 
-- Serveur: localhost
-- Généré le : Lun 07 Janvier 2008 à 21:55
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
-- Structure de la table `ingredientsperso`
-- 

DROP TABLE IF EXISTS `ingredientsperso`;
CREATE TABLE IF NOT EXISTS `ingredientsperso` (
  `idperso` varchar(255) NOT NULL,
  `ingredient` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `ingredientsperso`
-- 

INSERT INTO `ingredientsperso` (`idperso`, `ingredient`) VALUES
('specialJen', 'Fromage'),
('specialJen', 'Tomate');

-- --------------------------------------------------------

-- 
-- Structure de la table `itemscommandes`
-- 

DROP TABLE IF EXISTS `itemscommandes`;
CREATE TABLE IF NOT EXISTS `itemscommandes` (
  `commande` int(11) NOT NULL,
  `item` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `quantite` int(11) NOT NULL,
  `pret` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `itemscommandes`
-- 

INSERT INTO `itemscommandes` (`commande`, `item`, `type`, `quantite`, `pret`) VALUES
(1, 'specialJen', 'Perso', 3, 1),
(1, 'Nutella', 'Crepe', 1, 0),
(0, 'Nutella', 'Crepe', 2, 0),
(1, 'Coca', 'Boisson', 2, 0);

-- --------------------------------------------------------

-- 
-- Structure de la table `itemsmenus`
-- 

DROP TABLE IF EXISTS `itemsmenus`;
CREATE TABLE IF NOT EXISTS `itemsmenus` (
  `idmenu` int(11) NOT NULL,
  `item` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `itemsmenus`
-- 


-- --------------------------------------------------------

-- 
-- Structure de la table `menus`
-- 

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL auto_increment,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Contenu de la table `menus`
-- 


-- --------------------------------------------------------

-- 
-- Structure de la table `perso`
-- 

DROP TABLE IF EXISTS `perso`;
CREATE TABLE IF NOT EXISTS `perso` (
  `idperso` int(11) NOT NULL auto_increment,
  `sucre` tinyint(1) NOT NULL,
  PRIMARY KEY  (`idperso`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Contenu de la table `perso`
-- 

INSERT INTO `perso` (`idperso`, `sucre`) VALUES
(1, 0);

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
  `prix` float NOT NULL,
  `sucresale` int(11) NOT NULL,
  PRIMARY KEY  (`ingredient`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `stocks`
-- 

INSERT INTO `stocks` (`ingredient`, `quantite`, `seuil`, `crepable`, `prix`, `sucresale`) VALUES
('Beurre', 22, 12, 1, 2, 2),
('Biere', 22, 13, 0, 0, 0),
('Brownie', 22, 1, 0, 0, 0),
('Champignon', 323, 22, 1, 2, 1),
('Coca', 45, 44, 0, 0, 0),
('Emmental', 21, 12, 1, 1, 1),
('Fromage', 32, 5, 1, 2, 1),
('Jambon', 33, 2, 1, 1.5, 1),
('Nutella', 33, 12, 1, 2, 0),
('Sucre', 45, 3, 1, 2, 0),
('Tarte au citron', 4, 2, 0, 0, 0),
('Tomate', 43, 10, 1, 2, 1);
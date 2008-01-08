-- phpMyAdmin SQL Dump
-- version 2.9.1.1
-- http://www.phpmyadmin.net
-- 
-- Serveur: localhost
-- Généré le : Mardi 08 Janvier 2008 à 22:39
-- Version du serveur: 5.0.27
-- Version de PHP: 5.2.0
-- 
-- Base de données: `crepes`
-- 

-- --------------------------------------------------------

-- 
-- Structure de la table `client`
-- 

CREATE TABLE `client` (
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

CREATE TABLE `commandes` (
  `id` int(11) NOT NULL auto_increment,
  `client` int(11) NOT NULL,
  `date` date NOT NULL,
  `heure` time NOT NULL,
  `livre` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Contenu de la table `commandes`
-- 

INSERT INTO `commandes` (`id`, `client`, `date`, `heure`, `livre`) VALUES 
(1, 0, '2008-01-08', '22:25:00', 0);

-- --------------------------------------------------------

-- 
-- Structure de la table `ingredientsperso`
-- 

CREATE TABLE `ingredientsperso` (
  `idperso` varchar(255) NOT NULL,
  `ingredient` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `ingredientsperso`
-- 

INSERT INTO `ingredientsperso` (`idperso`, `ingredient`) VALUES 
('1', 'Beurre'),
('1', 'Champignon'),
('2', 'Emmental'),
('2', 'Fromage'),
('2', 'Jambon'),
('2', 'Tomate'),
('3', 'Beurre'),
('3', 'Nutella'),
('3', 'Sucre');

-- --------------------------------------------------------

-- 
-- Structure de la table `itemscommandes`
-- 

CREATE TABLE `itemscommandes` (
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
(1, 'Jambon', 'Galette', 2, 0),
(1, 'Beurre Sucre', 'Crepe', 1, 0),
(1, 'Coca', 'Boisson', 1, 0),
(1, 'Brownie', 'Dessert', 1, 0),
(1, '1', 'Perso', 2, 0),
(1, '2', 'Perso', 1, 0),
(1, '3', 'Perso', 1, 0),
(1, '1', 'Menu', 2, 0);

-- --------------------------------------------------------

-- 
-- Structure de la table `itemsmenus`
-- 

CREATE TABLE `itemsmenus` (
  `idmenu` int(11) NOT NULL,
  `item` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `pret` tinyint(4) NOT NULL,
  `id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Contenu de la table `itemsmenus`
-- 

INSERT INTO `itemsmenus` (`idmenu`, `item`, `type`, `pret`, `id`) VALUES 
(1, 'Jambon', 'Galette', 0, 1),
(1, 'Beurre Sucre', 'Crepe', 0, 2),
(1, 'Coca', 'Boisson', 0, 3);

-- --------------------------------------------------------

-- 
-- Structure de la table `menus`
-- 

CREATE TABLE `menus` (
  `id` int(11) NOT NULL auto_increment,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Contenu de la table `menus`
-- 

INSERT INTO `menus` (`id`, `type`) VALUES 
(1, 'Solo');

-- --------------------------------------------------------

-- 
-- Structure de la table `perso`
-- 

CREATE TABLE `perso` (
  `idperso` int(11) NOT NULL auto_increment,
  `sucre` tinyint(1) NOT NULL,
  PRIMARY KEY  (`idperso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Contenu de la table `perso`
-- 

INSERT INTO `perso` (`idperso`, `sucre`) VALUES 
(1, 0),
(2, 0),
(3, 1);

-- --------------------------------------------------------

-- 
-- Structure de la table `stocks`
-- 

CREATE TABLE `stocks` (
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
('Beurre', 1, 12, 1, 2, 2),
('Biere', 22, 13, 0, 0, 0),
('Brownie', 19, 1, 0, 0, 0),
('Champignon', 311, 22, 1, 2, 1),
('Coca', 37, 44, 0, 0, 0),
('Emmental', 17, 12, 1, 1, 1),
('Fromage', 29, 5, 1, 2, 1),
('Jambon', 21, 2, 1, 1.5, 1),
('Nutella', 31, 12, 1, 2, 0),
('Sucre', 36, 3, 1, 2, 0),
('Tarte au citron', 4, 2, 0, 0, 0),
('Tomate', 41, 10, 1, 2, 1);

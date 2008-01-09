-- phpMyAdmin SQL Dump
-- version 2.9.1.1
-- http://www.phpmyadmin.net
-- 
-- Serveur: localhost
-- Généré le : Vendredi 04 Janvier 2008 à 17:47
-- Version du serveur: 5.0.27
-- Version de PHP: 5.2.0
-- 
-- Base de données: `la-galette-orceenne`
-- 
CREATE DATABASE `la-galette-orceenne` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `la-galette-orceenne`;

-- --------------------------------------------------------

-- 
-- Structure de la table `boissons`
-- 

CREATE TABLE `boissons` (
  `nom` varchar(20) NOT NULL,
  `description` text,
  `quantite` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`nom`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Contenu de la table `boissons`
-- 

INSERT INTO `boissons` (`nom`, `description`, `quantite`) VALUES 
('Coca Cola', 'Ou Pepsi selon stocks.', 3),
('Coca Cola Light', NULL, 3),
('Coca Cola Lime', 'Au citron vert.\r\nSans sucres.', 3),
('Coca Cola Zero', NULL, 3),
('Orangina', NULL, 3),
('Orangina Light', NULL, 3),
('Perrier', NULL, 3),
('Badoit', NULL, 3),
('Evian', NULL, 3),
('Volvic', NULL, 3),
('Diabolo menthe', NULL, 3),
('Diabolo fraise', NULL, 3),
('Jus d''ananas', NULL, 3),
('Jus de pomme', NULL, 3),
('Jus d''orange', NULL, 3),
('Jus multivitamine', NULL, 3),
('Limonade', NULL, 3);

-- --------------------------------------------------------

-- 
-- Structure de la table `clients`
-- 

CREATE TABLE `clients` (
  `courriel` varchar(80) NOT NULL,
  `mdp` varchar(16) character set ascii NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) default NULL,
  `civilite` enum('M.','Mme','Mlle','Pr','Dr','Me') NOT NULL default 'M.',
  `adresse1` varchar(40) NOT NULL,
  `adresse2` varchar(40) default NULL,
  `ville` varchar(30) NOT NULL,
  `cp` mediumint(5) unsigned zerofill NOT NULL,
  `remarques` text,
  `tel` int(10) unsigned default NULL,
  PRIMARY KEY  (`courriel`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Liste des clients';

-- 
-- Contenu de la table `clients`
-- 

INSERT INTO `clients` (`courriel`, `mdp`, `nom`, `prenom`, `civilite`, `adresse1`, `adresse2`, `ville`, `cp`, `remarques`, `tel`) VALUES 
('test', 'test', 'IFIPS', 'Test', 'Pr', '14 rue du cornichon ultraviolet', NULL, 'Quatteyague', 78910, '2e étage\r\ncode porte : 7812', NULL);

-- --------------------------------------------------------

-- 
-- Structure de la table `desserts`
-- 

CREATE TABLE `desserts` (
  `nom` varchar(20) NOT NULL,
  `description` text,
  `quantite` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`nom`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Liste des desserts';

-- 
-- Contenu de la table `desserts`
-- 

INSERT INTO `desserts` (`nom`, `description`, `quantite`) VALUES 
('crêpe au sucre', NULL, 5),
('crêpe nutella', NULL, 5),
('crêpe Grand-Marnier', NULL, 5),
('sorbet 2 boules', NULL, 5),
('tartelette au citron', NULL, 5),
('brownie', NULL, 5),
('fruit de saison', NULL, 5);

-- --------------------------------------------------------

-- 
-- Structure de la table `ingredients`
-- 

CREATE TABLE `ingredients` (
  `nom` varchar(50) NOT NULL,
  `description` text,
  `quantite` int(10) unsigned NOT NULL default '0',
  `base` enum('sel','sucre') NOT NULL default 'sel',
  PRIMARY KEY  (`nom`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Liste des ingrédients et stocks.';

-- 
-- Contenu de la table `ingredients`
-- 

INSERT INTO `ingredients` (`nom`, `description`, `quantite`, `base`) VALUES 
('jambon', 'Jambon de pays', 5, 'sel'),
('emmental', 'emmental rapé', 7, 'sel'),
('oeuf', NULL, 5, 'sel'),
('saucisse', NULL, 0, 'sel'),
('salade', NULL, 0, 'sel'),
('tomate', NULL, 0, 'sel'),
('fromage de chèvre', NULL, 0, 'sel'),
('lardons', NULL, 0, 'sel'),
('poivron', NULL, 0, 'sel'),
('viande hachée', NULL, 0, 'sel'),
('jambon de Bayonne', NULL, 0, 'sel'),
('roquefort', NULL, 0, 'sel'),
('miel', NULL, 0, 'sel'),
('sauce tomate', NULL, 0, 'sel'),
('ratatouille', NULL, 0, 'sel'),
('champignons', NULL, 0, 'sel'),
('poulet', NULL, 0, 'sel'),
('mélange de fruits de mer', NULL, 0, 'sel'),
('gouda', NULL, 0, 'sel'),
('foie de volaille', NULL, 0, 'sel'),
('oeufs de lumps', NULL, 0, 'sel'),
('béchamelle', NULL, 0, 'sel'),
('oignons', NULL, 0, 'sel'),
('boudin noir', NULL, 0, 'sel'),
('épinards', NULL, 0, 'sel'),
('risoto', NULL, 0, 'sel'),
('sucre', NULL, 5, 'sucre'),
('nutella', NULL, 4, 'sucre');

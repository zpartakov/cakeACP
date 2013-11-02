-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 02, 2013 at 08:31 AM
-- Server version: 5.5.34-0ubuntu0.12.04.1
-- PHP Version: 5.3.10-1ubuntu3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `p2rch1`
--

-- --------------------------------------------------------

--
-- Table structure for table `cocagne_defaults`
--

DROP TABLE IF EXISTS `cocagne_defaults`;
CREATE TABLE IF NOT EXISTS `cocagne_defaults` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `lib` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `n` int(9) NOT NULL,
  `rem1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rem2` text COLLATE utf8_unicode_ci NOT NULL,
  `datemod` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='table des valeurs défaut pour les DJ' AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `dj_maintenances`
--

DROP TABLE IF EXISTS `dj_maintenances`;
CREATE TABLE IF NOT EXISTS `dj_maintenances` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `actif` int(1) NOT NULL,
  `stop` date NOT NULL,
  `start` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='dates désactivation/activation demi-journées' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `import`
--

DROP TABLE IF EXISTS `import`;
CREATE TABLE IF NOT EXISTS `import` (
  `pdd` text COLLATE latin1_german1_ci NOT NULL,
  `coop` text COLLATE latin1_german1_ci NOT NULL,
  `panier` text COLLATE latin1_german1_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jos_demiejournees`
--

DROP TABLE IF EXISTS `jos_demiejournees`;
CREATE TABLE IF NOT EXISTS `jos_demiejournees` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `type` varchar(255) NOT NULL,
  `nplaces` int(3) NOT NULL,
  `statut` smallint(1) NOT NULL DEFAULT '1',
  `REMARQUES` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `date` (`date`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12111 ;

-- --------------------------------------------------------

--
-- Table structure for table `jos_demiejournees_archives`
--

DROP TABLE IF EXISTS `jos_demiejournees_archives`;
CREATE TABLE IF NOT EXISTS `jos_demiejournees_archives` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `type` varchar(255) NOT NULL,
  `nplaces` int(3) NOT NULL,
  `statut` smallint(1) NOT NULL DEFAULT '1',
  `REMARQUES` text CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `date` (`date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jos_demiejournees_default_schedules`
--

DROP TABLE IF EXISTS `jos_demiejournees_default_schedules`;
CREATE TABLE IF NOT EXISTS `jos_demiejournees_default_schedules` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `jourheure` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `npers` int(2) NOT NULL,
  `rem1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rem2` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='table des valeurs défaut pour les DJ' AUTO_INCREMENT=29 ;

-- --------------------------------------------------------

--
-- Table structure for table `jos_demiejournees_details`
--

DROP TABLE IF EXISTS `jos_demiejournees_details`;
CREATE TABLE IF NOT EXISTS `jos_demiejournees_details` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `user` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `npers` smallint(6) NOT NULL,
  `rem` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1528 ;

-- --------------------------------------------------------

--
-- Table structure for table `jos_paniers`
--

DROP TABLE IF EXISTS `jos_paniers`;
CREATE TABLE IF NOT EXISTS `jos_paniers` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `user_id` int(12) NOT NULL,
  `panier` varchar(90) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=495 ;

-- --------------------------------------------------------

--
-- Table structure for table `jos_pdds`
--

DROP TABLE IF EXISTS `jos_pdds`;
CREATE TABLE IF NOT EXISTS `jos_pdds` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `Lieu_dit` varchar(255) DEFAULT NULL,
  `mini` int(3) NOT NULL,
  `moyen` int(3) NOT NULL,
  `grand` int(3) NOT NULL,
  `oeufs` int(3) NOT NULL,
  `PDDTexte` varchar(255) DEFAULT NULL,
  `PDDAdr` varchar(255) DEFAULT NULL,
  `CP` varchar(80) NOT NULL,
  `Localite` varchar(255) NOT NULL,
  `Ouverture` text NOT NULL,
  `dispo_paniers` varchar(255) NOT NULL,
  `imperatifs_livraison` varchar(255) NOT NULL,
  `nb_max_paniers` int(3) NOT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

-- --------------------------------------------------------

--
-- Table structure for table `jos_users_pdds`
--

DROP TABLE IF EXISTS `jos_users_pdds`;
CREATE TABLE IF NOT EXISTS `jos_users_pdds` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `user_id` int(12) NOT NULL,
  `jos_pdd_id` int(12) NOT NULL,
  `note` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=501 ;

-- --------------------------------------------------------

--
-- Table structure for table `livreurs`
--

DROP TABLE IF EXISTS `livreurs`;
CREATE TABLE IF NOT EXISTS `livreurs` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `user_id` int(12) NOT NULL,
  `rem` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `jos_user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='livreurs et livreuses' AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `oeufs`
--

DROP TABLE IF EXISTS `oeufs`;
CREATE TABLE IF NOT EXISTS `oeufs` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `user_id` int(12) NOT NULL,
  `oeufs` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=250 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=678 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

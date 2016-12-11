-- phpMyAdmin SQL Dump
-- version 3.3.2deb1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Ven 15 Octobre 2010 à 11:10
-- Version du serveur: 5.1.41
-- Version de PHP: 5.3.2-1ubuntu4.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `lesjardinsdecocagnech`
--

-- --------------------------------------------------------

--
-- Structure de la table `cocagne_genres`
--

CREATE TABLE IF NOT EXISTS `cocagne_genres` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `genre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Structure de la table `cocagne_legumes`
--

CREATE TABLE IF NOT EXISTS `cocagne_legumes` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `legume` varchar(255) NOT NULL,
  `printemps` int(1) NOT NULL,
  `ete` int(1) NOT NULL,
  `automne` int(1) NOT NULL,
  `hiver` int(1) NOT NULL,
  `generalite` text NOT NULL,
  `origine` text NOT NULL,
  `choix` text NOT NULL,
  `preparation` text NOT NULL,
  `conservation` text NOT NULL,
  `conseils` text NOT NULL,
  `conseils_sante` text NOT NULL,
  `remarques` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=61 ;

-- --------------------------------------------------------

--
-- Structure de la table `cocagne_recettes`
--

CREATE TABLE IF NOT EXISTS `cocagne_recettes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ingredients` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `preparation` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `genre` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=177 ;

-- --------------------------------------------------------

--
-- Structure de la table `FestivalFilmAide`
--

CREATE TABLE IF NOT EXISTS `FestivalFilmAide` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `hdep` varchar(255) NOT NULL,
  `hfin` varchar(255) NOT NULL,
  `jour` varchar(12) NOT NULL,
  `np` int(1) NOT NULL,
  `qui1` varchar(255) NOT NULL,
  `qui2` varchar(255) NOT NULL,
  `qui3` varchar(255) NOT NULL,
  `rem` text NOT NULL,
  `nom1` text NOT NULL,
  `tel1` text NOT NULL,
  `mel1` text NOT NULL,
  `nom2` text NOT NULL,
  `tel2` text NOT NULL,
  `mel2` text NOT NULL,
  `nom3` text NOT NULL,
  `tel3` text NOT NULL,
  `mel3` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_action_trigger`
--

CREATE TABLE IF NOT EXISTS `jos_action_trigger` (
  `ctrid` mediumint(8) unsigned NOT NULL,
  `actid` mediumint(8) unsigned NOT NULL,
  `ordering` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `publish` tinyint(4) NOT NULL,
  PRIMARY KEY (`ctrid`,`actid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jos_adresses`
--

CREATE TABLE IF NOT EXISTS `jos_adresses` (
  `id` int(4) NOT NULL DEFAULT '0',
  `NOM1` varchar(100) DEFAULT NULL,
  `NOM2` varchar(100) DEFAULT NULL,
  `NOM3` varchar(100) DEFAULT NULL,
  `ABREVIATION` varchar(32) DEFAULT NULL,
  `CONTACT` varchar(40) DEFAULT NULL,
  `PRENOM` varchar(36) DEFAULT NULL,
  `TITRE` varchar(52) DEFAULT NULL,
  `ADRESSE` varchar(100) DEFAULT NULL,
  `ADRESSE2` varchar(100) DEFAULT NULL,
  `NO_POSTAL` varchar(20) DEFAULT NULL,
  `LIEU` varchar(48) DEFAULT NULL,
  `PAYS` varchar(40) DEFAULT NULL,
  `Etage` int(1) DEFAULT NULL,
  `CodePorteEntree` varchar(20) DEFAULT NULL,
  `NO_TEL1` varchar(36) DEFAULT NULL,
  `NO_TEL2` varchar(36) DEFAULT NULL,
  `NO_TEL3` varchar(36) DEFAULT NULL,
  `NO_NATEL` varchar(36) DEFAULT NULL,
  `NO_FAX` varchar(36) DEFAULT NULL,
  `E_MAIL` varchar(100) DEFAULT NULL,
  `E_MAIL2` varchar(100) DEFAULT NULL,
  `EmailTo` varchar(100) DEFAULT NULL,
  `EmailTo2` varchar(100) DEFAULT NULL,
  `FONCTION` varchar(70) DEFAULT NULL,
  `ACTIVITE` varchar(36) DEFAULT NULL,
  `NAISSANCE` varchar(36) DEFAULT NULL,
  `SEXE` varchar(2) DEFAULT NULL,
  `LANGUE` varchar(6) DEFAULT NULL,
  `CODE1` varchar(24) DEFAULT NULL,
  `CODE2` varchar(24) DEFAULT NULL,
  `CODE3` varchar(24) DEFAULT NULL,
  `CODE4` varchar(24) DEFAULT NULL,
  `CODE5` varchar(24) DEFAULT NULL,
  `CODE6` varchar(24) DEFAULT NULL,
  `VALEUR1` float DEFAULT NULL,
  `VALEUR2` float DEFAULT NULL,
  `DATE1` varchar(100) DEFAULT NULL,
  `DATE2` varchar(100) DEFAULT NULL,
  `SiteWeb` varchar(100) DEFAULT NULL,
  `PourFacturation` varchar(100) DEFAULT NULL,
  `eMAILMailto` varchar(100) DEFAULT NULL,
  `idPoint` int(4) DEFAULT NULL,
  `ResponsablePoint` varchar(100) DEFAULT NULL,
  `NTaillePart` int(4) DEFAULT NULL,
  `NClassePart` int(4) DEFAULT NULL,
  `RemarquePart` varchar(100) DEFAULT NULL,
  `CocagneDateEntree` varchar(100) DEFAULT NULL,
  `CocagneDateSortie` varchar(100) DEFAULT NULL,
  `NomFichierSource` varchar(100) DEFAULT NULL,
  `NoFicheSource` int(4) DEFAULT NULL,
  `RepertoireDocuments` varchar(100) DEFAULT NULL,
  `C_IMPOT` varchar(2) DEFAULT NULL,
  `NO_COMPTE` varchar(28) DEFAULT NULL,
  `SELECTION` varchar(2) DEFAULT NULL,
  `NOTES` text,
  `D_CREATION` varchar(100) DEFAULT NULL,
  `H_CREATION` varchar(10) DEFAULT NULL,
  `USER_CREATION` varchar(24) DEFAULT NULL,
  `D_MODIF` varchar(100) DEFAULT NULL,
  `H_MODIF` varchar(10) DEFAULT NULL,
  `USER_MODIF` varchar(24) DEFAULT NULL,
  `D_RAPPEL` varchar(100) DEFAULT NULL,
  `H_RAPPEL` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `NOM1` (`NOM1`),
  KEY `NOM2` (`NOM2`),
  KEY `NOM3` (`NOM3`),
  KEY `E_MAIL` (`E_MAIL`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `jos_banner`
--

CREATE TABLE IF NOT EXISTS `jos_banner` (
  `bid` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL DEFAULT '0',
  `type` varchar(30) NOT NULL DEFAULT 'banner',
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `imptotal` int(11) NOT NULL DEFAULT '0',
  `impmade` int(11) NOT NULL DEFAULT '0',
  `clicks` int(11) NOT NULL DEFAULT '0',
  `imageurl` varchar(100) NOT NULL DEFAULT '',
  `clickurl` varchar(200) NOT NULL DEFAULT '',
  `date` datetime DEFAULT NULL,
  `showBanner` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `editor` varchar(50) DEFAULT NULL,
  `custombannercode` text,
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `sticky` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tags` text NOT NULL,
  `params` text NOT NULL,
  PRIMARY KEY (`bid`),
  KEY `viewbanner` (`showBanner`),
  KEY `idx_banner_catid` (`catid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_bannerclient`
--

CREATE TABLE IF NOT EXISTS `jos_bannerclient` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `contact` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `extrainfo` text NOT NULL,
  `checked_out` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out_time` time DEFAULT NULL,
  `editor` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_bannertrack`
--

CREATE TABLE IF NOT EXISTS `jos_bannertrack` (
  `track_date` date NOT NULL,
  `track_type` int(10) unsigned NOT NULL,
  `banner_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jos_captcha_config`
--

CREATE TABLE IF NOT EXISTS `jos_captcha_config` (
  `cpcid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `publish` tinyint(4) DEFAULT NULL,
  `h` int(10) unsigned DEFAULT NULL,
  `v` int(10) unsigned DEFAULT NULL,
  `vmin` int(10) unsigned DEFAULT NULL,
  `vmax` int(10) unsigned DEFAULT NULL,
  `hmin` int(10) unsigned DEFAULT NULL,
  `hmax` int(10) unsigned DEFAULT NULL,
  `vfixe` tinyint(3) unsigned DEFAULT NULL,
  `hfixe` tinyint(3) unsigned DEFAULT NULL,
  `randomtext` tinyint(3) unsigned DEFAULT NULL,
  `dicfixe` tinyint(3) unsigned DEFAULT NULL,
  `dic` varchar(100) DEFAULT NULL,
  `abcfixe` tinyint(3) unsigned DEFAULT NULL,
  `abc` varchar(255) DEFAULT NULL,
  `defaultlg` varchar(10) DEFAULT NULL,
  `lengthfixe` tinyint(3) unsigned DEFAULT NULL,
  `lengthmin` int(10) unsigned DEFAULT NULL,
  `lengthmax` int(10) unsigned DEFAULT NULL,
  `length` int(10) unsigned DEFAULT NULL,
  `bgcolor` varchar(6) DEFAULT NULL,
  `fgcolor` varchar(255) DEFAULT NULL,
  `multifgcolor` tinyint(3) unsigned DEFAULT NULL,
  `font` varchar(255) DEFAULT NULL,
  `multifont` tinyint(3) unsigned DEFAULT NULL,
  `sizefixe` tinyint(3) unsigned DEFAULT NULL,
  `size` int(10) unsigned DEFAULT NULL,
  `sizemin` int(10) unsigned DEFAULT NULL,
  `sizemax` int(10) unsigned DEFAULT NULL,
  `transparencyfixe` tinyint(3) unsigned DEFAULT NULL,
  `transparency` int(10) unsigned DEFAULT NULL,
  `transparencymin` int(10) unsigned DEFAULT NULL,
  `transparencymax` int(10) unsigned DEFAULT NULL,
  `brightfixe` tinyint(3) unsigned DEFAULT NULL,
  `bright` int(10) unsigned DEFAULT NULL,
  `brightmin` int(10) unsigned DEFAULT NULL,
  `brightmax` int(10) unsigned DEFAULT NULL,
  `rtl` tinyint(3) unsigned DEFAULT NULL,
  `ttb` tinyint(3) unsigned DEFAULT NULL,
  `anglefixe` tinyint(3) unsigned DEFAULT NULL,
  `angle` int(11) DEFAULT NULL,
  `anglemin` int(11) DEFAULT NULL,
  `anglemax` int(11) DEFAULT NULL,
  `autoadjust` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `spacefixe` tinyint(3) unsigned DEFAULT NULL,
  `space` int(11) DEFAULT NULL,
  `spacemin` int(11) DEFAULT NULL,
  `spacemax` int(11) DEFAULT NULL,
  `bgimg` tinyint(3) unsigned DEFAULT NULL,
  `multinoisecolor` tinyint(3) unsigned DEFAULT NULL,
  `noisecolor` varchar(255) DEFAULT NULL,
  `noiseover` tinyint(3) unsigned DEFAULT NULL,
  `noisetype` smallint(6) DEFAULT NULL,
  `noiseocc` mediumint(9) DEFAULT NULL,
  `noise` tinyint(3) unsigned DEFAULT NULL,
  `mindiff` tinyint(3) unsigned DEFAULT NULL,
  `txtandbgmindiff` mediumint(9) DEFAULT NULL,
  `thicknessfixe` tinyint(3) unsigned NOT NULL,
  `thickness` smallint(6) unsigned NOT NULL,
  `thicknessmin` smallint(6) unsigned NOT NULL,
  `thicknessmax` smallint(6) unsigned NOT NULL,
  PRIMARY KEY (`cpcid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_captcha_node`
--

CREATE TABLE IF NOT EXISTS `jos_captcha_node` (
  `cptid` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(10) unsigned DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `addon` int(11) DEFAULT NULL,
  `crypt` varchar(10) DEFAULT NULL,
  `used` int(11) NOT NULL DEFAULT '0',
  `image` varchar(40) DEFAULT NULL,
  `params` text,
  PRIMARY KEY (`cptid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_categories`
--

CREATE TABLE IF NOT EXISTS `jos_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT '',
  `section` varchar(50) NOT NULL DEFAULT '',
  `image_position` varchar(30) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `editor` varchar(50) DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `count` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cat_idx` (`section`,`published`,`access`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_ccnewsletter_acknowledgement`
--

CREATE TABLE IF NOT EXISTS `jos_ccnewsletter_acknowledgement` (
  `id` int(2) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `subs_title` varchar(255) NOT NULL DEFAULT '',
  `subs_content` mediumtext NOT NULL,
  `unsubs_title` varchar(255) NOT NULL DEFAULT '',
  `unsubs_content` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jos_ccnewsletter_newsletters`
--

CREATE TABLE IF NOT EXISTS `jos_ccnewsletter_newsletters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_ccnewsletter_subscribers`
--

CREATE TABLE IF NOT EXISTS `jos_ccnewsletter_subscribers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `plainText` tinyint(1) NOT NULL DEFAULT '0',
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `sdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_checkout_node`
--

CREATE TABLE IF NOT EXISTS `jos_checkout_node` (
  `sid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `eid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `modified` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`sid`,`eid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_components`
--

CREATE TABLE IF NOT EXISTS `jos_components` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `link` varchar(255) NOT NULL DEFAULT '',
  `menuid` int(11) unsigned NOT NULL DEFAULT '0',
  `parent` int(11) unsigned NOT NULL DEFAULT '0',
  `admin_menu_link` varchar(255) NOT NULL DEFAULT '',
  `admin_menu_alt` varchar(255) NOT NULL DEFAULT '',
  `option` varchar(50) NOT NULL DEFAULT '',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `admin_menu_img` varchar(255) NOT NULL DEFAULT '',
  `iscore` tinyint(4) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `enabled` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `parent_option` (`parent`,`option`(32))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=232 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_componentsSAV`
--

CREATE TABLE IF NOT EXISTS `jos_componentsSAV` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `link` varchar(255) NOT NULL DEFAULT '',
  `menuid` int(11) unsigned NOT NULL DEFAULT '0',
  `parent` int(11) unsigned NOT NULL DEFAULT '0',
  `admin_menu_link` varchar(255) NOT NULL DEFAULT '',
  `admin_menu_alt` varchar(255) NOT NULL DEFAULT '',
  `option` varchar(50) NOT NULL DEFAULT '',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `admin_menu_img` varchar(255) NOT NULL DEFAULT '',
  `iscore` tinyint(4) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `enabled` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `parent_option` (`parent`,`option`(32))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=232 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_contact_details`
--

CREATE TABLE IF NOT EXISTS `jos_contact_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `con_position` varchar(255) DEFAULT NULL,
  `address` text,
  `suburb` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `postcode` varchar(100) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `misc` mediumtext,
  `image` varchar(255) DEFAULT NULL,
  `imagepos` varchar(20) DEFAULT NULL,
  `email_to` varchar(255) DEFAULT NULL,
  `default_con` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `published` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `catid` int(11) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `mobile` varchar(255) NOT NULL DEFAULT '',
  `webpage` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_content`
--

CREATE TABLE IF NOT EXISTS `jos_content` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `title_alias` varchar(255) NOT NULL DEFAULT '',
  `introtext` mediumtext NOT NULL,
  `fulltext` mediumtext NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `sectionid` int(11) unsigned NOT NULL DEFAULT '0',
  `mask` int(11) unsigned NOT NULL DEFAULT '0',
  `catid` int(11) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `images` text NOT NULL,
  `urls` text NOT NULL,
  `attribs` text NOT NULL,
  `version` int(11) unsigned NOT NULL DEFAULT '1',
  `parentid` int(11) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `access` int(11) unsigned NOT NULL DEFAULT '0',
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  `metadata` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_section` (`sectionid`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`state`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=231 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_content_frontpage`
--

CREATE TABLE IF NOT EXISTS `jos_content_frontpage` (
  `content_id` int(11) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`content_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jos_content_rating`
--

CREATE TABLE IF NOT EXISTS `jos_content_rating` (
  `content_id` int(11) NOT NULL DEFAULT '0',
  `rating_sum` int(11) unsigned NOT NULL DEFAULT '0',
  `rating_count` int(11) unsigned NOT NULL DEFAULT '0',
  `lastip` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`content_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jos_conversation_node`
--

CREATE TABLE IF NOT EXISTS `jos_conversation_node` (
  `mcid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `top` int(10) unsigned DEFAULT NULL,
  `parent` int(10) unsigned NOT NULL DEFAULT '0',
  `replies` smallint(5) unsigned NOT NULL DEFAULT '0',
  `created` int(10) unsigned NOT NULL,
  `modified` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`mcid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_conversation_status`
--

CREATE TABLE IF NOT EXISTS `jos_conversation_status` (
  `uid` int(10) unsigned NOT NULL,
  `mcid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `isread` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `replies` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`,`mcid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_conversation_to`
--

CREATE TABLE IF NOT EXISTS `jos_conversation_to` (
  `uid` int(10) unsigned NOT NULL,
  `mcid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`uid`,`mcid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jos_core_acl_aro`
--

CREATE TABLE IF NOT EXISTS `jos_core_acl_aro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section_value` varchar(240) NOT NULL DEFAULT '0',
  `value` varchar(240) NOT NULL DEFAULT '',
  `order_value` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `hidden` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `jos_section_value_value_aro` (`section_value`(100),`value`(100)),
  KEY `jos_gacl_hidden_aro` (`hidden`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_core_acl_aro_groups`
--

CREATE TABLE IF NOT EXISTS `jos_core_acl_aro_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `lft` int(11) NOT NULL DEFAULT '0',
  `rgt` int(11) NOT NULL DEFAULT '0',
  `value` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `jos_gacl_parent_id_aro_groups` (`parent_id`),
  KEY `jos_gacl_lft_rgt_aro_groups` (`lft`,`rgt`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_core_acl_aro_map`
--

CREATE TABLE IF NOT EXISTS `jos_core_acl_aro_map` (
  `acl_id` int(11) NOT NULL DEFAULT '0',
  `section_value` varchar(230) NOT NULL DEFAULT '0',
  `value` varchar(100) NOT NULL,
  PRIMARY KEY (`acl_id`,`section_value`,`value`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jos_core_acl_aro_sections`
--

CREATE TABLE IF NOT EXISTS `jos_core_acl_aro_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(230) NOT NULL DEFAULT '',
  `order_value` int(11) NOT NULL DEFAULT '0',
  `name` varchar(230) NOT NULL DEFAULT '',
  `hidden` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `jos_gacl_value_aro_sections` (`value`),
  KEY `jos_gacl_hidden_aro_sections` (`hidden`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_core_acl_groups_aro_map`
--

CREATE TABLE IF NOT EXISTS `jos_core_acl_groups_aro_map` (
  `group_id` int(11) NOT NULL DEFAULT '0',
  `section_value` varchar(240) NOT NULL DEFAULT '',
  `aro_id` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `group_id_aro_id_groups_aro_map` (`group_id`,`section_value`,`aro_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jos_core_log_items`
--

CREATE TABLE IF NOT EXISTS `jos_core_log_items` (
  `time_stamp` date NOT NULL DEFAULT '0000-00-00',
  `item_table` varchar(50) NOT NULL DEFAULT '',
  `item_id` int(11) unsigned NOT NULL DEFAULT '0',
  `hits` int(11) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jos_core_log_searches`
--

CREATE TABLE IF NOT EXISTS `jos_core_log_searches` (
  `search_term` varchar(128) NOT NULL DEFAULT '',
  `hits` int(11) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jos_co_petites_annonces`
--

CREATE TABLE IF NOT EXISTS `jos_co_petites_annonces` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `contact` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `active` tinyint(1) NOT NULL,
  `cocagnard_e_id` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_dataset_constraints`
--

CREATE TABLE IF NOT EXISTS `jos_dataset_constraints` (
  `ctid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `sid` smallint(5) unsigned NOT NULL,
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `namekey` varchar(50) NOT NULL,
  `dbtid` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`ctid`),
  UNIQUE KEY `UK_dataset_constraints_namekey` (`namekey`),
  KEY `sid` (`sid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=130 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_dataset_constraintsitems`
--

CREATE TABLE IF NOT EXISTS `jos_dataset_constraintsitems` (
  `ctid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `ordering` tinyint(3) unsigned NOT NULL DEFAULT '5',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `dbcid` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`ctid`,`dbcid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=130 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_dataset_foreign`
--

CREATE TABLE IF NOT EXISTS `jos_dataset_foreign` (
  `fkid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `ondelete` tinyint(3) unsigned NOT NULL DEFAULT '3',
  `sid` smallint(5) unsigned NOT NULL,
  `feid` mediumint(8) unsigned NOT NULL,
  `ref_sid` smallint(5) unsigned NOT NULL,
  `ref_feid` mediumint(8) unsigned NOT NULL,
  `namekey` varchar(50) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL,
  `publish` tinyint(4) NOT NULL DEFAULT '1',
  `map` char(20) NOT NULL,
  `map2` char(20) NOT NULL,
  `onupdate` tinyint(3) unsigned NOT NULL DEFAULT '3',
  `params` text NOT NULL,
  `dbtid` smallint(5) unsigned NOT NULL,
  `ref_dbtid` smallint(5) unsigned NOT NULL,
  `ordering` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`fkid`),
  UNIQUE KEY `UK_dataset_foreign_namekey` (`namekey`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=182 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_dataset_match`
--

CREATE TABLE IF NOT EXISTS `jos_dataset_match` (
  `name` varchar(50) NOT NULL,
  `sid` smallint(5) unsigned NOT NULL,
  `map` varchar(50) NOT NULL,
  `ref_sid` smallint(5) unsigned NOT NULL,
  `refmap` varchar(50) NOT NULL,
  `publish` tinyint(4) NOT NULL DEFAULT '0',
  `core` tinyint(3) unsigned NOT NULL,
  `wid` smallint(5) unsigned NOT NULL,
  `mcid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`mcid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_db_columns`
--

CREATE TABLE IF NOT EXISTS `jos_db_columns` (
  `dbcid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dbtid` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `pkey` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `checkval` tinyint(3) unsigned NOT NULL,
  `type` mediumint(8) unsigned NOT NULL,
  `attributes` tinyint(3) unsigned NOT NULL,
  `mandatory` tinyint(3) unsigned NOT NULL,
  `default` varchar(50) NOT NULL,
  `ordering` tinyint(3) unsigned NOT NULL,
  `level` tinyint(3) unsigned NOT NULL,
  `rolid` smallint(5) unsigned NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `extra` tinyint(3) unsigned NOT NULL,
  `size` varchar(255) NOT NULL,
  `export` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `namekey` varchar(50) NOT NULL,
  `core` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`dbcid`),
  UNIQUE KEY `UK_db_columns` (`namekey`),
  UNIQUE KEY `UK_dbtid_columnname` (`dbtid`,`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1031 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_db_node`
--

CREATE TABLE IF NOT EXISTS `jos_db_node` (
  `dbid` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `host` varchar(255) NOT NULL,
  `size` int(10) unsigned NOT NULL,
  `tables` int(10) unsigned NOT NULL,
  `prefix` varchar(255) NOT NULL,
  `publish` tinyint(4) NOT NULL DEFAULT '1',
  `rolid` smallint(5) unsigned NOT NULL DEFAULT '1',
  `suffix` varchar(255) NOT NULL,
  `addon` varchar(20) NOT NULL DEFAULT 'mysql',
  `namekey` varchar(50) NOT NULL,
  PRIMARY KEY (`dbid`),
  UNIQUE KEY `UK_namekey` (`namekey`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_db_tables`
--

CREATE TABLE IF NOT EXISTS `jos_db_tables` (
  `dbtid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dbid` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `namekey` varchar(50) NOT NULL,
  `size` int(10) unsigned NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `modified` int(10) unsigned NOT NULL,
  `rows` int(10) unsigned NOT NULL,
  `rows_average_length` int(10) unsigned NOT NULL,
  `data_length` int(10) unsigned NOT NULL,
  `prefix` varchar(255) NOT NULL,
  `version` varchar(50) NOT NULL,
  `rolid` smallint(5) unsigned NOT NULL DEFAULT '1',
  `level` tinyint(3) unsigned NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `pkey` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `domain` tinyint(4) NOT NULL DEFAULT '1',
  `export` tinyint(3) unsigned NOT NULL,
  `exportdelete` tinyint(4) NOT NULL,
  PRIMARY KEY (`dbtid`),
  UNIQUE KEY `UK_549_namekey` (`namekey`),
  UNIQUE KEY `UK_dbid_name` (`name`,`dbid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=126 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_demiejournees`
--

CREATE TABLE IF NOT EXISTS `jos_demiejournees` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `type` varchar(255) NOT NULL,
  `nplaces` int(3) NOT NULL,
  `statut` smallint(1) NOT NULL DEFAULT '1',
  `REMARQUES` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `date` (`date`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7607 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_demiejournees_archives`
--

CREATE TABLE IF NOT EXISTS `jos_demiejournees_archives` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `type` varchar(255) NOT NULL,
  `nplaces` int(3) NOT NULL,
  `statut` smallint(1) NOT NULL DEFAULT '1',
  `REMARQUES` text CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `date` (`date`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6524 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_demiejournees_details`
--

CREATE TABLE IF NOT EXISTS `jos_demiejournees_details` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `user` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `npers` smallint(6) NOT NULL,
  `rem` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=64 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_demiejournees_details_archives`
--

CREATE TABLE IF NOT EXISTS `jos_demiejournees_details_archives` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `user` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `npers` smallint(6) NOT NULL,
  `rem` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_dropset_node`
--

CREATE TABLE IF NOT EXISTS `jos_dropset_node` (
  `namekey` varchar(50) NOT NULL,
  `did` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `map` varchar(20) NOT NULL,
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `outype` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `wid` smallint(5) unsigned DEFAULT '0',
  `ref_sid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `first_value` int(10) unsigned NOT NULL DEFAULT '0',
  `first_all` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `lib_ext` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `external` varchar(60) NOT NULL,
  `first_caption` varchar(50) NOT NULL,
  `core` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `publish` tinyint(4) NOT NULL DEFAULT '1',
  `author` int(10) unsigned NOT NULL,
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `modified` int(10) unsigned NOT NULL,
  `params` text NOT NULL,
  `mon` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `role` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `sort` tinyint(3) unsigned NOT NULL,
  `sort_type` tinyint(3) unsigned NOT NULL,
  `sid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `level` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `rolid` smallint(5) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`did`),
  UNIQUE KEY `UK_dropset_node_namekey` (`namekey`),
  KEY `wid` (`wid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=192 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_dropset_trans`
--

CREATE TABLE IF NOT EXISTS `jos_dropset_trans` (
  `did` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `lgid` tinyint(3) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`did`,`lgid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_eguillage_node`
--

CREATE TABLE IF NOT EXISTS `jos_eguillage_node` (
  `ctrid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `namekey` varchar(100) NOT NULL,
  `app` varchar(100) NOT NULL,
  `task` varchar(100) NOT NULL DEFAULT 'default',
  `premium` tinyint(3) unsigned NOT NULL,
  `admin` tinyint(3) unsigned NOT NULL DEFAULT '250',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `yid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `wid` mediumint(8) unsigned NOT NULL,
  `level` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `publish` tinyint(4) NOT NULL DEFAULT '1',
  `workflow` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `path` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `you` tinyint(1) unsigned NOT NULL,
  `mine` tinyint(3) unsigned NOT NULL,
  `core` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `rolid` smallint(5) unsigned NOT NULL DEFAULT '1',
  `trigger` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `uyid` mediumint(5) unsigned NOT NULL,
  PRIMARY KEY (`ctrid`),
  UNIQUE KEY `UK_eguillage_node_app_task` (`app`,`task`,`admin`),
  UNIQUE KEY `UK_eiguillage_node_namekey` (`namekey`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=429 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_eguillage_redirect`
--

CREATE TABLE IF NOT EXISTS `jos_eguillage_redirect` (
  `ctrid` mediumint(8) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `ref_ctrid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ctrid`,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jos_extension_dependency`
--

CREATE TABLE IF NOT EXISTS `jos_extension_dependency` (
  `wid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ref_wid` mediumint(8) unsigned NOT NULL,
  `type` smallint(5) unsigned NOT NULL DEFAULT '0',
  `priority` smallint(5) unsigned NOT NULL,
  `filter` varchar(100) NOT NULL,
  `from` varchar(50) NOT NULL,
  `to` varchar(50) NOT NULL,
  `level` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `main` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`wid`,`ref_wid`),
  KEY `ref_wid` (`ref_wid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=124 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_extension_enabled`
--

CREATE TABLE IF NOT EXISTS `jos_extension_enabled` (
  `enabled` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `wid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`wid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `jos_extension_level`
--

CREATE TABLE IF NOT EXISTS `jos_extension_level` (
  `lwid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `level` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `namekey` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`lwid`),
  UNIQUE KEY `UK_extension_level_wid_level` (`wid`,`level`),
  UNIQUE KEY `UK_namekey` (`namekey`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_extension_leveltrans`
--

CREATE TABLE IF NOT EXISTS `jos_extension_leveltrans` (
  `lwid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lgid` tinyint(3) unsigned NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`lwid`,`lgid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_extension_node`
--

CREATE TABLE IF NOT EXISTS `jos_extension_node` (
  `wid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `namekey` varchar(100) NOT NULL,
  `folder` varchar(40) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` smallint(5) unsigned NOT NULL DEFAULT '1',
  `level` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `publish` tinyint(4) NOT NULL DEFAULT '1',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created` int(10) unsigned NOT NULL,
  `modified` int(10) unsigned NOT NULL,
  `params` text NOT NULL,
  `destination` varchar(255) NOT NULL,
  `parent` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `trans` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `license` varchar(255) NOT NULL,
  `certify` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `version` varchar(9) NOT NULL,
  `lversion` varchar(9) NOT NULL,
  `pref` tinyint(3) unsigned NOT NULL,
  `rolid` smallint(5) unsigned NOT NULL DEFAULT '1',
  `install` text NOT NULL,
  `ordering` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `core` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`wid`),
  UNIQUE KEY `UK_extension_node_namkey` (`namekey`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=124 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_extension_trans`
--

CREATE TABLE IF NOT EXISTS `jos_extension_trans` (
  `lgid` tinyint(3) unsigned NOT NULL,
  `wid` mediumint(8) unsigned NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`lgid`,`wid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jos_extension_version`
--

CREATE TABLE IF NOT EXISTS `jos_extension_version` (
  `vsid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wid` int(10) unsigned NOT NULL,
  `version` varchar(50) NOT NULL,
  `changelog` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `code` char(32) NOT NULL,
  `sha1` varchar(100) NOT NULL,
  `encoding` varchar(100) NOT NULL DEFAULT '0',
  `marketing` varchar(255) NOT NULL,
  `final` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`vsid`),
  KEY `wid` (`wid`,`sha1`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_filters_layout`
--

CREATE TABLE IF NOT EXISTS `jos_filters_layout` (
  `flid` smallint(5) unsigned NOT NULL,
  `yid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ordering` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`flid`,`yid`),
  KEY `yid` (`yid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jos_filters_node`
--

CREATE TABLE IF NOT EXISTS `jos_filters_node` (
  `flid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `bktbefore` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `sid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `map` varchar(20) NOT NULL,
  `condopr` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '2',
  `dsid` mediumint(8) unsigned NOT NULL,
  `dmap` varchar(20) NOT NULL,
  `bktafter` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `logicopr` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `level` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `publish` tinyint(4) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `refmap` varchar(30) NOT NULL,
  `ref_sid` smallint(5) NOT NULL,
  `typea` smallint(5) NOT NULL,
  `typeb` smallint(5) NOT NULL,
  `namekey` varchar(50) NOT NULL,
  `wid` smallint(5) unsigned DEFAULT '0',
  `ordering` tinyint(3) unsigned NOT NULL,
  `name` varchar(40) NOT NULL,
  PRIMARY KEY (`flid`),
  UNIQUE KEY `UK_filters_node_namekey` (`namekey`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=95 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_groups`
--

CREATE TABLE IF NOT EXISTS `jos_groups` (
  `id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jos_jce_extensions`
--

CREATE TABLE IF NOT EXISTS `jos_jce_extensions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `extension` varchar(255) NOT NULL,
  `folder` varchar(255) NOT NULL,
  `published` tinyint(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_jce_groups`
--

CREATE TABLE IF NOT EXISTS `jos_jce_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `users` text NOT NULL,
  `types` varchar(255) NOT NULL,
  `components` text NOT NULL,
  `rows` text NOT NULL,
  `plugins` varchar(255) NOT NULL,
  `published` tinyint(3) NOT NULL,
  `ordering` int(11) NOT NULL,
  `checked_out` tinyint(3) NOT NULL,
  `checked_out_time` datetime NOT NULL,
  `params` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_jce_plugins`
--

CREATE TABLE IF NOT EXISTS `jos_jce_plugins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `layout` varchar(255) NOT NULL,
  `row` int(11) NOT NULL,
  `ordering` int(11) NOT NULL,
  `published` tinyint(3) NOT NULL,
  `editable` tinyint(3) NOT NULL,
  `iscore` tinyint(3) NOT NULL,
  `elements` varchar(255) NOT NULL,
  `checked_out` int(11) NOT NULL,
  `checked_out_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `plugin` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=59 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_jpfchat`
--

CREATE TABLE IF NOT EXISTS `jos_jpfchat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `tab` int(5) NOT NULL,
  `seq` int(5) NOT NULL,
  `prompt` varchar(30) NOT NULL,
  `value` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `type` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_jp_dbtf`
--

CREATE TABLE IF NOT EXISTS `jos_jp_dbtf` (
  `dbtf_id` int(11) NOT NULL AUTO_INCREMENT,
  `tablename` mediumtext NOT NULL,
  PRIMARY KEY (`dbtf_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_jp_def`
--

CREATE TABLE IF NOT EXISTS `jos_jp_def` (
  `def_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `directory` mediumtext NOT NULL,
  PRIMARY KEY (`def_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_jp_extradb`
--

CREATE TABLE IF NOT EXISTS `jos_jp_extradb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `host` varchar(255) NOT NULL,
  `port` varchar(6) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `database` varchar(255) NOT NULL,
  `usefilters` tinyint(4) NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_jp_packvars`
--

CREATE TABLE IF NOT EXISTS `jos_jp_packvars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  `value2` longtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1366 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_jp_sff`
--

CREATE TABLE IF NOT EXISTS `jos_jp_sff` (
  `sff_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `file` mediumtext NOT NULL,
  PRIMARY KEY (`sff_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_list_members`
--

CREATE TABLE IF NOT EXISTS `jos_list_members` (
  `lsid` mediumint(8) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `manual` tinyint(255) unsigned NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `invite` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`lsid`,`uid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jos_list_news`
--

CREATE TABLE IF NOT EXISTS `jos_list_news` (
  `lsid` mediumint(8) unsigned NOT NULL,
  `sdsub` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `sdunsub` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `fendshow` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `mgidunsub` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `mgidsub` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`lsid`),
  KEY `lsid` (`lsid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jos_list_node`
--

CREATE TABLE IF NOT EXISTS `jos_list_node` (
  `lsid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `namekey` varchar(50) NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `publish` tinyint(4) NOT NULL,
  `mode` tinyint(3) unsigned NOT NULL,
  `params` text NOT NULL,
  `premium` tinyint(3) unsigned NOT NULL,
  `ordering` tinyint(3) unsigned NOT NULL,
  `rolid` smallint(5) unsigned NOT NULL DEFAULT '1',
  `core` tinyint(4) NOT NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`lsid`),
  UNIQUE KEY `namekey` (`namekey`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_list_trans`
--

CREATE TABLE IF NOT EXISTS `jos_list_trans` (
  `lsid` mediumint(8) unsigned NOT NULL,
  `lgid` tinyint(3) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`lsid`,`lgid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jos_lxmenu`
--

CREATE TABLE IF NOT EXISTS `jos_lxmenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `main_id` int(11) NOT NULL DEFAULT '0',
  `sub_id` int(11) NOT NULL DEFAULT '0',
  `outer_bg_color` varchar(7) NOT NULL DEFAULT '#FFFFFF',
  `inner_bg_color` varchar(7) NOT NULL DEFAULT '#FFFFFF',
  `outer_bg_color_hl` varchar(7) NOT NULL DEFAULT '#FFFFFF',
  `inner_bg_color_hl` varchar(7) NOT NULL DEFAULT '#FFFFFF',
  `inner_border_type` varchar(20) NOT NULL DEFAULT 'none',
  `inner_border_type_hl` varchar(20) NOT NULL DEFAULT 'none',
  `inner_border_color` varchar(7) NOT NULL DEFAULT '#FFFFFF',
  `inner_border_color_hl` varchar(7) NOT NULL DEFAULT '#FFFFFF',
  `inner_border_size` smallint(2) NOT NULL DEFAULT '0',
  `font_family` varchar(150) NOT NULL DEFAULT 'verdana,tahoma,arial',
  `font_size` smallint(2) NOT NULL DEFAULT '10',
  `item_width` smallint(3) NOT NULL DEFAULT '120',
  `item_height` smallint(3) NOT NULL DEFAULT '20',
  `item_text_color` varchar(20) NOT NULL DEFAULT '#000000',
  `item_text_align` varchar(20) NOT NULL DEFAULT 'left',
  `item_text_weight` varchar(20) NOT NULL DEFAULT 'normal',
  `item_text_decoration` varchar(20) NOT NULL DEFAULT 'none',
  `item_text_wspace` varchar(20) NOT NULL DEFAULT 'normal',
  `item_text_color_hl` varchar(20) NOT NULL DEFAULT '#000000',
  `item_text_align_hl` varchar(20) NOT NULL DEFAULT 'left',
  `item_text_weight_hl` varchar(20) NOT NULL DEFAULT 'normal',
  `item_text_decoration_hl` varchar(20) NOT NULL DEFAULT 'none',
  `item_text_wspace_hl` varchar(20) NOT NULL DEFAULT 'normal',
  `inner_padding_top` smallint(2) NOT NULL DEFAULT '0',
  `inner_padding_right` smallint(2) NOT NULL DEFAULT '0',
  `inner_padding_bottom` smallint(2) NOT NULL DEFAULT '0',
  `inner_padding_left` smallint(2) NOT NULL DEFAULT '0',
  `outer_padding_top` smallint(2) NOT NULL DEFAULT '0',
  `outer_padding_right` smallint(2) NOT NULL DEFAULT '0',
  `outer_padding_bottom` smallint(2) NOT NULL DEFAULT '0',
  `outer_padding_left` smallint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_lxmenu_config`
--

CREATE TABLE IF NOT EXISTS `jos_lxmenu_config` (
  `id` int(11) NOT NULL DEFAULT '0',
  `version` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jos_lxmenu_main`
--

CREATE TABLE IF NOT EXISTS `jos_lxmenu_main` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT 'mainmenu',
  `direction` varchar(20) NOT NULL DEFAULT 'horizontal',
  `position_style` varchar(20) NOT NULL DEFAULT 'relative',
  `position_left` smallint(4) NOT NULL DEFAULT '0',
  `position_top` smallint(4) NOT NULL DEFAULT '0',
  `pop_on_click` tinyint(1) NOT NULL DEFAULT '0',
  `expand_delay` smallint(4) NOT NULL DEFAULT '0',
  `hide_delay` smallint(4) NOT NULL DEFAULT '600',
  `transparency_create` tinyint(1) NOT NULL DEFAULT '0',
  `transparency` smallint(3) NOT NULL DEFAULT '80',
  `menu_align` varchar(10) NOT NULL DEFAULT 'left',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_lxmenu_sub`
--

CREATE TABLE IF NOT EXISTS `jos_lxmenu_sub` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `main_id` int(11) NOT NULL DEFAULT '0',
  `transparency_create` tinyint(1) NOT NULL DEFAULT '0',
  `transparency` smallint(3) NOT NULL DEFAULT '80',
  `direction` varchar(10) NOT NULL DEFAULT 'right',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_mailing_node`
--

CREATE TABLE IF NOT EXISTS `jos_mailing_node` (
  `mgid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `wid` mediumint(8) unsigned NOT NULL,
  `namekey` varchar(50) NOT NULL,
  `fendshow` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `rolid` smallint(5) unsigned NOT NULL DEFAULT '1',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `created` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `publish` tinyint(4) NOT NULL DEFAULT '1',
  `senddate` int(11) unsigned NOT NULL DEFAULT '0',
  `delay` int(10) unsigned NOT NULL,
  `stats` tinyint(3) unsigned NOT NULL,
  `tplid` int(10) unsigned NOT NULL,
  `html` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `alias` varchar(255) NOT NULL,
  `params` text NOT NULL,
  `level` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`mgid`),
  UNIQUE KEY `IX_mailing_node_namekey` (`namekey`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_mailing_trans`
--

CREATE TABLE IF NOT EXISTS `jos_mailing_trans` (
  `mgid` mediumint(8) unsigned NOT NULL,
  `lgid` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `name` varchar(255) NOT NULL,
  `ctext` text NOT NULL,
  `chtml` text NOT NULL,
  `smail` char(100) NOT NULL,
  `sname` char(50) NOT NULL,
  `rmail` varchar(100) NOT NULL,
  `rname` varchar(100) NOT NULL,
  PRIMARY KEY (`mgid`,`lgid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jos_memberscat_node`
--

CREATE TABLE IF NOT EXISTS `jos_memberscat_node` (
  `catid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `namekey` varchar(40) NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `ordering` smallint(5) unsigned NOT NULL DEFAULT '99',
  `premium` tinyint(3) unsigned NOT NULL,
  `publish` tinyint(4) NOT NULL,
  `modified` int(10) unsigned NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `rgt` mediumint(8) unsigned NOT NULL,
  `lft` mediumint(8) unsigned NOT NULL,
  `parent` mediumint(8) unsigned NOT NULL,
  `filid` int(10) unsigned NOT NULL,
  `rolid` smallint(5) unsigned NOT NULL DEFAULT '1',
  `depth` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`catid`),
  UNIQUE KEY `UQ_members_categories_1` (`namekey`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_memberscat_ref`
--

CREATE TABLE IF NOT EXISTS `jos_memberscat_ref` (
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `catid` int(10) unsigned NOT NULL,
  `invite` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `date` int(10) unsigned NOT NULL,
  PRIMARY KEY (`uid`,`catid`),
  KEY `cid` (`catid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jos_memberscat_trans`
--

CREATE TABLE IF NOT EXISTS `jos_memberscat_trans` (
  `lgid` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`lgid`,`catid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_members_info`
--

CREATE TABLE IF NOT EXISTS `jos_members_info` (
  `uid` int(10) unsigned NOT NULL,
  `filid` int(10) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `mname` varchar(40) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` char(48) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jos_members_ip`
--

CREATE TABLE IF NOT EXISTS `jos_members_ip` (
  `ipid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `ip` varchar(40) NOT NULL,
  `created` int(10) unsigned NOT NULL,
  PRIMARY KEY (`ipid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_members_lang`
--

CREATE TABLE IF NOT EXISTS `jos_members_lang` (
  `uid` int(10) unsigned NOT NULL,
  `lgid` tinyint(3) unsigned NOT NULL,
  `ordering` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`uid`,`lgid`),
  KEY `lgid` (`lgid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jos_members_node`
--

CREATE TABLE IF NOT EXISTS `jos_members_node` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id` int(10) unsigned NOT NULL,
  `name` varchar(200) NOT NULL,
  `username` varchar(40) NOT NULL,
  `openid` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `block` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `activation` varchar(32) NOT NULL,
  `timezone` time NOT NULL DEFAULT '00:00:00',
  `confirmed` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `registerdate` datetime NOT NULL,
  `modified` int(10) unsigned NOT NULL,
  `lgid` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `html` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `registered` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `unsub` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `login` datetime NOT NULL,
  `rolid` smallint(5) unsigned NOT NULL DEFAULT '1',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `IX_members_node_username` (`username`),
  KEY `id` (`id`),
  KEY `IX_members_node_email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=86 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_menu`
--

CREATE TABLE IF NOT EXISTS `jos_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menutype` varchar(75) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `link` text,
  `type` varchar(50) NOT NULL DEFAULT '',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `parent` int(11) unsigned NOT NULL DEFAULT '0',
  `componentid` int(11) unsigned NOT NULL DEFAULT '0',
  `sublevel` int(11) DEFAULT '0',
  `ordering` int(11) DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `pollid` int(11) NOT NULL DEFAULT '0',
  `browserNav` tinyint(4) DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `utaccess` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `lft` int(11) unsigned NOT NULL DEFAULT '0',
  `rgt` int(11) unsigned NOT NULL DEFAULT '0',
  `home` int(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `componentid` (`componentid`,`menutype`,`published`,`access`),
  KEY `menutype` (`menutype`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=191 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_menu_types`
--

CREATE TABLE IF NOT EXISTS `jos_menu_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menutype` varchar(75) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `menutype` (`menutype`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_messages`
--

CREATE TABLE IF NOT EXISTS `jos_messages` (
  `message_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id_from` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id_to` int(10) unsigned NOT NULL DEFAULT '0',
  `folder_id` int(10) unsigned NOT NULL DEFAULT '0',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `state` int(11) NOT NULL DEFAULT '0',
  `priority` int(1) unsigned NOT NULL DEFAULT '0',
  `subject` text NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `useridto_state` (`user_id_to`,`state`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_messages_cfg`
--

CREATE TABLE IF NOT EXISTS `jos_messages_cfg` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `cfg_name` varchar(100) NOT NULL DEFAULT '',
  `cfg_value` varchar(255) NOT NULL DEFAULT '',
  UNIQUE KEY `idx_user_var_name` (`user_id`,`cfg_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jos_message_node`
--

CREATE TABLE IF NOT EXISTS `jos_message_node` (
  `mgid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `namekey` varchar(50) NOT NULL,
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `priority` tinyint(3) unsigned NOT NULL DEFAULT '254',
  `repetition` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `expiration` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `frequency` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `askme` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `alias` varchar(100) NOT NULL,
  `core` tinyint(3) unsigned NOT NULL,
  `wid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`mgid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_message_queue`
--

CREATE TABLE IF NOT EXISTS `jos_message_queue` (
  `mgqid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mgid` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `nextdate` int(10) unsigned NOT NULL,
  `priority` tinyint(3) unsigned NOT NULL DEFAULT '254',
  `expirationdate` int(10) unsigned NOT NULL,
  `wid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `repetition` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `params` text NOT NULL,
  PRIMARY KEY (`mgqid`),
  KEY `IX_message_queue_nextdate` (`nextdate`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_message_trans`
--

CREATE TABLE IF NOT EXISTS `jos_message_trans` (
  `mgid` int(10) unsigned NOT NULL,
  `lgid` tinyint(3) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`mgid`,`lgid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jos_migration_backlinks`
--

CREATE TABLE IF NOT EXISTS `jos_migration_backlinks` (
  `itemid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `url` text NOT NULL,
  `sefurl` text NOT NULL,
  `newurl` text NOT NULL,
  PRIMARY KEY (`itemid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jos_model_node`
--

CREATE TABLE IF NOT EXISTS `jos_model_node` (
  `sid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `dbtid` int(10) unsigned NOT NULL,
  `path` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `namekey` varchar(255) NOT NULL,
  `folder` varchar(255) DEFAULT NULL,
  `rolid` smallint(5) unsigned NOT NULL DEFAULT '1',
  `level` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `publish` tinyint(4) NOT NULL DEFAULT '1',
  `created` int(10) unsigned NOT NULL DEFAULT '0',
  `extended` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `params` text,
  `checkval` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `alias` varchar(255) DEFAULT NULL,
  `ordering` smallint(5) unsigned NOT NULL DEFAULT '0',
  `prefix` varchar(50) DEFAULT NULL,
  `suffix` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`sid`),
  UNIQUE KEY `UK_model_node_namekey` (`namekey`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=133 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_model_trans`
--

CREATE TABLE IF NOT EXISTS `jos_model_trans` (
  `sid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `lgid` smallint(5) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`sid`,`lgid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=132 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_modules`
--

CREATE TABLE IF NOT EXISTS `jos_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `position` varchar(50) DEFAULT NULL,
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `module` varchar(50) DEFAULT NULL,
  `numnews` int(11) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `showtitle` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `params` text NOT NULL,
  `iscore` tinyint(4) NOT NULL DEFAULT '0',
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  `control` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `published` (`published`,`access`),
  KEY `newsfeeds` (`module`,`published`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=77 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_modules_menu`
--

CREATE TABLE IF NOT EXISTS `jos_modules_menu` (
  `moduleid` int(11) NOT NULL DEFAULT '0',
  `menuid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`moduleid`,`menuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jos_newsfeeds`
--

CREATE TABLE IF NOT EXISTS `jos_newsfeeds` (
  `catid` int(11) NOT NULL DEFAULT '0',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `link` text NOT NULL,
  `filename` varchar(200) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `numarticles` int(11) unsigned NOT NULL DEFAULT '1',
  `cache_time` int(11) unsigned NOT NULL DEFAULT '3600',
  `checked_out` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `rtl` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `published` (`published`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_pdds`
--

CREATE TABLE IF NOT EXISTS `jos_pdds` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `PDDINo` int(4) DEFAULT NULL,
  `PDDTexte` varchar(255) DEFAULT NULL,
  `PDDNom` varchar(255) DEFAULT NULL,
  `PDDAdr` varchar(255) DEFAULT NULL,
  `PDDNoRue` varchar(255) DEFAULT NULL,
  `PDDTele` varchar(255) DEFAULT NULL,
  `PDDLieu` varchar(255) DEFAULT NULL,
  `PDDEmail` varchar(255) DEFAULT NULL,
  `PDDRem` text,
  `PDDGP` int(4) DEFAULT NULL,
  `PDDPP` int(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_phocagallery`
--

CREATE TABLE IF NOT EXISTS `jos_phocagallery` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL DEFAULT '0',
  `sid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(250) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `filename` varchar(250) NOT NULL DEFAULT '',
  `description` text,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hits` int(11) NOT NULL DEFAULT '0',
  `latitude` varchar(20) NOT NULL DEFAULT '',
  `longitude` varchar(20) NOT NULL DEFAULT '',
  `zoom` int(3) NOT NULL DEFAULT '0',
  `geotitle` varchar(255) NOT NULL DEFAULT '',
  `videocode` text,
  `vmproductid` int(11) NOT NULL DEFAULT '0',
  `imgorigsize` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `params` text,
  `metakey` text,
  `metadesc` text,
  `extlink1` text,
  `extlink2` text,
  `extid` varchar(255) NOT NULL DEFAULT '',
  `extl` varchar(255) NOT NULL DEFAULT '',
  `extm` varchar(255) NOT NULL DEFAULT '',
  `exts` varchar(255) NOT NULL DEFAULT '',
  `exto` varchar(255) NOT NULL DEFAULT '',
  `extw` varchar(255) NOT NULL DEFAULT '',
  `exth` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `catid` (`catid`,`published`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=89 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_phocagallery_categories`
--

CREATE TABLE IF NOT EXISTS `jos_phocagallery_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `owner_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT '',
  `section` varchar(50) NOT NULL DEFAULT '',
  `image_position` varchar(30) NOT NULL DEFAULT '',
  `description` text,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `editor` varchar(50) DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `count` int(11) NOT NULL DEFAULT '0',
  `hits` int(11) NOT NULL DEFAULT '0',
  `accessuserid` text,
  `uploaduserid` text,
  `deleteuserid` text,
  `userfolder` text,
  `latitude` varchar(20) NOT NULL DEFAULT '',
  `longitude` varchar(20) NOT NULL DEFAULT '',
  `zoom` int(3) NOT NULL DEFAULT '0',
  `geotitle` varchar(255) NOT NULL DEFAULT '',
  `extid` varchar(255) NOT NULL DEFAULT '',
  `exta` varchar(255) NOT NULL DEFAULT '',
  `extu` varchar(255) NOT NULL DEFAULT '',
  `extauth` varchar(255) NOT NULL DEFAULT '',
  `params` text,
  `metakey` text,
  `metadesc` text,
  PRIMARY KEY (`id`),
  KEY `cat_idx` (`section`,`published`,`access`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_phocagallery_comments`
--

CREATE TABLE IF NOT EXISTS `jos_phocagallery_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `title` varchar(255) NOT NULL DEFAULT '',
  `comment` text,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `params` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_phocagallery_img_comments`
--

CREATE TABLE IF NOT EXISTS `jos_phocagallery_img_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imgid` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `title` varchar(255) NOT NULL DEFAULT '',
  `comment` text,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `params` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_phocagallery_img_votes`
--

CREATE TABLE IF NOT EXISTS `jos_phocagallery_img_votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imgid` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `rating` tinyint(1) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `params` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_phocagallery_img_votes_statistics`
--

CREATE TABLE IF NOT EXISTS `jos_phocagallery_img_votes_statistics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imgid` int(11) NOT NULL DEFAULT '0',
  `count` int(11) NOT NULL DEFAULT '0',
  `average` float(8,6) NOT NULL DEFAULT '0.000000',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_phocagallery_user`
--

CREATE TABLE IF NOT EXISTS `jos_phocagallery_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL DEFAULT '0',
  `avatar` varchar(40) NOT NULL DEFAULT '',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `params` text,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_phocagallery_votes`
--

CREATE TABLE IF NOT EXISTS `jos_phocagallery_votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `rating` tinyint(1) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `params` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_phocagallery_votes_statistics`
--

CREATE TABLE IF NOT EXISTS `jos_phocagallery_votes_statistics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL DEFAULT '0',
  `count` int(11) NOT NULL DEFAULT '0',
  `average` float(8,6) NOT NULL DEFAULT '0.000000',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_plugins`
--

CREATE TABLE IF NOT EXISTS `jos_plugins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `element` varchar(100) NOT NULL DEFAULT '',
  `folder` varchar(100) NOT NULL DEFAULT '',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(3) NOT NULL DEFAULT '0',
  `iscore` tinyint(3) NOT NULL DEFAULT '0',
  `client_id` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_folder` (`published`,`client_id`,`access`,`folder`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_polls`
--

CREATE TABLE IF NOT EXISTS `jos_polls` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `voters` int(9) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `access` int(11) NOT NULL DEFAULT '0',
  `lag` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_poll_data`
--

CREATE TABLE IF NOT EXISTS `jos_poll_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pollid` int(11) NOT NULL DEFAULT '0',
  `text` text NOT NULL,
  `hits` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `pollid` (`pollid`,`text`(1))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_poll_date`
--

CREATE TABLE IF NOT EXISTS `jos_poll_date` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `vote_id` int(11) NOT NULL DEFAULT '0',
  `poll_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `poll_id` (`poll_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_poll_menu`
--

CREATE TABLE IF NOT EXISTS `jos_poll_menu` (
  `pollid` int(11) NOT NULL DEFAULT '0',
  `menuid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pollid`,`menuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jos_rd_rss`
--

CREATE TABLE IF NOT EXISTS `jos_rd_rss` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `catids` text NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_role_members`
--

CREATE TABLE IF NOT EXISTS `jos_role_members` (
  `rolid` smallint(5) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `credits` int(10) unsigned NOT NULL DEFAULT '0',
  `publish` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `start` int(10) unsigned NOT NULL,
  PRIMARY KEY (`rolid`,`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_role_node`
--

CREATE TABLE IF NOT EXISTS `jos_role_node` (
  `rolid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `parent` smallint(5) unsigned NOT NULL,
  `lft` smallint(5) unsigned NOT NULL,
  `rgt` smallint(5) unsigned NOT NULL,
  `core` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `joomla` tinyint(3) unsigned NOT NULL,
  `namekey` varchar(255) NOT NULL,
  `color` varchar(20) NOT NULL DEFAULT '',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `depth` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`rolid`),
  UNIQUE KEY `NameKey_Unique` (`namekey`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10000 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_role_trans`
--

CREATE TABLE IF NOT EXISTS `jos_role_trans` (
  `rolid` smallint(5) unsigned NOT NULL,
  `lgid` smallint(5) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`rolid`,`lgid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jos_scheduler_node`
--

CREATE TABLE IF NOT EXISTS `jos_scheduler_node` (
  `schid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(30) NOT NULL,
  `nextdate` int(10) unsigned NOT NULL,
  `frequency` mediumint(8) unsigned NOT NULL,
  `priority` tinyint(3) unsigned NOT NULL,
  `lastdate` int(10) unsigned NOT NULL,
  `publish` tinyint(4) NOT NULL DEFAULT '1',
  `created` int(10) unsigned NOT NULL,
  `params` text NOT NULL,
  `cron` varchar(255) NOT NULL DEFAULT '',
  `ptype` tinyint(3) unsigned NOT NULL,
  `addon` varchar(255) NOT NULL DEFAULT '',
  `complete` tinyint(4) unsigned NOT NULL DEFAULT '1',
  `namekey` varchar(50) NOT NULL DEFAULT '',
  `wid` mediumint(8) unsigned DEFAULT '0',
  PRIMARY KEY (`schid`),
  UNIQUE KEY `UK_scheduler_node_namekey` (`namekey`),
  KEY `nextdate` (`nextdate`,`priority`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_scheduler_trans`
--

CREATE TABLE IF NOT EXISTS `jos_scheduler_trans` (
  `schid` smallint(5) unsigned NOT NULL,
  `lgid` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`schid`,`lgid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jos_sections`
--

CREATE TABLE IF NOT EXISTS `jos_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `image` text NOT NULL,
  `scope` varchar(50) NOT NULL DEFAULT '',
  `image_position` varchar(30) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `count` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_scope` (`scope`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_session`
--

CREATE TABLE IF NOT EXISTS `jos_session` (
  `username` varchar(150) DEFAULT '',
  `time` varchar(14) DEFAULT '',
  `session_id` varchar(200) NOT NULL DEFAULT '0',
  `guest` tinyint(4) DEFAULT '1',
  `userid` int(11) DEFAULT '0',
  `usertype` varchar(50) DEFAULT '',
  `gid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `client_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `data` longtext,
  PRIMARY KEY (`session_id`(64)),
  KEY `whosonline` (`guest`,`usertype`),
  KEY `userid` (`userid`),
  KEY `time` (`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jos_simplecal`
--

CREATE TABLE IF NOT EXISTS `jos_simplecal` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `categoryID` int(11) DEFAULT NULL,
  `date1` date NOT NULL DEFAULT '0000-00-00',
  `date2` date DEFAULT '0000-00-00',
  `date3` date DEFAULT '0000-00-00',
  `from_time` time DEFAULT '00:00:00',
  `to_time` time DEFAULT '00:00:00',
  `entryName` varchar(64) NOT NULL DEFAULT '',
  `entryPlace` varchar(128) DEFAULT NULL,
  `entryLatLon` varchar(64) DEFAULT NULL,
  `entryGroupID` int(11) NOT NULL,
  `entryInfo` text,
  `entryIsPrivate` int(1) DEFAULT '0',
  `contactName` varchar(64) DEFAULT NULL,
  `contactEmail` varchar(64) DEFAULT NULL,
  `contactWebSite` varchar(255) DEFAULT NULL,
  `contactTelephone` varchar(32) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `published` int(1) DEFAULT '1',
  `price` varchar(32) DEFAULT '',
  `userid` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_simplecal_categories`
--

CREATE TABLE IF NOT EXISTS `jos_simplecal_categories` (
  `categoryID` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(32) NOT NULL DEFAULT '',
  `catid` int(11) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`categoryID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_simplecal_groups`
--

CREATE TABLE IF NOT EXISTS `jos_simplecal_groups` (
  `groupID` int(11) NOT NULL AUTO_INCREMENT,
  `groupAbbr` varchar(6) DEFAULT NULL,
  `groupName` varchar(64) DEFAULT NULL,
  `groupLatLon` varchar(64) DEFAULT NULL,
  `groupLogo` varchar(32) DEFAULT NULL,
  `contactName` varchar(64) DEFAULT NULL,
  `contactEmail` varchar(64) DEFAULT NULL,
  `contactWebSite` varchar(255) DEFAULT NULL,
  `contactTelephone` varchar(32) DEFAULT NULL,
  `imageFile` varchar(64) DEFAULT '',
  `showAlways` int(1) DEFAULT '0',
  `catid` int(11) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`groupID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_simplecal_settings`
--

CREATE TABLE IF NOT EXISTS `jos_simplecal_settings` (
  `id` int(11) NOT NULL DEFAULT '1',
  `use_gmap` int(1) DEFAULT '0',
  `gmap_api_key` varchar(255) DEFAULT '- set google api key here -',
  `show_donation_line` int(1) DEFAULT '1',
  `date_long_format` varchar(64) DEFAULT '%a %d.%m.%Y',
  `date_short_format` varchar(64) DEFAULT '%a %d.%m',
  `time_format` varchar(64) DEFAULT '%H:%M',
  `frontend_link_color` varchar(16) DEFAULT 'B8CDDC',
  `default_ordering` varchar(16) DEFAULT 'date',
  `show_search_bar` int(1) DEFAULT '1',
  `show_only_future_events` int(1) DEFAULT '1',
  `frontend_add_gid` int(11) DEFAULT '18',
  `frontend_edit_gid` int(11) DEFAULT '18',
  `gmap_std_latlon` varchar(32) DEFAULT '46,9',
  `currency` varchar(32) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jos_stats_agents`
--

CREATE TABLE IF NOT EXISTS `jos_stats_agents` (
  `agent` varchar(255) NOT NULL DEFAULT '',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `hits` int(11) unsigned NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jos_swmenufree_config`
--

CREATE TABLE IF NOT EXISTS `jos_swmenufree_config` (
  `id` int(11) NOT NULL DEFAULT '0',
  `main_top` smallint(8) DEFAULT '0',
  `main_left` smallint(8) DEFAULT '0',
  `main_height` smallint(8) DEFAULT '20',
  `sub_border_over` varchar(30) DEFAULT '0',
  `main_width` smallint(8) DEFAULT '100',
  `sub_width` smallint(8) DEFAULT '100',
  `main_back` varchar(7) DEFAULT '#4682B4',
  `main_over` varchar(7) DEFAULT '#5AA7E5',
  `sub_back` varchar(7) DEFAULT '#4682B4',
  `sub_over` varchar(7) DEFAULT '#5AA7E5',
  `sub_border` varchar(30) DEFAULT '#FFFFFF',
  `main_font_size` smallint(8) DEFAULT '0',
  `sub_font_size` smallint(8) DEFAULT '0',
  `main_border_over` varchar(30) DEFAULT '0',
  `sub_font_color` varchar(7) DEFAULT '#000000',
  `main_border` varchar(30) DEFAULT '#FFFFFF',
  `main_font_color` varchar(7) DEFAULT '#000000',
  `sub_font_color_over` varchar(7) DEFAULT '#FFFFFF',
  `main_font_color_over` varchar(7) DEFAULT '#FFFFFF',
  `main_align` varchar(8) DEFAULT 'left',
  `sub_align` varchar(8) DEFAULT 'left',
  `sub_height` smallint(7) DEFAULT '20',
  `position` varchar(10) DEFAULT 'absolute',
  `orientation` varchar(20) DEFAULT NULL,
  `font_family` varchar(50) DEFAULT 'Arial',
  `font_weight` varchar(10) DEFAULT 'normal',
  `font_weight_over` varchar(10) DEFAULT 'normal',
  `level2_sub_top` int(11) DEFAULT '0',
  `level2_sub_left` int(11) DEFAULT '0',
  `level1_sub_top` int(11) NOT NULL DEFAULT '0',
  `level1_sub_left` int(11) NOT NULL DEFAULT '0',
  `main_back_image` varchar(100) DEFAULT NULL,
  `main_back_image_over` varchar(100) DEFAULT NULL,
  `sub_back_image` varchar(100) DEFAULT NULL,
  `sub_back_image_over` varchar(100) DEFAULT NULL,
  `specialA` varchar(50) DEFAULT '80',
  `main_padding` varchar(40) DEFAULT '0px 0px 0px 0px',
  `sub_padding` varchar(40) DEFAULT '0px 0px 0px 0px',
  `specialB` varchar(100) DEFAULT '50',
  `sub_font_family` varchar(50) DEFAULT 'Arial',
  `extra` mediumtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jos_templates_menu`
--

CREATE TABLE IF NOT EXISTS `jos_templates_menu` (
  `template` varchar(255) NOT NULL DEFAULT '',
  `menuid` int(11) NOT NULL DEFAULT '0',
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`menuid`,`client_id`,`template`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jos_test`
--

CREATE TABLE IF NOT EXISTS `jos_test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `greeting` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_theme_node`
--

CREATE TABLE IF NOT EXISTS `jos_theme_node` (
  `tmid` smallint(6) NOT NULL AUTO_INCREMENT,
  `type` tinyint(3) unsigned NOT NULL,
  `namekey` varchar(100) NOT NULL,
  `publish` tinyint(4) NOT NULL,
  `description` text NOT NULL,
  `chtml` text NOT NULL,
  `ctext` text NOT NULL,
  `params` text NOT NULL,
  `premium` tinyint(4) NOT NULL DEFAULT '0',
  `ordering` tinyint(3) unsigned NOT NULL,
  `core` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `alias` varchar(255) NOT NULL,
  `wid` mediumint(9) DEFAULT '0',
  PRIMARY KEY (`tmid`),
  UNIQUE KEY `namekey` (`namekey`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_theme_trans`
--

CREATE TABLE IF NOT EXISTS `jos_theme_trans` (
  `tmid` smallint(6) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `lgid` tinyint(4) NOT NULL,
  PRIMARY KEY (`tmid`,`lgid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jos_translation_engine`
--

CREATE TABLE IF NOT EXISTS `jos_translation_engine` (
  `engid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `engine` tinyint(3) unsigned NOT NULL,
  `publish` tinyint(4) NOT NULL DEFAULT '1',
  `lgid` tinyint(3) unsigned NOT NULL,
  `ref_lgid` tinyint(3) unsigned NOT NULL,
  `ordering` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`engid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_translation_fr`
--

CREATE TABLE IF NOT EXISTS `jos_translation_fr` (
  `imac` varchar(255) NOT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `auto` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`imac`),
  FULLTEXT KEY `FTXT_translation_fr_text` (`text`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jos_translation_node`
--

CREATE TABLE IF NOT EXISTS `jos_translation_node` (
  `text` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `imac` varchar(255) NOT NULL,
  PRIMARY KEY (`imac`),
  FULLTEXT KEY `FTXT_translation_node_text` (`text`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jos_translation_reference`
--

CREATE TABLE IF NOT EXISTS `jos_translation_reference` (
  `wid` mediumint(8) unsigned NOT NULL,
  `trid` int(10) unsigned NOT NULL,
  `load` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `imac` varchar(255) NOT NULL,
  PRIMARY KEY (`wid`,`imac`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jos_translation_temp`
--

CREATE TABLE IF NOT EXISTS `jos_translation_temp` (
  `tempid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`tempid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_users`
--

CREATE TABLE IF NOT EXISTS `jos_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(150) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `usertype` varchar(25) NOT NULL DEFAULT '',
  `block` tinyint(4) NOT NULL DEFAULT '0',
  `sendEmail` tinyint(4) DEFAULT '0',
  `gid` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `registerDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastvisitDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `activation` varchar(100) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usertype` (`usertype`),
  KEY `idx_name` (`name`),
  KEY `gid_block` (`gid`,`block`),
  KEY `username` (`username`),
  KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=96 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_version`
--

CREATE TABLE IF NOT EXISTS `jos_version` (
  `id` double DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `title_alias` varchar(255) DEFAULT NULL,
  `introtext` blob,
  `fulltext` blob,
  `state` tinyint(3) DEFAULT NULL,
  `sectionid` double DEFAULT NULL,
  `mask` double DEFAULT NULL,
  `catid` double DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` double DEFAULT NULL,
  `created_by_alias` varchar(255) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` double DEFAULT NULL,
  `checked_out` double DEFAULT NULL,
  `checked_out_time` datetime DEFAULT NULL,
  `publish_up` datetime DEFAULT NULL,
  `publish_down` datetime DEFAULT NULL,
  `images` blob,
  `urls` blob,
  `attribs` blob,
  `version` double DEFAULT NULL,
  `parentid` double DEFAULT NULL,
  `ordering` double DEFAULT NULL,
  `metakey` blob,
  `metadesc` blob,
  `access` double DEFAULT NULL,
  `hits` double DEFAULT NULL,
  `metadata` blob,
  `content_id` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jos_weblinks`
--

CREATE TABLE IF NOT EXISTS `jos_weblinks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL DEFAULT '0',
  `sid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(250) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(250) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hits` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `archived` tinyint(1) NOT NULL DEFAULT '0',
  `approved` tinyint(1) NOT NULL DEFAULT '1',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `catid` (`catid`,`published`,`archived`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_xmap`
--

CREATE TABLE IF NOT EXISTS `jos_xmap` (
  `name` varchar(30) NOT NULL,
  `value` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jos_xmap_ext`
--

CREATE TABLE IF NOT EXISTS `jos_xmap_ext` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `extension` varchar(100) NOT NULL,
  `published` int(1) DEFAULT '0',
  `params` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `jos_xmap_sitemap`
--

CREATE TABLE IF NOT EXISTS `jos_xmap_sitemap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `expand_category` int(11) DEFAULT NULL,
  `expand_section` int(11) DEFAULT NULL,
  `show_menutitle` int(11) DEFAULT NULL,
  `columns` int(11) DEFAULT NULL,
  `exlinks` int(11) DEFAULT NULL,
  `ext_image` varchar(255) DEFAULT NULL,
  `menus` text,
  `exclmenus` varchar(255) DEFAULT NULL,
  `includelink` int(11) DEFAULT NULL,
  `usecache` int(11) DEFAULT NULL,
  `cachelifetime` int(11) DEFAULT NULL,
  `classname` varchar(255) DEFAULT NULL,
  `count_xml` int(11) DEFAULT NULL,
  `count_html` int(11) DEFAULT NULL,
  `views_xml` int(11) DEFAULT NULL,
  `views_html` int(11) DEFAULT NULL,
  `lastvisit_xml` int(11) DEFAULT NULL,
  `lastvisit_html` int(11) DEFAULT NULL,
  `excluded_items` varchar(255) DEFAULT NULL,
  `compress_xml` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `liste_attentes`
--

CREATE TABLE IF NOT EXISTS `liste_attentes` (
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `rue` varchar(255) NOT NULL,
  `cp` varchar(255) NOT NULL,
  `commune` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pdd` varchar(255) NOT NULL,
  `cocagne` varchar(255) NOT NULL,
  `part` varchar(255) NOT NULL,
  `classe` varchar(255) NOT NULL,
  `commentaires` varchar(255) NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id` int(12) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `tbl_cart`
--

CREATE TABLE IF NOT EXISTS `tbl_cart` (
  `ct_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pd_id` int(10) unsigned NOT NULL DEFAULT '0',
  `ct_qty` mediumint(8) unsigned NOT NULL DEFAULT '1',
  `ct_session_id` char(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `ct_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ct_id`),
  KEY `pd_id` (`pd_id`),
  KEY `ct_session_id` (`ct_session_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=104 ;

-- --------------------------------------------------------

--
-- Structure de la table `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
  `cat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cat_parent_id` int(11) NOT NULL DEFAULT '0',
  `cat_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `cat_description` text COLLATE utf8_unicode_ci NOT NULL,
  `cat_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`cat_id`),
  KEY `cat_parent_id` (`cat_parent_id`),
  KEY `cat_name` (`cat_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=52 ;

-- --------------------------------------------------------

--
-- Structure de la table `tbl_cocagnards`
--

CREATE TABLE IF NOT EXISTS `tbl_cocagnards` (
  `PersNo` int(20) NOT NULL AUTO_INCREMENT,
  `PersPDDDistrNo` int(20) DEFAULT NULL,
  `PersLogin` text COLLATE utf8_unicode_ci,
  `PersPasswd` text COLLATE utf8_unicode_ci,
  `PersNom` text COLLATE utf8_unicode_ci,
  `PersPrenom` text COLLATE utf8_unicode_ci,
  `PersAdresse` text COLLATE utf8_unicode_ci,
  `PersTelephone` text COLLATE utf8_unicode_ci,
  `PersNPA` text COLLATE utf8_unicode_ci,
  `PersLocalite` text COLLATE utf8_unicode_ci,
  `PersAdresseEmail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jos_user_id` int(12) NOT NULL,
  PRIMARY KEY (`PersNo`),
  UNIQUE KEY `PersAdresseEmail` (`PersAdresseEmail`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1074 ;

-- --------------------------------------------------------

--
-- Structure de la table `tbl_currency`
--

CREATE TABLE IF NOT EXISTS `tbl_currency` (
  `cy_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cy_code` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `cy_symbol` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`cy_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Structure de la table `tbl_customers`
--

CREATE TABLE IF NOT EXISTS `tbl_customers` (
  `PersNo` int(20) NOT NULL AUTO_INCREMENT,
  `PersPDDDistrNo` int(20) DEFAULT NULL,
  `PersNom` text COLLATE utf8_unicode_ci,
  `PersPrenom` text COLLATE utf8_unicode_ci,
  `PersAdresse` text COLLATE utf8_unicode_ci,
  `PersTelephone` text COLLATE utf8_unicode_ci,
  `PersNPA` text COLLATE utf8_unicode_ci,
  `PersLocalite` text COLLATE utf8_unicode_ci,
  `PersAdresseEmail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jos_user_id` int(12) NOT NULL,
  PRIMARY KEY (`PersNo`),
  UNIQUE KEY `jos_user_id` (`jos_user_id`),
  UNIQUE KEY `PersAdresseEmail` (`PersAdresseEmail`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Structure de la table `tbl_order`
--

CREATE TABLE IF NOT EXISTS `tbl_order` (
  `od_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `od_date` datetime DEFAULT NULL,
  `od_last_update` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `od_status` enum('Nouveau','Payé','Envoyé','Terminé','Supprimé') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Nouveau',
  `od_memo` text COLLATE utf8_unicode_ci NOT NULL,
  `od_shipping_user` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `date_livraison` date NOT NULL,
  PRIMARY KEY (`od_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Structure de la table `tbl_order_item`
--

CREATE TABLE IF NOT EXISTS `tbl_order_item` (
  `od_id` int(10) unsigned NOT NULL DEFAULT '0',
  `pd_id` int(10) unsigned NOT NULL DEFAULT '0',
  `od_qty` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`od_id`,`pd_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tbl_product`
--

CREATE TABLE IF NOT EXISTS `tbl_product` (
  `pd_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cat_id` int(10) unsigned NOT NULL DEFAULT '0',
  `pd_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pd_description` text COLLATE utf8_unicode_ci NOT NULL,
  `pd_price` decimal(9,2) NOT NULL DEFAULT '0.00',
  `pd_qty` smallint(5) unsigned NOT NULL DEFAULT '0',
  `pd_image` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pd_thumbnail` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pd_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `pd_last_update` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`pd_id`),
  KEY `cat_id` (`cat_id`),
  KEY `pd_name` (`pd_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1036 ;

-- --------------------------------------------------------

--
-- Structure de la table `tbl_shop_config`
--

CREATE TABLE IF NOT EXISTS `tbl_shop_config` (
  `sc_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `sc_address` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `sc_phone` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `sc_email` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `sc_shipping_cost` decimal(5,2) NOT NULL DEFAULT '0.00',
  `sc_currency` int(10) unsigned NOT NULL DEFAULT '1',
  `sc_order_email` enum('y','n') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tbl_titre`
--

CREATE TABLE IF NOT EXISTS `tbl_titre` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `titre` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_regdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

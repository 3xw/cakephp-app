# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.7.26)
# Database: attachment
# Generation Time: 2019-09-11 07:10:45 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table ai18n
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ai18n`;

CREATE TABLE `ai18n` (
  `id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `locale` varchar(6) NOT NULL,
  `model` varchar(255) NOT NULL,
  `foreign_key` char(36) NOT NULL,
  `field` varchar(255) NOT NULL,
  `content` text,
  PRIMARY KEY (`id`),
  KEY `fkey` (`foreign_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table atag_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `atag_types`;

CREATE TABLE `atag_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `exclusive` tinyint(1) NOT NULL DEFAULT '0',
  `order` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table atags
# ------------------------------------------------------------

DROP TABLE IF EXISTS `atags`;

CREATE TABLE `atags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `atag_type_id` int(11) DEFAULT NULL,
  `user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  UNIQUE KEY `slug_UNIQUE` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `atags` WRITE;
/*!40000 ALTER TABLE `atags` DISABLE KEYS */;

INSERT INTO `atags` (`id`, `name`, `slug`, `atag_type_id`, `user_id`)
VALUES
	(1,'A1 Junction Grand-saconnex','A1-Junction-Grand-saconnex',NULL,NULL),
	(2,'A1 Goulet Crissier','A1-Goulet-Crissier',NULL,NULL),
	(3,'démolition','demolition',NULL,NULL),
	(4,'pont','pont',NULL,NULL),
	(5,'terrassement','terrassement',NULL,NULL),
	(6,'construction','construction',NULL,NULL),
	(7,'marquage','marquage',NULL,NULL),
	(8,'etc','etc',NULL,NULL),
	(9,'jour','jour',NULL,NULL),
	(10,'nuit','nuit',NULL,NULL),
	(11,'coucher soleil','coucher-soleil',NULL,NULL),
	(12,'levé soleil','leve-soleil',NULL,NULL);

/*!40000 ALTER TABLE `atags` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table attachments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `attachments`;

CREATE TABLE `attachments` (
  `id` char(36) NOT NULL,
  `profile` varchar(45) NOT NULL DEFAULT 'default',
  `type` varchar(45) NOT NULL,
  `subtype` varchar(45) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) NOT NULL,
  `size` bigint(19) unsigned NOT NULL,
  `md5` varchar(32) NOT NULL,
  `path` varchar(255) DEFAULT NULL,
  `embed` text,
  `title` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `description` text,
  `author` varchar(255) DEFAULT NULL,
  `copyright` varchar(255) DEFAULT NULL,
  `width` int(10) unsigned DEFAULT '0',
  `height` int(10) unsigned DEFAULT '0',
  `duration` int(10) unsigned DEFAULT NULL,
  `meta` text,
  `user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `attachments` WRITE;
/*!40000 ALTER TABLE `attachments` DISABLE KEYS */;

INSERT INTO `attachments` (`id`, `profile`, `type`, `subtype`, `created`, `modified`, `name`, `size`, `md5`, `path`, `embed`, `title`, `date`, `description`, `author`, `copyright`, `width`, `height`, `duration`, `meta`, `user_id`)
VALUES
	('a8dcc873-b1de-4712-8360-b828b40c9ea1','default','image','jpeg','2019-08-14 15:21:48','2019-08-14 15:21:48','_billet.jpg',353133,'ff2a73c7865a77c67b68f159951989fa','1565796108__billet.jpg',NULL,'','2019-08-14 15:21:48','','','',2223,708,NULL,'{\"FileName\":\"phpfV3ZIk\",\"FileDateTime\":1565796108,\"FileSize\":353133,\"FileType\":2,\"MimeType\":\"image\\/jpeg\",\"SectionsFound\":\"APP12\",\"COMPUTED\":{\"html\":\"width=\\\"2223\\\" height=\\\"708\\\"\",\"Height\":708,\"Width\":2223,\"IsColor\":1},\"Company\":\"Ducky\",\"Info\":\"\\u0001\"}','f3c3ee20-7e40-42da-ae0f-bbe6b842668d');

/*!40000 ALTER TABLE `attachments` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table attachments_atags
# ------------------------------------------------------------

DROP TABLE IF EXISTS `attachments_atags`;

CREATE TABLE `attachments_atags` (
  `attachment_id` char(36) NOT NULL,
  `atag_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`attachment_id`,`atag_id`),
  KEY `fk_attachments_has_atags_atags1_idx` (`atag_id`),
  KEY `fk_attachments_has_atags_attachments_idx` (`attachment_id`),
  CONSTRAINT `fk_attachments_has_atags_atags1` FOREIGN KEY (`atag_id`) REFERENCES `atags` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_attachments_has_atags_attachments` FOREIGN KEY (`attachment_id`) REFERENCES `attachments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table i18n
# ------------------------------------------------------------

DROP TABLE IF EXISTS `i18n`;

CREATE TABLE `i18n` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `locale` varchar(6) NOT NULL,
  `model` varchar(255) NOT NULL,
  `foreign_key` bigint(20) NOT NULL,
  `field` varchar(255) NOT NULL,
  `content` text,
  PRIMARY KEY (`id`),
  KEY `locale` (`locale`),
  KEY `model` (`model`),
  KEY `foreign_key` (`foreign_key`),
  KEY `field` (`field`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `token_expires` datetime DEFAULT NULL,
  `api_token` varchar(255) DEFAULT NULL,
  `activation_date` datetime DEFAULT NULL,
  `tos_date` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `is_superuser` tinyint(1) NOT NULL DEFAULT '0',
  `role` varchar(255) DEFAULT 'user',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `attachment_id` varchar(45) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `username`, `email`, `password`, `first_name`, `last_name`, `token`, `token_expires`, `api_token`, `activation_date`, `tos_date`, `active`, `is_superuser`, `role`, `created`, `modified`, `attachment_id`)
VALUES
	('f3c3ee20-7e40-42da-ae0f-bbe6b842668d','awallef','wallef@wgr.ch','$2y$10$Lb5RSDjBS7HlOFIrvhjOyejdRyU1t58K9CHPPYPrNdK0JrGbUpp6W','Antoine','Wallef',NULL,NULL,NULL,NULL,NULL,1,1,'superuser','2019-08-14 13:07:04','2019-08-14 13:25:35','0');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

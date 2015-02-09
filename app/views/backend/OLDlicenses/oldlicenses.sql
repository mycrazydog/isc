# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.30)
# Database: db_isc
# Generation Time: 2015-02-09 19:08:48 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table OLDlicenses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `OLDlicenses`;

CREATE TABLE `OLDlicenses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `licensestatus` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `funding` int(11) NOT NULL,
  `policy` int(11) NOT NULL,
  `program` int(11) NOT NULL,
  `evaluate` int(11) NOT NULL,
  `responsible` int(11) NOT NULL,
  `confidential` int(11) NOT NULL,
  `irb` int(11) NOT NULL,
  `benefit` int(11) NOT NULL,
  `credentials` int(11) NOT NULL,
  `initial` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `OLDlicenses` WRITE;
/*!40000 ALTER TABLE `OLDlicenses` DISABLE KEYS */;

INSERT INTO `OLDlicenses` (`id`, `user_id`, `licensestatus`, `funding`, `policy`, `program`, `evaluate`, `responsible`, `confidential`, `irb`, `benefit`, `credentials`, `initial`, `created_at`, `updated_at`)
VALUES
	(2,3,'Processing',1,1,1,1,1,1,1,1,1,'partner-web1.org','2015-01-13 14:11:23','2015-01-13 14:13:02');

/*!40000 ALTER TABLE `OLDlicenses` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

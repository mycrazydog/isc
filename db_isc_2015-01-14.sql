# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.38-0ubuntu0.14.04.1)
# Database: db_isc
# Generation Time: 2015-01-14 13:45:32 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table comments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `post_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;

INSERT INTO `comments` (`id`, `parent_id`, `post_id`, `user_id`, `content`, `created_at`, `updated_at`)
VALUES
	(1,NULL,1,2,'Lorem ipsum dolor sit amet, mutat utinam nonumy ea mel.','2014-10-26 15:34:02','2014-10-26 15:34:02'),
	(2,NULL,1,2,'Lorem ipsum dolor sit amet, sale ceteros liberavisse duo ex, nam mazim maiestatis dissentiunt no. Iusto nominavi cu sed, has.','2014-10-30 17:34:02','2014-10-30 17:34:02'),
	(3,NULL,1,2,'Et consul eirmod feugait mel! Te vix iuvaret feugiat repudiandae. Solet dolore lobortis mei te, saepe habemus imperdiet ex vim. Consequat signiferumque per no, ne pri erant vocibus invidunt te.','2014-11-09 19:34:02','2014-11-09 19:34:02'),
	(4,NULL,2,2,'Lorem ipsum dolor sit amet, mutat utinam nonumy ea mel.','2014-11-09 15:34:02','2014-11-09 15:34:02'),
	(5,NULL,2,2,'Lorem ipsum dolor sit amet, sale ceteros liberavisse duo ex, nam mazim maiestatis dissentiunt no. Iusto nominavi cu sed, has.','2014-11-11 17:34:02','2014-11-11 17:34:02'),
	(6,NULL,3,2,'Lorem ipsum dolor sit amet, mutat utinam nonumy ea mel.','2014-11-11 15:34:02','2014-11-11 15:34:02');

/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `groups_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;

INSERT INTO `groups` (`id`, `name`, `permissions`, `created_at`, `updated_at`)
VALUES
	(1,'Admin','{\"superuser\":1,\"admin\":1,\"posts.write\":1,\"posts.read\":1,\"users\":1}','2014-11-13 13:34:02','2014-11-13 13:34:02'),
	(2,'Authors','{\"posts.write\":1,\"posts.read\":1,\"post.read\":1,\"post.create\":1}','2014-11-13 13:34:02','2014-11-17 19:27:02'),
	(3,'User','{\"posts.read\":1}','2014-11-13 13:34:02','2014-11-17 20:56:33');

/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table licenses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `licenses`;

CREATE TABLE `licenses` (
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

LOCK TABLES `licenses` WRITE;
/*!40000 ALTER TABLE `licenses` DISABLE KEYS */;

INSERT INTO `licenses` (`id`, `user_id`, `licensestatus`, `funding`, `policy`, `program`, `evaluate`, `responsible`, `confidential`, `irb`, `benefit`, `credentials`, `initial`, `created_at`, `updated_at`)
VALUES
	(2,3,'Processing',1,1,1,1,1,1,1,1,1,'partner-web1.org','2015-01-13 14:11:23','2015-01-13 14:13:02');

/*!40000 ALTER TABLE `licenses` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`migration`, `batch`)
VALUES
	('2012_12_06_225921_migration_cartalyst_sentry_install_users',1),
	('2012_12_06_225929_migration_cartalyst_sentry_install_groups',1),
	('2012_12_06_225945_migration_cartalyst_sentry_install_users_groups_pivot',1),
	('2012_12_06_225988_migration_cartalyst_sentry_install_throttle',1),
	('2013_01_19_011903_create_posts_table',2),
	('2013_01_19_044505_create_comments_table',2),
	('2013_03_23_193214_update_users_table',2),
	('2014_11_12_145550_add_custom_fields_to_posts',2),
	('2014_11_18_193353_create_licenses_table',3),
	('2014_11_20_125637_create_batch_table',4),
	('2014_11_20_212012_create_parent_table',5),
	('2014_11_20_213025_create_child_table',6),
	('2014_11_24_190846_add_partner_id_tabDataParent',7),
	('2014_11_24_191549_add_partner_id_tabDataChild',8),
	('2014_11_25_205854_add_filePartnerLogo_posts',9),
	('2014_12_01_180037_add_tags_to_posts_table',10),
	('2014_12_01_180456_add_tags_to_posts_table',11),
	('',0),
	('2014_12_01_185759_add_statuses_table',12),
	('2014_12_02_193841_add_licensestatus_to_licenses',13);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table posts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `partnerwebsite` text COLLATE utf8_unicode_ci NOT NULL,
  `tags` text COLLATE utf8_unicode_ci NOT NULL,
  `yearsavailable` text COLLATE utf8_unicode_ci NOT NULL,
  `notescleaning` text COLLATE utf8_unicode_ci NOT NULL,
  `notessource` text COLLATE utf8_unicode_ci NOT NULL,
  `notesversion` text COLLATE utf8_unicode_ci NOT NULL,
  `filePartnerLogo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;

INSERT INTO `posts` (`id`, `user_id`, `title`, `slug`, `content`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`, `updated_at`, `partnerwebsite`, `tags`, `yearsavailable`, `notescleaning`, `notessource`, `notesversion`, `filePartnerLogo`, `status_id`)
VALUES
	(1,2,'Charlotte Mecklenburg Schools (CMS)','charlotte-mecklenburg-schools','In mea autem etiam menandri, quot elitr vim ei, eos semper disputationi id? Per facer appetere eu, duo et animal maiestatis. Omnesque invidunt mnesarchum ex mel, vis no case senserit dissentias. Te mei minimum singulis inimicus, ne labores accusam necessitatibus vel, vivendo nominavi ne sed. Posidonium scriptorem consequuntur cum ex.','','','','2014-10-24 13:34:02','2015-01-14 11:02:50','http://www.cms.k12.nc.us/','Education, Social Well-Being','2006-2007, 2012-2013','CMS changed to NC Wise in the 2006-2007 school year. Data prior to that school year is not available due to the data quality concerns.','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. \r\n\r\nDuis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.','filePartnerLogo-eye-tiger-growl_normal.jpg',1),
	(2,2,'Ronald McDonald House of Charlotte','ronald-mcdonald','In mea autem etiam menandri, quot elitr vim ei, eos semper disputationi id? Per facer appetere eu, duo et animal maiestatis. Omnesque invidunt mnesarchum ex mel, vis no case senserit dissentias. Te mei minimum singulis inimicus, ne labores accusam necessitatibus vel, vivendo nominavi ne sed. Posidonium scriptorem consequuntur cum ex? Posse fabulas iudicabit in nec, eos cu electram forensibus, pro ei commodo tractatos reformidans. Qui eu lorem augue alterum, eos in facilis pericula mediocritatem?\r\n\r\nEst hinc legimus oporteat in. Sit ei melius delicatissimi. Duo ex qualisque adolescens! Pri cu solum aeque. Aperiri docendi vituperatoribus has ea!\r\n\r\nSed ut ludus perfecto sensibus, no mea iisque facilisi. Choro tation melius et mea, ne vis nisl insolens. Vero autem scriptorem cu qui? Errem dolores no nam, mea tritani platonem id! At nec tantas consul, vis mundi petentium elaboraret ex, mel appareat maiestatis at.\r\n\r\nSed et eros concludaturque. Mel ne aperiam comprehensam! Ornatus delicatissimi eam ex, sea an quidam tritani placerat? Ad eius iriure consequat eam, mazim temporibus conclusionemque eum ex.\r\n\r\nTe amet sumo usu, ne autem impetus scripserit duo, ius ei mutat labore inciderint! Id nulla comprehensam his? Ut eam deleniti argumentum, eam appellantur definitionem ad. Pro et purto partem mucius!\r\n\r\nCu liber primis sed, esse evertitur vis ad. Ne graeco maiorum mea! In eos nostro docendi conclusionemque. Ne sit audire blandit tractatos? An nec dicam causae meliore, pro tamquam offendit efficiendi ut.\r\n\r\nTe dicta sadipscing nam, denique albucius conclusionemque ne usu, mea eu euripidis philosophia! Qui at vivendo efficiendi! Vim ex delenit blandit oportere, in iriure placerat cum. Te cum meis altera, ius ex quis veri.\r\n\r\nMutat propriae eu has, mel ne veri bonorum tincidunt. Per noluisse sensibus honestatis ut, stet singulis ea eam, his dicunt vivendum mediocrem ei. Ei usu mutat efficiantur, eum verear aperiam definitiones an! Simul dicam instructior ius ei. Cu ius facer doming cotidieque! Quot principes eu his, usu vero dicat an.\r\n\r\nEx dicta perpetua qui, pericula intellegam scripserit id vel. Id fabulas ornatus necessitatibus mel. Prompta dolorem appetere ea has. Vel ad expetendis instructior!\r\n\r\nTe his dolorem adversarium? Pri eu rebum viris, tation molestie id pri. Mel ei stet inermis dissentias. Sed ea dolorum detracto vituperata. Possit oportere similique cu nec, ridens animal quo ex?','','','','2014-11-05 13:34:02','2015-01-14 11:15:14','http://www.rmhofcharlotte.org/','','','','','','',4),
	(3,2,'Carolina&#039;s Medical Center','cmc','111In mea autem etiam menandri, quot elitr vim ei, eos semper disputationi id? Per facer appetere eu, duo et animal maiestatis. Omnesque invidunt mnesarchum ex mel, vis no case senserit dissentias. Te mei minimum singulis inimicus, ne labores accusam necessitatibus vel, vivendo nominavi ne sed. Posidonium scriptorem consequuntur cum ex? Posse fabulas iudicabit in nec, eos cu electram forensibus, pro ei commodo tractatos reformidans. Qui eu lorem augue alterum, eos in facilis pericula mediocritatem?\r\n\r\nEst hinc legimus oporteat in. Sit ei melius delicatissimi. Duo ex qualisque adolescens! Pri cu solum aeque. Aperiri docendi vituperatoribus has ea!\r\n\r\nSed ut ludus perfecto sensibus, no mea iisque facilisi. Choro tation melius et mea, ne vis nisl insolens. Vero autem scriptorem cu qui? Errem dolores no nam, mea tritani platonem id! At nec tantas consul, vis mundi petentium elaboraret ex, mel appareat maiestatis at.\r\n\r\nSed et eros concludaturque. Mel ne aperiam comprehensam! Ornatus delicatissimi eam ex, sea an quidam tritani placerat? Ad eius iriure consequat eam, mazim temporibus conclusionemque eum ex.\r\n\r\nTe amet sumo usu, ne autem impetus scripserit duo, ius ei mutat labore inciderint! Id nulla comprehensam his? Ut eam deleniti argumentum, eam appellantur definitionem ad. Pro et purto partem mucius!\r\n\r\nCu liber primis sed, esse evertitur vis ad. Ne graeco maiorum mea! In eos nostro docendi conclusionemque. Ne sit audire blandit tractatos? An nec dicam causae meliore, pro tamquam offendit efficiendi ut.\r\n\r\nTe dicta sadipscing nam, denique albucius conclusionemque ne usu, mea eu euripidis philosophia! Qui at vivendo efficiendi! Vim ex delenit blandit oportere, in iriure placerat cum. Te cum meis altera, ius ex quis veri.\r\n\r\nMutat propriae eu has, mel ne veri bonorum tincidunt. Per noluisse sensibus honestatis ut, stet singulis ea eam, his dicunt vivendum mediocrem ei. Ei usu mutat efficiantur, eum verear aperiam definitiones an! Simul dicam instructior ius ei. Cu ius facer doming cotidieque! Quot principes eu his, usu vero dicat an.\r\n\r\nEx dicta perpetua qui, pericula intellegam scripserit id vel. Id fabulas ornatus necessitatibus mel. Prompta dolorem appetere ea has. Vel ad expetendis instructior!\r\n\r\nTe his dolorem adversarium? Pri eu rebum viris, tation molestie id pri. Mel ei stet inermis dissentias. Sed ea dolorum detracto vituperata. Possit oportere similique cu nec, ridens animal quo ex?','','','','2014-11-09 13:34:02','2015-01-14 11:08:14','','Health, Economy, Social Well-Being','2009','2','3','4','',3),
	(5,2,'United Way of the Carolinas','united-way','The United Way Worldwide, based in Alexandria, Virginia, is a nonprofit organization that works with more than 1,200 local United Way offices throughout the country in a coalition of charitable organizations to pool efforts in fundraising and support. United Way&#039;s focus is to identify and resolve pressing community issues, and to make measurable changes in communities through partnerships with schools, government agencies, businesses, organized labor, financial institutions, community development corporations, voluntary and neighborhood associations, the faith community, and others. The issues United Way offices focus on are determined locally because communities differ. The main areas include education, income, and health.','','','','2014-11-17 18:19:15','2015-01-14 13:37:18','','Education, Health, Income','','','','','',2);

/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table statuses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `statuses`;

CREATE TABLE `statuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `statuses` WRITE;
/*!40000 ALTER TABLE `statuses` DISABLE KEYS */;

INSERT INTO `statuses` (`id`, `status`)
VALUES
	(1,'Data Available'),
	(2,'Processing Data'),
	(3,'Data Coming'),
	(4,'Project specific availability');

/*!40000 ALTER TABLE `statuses` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tabDataBatch
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tabDataBatch`;

CREATE TABLE `tabDataBatch` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `partner_id` int(10) unsigned NOT NULL,
  `batch_description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `batch_type` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `tabDataBatch` WRITE;
/*!40000 ALTER TABLE `tabDataBatch` DISABLE KEYS */;

INSERT INTO `tabDataBatch` (`id`, `user_id`, `partner_id`, `batch_description`, `created_at`, `updated_at`, `batch_type`)
VALUES
	(2,1,1,'Testing Batch Import','0000-00-00 00:00:00','0000-00-00 00:00:00',0);

/*!40000 ALTER TABLE `tabDataBatch` ENABLE KEYS */;
UNLOCK TABLES;

DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`homestead`@`10.0.2.2` */ /*!50003 TRIGGER `delete_batch` AFTER DELETE ON `tabDataBatch` FOR EACH ROW BEGIN
  DELETE FROM tabDataParent WHERE batch_id = OLD.id ; 
  DELETE FROM tabDataChild WHERE batch_id = OLD.id ; 
END */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;


# Dump of table tabDataChild
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tabDataChild`;

CREATE TABLE `tabDataChild` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `partner_id` int(11) NOT NULL,
  `table_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `column_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data_value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `batch_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `tabDataChild` WRITE;
/*!40000 ALTER TABLE `tabDataChild` DISABLE KEYS */;

INSERT INTO `tabDataChild` (`id`, `partner_id`, `table_name`, `column_name`, `data_value`, `data_type`, `batch_id`, `created_at`, `updated_at`)
VALUES
	(12,1,'CharMeckSchools','ethnic-code','','ALL',2,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(13,1,'CharMeckSchools','ethnic-code','B','ALL',2,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(14,1,'CharMeckSchools','ethnic-code','I','ALL',2,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(15,1,'CharMeckSchools','ethnic-code','M','ALL',2,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(16,1,'CharMeckSchools','ethnic-code','NULL','ALL',2,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(17,1,'CharMeckSchools','ethnic-code','R','ALL',2,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(18,1,'CharMeckSchools','ethnic-code','S','ALL',2,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(19,1,'CharMeckSchools','ethnic-code','W','ALL',2,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(20,1,'CharMeckSchools','school-id','222','QTY',2,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(21,1,'CharMeckSchools','zip-code','10472','MIN',2,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(22,1,'CharMeckSchools','zip-code','7052','MAX',2,'0000-00-00 00:00:00','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `tabDataChild` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tabDataParent
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tabDataParent`;

CREATE TABLE `tabDataParent` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `partner_id` int(11) NOT NULL,
  `table_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `column_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `max_length` float DEFAULT NULL,
  `complete` float DEFAULT NULL,
  `total_rows` float DEFAULT NULL,
  `pct_complete` float DEFAULT NULL,
  `batch_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `tabDataParent` WRITE;
/*!40000 ALTER TABLE `tabDataParent` DISABLE KEYS */;

INSERT INTO `tabDataParent` (`id`, `partner_id`, `table_name`, `column_name`, `data_type`, `max_length`, `complete`, `total_rows`, `pct_complete`, `batch_id`, `created_at`, `updated_at`)
VALUES
	(5,1,'CharMeckSchools','total-absences','numeric',NULL,934004,934004,100,2,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(6,1,'CharMeckSchools','ethnic-code','nvarchar',12,1173030,1173030,100,2,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(7,1,'CharMeckSchools','school-id','numeric',NULL,1173030,1173030,100,2,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(8,1,'CharMeckSchools','zip-code','nvarchar',10,1173030,1173030,100,2,'0000-00-00 00:00:00','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `tabDataParent` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_temp_measurement
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_temp_measurement`;

CREATE TABLE `tbl_temp_measurement` (
  `meas_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `meas_date` varchar(11) DEFAULT NULL,
  `station_id` varchar(11) DEFAULT NULL,
  `max_temp` varchar(11) DEFAULT NULL,
  `min_temp` varchar(11) DEFAULT NULL,
  `rain` varchar(11) DEFAULT NULL,
  `avgrh` varchar(11) DEFAULT NULL,
  `evapor` varchar(11) DEFAULT NULL,
  `mean_temp` varchar(11) DEFAULT NULL,
  `source` varchar(11) DEFAULT NULL,
  `meas_year` varchar(11) DEFAULT NULL,
  `meas_month` varchar(11) DEFAULT NULL,
  `meas_day` varchar(11) DEFAULT NULL,
  `batch_id` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`meas_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tbl_temp_measurement` WRITE;
/*!40000 ALTER TABLE `tbl_temp_measurement` DISABLE KEYS */;

INSERT INTO `tbl_temp_measurement` (`meas_id`, `meas_date`, `station_id`, `max_temp`, `min_temp`, `rain`, `avgrh`, `evapor`, `mean_temp`, `source`, `meas_year`, `meas_month`, `meas_day`, `batch_id`)
VALUES
	(1,'2004-1-1','327301','30.5','12.1','0','59','2.4','21','1','2004','1','1','1'),
	(2,'2004-1-1','327301','30.5','12.1','0','59','2.4','21','1','2004','1','1','1'),
	(3,'2004-1-2','327302','31.1','12.2','0','59','2.4','22','1','2004','1','2','1'),
	(4,'2004-1-2','327302','31.1','12.2','0','59','2.4','22','1','2004','1','2','1'),
	(5,'2004-1-3','327303','30.5','12.7','0','61','3.2','23','1','2004','1','3','1'),
	(6,'2004-1-3','327303','30.5','12.7','0','61','3.2','23','1','2004','1','3','1'),
	(7,'2004-1-4','327304','31','13.3','0','62','2.3','24','1','2004','1','4','1'),
	(8,'2004-1-4','327304','31','13.3','0','62','2.3','24','1','2004','1','4','1'),
	(9,'2011-11-11','911','11','11','11','11','11','11','1','2011','11','11','1'),
	(10,'2004-1-2','327302','31.1','12.2','0','59','2.4','22','1','2004','1','2','1'),
	(11,'2004-1-2','327302','31.1','12.2','0','59','2.4','22','1','2004','1','2','1'),
	(12,'2004-1-3','327303','30.5','12.7','0','61','3.2','23','1','2004','1','3','1'),
	(13,'2004-1-3','327303','30.5','12.7','0','61','3.2','23','1','2004','1','3','1'),
	(14,'2004-1-4','327304','31','13.3','0','62','2.3','24','1','2004','1','4','1'),
	(15,'2004-1-1','327301','30.5','12.1','0','59','2.4','21','1','2004','1','1','1'),
	(16,'2012-12-12','912','12','12','12','12','12','12','1','2012','12','12','1');

/*!40000 ALTER TABLE `tbl_temp_measurement` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table throttle
# ------------------------------------------------------------

DROP TABLE IF EXISTS `throttle`;

CREATE TABLE `throttle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attempts` int(11) NOT NULL DEFAULT '0',
  `suspended` tinyint(1) NOT NULL DEFAULT '0',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `last_attempt_at` timestamp NULL DEFAULT NULL,
  `suspended_at` timestamp NULL DEFAULT NULL,
  `banned_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `throttle_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `throttle` WRITE;
/*!40000 ALTER TABLE `throttle` DISABLE KEYS */;

INSERT INTO `throttle` (`id`, `user_id`, `ip_address`, `attempts`, `suspended`, `banned`, `last_attempt_at`, `suspended_at`, `banned_at`)
VALUES
	(1,1,'10.0.2.2',0,0,0,NULL,NULL,NULL),
	(2,2,NULL,0,0,0,NULL,NULL,NULL),
	(3,3,NULL,0,0,0,NULL,NULL,NULL);

/*!40000 ALTER TABLE `throttle` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `activation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `persist_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_password_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_activation_code_index` (`activation_code`),
  KEY `users_reset_password_code_index` (`reset_password_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `email`, `password`, `permissions`, `activated`, `activation_code`, `activated_at`, `last_login`, `persist_code`, `reset_password_code`, `first_name`, `last_name`, `created_at`, `updated_at`, `deleted_at`, `website`, `country`, `gravatar`)
VALUES
	(1,'ben@franklin.org','$2y$10$NeSRPwIVFl0zxwKsCAE68..EG5dvB9u0BLy7HbZ/MDk7pbjHir2MW','{\"superuser\":1,\"admin\":1,\"posts.write\":1,\"posts.read\":1,\"user\":1}',1,NULL,NULL,'2015-01-14 10:52:58','$2y$10$OBqRd0p.l10ANOelMi0yPOHdypqwHDIiEvxcPkwkByy160YXYGucq',NULL,'Ben','Franklin','2014-11-13 13:34:02','2015-01-14 10:52:58',NULL,'','',''),
	(2,'example@example.com','$2y$10$6X5LbL3LVuehxCz.zBuAI.E36Ya8RFCSwbOIj094zM.uY2hZdxr9G','{\"posts.write\":1,\"posts.read\":1,\"superuser\":-1,\"post.create\":-1,\"post.read\":-1,\"admin\":-1}',1,NULL,NULL,'2014-11-17 19:56:26','$2y$10$UemkNl2dQrLtjyz9Mfw8H.9.dl865cbBX3fMRQPxEfsYsMvzRVkTO',NULL,'John','Doe','2014-11-13 13:34:02','2014-11-17 19:56:26',NULL,NULL,NULL,'example@example.com'),
	(3,'mycrazydog@ymail.com','$2y$10$I95NtA1xMr1ZwzsLcN6oWOGuR7ZhQnLKbZBw2zeplgSzTAiUhK7.u','{\"superuser\":-1}',1,'8dLOzYmnKJ4QxN0MCoDLzn5BNEL8c2FV2GHXuMptNw',NULL,'2015-01-13 14:06:32','$2y$10$gKzPbIhrTHgqtetgiKhTSeMpyRC8shj7euJ/ByXFHA6IMKmHd9rOC',NULL,'George','Washington','2014-11-19 10:42:25','2015-01-13 14:06:32',NULL,NULL,NULL,NULL);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users_groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users_groups`;

CREATE TABLE `users_groups` (
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `users_groups` WRITE;
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;

INSERT INTO `users_groups` (`user_id`, `group_id`)
VALUES
	(1,1),
	(2,3),
	(3,3);

/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

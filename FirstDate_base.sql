CREATE DATABASE  IF NOT EXISTS `FirstDate_base` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `FirstDate_base`;
-- MySQL dump 10.13  Distrib 5.7.11, for Linux (x86_64)
--
-- Host: localhost    Database: FirstDate_base
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.11-MariaDB-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `connect_users_likes`
--

DROP TABLE IF EXISTS `connect_users_likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `connect_users_likes` (
  `id_connect_users` bigint(20) NOT NULL,
  `id_connect_likes` bigint(20) NOT NULL,
  PRIMARY KEY (`id_connect_users`,`id_connect_likes`),
  KEY `fk_connect_users_likes_1_idx` (`id_connect_users`),
  KEY `fk_connect_users_likes_2_idx` (`id_connect_likes`),
  CONSTRAINT `fk_connect_users_likes_1` FOREIGN KEY (`id_connect_likes`) REFERENCES `likes` (`id_fb_likes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_connect_users_likes_2` FOREIGN KEY (`id_connect_users`) REFERENCES `users` (`id_fb_users`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `connect_users_likes`
--

LOCK TABLES `connect_users_likes` WRITE;
/*!40000 ALTER TABLE `connect_users_likes` DISABLE KEYS */;
INSERT INTO `connect_users_likes` VALUES (141221166264564,6051144797),(141221166264564,10513336322),(141221166264564,41036834883),(141221166264564,151181515624),(141221166264564,312340716529),(141221166264564,131177840264867),(141221166264564,189848084361865),(141221166264564,322607391091431),(141221166264564,351298801548153),(141221166264564,783491298368220),(141221166264564,1395372810692962),(10207795536022976,7608631709),(10207795536022976,10513336322),(10207795536022976,18523496658),(10207795536022976,26367762529),(10207795536022976,41036834883),(10207795536022976,116435393756),(10207795536022976,227924673504),(10207795536022976,252613304456),(10207795536022976,255370230787),(10207795536022976,310598399291),(10207795536022976,108033369246988),(10207795536022976,108732975975237),(10207795536022976,130023037012405),(10207795536022976,130984563902328),(10207795536022976,132315546855179),(10207795536022976,132518420177331),(10207795536022976,152143858190988),(10207795536022976,198320350202343),(10207795536022976,280679601989378),(10207795536022976,283017268533649),(10207795536022976,528659830488471),(10207795536022976,531991800213661),(10207795536022976,1696160087284123);
/*!40000 ALTER TABLE `connect_users_likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `likes` (
  `id_fb_likes` bigint(20) NOT NULL,
  `title_likes` varchar(45) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_fb_likes`),
  UNIQUE KEY `id_likes_UNIQUE` (`id_fb_likes`),
  UNIQUE KEY `title_likes_UNIQUE` (`title_likes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
INSERT INTO `likes` VALUES (0,''),(131177840264867,'Airica Michelle'),(116435393756,'Assassin\'s Creed'),(198320350202343,'BEAUTIFUL PLANET EARTH'),(151181515624,'Bettie Page'),(1395372810692962,'BMW Sport Experience'),(132518420177331,'Bref'),(283017268533649,'BuzzFil France'),(351298801548153,'Craig Gum Photography'),(108732975975237,'Crossed'),(18523496658,'Dead Space'),(252613304456,'Demotivateur'),(152143858190988,'E3 2011 : Sony nous parle de la PS Vita'),(130984563902328,'Fédération Française Pour l\'UNESCO - FFPU'),(132315546855179,'Grand Corps Malade Ma tête, mon coeur et mes '),(7608631709,'House'),(322607391091431,'Lauren Drain'),(130023037012405,'le chat qui peche'),(531991800213661,'Le Jardin de Montsouris'),(255370230787,'Le Journal du Geek'),(26367762529,'Leetchi.com'),(108033369246988,'Les Guignols'),(312340716529,'Lucky Devil Pin Ups'),(41036834883,'Man vs. Wild'),(1696160087284123,'Mesdemoiselles Rose'),(783491298368220,'Mortus Corporatus'),(6051144797,'OM | Olympique De Marseille'),(227924673504,'Optia'),(116059788465999,'Sash Suicide'),(528659830488471,'Spotted : Université Paris Diderot - Paris 7'),(280679601989378,'Stargate SG-1'),(10513336322,'The Guardian'),(310598399291,'Toi aussi tu hésites à mettre \" j\'ai battu la'),(189848084361865,'Vany Vicious');
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id_fb_users` bigint(20) NOT NULL,
  `name_users` varchar(45) CHARACTER SET utf8 NOT NULL,
  `bio_users` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `birthday_users` date DEFAULT NULL,
  `gender_users` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `location_users` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `relation_users` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `interested_users` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `photo_users` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `mv_name_users` tinyint(1) DEFAULT '0',
  `mv_bio_users` tinyint(1) DEFAULT '0',
  `mv_birthday_users` tinyint(1) DEFAULT '0',
  `mv_gender_users` tinyint(1) DEFAULT '0',
  `mv_location_users` tinyint(1) DEFAULT '0',
  `mv_relation_users` tinyint(1) DEFAULT '0',
  `mv_interested_users` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_fb_users`),
  UNIQUE KEY `id_utilisateurs_UNIQUE` (`id_fb_users`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (141221166264564,'Jesuisbienmoi Pastoi','I\'m a kill ass!','0000-00-00','female','Palembang','It\'s comlicated','female,male','https://scontent.xx.fbcdn.net/hprofile-xlt1/v/t1.0-1/p200x200/12715574_146115355775145_8041287794932713127_n.jpg?oh=d62a08e274ce53fe665ab765fcb670c8&oe=575551C2',1,1,0,0,0,1,0),(10207795536022976,'Evrim Petek','efrgthyjujhgfdfdghwcxvbn','1990-02-02','male','Terre Haute, Indiana','Single','female,male','https://scontent.xx.fbcdn.net/hprofile-xtp1/v/t1.0-1/p200x200/12717377_10207786936087983_9007873218032232209_n.jpg?oh=0d87ac2064aa8532dc0eeeae9c61bbe9&oe=57242187',0,1,1,0,0,0,0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-02-22 22:12:04

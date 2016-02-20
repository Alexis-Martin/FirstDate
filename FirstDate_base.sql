-- MySQL dump 10.13  Distrib 5.6.28, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: FirstDate_base
-- ------------------------------------------------------
-- Server version	5.6.28-0ubuntu0.15.10.1

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
  `id_connect_users_likes` int(11) NOT NULL AUTO_INCREMENT,
  `id_connect_users` int(11) NOT NULL,
  `id_connect_likes` int(11) NOT NULL,
  PRIMARY KEY (`id_connect_users_likes`),
  UNIQUE KEY `id_connect_users_likes_UNIQUE` (`id_connect_users_likes`),
  KEY `fk_connect_users_likes_1_idx` (`id_connect_users`),
  KEY `fk_connect_users_likes_2_idx` (`id_connect_likes`),
  CONSTRAINT `fk_connect_users_likes_1` FOREIGN KEY (`id_connect_users`) REFERENCES `users` (`id_users`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_connect_users_likes_2` FOREIGN KEY (`id_connect_likes`) REFERENCES `likes` (`id_likes`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `likes` (
  `id_likes` int(11) NOT NULL AUTO_INCREMENT,
  `titlelikes` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id_likes`),
  UNIQUE KEY `id_likes_UNIQUE` (`id_likes`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id_users` int(11) NOT NULL AUTO_INCREMENT,
  `name_users` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `fb_id_users` varchar(45) COLLATE utf8_bin NOT NULL,
  `bio_users` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `birthday_users` date DEFAULT NULL,
  `gender_users` binary(1) DEFAULT NULL,
  `location_users` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `relation_users` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `interested_users` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id_users`),
  UNIQUE KEY `id_utilisateurs_UNIQUE` (`id_users`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-02-20 23:16:42

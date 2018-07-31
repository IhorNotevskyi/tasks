-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: localhost    Database: beejee2
-- ------------------------------------------------------
-- Server version	5.7.22-0ubuntu0.17.10.1

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
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(5) NOT NULL DEFAULT 'user',
  `password` char(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_uindex` (`email`),
  UNIQUE KEY `admins_login_uindex` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'admin','admin@admin.admin','admin','3cd03b4a31b7f4a683709c01dd62eea4');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tasks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `task` text NOT NULL,
  `is_done` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `image` varchar(100) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT INTO `tasks` VALUES (1,'Mike','mike@mike.com','Lorem ipsum dolor sit amet consectetur adipiscing elit',1,'46aec87796be7db2c14b5c0f3c6aee9d_5b5f778c851e1.jpg'),(2,'Александр','willy@willy.com',' Текст генерируется абзацами случайным образом от двух до десяти предложений в абзаце',0,''),(3,'Kolya','kolya@kolya.com','Sunt seculaes transferre talis camerarius fluctuies',1,'73c99d6ba6acbeb1b7486997da00027b_5b5f43cd4d1d2.jpg'),(4,'Alessandro Marlon','sash@aless.com','Eposs sunt solems de superbus fortis',0,''),(5,'Brobbery','brob@brob.com','Mineralis persuadere omnes finises desiderium',1,'f49bbb3d2fa89add46b745cd5a31d6cb_5b5f280db77ac.jpg'),(6,'Василий','hryak@cryak.com','Era brevis ratione est',0,'aca1f4523a726533e7b44dc6ccdd40ec_5b5f282691b52.jpg'),(7,'Boriello','boro@boro.com','Potus sensim ad ferox abnoba. Sunt accentores vitare salvus flavum parses',1,'4ea9b37e1dee005d0b94c1e9160a0e35_5b5f2852028fe.jpg'),(8,'Клаудио Моралес','claxton@tonyo.com','По своей сути рыбатекст является альтернативой традиционному lorem ipsum, который вызывает у некторых людей недоумение при попытках прочитать рыбу текст',0,'9abf289596607a28b085f55777677808_5b5f285d6cdf3.jpg'),(9,'Маша Колесникова','masha@masha.com','Ut suscipit posuere justo at vulputate. Pellentesque medicinaes.',1,'054223ccdcb7925c637a5f68cd2e68fd_5b5f286ae8671.jpg'),(10,'Dronton56','dronton56@dryu.com','Diatrias tolerare tanquam noster caesium',0,'45aa16c2f73febca67460dea900e6f57_5b5f27fa45a55.jpg');
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-07-31 12:11:51

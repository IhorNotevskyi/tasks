-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: localhost    Database: double
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
-- Table structure for table `obj_contacts`
--

DROP TABLE IF EXISTS `obj_contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `obj_contacts` (
  `id_contact` int(11) NOT NULL AUTO_INCREMENT,
  `id_customer` int(11) DEFAULT NULL,
  `number` varchar(100) DEFAULT NULL,
  `date_sign` date DEFAULT NULL,
  `staff_number` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_contact`),
  KEY `obj_contacts_obj_customers_id_customer_fk` (`id_customer`),
  CONSTRAINT `obj_contacts_obj_customers_id_customer_fk` FOREIGN KEY (`id_customer`) REFERENCES `obj_customers` (`id_customer`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obj_contacts`
--

LOCK TABLES `obj_contacts` WRITE;
/*!40000 ALTER TABLE `obj_contacts` DISABLE KEYS */;
INSERT INTO `obj_contacts` VALUES (1,2,'5353535678','2018-08-08','25'),(2,3,'6456546564','2018-08-09','10'),(3,4,'4234635353','2018-08-10','15'),(4,5,'8678664470','2018-08-11','50'),(5,6,'0534753483','2018-08-12','150'),(6,7,'5356837573','2018-08-13','300'),(7,3,'1231039095','2018-08-14','80'),(8,5,'0535783461','2018-08-15','200'),(9,7,'4234832749','2018-08-16','5');
/*!40000 ALTER TABLE `obj_contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obj_customers`
--

DROP TABLE IF EXISTS `obj_customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `obj_customers` (
  `id_customer` int(11) NOT NULL AUTO_INCREMENT,
  `name_customer` varchar(250) DEFAULT NULL,
  `company` enum('company_1','company_2','company_3') DEFAULT NULL,
  PRIMARY KEY (`id_customer`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obj_customers`
--

LOCK TABLES `obj_customers` WRITE;
/*!40000 ALTER TABLE `obj_customers` DISABLE KEYS */;
INSERT INTO `obj_customers` VALUES (2,'John Blythe','company_2'),(3,'Allan Blossom','company_1'),(4,'Bellamy White','company_3'),(5,'Bolton Grey','company_1'),(6,'Booker Boswell','company_2'),(7,'Tyson Twila','company_3');
/*!40000 ALTER TABLE `obj_customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obj_services`
--

DROP TABLE IF EXISTS `obj_services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `obj_services` (
  `id_service` int(11) NOT NULL AUTO_INCREMENT,
  `id_contact` int(11) DEFAULT NULL,
  `title_service` varchar(250) DEFAULT NULL,
  `status` enum('work','connecting','disconnected') DEFAULT NULL,
  PRIMARY KEY (`id_service`),
  KEY `obj_services_obj_contacts_id_contact_fk` (`id_contact`),
  CONSTRAINT `obj_services_obj_contacts_id_contact_fk` FOREIGN KEY (`id_contact`) REFERENCES `obj_contacts` (`id_contact`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obj_services`
--

LOCK TABLES `obj_services` WRITE;
/*!40000 ALTER TABLE `obj_services` DISABLE KEYS */;
INSERT INTO `obj_services` VALUES (1,1,'Sed quia non numquam','work'),(2,2,'Reprehenderit qui in eap','disconnected'),(3,3,'Tempora incidunt ut labore','work'),(4,4,'Quaerat voluptatem','connecting'),(5,5,'Ipsum quia dolor','work'),(6,6,'Nor again is there','disconnected'),(7,7,'Some great pleasure','work'),(8,8,'Laborious physical exercise','connecting'),(9,9,'Advantage from it','disconnected'),(10,2,'Ut enim ad minima','work'),(11,4,'Et dolore magna','connecting'),(12,6,'Doloremque laudantium','disconnected'),(13,8,'Natus error sit','work');
/*!40000 ALTER TABLE `obj_services` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-08-27  2:33:49

-- MySQL dump 10.13  Distrib 5.7.29, for Linux (x86_64)
--
-- Host: localhost    Database: kedaigambar
-- ------------------------------------------------------
-- Server version	5.7.29-0ubuntu0.18.04.1

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
-- Table structure for table `photos`
--

DROP TABLE IF EXISTS `photos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(200) NOT NULL,
  `caption` varchar(2000) NOT NULL,
  `photographer` varchar(200) NOT NULL,
  `submitted_date` int(2) NOT NULL,
  `approval_date` varchar(40) NOT NULL DEFAULT '0',
  `publish_status` tinyint(1) NOT NULL DEFAULT '1',
  `rejected_date` int(20) NOT NULL DEFAULT '0',
  `total_downloaded` int(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `photos`
--

LOCK TABLES `photos` WRITE;
/*!40000 ALTER TABLE `photos` DISABLE KEYS */;
INSERT INTO `photos` VALUES (1,'839743392765_5736151803_ecec24c603_z.jpg','Cities','photographer1',1477877952,'1477878011',1,0,757),(2,'839743396455_11997568036_570f2ed2c8_z.jpg','Train','photographer1',1477877958,'1528424494',1,0,1),(3,'83974341183_9115425071_dc4924b191_z.jpg','free','photographer2',1477877983,'0',1,1477878023,0),(4,'83974341552_12306384833_2ba56ee451_z.jpg','moon','photographer2',1477877989,'1477878017',1,0,731),(5,'839743422285_24285013876_b0f6b1dd56_z.jpg','bawang','photographer2',1477878000,'1477878020',1,0,1003),(14,'883052853885_img.jpg','Transport','photographer1',1548299840,'0',1,1581334510,0),(15,'903369217755_1.png','1','editor1',1581334578,'0',1,1581334649,0),(16,'903369266955_3.png','2','editor1',1581334658,'0',1,1581334668,0),(17,'90336927864_aaaaaasd.jpg','dsd ','editor1',1581334677,'0',1,1581334780,0),(18,'90336935859_1caswfwet.jpg','sdf segse rg','editor1',1581334807,'0',1,1581334831,0);
/*!40000 ALTER TABLE `photos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `no` int(3) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `name` varchar(500) NOT NULL,
  `roles` int(1) NOT NULL,
  PRIMARY KEY (`no`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'user1','user_1!','user1@email.com','User1',1),(2,'photographer1','photographer1!','editor1@email.com','Photographer1',2),(3,'editor1','editor1!','photographer1@email.com','Editor1',3),(4,'photographer2','photographer2!','photographer2@email.com','Photographer2',2);
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

-- Dump completed on 2020-08-18 16:19:13

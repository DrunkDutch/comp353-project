CREATE DATABASE  IF NOT EXISTS `comp353` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `comp353`;
-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: 192.168.2.75    Database: comp353
-- ------------------------------------------------------
-- Server version	5.6.31-0ubuntu0.14.04.2

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
-- Table structure for table `Comment`
--

DROP TABLE IF EXISTS `Comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Comment` (
  `CommentId` int(8) NOT NULL AUTO_INCREMENT,
  `RideId` int(8) NOT NULL,
  `PosterId` int(8) NOT NULL,
  `Comment` varchar(355) NOT NULL,
  `PostStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`CommentId`),
  KEY `RideC_idx` (`RideId`),
  KEY `Poster_idx` (`PosterId`),
  CONSTRAINT `Poster` FOREIGN KEY (`PosterId`) REFERENCES `Member` (`UserId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `RideC` FOREIGN KEY (`RideId`) REFERENCES `Ride` (`RideId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Comment`
--

LOCK TABLES `Comment` WRITE;
/*!40000 ALTER TABLE `Comment` DISABLE KEYS */;
INSERT INTO `Comment` VALUES (1,1,4,'Looking for people to split gas with','2016-11-13 23:31:28'),(2,2,5,'This ride was horrible','2016-11-30 11:14:33'),(3,3,4,'This is not a test comment to make sure that tests work. This is a real comment','2016-11-30 12:43:09'),(4,3,4,'This is not a comment','2016-11-30 12:44:23'),(5,3,4,'12345678790123456789012345678790123456789012345678790123456789012345678790123456789012345678790123456789012345678790123456789012345678790123456789012345678790123456789012345678790123456789012345678790123456789012345678790123456789012345678790123456789012345678790123456789012345678790123456789012345678790123456789012345678790123456789012345678790123','2016-11-30 12:45:54'),(6,3,6,'This is me commenting to say that this is a wonderful idea for a ride and I might just join it','2016-11-30 12:51:06');
/*!40000 ALTER TABLE `Comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Driver`
--

DROP TABLE IF EXISTS `Driver`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Driver` (
  `RideId` int(8) NOT NULL,
  `DriverId` int(8) NOT NULL,
  PRIMARY KEY (`RideId`,`DriverId`),
  KEY `Driver_idx` (`DriverId`),
  CONSTRAINT `Driver` FOREIGN KEY (`DriverId`) REFERENCES `Member` (`UserId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `RideD` FOREIGN KEY (`RideId`) REFERENCES `Ride` (`RideId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Driver`
--

LOCK TABLES `Driver` WRITE;
/*!40000 ALTER TABLE `Driver` DISABLE KEYS */;
INSERT INTO `Driver` VALUES (1,4),(2,4),(3,4),(4,4),(5,5);
/*!40000 ALTER TABLE `Driver` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Location`
--

DROP TABLE IF EXISTS `Location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Location` (
  `LocationId` int(8) NOT NULL AUTO_INCREMENT,
  `Latitude` float(10,6) NOT NULL,
  `Longitude` float(10,6) NOT NULL,
  `StreetNum` int(6) NOT NULL,
  `Street` varchar(45) NOT NULL,
  `PostalCode` varchar(6) NOT NULL,
  `City` varchar(45) NOT NULL,
  `Province` varchar(45) NOT NULL,
  PRIMARY KEY (`LocationId`,`Latitude`,`Longitude`),
  UNIQUE KEY `LocationId_UNIQUE` (`LocationId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Location`
--

LOCK TABLES `Location` WRITE;
/*!40000 ALTER TABLE `Location` DISABLE KEYS */;
INSERT INTO `Location` VALUES (1,46.763512,-71.274033,2619,'Vigneault','G1W1X4','Quebec','QC'),(2,45.458130,-73.637367,7141,'Sherbrooke Ouest','H4B2B9','Montreal','QC'),(3,45.497108,-73.578735,1455,'de Maisonneuve O','H3G1M8','Montreal','QC'),(4,45.502789,-73.572845,845,'de Maisonneuve O','H3A0G4','Montreal','QC'),(5,38.898811,-77.037636,1600,'Pennsylvania NW','20500','Washington','DC'),(6,45.494926,-73.795486,3,'duBois','H9B1L2','Montreal','Qc');
/*!40000 ALTER TABLE `Location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Member`
--

DROP TABLE IF EXISTS `Member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Member` (
  `UserId` int(8) NOT NULL AUTO_INCREMENT,
  `UName` varchar(12) NOT NULL,
  `Password` varchar(12) NOT NULL,
  `FName` varchar(45) NOT NULL,
  `LName` varchar(45) NOT NULL,
  `Email` varchar(328) NOT NULL,
  `DOB` date NOT NULL,
  `ReferrerID` int(8) NOT NULL,
  `Balance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `Active` tinyint(1) NOT NULL DEFAULT '1',
  `Privilege` int(8) NOT NULL DEFAULT '3',
  `Phone` varchar(15) NOT NULL,
  `Permit` varchar(45) DEFAULT NULL,
  `Insurance` varchar(45) DEFAULT NULL,
  `Suspended` tinyint(1) NOT NULL DEFAULT '0',
  `RegisterDate` date DEFAULT NULL,
  PRIMARY KEY (`UserId`),
  UNIQUE KEY `UserId_UNIQUE` (`UserId`),
  UNIQUE KEY `UName_UNIQUE` (`UName`),
  UNIQUE KEY `Email_UNIQUE` (`Email`),
  UNIQUE KEY `Permit_UNIQUE` (`Permit`),
  UNIQUE KEY `Insurance_UNIQUE` (`Insurance`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Member`
--

LOCK TABLES `Member` WRITE;
/*!40000 ALTER TABLE `Member` DISABLE KEYS */;
INSERT INTO `Member` VALUES (1,'Root','Root','Root','Root','root@test.com','2016-11-01',1,0.00,1,1,'8005556832',NULL,NULL,0,'1970-01-01'),(2,'admin','admin','Admin','Admin','test@test.com','2016-11-02',1,10.63,1,2,'8005557334',NULL,NULL,0,'1970-01-01'),(3,'Member','Member','Member','Member','member@test.com','2016-11-03',1,0.00,1,3,'8005557201',NULL,NULL,0,'1970-01-01'),(4,'Dmens','hardware','DEVIN','Mens','devin.mens@gmail.com','1991-04-14',1,53.50,1,1,'4388372958','M520314049109','022469361335',0,'2016-11-01'),(5,'Slee','test','Stella','Lee','st_lee@encs.concordia.ca','1991-01-01',1,284.14,1,1,'8008008001',NULL,NULL,0,'2016-11-02'),(6,'Chardy','test','Charles-Antoine','Hardy','cha_hard@encs.concordia.ca','1991-01-01',1,491.73,1,1,'8005556833',NULL,NULL,0,'2016-11-03'),(7,'Bcloutier','test','Bernard','Cloutier','b_clo@encs.concordia.ca','1991-01-01',4,0.00,0,3,'8005556834',NULL,NULL,0,'2016-11-04'),(8,'Mverrucci','test','Matthew','Verrucci','m_verru@encs.concordia.ca','1991-01-01',1,0.00,1,2,'8005556835',NULL,NULL,0,'2016-11-01');
/*!40000 ALTER TABLE `Member` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `comp353`.`Member_BEFORE_INSERT` BEFORE INSERT ON `Member` FOR EACH ROW
SET NEW.RegisterDate = NOW() */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `Message`
--

DROP TABLE IF EXISTS `Message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Message` (
  `MessageId` int(8) NOT NULL AUTO_INCREMENT,
  `Date` datetime NOT NULL,
  `SenderId` int(8) NOT NULL,
  `ReceiverId` int(8) NOT NULL,
  `Content` varchar(355) NOT NULL,
  `PostStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`MessageId`),
  UNIQUE KEY `MessageId_UNIQUE` (`MessageId`),
  KEY `Sender_idx` (`SenderId`),
  KEY `Receiver_idx` (`ReceiverId`),
  CONSTRAINT `Receiver` FOREIGN KEY (`ReceiverId`) REFERENCES `Member` (`UserId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Sender` FOREIGN KEY (`SenderId`) REFERENCES `Member` (`UserId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Message`
--

LOCK TABLES `Message` WRITE;
/*!40000 ALTER TABLE `Message` DISABLE KEYS */;
INSERT INTO `Message` VALUES (1,'2016-11-17 14:00:00',5,4,'Your driving sucks','2016-11-13 23:31:50'),(2,'2016-11-17 14:00:01',5,1,'TEST MESSAGE PLS IGNORE','2016-11-13 23:31:50'),(3,'2016-11-14 00:00:00',4,5,'Test Test','2016-11-14 05:56:53'),(4,'2016-11-14 00:00:00',4,5,'tester tester','2016-11-14 05:59:08'),(5,'2016-11-14 00:00:00',4,4,'tewrwqrwr','2016-11-14 05:59:23'),(6,'2016-11-14 01:02:03',4,4,'teedsadasa','2016-11-14 06:02:03'),(7,'2016-11-29 00:38:02',5,4,'test test test','2016-11-29 05:38:02');
/*!40000 ALTER TABLE `Message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Rating`
--

DROP TABLE IF EXISTS `Rating`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Rating` (
  `RideId` int(8) NOT NULL,
  `RaterId` int(8) NOT NULL,
  `RateeId` int(8) NOT NULL,
  `Score` int(1) NOT NULL,
  `PostStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`RideId`,`RaterId`,`RateeId`),
  KEY `Rater_idx` (`RaterId`),
  KEY `Ratee_idx` (`RateeId`),
  CONSTRAINT `fk_RateeID` FOREIGN KEY (`RateeId`) REFERENCES `Member` (`UserId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_RaterID` FOREIGN KEY (`RaterId`) REFERENCES `Member` (`UserId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Ride` FOREIGN KEY (`RideId`) REFERENCES `Ride` (`RideId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Rating`
--

LOCK TABLES `Rating` WRITE;
/*!40000 ALTER TABLE `Rating` DISABLE KEYS */;
INSERT INTO `Rating` VALUES (1,4,5,5,'2016-11-13 23:32:12'),(1,4,6,1,'2016-11-30 05:55:45'),(1,5,4,1,'2016-11-13 23:32:12'),(1,6,4,5,'2016-11-30 12:47:10'),(3,6,4,5,'2016-11-30 12:52:00');
/*!40000 ALTER TABLE `Rating` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Ride`
--

DROP TABLE IF EXISTS `Ride`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Ride` (
  `RideId` int(8) NOT NULL AUTO_INCREMENT,
  `Date` date NOT NULL,
  `DepartTime` time NOT NULL,
  `RepeatDay` varchar(45) DEFAULT NULL,
  `DepartureId` int(8) NOT NULL,
  `DestinationId` int(8) NOT NULL,
  `Distance` double NOT NULL,
  `RiderCapacity` int(4) NOT NULL,
  `PosterId` int(11) NOT NULL,
  `PostStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`RideId`),
  UNIQUE KEY `RideId_UNIQUE` (`RideId`),
  KEY `Departure_idx` (`DepartureId`),
  KEY `Destination_idx` (`DestinationId`),
  KEY `Poster_idx` (`PosterId`),
  CONSTRAINT `Departure` FOREIGN KEY (`DepartureId`) REFERENCES `Location` (`LocationId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Destination` FOREIGN KEY (`DestinationId`) REFERENCES `Location` (`LocationId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Ride`
--

LOCK TABLES `Ride` WRITE;
/*!40000 ALTER TABLE `Ride` DISABLE KEYS */;
INSERT INTO `Ride` VALUES (1,'2016-11-17','13:30:00',NULL,1,3,248,2,4,'2016-11-13 23:29:31'),(2,'2016-11-18','09:00:00',NULL,3,1,248,0,4,'2016-11-13 23:29:31'),(3,'2016-11-19','11:00:00','Mon',2,4,10.6,3,4,'2016-11-13 23:29:31'),(4,'2016-11-30','11:00:00','',1,1,0,3,4,'2016-11-29 05:18:06'),(5,'2016-12-16','11:00:00','',6,1,262,3,5,'2016-11-30 08:48:45');
/*!40000 ALTER TABLE `Ride` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Rider`
--

DROP TABLE IF EXISTS `Rider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Rider` (
  `RideId` int(8) NOT NULL,
  `RiderId` int(8) NOT NULL,
  PRIMARY KEY (`RideId`,`RiderId`),
  KEY `Rider_idx` (`RiderId`),
  CONSTRAINT `Ride` FOREIGN KEY (`RideId`) REFERENCES `Ride` (`RideId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Rider` FOREIGN KEY (`RiderId`) REFERENCES `Member` (`UserId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Rider`
--

LOCK TABLES `Rider` WRITE;
/*!40000 ALTER TABLE `Rider` DISABLE KEYS */;
INSERT INTO `Rider` VALUES (5,4),(1,5),(4,5),(1,6),(3,6),(4,6);
/*!40000 ALTER TABLE `Rider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Transaction`
--

DROP TABLE IF EXISTS `Transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Transaction` (
  `TransactionId` int(8) NOT NULL AUTO_INCREMENT,
  `PayerId` int(8) NOT NULL,
  `PayeeId` int(8) NOT NULL,
  `Amount` decimal(10,2) NOT NULL,
  `PostStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`TransactionId`),
  UNIQUE KEY `TransactionId_UNIQUE` (`TransactionId`),
  KEY `Payer_idx` (`PayerId`),
  KEY `Payee_idx` (`PayeeId`),
  CONSTRAINT `Payee` FOREIGN KEY (`PayeeId`) REFERENCES `Member` (`UserId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Payer` FOREIGN KEY (`PayerId`) REFERENCES `Member` (`UserId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Transaction`
--

LOCK TABLES `Transaction` WRITE;
/*!40000 ALTER TABLE `Transaction` DISABLE KEYS */;
INSERT INTO `Transaction` VALUES (1,5,4,50.00,'2016-11-13 23:32:31'),(2,6,4,50.00,'2016-11-13 23:32:31'),(3,5,4,0.00,'2016-11-29 05:18:31'),(4,5,2,0.00,'2016-11-29 05:18:31'),(5,4,5,194.14,'2016-11-30 08:49:10'),(6,4,2,10.22,'2016-11-30 08:49:10'),(7,6,4,0.00,'2016-11-30 12:47:56'),(8,6,2,0.00,'2016-11-30 12:47:56'),(9,6,4,7.86,'2016-11-30 12:51:45'),(10,6,2,0.41,'2016-11-30 12:51:45');
/*!40000 ALTER TABLE `Transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'comp353'
--

--
-- Dumping routines for database 'comp353'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-30 21:14:31

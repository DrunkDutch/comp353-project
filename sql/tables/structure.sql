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
  PRIMARY KEY (`CommentId`),
  KEY `RideC_idx` (`RideId`),
  KEY `Poster_idx` (`PosterId`),
  CONSTRAINT `Poster` FOREIGN KEY (`PosterId`) REFERENCES `Member` (`UserId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `RideC` FOREIGN KEY (`RideId`) REFERENCES `Ride` (`RideId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  `Balance` decimal(10,2) NOT NULL,
  `Active` tinyint(1) NOT NULL,
  `Privilege` int(8) NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `Permit` varchar(45) DEFAULT NULL,
  `Insurance` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`UserId`),
  UNIQUE KEY `UserId_UNIQUE` (`UserId`),
  UNIQUE KEY `UName_UNIQUE` (`UName`),
  UNIQUE KEY `Email_UNIQUE` (`Email`),
  UNIQUE KEY `Permit_UNIQUE` (`Permit`),
  UNIQUE KEY `Insurance_UNIQUE` (`Insurance`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  PRIMARY KEY (`MessageId`),
  UNIQUE KEY `MessageId_UNIQUE` (`MessageId`),
  KEY `Sender_idx` (`SenderId`),
  KEY `Receiver_idx` (`ReceiverId`),
  CONSTRAINT `Receiver` FOREIGN KEY (`ReceiverId`) REFERENCES `Member` (`UserId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Sender` FOREIGN KEY (`SenderId`) REFERENCES `Member` (`UserId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  PRIMARY KEY (`RideId`),
  KEY `Rater_idx` (`RaterId`),
  KEY `Ratee_idx` (`RateeId`),
  CONSTRAINT `fk_RateeID` FOREIGN KEY (`RateeId`) REFERENCES `Member` (`UserId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_RaterID` FOREIGN KEY (`RaterId`) REFERENCES `Member` (`UserId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Ride` FOREIGN KEY (`RideId`) REFERENCES `Ride` (`RideId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  `Repeat` varchar(45) DEFAULT NULL,
  `DepartureId` int(8) NOT NULL,
  `DestinationId` int(8) NOT NULL,
  `Distance` double NOT NULL,
  `RiderCapacity` int(4) NOT NULL,
  PRIMARY KEY (`RideId`),
  UNIQUE KEY `RideId_UNIQUE` (`RideId`),
  KEY `Departure_idx` (`DepartureId`),
  KEY `Destination_idx` (`DestinationId`),
  CONSTRAINT `Departure` FOREIGN KEY (`DepartureId`) REFERENCES `Location` (`LocationId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Destination` FOREIGN KEY (`DestinationId`) REFERENCES `Location` (`LocationId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  PRIMARY KEY (`TransactionId`),
  UNIQUE KEY `TransactionId_UNIQUE` (`TransactionId`),
  KEY `Payer_idx` (`PayerId`),
  KEY `Payee_idx` (`PayeeId`),
  CONSTRAINT `Payee` FOREIGN KEY (`PayeeId`) REFERENCES `Member` (`UserId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Payer` FOREIGN KEY (`PayerId`) REFERENCES `Member` (`UserId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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

-- Dump completed on 2016-11-09 19:47:48

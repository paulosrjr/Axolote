CREATE DATABASE  IF NOT EXISTS `backup` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `backup`;
-- MySQL dump 10.13  Distrib 5.6.24, for linux-glibc2.5 (x86_64)
--
-- Host: localhost    Database: backup
-- ------------------------------------------------------
-- Server version	5.5.5-10.0.17-MariaDB-wsrep

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
-- Table structure for table `backupTypeParameters`
--

DROP TABLE IF EXISTS `backupTypeParameters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `backupTypeParameters` (
  `idbackupTypeParameters` int(11) NOT NULL AUTO_INCREMENT,
  `backupType_idbackupType` int(11) NOT NULL,
  `parameter` varchar(45) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`idbackupTypeParameters`,`backupType_idbackupType`),
  KEY `fk_backupTypeParameters_backupType1_idx` (`backupType_idbackupType`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backupTypeParameters`
--

LOCK TABLES `backupTypeParameters` WRITE;
/*!40000 ALTER TABLE `backupTypeParameters` DISABLE KEYS */;
INSERT INTO `backupTypeParameters` VALUES (1,1,'-P','Specifies the port to connect to on the remote host. Note that this option is written with a capital P, because -p is already reserved for preserving the times and modes of the file in rcp(1).'),(2,1,'-S','Name of program to use for the encrypted connection.'),(3,4,'-r','Recursive'),(4,4,'-v','Verbose'),(5,2,'-v','Verbose'),(6,3,'-v','Verbose'),(7,1,'-p ','Preserves modification times, access times, and modes from the original file.'),(8,5,'ALL','Automatically, the first argument is always the Staging Path, if necessary , enter additional parameters in the parameter field.'),(9,6,'ALL','Automatic arguments');
/*!40000 ALTER TABLE `backupTypeParameters` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-08-31  7:11:28

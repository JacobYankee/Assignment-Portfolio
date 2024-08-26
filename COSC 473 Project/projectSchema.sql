-- MySQL dump 10.13  Distrib 8.0.23, for Win64 (x86_64)
--
-- Host: cosc473project.coend9cuqsan.us-east-1.rds.amazonaws.com    Database: projectSchema
-- ------------------------------------------------------
-- Server version	8.0.33

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
SET @MYSQLDUMP_TEMP_LOG_BIN = @@SESSION.SQL_LOG_BIN;
SET @@SESSION.SQL_LOG_BIN= 0;

--
-- GTID state at the beginning of the backup 
--

SET @@GLOBAL.GTID_PURGED=/*!80000 '+'*/ '';

--
-- Table structure for table `passwords`
--

DROP TABLE IF EXISTS `passwords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `passwords` (
  `pwd` varchar(20) NOT NULL,
  PRIMARY KEY (`pwd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `passwords`
--

LOCK TABLES `passwords` WRITE;
/*!40000 ALTER TABLE `passwords` DISABLE KEYS */;
INSERT INTO `passwords` VALUES ('password21');
/*!40000 ALTER TABLE `passwords` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `storeItems`
--

DROP TABLE IF EXISTS `storeItems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `storeItems` (
  `id` int NOT NULL,
  `itemName` varchar(60) NOT NULL,
  `price` float NOT NULL,
  `shortDesc` varchar(50) NOT NULL,
  `longDesc` varchar(500) NOT NULL,
  `imgLink` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `storeItems`
--

LOCK TABLES `storeItems` WRITE;
/*!40000 ALTER TABLE `storeItems` DISABLE KEYS */;
INSERT INTO `storeItems` VALUES (1,'Tumblewash',0,'Washing machine puzzle fun','Our very first project, Tumblewash is a puzzle game reminiscent of flash games. Tumble the washing machine through ten levels to collect floating, spinning pairs of pants. The catch? Only the door of the washing machine can collect them! As Tumblewash is our first project, it is currently available for free on our itch.io page. Happy tumbling!','https://cdn.discordapp.com/attachments/1180984530451038319/1180984603553574952/Tumblewash_box_art.png?ex=657f689f&is=656cf39f&hm=6b8441e49dfeab4b5ed010113dfd2381d5efa9d7774465022d44b5c131cd6cbf&'),(2,'Kartle',0,'Sandbox style kart racer','Kartle is an innovative take on the kart racer genre. Standard tracks are replaced with open areas, and laps are made of driving through sets of randomly placed rings that can spawn almost anywhere. In addition, Kartle cars can drive on almost any surface and freely rotate while airborne, making map knowledge and movement crucial to winning a race. Look forward to future updates as Kartle is in very early development.','https://cdn.discordapp.com/attachments/1180984530451038319/1180984602542747798/Kartle_boxart.png?ex=657f689e&is=656cf39e&hm=04ebe3b9b95811f05c5ba80df0b7b9c882edf2af097ed295f943d6a3625b990d&'),(3,'Getting To The Bottom Of It',0,'Downwards precision platforming','Getting To The Bottom Of It is a Foddian style precision platformer where progress is made by going down. After a severe windstorm hits the floating island you call home, you are tasked with turning on the backup generator that can only be accessed at the very bottom of the island. With nothing but a makeshift grappling hook, you will be forced to take the long way down to get to the bottom of it. Getting To The Bottom Of It is currently in development and should release summer of 2024.','https://cdn.discordapp.com/attachments/1180984530451038319/1180984601833906316/getting_to_the_bottom_of_it_boxart.png?ex=657f689e&is=656cf39e&hm=69c735772be1a4efdd9bdbb157aa55501944504a403690550e94809'),(4,'Cube Project',0,'New block based sandbox','Cube Project is a new block based sandbox words words words I am writing for fun at this rate','https://cdn.discordapp.com/attachments/1180984530451038319/1180984601443848242/Cube_Project_boxart.png?ex=657f689e&is=656cf39e&hm=7cc8a84c81150dea2df4a074fd1eaeff1ab7cd9740d32bc4ff01df2245d30e37&');
/*!40000 ALTER TABLE `storeItems` ENABLE KEYS */;
UNLOCK TABLES;
SET @@SESSION.SQL_LOG_BIN = @MYSQLDUMP_TEMP_LOG_BIN;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-04 22:39:41

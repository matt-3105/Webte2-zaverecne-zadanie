-- MySQL dump 10.13  Distrib 8.0.29, for Linux (x86_64)
--
-- Host: localhost    Database: skuskove1
-- ------------------------------------------------------
-- Server version	8.0.29-0ubuntu0.20.04.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `logy`
--

DROP TABLE IF EXISTS `logy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logy` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `log_time` datetime NOT NULL,
  `log` text CHARACTER SET utf8mb4 COLLATE utf8mb4_slovak_ci NOT NULL,
  `log_err` text CHARACTER SET utf8mb4 COLLATE utf8mb4_slovak_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=370 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovak_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logy`
--

LOCK TABLES `logy` WRITE;
/*!40000 ALTER TABLE `logy` DISABLE KEYS */;
INSERT INTO `logy` VALUES (327,'2022-05-24 19:46:38','0','OK'),(328,'2022-05-24 19:46:48','0','OK'),(329,'2022-05-24 19:46:51','0','OK'),(330,'2022-05-24 19:48:55','0','OK'),(331,'2022-05-24 19:54:13','0.15','OK'),(332,'2022-05-24 19:54:19','0.30','OK'),(333,'2022-05-24 20:00:11','0.15','OK'),(334,'2022-05-24 20:00:29','0.3','OK'),(335,'2022-05-24 20:04:37','','Bad request'),(336,'2022-05-24 20:05:13','','Bad request'),(337,'2022-05-24 20:05:46','','Bad request'),(338,'2022-05-24 20:06:18','0.1','Bad request'),(339,'2022-05-24 20:06:29','0.1','Bad request'),(340,'2022-05-24 20:07:01','0.1','Bad request'),(341,'2022-05-24 20:07:13','0.1','OK'),(342,'2022-05-24 20:07:37','0.1','OK'),(343,'2022-05-24 20:07:54','0.1','OK'),(344,'2022-05-24 20:12:18','0.1','Bad request'),(345,'2022-05-24 20:12:28','0.1','Bad request'),(346,'2022-05-24 20:12:31','0.1','Bad request'),(347,'2022-05-24 20:12:54','0.1','Bad request'),(348,'2022-05-24 20:13:11','0.1','OK'),(349,'2022-05-24 20:13:46','0.1','Bad request'),(350,'2022-05-24 20:14:04','0.1','Bad request'),(351,'2022-05-24 20:17:51','0.1','OK'),(352,'2022-05-24 20:26:03','0.1','OK'),(353,'2022-05-24 20:26:18','0','OK'),(354,'2022-05-24 20:26:37','0','OK'),(355,'2022-05-24 20:27:06','1+1','OK'),(356,'2022-05-24 20:35:15','0.15','OK'),(357,'2022-05-24 20:35:25','0.3','OK'),(358,'2022-05-24 20:35:35','0.45','OK'),(359,'2022-05-24 21:34:44','1+1','OK'),(360,'2022-05-24 22:27:21','0.1','OK'),(361,'2022-05-24 22:27:36','0.1','OK'),(362,'2022-05-24 22:27:46','0','OK'),(363,'2022-05-24 22:27:53','-0.1','OK'),(364,'2022-05-24 22:28:25','-0.1','OK'),(365,'2022-05-24 22:29:27','-0.15','OK'),(366,'2022-05-24 22:32:03','0.1','OK'),(367,'2022-05-24 22:32:11','0','OK'),(368,'2022-05-24 22:32:31','0.1','OK'),(369,'2022-05-24 22:33:18','0.2','OK');
/*!40000 ALTER TABLE `logy` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-24 22:34:09

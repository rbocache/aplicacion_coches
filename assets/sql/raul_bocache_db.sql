CREATE DATABASE  IF NOT EXISTS `raul_bocache_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `raul_bocache_db`;
-- MySQL dump 10.13  Distrib 8.0.21, for Win64 (x86_64)
--
-- Host: localhost    Database: raul_bocache_db
-- ------------------------------------------------------
-- Server version	8.0.21-0ubuntu0.20.04.4

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

--
-- Table structure for table `COCHES`
--

DROP TABLE IF EXISTS `COCHES`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `COCHES` (
  `id` int NOT NULL AUTO_INCREMENT,
  `anio_fabricacion` varchar(45) NOT NULL,
  `n_puertas` int NOT NULL,
  `fecha_compra` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `COMPRADORES_id` int NOT NULL,
  `VENDEDORES_id` int NOT NULL,
  `MARCAS_id` int NOT NULL,
  `TIPO_MOTOR_id` int NOT NULL,
  `precio` double DEFAULT '0',
  `MEDIAS_id` int NOT NULL,
  PRIMARY KEY (`id`,`MEDIAS_id`),
  KEY `fk_COCHES_COMPRADORES1_idx` (`COMPRADORES_id`),
  KEY `fk_COCHES_VENDEDORES1_idx` (`VENDEDORES_id`),
  KEY `fk_COCHES_MARCAS1_idx` (`MARCAS_id`),
  KEY `fk_TIPO_MOTOR_id_idx` (`TIPO_MOTOR_id`),
  KEY `fk_COCHES_MEDIAS1_idx` (`MEDIAS_id`),
  CONSTRAINT `fk_COCHES_COMPRADORES1` FOREIGN KEY (`COMPRADORES_id`) REFERENCES `COMPRADORES` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_COCHES_MARCAS1` FOREIGN KEY (`MARCAS_id`) REFERENCES `MARCAS` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_COCHES_MEDIAS1` FOREIGN KEY (`MEDIAS_id`) REFERENCES `MEDIAS` (`id`),
  CONSTRAINT `fk_COCHES_VENDEDORES1` FOREIGN KEY (`VENDEDORES_id`) REFERENCES `VENDEDORES` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_TIPO_MOTOR_id` FOREIGN KEY (`TIPO_MOTOR_id`) REFERENCES `TIPO_MOTOR` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `COCHES`
--

LOCK TABLES `COCHES` WRITE;
/*!40000 ALTER TABLE `COCHES` DISABLE KEYS */;
/*!40000 ALTER TABLE `COCHES` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `COMPRADORES`
--

DROP TABLE IF EXISTS `COMPRADORES`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `COMPRADORES` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `DIRECCIONES_id` int NOT NULL,
  PRIMARY KEY (`id`,`DIRECCIONES_id`),
  KEY `fk_COMPRADORES_DIRECCIONES1_idx` (`DIRECCIONES_id`),
  CONSTRAINT `fk_COMPRADORES_DIRECCIONES1` FOREIGN KEY (`DIRECCIONES_id`) REFERENCES `DIRECCIONES` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `COMPRADORES`
--

LOCK TABLES `COMPRADORES` WRITE;
/*!40000 ALTER TABLE `COMPRADORES` DISABLE KEYS */;
INSERT INTO `COMPRADORES` VALUES (2,'Raul','Bocache',3),(3,'Raul','Bocache',5);
/*!40000 ALTER TABLE `COMPRADORES` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `DIRECCIONES`
--

DROP TABLE IF EXISTS `DIRECCIONES`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `DIRECCIONES` (
  `id` int NOT NULL AUTO_INCREMENT,
  `calle` varchar(100) NOT NULL,
  `codigo_postal` varchar(5) NOT NULL,
  `localidad` varchar(45) NOT NULL,
  `provincia` varchar(45) NOT NULL,
  `pais` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `DIRECCIONES`
--

LOCK TABLES `DIRECCIONES` WRITE;
/*!40000 ALTER TABLE `DIRECCIONES` DISABLE KEYS */;
INSERT INTO `DIRECCIONES` VALUES (3,'Josep Tarradellas, 12','08788','Vilanova del Camí','Barcelona','España'),(4,'Josep Tarradellas, 12','08788','Vilanova del Camí','Barcelona','España'),(5,'Josep Tarradellas, 12','08788','Vilanova del Camí','Barcelona','España'),(6,'Josep Tarradellas, 12','08788','Vilanova del Camí','Barcelona','España');
/*!40000 ALTER TABLE `DIRECCIONES` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MARCAS`
--

DROP TABLE IF EXISTS `MARCAS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `MARCAS` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MARCAS`
--

LOCK TABLES `MARCAS` WRITE;
/*!40000 ALTER TABLE `MARCAS` DISABLE KEYS */;
INSERT INTO `MARCAS` VALUES (14,'Renault'),(15,'14'),(16,'14'),(17,'14');
/*!40000 ALTER TABLE `MARCAS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MEDIAS`
--

DROP TABLE IF EXISTS `MEDIAS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `MEDIAS` (
  `id` int NOT NULL AUTO_INCREMENT,
  `path` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MEDIAS`
--

LOCK TABLES `MEDIAS` WRITE;
/*!40000 ALTER TABLE `MEDIAS` DISABLE KEYS */;
INSERT INTO `MEDIAS` VALUES (4,'tmp/Coche1.JPG'),(5,'tmp/Coche1.JPG');
/*!40000 ALTER TABLE `MEDIAS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MODELOS`
--

DROP TABLE IF EXISTS `MODELOS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `MODELOS` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `MARCAS_id` int NOT NULL,
  PRIMARY KEY (`id`,`MARCAS_id`),
  KEY `fk_MODELOS_MARCAS1_idx` (`MARCAS_id`),
  CONSTRAINT `fk_MODELOS_MARCAS1` FOREIGN KEY (`MARCAS_id`) REFERENCES `MARCAS` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MODELOS`
--

LOCK TABLES `MODELOS` WRITE;
/*!40000 ALTER TABLE `MODELOS` DISABLE KEYS */;
INSERT INTO `MODELOS` VALUES (8,'Fuego 2.0 16V',14),(9,'8',15),(10,'8',16),(11,'8',17);
/*!40000 ALTER TABLE `MODELOS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TIPO_MOTOR`
--

DROP TABLE IF EXISTS `TIPO_MOTOR`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `TIPO_MOTOR` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TIPO_MOTOR`
--

LOCK TABLES `TIPO_MOTOR` WRITE;
/*!40000 ALTER TABLE `TIPO_MOTOR` DISABLE KEYS */;
INSERT INTO `TIPO_MOTOR` VALUES (9,'Gasolina'),(10,'9'),(11,'9'),(12,'9');
/*!40000 ALTER TABLE `TIPO_MOTOR` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `VENDEDORES`
--

DROP TABLE IF EXISTS `VENDEDORES`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `VENDEDORES` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `DIRECCIONES_id` int NOT NULL,
  PRIMARY KEY (`id`,`DIRECCIONES_id`),
  KEY `fk_VENDEDORES_DIRECCIONES1_idx` (`DIRECCIONES_id`),
  CONSTRAINT `fk_VENDEDORES_DIRECCIONES1` FOREIGN KEY (`DIRECCIONES_id`) REFERENCES `DIRECCIONES` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `VENDEDORES`
--

LOCK TABLES `VENDEDORES` WRITE;
/*!40000 ALTER TABLE `VENDEDORES` DISABLE KEYS */;
INSERT INTO `VENDEDORES` VALUES (2,'Raul','Bocache',4),(3,'Raul','Bocache',6);
/*!40000 ALTER TABLE `VENDEDORES` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-10-30 15:56:04

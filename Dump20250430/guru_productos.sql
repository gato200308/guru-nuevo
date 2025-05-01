-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: guru
-- ------------------------------------------------------
-- Server version	8.0.17

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
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `precio` decimal(10,2) DEFAULT NULL,
  `imagen_url` varchar(255) DEFAULT NULL,
  `vendedor_id` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vendedor_id` (`vendedor_id`),
  CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`vendedor_id`) REFERENCES `usuario` (`identificacion`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,'Artesana & Co.','.\r\n',80000.00,'imagenes/67edad77c2bf7_Imagen de WhatsApp 2025-04-02 a las 14.16.22_9f714b98.jpg','1193562724'),(2,'Hecho & Hilo','.',40000.00,'imagenes/67edadb0b65b3_Imagen de WhatsApp 2025-04-02 a las 14.16.22_59e7270b.jpg','1193562724'),(3,'Trama & Raíz','.',40000.00,'imagenes/67edaee1892c6_bolso_-removebg-preview.png','1193562724'),(4,'Manos del Mundo','.',95000.00,'imagenes/67edaf40681d0_Imagen_de_WhatsApp_2024-11-05_a_las_23.20.55_b3a10d3f-removebg-preview.png','1193562724'),(5,'Fibra Fina','.',85000.00,'imagenes/67edaf6be2ca1_Imagen_de_WhatsApp_2024-11-05_a_las_23.25.53_011f0cb5-removebg-preview.png','1193562724'),(6,'Tela y Tierra','.',45000.00,'imagenes/67edaf9113193_Imagen_de_WhatsApp_2024-11-05_a_las_23.27.15_b459f8bc-removebg-preview.png','1193562724'),(7,'Cosecha Craft','.',75000.00,'imagenes/67edafb1b3377_Imagen_de_WhatsApp_2024-11-05_a_las_23.29.32_827ea22a-removebg-preview.png','1193562724'),(8,'Tierra de Tela','.',69000.00,'imagenes/67edafcecf908_Imagen_de_WhatsApp_2024-11-05_a_las_23.37.15_88308922-removebg-preview (1).png','1193562724'),(9,'Musa Manual','.',87000.00,'imagenes/67edb0522ba74_Imagen_de_WhatsApp_2024-11-05_a_las_23.39.33_c6e1a0c7-removebg-preview.png','1193562724'),(10,'Cruz & Hilo','.',47000.00,'imagenes/67edb093f20b4_Imagen_de_WhatsApp_2024-11-05_a_las_23.52.11_e3f9d5d9-removebg-preview.png','1193562724'),(11,'Amano Bags','.',75000.00,'imagenes/67edb0bb9aae3_Imagen_de_WhatsApp_2024-11-05_a_las_23.53.28_f11d5332-removebg-preview (1).png','1193562724'),(12,'Raíces & Tramas','.',96000.00,'imagenes/67edb0d558c7d_Imagen_de_WhatsApp_2024-11-05_a_las_23.54.35_910167a7-removebg-preview (1).png','1193562724');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-30 19:54:35

-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: dbsistemaventas
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Activitylogs`
--

DROP TABLE IF EXISTS `Activitylogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Activitylogs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `action` varchar(255) NOT NULL,
  `module` varchar(255) DEFAULT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data`)),
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Activitylogs_user_id_foreign` (`user_id`),
  CONSTRAINT `Activitylogs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Activitylogs`
--

LOCK TABLES `Activitylogs` WRITE;
/*!40000 ALTER TABLE `Activitylogs` DISABLE KEYS */;
INSERT INTO `Activitylogs` VALUES (1,1,'Creacion de caja','Cajas','{\"caja\":{\"saldo_inicial\":\"1500\",\"nombre\":\"Caja de pedro urena\",\"fecha_hora_apertura\":\"2025-05-12 21:06:31\",\"user_id\":1,\"updated_at\":\"2025-05-13T02:06:31.000000Z\",\"created_at\":\"2025-05-13T02:06:31.000000Z\",\"id\":1}}','127.0.0.1','2025-05-13 01:06:31','2025-05-13 01:06:31'),(2,1,'Edición de empresa','Empresa','{\"nombre\":\"VOCAUTO UH IMPORT SRL\",\"propietario\":\"Pedro ure\\u00f1a\",\"rnc\":\"132653025\",\"porcentaje_impuesto\":\"18\",\"abreviatura_impuesto\":\"ITBIS\",\"direccion\":\"Av.principal  n\\u00ba105 punta cana\",\"correo\":\"VOCAUTO@GMAIL.COM\",\"telefono\":\"8299437780\",\"ubicacion\":\"PUNTA CANA VERON\",\"moneda_id\":\"2\"}','127.0.0.1','2025-05-13 01:09:51','2025-05-13 01:09:51'),(3,1,'Creacion de presentacion','Presentaciones','{\"nombre\":\"CAJAS\",\"descripcion\":\"PRESENTACIONES EN CAJA\"}','127.0.0.1','2025-05-13 01:13:50','2025-05-13 01:13:50'),(4,1,'Creacion de presentacion','Presentaciones','{\"nombre\":\"UNIDADES\",\"descripcion\":\"PRESENTACION DE UNIDADES ES UND\"}','127.0.0.1','2025-05-13 01:14:12','2025-05-13 01:14:12'),(5,1,'creacion de producto','productos','{\"codigo\":null,\"nombre\":\"SAMSUNG GALAXY S25 ULTRA\",\"descripcion\":\"TELEFONO SAMSUNG\",\"img_path\":{},\"marca_id\":\"2\",\"presentacione_id\":\"2\",\"categoria_id\":\"1\"}','127.0.0.1','2025-05-13 01:17:47','2025-05-13 01:17:47'),(6,1,'Inicializacion de producto','producto','{\"producto_id\":\"1\",\"ubicacione_id\":\"4\",\"cantidad\":\"5\",\"fecha_vencimiento\":null,\"costo_unitario\":\"85000\"}','127.0.0.1','2025-05-13 01:18:18','2025-05-13 01:18:18'),(7,1,'Creacion de proveedor','proveedores','{\"razon_social\":\"PEDRO SUPLID\",\"direccion\":\"101 4TA ESQ, RAMON RODRIGUEZ, URB, ANTIGUA\",\"documento_id\":\"3\",\"numero_documento\":\"88663355\"}','127.0.0.1','2025-05-13 01:20:45','2025-05-13 01:20:45'),(8,1,'Creacion de caja','Cajas','{\"caja\":{\"saldo_inicial\":\"1500\",\"nombre\":\"Caja de pedro urena cruz\",\"fecha_hora_apertura\":\"2025-05-13 17:48:43\",\"user_id\":1,\"updated_at\":\"2025-05-13T22:48:43.000000Z\",\"created_at\":\"2025-05-13T22:48:43.000000Z\",\"id\":2}}','127.0.0.1','2025-05-13 21:48:43','2025-05-13 21:48:43'),(9,1,'Creacion de movimiento','Movimientos','{\"descripcion\":\"450\",\"monto\":\"450\",\"metodo_pago\":\"EFECTIVO\",\"caja_id\":\"2\",\"tipo\":\"RETIRO\"}','127.0.0.1','2025-05-13 21:50:07','2025-05-13 21:50:07'),(10,1,'Creacion de caja','Cajas','{\"caja\":{\"saldo_inicial\":\"8500\",\"nombre\":\"Caja de pedro urena cruz\",\"fecha_hora_apertura\":\"2025-05-13 17:50:48\",\"user_id\":1,\"updated_at\":\"2025-05-13T22:50:48.000000Z\",\"created_at\":\"2025-05-13T22:50:48.000000Z\",\"id\":3}}','127.0.0.1','2025-05-13 21:50:48','2025-05-13 21:50:48'),(11,1,'Creacion de movimiento','Movimientos','{\"descripcion\":\"agua\",\"monto\":\"1580\",\"metodo_pago\":\"EFECTIVO\",\"caja_id\":\"3\",\"tipo\":\"RETIRO\"}','127.0.0.1','2025-05-13 21:52:22','2025-05-13 21:52:22'),(12,1,'Creacion de una venta','venta','{\"cliente_id\":\"1\",\"comprobante_id\":\"1\",\"metodo_pago\":\"EFECTIVO\",\"subtotal\":\"46541.17\",\"impuesto\":\"8377.41\",\"total\":\"54918.58\",\"monto_recibido\":\"55000\",\"vuelto_entregado\":\"81.42\"}','127.0.0.1','2025-05-13 23:07:52','2025-05-13 23:07:52'),(13,1,'Creacion de empleado','Empleados','{\"razon_social\":\"xsxsxdfgdfgdfgdf\",\"cargo\":\"vendedor\"}','127.0.0.1','2025-05-13 23:31:15','2025-05-13 23:31:15'),(14,1,'Creacion de empleado','Empleados','{\"razon_social\":\"xsxsxdfgdfgdfgdf\",\"cargo\":\"vendedor\"}','127.0.0.1','2025-05-13 23:31:30','2025-05-13 23:31:30'),(15,1,'Creacion de empleado','Empleados','{\"razon_social\":\"julio\",\"cargo\":\"vendedor\"}','127.0.0.1','2025-05-13 23:40:32','2025-05-13 23:40:32'),(16,1,'Creación de empleado','Empleados','{\"razon_social\":\"jose\",\"cargo\":\"vendedor\",\"img\":null}','127.0.0.1','2025-05-13 23:54:58','2025-05-13 23:54:58'),(17,1,'Creación de empleado','Empleados','{\"razon_social\":\"PERSONAL\",\"cargo\":\"vendedor\",\"img\":null}','127.0.0.1','2025-05-14 00:15:22','2025-05-14 00:15:22'),(18,1,'Eliminación de empleado','Empleados','{\"empleado\":{\"id\":5,\"razon_social\":\"PERSONAL\",\"cargo\":\"vendedor\",\"img\":null,\"created_at\":\"2025-05-14T01:15:22.000000Z\",\"updated_at\":\"2025-05-14T01:15:22.000000Z\"}}','127.0.0.1','2025-05-14 00:15:32','2025-05-14 00:15:32'),(19,1,'Eliminación de empleado','Empleados','{\"empleado\":{\"id\":4,\"razon_social\":\"jose\",\"cargo\":\"vendedor\",\"img\":null,\"created_at\":\"2025-05-14T00:54:58.000000Z\",\"updated_at\":\"2025-05-14T00:54:58.000000Z\"}}','127.0.0.1','2025-05-14 00:15:39','2025-05-14 00:15:39'),(20,1,'Creación de empleado','Empleados','{\"razon_social\":\"jose a\",\"cargo\":\"vendedor\",\"img\":null}','127.0.0.1','2025-05-14 00:27:10','2025-05-14 00:27:10'),(21,1,'Creacion de empleado','Empleados','{\"razon_social\":\"PERSONAL\",\"cargo\":\"vendedor\"}','127.0.0.1','2025-05-14 00:44:01','2025-05-14 00:44:01'),(22,1,'Creacion de empleado','Empleados','{\"razon_social\":\"maria rodriguez\",\"cargo\":\"vendedora\"}','127.0.0.1','2025-05-14 00:55:52','2025-05-14 00:55:52'),(23,1,'Creacion de empleado','Empleados','{\"razon_social\":\"maria rodriguez\",\"cargo\":\"vendedora\"}','127.0.0.1','2025-05-14 01:06:12','2025-05-14 01:06:12'),(24,1,'Creacion de empleado','Empleados','{\"razon_social\":\"PERSONAL\",\"cargo\":\"vendedor\"}','127.0.0.1','2025-05-14 01:06:35','2025-05-14 01:06:35'),(25,1,'Eliminacion de empleado','Empleados','{\"empleado\":{\"id\":10,\"razon_social\":\"PERSONAL\",\"cargo\":\"vendedor\",\"img_path\":null,\"created_at\":\"2025-05-14T02:06:35.000000Z\",\"updated_at\":\"2025-05-14T02:06:35.000000Z\"}}','127.0.0.1','2025-05-14 01:07:47','2025-05-14 01:07:47'),(26,1,'Eliminacion de empleado','Empleados','{\"empleado\":{\"id\":8,\"razon_social\":\"maria rodriguez\",\"cargo\":\"vendedora\",\"img_path\":null,\"created_at\":\"2025-05-14T01:55:52.000000Z\",\"updated_at\":\"2025-05-14T01:55:52.000000Z\"}}','127.0.0.1','2025-05-14 01:07:51','2025-05-14 01:07:51'),(27,1,'Creacion de empleado','Empleados','{\"razon_social\":\"maria rodriguez cruz\",\"cargo\":\"vendedora\"}','127.0.0.1','2025-05-14 01:08:07','2025-05-14 01:08:07'),(28,1,'Eliminacion de empleado','Empleados','{\"empleado\":{\"id\":9,\"razon_social\":\"maria rodriguez\",\"cargo\":\"vendedora\",\"img_path\":null,\"created_at\":\"2025-05-14T02:06:12.000000Z\",\"updated_at\":\"2025-05-14T02:06:12.000000Z\"}}','127.0.0.1','2025-05-14 01:08:41','2025-05-14 01:08:41'),(29,1,'Actualización de empleado','Empleados','{\"razon_social\":\"maria rodriguez\",\"cargo\":\"vendedora\"}','127.0.0.1','2025-05-14 01:10:43','2025-05-14 01:10:43'),(30,1,'Creación de empleado','Empleados','{\"razon_social\":\"PERSONAL\",\"cargo\":\"vendedor\",\"img\":null}','127.0.0.1','2025-05-14 01:35:54','2025-05-14 01:35:54'),(31,1,'Eliminación de empleado','Empleados','{\"empleado\":{\"id\":12,\"razon_social\":\"PERSONAL\",\"cargo\":\"vendedor\",\"img\":null,\"created_at\":\"2025-05-14T02:35:54.000000Z\",\"updated_at\":\"2025-05-14T02:35:54.000000Z\"}}','127.0.0.1','2025-05-14 01:36:17','2025-05-14 01:36:17'),(32,1,'Edicion de rol','roles','{\"_method\":\"PATCH\",\"_token\":\"ZdLdtsLew0L81H36w2nvQwWL2wk29JvZ20Anmbxi\",\"name\":\"CAJA\",\"permission\":[\"1\",\"2\",\"3\",\"4\",\"10\",\"11\",\"12\",\"13\",\"23\",\"29\",\"30\",\"31\",\"32\",\"38\",\"39\",\"40\",\"41\",\"42\",\"44\",\"45\",\"46\"]}','127.0.0.1','2025-05-15 22:20:17','2025-05-15 22:20:17'),(33,1,'Edicion de rol','roles','{\"_method\":\"PATCH\",\"_token\":\"ZdLdtsLew0L81H36w2nvQwWL2wk29JvZ20Anmbxi\",\"name\":\"CAJA\",\"permission\":[\"1\",\"2\",\"3\",\"4\",\"10\",\"11\",\"12\",\"13\",\"17\",\"18\",\"19\",\"23\",\"29\",\"30\",\"31\",\"32\",\"38\",\"39\",\"40\",\"41\",\"42\",\"44\",\"45\",\"46\"]}','127.0.0.1','2025-05-15 22:25:45','2025-05-15 22:25:45'),(34,1,'Eliminacion de rol','roles','{\"rol_id\":\"2\"}','127.0.0.1','2025-05-15 22:38:33','2025-05-15 22:38:33'),(35,1,'Creacion de empleado','Empleados','{\"razon_social\":\"xsxsxdfgdfgdfgdf\",\"cargo\":\"vendedor\"}','127.0.0.1','2025-05-16 23:27:06','2025-05-16 23:27:06'),(36,1,'Creacion de empleado','Empleados','{\"razon_social\":\"xsxsxdfgdfgdfgdf\",\"cargo\":\"vendedor\"}','127.0.0.1','2025-05-16 23:29:58','2025-05-16 23:29:58'),(37,1,'Creacion de empleado','Empleados','{\"razon_social\":\"rrrrrr\",\"cargo\":\"vendedor\"}','127.0.0.1','2025-05-16 23:46:05','2025-05-16 23:46:05'),(38,1,'Creacion de empleado','Empleados','{\"razon_social\":\"rrrrrr\",\"cargo\":\"vendedor\"}','127.0.0.1','2025-05-16 23:47:10','2025-05-16 23:47:10'),(39,1,'Creacion de empleado','Empleados','{\"razon_social\":\"xsxsxdfgdfgdfgdf\",\"cargo\":\"vendedora\"}','127.0.0.1','2025-05-16 23:47:59','2025-05-16 23:47:59'),(40,1,'Creación de empleado','Empleados','{\"razon_social\":\"xsxsxdfgdfgdfgdf\",\"cargo\":\"vendedor\",\"img\":{},\"img_path\":\"storage\\/empleados\\/6827e8ae550d3.jpg\"}','127.0.0.1','2025-05-17 00:38:55','2025-05-17 00:38:55'),(41,1,'Eliminación de empleado','Empleados','{\"empleado\":{\"id\":11,\"razon_social\":\"maria rodriguez\",\"cargo\":\"vendedora\",\"img\":null,\"created_at\":\"2025-05-14T02:08:07.000000Z\",\"updated_at\":\"2025-05-14T02:10:43.000000Z\"}}','127.0.0.1','2025-05-17 00:43:16','2025-05-17 00:43:16'),(42,1,'Creación de empleado','Empleados','{\"razon_social\":\"sdsd\",\"cargo\":\"vendedor\",\"img\":{},\"img_path\":\"storage\\/empleados\\/6827e9cf1a6f8.jpeg\"}','127.0.0.1','2025-05-17 00:43:43','2025-05-17 00:43:43'),(43,1,'Creacion de Empleado','Empleado','{\"razon_social\":\"EMPLEADO5\",\"cargo\":\"NADA\",\"img\":{}}','127.0.0.1','2025-05-17 01:10:13','2025-05-17 01:10:13'),(44,1,'Eliminación de empleado','Empleados','{\"id\":24,\"razon_social\":\"EMPLEADO5\",\"cargo\":\"NADA\"}','127.0.0.1','2025-05-17 01:19:21','2025-05-17 01:19:21'),(45,1,'actualizacion del Empleado','Empleado','{\"razon_social\":\"EJEMPLO 2\",\"cargo\":\"ADMINISTRADOR\"}','127.0.0.1','2025-05-17 01:19:42','2025-05-17 01:19:42'),(46,1,'Creacion de usuario','Usuario','{\"name\":\"Darlin\",\"email\":\"darlin@gmail.com\",\"password\":\"12345678\",\"role\":\"CAJA\",\"empleado_id\":\"21\"}','127.0.0.1','2025-05-17 01:42:57','2025-05-17 01:42:57'),(47,1,'Creacion de usuario','Usuario','{\"name\":\"Darlin Bonilla\",\"email\":\"darlin@gmail.com\",\"password\":\"12345678\",\"role\":\"CAJA\",\"empleado_id\":\"21\"}','127.0.0.1','2025-05-17 12:26:51','2025-05-17 12:26:51'),(48,1,'Usuario desactivado','Usuario','{\"user_id\":\"4\",\"estado\":0}','127.0.0.1','2025-05-17 12:46:52','2025-05-17 12:46:52'),(49,1,'usuario activo','Usuario','{\"user_id\":\"4\",\"estado\":1}','127.0.0.1','2025-05-17 12:46:57','2025-05-17 12:46:57'),(50,1,'Usuario desactivado','Usuario','{\"user_id\":\"4\",\"estado\":0}','127.0.0.1','2025-05-17 12:49:29','2025-05-17 12:49:29'),(51,1,'usuario activo','Usuario','{\"user_id\":\"4\",\"estado\":1}','127.0.0.1','2025-05-17 12:53:50','2025-05-17 12:53:50'),(52,1,'Usuario desactivado','Usuario','{\"user_id\":\"4\",\"estado\":0}','127.0.0.1','2025-05-17 13:25:43','2025-05-17 13:25:43'),(53,1,'Usuario activado','Usuario','{\"user_id\":\"4\",\"estado\":1}','127.0.0.1','2025-05-17 13:30:49','2025-05-17 13:30:49'),(54,1,'Usuario desactivado','Usuario','{\"user_id\":\"4\",\"estado\":0}','127.0.0.1','2025-05-17 13:30:53','2025-05-17 13:30:53'),(55,1,'Usuario activado','Usuario','{\"user_id\":\"4\",\"estado\":1}','127.0.0.1','2025-05-17 13:35:48','2025-05-17 13:35:48'),(56,1,'Usuario desactivado','Usuario','{\"user_id\":\"4\",\"estado\":0}','127.0.0.1','2025-05-17 13:41:22','2025-05-17 13:41:22'),(57,1,'Usuario activado','Usuario','{\"user_id\":\"4\",\"estado\":1}','127.0.0.1','2025-05-17 13:41:31','2025-05-17 13:41:31'),(58,1,'Usuario desactivado','Usuario','{\"user_id\":\"4\",\"estado\":0}','127.0.0.1','2025-05-17 13:47:56','2025-05-17 13:47:56'),(59,1,'Usuario activado','Usuario','{\"user_id\":\"4\",\"estado\":1}','127.0.0.1','2025-05-17 13:48:03','2025-05-17 13:48:03'),(60,1,'Creacion de usuario','Usuario','{\"name\":\"ejemplo\",\"email\":\"personal@gmail.com\",\"password\":\"12345678\",\"role\":\"CAJA\",\"empleado_id\":\"22\"}','127.0.0.1','2025-05-17 13:48:47','2025-05-17 13:48:47'),(61,1,'Usuario desactivado','Usuario','{\"user_id\":\"5\",\"estado\":0}','127.0.0.1','2025-05-17 13:52:41','2025-05-17 13:52:41'),(62,1,'Edicion de rol','roles','{\"_method\":\"PATCH\",\"_token\":\"d1QPZxCyDwj5IxQrcHyJrPUoDxPZb1E39a0BPwWK\",\"name\":\"CAJA\",\"permission\":[\"1\",\"2\",\"3\",\"4\"]}','127.0.0.1','2025-05-17 15:48:08','2025-05-17 15:48:08'),(63,1,'Creacion de caja','Cajas','{\"caja\":{\"saldo_inicial\":\"1000\",\"nombre\":\"Caja de pedro urena cruz\",\"fecha_hora_apertura\":\"2025-05-18 11:32:34\",\"user_id\":1,\"updated_at\":\"2025-05-18T16:32:34.000000Z\",\"created_at\":\"2025-05-18T16:32:34.000000Z\",\"id\":4}}','127.0.0.1','2025-05-18 15:32:34','2025-05-18 15:32:34'),(64,1,'Creacion de una venta','venta','{\"cliente_id\":\"1\",\"comprobante_id\":\"2\",\"metodo_pago\":\"EFECTIVO\",\"subtotal\":\"232705.85\",\"impuesto\":\"41887.05\",\"total\":\"274592.9\",\"monto_recibido\":\"275000\",\"vuelto_entregado\":\"407.10\"}','127.0.0.1','2025-05-18 15:33:08','2025-05-18 15:33:08');
/*!40000 ALTER TABLE `Activitylogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cajas`
--

DROP TABLE IF EXISTS `cajas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cajas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `fecha_hora_apertura` datetime NOT NULL,
  `fecha_hora_cierre` datetime DEFAULT NULL,
  `saldo_inicial` decimal(8,2) NOT NULL,
  `saldo_final` decimal(8,2) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cajas_user_id_foreign` (`user_id`),
  CONSTRAINT `cajas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cajas`
--

LOCK TABLES `cajas` WRITE;
/*!40000 ALTER TABLE `cajas` DISABLE KEYS */;
INSERT INTO `cajas` VALUES (1,'Caja de pedro urena','2025-05-12 21:06:31','2025-05-12 21:06:35',1500.00,1500.00,0,1,'2025-05-13 01:06:31','2025-05-13 01:06:35'),(2,'Caja de pedro urena cruz','2025-05-13 17:48:43','2025-05-13 17:50:31',1500.00,1050.00,0,1,'2025-05-13 21:48:43','2025-05-13 21:50:31'),(3,'Caja de pedro urena cruz','2025-05-13 17:50:48','2025-05-13 19:17:51',8500.00,61838.58,0,1,'2025-05-13 21:50:48','2025-05-13 23:17:51'),(4,'Caja de pedro urena cruz','2025-05-18 11:32:34','2025-06-05 14:26:35',1000.00,275592.90,0,1,'2025-05-18 15:32:34','2025-06-05 18:26:35');
/*!40000 ALTER TABLE `cajas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caracteristicas`
--

DROP TABLE IF EXISTS `caracteristicas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caracteristicas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caracteristicas`
--

LOCK TABLES `caracteristicas` WRITE;
/*!40000 ALTER TABLE `caracteristicas` DISABLE KEYS */;
INSERT INTO `caracteristicas` VALUES (1,'TELEFONO SAMSUNG','TELEFONO',1,'2025-05-13 01:13:21','2025-05-13 01:13:21'),(2,'CAJAS','PRESENTACIONES EN CAJA',1,'2025-05-13 01:13:50','2025-05-13 01:13:50'),(3,'UNIDADES','PRESENTACION DE UNIDADES ES UND',1,'2025-05-13 01:14:12','2025-05-13 01:14:12'),(4,'LG','MARCA DE ELETRODOMESTICO',1,'2025-05-13 01:14:32','2025-05-13 01:14:32'),(5,'SAMSUNG','MARCA DE TELEFONO Y ELETRODOMESTICO',1,'2025-05-13 01:14:55','2025-05-13 01:14:55');
/*!40000 ALTER TABLE `caracteristicas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `caracteristica_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categorias_caracteristica_id_unique` (`caracteristica_id`),
  CONSTRAINT `categorias_caracteristica_id_foreign` FOREIGN KEY (`caracteristica_id`) REFERENCES `caracteristicas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,1,'2025-05-13 01:13:21','2025-05-13 01:13:21');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `persona_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clientes_persona_id_unique` (`persona_id`),
  CONSTRAINT `clientes_persona_id_foreign` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,1,'2025-05-13 01:19:43','2025-05-13 01:19:43'),(2,2,'2025-05-13 01:19:58','2025-05-13 01:19:58');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compra_producto`
--

DROP TABLE IF EXISTS `compra_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compra_producto` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `compra_id` bigint(20) unsigned NOT NULL,
  `producto_id` bigint(20) unsigned NOT NULL,
  `cantidad` int(10) unsigned NOT NULL,
  `precio_compra` decimal(10,2) NOT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `compra_producto_compra_id_foreign` (`compra_id`),
  KEY `compra_producto_producto_id_foreign` (`producto_id`),
  CONSTRAINT `compra_producto_compra_id_foreign` FOREIGN KEY (`compra_id`) REFERENCES `compras` (`id`) ON DELETE CASCADE,
  CONSTRAINT `compra_producto_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compra_producto`
--

LOCK TABLES `compra_producto` WRITE;
/*!40000 ALTER TABLE `compra_producto` DISABLE KEYS */;
INSERT INTO `compra_producto` VALUES (2,3,1,15,45800.00,NULL,'2025-05-13 03:36:18','2025-05-13 03:36:18'),(3,4,1,1,35800.90,NULL,'2025-05-13 13:50:37','2025-05-13 13:50:37');
/*!40000 ALTER TABLE `compra_producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compras`
--

DROP TABLE IF EXISTS `compras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compras` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `comprobante_id` bigint(20) unsigned NOT NULL,
  `proveedore_id` bigint(20) unsigned NOT NULL,
  `numero_comprobante` varchar(255) DEFAULT NULL,
  `comprobante_path` varchar(2048) DEFAULT NULL,
  `metodo_pago` enum('EFECTIVO','TARJETA') NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `impuesto` decimal(8,2) unsigned NOT NULL,
  `subtotal` decimal(8,2) unsigned NOT NULL,
  `total` decimal(8,2) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `compras_numero_comprobante_unique` (`numero_comprobante`),
  KEY `compras_user_id_foreign` (`user_id`),
  KEY `compras_comprobante_id_foreign` (`comprobante_id`),
  KEY `compras_proveedore_id_foreign` (`proveedore_id`),
  CONSTRAINT `compras_comprobante_id_foreign` FOREIGN KEY (`comprobante_id`) REFERENCES `comprobantes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `compras_proveedore_id_foreign` FOREIGN KEY (`proveedore_id`) REFERENCES `proveedores` (`id`) ON DELETE CASCADE,
  CONSTRAINT `compras_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compras`
--

LOCK TABLES `compras` WRITE;
/*!40000 ALTER TABLE `compras` DISABLE KEYS */;
INSERT INTO `compras` VALUES (3,1,1,1,'124',NULL,'EFECTIVO','2025-05-13 00:35:00',0.00,0.00,810660.00,'2025-05-13 03:36:18','2025-05-13 03:36:18'),(4,1,1,1,'123525',NULL,'EFECTIVO','2025-05-13 10:49:00',6444.16,35800.90,42245.06,'2025-05-13 13:50:37','2025-05-13 13:50:37');
/*!40000 ALTER TABLE `compras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comprobantes`
--

DROP TABLE IF EXISTS `comprobantes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comprobantes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comprobantes`
--

LOCK TABLES `comprobantes` WRITE;
/*!40000 ALTER TABLE `comprobantes` DISABLE KEYS */;
INSERT INTO `comprobantes` VALUES (1,'Consumidor final',NULL,NULL),(2,'Factura Credito fiscal',NULL,NULL);
/*!40000 ALTER TABLE `comprobantes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documentos`
--

DROP TABLE IF EXISTS `documentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documentos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documentos`
--

LOCK TABLES `documentos` WRITE;
/*!40000 ALTER TABLE `documentos` DISABLE KEYS */;
INSERT INTO `documentos` VALUES (1,'Cedula',NULL,NULL),(2,'Pasaporte',NULL,NULL),(3,'Rnc',NULL,NULL),(4,'Carnet',NULL,NULL);
/*!40000 ALTER TABLE `documentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleados`
--

DROP TABLE IF EXISTS `empleados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empleados` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `razon_social` varchar(255) NOT NULL,
  `cargo` varchar(50) NOT NULL,
  `img` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleados`
--

LOCK TABLES `empleados` WRITE;
/*!40000 ALTER TABLE `empleados` DISABLE KEYS */;
INSERT INTO `empleados` VALUES (21,'Darlin Bonilla cruz','Tecnico supervisor','empleados/6827ece648ef2.jpeg','2025-05-17 00:52:01','2025-05-17 00:56:54'),(22,'PERSONAL','vendedor','empleados/6827ed6029ed4.jpeg','2025-05-17 00:58:56','2025-05-17 00:58:56'),(23,'EJEMPLO 2','ADMINISTRADOR','empleados/6827eecf5aeb5.jpeg','2025-05-17 01:02:44','2025-05-17 01:19:42'),(25,'luis daniiel','conserje',NULL,'2025-06-01 15:00:32','2025-06-01 15:00:32'),(26,'jose lulu','almacenista',NULL,'2025-06-01 15:00:32','2025-06-01 15:00:32'),(27,'juan perez','vendedor',NULL,'2025-06-01 15:00:32','2025-06-01 15:00:32'),(28,'maria cruz','cajera',NULL,'2025-06-01 15:00:32','2025-06-01 15:00:32');
/*!40000 ALTER TABLE `empleados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresa`
--

DROP TABLE IF EXISTS `empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresa` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `propietario` varchar(255) NOT NULL,
  `rnc` varchar(50) NOT NULL,
  `porcentaje_impuesto` int(10) unsigned NOT NULL,
  `abreviatura_impuesto` varchar(5) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `ubicacion` varchar(255) DEFAULT NULL,
  `moneda_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `empresa_moneda_id_foreign` (`moneda_id`),
  CONSTRAINT `empresa_moneda_id_foreign` FOREIGN KEY (`moneda_id`) REFERENCES `moneda` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresa`
--

LOCK TABLES `empresa` WRITE;
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
INSERT INTO `empresa` VALUES (1,'VOCAUTO UH IMPORT SRL','Pedro ureña','132653025',18,'ITBIS','Av.principal  nº105 punta cana','VOCAUTO@GMAIL.COM','8299437780','PUNTA CANA VERON',2,NULL,'2025-05-13 01:09:51');
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventario`
--

DROP TABLE IF EXISTS `inventario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventario` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `producto_id` bigint(20) unsigned NOT NULL,
  `ubicacione_id` bigint(20) unsigned NOT NULL,
  `cantidad` bigint(20) unsigned NOT NULL,
  `cantidad_minima` bigint(20) unsigned DEFAULT NULL,
  `cantidad_maxima` bigint(20) unsigned DEFAULT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inventario_producto_id_foreign` (`producto_id`),
  KEY `inventario_ubicacione_id_foreign` (`ubicacione_id`),
  CONSTRAINT `inventario_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `inventario_ubicacione_id_foreign` FOREIGN KEY (`ubicacione_id`) REFERENCES `ubicaciones` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventario`
--

LOCK TABLES `inventario` WRITE;
/*!40000 ALTER TABLE `inventario` DISABLE KEYS */;
INSERT INTO `inventario` VALUES (1,1,4,30,NULL,NULL,NULL,'2025-05-13 01:18:18','2025-05-18 15:33:08');
/*!40000 ALTER TABLE `inventario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kardex`
--

DROP TABLE IF EXISTS `kardex`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kardex` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `producto_id` bigint(20) unsigned NOT NULL,
  `tipo_transaccion` enum('COMPRA','VENTA','AJUSTE','APERTURA') NOT NULL,
  `descripcion_transaccion` varchar(255) NOT NULL,
  `entrada` int(11) DEFAULT NULL,
  `salida` int(11) DEFAULT NULL,
  `saldo` int(11) DEFAULT NULL,
  `costo_unitario` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kardex_producto_id_foreign` (`producto_id`),
  CONSTRAINT `kardex_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kardex`
--

LOCK TABLES `kardex` WRITE;
/*!40000 ALTER TABLE `kardex` DISABLE KEYS */;
INSERT INTO `kardex` VALUES (1,1,'APERTURA','Apertura del producto',NULL,NULL,5,85000.00,'2025-05-13 01:18:18','2025-05-13 01:18:18'),(2,1,'COMPRA','Entrada de producto por la compra #1',15,NULL,20,45500.00,'2025-05-13 02:49:57','2025-05-13 02:49:57'),(3,1,'COMPRA','Entrada de producto por la compra #3',15,NULL,35,45800.00,'2025-05-13 03:36:18','2025-05-13 03:36:18'),(4,1,'COMPRA','Entrada de producto por la compra #4',1,NULL,36,35800.90,'2025-05-13 13:50:37','2025-05-13 13:50:37'),(5,1,'VENTA','Salida de producto por la Venta #1',NULL,1,35,35800.90,'2025-05-13 23:07:52','2025-05-13 23:07:52'),(6,1,'VENTA','Salida de producto por la Venta #2',NULL,5,30,35800.90,'2025-05-18 15:33:08','2025-05-18 15:33:08');
/*!40000 ALTER TABLE `kardex` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marcas`
--

DROP TABLE IF EXISTS `marcas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marcas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `caracteristica_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `marcas_caracteristica_id_unique` (`caracteristica_id`),
  CONSTRAINT `marcas_caracteristica_id_foreign` FOREIGN KEY (`caracteristica_id`) REFERENCES `caracteristicas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marcas`
--

LOCK TABLES `marcas` WRITE;
/*!40000 ALTER TABLE `marcas` DISABLE KEYS */;
INSERT INTO `marcas` VALUES (1,4,'2025-05-13 01:14:32','2025-05-13 01:14:32'),(2,5,'2025-05-13 01:14:55','2025-05-13 01:14:55');
/*!40000 ALTER TABLE `marcas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2025_03_07_000000_create_failed_jobs_table',1),(2,'2025_03_07_000000_create_users_table',1),(3,'2025_03_07_000001_create_personal_access_tokens_table',1),(4,'2025_03_07_011515_create_documentos_table',1),(5,'2025_03_07_012149_create_personas_table',1),(6,'2025_03_07_015030_create_proveedores_table',1),(7,'2025_03_07_015806_create_clientes_table',1),(8,'2025_03_07_020010_create_comprobantes_table',1),(9,'2025_03_07_020257_create_compras_table',1),(10,'2025_03_07_022517_create_ventas_table',1),(11,'2025_03_07_023329_create_caracteristicas_table',1),(12,'2025_03_07_023555_create_categorias_table',1),(13,'2025_03_07_023818_create_marcas_table',1),(14,'2025_03_07_023953_create_presentaciones_table',1),(15,'2025_03_07_024112_create_productos_table',1),(16,'2025_03_07_025748_create_compra_producto_table',1),(17,'2025_03_07_030137_create_producto_venta_table',1),(18,'2025_03_07_083634_create_permission_tables',1),(19,'2025_03_07_100000_create_password_resets_table',1),(20,'2025_03_07_114541_create_monedas_table',1),(21,'2025_03_07_115038_create_empresas_table',1),(22,'2025_03_07_120039_create_empleados_table',1),(23,'2025_03_07_120742_update_colums_to_users_table',1),(24,'2025_03_07_122837_create_cajas_table',1),(25,'2025_03_07_123939_create_movimientos_table',1),(26,'2025_03_07_124658_update_colums_to_ventas_table',1),(27,'2025_03_07_125444_create_ubicaciones_table',1),(28,'2025_03_07_125608_create_inventarios_table',1),(29,'2025_03_07_163938_create_kardexes_table',1),(30,'2025_03_14_140942_create_activity_logs_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',1),(4,'App\\Models\\User',3),(4,'App\\Models\\User',4),(4,'App\\Models\\User',5);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `moneda`
--

DROP TABLE IF EXISTS `moneda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `moneda` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `estandar_iso` varchar(10) NOT NULL,
  `nombre_completo` varchar(255) NOT NULL,
  `simbolo` varchar(3) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `moneda`
--

LOCK TABLES `moneda` WRITE;
/*!40000 ALTER TABLE `moneda` DISABLE KEYS */;
INSERT INTO `moneda` VALUES (1,'USD','Dolar estadounidense','$',NULL,NULL),(2,'DOP','Peso Dominicano','RD$',NULL,NULL);
/*!40000 ALTER TABLE `moneda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movimientos`
--

DROP TABLE IF EXISTS `movimientos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `movimientos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` enum('VENTA','RETIRO') NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `monto` decimal(8,2) NOT NULL,
  `metodo_pago` enum('EFECTIVO','TARJETA') NOT NULL,
  `caja_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `movimientos_caja_id_foreign` (`caja_id`),
  CONSTRAINT `movimientos_caja_id_foreign` FOREIGN KEY (`caja_id`) REFERENCES `cajas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movimientos`
--

LOCK TABLES `movimientos` WRITE;
/*!40000 ALTER TABLE `movimientos` DISABLE KEYS */;
INSERT INTO `movimientos` VALUES (1,'RETIRO','450',450.00,'EFECTIVO',2,'2025-05-13 21:50:07','2025-05-13 21:50:07'),(2,'RETIRO','agua',1580.00,'EFECTIVO',3,'2025-05-13 21:52:22','2025-05-13 21:52:22'),(3,'VENTA','venta # C003 - 0000001',54918.58,'EFECTIVO',3,'2025-05-13 23:07:52','2025-05-13 23:07:52'),(4,'VENTA','venta # F004 - 0000001',274592.90,'EFECTIVO',4,'2025-05-18 15:33:08','2025-05-18 15:33:08');
/*!40000 ALTER TABLE `movimientos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'ver-registro-actividad','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(2,'ver-caja','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(3,'aperturar-caja','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(4,'cerrar-caja','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(5,'ver-kardex','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(6,'ver-categoria','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(7,'crear-categoria','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(8,'editar-categoria','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(9,'eliminar-categoria','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(10,'ver-cliente','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(11,'crear-cliente','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(12,'editar-cliente','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(13,'eliminar-cliente','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(14,'ver-compra','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(15,'crear-compra','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(16,'mostrar-compra','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(17,'ver-empleado','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(18,'crear-empleado','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(19,'editar-empleado','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(20,'eliminar-empleado','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(21,'ver-empresa','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(22,'update-empresa','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(23,'ver-inventario','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(24,'crear-inventario','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(25,'ver-marca','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(26,'crear-marca','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(27,'editar-marca','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(28,'eliminar-marca','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(29,'ver-movimiento','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(30,'crear-movimiento','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(31,'ver-presentacione','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(32,'crear-presentacione','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(33,'editar-presentacione','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(34,'eliminar-presentacione','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(35,'ver-producto','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(36,'crear-producto','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(37,'editar-producto','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(38,'ver-perfil','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(39,'editar-perfil','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(40,'ver-proveedore','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(41,'crear-proveedore','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(42,'editar-proveedore','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(43,'eliminar-proveedore','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(44,'ver-venta','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(45,'crear-venta','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(46,'mostrar-venta','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(47,'ver-role','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(48,'crear-role','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(49,'editar-role','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(50,'eliminar-role','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(51,'ver-user','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(52,'crear-user','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(53,'editar-user','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(54,'eliminar-user','web','2025-05-13 00:57:56','2025-05-13 00:57:56');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personas`
--

DROP TABLE IF EXISTS `personas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `razon_social` varchar(255) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `tipo` enum('NATURAL','JURIDICA') NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1,
  `documento_id` bigint(20) unsigned NOT NULL,
  `numero_documento` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `personas_documento_id_foreign` (`documento_id`),
  CONSTRAINT `personas_documento_id_foreign` FOREIGN KEY (`documento_id`) REFERENCES `documentos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personas`
--

LOCK TABLES `personas` WRITE;
/*!40000 ALTER TABLE `personas` DISABLE KEYS */;
INSERT INTO `personas` VALUES (1,'perez','punta cana',NULL,'NATURAL',NULL,1,1,'8866332255','2025-05-13 01:19:43','2025-05-13 01:19:43'),(2,'PERSONAL','punta cana',NULL,'NATURAL',NULL,1,3,'11111111','2025-05-13 01:19:58','2025-05-13 01:19:58'),(3,'PEDRO SUPLID','101 4TA ESQ, RAMON RODRIGUEZ, URB, ANTIGUA',NULL,'NATURAL',NULL,1,3,'88663355','2025-05-13 01:20:45','2025-05-13 01:20:45');
/*!40000 ALTER TABLE `personas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `presentaciones`
--

DROP TABLE IF EXISTS `presentaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `presentaciones` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `caracteristica_id` bigint(20) unsigned NOT NULL,
  `sigla` varchar(5) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `presentaciones_caracteristica_id_unique` (`caracteristica_id`),
  CONSTRAINT `presentaciones_caracteristica_id_foreign` FOREIGN KEY (`caracteristica_id`) REFERENCES `caracteristicas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `presentaciones`
--

LOCK TABLES `presentaciones` WRITE;
/*!40000 ALTER TABLE `presentaciones` DISABLE KEYS */;
INSERT INTO `presentaciones` VALUES (1,2,'CJ','2025-05-13 01:13:50','2025-05-13 01:13:50'),(2,3,'UND','2025-05-13 01:14:12','2025-05-13 01:14:12');
/*!40000 ALTER TABLE `presentaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto_venta`
--

DROP TABLE IF EXISTS `producto_venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producto_venta` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `venta_id` bigint(20) unsigned NOT NULL,
  `producto_id` bigint(20) unsigned NOT NULL,
  `cantidad` int(10) unsigned NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `producto_venta_venta_id_foreign` (`venta_id`),
  KEY `producto_venta_producto_id_foreign` (`producto_id`),
  CONSTRAINT `producto_venta_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `producto_venta_venta_id_foreign` FOREIGN KEY (`venta_id`) REFERENCES `ventas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto_venta`
--

LOCK TABLES `producto_venta` WRITE;
/*!40000 ALTER TABLE `producto_venta` DISABLE KEYS */;
INSERT INTO `producto_venta` VALUES (1,1,1,1,46541.17,'2025-05-13 23:07:52','2025-05-13 23:07:52'),(2,2,1,5,46541.17,'2025-05-18 15:33:08','2025-05-18 15:33:08');
/*!40000 ALTER TABLE `producto_venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `img_path` varchar(2048) DEFAULT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 0,
  `precio` decimal(8,2) DEFAULT NULL,
  `marca_id` bigint(20) unsigned DEFAULT NULL,
  `presentacione_id` bigint(20) unsigned NOT NULL,
  `categoria_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `productos_codigo_unique` (`codigo`),
  KEY `productos_marca_id_foreign` (`marca_id`),
  KEY `productos_presentacione_id_foreign` (`presentacione_id`),
  KEY `productos_categoria_id_foreign` (`categoria_id`),
  CONSTRAINT `productos_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE,
  CONSTRAINT `productos_marca_id_foreign` FOREIGN KEY (`marca_id`) REFERENCES `marcas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `productos_presentacione_id_foreign` FOREIGN KEY (`presentacione_id`) REFERENCES `presentaciones` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,'5243987046','SAMSUNG GALAXY S25 ULTRA','TELEFONO SAMSUNG','/storage/productos/6822abca04bb6.jpeg',1,46541.17,2,2,1,'2025-05-13 01:17:47','2025-05-13 13:50:37');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proveedores` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `persona_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `proveedores_persona_id_unique` (`persona_id`),
  CONSTRAINT `proveedores_persona_id_foreign` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedores`
--

LOCK TABLES `proveedores` WRITE;
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
INSERT INTO `proveedores` VALUES (1,3,'2025-05-13 01:20:45','2025-05-13 01:20:45');
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(1,4),(2,1),(2,4),(3,1),(3,4),(4,1),(4,4),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),(26,1),(27,1),(28,1),(29,1),(30,1),(31,1),(32,1),(33,1),(34,1),(35,1),(36,1),(37,1),(38,1),(39,1),(40,1),(41,1),(42,1),(43,1),(44,1),(45,1),(46,1),(47,1),(48,1),(49,1),(50,1),(51,1),(52,1),(53,1),(54,1);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'administrador','web','2025-05-13 00:57:56','2025-05-13 00:57:56'),(4,'CAJA','web','2025-05-15 21:57:21','2025-05-15 21:58:29');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ubicaciones`
--

DROP TABLE IF EXISTS `ubicaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ubicaciones` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ubicaciones`
--

LOCK TABLES `ubicaciones` WRITE;
/*!40000 ALTER TABLE `ubicaciones` DISABLE KEYS */;
INSERT INTO `ubicaciones` VALUES (1,'Estante 1',NULL,NULL),(2,'Estante 2',NULL,NULL),(3,'Estante 3',NULL,NULL),(4,'Estante 4',NULL,NULL),(5,'Estante 5',NULL,NULL),(6,'Estante 6',NULL,NULL),(7,'Estante 7',NULL,NULL),(8,'Estante 8',NULL,NULL),(9,'Estante 9',NULL,NULL),(10,'Estante 10','2025-06-05 18:48:43','2025-06-05 18:48:43');
/*!40000 ALTER TABLE `ubicaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `empleado_id` bigint(20) unsigned DEFAULT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_empleado_id_unique` (`empleado_id`),
  CONSTRAINT `users_empleado_id_foreign` FOREIGN KEY (`empleado_id`) REFERENCES `empleados` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'pedro urena cruz','admin@gmail.com',NULL,'$2y$10$tHgE3ZpotlmLAf9hU3GKDO6Nb5cqExHW0f8sFU00oNHqV3gDr7T16',NULL,NULL,1,'2025-05-13 00:57:56','2025-05-13 01:12:48'),(4,'Darlin Bonilla','darlin@gmail.com',NULL,'$2y$10$GEm3GaPT1bWdyw/8DhNsbODK5yIa0mL0WTTsOJ85WNAu8LtVX6Nou',NULL,21,1,'2025-05-17 12:26:51','2025-05-17 13:48:03'),(5,'Personal de ejemplo','personal@gmail.com',NULL,'$2y$10$.dxbcJsvfC4XvN2GdDY1NuD8UOT.P6QuQL35mlwrXoEmvFmRAqQ22',NULL,22,0,'2025-05-17 13:48:47','2025-05-17 13:52:41');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ventas`
--

DROP TABLE IF EXISTS `ventas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ventas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cliente_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `caja_id` bigint(20) unsigned NOT NULL,
  `comprobante_id` bigint(20) unsigned NOT NULL,
  `numero_comprobante` varchar(255) NOT NULL,
  `metodo_pago` enum('EFECTIVO','TARJETA') NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `subtotal` decimal(8,2) NOT NULL,
  `impuesto` decimal(8,2) NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `monto_recibido` decimal(8,2) NOT NULL,
  `vuelto_entregado` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ventas_numero_comprobante_unique` (`numero_comprobante`),
  KEY `ventas_cliente_id_foreign` (`cliente_id`),
  KEY `ventas_user_id_foreign` (`user_id`),
  KEY `ventas_comprobante_id_foreign` (`comprobante_id`),
  KEY `ventas_caja_id_foreign` (`caja_id`),
  CONSTRAINT `ventas_caja_id_foreign` FOREIGN KEY (`caja_id`) REFERENCES `cajas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ventas_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ventas_comprobante_id_foreign` FOREIGN KEY (`comprobante_id`) REFERENCES `comprobantes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ventas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventas`
--

LOCK TABLES `ventas` WRITE;
/*!40000 ALTER TABLE `ventas` DISABLE KEYS */;
INSERT INTO `ventas` VALUES (1,1,1,3,1,'C003 - 0000001','EFECTIVO','2025-05-13 19:07:52',46541.17,8377.41,54918.58,55000.00,81.42,'2025-05-13 23:07:52','2025-05-13 23:07:52'),(2,1,1,4,2,'F004 - 0000001','EFECTIVO','2025-05-18 11:33:08',232705.85,41887.05,274592.90,275000.00,407.10,'2025-05-18 15:33:08','2025-05-18 15:33:08');
/*!40000 ALTER TABLE `ventas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-05 17:06:11

-- MySQL dump 10.13  Distrib 5.7.31, for Linux (x86_64)
--
-- Host: localhost    Database: db_oliveira
-- ------------------------------------------------------
-- Server version	5.7.31-0ubuntu0.18.04.1

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
-- Table structure for table `conversao_taxas`
--

DROP TABLE IF EXISTS `conversao_taxas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conversao_taxas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` bigint(20) unsigned NOT NULL,
  `valor_minimo` double(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Valor minimo para taxa.',
  `valor_maximo` double(10,2) NOT NULL DEFAULT '0.00',
  `porcentagem` double(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Porcentagem da taxa.',
  `ativo` enum('S','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'S' COMMENT 'Seta se está ativo ou não.',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `conversao_taxas_empresa_id_foreign` (`empresa_id`),
  CONSTRAINT `conversao_taxas_empresa_id_foreign` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conversao_taxas`
--

LOCK TABLES `conversao_taxas` WRITE;
/*!40000 ALTER TABLE `conversao_taxas` DISABLE KEYS */;
INSERT INTO `conversao_taxas` VALUES (1,1,1.00,2999.00,1.00,'S','2022-01-31 22:04:16','2022-02-03 04:27:50'),(2,1,3000.01,99999999.99,2.00,'S','2022-01-31 22:04:16','2022-01-31 22:04:16');
/*!40000 ALTER TABLE `conversao_taxas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conversoes_moedas`
--

DROP TABLE IF EXISTS `conversoes_moedas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conversoes_moedas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `valor_conversao` double(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Valor a ser convertido.',
  `moeda_origem` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'BRL' COMMENT 'Moeda de origem.',
  `moeda_destino` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Moeda de destino.',
  `valor_moeda_destino` double(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Valor da moeda de destino.',
  `valor_comprado_moeda_destino` double(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Valor comprado da moeda de destino.',
  `forma_pagamento` enum('B','C') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'B - Boleto , C - Cartão de crédito.',
  `taxa_pagamento` double(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Taxa de pagamento, de acordo com a forma de pagamento.',
  `taxa_conversao` double(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Taxa de conversao.',
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_enviado` enum('S','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'Seta se email foi enviado ou não.',
  `valor_final_conversao` double(10,2) NOT NULL DEFAULT '0.00' COMMENT 'valor final da conversao com descontos.',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `conversoes_moedas_empresa_id_foreign` (`empresa_id`),
  KEY `conversoes_moedas_user_id_foreign` (`user_id`),
  CONSTRAINT `conversoes_moedas_empresa_id_foreign` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `conversoes_moedas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conversoes_moedas`
--

LOCK TABLES `conversoes_moedas` WRITE;
/*!40000 ALTER TABLE `conversoes_moedas` DISABLE KEYS */;
INSERT INTO `conversoes_moedas` VALUES (1,1,1,1000.00,'BRL','USD',5.28,173.05,'C',76.30,10.00,'pedro.phnb@gmail.com','N',913.70,'2022-02-03 23:44:15','2022-02-03 23:44:15'),(2,1,1,10000.00,'BRL','USD',5.28,1.71,'C',763.00,200.00,'leeogvieira@gmail.com','N',9037.00,'2022-02-04 00:46:03','2022-02-04 00:46:03'),(3,1,1,50000.00,'BRL','USD',5.28,9.14,'B',725.00,1000.00,'joao@gmail.com','N',48275.00,'2022-02-04 00:52:16','2022-02-04 00:52:16'),(4,1,1,50000.00,'BRL','USD',5.28,9143.00,'B',725.00,1000.00,'pedro.phnb@gmail.com','N',48275.00,'2022-02-04 01:02:34','2022-02-04 01:02:34'),(5,1,1,50000.00,'BRL','EUR',6.05,7469.00,'C',3815.00,1000.00,'ruga@ruga.com','N',45185.00,'2022-02-04 01:02:55','2022-02-04 01:02:55');
/*!40000 ALTER TABLE `conversoes_moedas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresa_planos`
--

DROP TABLE IF EXISTS `empresa_planos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresa_planos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` bigint(20) unsigned NOT NULL,
  `loja_id` bigint(20) unsigned NOT NULL,
  `valor` double(8,2) DEFAULT NULL COMMENT 'Valor pago.',
  `acrescimo` double(8,2) DEFAULT NULL COMMENT 'Acrescimo de algum valor.',
  `desconto` double(8,2) DEFAULT NULL COMMENT 'Desconto de algum valor.',
  `valor_total` double(8,2) DEFAULT NULL COMMENT 'Valor total.',
  `data_email_vencimento` date DEFAULT NULL COMMENT 'data que enviou email de vencimento.',
  `data_email_reenvio_boleto` date DEFAULT NULL COMMENT 'data que reenviou email de vencimento.',
  `data_vencimento` date DEFAULT NULL COMMENT 'data de vencimento.',
  `pago_em` date DEFAULT NULL COMMENT 'data que pagou o boleto.',
  `atual` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT 'Seta se eh o plano atual.',
  `baixado_por` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Quem baixou o pagamento.',
  `ativo` enum('S','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'S' COMMENT 'Seta se esta ativo ou não.',
  `user_id` bigint(20) unsigned NOT NULL,
  `nome_usuario` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Nome do usuario.',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `empresa_planos_empresa_id_foreign` (`empresa_id`),
  KEY `empresa_planos_loja_id_foreign` (`loja_id`),
  KEY `empresa_planos_user_id_foreign` (`user_id`),
  CONSTRAINT `empresa_planos_empresa_id_foreign` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `empresa_planos_loja_id_foreign` FOREIGN KEY (`loja_id`) REFERENCES `lojas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `empresa_planos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresa_planos`
--

LOCK TABLES `empresa_planos` WRITE;
/*!40000 ALTER TABLE `empresa_planos` DISABLE KEYS */;
INSERT INTO `empresa_planos` VALUES (1,1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,'S',1,'Pedro Henrique Novaes Braga','2022-01-31 22:04:17','2022-01-31 22:04:17');
/*!40000 ALTER TABLE `empresa_planos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresas`
--

DROP TABLE IF EXISTS `empresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_admin_id` bigint(20) unsigned DEFAULT NULL,
  `tipo_pessoa` enum('PJ','PF') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PJ' COMMENT 'Seta se pessoa fisica ou juridica.',
  `razao_social` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Razão social.',
  `nome_fantasia` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Nome fantasia.',
  `cpf_cnpj` varchar(18) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'CPF ou CNPJ.',
  `cep` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'cep da empresa.',
  `logradouro` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'logradouro da empresa.',
  `numero` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'numero da empresa.',
  `complemento` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'complemento da empresa.',
  `bairro` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'bairro da empresa.',
  `nome_cidade` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'nome_cidade da empresa.',
  `codigo_cidade` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'codigo_cidade da empresa.',
  `estado` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'estado da empresa.',
  `codigo_siafi` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT ' codigo estado da empresa.',
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'email.',
  `telefone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'telefone.',
  `celular` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'celular.',
  `ativou_em` date DEFAULT NULL COMMENT 'data que foi ativado o plano.',
  `tipo` enum('A','T','C') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'T' COMMENT 'A - Admin, T -  Tipster, C -Cliente do tipster.',
  `ativo` enum('S','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'S' COMMENT 'Seta se esta ativo ou não.',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `empresas_empresa_admin_id_foreign` (`empresa_admin_id`),
  CONSTRAINT `empresas_empresa_admin_id_foreign` FOREIGN KEY (`empresa_admin_id`) REFERENCES `empresas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresas`
--

LOCK TABLES `empresas` WRITE;
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
INSERT INTO `empresas` VALUES (1,NULL,'PJ','Oliveira Trust',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1111111111','11111111112',NULL,'T','S','2022-01-31 22:04:16','2022-01-31 22:04:16');
/*!40000 ALTER TABLE `empresas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forma_pagamento_taxas`
--

DROP TABLE IF EXISTS `forma_pagamento_taxas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forma_pagamento_taxas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` bigint(20) unsigned NOT NULL,
  `tipo` enum('B','C') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'B - Boleto , C - Cartão de crédito.',
  `porcentagem` double(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Porcentagem da taxa.',
  `ativo` enum('S','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'S' COMMENT 'Seta se está ativo ou não.',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `forma_pagamento_taxas_tipo_unique` (`tipo`),
  KEY `forma_pagamento_taxas_empresa_id_foreign` (`empresa_id`),
  CONSTRAINT `forma_pagamento_taxas_empresa_id_foreign` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forma_pagamento_taxas`
--

LOCK TABLES `forma_pagamento_taxas` WRITE;
/*!40000 ALTER TABLE `forma_pagamento_taxas` DISABLE KEYS */;
INSERT INTO `forma_pagamento_taxas` VALUES (1,1,'B',1.45,'S','2022-01-31 22:04:16','2022-02-03 03:20:23'),(2,1,'C',7.63,'S','2022-01-31 22:04:16','2022-02-03 03:21:28');
/*!40000 ALTER TABLE `forma_pagamento_taxas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lojas`
--

DROP TABLE IF EXISTS `lojas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lojas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` bigint(20) unsigned NOT NULL,
  `nome` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nome da Loja.',
  `matriz` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT 'Identifica se é matriz ou filial.',
  `tipo_pessoa` enum('PJ','PF') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PJ' COMMENT 'Seta se pessoa fisica ou juridica.',
  `razao_social` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Razão social.',
  `nome_fantasia` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nome fantasia.',
  `cpf_cnpj` varchar(18) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'CPF ou CNPJ.',
  `inscricao_estadual` varchar(18) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Inscrição estadual.',
  `isenta_ins_est` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT 'Identifica se insento de inscricao estadual.',
  `inscricao_municipal` varchar(18) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Inscrição municipal.',
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'email.',
  `telefone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'telefone.',
  `celular` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'celular.',
  `cep` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'cep da loja.',
  `logradouro` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'logradouro da loja.',
  `numero` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'numero da loja.',
  `complemento` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'complemento da loja.',
  `bairro` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'bairro da loja.',
  `nome_cidade` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'nome_cidade da loja.',
  `codigo_cidade` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'codigo_cidade da loja.',
  `estado` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'estado da loja.',
  `timezone` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'America/Sao_Paulo' COMMENT 'Time zone da loja.',
  `ativo` enum('S','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'S' COMMENT 'Seta se esta ativo ou não.',
  `user_id` bigint(20) unsigned NOT NULL,
  `nome_usuario` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Nome do usuario.',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lojas_empresa_id_foreign` (`empresa_id`),
  KEY `lojas_user_id_foreign` (`user_id`),
  CONSTRAINT `lojas_empresa_id_foreign` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lojas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lojas`
--

LOCK TABLES `lojas` WRITE;
/*!40000 ALTER TABLE `lojas` DISABLE KEYS */;
INSERT INTO `lojas` VALUES (1,1,'Oliveira Trust','1','PJ','Oliveira Trust','Oliveira Trust',NULL,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'America/Sao_Paulo','S',1,'Pedro Henrique Novaes Braga','2022-01-31 22:04:17','2022-01-31 22:04:17');
/*!40000 ALTER TABLE `lojas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2020_05_11_202011_create_empresas_table',1),(2,'2020_05_11_202018_create_users_table',1),(3,'2020_05_11_202035_create_lojas_table',1),(4,'2020_05_11_202042_create_empresa_planos_table',1),(5,'2021_04_25_110820_adds_api_token_to_users_table',1),(6,'2021_04_26_175408_adds_is_api_to_users_table',1),(7,'2022_01_31_231313_create_conversoes_table',2),(8,'2022_02_01_080050_create_taxa_forma_pagamento_taxas__table',2),(9,'2022_02_01_080124_create_taxa_conversao_taxas__table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` bigint(20) unsigned NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpf` varchar(18) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'CPF',
  `valor_unidade_bet_365` double(10,2) NOT NULL DEFAULT '0.00' COMMENT 'valor da unidade do bet365 do cliente.',
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verificado_em` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` enum('A','T','C') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'T' COMMENT 'A - Admin, T -  Tipster, C -Cliente do tipster.',
  `ativo` enum('S','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'S' COMMENT 'Seta se esta ativo ou não.',
  `foto` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Foto ',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_token` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permissao_api` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_api_token_unique` (`api_token`),
  KEY `users_empresa_id_foreign` (`empresa_id`),
  CONSTRAINT `users_empresa_id_foreign` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'Pedro Henrique Novaes Braga','pedro.phnb@gmail.com',NULL,0.00,NULL,NULL,1,'$2y$10$nuyXdRJMiy.kZdRz.JhME.MPbZ8o.buAkv7HUp53hWDh/NlUdE0uy','T','S','/upload/1/avatar/1/avatar_31_01_2022_07_04_53_1_1.png',NULL,NULL,NULL,'2022-01-31 22:04:17','2022-01-31 22:04:53');
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

-- Dump completed on 2022-02-03 22:32:27

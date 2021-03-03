/*
SQLyog Ultimate v10.42 
MySQL - 5.5.5-10.4.17-MariaDB : Database - desafio
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `carrinho` */

DROP TABLE IF EXISTS `carrinho`;

CREATE TABLE `carrinho` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `carrinho` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `pedido_produto` */

DROP TABLE IF EXISTS `pedido_produto`;

CREATE TABLE `pedido_produto` (
  `id_pedido` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) DEFAULT NULL,
  KEY `fk_order` (`id_pedido`),
  KEY `fk_product` (`id_produto`),
  CONSTRAINT `fk_order` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_product` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `pedido_produto` */

insert  into `pedido_produto`(`id_pedido`,`id_produto`,`quantidade`) values (9,4,1),(9,5,1),(10,4,1);

/*Table structure for table `pedidos` */

DROP TABLE IF EXISTS `pedidos`;

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` bigint(11) DEFAULT NULL,
  `data` datetime NOT NULL,
  `id_status` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_status` (`id_status`),
  CONSTRAINT `fk_status` FOREIGN KEY (`id_status`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `pedidos` */

insert  into `pedidos`(`id`,`id_cliente`,`data`,`id_status`,`updated_at`) values (9,2,'2021-03-02 18:42:30',2,'2021-03-02 22:39:26'),(10,2,'2021-03-02 18:45:40',3,'2021-03-02 19:24:49');

/*Table structure for table `produtos` */

DROP TABLE IF EXISTS `produtos`;

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(155) COLLATE utf8_unicode_ci NOT NULL,
  `preco` float DEFAULT NULL,
  `imagem` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descricao` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `ativo` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `produtos` */

insert  into `produtos`(`id`,`nome`,`preco`,`imagem`,`descricao`,`ativo`,`updated_at`) values (4,'Playstation 5 Versão completa',4700,'img/produtos/IlxoJUdUPtBQJjECqme7oCdNXpRzqjzA4MTINPj1.jpg','Versão com midia fisica',1,'2021-03-03 01:29:34'),(5,'Xbox Series X',5000,'img/produtos/zNyY5nOgPd2vyYQWUJ0vDtIWTk8yyzC3UWRCU90h.png','Novo',1,'2021-03-03 01:29:36');

/*Table structure for table `status` */

DROP TABLE IF EXISTS `status`;

CREATE TABLE `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `status` */

insert  into `status`(`id`,`status`) values (1,'Em Aberto'),(2,'Pago'),(3,'Cancelado');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `perfil` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`,`perfil`,`active`) values (2,'Volnei','prado.volnei@gmail.com',NULL,'$2y$10$YTS1aD7JlHkDscC2gYI7aufTi415658vdtbxRG0X0oxFOEq8J18ie',NULL,'2021-02-25 23:39:28','2021-02-25 23:39:28',1,NULL),(5,'Luiz','volneifjv@gmail.com',NULL,'$2y$10$W.i3rgknEJek6YasFlPCy.r5shBY0jJfAIh0aPqIxz6.dKpq7SeQS',NULL,'2021-02-26 00:30:15','2021-03-02 22:58:57',NULL,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

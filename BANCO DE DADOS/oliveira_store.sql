/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 100411
Source Host           : localhost:3306
Source Database       : oliveira_store

Target Server Type    : MYSQL
Target Server Version : 100411
File Encoding         : 65001

Date: 2020-09-22 15:18:07
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2017_01_29_210252_create_produtos_table', '1');
INSERT INTO `migrations` VALUES ('4', '2017_01_29_210306_create_cupom_descontos_table', '1');
INSERT INTO `migrations` VALUES ('5', '2017_01_30_234710_create_pedidos_table', '1');
INSERT INTO `migrations` VALUES ('6', '2017_01_30_235200_create_pedido_produtos_table', '1');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for pedidos
-- ----------------------------
DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE `pedidos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `status` enum('RE','PA','CA') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pedidos_user_id_foreign` (`user_id`),
  CONSTRAINT `pedidos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of pedidos
-- ----------------------------
INSERT INTO `pedidos` VALUES ('1', '1', 'PA', '2020-09-22 16:35:56', '2020-09-22 16:36:13');
INSERT INTO `pedidos` VALUES ('2', '1', 'PA', '2020-09-22 16:36:39', '2020-09-22 16:37:11');
INSERT INTO `pedidos` VALUES ('3', '1', 'CA', '2020-09-22 16:38:03', '2020-09-22 16:38:09');
INSERT INTO `pedidos` VALUES ('4', '1', 'PA', '2020-09-22 16:38:27', '2020-09-22 16:38:51');
INSERT INTO `pedidos` VALUES ('5', '1', 'RE', '2020-09-22 16:39:08', '2020-09-22 16:39:08');

-- ----------------------------
-- Table structure for pedido_produtos
-- ----------------------------
DROP TABLE IF EXISTS `pedido_produtos`;
CREATE TABLE `pedido_produtos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pedido_id` int(10) unsigned NOT NULL,
  `produto_id` int(10) unsigned NOT NULL,
  `status` enum('RE','PA','CA') COLLATE utf8_unicode_ci NOT NULL,
  `valor` decimal(6,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pedido_produtos_pedido_id_foreign` (`pedido_id`),
  KEY `pedido_produtos_produto_id_foreign` (`produto_id`),
  CONSTRAINT `pedido_produtos_pedido_id_foreign` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
  CONSTRAINT `pedido_produtos_produto_id_foreign` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of pedido_produtos
-- ----------------------------
INSERT INTO `pedido_produtos` VALUES ('1', '1', '1', 'PA', '20.96', '2020-09-22 16:35:56', '2020-09-22 16:36:13');
INSERT INTO `pedido_produtos` VALUES ('2', '1', '1', 'PA', '20.96', '2020-09-22 16:35:58', '2020-09-22 16:36:13');
INSERT INTO `pedido_produtos` VALUES ('3', '1', '5', 'PA', '19.73', '2020-09-22 16:36:03', '2020-09-22 16:36:13');
INSERT INTO `pedido_produtos` VALUES ('4', '1', '5', 'PA', '19.73', '2020-09-22 16:36:05', '2020-09-22 16:36:13');
INSERT INTO `pedido_produtos` VALUES ('5', '1', '5', 'PA', '19.73', '2020-09-22 16:36:06', '2020-09-22 16:36:13');
INSERT INTO `pedido_produtos` VALUES ('6', '1', '9', 'PA', '41.58', '2020-09-22 16:36:11', '2020-09-22 16:36:13');
INSERT INTO `pedido_produtos` VALUES ('7', '2', '2', 'PA', '21.27', '2020-09-22 16:36:39', '2020-09-22 16:37:11');
INSERT INTO `pedido_produtos` VALUES ('8', '2', '2', 'PA', '21.27', '2020-09-22 16:36:41', '2020-09-22 16:37:11');
INSERT INTO `pedido_produtos` VALUES ('9', '2', '2', 'PA', '21.27', '2020-09-22 16:36:41', '2020-09-22 16:37:11');
INSERT INTO `pedido_produtos` VALUES ('10', '2', '2', 'PA', '21.27', '2020-09-22 16:36:41', '2020-09-22 16:37:11');
INSERT INTO `pedido_produtos` VALUES ('11', '2', '2', 'CA', '21.27', '2020-09-22 16:36:42', '2020-09-22 16:37:34');
INSERT INTO `pedido_produtos` VALUES ('12', '2', '4', 'CA', '22.84', '2020-09-22 16:36:46', '2020-09-22 16:37:34');
INSERT INTO `pedido_produtos` VALUES ('13', '2', '4', 'CA', '22.84', '2020-09-22 16:36:48', '2020-09-22 16:37:34');
INSERT INTO `pedido_produtos` VALUES ('14', '2', '6', 'CA', '50.36', '2020-09-22 16:37:04', '2020-09-22 16:37:34');
INSERT INTO `pedido_produtos` VALUES ('15', '3', '8', 'CA', '28.39', '2020-09-22 16:38:03', '2020-09-22 16:38:09');
INSERT INTO `pedido_produtos` VALUES ('16', '4', '3', 'CA', '57.56', '2020-09-22 16:38:27', '2020-09-22 16:40:10');
INSERT INTO `pedido_produtos` VALUES ('17', '4', '3', 'CA', '57.56', '2020-09-22 16:38:29', '2020-09-22 16:40:10');
INSERT INTO `pedido_produtos` VALUES ('18', '4', '3', 'CA', '57.56', '2020-09-22 16:38:30', '2020-09-22 16:40:10');
INSERT INTO `pedido_produtos` VALUES ('19', '4', '7', 'PA', '20.36', '2020-09-22 16:38:40', '2020-09-22 16:38:51');
INSERT INTO `pedido_produtos` VALUES ('20', '4', '12', 'PA', '15.46', '2020-09-22 16:38:44', '2020-09-22 16:38:51');
INSERT INTO `pedido_produtos` VALUES ('21', '4', '10', 'PA', '89.59', '2020-09-22 16:38:49', '2020-09-22 16:38:51');
INSERT INTO `pedido_produtos` VALUES ('22', '5', '6', 'RE', '50.36', '2020-09-22 16:39:08', '2020-09-22 16:39:08');
INSERT INTO `pedido_produtos` VALUES ('23', '5', '5', 'RE', '19.73', '2020-09-22 16:39:46', '2020-09-22 16:39:46');

-- ----------------------------
-- Table structure for produtos
-- ----------------------------
DROP TABLE IF EXISTS `produtos`;
CREATE TABLE `produtos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8_unicode_ci NOT NULL,
  `valor` decimal(6,2) NOT NULL DEFAULT 0.00,
  `ativo` enum('S','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'S',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of produtos
-- ----------------------------
INSERT INTO `produtos` VALUES ('1', 'PETR4', '<p><span style=\"font-family: \'Open Sans\', Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vel ornare neque, in egestas magna. In in egestas lectus. Morbi mollis ultricies imperdiet. Phasellus efficitur metus leo, et rhoncus lacus tincidunt vel. Nam turpis eros, faucibus sit amet auctor sed, elementum non augue. Nam bibendum eleifend faucibus. Curabitur in elit non libero auctor consequat. Sed hendrerit ultricies mi, sit amet dictum turpis pellentesque et.</span></p>', '20.96', 'S', '2020-09-22 16:25:51', '2020-09-22 16:27:47');
INSERT INTO `produtos` VALUES ('2', 'PETR3', '<p><span style=\"font-family: \'Open Sans\', Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vel ornare neque, in egestas magna. In in egestas lectus. Morbi mollis ultricies imperdiet. Phasellus efficitur metus leo, et rhoncus lacus tincidunt vel. Nam turpis eros, faucibus sit amet auctor sed, elementum non augue. Nam bibendum eleifend faucibus. Curabitur in elit non libero auctor consequat. Sed hendrerit ultricies mi, sit amet dictum turpis pellentesque et.</span></p>', '21.27', 'S', '2020-09-22 16:28:31', '2020-09-22 16:28:31');
INSERT INTO `produtos` VALUES ('3', 'VALE3', '<p><span style=\"color: rgba(0, 0, 0, 0.87); font-family: \'Open Sans\', Arial, sans-serif; font-size: 15px; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vel ornare neque, in egestas magna. In in egestas lectus. Morbi mollis ultricies imperdiet. Phasellus efficitur metus leo, et rhoncus lacus tincidunt vel. Nam turpis eros, faucibus sit amet auctor sed, elementum non augue. Nam bibendum eleifend faucibus. Curabitur in elit non libero auctor consequat. Sed hendrerit ultricies mi, sit amet dictum turpis pellentesque et.</span></p>', '57.56', 'S', '2020-09-22 16:29:39', '2020-09-22 16:29:39');
INSERT INTO `produtos` VALUES ('4', 'ITUB4', '<p><span style=\"font-family: \'Open Sans\', Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vel ornare neque, in egestas magna. In in egestas lectus. Morbi mollis ultricies imperdiet. Phasellus efficitur metus leo, et rhoncus lacus tincidunt vel. Nam turpis eros, faucibus sit amet auctor sed, elementum non augue. Nam bibendum eleifend faucibus. Curabitur in elit non libero auctor consequat. Sed hendrerit ultricies mi, sit amet dictum turpis pellentesque et.</span></p>', '22.84', 'S', '2020-09-22 16:30:22', '2020-09-22 16:30:22');
INSERT INTO `produtos` VALUES ('5', 'BBDC4', '<p><span style=\"font-family: \'Open Sans\', Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vel ornare neque, in egestas magna. In in egestas lectus. Morbi mollis ultricies imperdiet. Phasellus efficitur metus leo, et rhoncus lacus tincidunt vel. Nam turpis eros, faucibus sit amet auctor sed, elementum non augue. Nam bibendum eleifend faucibus. Curabitur in elit non libero auctor consequat. Sed hendrerit ultricies mi, sit amet dictum turpis pellentesque et.</span></p>', '19.73', 'S', '2020-09-22 16:31:12', '2020-09-22 16:31:12');
INSERT INTO `produtos` VALUES ('6', 'BIDI11', '<p><span style=\"font-family: \'Open Sans\', Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vel ornare neque, in egestas magna. In in egestas lectus. Morbi mollis ultricies imperdiet. Phasellus efficitur metus leo, et rhoncus lacus tincidunt vel. Nam turpis eros, faucibus sit amet auctor sed, elementum non augue. Nam bibendum eleifend faucibus. Curabitur in elit non libero auctor consequat. Sed hendrerit ultricies mi, sit amet dictum turpis pellentesque et.</span></p>', '50.36', 'S', '2020-09-22 16:31:45', '2020-09-22 16:31:45');
INSERT INTO `produtos` VALUES ('7', 'RAIL3', '<p><span style=\"font-family: \'Open Sans\', Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vel ornare neque, in egestas magna. In in egestas lectus. Morbi mollis ultricies imperdiet. Phasellus efficitur metus leo, et rhoncus lacus tincidunt vel. Nam turpis eros, faucibus sit amet auctor sed, elementum non augue. Nam bibendum eleifend faucibus. Curabitur in elit non libero auctor consequat. Sed hendrerit ultricies mi, sit amet dictum turpis pellentesque et.</span></p>', '20.36', 'S', '2020-09-22 16:32:12', '2020-09-22 16:32:12');
INSERT INTO `produtos` VALUES ('8', 'TAEE11', '<p><span style=\"font-family: \'Open Sans\', Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vel ornare neque, in egestas magna. In in egestas lectus. Morbi mollis ultricies imperdiet. Phasellus efficitur metus leo, et rhoncus lacus tincidunt vel. Nam turpis eros, faucibus sit amet auctor sed, elementum non augue. Nam bibendum eleifend faucibus. Curabitur in elit non libero auctor consequat. Sed hendrerit ultricies mi, sit amet dictum turpis pellentesque et.</span></p>', '28.39', 'S', '2020-09-22 16:32:40', '2020-09-22 16:32:40');
INSERT INTO `produtos` VALUES ('9', 'LREN3', '<p><span style=\"font-family: \'Open Sans\', Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vel ornare neque, in egestas magna. In in egestas lectus. Morbi mollis ultricies imperdiet. Phasellus efficitur metus leo, et rhoncus lacus tincidunt vel. Nam turpis eros, faucibus sit amet auctor sed, elementum non augue. Nam bibendum eleifend faucibus. Curabitur in elit non libero auctor consequat. Sed hendrerit ultricies mi, sit amet dictum turpis pellentesque et.</span></p>', '41.58', 'S', '2020-09-22 16:33:12', '2020-09-22 16:33:12');
INSERT INTO `produtos` VALUES ('10', 'MGLU3', '<p><span style=\"font-family: \'Open Sans\', Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vel ornare neque, in egestas magna. In in egestas lectus. Morbi mollis ultricies imperdiet. Phasellus efficitur metus leo, et rhoncus lacus tincidunt vel. Nam turpis eros, faucibus sit amet auctor sed, elementum non augue. Nam bibendum eleifend faucibus. Curabitur in elit non libero auctor consequat. Sed hendrerit ultricies mi, sit amet dictum turpis pellentesque et.</span></p>', '89.59', 'S', '2020-09-22 16:33:40', '2020-09-22 16:33:40');
INSERT INTO `produtos` VALUES ('11', 'VVAR3', '<p><span style=\"font-family: \'Open Sans\', Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vel ornare neque, in egestas magna. In in egestas lectus. Morbi mollis ultricies imperdiet. Phasellus efficitur metus leo, et rhoncus lacus tincidunt vel. Nam turpis eros, faucibus sit amet auctor sed, elementum non augue. Nam bibendum eleifend faucibus. Curabitur in elit non libero auctor consequat. Sed hendrerit ultricies mi, sit amet dictum turpis pellentesque et.</span></p>', '17.63', 'S', '2020-09-22 16:34:12', '2020-09-22 16:34:12');
INSERT INTO `produtos` VALUES ('12', 'GUAR3', '<p><span style=\"font-family: \'Open Sans\', Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vel ornare neque, in egestas magna. In in egestas lectus. Morbi mollis ultricies imperdiet. Phasellus efficitur metus leo, et rhoncus lacus tincidunt vel. Nam turpis eros, faucibus sit amet auctor sed, elementum non augue. Nam bibendum eleifend faucibus. Curabitur in elit non libero auctor consequat. Sed hendrerit ultricies mi, sit amet dictum turpis pellentesque et.</span></p>', '15.46', 'S', '2020-09-22 16:34:50', '2020-09-22 16:34:50');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Oliveira Trust', 'admin@oliveiratrust.com.br', '$2y$10$7147j80H6MQDlz2BevQYIuo4MHLzAxE6abI5jhRzFP8gwL7dqk0y6', 'QJzrobBJRf6vhvAGdyRKSSXb3Iqdb22zREi6oIvherUn2k3BLWdIszrlSQ9V', '2020-09-22 16:00:21', '2020-09-22 16:41:35');
INSERT INTO `users` VALUES ('2', 'Gabriel Pereira Bittencourt Passaes', 'gabriel.bc88@gmail.com', '123456', null, '2020-09-22 16:47:18', '2020-09-22 16:47:18');
INSERT INTO `users` VALUES ('3', 'Felipe Queiroga', 'tenqueiroga@gmail.com', '123456', null, '2020-09-22 16:48:02', '2020-09-22 16:48:02');

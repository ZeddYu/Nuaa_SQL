/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100313
 Source Host           : localhost:3306
 Source Schema         : Bus

 Target Server Type    : MySQL
 Target Server Version : 100313
 File Encoding         : 65001

 Date: 23/06/2019 00:24:08
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for book
-- ----------------------------
DROP TABLE IF EXISTS `book`;
CREATE TABLE `book` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ISBN` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `num` int(5) DEFAULT 0,
  `price` decimal(10,2) DEFAULT NULL,
  `lent` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of book
-- ----------------------------
BEGIN;
INSERT INTO `book` VALUES (2, 'Book2', 'author2', '10087', 4, 108.60, 2);
INSERT INTO `book` VALUES (5, 'Book5', 'author5', '10091', 10, 10.00, 2);
INSERT INTO `book` VALUES (6, 'Book7', 'author7', '10093', 40, 80.00, 0);
COMMIT;

-- ----------------------------
-- Table structure for history_log
-- ----------------------------
DROP TABLE IF EXISTS `history_log`;
CREATE TABLE `history_log` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `book_id` int(5) DEFAULT NULL,
  `user_id` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of history_log
-- ----------------------------
BEGIN;
INSERT INTO `history_log` VALUES (1, 1, 1);
INSERT INTO `history_log` VALUES (2, 2, 2);
INSERT INTO `history_log` VALUES (3, 2, 4);
INSERT INTO `history_log` VALUES (4, 2, 5);
INSERT INTO `history_log` VALUES (5, 1, 5);
INSERT INTO `history_log` VALUES (6, 4, 6);
INSERT INTO `history_log` VALUES (7, 5, 6);
INSERT INTO `history_log` VALUES (8, 5, 8);
INSERT INTO `history_log` VALUES (9, 5, 8);
INSERT INTO `history_log` VALUES (10, 2, 1);
COMMIT;

-- ----------------------------
-- Table structure for log
-- ----------------------------
DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `book_id` int(5) DEFAULT NULL,
  `user_id` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `book_id` (`book_id`),
  CONSTRAINT `book_id` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of log
-- ----------------------------
BEGIN;
INSERT INTO `log` VALUES (13, 5, 8);
INSERT INTO `log` VALUES (14, 2, 1);
COMMIT;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(1) NOT NULL DEFAULT 2,
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
BEGIN;
INSERT INTO `user` VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 'abee3b3bd60707088fddc208bce22885');
INSERT INTO `user` VALUES (4, 'zedd', 'e10adc3949ba59abbe56e057f20f883e', 2, 'abee3b3bd60707088fddc208bce22885');
INSERT INTO `user` VALUES (7, 'abc', 'e10adc3949ba59abbe56e057f20f883e', 2, 'abee3b3bd60707088fddc208bce22885');
INSERT INTO `user` VALUES (8, 'qwerty', 'e10adc3949ba59abbe56e057f20f883e', 2, 'abee3b3bd60707088fddc208bce22885');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;

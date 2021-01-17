/*
 Navicat Premium Data Transfer

 Source Server         : access
 Source Server Type    : MySQL
 Source Server Version : 100408
 Source Host           : localhost:3306
 Source Schema         : nurse_schedule

 Target Server Type    : MySQL
 Target Server Version : 100408
 File Encoding         : 65001

 Date: 16/01/2021 17:26:35
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for nurse_account
-- ----------------------------
DROP TABLE IF EXISTS `nurse_account`;
CREATE TABLE `nurse_account`  (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `last_name` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `phone_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `gender` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created` datetime(0) NOT NULL,
  `verified` tinyint(2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 31 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of nurse_account
-- ----------------------------
INSERT INTO `nurse_account` VALUES (1, 'Ibinabo', 'Bille', 'billeibinabo@gmail.com', '$2y$10$P2n/dgpj/VY0CdM05pJ39ezMsZQwvRy90c3ldvwuS5P8bjXe8UMom', '+2348162530944', 'MALE', '2021-01-10 17:15:55', 1);
INSERT INTO `nurse_account` VALUES (30, 'Ibinabo', 'Bille', 'bille2right@yahoo.com', '$2y$10$e2.T6XEl2npbymPCZmNjAenRdBAx12sgaRPYuEuxSy.DLzsFwrlDO', '+2348162530944', 'FEMALE', '2021-01-12 01:50:51', 1);

-- ----------------------------
-- Table structure for nurse_details
-- ----------------------------
DROP TABLE IF EXISTS `nurse_details`;
CREATE TABLE `nurse_details`  (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `position` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ward` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dob` date NOT NULL,
  `higher_institution` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `start_date` datetime(0) NULL DEFAULT NULL,
  `end_date` datetime(0) NULL DEFAULT NULL,
  `degree_obtained` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `certificate` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `account_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `bank` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `sort_code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `major_field` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `license_letter` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `income` float(20, 2) NULL DEFAULT NULL,
  `nurse_id` int(20) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `nurse_fk`(`nurse_id`) USING BTREE,
  CONSTRAINT `nurse_fk` FOREIGN KEY (`nurse_id`) REFERENCES `nurse_account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of nurse_details
-- ----------------------------
INSERT INTO `nurse_details` VALUES (1, 'Nurse Leader', 'Ward 3', 'billeibinabo@gmail.com.jpg', '1994-09-25', 'University of Port Harcourt', '2013-10-21 12:00:00', '2017-11-14 12:00:00', 'Associate’s degree in nursing (ADN)', 'billeibinabo@gmail.com.pdf', 'Mango Tree Junction, Dutse, Abuja, FCT', '6171966137', 'Union Bank', '2001736', 'Computer Sciemce', 'Advanced practice registered nurse (APRN)', 650000.00, 1);
INSERT INTO `nurse_details` VALUES (22, 'Clinical Nurse Specialist (CNS)', 'Ward 5', 'bille2right@yahoo.com.jpg', '1995-06-19', 'University of Nigeria', '2013-09-24 12:00:00', '2018-10-23 12:00:00', 'Bachelor of science in nursing (BSN)', 'bille2right@yahoo.com.pdf', '7 Noble Drive By Oroekpo', '2209422980', 'First Bank', '201441', 'Nursing Science', 'Registered nurse (RN)', 224000.00, 30);

-- ----------------------------
-- Table structure for nurse_tracker
-- ----------------------------
DROP TABLE IF EXISTS `nurse_tracker`;
CREATE TABLE `nurse_tracker`  (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `leave_type` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `date_from` datetime(0) NULL DEFAULT NULL,
  `date_to` datetime(0) NULL DEFAULT NULL,
  `number_of_days` int(11) NULL DEFAULT NULL,
  `reason` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `nurse_id` int(20) NOT NULL,
  `status` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `approved_by_id` int(20) NULL DEFAULT NULL,
  `year` year NULL DEFAULT NULL,
  `updated` datetime(0) NULL DEFAULT NULL,
  `day_count` int(2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `nurse_primary_key`(`nurse_id`) USING BTREE,
  CONSTRAINT `nurse_primary_key` FOREIGN KEY (`nurse_id`) REFERENCES `nurse_account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of nurse_tracker
-- ----------------------------
INSERT INTO `nurse_tracker` VALUES (1, NULL, NULL, NULL, NULL, NULL, 1, 'ACTIVE', NULL, NULL, NULL, 1);
INSERT INTO `nurse_tracker` VALUES (5, NULL, NULL, NULL, NULL, NULL, 30, 'OFF_DAY', NULL, 2021, NULL, 0);

-- ----------------------------
-- Table structure for nurse_tracker_copy1
-- ----------------------------
DROP TABLE IF EXISTS `nurse_tracker_copy1`;
CREATE TABLE `nurse_tracker_copy1`  (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `leave_type` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_from` datetime(0) NOT NULL,
  `date_to` datetime(0) NOT NULL,
  `number_of_days` int(11) NOT NULL,
  `reason` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nurse_id` int(20) NOT NULL,
  `status` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `approved_by_id` int(20) NOT NULL,
  `year` year NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;

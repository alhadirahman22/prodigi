/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 100130
Source Host           : localhost:3306
Source Database       : ciblog

Target Server Type    : MYSQL
Target Server Version : 100130
File Encoding         : 65001

Date: 2019-01-28 09:16:06
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for master_3_proa
-- ----------------------------
DROP TABLE IF EXISTS `master_3_proa`;
CREATE TABLE `master_3_proa` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Co_singer` varchar(255) DEFAULT NULL,
  `Co_title` varchar(255) DEFAULT NULL,
  `RevenueProdigi` decimal(10,2) DEFAULT NULL,
  `SharePartner` decimal(10,2) DEFAULT NULL,
  `ShareProdigi` decimal(10,2) DEFAULT NULL,
  `RoyaltiArtis` decimal(10,2) DEFAULT NULL,
  `RoyalPencipta` decimal(10,2) DEFAULT NULL,
  `MarketingChanel` decimal(10,2) DEFAULT NULL,
  `Pencipta` varchar(255) DEFAULT NULL,
  `Partner` varchar(255) DEFAULT NULL,
  `Artis` varchar(255) DEFAULT NULL,
  `NmChanel` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of master_3_proa
-- ----------------------------

-- ----------------------------
-- Table structure for proses_3_proa
-- ----------------------------
DROP TABLE IF EXISTS `proses_3_proa`;
CREATE TABLE `proses_3_proa` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Co_singer` varchar(255) DEFAULT NULL,
  `Co_title` varchar(255) DEFAULT NULL,
  `Detail` longtext,
  `Friend` longtext,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of proses_3_proa
-- ----------------------------

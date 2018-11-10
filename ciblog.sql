/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 100128
Source Host           : localhost:3306
Source Database       : ciblog

Target Server Type    : MYSQL
Target Server Version : 100128
File Encoding         : 65001

Date: 2018-11-10 14:01:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for master
-- ----------------------------
DROP TABLE IF EXISTS `master`;
CREATE TABLE `master` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Co_singer` varchar(255) DEFAULT NULL,
  `Co_title` varchar(255) DEFAULT NULL,
  `SharePartner` decimal(3,2) DEFAULT NULL,
  `ShareProdigi` decimal(3,2) DEFAULT NULL,
  `RoyaltiArtis` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of master
-- ----------------------------

-- ----------------------------
-- Table structure for proses
-- ----------------------------
DROP TABLE IF EXISTS `proses`;
CREATE TABLE `proses` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Co_singer` varchar(255) DEFAULT NULL,
  `Co_title` varchar(255) DEFAULT NULL,
  `Detail` longtext,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of proses
-- ----------------------------

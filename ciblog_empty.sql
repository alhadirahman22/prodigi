/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 100130
Source Host           : localhost:3306
Source Database       : ciblog

Target Server Type    : MYSQL
Target Server Version : 100130
File Encoding         : 65001

Date: 2018-12-06 16:21:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for master_isat_proa
-- ----------------------------
DROP TABLE IF EXISTS `master_isat_proa`;
CREATE TABLE `master_isat_proa` (
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
-- Records of master_isat_proa
-- ----------------------------

-- ----------------------------
-- Table structure for master_telkom
-- ----------------------------
DROP TABLE IF EXISTS `master_telkom`;
CREATE TABLE `master_telkom` (
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
-- Records of master_telkom
-- ----------------------------

-- ----------------------------
-- Table structure for master_telkom_proa
-- ----------------------------
DROP TABLE IF EXISTS `master_telkom_proa`;
CREATE TABLE `master_telkom_proa` (
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
-- Records of master_telkom_proa
-- ----------------------------

-- ----------------------------
-- Table structure for master_xl
-- ----------------------------
DROP TABLE IF EXISTS `master_xl`;
CREATE TABLE `master_xl` (
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
-- Records of master_xl
-- ----------------------------

-- ----------------------------
-- Table structure for master_xl_proa
-- ----------------------------
DROP TABLE IF EXISTS `master_xl_proa`;
CREATE TABLE `master_xl_proa` (
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
-- Records of master_xl_proa
-- ----------------------------

-- ----------------------------
-- Table structure for proses_isat_proa
-- ----------------------------
DROP TABLE IF EXISTS `proses_isat_proa`;
CREATE TABLE `proses_isat_proa` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Co_singer` varchar(255) DEFAULT NULL,
  `Co_title` varchar(255) DEFAULT NULL,
  `Detail` longtext,
  `Friend` longtext,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of proses_isat_proa
-- ----------------------------

-- ----------------------------
-- Table structure for proses_telkom
-- ----------------------------
DROP TABLE IF EXISTS `proses_telkom`;
CREATE TABLE `proses_telkom` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Co_singer` varchar(255) DEFAULT NULL,
  `Co_title` varchar(255) DEFAULT NULL,
  `Detail` longtext,
  `Friend` longtext,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of proses_telkom
-- ----------------------------

-- ----------------------------
-- Table structure for proses_telkom_proa
-- ----------------------------
DROP TABLE IF EXISTS `proses_telkom_proa`;
CREATE TABLE `proses_telkom_proa` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Co_singer` varchar(255) DEFAULT NULL,
  `Co_title` varchar(255) DEFAULT NULL,
  `Detail` longtext,
  `Friend` longtext,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of proses_telkom_proa
-- ----------------------------

-- ----------------------------
-- Table structure for proses_xl
-- ----------------------------
DROP TABLE IF EXISTS `proses_xl`;
CREATE TABLE `proses_xl` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Co_singer` varchar(255) DEFAULT NULL,
  `Co_title` varchar(255) DEFAULT NULL,
  `Detail` longtext,
  `Friend` longtext,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of proses_xl
-- ----------------------------

-- ----------------------------
-- Table structure for proses_xl_proa
-- ----------------------------
DROP TABLE IF EXISTS `proses_xl_proa`;
CREATE TABLE `proses_xl_proa` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Co_singer` varchar(255) DEFAULT NULL,
  `Co_title` varchar(255) DEFAULT NULL,
  `Detail` longtext,
  `Friend` longtext,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of proses_xl_proa
-- ----------------------------

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Auth` enum('SuperAdmin','Administrator','Operator','Guest') NOT NULL,
  `Active` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 : Not Active, 1 : Active',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Username` (`Username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', '8843028fefce50a6de50acdf064ded27', 'IT', 'SuperAdmin', '1');
INSERT INTO `user` VALUES ('2', 'adi', '8843028fefce50a6de50acdf064ded27', 'Alhadi', 'SuperAdmin', '1');
INSERT INTO `user` VALUES ('3', 'davit', '8843028fefce50a6de50acdf064ded27', 'Davit Chandra', 'SuperAdmin', '1');

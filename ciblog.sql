/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 100128
Source Host           : localhost:3306
Source Database       : ciblog

Target Server Type    : MYSQL
Target Server Version : 100128
File Encoding         : 65001

Date: 2018-11-10 20:05:12
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
  `SharePartner` decimal(3,2) DEFAULT NULL,
  `ShareProdigi` decimal(3,2) DEFAULT NULL,
  `RoyaltiArtis` decimal(3,2) DEFAULT NULL,
  `RoyalPencipta` decimal(3,2) DEFAULT NULL,
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
  `SharePartner` decimal(3,2) DEFAULT NULL,
  `ShareProdigi` decimal(3,2) DEFAULT NULL,
  `RoyaltiArtis` decimal(3,2) DEFAULT NULL,
  `RoyalPencipta` decimal(3,2) DEFAULT NULL,
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
  `SharePartner` decimal(3,2) DEFAULT NULL,
  `ShareProdigi` decimal(3,2) DEFAULT NULL,
  `RoyaltiArtis` decimal(3,2) DEFAULT NULL,
  `RoyalPencipta` decimal(3,2) DEFAULT NULL,
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
  `SharePartner` decimal(3,2) DEFAULT NULL,
  `ShareProdigi` decimal(3,2) DEFAULT NULL,
  `RoyaltiArtis` decimal(3,2) DEFAULT NULL,
  `RoyalPencipta` decimal(3,2) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of master_xl
-- ----------------------------
INSERT INTO `master_xl` VALUES ('1', 'Kristina', 'ada perlu apa', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('2', 'Kristina', 'aku cantik', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('3', 'Kristina', 'aku jatuh cinta', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('4', 'Kristina', 'aku kangen', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('5', 'Kristina', 'aku kangen kamu', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('6', 'Kristina', 'aku lelah', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('7', 'Kristina', 'aku takut', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('8', 'Kristina', 'AkuMasihSayang', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('9', 'Kristina', 'AkuMencintaimu', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('10', 'Kristina', 'assalamualaikum', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('11', 'Kristina', 'bikin bete', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('12', 'Kristina', 'bikin sakit', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('13', 'Kristina', 'bodo amat', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('14', 'Kristina', 'bosan sama kamu', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('15', 'Kristina', 'buat mantan', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('16', 'Kristina', 'calon imam', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('17', 'Kristina', 'cukup aku', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('18', 'Kristina', 'diajak nikah', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('19', 'Kristina', 'dibohongin lagi', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('20', 'Kristina', 'dibutuhkan pacar', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('21', 'Kristina', 'enak dipelukin', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('22', 'Kristina', 'ga peka', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('23', 'Kristina', 'ganggu banget', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('24', 'Kristina', 'goyangin say', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('25', 'Kristina', 'hai kamu', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('26', 'Kristina', 'hei kamu', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('27', 'Kristina', 'hey kamu', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('28', 'Kristina', 'i love you', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('29', 'Kristina', 'ingat kamu', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('30', 'Kristina', 'ingin bersamamu', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('31', 'Kristina', 'jaga diri', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('32', 'Kristina', 'jalan sama janda', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('33', 'Kristina', 'jangan bohongin aku', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('34', 'Kristina', 'jangan diganggu', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('35', 'Kristina', 'jangan marah', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('36', 'Kristina', 'JanganGanggu', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('37', 'Kristina', 'jatuh cinta', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('38', 'Kristina', 'jujur', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('39', 'Kristina', 'kalo kamu sayang', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('40', 'Kristina', 'kamu', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('41', 'Kristina', 'kamu ganteng', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('42', 'Kristina', 'kamu lucu', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('43', 'Kristina', 'kangen', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('44', 'Kristina', 'kangen sama kamu', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('45', 'Kristina', 'kangennya sama kamu', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('46', 'Kristina', 'kapan putus', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('47', 'Kristina', 'kekasih hati', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('48', 'Kristina', 'keseriusan kamu', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('49', 'Kristina', 'ketemuan yu', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('50', 'Kristina', 'kita saling nyaman', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('51', 'Kristina', 'lagi cape', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('52', 'Kristina', 'lagi galau', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('53', 'Kristina', 'lagi meeting', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('54', 'Kristina', 'laki laki impian', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('55', 'Kristina', 'maaf', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('56', 'Kristina', 'membuka hati', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('57', 'Kristina', 'mimpiin kamu', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('58', 'Kristina', 'minta maaf', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('59', 'Kristina', 'pengen dicium', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('60', 'Kristina', 'rindu', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('61', 'Kristina', 'SalahSambung', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('62', 'Kristina', 'Sayang2an', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('63', 'Kristina', 'SayangDibuktiin', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('64', 'Kristina', 'SedangPelukan', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('65', 'Kristina', 'sedih gue', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('66', 'Kristina', 'selamat datang 2018', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('67', 'Kristina', 'semakin sayang', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('68', 'Kristina', 'semangat ya sayang', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('69', 'Kristina', 'SetelahKamuPergi', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('70', 'Kristina', 'sini peluk', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('71', 'Kristina', 'telfon pacar', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('72', 'Kristina', 'tidur dulu', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('73', 'Kristina', 'tuhan jaga dia', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('74', 'Kristina', 'ungkapin dong', '100.00', '0.00', '0.00', '0.00', '0.40');
INSERT INTO `master_xl` VALUES ('75', 'Neng Euis', 'Cinta Sejati', '100.00', '0.65', '0.00', '0.00', '0.00');
INSERT INTO `master_xl` VALUES ('76', 'Neng Euis', 'Cintaku Untukmu', '100.00', '0.65', '0.00', '0.00', '0.00');
INSERT INTO `master_xl` VALUES ('77', 'Neng Euis', 'Rasanya Hambar', '100.00', '0.65', '0.00', '0.00', '0.00');
INSERT INTO `master_xl` VALUES ('78', 'Neng Euis', 'Tetap Bertahan', '100.00', '0.65', '0.00', '0.00', '0.00');
INSERT INTO `master_xl` VALUES ('79', 'Neng Euis', 'Tolong Jaga Dirinya', '100.00', '0.65', '0.00', '0.00', '0.00');

-- ----------------------------
-- Table structure for master_xl_proa
-- ----------------------------
DROP TABLE IF EXISTS `master_xl_proa`;
CREATE TABLE `master_xl_proa` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Co_singer` varchar(255) DEFAULT NULL,
  `Co_title` varchar(255) DEFAULT NULL,
  `RevenueProdigi` decimal(10,2) DEFAULT NULL,
  `SharePartner` decimal(3,2) DEFAULT NULL,
  `ShareProdigi` decimal(3,2) DEFAULT NULL,
  `RoyaltiArtis` decimal(3,2) DEFAULT NULL,
  `RoyalPencipta` decimal(3,2) DEFAULT NULL,
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
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of proses_xl_proa
-- ----------------------------

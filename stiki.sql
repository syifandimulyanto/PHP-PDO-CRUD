/*
Navicat MySQL Data Transfer

Source Server         : ts
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : stiki

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-11-19 13:56:58
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mhs
-- ----------------------------
DROP TABLE IF EXISTS `mhs`;
CREATE TABLE `mhs` (
  `nrp` varchar(15) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `jk` varchar(1) NOT NULL,
  `aktif` varchar(1) NOT NULL,
  `password` varchar(64) NOT NULL,
  PRIMARY KEY (`nrp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mhs
-- ----------------------------
INSERT INTO `mhs` VALUES ('151116008', 'risky andrianto', 'ISLAM', 'l', '1', '12345');
INSERT INTO `mhs` VALUES ('151116009', 'Syifandi Mulyanto', 'ISLAM 1', 'l', '1', 'nimda12!@');

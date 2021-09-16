/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50726
Source Host           : 127.0.0.1:3306
Source Database       : test.io

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2021-08-16 18:05:58
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for app_ip
-- ----------------------------
DROP TABLE IF EXISTS `app_ip`;
CREATE TABLE `app_ip` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `ip` varchar(130) NOT NULL COMMENT 'IP',
  `ua` varchar(500) NOT NULL COMMENT 'UA',
  `time` datetime NOT NULL COMMENT '访问时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50726
Source Host           : 127.0.0.1:3306
Source Database       : shuadan

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2021-09-16 15:38:36
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sd_link
-- ----------------------------
DROP TABLE IF EXISTS `sd_link`;
CREATE TABLE `sd_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `link` varchar(500) NOT NULL COMMENT '链接',
  `shop_id` int(11) NOT NULL COMMENT '店铺ID',
  `num` int(11) NOT NULL DEFAULT '0' COMMENT '刷单总量',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Table structure for sd_matter
-- ----------------------------
DROP TABLE IF EXISTS `sd_matter`;
CREATE TABLE `sd_matter` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `user_phone` char(13) NOT NULL COMMENT '用户ID',
  `link_id` int(11) NOT NULL COMMENT '链接ID',
  `is_star` tinyint(4) NOT NULL DEFAULT '2' COMMENT '是否五星 1:是 2:不是',
  `number` varchar(500) NOT NULL DEFAULT '0' COMMENT '订单编号',
  `remark` varchar(500) NOT NULL DEFAULT '0' COMMENT '备注',
  `is_pay` tinyint(4) NOT NULL DEFAULT '3' COMMENT '是否打款 1:是 2:不是 3-已分配',
  `shop_id` int(11) NOT NULL COMMENT '店铺ID',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '刷单时间',
  `pay_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '打款时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Table structure for sd_shop
-- ----------------------------
DROP TABLE IF EXISTS `sd_shop`;
CREATE TABLE `sd_shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `shop_name` varchar(500) NOT NULL COMMENT '店铺名',
  `open` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Table structure for sd_user
-- ----------------------------
DROP TABLE IF EXISTS `sd_user`;
CREATE TABLE `sd_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `phone` char(11) NOT NULL COMMENT '手机号',
  `num` int(11) NOT NULL COMMENT '总刷单量',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  `remark` varchar(500) NOT NULL COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

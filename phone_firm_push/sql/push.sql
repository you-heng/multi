/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : test.io

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2022-05-12 15:05:11
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for push_log
-- ----------------------------
DROP TABLE IF EXISTS `push_log`;
CREATE TABLE `push_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(80) COLLATE utf8_unicode_ci NOT NULL COMMENT '标题',
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '内容',
  `regid` varchar(150) COLLATE utf8_unicode_ci NOT NULL COMMENT 'regid',
  `click` tinyint(4) NOT NULL COMMENT '1-打开app首页 2-打开app指定页 3-打开指定网页',
  `url` varchar(150) COLLATE utf8_unicode_ci NOT NULL COMMENT '跳转的链接',
  `scope` tinyint(4) NOT NULL COMMENT '1-单推 2-全量',
  `state` tinyint(4) NOT NULL COMMENT '1-成功 0-失败',
  `firm` varchar(15) COLLATE utf8_unicode_ci NOT NULL COMMENT '厂商',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for push_user
-- ----------------------------
DROP TABLE IF EXISTS `push_user`;
CREATE TABLE `push_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `userid` int(11) NOT NULL COMMENT '用户标识',
  `regid` varchar(150) COLLATE utf8_unicode_ci NOT NULL COMMENT '手机推送标识',
  `firm` varchar(15) COLLATE utf8_unicode_ci NOT NULL COMMENT '厂商',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

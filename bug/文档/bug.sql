/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50726
Source Host           : 127.0.0.1:3306
Source Database       : test.io

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2021-09-16 16:42:51
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for b_bug
-- ----------------------------
DROP TABLE IF EXISTS `b_bug`;
CREATE TABLE `b_bug` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bug_title` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `put_id` int(11) DEFAULT NULL,
  `solve_id` int(11) DEFAULT NULL,
  `bug_desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_role` tinyint(4) DEFAULT NULL,
  `is_state` tinyint(4) DEFAULT NULL,
  `bug_img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_type` tinyint(4) DEFAULT NULL,
  `system` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `system_ver` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_weight` tinyint(4) DEFAULT NULL,
  `is_priority` tinyint(4) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for b_bug_log
-- ----------------------------
DROP TABLE IF EXISTS `b_bug_log`;
CREATE TABLE `b_bug_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bug_id` int(11) DEFAULT NULL,
  `hand_id` int(11) DEFAULT NULL,
  `content` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for b_project
-- ----------------------------
DROP TABLE IF EXISTS `b_project`;
CREATE TABLE `b_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `project_desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for b_user
-- ----------------------------
DROP TABLE IF EXISTS `b_user`;
CREATE TABLE `b_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` char(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_role` tinyint(4) DEFAULT NULL,
  `login_ip` char(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` char(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `login_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

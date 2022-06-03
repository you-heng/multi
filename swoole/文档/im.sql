/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : test.io

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2022-05-31 17:59:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for im_chat_log
-- ----------------------------
DROP TABLE IF EXISTS `im_chat_log`;
CREATE TABLE `im_chat_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `f_id` int(11) NOT NULL COMMENT '发送id',
  `t_id` int(11) NOT NULL COMMENT '接收id',
  `type` tinyint(4) NOT NULL COMMENT '1-客户端文字 2-客户端图片 3-客服端文字 4-客服端图片',
  `text` varchar(500) COLLATE utf8_unicode_ci NOT NULL COMMENT '内容',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of im_chat_log
-- ----------------------------

-- ----------------------------
-- Table structure for im_service
-- ----------------------------
DROP TABLE IF EXISTS `im_service`;
CREATE TABLE `im_service` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `uid` int(11) DEFAULT NULL COMMENT '唯一标识',
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '名字',
  `password` char(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '密码',
  `ip` char(15) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '最后一次登录的ip',
  `ua` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '最后一次登录的ua',
  `fd` int(11) DEFAULT NULL COMMENT 'swoole分配的fd',
  `is_line` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1-不在线 2-在线',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1-售前 2-售后',
  `serve_num` int(11) DEFAULT NULL COMMENT '服务数量',
  `serve_count` int(11) DEFAULT NULL COMMENT '服务总量',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '最后一次登录时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of im_service
-- ----------------------------
INSERT INTO `im_service` VALUES ('1', '222', '一号', '3c3117539cdb80a6fbdcb0857b44cdff', null, null, null, '0', '1', '1', '1', '2022-05-31 14:11:19', '2022-05-31 14:11:19');
INSERT INTO `im_service` VALUES ('2', '333', '二号', '3c3117539cdb80a6fbdcb0857b44cdff', null, null, null, '0', '1', '2', '2', '2022-05-31 14:11:19', '2022-05-31 14:11:19');

-- ----------------------------
-- Table structure for im_user
-- ----------------------------
DROP TABLE IF EXISTS `im_user`;
CREATE TABLE `im_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `uid` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户唯一标识',
  `sid` int(11) NOT NULL COMMENT '客服id',
  `ip` char(15) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '最后一次登录ip',
  `ua` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '最后一次登录ua',
  `fd` int(11) DEFAULT NULL COMMENT 'swoole分配的fd',
  `unread` int(11) DEFAULT NULL COMMENT '未读数量',
  `address` varchar(130) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '最后一次登录地址',
  `is_black` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1-正常 2-拉黑',
  `remark` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '备注',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '最后一次登录时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of im_user
-- ----------------------------
INSERT INTO `im_user` VALUES ('1', '111', '0', null, null, '1', null, null, '1', null, '2022-05-31 13:08:27', '2022-05-31 13:08:27');
INSERT INTO `im_user` VALUES ('2', '1', '1', null, null, null, null, null, '1', null, '2022-05-31 14:06:34', '2022-05-31 14:06:34');
INSERT INTO `im_user` VALUES ('3', '3', '0', null, null, null, null, null, '1', null, '2022-05-31 14:52:36', '2022-05-31 14:52:36');
INSERT INTO `im_user` VALUES ('4', '4', '0', null, null, null, null, null, '1', null, '2022-05-31 14:57:07', '2022-05-31 14:57:07');

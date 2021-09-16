/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : anli

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2021-04-21 10:16:36
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sign
-- ----------------------------
DROP TABLE IF EXISTS `sign`;
CREATE TABLE `sign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '名字',
  `student` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '学号',
  `is_temp` tinyint(4) DEFAULT NULL COMMENT '体温是否小于37.2 1-是 2-否',
  `is_leave` tinyint(4) DEFAULT NULL COMMENT '是否前往高风险地区 1-是 2-否',
  `address` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '所在地',
  `create_time` int(11) DEFAULT NULL COMMENT '签到时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of sign
-- ----------------------------
INSERT INTO `sign` VALUES ('1', '黄汪汪', '20171564001', '1', '2', '中国北京', '1618923703');
INSERT INTO `sign` VALUES ('2', '李毛毛', '20171564002', '1', '1', '中国北京', '1618923785');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '名称',
  `student` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pass` char(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '密码',
  `is_sign` tinyint(4) DEFAULT '2' COMMENT '签到 1-已签到 2-未签到',
  `is_state` tinyint(4) DEFAULT NULL COMMENT '1-学生 2-老师',
  `login_time` int(11) DEFAULT NULL COMMENT '登录时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', '黄汪汪', '20171564001', '564001', '1', '1', '1618923676');
INSERT INTO `user` VALUES ('2', '李毛毛', '20171564002', '564002', '1', '1', '1618923906');
INSERT INTO `user` VALUES ('3', '买多多', '20171564003', '564003', '2', '1', null);
INSERT INTO `user` VALUES ('4', '王琪琪', '20171564004', '564004', '2', '1', null);
INSERT INTO `user` VALUES ('5', '李涵涵', '20171564005', '564005', '2', '1', null);
INSERT INTO `user` VALUES ('6', '赵碧碧', '20171564007', '564007', '2', '1', null);
INSERT INTO `user` VALUES ('7', '刘龙龙', '20171564008', '564008', '2', '1', null);
INSERT INTO `user` VALUES ('8', '谭管管', '20171564009', '564009', '2', '1', null);
INSERT INTO `user` VALUES ('9', '毛恒恒', '20171564009', '564009', '2', '1', null);
INSERT INTO `user` VALUES ('10', '吕斌斌', '20171564010', '564010', '2', '1', null);
INSERT INTO `user` VALUES ('11', '寒信', '20171564011', '564011', '2', '1', null);
INSERT INTO `user` VALUES ('12', '李仁', '20171564012', '564012', '2', '1', null);
INSERT INTO `user` VALUES ('13', '刘谋', '20171564013', '564013', '2', '1', null);
INSERT INTO `user` VALUES ('14', '王麒', '20171564014', '564014', '2', '1', null);
INSERT INTO `user` VALUES ('15', '赵鑫', '20171564015', '564015', '2', '1', null);
INSERT INTO `user` VALUES ('16', '李玉', '20171564016', '564016', '2', '1', null);
INSERT INTO `user` VALUES ('17', '王萌', '20171564017', '564017', '2', '1', null);
INSERT INTO `user` VALUES ('18', '陈成', '20171564018', '564018', '2', '1', null);
INSERT INTO `user` VALUES ('19', '李泽', '20171564019', '564019', '2', '1', null);
INSERT INTO `user` VALUES ('20', 'teacher1', '', '000001', null, '2', '1618924112');
INSERT INTO `user` VALUES ('21', 'teacher2', '', '000002', null, '2', null);
INSERT INTO `user` VALUES ('22', 'teacher3', '', '000003', null, '2', null);
INSERT INTO `user` VALUES ('23', 'teacher4', '', '000004', null, '2', null);
INSERT INTO `user` VALUES ('24', 'teacher5', '', '000005', null, '2', null);
INSERT INTO `user` VALUES ('25', 'teacher6', '', '000006', null, '2', null);
INSERT INTO `user` VALUES ('26', 'teacher7', '', '000007', null, '2', null);
INSERT INTO `user` VALUES ('27', 'teacher8', '', '000008', null, '2', null);
INSERT INTO `user` VALUES ('28', 'teacher9', '', '000009', null, '2', null);
INSERT INTO `user` VALUES ('29', 'teacher10', '', '000010', null, '2', null);

/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : paper

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2021-04-28 17:10:07
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for p_admin
-- ----------------------------
DROP TABLE IF EXISTS `p_admin`;
CREATE TABLE `p_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` char(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_role` tinyint(4) DEFAULT NULL,
  `serialNumber` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `b_id` int(11) DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` char(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip` char(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` tinyint(4) DEFAULT '1',
  `login_time` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of p_admin
-- ----------------------------
INSERT INTO `p_admin` VALUES ('1', 'admin', '123456', '0', '00000', '0', '0', '0', '127.0.0.1', '2', '1619597790', '1619597050', null);
INSERT INTO `p_admin` VALUES ('2', '计算机学院院长', '123456', '1', '0001', '1', '0001@qq.com', '15000000000', '127.0.0.1', '2', '1619600794', '1619597097', '1619597441');
INSERT INTO `p_admin` VALUES ('3', '商学院院长', '123456', '1', '00002', '2', '00002@qq.com', '15000000000', '127.0.0.1', '2', '1619597645', '1619597121', '1619597747');
INSERT INTO `p_admin` VALUES ('4', '工学院院长', '123456', '1', '00003', '3', null, null, null, '1', null, '1619597137', null);
INSERT INTO `p_admin` VALUES ('5', '农学院院长', '123456', '1', '00004', '4', null, null, null, '1', null, '1619597153', null);

-- ----------------------------
-- Table structure for p_college
-- ----------------------------
DROP TABLE IF EXISTS `p_college`;
CREATE TABLE `p_college` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `number` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of p_college
-- ----------------------------
INSERT INTO `p_college` VALUES ('1', '计算机信息学院', '0001', '1619597005', null);
INSERT INTO `p_college` VALUES ('2', '商学院', '0002', '1619597012', null);
INSERT INTO `p_college` VALUES ('3', '工学院', '0003', '1619597022', null);
INSERT INTO `p_college` VALUES ('4', '农学院', '0004', '1619597033', null);

-- ----------------------------
-- Table structure for p_document
-- ----------------------------
DROP TABLE IF EXISTS `p_document`;
CREATE TABLE `p_document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paper_report` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `guide_report` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reply_report` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `b_id` int(11) DEFAULT NULL,
  `t_id` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of p_document
-- ----------------------------
INSERT INTO `p_document` VALUES ('1', 'http://paper.com/upload/2021/04/28/60891b5492fbe.doc', 'http://paper.com/upload/2021/04/28/60891b5acf51c.doc', 'http://paper.com/upload/2021/04/28/60891b5ee96c1.doc', '1', '1', '1619598176', null);

-- ----------------------------
-- Table structure for p_group
-- ----------------------------
DROP TABLE IF EXISTS `p_group`;
CREATE TABLE `p_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `b_id` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of p_group
-- ----------------------------
INSERT INTO `p_group` VALUES ('1', '一组', '1', '1619597600', null);
INSERT INTO `p_group` VALUES ('2', '二组', '1', '1619597605', null);
INSERT INTO `p_group` VALUES ('3', '三组', '1', '1619597611', null);
INSERT INTO `p_group` VALUES ('4', '四组', '1', '1619597616', null);
INSERT INTO `p_group` VALUES ('5', '一组', '2', '1619597758', null);
INSERT INTO `p_group` VALUES ('6', '二组', '2', '1619597763', null);
INSERT INTO `p_group` VALUES ('7', '三组', '2', '1619597768', null);

-- ----------------------------
-- Table structure for p_notice
-- ----------------------------
DROP TABLE IF EXISTS `p_notice`;
CREATE TABLE `p_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notice_desc` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_auth` tinyint(4) DEFAULT NULL,
  `is_type` tinyint(4) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of p_notice
-- ----------------------------
INSERT INTO `p_notice` VALUES ('1', '关于毕业论文', '又到了新一年的毕业季，请各位导师帮助同学完成毕业论文', '1', '2', '1619600064', null);
INSERT INTO `p_notice` VALUES ('2', '关于答辩', '请1组学生xx号到xx教室进行答辩', '1', '1', '1619600848', null);

-- ----------------------------
-- Table structure for p_paper
-- ----------------------------
DROP TABLE IF EXISTS `p_paper`;
CREATE TABLE `p_paper` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paper_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paper_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_state` tinyint(4) DEFAULT '1',
  `score` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `t_id` int(11) DEFAULT NULL,
  `b_id` int(11) DEFAULT NULL,
  `s_id` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of p_paper
-- ----------------------------
INSERT INTO `p_paper` VALUES ('1', '论文管理系统', 'http://paper.com/upload/2021/04/28/608921eb2245a.doc', '2', '80', '1', '1', '1', '1619599854', '1619600288');

-- ----------------------------
-- Table structure for p_report
-- ----------------------------
DROP TABLE IF EXISTS `p_report`;
CREATE TABLE `p_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `report_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `report_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_state` tinyint(4) DEFAULT '1',
  `b_id` int(11) DEFAULT NULL,
  `t_id` int(11) DEFAULT NULL,
  `s_id` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of p_report
-- ----------------------------
INSERT INTO `p_report` VALUES ('1', '论文管理系统', 'http://paper.com/upload/2021/04/28/608921276bbcd.doc', '2', '1', '1', '1', '1619599075', '1619599702');

-- ----------------------------
-- Table structure for p_student
-- ----------------------------
DROP TABLE IF EXISTS `p_student`;
CREATE TABLE `p_student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` char(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_role` tinyint(4) DEFAULT NULL,
  `serialNumber` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `b_id` int(11) DEFAULT NULL,
  `t_id` int(11) DEFAULT NULL,
  `g_id` int(11) DEFAULT NULL,
  `ts_id` int(11) DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` char(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip` char(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` tinyint(4) DEFAULT '1',
  `login_time` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of p_student
-- ----------------------------
INSERT INTO `p_student` VALUES ('1', '吴同学', '123456', '3', 's0001', '1', '1', '1', '1', null, null, '127.0.0.1', '1', '1619599729', '1619597817', '1619598959');
INSERT INTO `p_student` VALUES ('2', '郑同学', '123456', '3', 's00002', '1', '1', '1', null, null, null, null, '1', null, '1619597843', null);
INSERT INTO `p_student` VALUES ('3', '王同学', '123456', '3', 's00003', '1', '2', '1', null, null, null, null, '1', null, '1619597872', null);
INSERT INTO `p_student` VALUES ('4', '冯同学', '123456', '3', 's00004', '1', '2', '1', null, null, null, null, '1', null, '1619597893', null);
INSERT INTO `p_student` VALUES ('5', '陈同学', '123456', '3', 's00005', '1', '1', '2', null, null, null, null, '1', null, '1619597920', null);
INSERT INTO `p_student` VALUES ('6', '褚同学', '123456', '3', 's00006', '1', '1', '2', null, null, null, null, '1', null, '1619597957', null);
INSERT INTO `p_student` VALUES ('7', '卫同学', '123456', '3', 's00007', '2', '3', '5', null, null, null, null, '1', null, '1619597989', null);
INSERT INTO `p_student` VALUES ('8', '蒋同学', '123456', '3', 's00008', '2', '3', '5', null, null, null, null, '1', null, '1619598047', null);
INSERT INTO `p_student` VALUES ('9', '沈同学', '123456', '3', 's00009', '2', '4', '5', null, null, null, null, '1', null, '1619598070', null);
INSERT INTO `p_student` VALUES ('10', '韩同学', '123456', '3', 's0000a', '2', '4', '6', null, null, null, null, '1', null, '1619598097', null);

-- ----------------------------
-- Table structure for p_task
-- ----------------------------
DROP TABLE IF EXISTS `p_task`;
CREATE TABLE `p_task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `task_desc` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `t_id` int(11) DEFAULT NULL,
  `b_id` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of p_task
-- ----------------------------
INSERT INTO `p_task` VALUES ('1', '论文管理系统', '论文管理系统是由layui+php完成', '1', '1', '1619598234', null);
INSERT INTO `p_task` VALUES ('2', '测试测试测试测试', '测试测试测试测试测试测试测试测试测试测试测试测试', '1', '1', '1619598252', null);
INSERT INTO `p_task` VALUES ('3', '1111111111', '1111111111111111111', '1', '1', '1619598261', null);
INSERT INTO `p_task` VALUES ('4', '赵老师课题', '赵老师课题赵老师课题赵老师课题', '2', '1', '1619598337', null);
INSERT INTO `p_task` VALUES ('5', '测试2', '测试2测试2测试2测试2', '2', '1', '1619598348', null);
INSERT INTO `p_task` VALUES ('6', '狗狗币大涨', '怎么看待狗狗币大涨？是什么原因', '3', '2', '1619598489', null);
INSERT INTO `p_task` VALUES ('7', '测试测试测试33333', '测试测试测试33333测试测试测试33333测试测试测试33333', '3', '2', '1619598526', null);
INSERT INTO `p_task` VALUES ('8', '李老师的课题', '李老师的课题李老师的课题李老师的课题', '4', '2', '1619598576', null);
INSERT INTO `p_task` VALUES ('9', '机械自动化的实现', '小型设备怎么实现自动化？用什么方法实现', '5', '3', '1619598694', null);
INSERT INTO `p_task` VALUES ('10', '测试123323', '测试123323测试123323', '5', '3', '1619598706', null);

-- ----------------------------
-- Table structure for p_teacher
-- ----------------------------
DROP TABLE IF EXISTS `p_teacher`;
CREATE TABLE `p_teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` char(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_role` tinyint(4) DEFAULT NULL,
  `serialNumber` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `b_id` int(11) DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` char(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip` char(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` tinyint(4) DEFAULT '1',
  `login_time` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of p_teacher
-- ----------------------------
INSERT INTO `p_teacher` VALUES ('1', '赵老师', '123456', '2', 't0001', '1', 't0001@qq.com', '15000000000', '127.0.0.1', '2', '1619600870', '1619597185', '1619598145');
INSERT INTO `p_teacher` VALUES ('2', '钱老师', '123456', '2', 't00002', '1', null, null, '127.0.0.1', '1', '1619598313', '1619597204', null);
INSERT INTO `p_teacher` VALUES ('3', '孙老师', '123456', '2', 't00003', '2', null, null, '127.0.0.1', '1', '1619598379', '1619597223', null);
INSERT INTO `p_teacher` VALUES ('4', '李老师', '123456', '2', 't0004', '2', null, null, '127.0.0.1', '1', '1619598551', '1619597242', '1619597352');
INSERT INTO `p_teacher` VALUES ('5', '周老师', '123456', '2', 't00005', '3', null, null, '127.0.0.1', '1', '1619598591', '1619597374', null);

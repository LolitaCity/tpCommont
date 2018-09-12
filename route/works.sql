/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : works

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-09-12 10:06:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `mh_admin`
-- ----------------------------
DROP TABLE IF EXISTS `mh_admin`;
CREATE TABLE `mh_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL COMMENT '用户名',
  `nick_name` varchar(30) DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  `tel` varchar(11) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `inc` int(10) unsigned DEFAULT '0' COMMENT '登陆次数',
  `last_logintime` varchar(10) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '上次登录时间',
  `last_ip` varchar(50) DEFAULT NULL COMMENT '上次登录IP',
  `add_time` varchar(11) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '注册时间',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态，0为删除，1为正常，2为禁用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='管理员表(admin table)';

-- ----------------------------
-- Records of mh_admin
-- ----------------------------
INSERT INTO `mh_admin` VALUES ('1', 'admin', '超级管理员', '14e1b600b1fd579f47433b88e8d85291', '17098905509', '605333742@qq.com', null, '120', '1536577986', '10.0.0.97', null, '1');
INSERT INTO `mh_admin` VALUES ('2', 'Lee', '普通管理员', '14e1b600b1fd579f47433b88e8d85291', '13324110120', '222', null, '1', '1536123537', '10.0.0.97', null, '1');

-- ----------------------------
-- Table structure for `mh_admin_role`
-- ----------------------------
DROP TABLE IF EXISTS `mh_admin_role`;
CREATE TABLE `mh_admin_role` (
  `a_id` int(11) unsigned DEFAULT NULL COMMENT '用户id',
  `role_id` int(11) unsigned DEFAULT NULL COMMENT '角色id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户与角色关联表';

-- ----------------------------
-- Records of mh_admin_role
-- ----------------------------
INSERT INTO `mh_admin_role` VALUES ('1', '1');

-- ----------------------------
-- Table structure for `mh_log`
-- ----------------------------
DROP TABLE IF EXISTS `mh_log`;
CREATE TABLE `mh_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL COMMENT '操作人id',
  `db` varchar(100) DEFAULT NULL COMMENT '操作的数据库',
  `content` mediumtext COMMENT '操作内容',
  `add_time` int(11) unsigned DEFAULT NULL COMMENT '操作时间',
  `ip` varchar(45) DEFAULT NULL COMMENT '登录人ip',
  `addr` varchar(100) DEFAULT NULL COMMENT '登陆地点',
  `type` tinyint(1) unsigned DEFAULT '0' COMMENT '日志类型（0为操作日志，1为登录日志）',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态，0为删除，1为正常，',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=556 DEFAULT CHARSET=utf8 COMMENT='日志表(log table)';

-- ----------------------------
-- Records of mh_log
-- ----------------------------
INSERT INTO `mh_log` VALUES ('437', '1', 'Node', 'admin在数据库 Node 新增了一条数据', '1536308070', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('438', '1', 'Node', 'admin在数据库 Node 新增了一条数据', '1536308221', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('439', '1', 'Node', 'admin编辑的数据表Node中主键为id 的数据', '1536308500', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('440', '1', 'Node', 'admin在数据库 Node 新增了一条数据', '1536309080', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('441', '1', 'Node', 'admin在数据库 Node 新增了一条数据', '1536309147', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('442', '1', 'Node', 'admin在数据库 Node 新增了一条数据', '1536309183', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('443', '1', 'Node', 'admin在数据库 Node 新增了一条数据', '1536309221', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('444', '1', 'Node', 'admin在数据库 Node 新增了一条数据', '1536309289', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('445', '1', 'Node', 'admin在数据库 Node 新增了一条数据', '1536309361', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('446', '1', 'Node', 'admin在数据库 Node 新增了一条数据', '1536309445', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('447', '1', 'Node', 'admin在数据库 Node 新增了一条数据', '1536309502', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('448', '1', 'Node', 'admin在数据库 Node 新增了一条数据', '1536309536', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('449', '1', 'Node', 'admin在数据库 Node 新增了一条数据', '1536309551', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('450', '1', 'Node', 'admin在数据库 Node 新增了一条数据', '1536309566', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('451', '1', 'Node', 'admin在数据库 Node 新增了一条数据', '1536309577', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('452', '1', 'Node', 'admin在数据库 Node 新增了一条数据', '1536309593', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('453', '1', 'Node', 'admin在数据库 Node 新增了一条数据', '1536309598', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('454', '1', 'Node', 'admin在数据库 Node 新增了一条数据', '1536309644', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('455', '1', 'Node', 'admin在数据库 Node 新增了一条数据', '1536309691', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('456', '1', 'Node', 'admin在数据库 Node 新增了一条数据', '1536309771', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('457', '1', 'Node', 'admin在数据库 Node 新增了一条数据', '1536309790', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('458', '1', 'Node', 'admin在数据库 Node 新增了一条数据', '1536309808', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('459', '1', 'Node', 'admin在数据库 Node 新增了一条数据', '1536309843', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('460', '1', 'Node', 'admin在数据库 Node 新增了一条数据', '1536309871', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('461', '1', 'Node', 'admin编辑的数据表Node中主键为id 的数据', '1536309902', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('462', '1', 'Node', 'admin编辑的数据表Node中主键为id 的数据', '1536309984', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('463', '1', 'Node', 'admin编辑的数据表Node中主键为id 的数据', '1536310050', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('464', '1', 'Node', 'admin编辑的数据表Node中主键为id 的数据', '1536310077', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('465', '1', 'Node', 'admin编辑的数据表Node中主键为id 的数据', '1536310104', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('466', '1', 'Node', 'admin删除了数据表 Node 中主键为 137,136,135,134,133,119,118,117,116,141,142,153,152,151,150,149,148,147,146,145 的数据', '1536310160', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('467', '1', 'Node', 'admin删除了数据表 Node 中主键为 95,96,97,98,99,100,101,102,103,89 的数据', '1536310172', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('468', '1', 'Node', 'admin删除了数据表 Node 中主键为 143,144 的数据', '1536310197', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('469', '1', 'Node', 'admin删除了数据表 Node 中主键为 112 的数据', '1536310210', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('470', '1', 'Node', 'admin删除了数据表 Node 中主键为 105 的数据', '1536310236', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('471', '1', 'Node', 'admin编辑的数据表Node中主键为id 的数据', '1536311341', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('472', '1', 'Node', 'admin编辑的数据表Node中主键为id 的数据', '1536311370', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('473', '1', 'Node', 'admin编辑的数据表Node中主键为id 的数据', '1536311440', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('474', '1', 'Node', 'admin编辑的数据表Node中主键为id 的数据', '1536311531', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('475', '1', 'Node', 'admin编辑的数据表Node中主键为id 的数据', '1536311555', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('476', '1', 'Node', 'admin编辑的数据表Node中主键为id 的数据', '1536311671', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('477', '1', 'Node', 'admin编辑的数据表Node中主键为id 的数据', '1536311760', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('478', '1', 'Node', 'admin编辑的数据表Node中主键为id 的数据', '1536311842', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('479', '1', 'Node', 'admin编辑的数据表Node中主键为id 的数据', '1536311884', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('480', '1', 'Node', 'admin编辑的数据表Node中主键为id 的数据', '1536311952', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('481', '1', 'Node', 'admin在数据库 Node 新增了一条数据', '1536312002', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('482', '1', 'Node', 'admin在数据库 Node 新增了一条数据', '1536312113', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('483', '1', 'Node', 'admin在数据库 Node 新增了一条数据', '1536312137', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('484', '1', 'Node', 'admin在数据库 Node 新增了一条数据', '1536312170', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('485', '1', 'Node', 'admin在数据库 Node 新增了一条数据', '1536312205', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('486', '1', 'Node', 'admin在数据库 Node 新增了一条数据', '1536312238', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('487', '1', 'Node', 'admin编辑的数据表Node中主键为id 的数据', '1536312273', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('488', '1', 'Node', 'admin删除了数据表 Node 中主键为 155,156,157,158,159,160 的数据', '1536312347', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('489', '1', 'Node', 'admin删除了数据表 Node 中主键为 154 的数据', '1536312354', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('490', '1', 'Node', 'admin删除了数据表 Node 中主键为 153 的数据', '1536312356', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('491', '1', 'Node', 'admin删除了数据表 Node 中主键为 152 的数据', '1536312359', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('492', '1', 'Node', 'admin删除了数据表 Node 中主键为 151 的数据', '1536312361', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('493', '1', 'Node', 'admin在数据库 Node 新增了一条数据', '1536312387', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('494', '1', 'Node', 'admin删除了数据表 Node 中主键为 93,94,104,106,107,108,109,110,111,113,114,115,138,139,140,150,161 的数据', '1536312399', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('495', '1', 'Node', 'admin删除了数据表 Node 中主键为 57,58,61,62,64,65,69,70,72,73,74,79,80,81,82,84,86,90,91,92 的数据', '1536312409', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('496', '1', 'Node', 'admin删除了数据表 Node 中主键为 48,49,50,51,52,56 的数据', '1536312422', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('497', '1', 'Node', 'admin删除了数据表 Node 中主键为 54 的数据', '1536312939', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('498', '1', 'Node', 'admin删除了数据表 Node 中主键为 53 的数据', '1536313025', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('499', '1', 'Node', 'admin删除了数据表 Node 中主键为 52 的数据', '1536313050', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('500', '1', 'Node', 'admin删除了数据表 Node 中主键为 51 的数据', '1536313091', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('501', '1', 'Node', 'admin删除了数据表 Node 中主键为 50 的数据', '1536313117', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('502', '1', 'Node', 'admin删除了数据表 Node 中主键为 62 的数据', '1536313179', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('503', '1', 'Node', 'admin删除了数据表 Node 中主键为 61 的数据', '1536313255', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('504', '1', 'Node', 'admin删除了数据表 Node 中主键为 63 的数据', '1536313289', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('505', '1', 'Node', 'admin删除了数据表 Node 中主键为 58 的数据', '1536313321', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('506', '1', 'Node', 'admin删除了数据表 Node 中主键为 57 的数据', '1536313392', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('507', '1', 'Node', 'admin删除了数据表 Node 中主键为 56 的数据', '1536313522', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('508', '1', 'Node', 'admin删除了数据表 Node 中主键为 60 的数据', '1536313562', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('509', '1', 'Node', 'admin删除了数据表 Node 中主键为 61 的数据', '1536313598', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('510', '1', 'Node', 'admin删除了数据表 Node 中主键为 62 的数据', '1536313636', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('511', '1', 'Node', 'admin删除了数据表 Node 中主键为 63 的数据', '1536313731', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('512', '1', 'Node', 'admin删除了数据表 Node 中主键为 58 的数据', '1536314215', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('513', '1', 'Node', 'admin删除了数据表 Node 中主键为 65 的数据', '1536314233', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('514', '1', 'Node', 'admin删除了数据表 Node 中主键为 66 的数据', '1536314396', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('515', '1', 'Node', 'admin删除了数据表 Node 中主键为 67 的数据', '1536363540', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('516', '1', 'Node', 'admin删除了数据表 Node 中主键为 64 的数据', '1536363870', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('517', '1', 'Node', 'admin删除了数据表 Node 中主键为 57 的数据', '1536363937', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('518', '1', 'Node', 'admin删除了数据表 Node 中主键为 56 的数据', '1536364100', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('519', '1', null, 'admin 登录成功', '1536364265', '10.0.0.97', '广东-深圳', '0', '1');
INSERT INTO `mh_log` VALUES ('520', '1', 'Node', 'admin删除了数据表 Node 中主键为 55 的数据', '1536364327', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('521', '1', 'Node', 'admin删除了数据表 Node 中主键为 147 的数据', '1536364553', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('522', '1', null, 'admin 登录成功', '1536541153', '10.0.0.97', '广东-深圳', '0', '1');
INSERT INTO `mh_log` VALUES ('523', '1', 'Node', 'admin删除了数据表 Node 中主键为 148 的数据', '1536541231', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('524', '1', 'Node', 'admin删除了数据表 Node 中主键为 80 的数据', '1536541328', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('525', '1', 'Node', 'admin删除了数据表 Node 中主键为 53 的数据', '1536541815', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('526', '1', 'Node', 'admin删除了数据表 Node 中主键为 54 的数据', '1536541879', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('527', '1', 'Node', 'admin删除了数据表 Node 中主键为 55 的数据', '1536541900', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('528', '1', 'Node', 'admin删除了数据表 Node 中主键为 52 的数据', '1536541958', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('529', '1', 'Node', 'admin删除了数据表 Node 中主键为 57 的数据', '1536542093', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('530', '1', 'Node', 'admin删除了数据表 Node 中主键为 58 的数据', '1536542099', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('531', '1', 'Node', 'admin删除了数据表 Node 中主键为 135,136,137,138,139,140,141,142,143,144,145,146,149,150,151,152,153,154,155,156 的数据', '1536544857', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('532', '1', 'Node', 'admin删除了数据表 Node 中主键为 157,158,159,160,161 的数据', '1536544865', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('533', '1', null, 'admin 登录成功', '1536573704', '10.0.0.97', '广东-深圳', '0', '1');
INSERT INTO `mh_log` VALUES ('534', '1', null, 'admin 登录成功', '1536574139', '10.0.0.97', '广东-深圳', '0', '1');
INSERT INTO `mh_log` VALUES ('535', '1', null, 'admin 登录成功', '1536574153', '10.0.0.97', '广东-深圳', '0', '1');
INSERT INTO `mh_log` VALUES ('536', '1', 'Node', 'admin删除了数据表 Node 中主键为 102,103,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,133,134 的数据', '1536574187', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('537', '1', null, 'admin 登录成功', '1536577986', '10.0.0.97', '广东-深圳', '0', '1');
INSERT INTO `mh_log` VALUES ('538', '1', 'Node', 'admin删除了数据表 Node 中主键为 60 的数据', '1536633288', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('539', '1', 'Node', 'admin删除了数据表 Node 中主键为 61 的数据', '1536643418', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('540', '1', 'Node', 'admin删除了数据表 Node 中主键为 101 的数据', '1536645563', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('541', '1', 'Node', 'admin删除了数据表 Node 中主键为 62 的数据', '1536646593', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('542', '1', 'Node', 'admin删除了数据表 Node 中主键为 63 的数据', '1536651637', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('543', '1', 'Node', 'admin删除了数据表 Node 中主键为 100 的数据', '1536651646', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('544', '1', 'Node', 'admin删除了数据表 Node 中主键为 99 的数据', '1536651650', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('545', '1', 'Node', 'admin删除了数据表 Node 中主键为 98 的数据', '1536651656', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('546', '1', 'Node', 'admin删除了数据表 Node 中主键为 92 的数据', '1536651664', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('547', '1', 'Node', 'admin删除了数据表 Node 中主键为 97 的数据', '1536651675', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('548', '1', 'Node', 'admin删除了数据表 Node 中主键为 96 的数据', '1536651678', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('549', '1', 'Node', 'admin删除了数据表 Node 中主键为 95 的数据', '1536651782', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('550', '1', 'Node', 'admin删除了数据表 Node 中主键为 94 的数据', '1536651786', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('551', '1', 'Node', 'admin删除了数据表 Node 中主键为 93 的数据', '1536651877', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('552', '1', 'Node', 'admin删除了数据表 Node 中主键为 64 的数据', '1536654003', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('553', '1', 'Node', 'admin删除了数据表 Node 中主键为 91 的数据', '1536654008', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('554', '1', 'Node', 'admin删除了数据表 Node 中主键为 65 的数据', '1536656335', null, null, '1', '1');
INSERT INTO `mh_log` VALUES ('555', '1', 'Node', 'admin删除了数据表 Node 中主键为 90 的数据', '1536656341', null, null, '1', '1');

-- ----------------------------
-- Table structure for `mh_node`
-- ----------------------------
DROP TABLE IF EXISTS `mh_node`;
CREATE TABLE `mh_node` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL COMMENT '节点名称',
  `controller` varchar(50) DEFAULT NULL COMMENT '控制器',
  `action` varchar(50) DEFAULT NULL COMMENT '方法',
  `level` tinyint(1) NOT NULL DEFAULT '0' COMMENT '层级',
  `p_id` int(10) unsigned NOT NULL DEFAULT '0',
  `ord` int(10) unsigned DEFAULT '99' COMMENT '节点排序',
  `path` varchar(15) DEFAULT NULL COMMENT '节点列表排序',
  `add_time` int(11) unsigned DEFAULT NULL COMMENT '添加时间',
  `edit_time` int(11) unsigned DEFAULT NULL COMMENT '修改时间',
  `add_a_id` varchar(60) NOT NULL DEFAULT '' COMMENT '添加人',
  `edit_a_id` varchar(60) NOT NULL DEFAULT '' COMMENT '修改人',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态0为删除，1为正常',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=162 DEFAULT CHARSET=utf8 COMMENT='节点表(node table)';

-- ----------------------------
-- Records of mh_node
-- ----------------------------
INSERT INTO `mh_node` VALUES ('1', '节点管理', 'Node', '', '0', '0', '1', '1_', '1530758456', '1530758456', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('2', '节点列表', 'Node', 'index', '1', '1', '1', '1_2_', '1530758456', '1530758456', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('3', '网站管理', 'Web', '', '0', '0', '2', '3_', '1530758456', '1530758456', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('4', '网站信息', 'Web', 'info', '1', '3', '1', '3_4_', '1530758456', '1530758456', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('6', '角色分配', 'Web', 'role', '1', '3', '2', '3_6_', '1530758456', '1530758456', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('8', '访问列表', 'Web', 'visit', '1', '8', '3', '3_8_', '1530758456', '1530758456', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('9', '系统管理', 'System', '', '0', '0', '3', '9_', '1530758456', '1530758456', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('10', '操作日志列表', 'System', 'log', '1', '9', '1', '9_10_', '1530758456', '1530758456', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('26', '用户管理', 'User', '', '0', '0', '3', '26_', '1530758456', '1530758456', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('27', '前台用户管理', 'User', 'index', '1', '26', '1', '26_27_', '1530758456', '1530758456', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('28', '后台用户管理', 'User', 'adminIndex', '1', '26', '2', '26_28_', '1530758456', '1530758456', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('30', '登录日志列表', 'System', 'loginLog', '1', '9', '2', '9_20_', '1530758456', '1530758456', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('31', '过期图片', 'System', 'invalidImg', '1', '31', '3', '9_31_', '1530758456', '1530758456', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('37', 'banner', 'Web', 'banner', '1', '3', '4', '3_37_', '1530758456', '1530758456', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('48', 'ceshix', 'Sa', '', '0', '48', '5', '48_', '1530856880', '1530856881', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('49', 'Amazon evaluation', 'UrlCont', '', '0', '0', '5', '49_', '1530758456', '1530758456', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('50', 'Need to grab the Amazon', 'UrlCont', 'index', '1', '50', '6', '49_50_', '1530758456', '1530758456', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('51', 'Minimum price limit ', 'MinimumPrice', '', '0', '0', '7', '51_', '1530758456', '1530758456', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('52', 'Ceshi_1', 'Ceshi1', '', '0', '52', '8', '52_', '1530758456', '1530758456', '1', '1', '0');
INSERT INTO `mh_node` VALUES ('53', '测试2_index', 'Ceshi1', 'index', '1', '54', '13', '52_53_', '1530758456', '1530758456', '1', '1', '0');
INSERT INTO `mh_node` VALUES ('54', 'Ceshi_2', 'Ceshi2', '', '0', '54', '10', '54_', '1530758456', '1530758456', '1', '1', '0');
INSERT INTO `mh_node` VALUES ('55', 'Ceshi_1_demo', 'Ceshi1', 'demo', '1', '52', '11', '52_55_', '1530758456', '1530758456', '1', '1', '0');
INSERT INTO `mh_node` VALUES ('56', 'Ceshi_1_ord', 'Ceshi1', 'index_ordb', '1', '52', '19', '52_56_', '1530758456', '1530758456', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('57', 'Ceshi_1_sort', 'Ceshi1', 'ceshi_sort', '1', '52', '13', '52_57_', '1530758456', '1530758456', '1', '1', '0');
INSERT INTO `mh_node` VALUES ('58', 'Ceshi_1_sort_2', 'Ceshi1', 'sort_2', '1', '52', '2', '52_58_', '1530758456', '1530758456', '1', '1', '0');
INSERT INTO `mh_node` VALUES ('60', 'Ceshi_1_sort_1', 'Ceshi', 'sss', '1', '60', '4', '60_', '1531281541', '1531281542', '1', '1', '0');
INSERT INTO `mh_node` VALUES ('61', 'Reseller list', 'MinimumPrice', 'resellerList', '1', '51', '1', '51_61_', '1530758456', '1530758456', '1', '1', '0');
INSERT INTO `mh_node` VALUES ('62', 'Product list', 'MinimumPrice', 'productList', '1', '51', '2', '51_62_', '1530758456', '1530758456', '1', '1', '0');
INSERT INTO `mh_node` VALUES ('63', 'Currency list', 'MinimumPrice', 'currencyList', '1', '63', '3', '51_63_', '1530758456', '1530758456', '1', '1', '0');
INSERT INTO `mh_node` VALUES ('64', 'Minimum price list', 'MinimumPrice', 'mPriceList', '1', '51', '4', '51_64_', '1530758456', '1530758456', '1', '1', '0');
INSERT INTO `mh_node` VALUES ('65', 'Send warning list', 'MinimumPrice', 'noticeList', '1', '51', '6', '51_65_', '1530758456', '1530758456', '1', '1', '0');
INSERT INTO `mh_node` VALUES ('66', 'ceshi777', 'sss', '444', '1', '66', '789', '66_', '1531281571', '1531281572', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('67', 'AAAA9992', 'Ceshi', '44', '1', '67', '444', '59_67_', '1531281628', '1531281629', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('68', 'ssxx', 'dd', 'x', '1', '68', '666', '68_', '1531281517', '1531281518', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('69', '777', '88', '', '0', '0', '55', '69_', '1530785490', '1530785490', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('70', '77u', 'uuu', '', '0', '0', '888', '70_', '1530785519', '1530785519', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('71', 'ddss', 'ddd', 'ss', '1', '70', '33', '70_71_', '1530785574', '1530785574', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('72', 'ceshi777ccc', 'ccccc', '', '0', '0', '0', '72_', '1530855579', '1530855579', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('73', '999666', '222', '', '0', '0', '0', '73_', '1530855607', '1530855607', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('74', 'ceshi7776', '银行', '', '0', '0', '0', '74_', '1530855750', '1530855750', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('75', 'ceshi777x', '44', '', '0', '75', '0', '75_', '1530855768', '1530855768', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('76', '77ddd', 'dddc', '', '0', '0', '0', '76_', '1530855795', '1530855795', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('77', 'xx', 'x', '', '0', '0', '0', '77_', '1530855851', '1530855851', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('78', 'xxx', 'xxx', '', '0', '0', '0', '78_', '1530855857', '1530855857', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('79', '77777sxxz', 'ddz', '', '0', '0', '0', '79_', '1530855894', '1530855894', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('80', '77777yh', 'hhu', '', '0', '0', '0', '80_', '1530855965', '1530855965', '1', '1', '0');
INSERT INTO `mh_node` VALUES ('81', 'ceshi7778', '777', '', '0', '0', '0', '81_', '1530855991', '1530855991', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('82', 'ceshi77755', '2211', '', '0', '0', '0', '82_', '1530856021', '1530856021', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('83', '77cccxz', '88', 'ccs', '1', '69', '0', '69_83_', '1530856197', '1530856197', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('84', 'ceshi777', 'Ceshi1', 'ff', '1', '52', '0', '52_84_', '1530856226', '1530856226', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('85', '77', 'sss', 'jjXXXX', '1', '85', '0', '85_', '1531194230', '1531194231', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('86', '77', 'MinimumPrice', '77', '1', '51', '1', '51_86_', '1530856340', '1530856340', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('87', 'ceshi777xc', '77sx', '', '0', '87', '0', '87_', '1530856856', '1530856856', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('88', 'ceshi777xzzss', 'sss', 'z', '1', '88', '0', '88_', '1530856992', '1530856992', '1', '1', '1');
INSERT INTO `mh_node` VALUES ('89', '测试2018_1', '', '', '0', '0', '999', null, null, null, '', '', '1');
INSERT INTO `mh_node` VALUES ('90', '测试2018_3', null, '', '0', '0', '99', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('91', '测试2018_5', null, '', '0', '0', '1000', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('92', '测试', null, '', '0', '0', '96', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('93', '测试2018_9', null, '', '0', '0', '999', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('94', '6654', null, '', '0', '0', '55', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('95', '6654', null, '', '0', '0', '55', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('96', '测试2018_11', null, '', '0', '0', '10006', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('97', '测试2018_11', null, '', '0', '0', '10006', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('98', '测试2018_17', null, null, '0', '0', '156', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('99', '测试2018_17', null, null, '0', '0', '156', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('100', '测试2018_18', null, null, '0', '0', '99', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('101', '测试2018_20', null, null, '0', '0', '99', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('102', '测试2018_20_', null, 'ces1', '1', '101', '99', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('103', '测试2018_20_2', null, 'cs2', '1', '101', '11', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('104', '测试2018_2_1', null, 'cs11', '1', '101', '3', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('105', '测试2018_20_3', null, 'cs3', '1', '101', '99', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('106', '测试2018_21', null, null, '0', '0', '99', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('107', '测试2018_21_1', null, 'ceshi21_1', '1', '106', '9', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('108', '测试2018_22', null, null, '0', '0', '33', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('109', '测试2018_23', null, null, '0', '0', '99', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('110', '测试2018_23_1', null, 'ceshi23_1', '1', '109', '99', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('111', '测试2018_23_2', null, 'ceshi23_2', '1', '109', '20', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('112', '测试2018_23_3', null, 'ceshi23_3', '1', '109', '66', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('113', '测试2018_24_S', 'dd', '', '0', '0', '0', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('114', '测试2018_24_P', null, 'ceshi24_1_s', '1', '113', '99', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('115', '测试2018_21_2', null, 'ceshi21_2', '1', '106', '66', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('116', '测试666', null, null, '0', '0', '99', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('117', '测试2018_30', 'YM30', null, '0', '0', '99', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('118', '测试2018_30', null, 'ceshi30', '1', '117', '99', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('119', '测试2018_30_5', 'YM30', 'ceshi30_5', '1', '117', '99', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('133', 'ceshi_48', 'sss', null, '0', '0', '36', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('134', 'ceshi_48', 'sss', null, '0', '0', '36', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('135', '测试2018_50', 'ceshi50', null, '0', '0', '1', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('136', '测试2018_51', 'ceshi51', null, '0', '0', '99', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('137', '测试2018_52', 'ceshi52', null, '0', '0', '1', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('138', '测试2018_53', 'ceshi53', null, '0', '0', '1', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('139', '测试2018_54', 'ceshi54', null, '0', '0', '99', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('140', '测试2018_54', 'ceshi54', null, '0', '0', '997', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('141', '测试2018_55', 'ceshi55', null, '0', '0', '2', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('142', 'cc', 'ccc', null, '0', '0', '2', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('143', 'cc', 'ccc', null, '0', '0', '2', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('144', 'cc', 'ccc', null, '0', '0', '2', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('145', 'cc', 'cccxvv', null, '0', '0', '2', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('146', '测试60', 'ccc', null, '0', '0', '2', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('147', 'cccx', 'ccc', null, '0', '151', '2', '151_147_', null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('148', 'cc', 'ccc', null, '0', '0', '2', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('149', 'cc', 'ccc', null, '0', '0', '2', null, null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('150', '测试2018_56', 'ceshi56S', null, '0', '0', '1201', '150_', null, '1536311952', '', '1', '0');
INSERT INTO `mh_node` VALUES ('151', '测试2018_57', 'ceshi57', null, '0', '0', '1110', '151_', null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('152', '测试2018_58', 'ceshi58', null, '0', '0', '99', '152_', null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('153', '测试2018_58_1', 'ceshi58', 'ceshi58_1', '1', '152', '99', '152_153_', null, null, '', '', '0');
INSERT INTO `mh_node` VALUES ('154', '测试2018_58_2', 'ceshi58', 'ceshi58_2', '1', '139', '22', '154_', null, '1536311370', '', '1', '0');
INSERT INTO `mh_node` VALUES ('155', '测试2018_58_4', 'ceshi58', 'ceshi58_4', '1', '152', '3', '152_155_', '1536312002', null, '1', '', '0');
INSERT INTO `mh_node` VALUES ('156', '测试2018_66', 'ceshi66', null, '0', '0', '1', '156_', '1536312113', '1536312113', '1', '1', '0');
INSERT INTO `mh_node` VALUES ('157', '测试2018_67', 'ceshi67', null, '0', '0', '52', '157_', '1536312137', '1536312137', '1', '1', '0');
INSERT INTO `mh_node` VALUES ('158', '测试2018_66_1', 'ceshi66', 'ceshi66_1', '1', '156', '2', '156_158_', '1536312170', '1536312170', '1', '1', '0');
INSERT INTO `mh_node` VALUES ('159', '测试2018_66_2', 'ceshi66', 'ceshi66_2', '1', '156', '99', '156_159_', '1536312205', '1536312205', '1', '1', '0');
INSERT INTO `mh_node` VALUES ('160', '测试2018_66_3', 'ceshi66', 'ceshi66_3', '1', '156', '30', '156_160_', '1536312238', '1536312273', '1', '1', '0');
INSERT INTO `mh_node` VALUES ('161', '测试2018_68', 'ceshi68', null, '0', '0', '6', '161_', '1536312387', '1536312387', '1', '1', '0');

-- ----------------------------
-- Table structure for `mh_role`
-- ----------------------------
DROP TABLE IF EXISTS `mh_role`;
CREATE TABLE `mh_role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL COMMENT '角色名称',
  `add_time` int(11) unsigned DEFAULT NULL COMMENT '添加时间',
  `edit_time` int(11) unsigned DEFAULT NULL COMMENT '修改时间',
  `add_a_id` varchar(60) NOT NULL DEFAULT '' COMMENT '添加人',
  `edit_a_id` varchar(60) NOT NULL DEFAULT '' COMMENT '修改人',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '状态0为删除，1为显示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='角色表';

-- ----------------------------
-- Records of mh_role
-- ----------------------------
INSERT INTO `mh_role` VALUES ('1', '超级管理员', null, null, '', '', '1');

-- ----------------------------
-- Table structure for `mh_role_node`
-- ----------------------------
DROP TABLE IF EXISTS `mh_role_node`;
CREATE TABLE `mh_role_node` (
  `role_id` int(11) unsigned DEFAULT NULL COMMENT '角色表id',
  `node_id` int(11) unsigned DEFAULT NULL COMMENT '节点表id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='角色与节点关联表';

-- ----------------------------
-- Records of mh_role_node
-- ----------------------------

-- ----------------------------
-- Table structure for `mh_user`
-- ----------------------------
DROP TABLE IF EXISTS `mh_user`;
CREATE TABLE `mh_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL COMMENT '用户名',
  `nick_name` varchar(30) DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  `tel` varchar(11) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `inc` int(10) unsigned DEFAULT '0' COMMENT '登陆次数',
  `last_logintime` varchar(10) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '上次登录时间',
  `add_time` varchar(11) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '注册时间',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态，0为删除，1为正常，2为禁用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表(user table)';

-- ----------------------------
-- Records of mh_user
-- ----------------------------

-- ----------------------------
-- Table structure for `mh_web`
-- ----------------------------
DROP TABLE IF EXISTS `mh_web`;
CREATE TABLE `mh_web` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT 'title，网站名称',
  `icon` varchar(100) DEFAULT NULL COMMENT '顶部导航拦图标路径',
  `logo` varchar(100) DEFAULT NULL COMMENT 'logo',
  `image` varchar(100) DEFAULT NULL COMMENT '微信二维码',
  `img` varchar(100) DEFAULT NULL COMMENT '关于我们的图片',
  `company_profile` varchar(2500) DEFAULT NULL COMMENT '公司简介',
  `keywords` varchar(1000) DEFAULT NULL COMMENT '网站关键字',
  `desc_` varchar(2500) DEFAULT NULL COMMENT '网站描述',
  `tel` varchar(15) DEFAULT NULL COMMENT '联系电话',
  `tel_1` varchar(15) DEFAULT NULL COMMENT '电话1',
  `weburl` varchar(45) DEFAULT NULL COMMENT '网址',
  `email` varchar(60) DEFAULT NULL COMMENT '联系邮箱',
  `address` varchar(255) DEFAULT NULL COMMENT '地址',
  `copyright` varchar(300) DEFAULT NULL COMMENT '底部版权信息',
  `add_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加时间',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '状态，1为使用中，2为未使用，0为删除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='wangzha网站信息表';

-- ----------------------------
-- Records of mh_web
-- ----------------------------
INSERT INTO `mh_web` VALUES ('1', '丰唐物联www.fantem.cn', '', 'title/2016-10-13/57ff28063c778.png', 'title/2016-10-13/57ff541e6261c.jpg', '', 'ss', 'Fantem,fantem,丰唐物联,丰唐', 'Fantem,fantem,丰唐物联,丰唐', '', null, '', '', '', '丰唐物联内网平台，是由我们自己打造的属于我们的信息平台。这里提供公司相关的新闻公告，内部通知，活动信息，以及各种通用及部门专用的培训资料。', '2016-10-26 11:34:27', '1');

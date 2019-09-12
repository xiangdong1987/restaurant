/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50727
Source Host           : 192.168.112.20:3306
Source Database       : restaurant

Target Server Type    : MYSQL
Target Server Version : 50727
File Encoding         : 65001

Date: 2019-09-12 18:33:15
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `admin`
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('3', 'xiangdong', '123', '1', '2019-09-12 17:56:39', '2019-09-12 17:56:39');
INSERT INTO `admin` VALUES ('4', 'xiangdong', '202cb962ac59075b964b07152d234b70', '1', '2019-09-12 17:59:08', '2019-09-12 17:59:08');

-- ----------------------------
-- Table structure for `dishes`
-- ----------------------------
DROP TABLE IF EXISTS `dishes`;
CREATE TABLE `dishes` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '菜品id',
  `name` varchar(50) DEFAULT NULL COMMENT '中文名',
  `name_it` varchar(200) DEFAULT NULL COMMENT '外文名',
  `price` float DEFAULT NULL COMMENT '价格',
  `discount` float DEFAULT NULL COMMENT '折扣',
  `freq` int(11) DEFAULT NULL COMMENT '被点次数',
  `scores` int(11) DEFAULT NULL COMMENT '评分',
  `category` int(11) DEFAULT NULL COMMENT '菜品分类',
  `status` int(11) DEFAULT NULL COMMENT '状态',
  `ctime` int(11) DEFAULT NULL COMMENT '创建时间',
  `utime` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dishes
-- ----------------------------

-- ----------------------------
-- Table structure for `log`
-- ----------------------------
DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `content` text,
  `ctime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of log
-- ----------------------------

-- ----------------------------
-- Table structure for `orders`
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '订单id',
  `table_id` int(11) DEFAULT NULL COMMENT '餐桌号',
  `status` int(11) DEFAULT NULL COMMENT '订单状态',
  `dish_num` int(11) DEFAULT NULL,
  `total_amount` float DEFAULT NULL COMMENT '总金额',
  `ctime` int(11) DEFAULT NULL COMMENT '创建时间',
  `utime` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orders
-- ----------------------------

-- ----------------------------
-- Table structure for `sub_orders`
-- ----------------------------
DROP TABLE IF EXISTS `sub_orders`;
CREATE TABLE `sub_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `dish_id` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `ctime` int(11) DEFAULT NULL,
  `utime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sub_orders
-- ----------------------------

-- ----------------------------
-- Table structure for `tables`
-- ----------------------------
DROP TABLE IF EXISTS `tables`;
CREATE TABLE `tables` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '桌号',
  `name` varchar(50) DEFAULT NULL COMMENT '名称',
  `people_num` int(11) DEFAULT NULL COMMENT '用餐人数',
  `max_people` int(11) DEFAULT NULL COMMENT '最大可用餐人数',
  `type` int(11) DEFAULT NULL COMMENT '类型 1 普通  2 包间',
  `status` int(11) DEFAULT NULL COMMENT '状态',
  `ctime` int(11) DEFAULT NULL COMMENT '创建时间',
  `utime` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tables
-- ----------------------------

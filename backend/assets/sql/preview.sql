/*
 Navicat Premium Data Transfer

 Source Server         : yaemart-network
 Source Server Type    : MySQL
 Source Server Version : 50640
 Source Host           : 47.75.66.30:3306
 Source Schema         : yaemart

 Target Server Type    : MySQL
 Target Server Version : 50640
 File Encoding         : 65001

 Date: 30/05/2018 15:05:41
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for preview
-- ----------------------------
DROP TABLE IF EXISTS `preview`;
CREATE TABLE `preview` (
  `preview_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '评审ID',
  `member2` varchar(30) DEFAULT NULL COMMENT '评审人',
  `product_id` varchar(20) DEFAULT NULL,
  `content` varchar(500) DEFAULT '' COMMENT '评审建议',
  `result` varchar(500) DEFAULT '' COMMENT '评审结果  0采样 1可开发  2拒绝（不合适不跟踪）',
  `priview_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '评审时间',
  `member_id` tinyint(1) DEFAULT NULL COMMENT '评审人ID',
  `ref_url1` varchar(5000) DEFAULT '' COMMENT 'Amazon低价网址',
  `ref_url2` varchar(5000) DEFAULT '' COMMENT 'eBay低价网址',
  `ref_url3` varchar(5000) DEFAULT '' COMMENT '1688低价网址',
  `ref_url4` varchar(5000) DEFAULT '' COMMENT '其他低价网址',
  `view_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'view状态  0 未评审 1 已评审',
  `saler_view_status` tinyint(1) DEFAULT '0' COMMENT '部长评审0 未评审 1 已评审',
  `submit_manager` tinyint(1) NOT NULL DEFAULT '0' COMMENT '提交评审 0未提交 1已提交',
  PRIMARY KEY (`preview_id`),
  UNIQUE KEY `product_id` (`product_id`,`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='评审记录表';

SET FOREIGN_KEY_CHECKS = 1;


DROP TABLE IF EXISTS `headman_preview`;
CREATE TABLE `headman_preview` (
  `preview_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '评审ID',
  `headman` varchar(30) DEFAULT NULL COMMENT '评审人',
  `product_id` varchar(20) DEFAULT NULL,
  `content` varchar(500) DEFAULT '' COMMENT '评审建议',
  `result` varchar(500) DEFAULT '' COMMENT '评审结果  0采样 1可开发  2拒绝（不合适不跟踪）',
  `priview_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '评审时间',
  `ref_url1` varchar(5000) DEFAULT '' COMMENT 'Amazon低价网址',
  `ref_url2` varchar(5000) DEFAULT '' COMMENT 'eBay低价网址',
  `ref_url3` varchar(5000) DEFAULT '' COMMENT '1688低价网址',
  `ref_url4` varchar(5000) DEFAULT '' COMMENT '其他低价网址',
  `view_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'view状态  0 未评审 1 已评审',
  `saler_view_status` tinyint(1) DEFAULT '0' COMMENT '部长评审0 未评审 1 已评审',
  `submit_manager` tinyint(1) NOT NULL DEFAULT '0' COMMENT '提交评审 0未提交 1已提交',
  PRIMARY KEY (`preview_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='评审记录表';
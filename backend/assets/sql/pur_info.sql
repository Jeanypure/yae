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

 Date: 30/05/2018 09:45:21
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for pur_info
-- ----------------------------
DROP TABLE IF EXISTS `pur_info`;
CREATE TABLE `pur_info` (
  `pur_info_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `purchaser` varchar(30) DEFAULT '',
  `pur_group` int(11) DEFAULT '0' COMMENT '序号',
  `pd_title` varchar(500) DEFAULT NULL COMMENT '中文简称',
  `pd_title_en` varchar(500) DEFAULT NULL COMMENT '中文简称',
  `pd_pic_url` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '图片',
  `pd_package` varchar(1000) DEFAULT NULL COMMENT '外包装',
  `pd_length` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '长cm',
  `pd_width` varchar(10) DEFAULT NULL COMMENT '宽cm',
  `pd_height` varchar(10) DEFAULT NULL COMMENT '高cm',
  `is_huge` tinyint(1) DEFAULT '0',
  `pd_weight` decimal(10,3) DEFAULT '0.000' COMMENT '货物实际重量kg',
  `pd_throw_weight` decimal(10,3) DEFAULT '0.000' COMMENT '抛重 长*宽*高/6000',
  `pd_count_weight` decimal(10,3) DEFAULT '0.000' COMMENT '计算重量',
  `pd_material` varchar(1000) DEFAULT NULL COMMENT '材质',
  `pd_purchase_num` int(11) NOT NULL DEFAULT '1' COMMENT '申请采购数量',
  `pd_pur_costprice` decimal(10,3) NOT NULL DEFAULT '0.000' COMMENT '含税价格',
  `has_shipping_fee` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否含运 0 否 1 是',
  `bill_type` varchar(10) DEFAULT NULL COMMENT '开票类型  --普票-- --专票--',
  `bill_tax_value` tinyint(4) DEFAULT NULL COMMENT '开票税率 --数字 并且小于16',
  `hs_code` varchar(60) DEFAULT NULL COMMENT 'HS编码',
  `bill_tax_rebate` tinyint(4) DEFAULT NULL COMMENT '退税率',
  `bill_rebate_amount` varchar(30) DEFAULT NULL COMMENT '退税金额',
  `no_rebate_amount` varchar(30) DEFAULT NULL COMMENT '预计销售不退税价格RMB',
  `retail_price` varchar(30) DEFAULT NULL COMMENT '预计销售价格$',
  `ebay_url` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT 'eBay最低价链接',
  `amazon_url` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT 'amazon最低价链接',
  `url_1688` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '1688最低价链接',
  `else_url` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '其他链接',
  `shipping_fee` varchar(30) DEFAULT NULL COMMENT '海运运费预估',
  `oversea_shipping_fee` varchar(30) DEFAULT NULL COMMENT '海外仓运运费预估',
  `transaction_fee` varchar(30) DEFAULT NULL COMMENT '成交费 销售金额的13%',
  `gross_profit` varchar(30) DEFAULT NULL COMMENT '预估毛利',
  `remark` varchar(2000) DEFAULT '' COMMENT '备注',
  `parent_product_id` int(11) DEFAULT '0' COMMENT '关联的母SKU ID',
  `source` tinyint(1) NOT NULL DEFAULT '1' COMMENT '商品来源  0销售推荐 1采购自主开发',
  `member` varchar(20) DEFAULT '' COMMENT '评审人',
  `preview_status` varchar(20) DEFAULT NULL COMMENT '评审状态',
  `brocast_status` varchar(30) DEFAULT NULL COMMENT '未公示 公示中 公示结束',
  `master_member` varchar(20) DEFAULT NULL COMMENT '经理组',
  `master_mark` varchar(200) DEFAULT NULL COMMENT '反馈意见',
  `master_result` varchar(200) DEFAULT NULL COMMENT '结果',
  `priview_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '评审时间',
  `ams_logistics_fee` decimal(10,3) DEFAULT NULL COMMENT 'amz物流计算费用',
  `is_submit` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否提交 0 UNCOMMITTED 1 COMMIT',
  `pd_create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '产品创建时间',
  `is_submit_manager` tinyint(1) NOT NULL DEFAULT '0' COMMENT '提交经理 0提交 1提交',
  PRIMARY KEY (`pur_info_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='采购信息表';

SET FOREIGN_KEY_CHECKS = 1;

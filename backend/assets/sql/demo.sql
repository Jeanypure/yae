CREATE TABLE `yae_freight` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `bill_to` varchar(200) NOT NULL COMMENT '付款方',
  `receiver` varchar(200) NOT NULL COMMENT '收款方',
  `shipment_id` varchar(200) NOT NULL DEFAULT '' COMMENT 'FBA单号',
  `pod` varchar(60) NOT NULL COMMENT '目的港',
  `pol` varchar(60) NOT NULL COMMENT '装货港',
  `remark` varchar(500) DEFAULT NULL COMMENT '备注',
  `image` varchar(200) DEFAULT NULL COMMENT '图片地址',
  `to_minister` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0 未提交 1 已提交',
  `to_financial` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0 未提交 1 已提交',
  `mini_deal` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0 未处理 1 已处理',
  `fina_deal` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0 未处理 1 已处理',
  `mini_res` varchar(200) DEFAULT NULL COMMENT '部长处理结果',
  `fina_res` varchar(200) DEFAULT NULL COMMENT '财务处理结果',
  `builder` varchar(60) DEFAULT NULL COMMENT '建单人',
  `build_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '建单时间',
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新时间',
  `payer` varchar(30) DEFAULT NULL COMMENT '付款人',
  `pay_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '付款时间',
  `etd` date NOT NULL DEFAULT '0000-00-00' COMMENT 'ETD',
  `eta` date NOT NULL DEFAULT '0000-00-00' COMMENT 'ETA',
  `contract_no` varchar(32) NOT NULL DEFAULT '' COMMENT '合同号',
  `debit_no` varchar(32) NOT NULL DEFAULT '' COMMENT '单号号',
  `fee_cateid` varchar(100) NOT NULL DEFAULT '' COMMENT '费用ID序列',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8


CREATE TABLE `freight_fee` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `freight_id` int(11) DEFAULT NULL COMMENT '外键',
  `description_id` tinyint(1) unsigned NOT NULL COMMENT 'fee_category的ID',
  `quantity` smallint(6) DEFAULT NULL COMMENT '数量',
  `unit_price` decimal(16,3) DEFAULT NULL COMMENT '单价',
  `currency` varchar(10) DEFAULT NULL COMMENT '币种',
  `amount` decimal(16,3) DEFAULT NULL COMMENT '金额',
  `remark` varchar(200) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `freight_id` (`freight_id`),
  CONSTRAINT `freight_fee_ibfk_1` FOREIGN KEY (`freight_id`) REFERENCES `yae_freight` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
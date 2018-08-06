CREATE TABLE `goodssku` (
  `sku_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '产品ID',
  `sku` varchar(60) NOT NULL DEFAULT '',
  `declared_value` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '申报价值',

  `sku_mark` varchar(100) NOT NULL DEFAULT '' COMMENT '备注',
  `pur_info_id` int(11) NOT NULL DEFAULT '0' COMMENT 'pur_info_id表主键',
  PRIMARY KEY (`sku_id`),
  KEY `pur_info_id` (`pur_info_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='产品档案';


-- purchasing-commission
CREATE table  `purchaser_commission`(
`commission_id` INT(11) NOT NULL  PRIMARY KEY AUTO_INCREMENT COMMENT 'ID',
`pur_info_id` int(11) default  null  COMMENT '产品id',
`has_arrival` TINYINT(1) unsigned  NOT NULL DEFAULT 0 COMMENT '是否到货 0 未到 1已到货',
`arrival_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '标记到货时间',
`write_date` varchar(10) not null  default '1970-01-01'  COMMENT '到货日期',
`minister_result` TINYINT(1) UNSIGNED NOT NULL  DEFAULT 0 COMMENT '部长产品判断 0简单重复 1半价产品 2新品  3推送产品 4未判断',
`minister_reson` varchar(100) not  null  default '' comment '部长备注',
`minister_extract` decimal(10,1) not  null  default '0.0' comment '部长计算提成',
`audit_group_result` TINYINT(1) UNSIGNED NOT NULL  DEFAULT 0 COMMENT '审核组产品判断 0简单重复 1半价产品 2新品 3推送产品 4未判断',
`audit_group_reson` varchar(100) not  null  default '' comment '审核组备注',
`audit_group_extract` decimal(10,1) not  null  default '0.0' comment '审核组计算提成',
`weight` decimal(10,1) not  null  default '0.0' comment '权重 0个 0.5个 1个',

)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='采购到货提成表';
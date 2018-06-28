
CREATE TABLE `company`(
`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT '公司ID',
`sub_company` varchar(100) default '' COMMENT '子公司名字',
`department` varchar(100) default '' COMMENT '部门',
`leader` varchar(100) default '' COMMENT '部长',
`memo` varchar(500) default '' COMMENT '备注'

)ENGINE=InnoDB DEFAULT CHARSET =utf8

CREATE TABLE `yae_freight` (
`id` int(11) not  null  primary  key  AUTO_INCREMENT COMMENT 'ID',
`bill_to` varchar (200) not  null  comment '付款方',
`receiver` varchar (200) not  null  comment '收款方',
`shipment_id` varchar (100) not  null comment '货单号' ,
`pod` varchar (60) not  null comment '目的港' ,
`pol` varchar (60) not  null comment '装货港' ,
`etd` timestamp  comment '预计离泊时间',
`eta` timestamp  comment '预计到达时间',
`remark` varchar(500)  comment '备注',

)ENGINE=InnoDB default  charset =utf8


--
-- 海运费 ocean_freight
-- 关税   tariff
-- 车架费 frame_fee
-- 预提费 advance_fee
-- 国外仓租 foreign_rent
-- 滞箱费     demurrage
-- 超时等候费  overtime_fee Overtime waiting fee
-- 周末送货费   weekend_fee Weekend delivery fee
-- 落箱费 discharge container fee
-- 超重许可 Overweight license
-- 其他费用
-- 备注



CREATE TABLE fee_category(
`id` smallint (6) unsigned not  null  primary key AUTO_INCREMENT comment 'ID',
`name_en` varchar (100) not  null comment '英文名',
`name_zn` varchar (100) not  null comment '中文名',
`remark` varchar (200) not  null comment '备注'
  )ENGINE=InnoDB default  charset =utf8



  CREATE TABLE  `freight_fee`(
  `id` int not  null  primary key AUTO_INCREMENT comment 'ID',
  `freight_id` int not  null  primary key AUTO_INCREMENT comment '外键',
  `description_id` tinyint(1) unsigned  not  null comment 'fee_category的ID',
  `quantity` smallint(6)  comment '数量',
  `unit_price` decimal (16,3)  comment '单价',
  `currency` varchar(10) comment '币种',
  `amount` decimal (16,3) comment '金额',
  `ramark` varchar(100) comment '备注',
  foreign key(freight_id) references yae_freight(id)
  )ENGINE=InnoDB default  charset =utf8


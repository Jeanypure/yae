
CREATE TABLE `company`(
`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT '公司ID',
`sub_company` varchar(100) default '' COMMENT '子公司名字',
`department` varchar(100) default '' COMMENT '部门',
`leader` varchar(100) default '' COMMENT '部长',
`memo` varchar(500) default '' COMMENT '备注'

)ENGINE=InnoDB DEFAULT CHARSET =utf8
ALTER PROCEDURE [dbo].[oaP_statuscount]
@username varchar(20)
AS
BEGIN
SET nocount ON

SELECT a.item_name as role into #roles FROM [user] AS u LEFT JOIN [auth_assignment] AS a ON a.user_id = u.id WHERE u.username = @username

--2017-11-08 James Ôö¼ÓÓÃ»§q


-- ²éÑ¯ÓÃ»§¹ÜÏ½ÏÂµÄÓÃ»§
create table #users(username varchar(20))
 --EXECUTE oa_P_users @username into #Users

insert into #users EXECUTE oa_P_users @username
--²úÆ·ÍÆ¼ö¼ÆÊý
select '²úÆ·ÍÆ¼ö' as moduletype,count(*) as num into #tmpinfo FROM oa_goods WHERE checkStatus='Î´ÈÏÁì'

--ÕýÏò¿ª·¢
insert into #tmpinfo
select 'ÕýÏò¿ª·¢',count(*) FROM oa_goods WHERE devStatus='ÕýÏòÈÏÁì' AND ( checkStatus='ÒÑÈÏÁì'  OR checkStatus='´ýÌá½»')
AND EXISTS(select * from #users as ur where ur.username=oa_goods.developer)


--ÄæÏò¿ª·¢
insert into #tmpinfo
select 'ÄæÏò¿ª·¢',count(*) FROM oa_goods WHERE  devStatus='ÄæÏòÈÏÁì' AND ( checkStatus='ÒÑÈÏÁì'  OR checkStatus='´ýÌá½»')
AND EXISTS(select * from #users as ur where ur.username=oa_goods.developer)


--´ýÉóÅú
insert into #tmpinfo
select '´ýÉóÅú',count(*) FROM oa_goods WHERE  checkStatus='´ýÉóÅú'   AND EXISTS(select * from #users as ur where ur.username=oa_goods.developer)

--ÒÑÉóÅú
insert into #tmpinfo
select 'ÒÑÉóÅú',count(*) FROM oa_goods WHERE  checkStatus='ÒÑÉóÅú' AND EXISTS(select * from #users as ur where ur.username=oa_goods.developer)

--Î´Í¨¹ý
insert into #tmpinfo
select 'Î´Í¨¹ý',count(*) FROM oa_goods WHERE  checkStatus='Î´Í¨¹ý'  AND EXISTS(select * from #users as ur where ur.username=oa_goods.developer)

--ÊôÐÔÐÅÏ¢
insert into #tmpinfo
select 'ÊôÐÔÐÅÏ¢',count(*) FROM oa_goodsinfo WHERE  achieveStatus='´ý´¦Àí'  AND EXISTS(select * from #users as ur where ur.username=oa_goodsinfo.developer)

--Í¼Æ¬ÐÅÏ¢
--select 'Í¼Æ¬ÐÅÏ¢',count(*) FROM oa_goodsinfo WHERE  picStatus='´ý´¦Àí' AND EXISTS(select * from #users as ur where ur.username=oa_goodsinfo.developer)
insert into #tmpinfo select 'Í¼Æ¬ÐÅÏ¢',count(*) FROM oa_goodsinfo WHERE  picStatus='´ý´¦Àí' AND EXISTS
(select * from #users as ur where ur.username=oa_goodsinfo.possessMan1 or ur.username=oa_goodsinfo.developer)


--Æ½Ì¨ÐÅÏ¢
--select 'Æ½Ì¨ÐÅÏ¢',count(*) FROM oa_goodsinfo WHERE  picStatus='ÒÑÍêÉÆ' AND EXISTS(select * from #users as ur where ur.username=oa_goodsinfo.developer)
--2018-02-08ÐÞ¸Ä
IF '³¬¼¶¹ÜÀíÔ±' in (select role from  #roles )
BEGIN
insert into #tmpinfo select 'Æ½Ì¨ÐÅÏ¢',count(*) FROM oa_goodsinfo WHERE  picStatus='ÒÑÍêÉÆ' AND ISNULL(completeStatus, '')='' AND EXISTS(select * from #users as ur where ur.username=oa_goodsinfo.developer)
END
ELSE IF  '²úÆ·¿ª·¢' in (select role from  #roles ) or 'wishÏúÊÛ'  in (select role from  #roles )
BEGIN
insert into #tmpinfo select 'Æ½Ì¨ÐÅÏ¢',count(*) FROM oa_goodsinfo WHERE  picStatus='ÒÑÍêÉÆ' AND ISNULL(completeStatus, '') NOT LIKE '%WishÒÑÍêÉÆ%' AND EXISTS(select * from #users as ur where ur.username=oa_goodsinfo.developer)
END
ELSE IF  'eBayÏúÊÛ' in (select role from  #roles )
BEGIN
insert into #tmpinfo select 'Æ½Ì¨ÐÅÏ¢',count(*) FROM oa_goodsinfo WHERE  picStatus='ÒÑÍêÉÆ' AND ISNULL(completeStatus, '') NOT LIKE '%eBayÒÑÍêÉÆ%' AND EXISTS(select * from #users as ur where ur.username=oa_goodsinfo.developer)
END
ELSE
BEGIN
insert into #tmpinfo select 'Æ½Ì¨ÐÅÏ¢',count(*) FROM oa_goodsinfo WHERE  picStatus='ÒÑÍêÉÆ' AND EXISTS(select * from #users as ur where ur.username=oa_goodsinfo.developer)
END


--²úÆ·Ä£°å
insert into #tmpinfo
select '²úÆ·ÖÐÐÄ',count(*) FROM oa_goodsinfo WHERE  completeStatus !='' AND EXISTS(select * from #users as ur where ur.username=oa_goodsinfo.developer)


--ÈÎÎñÖÐÐÄ
insert into #tmpinfo
select 'ÈÎÎñÖÐÐÄ',count(*) FROM oa_task t LEFT JOIN oa_taskSendee ts ON t.taskid=ts.taskid LEFT JOIN [user] u ON ts.userid = u.id
	WHERE  u.username=@username AND ts.status=''




SELECT * FROM #tmpinfo


drop table #users
drop table #tmpinfo
Drop table #roles

END


SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS  `pd_SKU`;
CREATE TABLE `pd_SKU` (
`pd_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
`product_sku` varchar(60) DEFAULT NULL COMMENT '产品SKU',
`product_code` varchar(32) DEFAULT NULL COMMENT '产品代码',
`product_title` varchar(100) DEFAULT NULL COMMENT '产品名称',
`product_title_en` varchar(100) DEFAULT NULL COMMENT '产品英文名称',
`product_category` varchar(10) DEFAULT NULL COMMENT '品类',
`pd_weight` decimal(10,3) DEFAULT '0.000' COMMENT '重量',
`pd_height` varchar(10) DEFAULT NULL COMMENT '高',
`pd_width` varchar(10) DEFAULT NULL COMMENT '宽',
`pd_length` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '长',
`pd_declare_name_en` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '英文申报名',
`pd_declare_name_cn` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '中文申报名',
`pd_declare_value` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '申报价值',
`pd_declare_currency_code` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '申报币种',
`pd_costprice` decimal(10,3) NOT NULL DEFAULT '0.000' COMMENT '采购价',
`pd_costprice_code` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '采购币种',
`default_supplier_code` varchar(32) NOT NULL DEFAULT '' COMMENT '默认供应商',
`pd_vendor_code` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '默认供应商代码',
`pd_sale_price` decimal(10,3) NOT NULL DEFAULT '0.000' COMMENT '销售价格',
`suggest_price_currency_code` varchar(20) DEFAULT NULL COMMENT '建议售价币种',
`pd_fare` decimal(10,2) DEFAULT NULL COMMENT '销售运费',
`pd_reason` varchar(216) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '开发建立原因',
`pd_origin_addr` varchar(216) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '供应商产品地址',
`pd_origin_code` varchar(216) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '供应商品号',
`pd_property_code` varchar(216) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '款式代码',
`is_end_product` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否是成品 0 否 1 是',
`opration_type` tinyint(1) NOT NULL DEFAULT '2' COMMENT '运营方式 1：代运营 2：自运营',
`labeling_type` int(11) NOT NULL DEFAULT '0' COMMENT '贴标容易度;1-简单;2-普通；3-困难',
`pd_sale_status` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '销售状态',
`seller_responsible_id` int(11) DEFAULT '0' COMMENT '销售负责人',
`develop_responsible_id` int(11) DEFAULT '0' COMMENT '开发负责人',
`puc_id` varchar(500) NOT NULL DEFAULT '0' COMMENT '自定义分类，对应product_user_category',
`pd_ischeck_qty` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否是需要质检 0 否 1 是',
`pd_declaration_statement` varchar(64) NOT NULL DEFAULT '' COMMENT '申报说明，关于申报信息上的扩展，如在此块填写HTS CODE',
`contain_battery` tinyint(1) NOT NULL DEFAULT '0' COMMENT '含电池:  0,不含 1:含',
`is_imitation` tinyint(1) DEFAULT '0' COMMENT '是否为仿制品 0 否 1 是',
`pd_min_purchase_num` int(11) NOT NULL DEFAULT '1' COMMENT '最小采购数',
`pd_get_days` int(11) NOT NULL DEFAULT '1' COMMENT '交期',
`pd_desc_zn` text COMMENT '中文描述',
`pd_desc_en` text COMMENT '英文描述',
`pd_net_weight` decimal(10,3) NOT NULL DEFAULT '0.000' COMMENT '净重(KG)',
`pd_ean_code` varchar(255) NOT NULL DEFAULT '' COMMENT 'EAN码',
`pu_code` varchar(5) DEFAULT NULL COMMENT '产品单位EA(单个) KG(公斤) MT(米) CASE(盒) PC(件) SET(套)',
`parent_product_id` int(11) DEFAULT '0' COMMENT '关联的母SKU ID',
PRIMARY KEY (`pd_id`),
KEY `product_sku` (`product_sku`),
KEY `puc_id` (`puc_id`),
KEY `product_category` (`product_category`),
KEY `parent_product_id` (`parent_product_id`),
KEY `product_code` (`product_code`) USING BTREE,
) ENGINE=InnoDB AUTO_INCREMENT=3785 DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;

GRANT ALL PRIVILEGES ON *.* TO 'root'@'47.75.66.30' IDENTIFIED BY '123456' WITH GRANT OPTION;
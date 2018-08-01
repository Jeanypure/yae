BEGIN
-- 判断这个ID 此item 是新记录 还是旧记录
	DECLARE c_num int;
	SELECT COUNT(*)  INTO c_num FROM `pur_info`
	WHERE `source`=0  AND `parent_product_id`=@id;

if c_num = 0  -- 新纪录
then

	-- 是新记录 插入

				 INSERT INTO `pur_info`
				 (parent_product_id,pd_title_en,pd_title,amazon_url,ebay_url,url_1688,pd_pic_url,source,purchaser,preview_status,pur_group)

					SELECT
						 @id,
						 t.`product_title_en`,
						 t.`product_title`,
							t.`ref_url1`,
							t.`ref_url2`,
							t.`ref_url3`,
							t.`pd_pic_url`,
						 '0',
						 t.`purchaser`,
						 '0',
						 `sub_company`
					FROM `product` t WHERE t.`product_id`= @id;

	 -- 旧记录 就更新
ELSE       -- 旧记录 做更新

		UPDATE `pur_info` o
		INNER JOIN (SELECT`product_id`,`purchaser` FROM `product`) t on o.`parent_product_id`=t.`product_id`
		set  o.`purchaser` = t.`purchaser`,o.`preview_status`='0'
		WHERE o.`parent_product_id`= @id;




END IF;

END
<?php
/**
 * Created by PhpStorm.
 * User: jenny
 * Date: 2018/6/1
 * Time: 下午4:25
 */

namespace backend\modules\yaedata\controllers;

use backend\models\Purchaser;
use Yii;
use yii\web\Controller;
use yii\data\SqlDataProvider;


class PurchaserDataController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * @return string
     * 按时间统计产品开发 拿样 拒绝 需议价等状态产品占比
     */
    public function actionMasterResult(){

        if (!empty($_POST)&&isset($_POST)){
            $date_range = $_POST['date_range_3'];
            $date_arr = explode(' - ',$date_range);
            $sql = "
              SELECT 
            purchaser,
            SUM(CASE WHEN master_result=0 THEN number ELSE 0 END) AS 'reject', 
            SUM(CASE WHEN master_result=1 THEN number ELSE 0 END) AS 'get', 
            SUM(CASE WHEN master_result=2 THEN number ELSE 0 END) AS 'need',
            SUM(CASE WHEN master_result=3 THEN number ELSE 0 END) AS 'undo',
            SUM(CASE WHEN master_result=4 THEN number ELSE 0 END) AS 'direct',
            SUM(CASE WHEN master_result=5 THEN number ELSE 0 END) AS 'season'
            
            FROM ( SELECT
            purchaser,
            master_result,
            count(*) AS number
            FROM
            pur_info
            WHERE   
            is_submit = 1 and purchaser_send_time between '$date_arr[0]' and '$date_arr[1]'
            GROUP BY
            master_result,purchaser
            ) bb
            GROUP BY purchaser
            ORDER BY SUM(CASE WHEN master_result=1 THEN number ELSE 0 END) DESC";
            $own_sql =  "
              SELECT 
            purchaser,
            SUM(CASE WHEN master_result=0 THEN number ELSE 0 END) AS 'reject', 
            SUM(CASE WHEN master_result=1 THEN number ELSE 0 END) AS 'get', 
            SUM(CASE WHEN master_result=2 THEN number ELSE 0 END) AS 'need',
            SUM(CASE WHEN master_result=3 THEN number ELSE 0 END) AS 'undo',
            SUM(CASE WHEN master_result=4 THEN number ELSE 0 END) AS 'direct',
            SUM(CASE WHEN master_result=5 THEN number ELSE 0 END) AS 'season'
            
            FROM ( SELECT
            purchaser,
            master_result,
            count(*) AS number
            FROM
            pur_info
            WHERE   
            is_submit = 1 and purchaser_send_time between '$date_arr[0]' and '$date_arr[1]' 
            and source = 1
            GROUP BY
            master_result,purchaser
            ) bb
            GROUP BY purchaser
            ORDER BY SUM(CASE WHEN master_result=1 THEN number ELSE 0 END) DESC";
            $source_sql = "
              SELECT o.purchaser ,count(*) as commit_num ,IFNULL(uncommit_num,0) as uncommit_num ,p.reject, p.get , p.need , p.undo , p.direct , p.season  
                FROM pur_info o 
                LEFT JOIN 
                (SELECT purchaser ,count(*) as uncommit_num  FROM pur_info o WHERE source=0 AND is_submit=0 and purchaser_send_time between '$date_arr[0]' and '$date_arr[1]'  GROUP BY purchaser ) u
                ON u.purchaser = o.purchaser
                LEFT JOIN 
                ( 
                    SELECT 
                    purchaser,
                    SUM(CASE WHEN master_result=0 THEN number ELSE 0 END) AS 'reject', 
                    SUM(CASE WHEN master_result=1 THEN number ELSE 0 END) AS 'get', 
                    SUM(CASE WHEN master_result=2 THEN number ELSE 0 END) AS 'need',
                    SUM(CASE WHEN master_result=3 THEN number ELSE 0 END) AS 'undo',
                    SUM(CASE WHEN master_result=4 THEN number ELSE 0 END) AS 'direct',
                    SUM(CASE WHEN master_result=5 THEN number ELSE 0 END) AS 'season'
                    FROM ( SELECT
                    purchaser,
                    master_result,
                    count(*) AS number
                    FROM
                    pur_info
                    WHERE 
                     source=0 and purchaser_send_time between '$date_arr[0]' and '$date_arr[1]'
                    GROUP BY 
                    master_result,purchaser
                    ) bb
                    GROUP BY purchaser 
                ) p ON p.purchaser=o.purchaser
                
                WHERE o.source=0 and (purchaser_send_time between '$date_arr[0]' and '$date_arr[1]') GROUP BY  o.purchaser  ORDER BY uncommit_num desc";
        } else {
            // -- 产品拒绝率 采样率 采购率统计
            $sql = "
              SELECT 
            purchaser,
            SUM(CASE WHEN master_result=0 THEN number ELSE 0 END) AS 'reject', 
            SUM(CASE WHEN master_result=1 THEN number ELSE 0 END) AS 'get', 
            SUM(CASE WHEN master_result=2 THEN number ELSE 0 END) AS 'need',
            SUM(CASE WHEN master_result=3 THEN number ELSE 0 END) AS 'undo',
            SUM(CASE WHEN master_result=4 THEN number ELSE 0 END) AS 'direct',
            SUM(CASE WHEN master_result=5 THEN number ELSE 0 END) AS 'season'
            
            FROM ( SELECT
            purchaser,
            master_result,
            count(*) AS number
            FROM
            pur_info
            WHERE   
            is_submit = 1
            GROUP BY
            master_result,purchaser
            ) bb
            GROUP BY purchaser
            ORDER BY SUM(CASE WHEN master_result=1 THEN number ELSE 0 END) DESC";
            $own_sql = "
              SELECT 
            purchaser,
            SUM(CASE WHEN master_result=0 THEN number ELSE 0 END) AS 'reject', 
            SUM(CASE WHEN master_result=1 THEN number ELSE 0 END) AS 'get', 
            SUM(CASE WHEN master_result=2 THEN number ELSE 0 END) AS 'need',
            SUM(CASE WHEN master_result=3 THEN number ELSE 0 END) AS 'undo',
            SUM(CASE WHEN master_result=4 THEN number ELSE 0 END) AS 'direct',
            SUM(CASE WHEN master_result=5 THEN number ELSE 0 END) AS 'season'
            
            FROM ( SELECT
            purchaser,
            master_result,
            count(*) AS number
            FROM
            pur_info
            WHERE   
            is_submit = 1 and  source =1
            GROUP BY
            master_result,purchaser
            ) bb
            GROUP BY purchaser
            ORDER BY SUM(CASE WHEN master_result=1 THEN number ELSE 0 END) DESC";
            $source_sql = "
              SELECT o.purchaser ,count(*) as commit_num ,IFNULL(uncommit_num,0) as uncommit_num ,p.reject, p.get , p.need , p.undo , p.direct , p.season  
                FROM pur_info o 
                LEFT JOIN 
                (SELECT purchaser ,count(*) as uncommit_num  FROM pur_info o WHERE source=0 AND is_submit=0 GROUP BY purchaser ) u
                ON u.purchaser = o.purchaser
                LEFT JOIN 
                ( 
                    SELECT 
                    purchaser,
                    SUM(CASE WHEN master_result=0 THEN number ELSE 0 END) AS 'reject', 
                    SUM(CASE WHEN master_result=1 THEN number ELSE 0 END) AS 'get', 
                    SUM(CASE WHEN master_result=2 THEN number ELSE 0 END) AS 'need',
                    SUM(CASE WHEN master_result=3 THEN number ELSE 0 END) AS 'undo',
                    SUM(CASE WHEN master_result=4 THEN number ELSE 0 END) AS 'direct',
                    SUM(CASE WHEN master_result=5 THEN number ELSE 0 END) AS 'season'
                    FROM ( SELECT
                    purchaser,
                    master_result,
                    count(*) AS number
                    FROM
                    pur_info
                    WHERE 
                     source=0 
                    GROUP BY 
                    master_result,purchaser
                    ) bb
                    GROUP BY purchaser 
                ) p ON p.purchaser=o.purchaser
                
                WHERE o.source=0  GROUP BY  o.purchaser  ORDER BY uncommit_num desc";
        }


        $dataProvider = new SqlDataProvider([
            'sql' => $sql,
        ]);
        $dataProvider2 = new SqlDataProvider([
            'sql' => $source_sql,
        ]);
        $dataProvider3 = new SqlDataProvider([
            'sql' => $own_sql,
        ]);

        return $this->render('result',[
            'dataProvider' => $dataProvider,
            'dataProvider2' => $dataProvider2,
            'dataProvider3' => $dataProvider3,
        ]);


    }

}
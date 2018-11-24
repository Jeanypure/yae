<?php
namespace backend\commands\tasks;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;

class TestController extends Controller
{
    /**
     * @return int Exit code
     */
    public function actionIndex()
    {
        sleep(1);
        echo "我是index方法\n";
        return ExitCode::OK;
    }

    /**
     * @return int Exit code
     */
    public function actionTest()
    {
        sleep(2);
        echo "我是test方法\n";
        return ExitCode::OK;
    }

}
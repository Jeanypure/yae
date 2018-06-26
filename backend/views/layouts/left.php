<?php
use mdm\admin\components\MenuHelper;

$sql = "select
'经理评审' as task_name,
count(*) as task_num
FROM pur_info WHERE audit_a=1 AND audit_b=1 AND preview_status=0 ";
$status_result = yii::$app->db->createCommand($sql)->queryAll();
$status_map = [];
foreach ($status_result as $res){
    $status_map[$res['task_name']] = $res['task_num'];
}

$callback = function($menu){
    $data = json_decode($menu['data'], true);
    $items = $menu['children'];
    $return = [
        'label' => $menu['name'],
        'url' => [$menu['route']],
    ];
    //处理我们的配置
    if ($data) {
        //visible
        isset($data['visible']) && $return['visible'] = $data['visible'];
        //icon
        isset($data['icon']) && $data['icon'] && $return['icon'] = $data['icon'];
        //other attribute e.g. class...
        $return['options'] = $data;
    }
    //没配置图标的显示默认图标
    (!isset($return['icon']) || !$return['icon']) && $return['icon'] = 'circle-o';
    $items && $return['items'] = $items;
    return $return;
};
?>



<aside class="main-sidebar">

    <section class="sidebar">


        <?= dmstr\widgets\Menu::widget(
            [

                'options' => ['class' => 'sidebar-menu','data-widget' => 'tree'],
                'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id,null,$callback),
            ]
        ) ?>

    </section>

</aside>

<?php
//注册JS 为每个模块加数量
$JS = <<< JS
//找到产品推荐模块并追加<span>
    $("a span:contains('经理评审')").after('<sup class="label label-info">{$status_map["经理评审"]}</sup>');
    
JS;
$this->registerJs($JS);

?>


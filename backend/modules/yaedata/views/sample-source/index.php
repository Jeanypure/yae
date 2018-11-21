<?php
/**
 * Created by PhpStorm.
 * User: YM-sale
 * Date: 2018/7/24
 * Time: 9:34
 */
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\daterange\DateRangePicker;
use kartik\widgets\ActiveForm;

?>
<?php
    $form = ActiveForm::begin();
echo '<div class="row">';
echo '<div class="col-md-4"><label class="control-label">Date Range</label>';
echo '<div class="drp-container">';
echo DateRangePicker::widget([
    'name'=>'date_range_3',
    'value'=>date('Y-m-d',strtotime('-29 day')) . ' - '. date('Y-m-d') ,
    'presetDropdown'=>true,
    'hideInput'=>true
]);
echo '</div></div>';

?>
<div class="col-md-4">

    <?php
        echo  Html::button('查询', ['id' => 'date-str', 'class' => 'btn btn-primary '])
         ;?>

</div>
</div>

<?php ActiveForm::end(); ?>
<?php
$sample_source = Url::toRoute('sample');
$js = <<< JS
//设置背景色
$('body').css('background','#FFF');
//删除H3
// $('h1').remove();
$('h3').remove();
        $(function () {
               
                $.ajax({
                    url:'{$sample_source}', 
                    success:function (data) {
                        // var da = JSON.parse(data);  //推荐方法
                        console.log(data);
                      sample_chart(data,'sample');
                      sample_chart(data,'purchase');
                     
                    }
                });
            }); 
            
		$(document).on('ajaxStart', function(){
			$('.loading').show();
			return false;
		});
		$(document).on('ajaxComplete',function(e,x,o){
			$('.loading').hide();
			return false;
		});
JS;
$this->registerJs($js);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!-- 引入 echarts.js -->
    <script src="https://cdn.bootcss.com/echarts/4.1.0.rc2/echarts-en.common.js"></script>
</head>

<body>


<div class="row">
    <div class="col-lg-6 col-md-3">
        <h2>采购拿样来源</h2>
        <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
        <div id="sample" style="width: 900px;height:600px;"></div>
    </div>

    <div class="col-lg-6 col-md-3">
        <h2>新品确定采购个数</h2>
        <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
        <div id="purchase" style="width: 900px;height:600px;"></div>
    </div>
</div>
<!-- 为 ECharts 准备一个具备大小（宽高）的 DOM -->


<script>
    function  sample_chart(sample_data,type_id) {
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById(type_id));
        console.log(type_id);
        var data = eval("(" + sample_data + ")");
        var purchase,result,resultType;
        purchase = data.purchase;
        result = data.num[type_id];
        resultType = (type_id=='sample')?'拿样':'采购';
        option = {
            tooltip: {
                trigger: 'item',
                formatter: "{a} <br/>{b}: {c} ({d}%)"
            },
            legend: {
                orient: 'vertical',
                x: 'left',
                data:purchase,
            },
            series: [
                {
                    name: resultType+'产品',
                    type:'pie',
                    selectedMode: 'single',
                    radius: [0, '30%'],

                    label: {
                        normal: {
                            position: 'inner'
                        }
                    },
                    labelLine: {
                        normal: {
                            show: false
                        }
                    },
                    data:
                        [
                            /* {value:335, name:'直达', selected:true},
                             {value:679, name:'营销广告'},
                             {value:1548, name:'搜索引擎'}*/
                        ]
                },
                {
                    name:resultType+'来源',
                    type:'pie',
                    radius: ['40%', '55%'],
                    label: {
                        normal: {
                            formatter: '{a|{a}}{abg|}\n{hr|}\n  {b|{b}：}{c}  {per|{d}%}  ',
                            backgroundColor: '#eee',
                            borderColor: '#aaa',
                            borderWidth: 1,
                            borderRadius: 4,
                            // shadowBlur:3,
                            // shadowOffsetX: 2,
                            // shadowOffsetY: 2,
                            // shadowColor: '#999',
                            // padding: [0, 7],
                            rich: {
                                a: {
                                    color: '#999',
                                    lineHeight: 22,
                                    align: 'center'
                                },
                                // abg: {
                                //     backgroundColor: '#333',
                                //     width: '100%',
                                //     align: 'right',
                                //     height: 22,
                                //     borderRadius: [4, 4, 0, 0]
                                // },
                                hr: {
                                    borderColor: '#aaa',
                                    width: '100%',
                                    borderWidth: 0.5,
                                    height: 0
                                },
                                b: {
                                    fontSize: 16,
                                    lineHeight: 33
                                },
                                per: {
                                    color: '#eee',
                                    backgroundColor: '#334455',
                                    padding: [2, 4],
                                    borderRadius: 2
                                }
                            }
                        }
                    },
                    data: result
                }
            ]
        };
        myChart.setOption(option);
    }
</script>

</body>
</html>

<?php
$submit = Url::toRoute('sample');
$submit_date =<<<JS
    $('#date-str').on('click',function() {
         var button = $(this);
            button.attr('disabled','disabled');
            var date_range = $("#w1").val();
            $.ajax({
            url:'{$submit}',
            type:'post',
            data:{date_range_2:date_range},
            success:function(res){
                 var da = JSON.parse(res);  //推荐方法
                 if(da.success=='200OK') alert(da.msg);
                 sample_chart(res);
                button.attr('disabled',false);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                button.attr('disabled',false);
            }
            });
    });
JS;

$this->registerJs($submit_date);

?>

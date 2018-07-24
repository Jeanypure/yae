<?php
/**
 * Created by PhpStorm.
 * User: YM-sale
 * Date: 2018/7/24
 * Time: 9:34
 */
use yii\helpers\Url;
use kartik\daterange\DateRangePicker;
use kartik\widgets\ActiveForm;
$form = ActiveForm::begin();
// DateRangePicker with ActiveForm and model. Check the `required` model validation for
// the attribute. This also features configuration of Bootstrap input group addon.
//echo $form->field($model, 'create_date', [
//    'addon'=>['prepend'=>['content'=>'<i class="glyphicon glyphicon-calendar"></i>']],
//    'options'=>['class'=>'drp-container form-group']
//])->widget(DateRangePicker::classname(), [
//    'useWithAddon'=>true
//]);

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
                      sample_chart(data);
                     
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/4.1.0/echarts-en.common.js"></script>
</head>

<body>
<div class="row">
    <h4>评审时间</h4>


</div>
<div class="row">
    <div id="pie-nest" style="width: 1000px;height:600px;"></div>


</div>
<!-- 为 ECharts 准备一个具备大小（宽高）的 DOM -->


<script>
    function  sample_chart(sample_data) {
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('pie-nest'));
        var data = eval("(" + sample_data + ")");
        var status,result;
        status = data.status;
        result = data.num;
        option = {
            tooltip: {
                trigger: 'item',
                formatter: "{a} <br/>{b}: {c} ({d}%)"
            },
            legend: {
                orient: 'vertical',
                x: 'left',
                data:status
            },
            series: [
                {
                    name:'拿样产品',
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
                    name:'拿样来源',
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

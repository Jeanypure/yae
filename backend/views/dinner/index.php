<?php
use yii\helpers\Url;
/* @var $this yii\web\View */
$total = Url::toRoute('total');
$js = <<< JS
//设置背景色
$('body').css('background','#FFF');
//删除H1
$('h1').remove();
        $(function () {
                $.ajax({
                    url:'{$total}', 
                    success:function (data) {
                        // alert(data);
                       // var da = JSON.parse(data);  //推荐方法
                      init_chart('main_food',data);
                    
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
<h1>dinner/index</h1>

<head>
    <meta charset="utf-8">
    <title>ECharts</title>
    <!-- 引入 echarts.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/4.1.0/echarts-en.common.js"></script>
</head>
<body>
<!-- 为ECharts准备一个具备大小（宽高）的Dom -->
<div id="main_food" style="width: 600px;height:400px;"></div>
    <script type="text/javascript">
        var itemStyle = {
            //柱形图圆角，鼠标移上去效果，如果只是一个数字则说明四个参数全部设置为那么多
            emphasis: {
                barBorderRadius: [8, 8, 8, 8]
            },
        };
    </script>
    <script type="text/javascript">
        function init_chart(id,row_data){
        console.log(id);
        console.log(row_data);
        var myChart = echarts.init(document.getElementById(id));
        var data = eval("(" + row_data + ")");
        console.log(data);
        // 指定图表的配置项和数据
        var option = {
            title: {
                text: 'Yae*mart Dinner'
            },
            tooltip: {
                borderRadius:5,
            },
            legend: {
                data:['点单量']
            },
            xAxis: {
                // data: ["衬衫","羊毛衫","雪纺衫","裤子","高跟鞋","袜子"]
                data: data['food_name']
            },
            yAxis: {},
            series: [{
                name: '点单量',
                type: 'bar',
                itemStyle: itemStyle,

                // data: [5, 20, 36, 10, 10, 20]
                data: data['number']
            }]
        };

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);


        }

    </script>


</body>
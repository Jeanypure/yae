<?php
/**
 * Created by PhpStorm.
 * User: YM-sale
 * Date: 2018/6/22
 * Time: 14:00
 */
use yii\helpers\Url;

$this->title = '状态分布';
$cat = Url::toRoute('compute');
$js = <<< JS
//设置背景色
$('body').css('background','#FFF');
//删除H1
$('h1').remove();
        $(function () {
                $.ajax({
                    url:'{$cat}', 
                    success:function (data) {
                        console.log(data);
                       // var da = JSON.parse(data);  //推荐方法
                        console.log(data);
                      init_chart(data);
                     
                      // init_chart('catNum',data);
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
<head>
    <meta charset="utf-8">
    <title>ECharts</title>
</head>

<body>
    <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
    <div id="main" style="height:400px"></div>
    <!-- ECharts单文件引入 -->
    <script src="http://echarts.baidu.com/build/dist/echarts.js"></script>
    <script type="text/javascript">
        // 路径配置
        require.config({
            paths: {
                echarts: 'http://echarts.baidu.com/build/dist'
            }
        });

        // 使用
        require(
            [
                'echarts',
                'echarts/chart/pie' // 使用柱状图就加载pie模块，按需加载
            ],
            function (ec) {
                init_chart(data);
                // 基于准备好的dom，初始化echarts图表
                // var myChart = ec.init(document.getElementById('main'));
                //
                // option = {
                //     title : {
                //         text: '产品状态分布',
                //         subtext: '来源支持管理部',
                //         x:'center'
                //     },
                //     tooltip : {
                //         trigger: 'item',
                //         formatter: "{a} <br/>{b} : {c} ({d}%)"
                //     },
                //     legend: {
                //         orient : 'vertical',
                //         x : 'left',
                //         data:['直接访问','邮件营销','联盟广告','视频广告','搜索引擎']
                //     },
                //     toolbox: {
                //         show : true,
                //         feature : {
                //             mark : {show: true},
                //             dataView : {show: true, readOnly: false},
                //             magicType : {
                //                 show: true,
                //                 type: ['pie', 'funnel'],
                //                 option: {
                //                     funnel: {
                //                         x: '25%',
                //                         width: '50%',
                //                         funnelAlign: 'left',
                //                         max: 1548
                //                     }
                //                 }
                //             },
                //             restore : {show: true},
                //             saveAsImage : {show: true}
                //         }
                //     },
                //     calculable : true,
                //     series : [
                //         {
                //             name:'访问来源',
                //             type:'pie',
                //             radius : '55%',
                //             center: ['50%', '60%'],
                //             data:[
                //                 {value:335, name:'直接访问'},
                //                 {value:310, name:'邮件营销'},
                //                 {value:234, name:'联盟广告'},
                //                 {value:135, name:'视频广告'},
                //                 {value:1548, name:'搜索引擎'}
                //             ]
                //         }
                //     ]
                // };
                //
                //
                // // 为echarts对象加载数据
                // myChart.setOption(option);
            }
        );

        function init_chart( row_data) {
            // 基于准备好的dom，初始化echarts图表
            var myChart = echarts.init(document.getElementById('main'));
            // var data = eval("(" + row_data + ")");
            // var status,result;
            // status = data.status;
            // result = data.data;
            option = {
                title : {
                    text: '产品状态分布',
                    subtext: '来源支持管理部',
                    x:'center'
                },
                tooltip : {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                legend: {
                    orient : 'vertical',
                    x : 'left',
                    data:['直接访问','邮件营销','联盟广告','视频广告','搜索引擎']
                    // data:status
                },
                toolbox: {
                    show : true,
                    feature : {
                        mark : {show: true},
                        dataView : {show: true, readOnly: false},
                        magicType : {
                            show: true,
                            type: ['pie', 'funnel'],
                            option: {
                                funnel: {
                                    x: '25%',
                                    width: '50%',
                                    funnelAlign: 'left',
                                    max: 1548
                                }
                            }
                        },
                        restore : {show: true},
                        saveAsImage : {show: true}
                    }
                },
                calculable : true,
                series : [
                    {
                        name:'访问来源',
                        type:'pie',
                        radius : '55%',
                        center: ['50%', '60%'],
                        data:[
                            {value:335, name:'直接访问'},
                            {value:310, name:'邮件营销'},
                            {value:234, name:'联盟广告'},
                            {value:135, name:'视频广告'},
                            {value:1548, name:'搜索引擎'}
                        ]
                        // data : result
                    }
                ]
            };
        }
    </script>
</body>
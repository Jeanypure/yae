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
$sample_source = Url::toRoute('sample');
$js = <<< JS
//设置背景色
$('body').css('background','#FFF');
//删除H1
$('h3').remove();
        $(function () {
                $.ajax({
                    url:'{$cat}', 
                    success:function (data) {
                        // var da = JSON.parse(data);  //推荐方法
                        console.log(data);
                      init_chart(data);
                     
                    }
                });
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
<head>
    <meta charset="utf-8">
    <title>ECharts</title>
</head>

<body>
<div class="row">
    <div class="col-md-12">
        <div class="loading" style="display: none;">
<!--            <center><img src="/assets/img/loading.gif"></center>-->
        </div>
    </div>
</div>
<div class="row">
     <div class="col-md-12">
         <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
         <div id="main" style="height:400px"></div>
     </div>
</div>
<div class="row">
     <div class="col-md-12">
         <h2>近30天拿样来源</h2>
         <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
         <div id="sample-source" style="width: 1200px;height:800px;"></div>
     </div>
</div>



<!-- ECharts单文件引入 标签式单文件引入-->
<!--<script src="http://echarts.baidu.com/build/dist/echarts-all.js"></script>-->
<script src="https://cdn.bootcss.com/echarts/4.1.0.rc2/echarts-en.common.js"></script>


<script type="text/javascript">
    function init_chart(row_data) {
        // 基于准备好的dom，初始化echarts图表
        var myChart = echarts.init(document.getElementById('main'));
        var data = eval("(" + row_data + ")");
        var status,result;
        status = data.status;
        result = data.num;
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
                data:status
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
                                max: 2000
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
                    name:'评审状态',
                    type:'pie',
                    radius : '55%',
                    center: ['50%', '60%'],
                    data : result
                }
            ]
        };
        myChart.setOption(option);
    }
</script>
<script>
    function  sample_chart(sample_data) {
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('sample-source'));
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
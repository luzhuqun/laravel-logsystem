
@extends('main')
@section('title', '总体统计')

@section('content')
<div class="col-sm-4"><h2 class="sub-header">总体统计(一周)</h2> </div>
<div class="col-sm-6" style="padding-top:20px;">
    <table style="float:right;padding-top:20px;">
        <tr>
            <td height="30" width="30" bgcolor="#dc143c"></td><td>pad智付通</td>
            <td height="30" width="30" bgcolor="#32cd32"></td><td>转账电话</td>
            <td height="30" width="30" bgcolor="#bdb76b"></td><td>管理端</td>
            <td height="30" width="30" bgcolor="#1e90ff"></td><td>协议组件</td>
        </tr>
    </table>
</div>
<canvas id="myChart"  style="width:2000px;height:700px"></canvas>
@endsection

@section('script')
<script src="/static/zui/lib/chart/zui.chart.js"></script>
<script type="text/javascript">
    window.onload = function() {
        var data = {
            // labels 数据包含依次在X轴上显示的文本标签
            labels: ['{{date("Y-m-d",time())}}', '{{date("Y-m-d",strtotime("-1 day"))}}', '{{date("Y-m-d",strtotime("-2 day"))}}', '{{date("Y-m-d",strtotime("-3 day"))}}', '{{date("Y-m-d",strtotime("-4 day"))}}', '{{date("Y-m-d",strtotime("-5 day"))}}', '{{date("Y-m-d",strtotime("-6 day"))}}'],
            datasets: [{
                // 数据集名称，会在图例中显示
                label: "pad智付通",

                // 颜色主题，可以是'#fff'、'rgb(255,0,0)'、'rgba(255,0,0,0.85)'、'red' 或 ZUI配色表中的颜色名称
                // 或者指定为 'random' 来使用一个随机的颜色主题
                //color: "red",
                // 也可以不指定颜色主题，使用下面的值来分别应用颜色设置，这些值会覆盖color生成的主题颜色设置
                 fillColor: "rgba(220,20,60,0.2)",
                 strokeColor: "rgba(220,20,60,1)",
                 pointColor: "rgba(220,20,60,1)",
                 pointStrokeColor: "#fff",
                 pointHighlightFill: "#fff",
                 pointHighlightStroke: "rgba(220,20,60,0,1)",

                // 数据集
                data: ["{{$zft1}}", "{{$zft2}}", "{{$zft3}}", "{{$zft4}}", "{{$zft5}}", "{{$zft6}}", "{{$zft7}}"]
            }, {
                label: "转账电话",
                fillColor: "rgba(50,205,50,0.2)",
                 strokeColor: "rgba(50,205,50,1)",
                 pointColor: "rgba(50,205,50,1)",
                 pointStrokeColor: "#fff",
                 pointHighlightFill: "#fff",
                 pointHighlightStroke: "rgba(50,205,50,0,1)",
                data: [100,100]
            }, {
                label: "管理端",
                 fillColor: "rgba(189,183,107,0.2)",
                 strokeColor: "rgba(189,183,107,1)",
                 pointColor: "rgba(189,183,107,1)",
                 pointStrokeColor: "#fff",
                 pointHighlightFill: "#fff",
                 pointHighlightStroke: "rgba(189,183,107,0,1)",
                data: [0,0,100,100]
            }, {
                label: "协议组件",
                fillColor: "rgba(30,144,255,0.2)",
                 strokeColor: "rgba(30,144,255,1)",
                 pointColor: "rgba(30,144,255,1)",
                 pointStrokeColor: "#fff",
                 pointHighlightFill: "#fff",
                 pointHighlightStroke: "rgba(30,144,255,0,1)",
                data: [0,0,0,0,100,100]
            }]
        };

        var options = {}; // 图表配置项，可以留空来使用默认的配置

        var myLineChart = $("#myChart").lineChart(data, options);
   }
</script>    
    
@endsection


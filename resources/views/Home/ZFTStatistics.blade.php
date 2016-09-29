@extends('main')
@section('title', 'pad智付通统计')

@section('content')
<h2 class="sub-header">pad智付通统计（最近一月）</h2>
<canvas id="myChart" style="width:2000px;height:700px"></canvas>
@endsection

@section('script')
    <script src="/static/zui/lib/chart/zui.chart.js"></script>
    <script type="text/javascript">
        window.onload = function() {
            var data = {
                labels: ["{{$class['0'] or ''}}", "{{$class['1'] or ''}}", "{{$class['2'] or ''}}", "{{$class['3'] or ''}}", "{{$class['4'] or ''}}", "{{$class['5'] or ''}}", "{{$class['6'] or ''}}", "{{$class['7'] or ''}}", "{{$class['8'] or ''}}", "{{$class['9'] or ''}}", ""],
                datasets: [
                    {
                        fillColor: "rgba(105,105,105,0.6)",
                        data: ["{{$amount['0'] or ''}}", "{{$amount['1'] or ''}}", "{{$amount['2'] or ''}}", "{{$amount['3'] or ''}}", "{{$amount['4'] or ''}}", "{{$amount['5'] or ''}}", "{{$amount['6'] or ''}}", "{{$amount['7'] or ''}}", "{{$amount['8'] or ''}}", "{{$amount['9'] or ''}}"]
                    }
                ]
            };

            var options = {responsive: true,}; // 图表配置项，可以留空来使用默认的配置
            var myChart = $('#myChart').barChart(data, options);
        }
    </script>
@endsection

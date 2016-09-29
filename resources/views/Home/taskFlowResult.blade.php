@extends('main')
@section('title', '任务结果查看')

@section('content')
    <h2 class="sub-header">结果查看</h2>
    <p>共找到：{{$totalCounts}} 条数据</p>
    @if($type == 'zft')
        <div class="table-responsive" style="">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>taskName</th>
                    <th>taskTime</th>
                    <th>function</th>
                    <th>AccNo</th>
                    <th>DevNo</th>
                    <th>Time</th>
                    <th>Class</th>
                </tr>
                </thead>
                <tbody>
                @foreach($taskResult as $value)
                    <tr data-accno="{{$value->AccNo}}" data-devno="{{$value->DevNo}}" data-time="{{$value->Time['date']}}" data-class="{{$value->Class}}"
                        data-ip="{{$value->Ip}}" data-level="{{$value->Level}}" data-description="{{$value->Description}}" data-label="{{$value->Label}}"
                        data-ex="{{$value->Exception}}" data-iserrorlog="{{$value->IsErrorLog}}" data-logname="{{$value->LogName}}" class="zft-tr">
                        <th>{{$value->taskName}}</th>
                        <th>{{$value->taskTime}}</th>
                        <th>{{$value->function}}</th>
                        @if($value->IsErrorLog)
                            <th><span class="glyphicon glyphicon-remove"></span>&nbsp;{{$value->AccNo}}</th>
                        @else
                            <th><span class="glyphicon glyphicon-ok"></span>&nbsp;{{$value->AccNo}}</th>
                        @endif
                        <th>{{$value->DevNo}}</th>
                        <th>{{$value->Time['date']}}</th>
                        <th>{{$value->Class}}</th>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <ul class="pagination pagination-demo"></ul>
        </div>
    @endif
    @if($type == 'bocom')
        <div class="table-responsive" style="">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>taskName</th>
                    <th>taskTime</th>
                    <th>function</th>
                    <th>交易类型</th>
                    <th>交易时间</th>
                    <th>返回码</th>
                    <th>终端标志</th>
                    <th>流水号</th>
                </tr>
                </thead>
                <tbody>
                @foreach($taskResult as $value)
                    <tr data-trade_time="{{$value->Trade_Time}}" data-trade_type="{{$value->Trade_Type}}" data-resp_no="{{$value->Resp_NO}}"
                        data-pin_code="{{$value->Pin_Code}}" data-ftag="{{$value->Ftag}}" data-message="{{$value->Message}}" class="bocom-tr">
                        <th>{{$value->taskName}}</th>
                        <th>{{$value->taskTime}}</th>
                        <th>{{$value->function}}</th>
                        @if(!$value->Succeed)
                            <th><span class="glyphicon glyphicon-remove"></span>&nbsp;{{$value->Trade_Type}}</th>
                        @else
                            <th><span class="glyphicon glyphicon-ok"></span>&nbsp;{{$value->Trade_Type}}</th>
                        @endif

                        <th>{{$value->Trade_Time}}</th>
                        <th>{{$value->Resp_NO}}</th>
                        <th>{{$value->Pin_Code}}</th>
                        <th>{{$value->Ftag}}</th>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <ul class="pagination pagination-demo"></ul>
        </div>
    @endif
@endsection

@section('script')
    <link href="/Scripts/dialog/css/bootstrap-dialog.min.css" rel="stylesheet" />
    <script src="/Scripts/dialog/js/bootstrap-dialog.min.js"></script>
    <script src="/Scripts/jqPaginator.min.js"></script>
    <script>
        $(".pagination-demo").jqPaginator({
            totalCounts: {{$totalCounts}},
            pageSize: 15,
            visiblePages: 10,
            currentPage: {{$page}},
            first: '<li class="first"><a href="/taskflowshow/{{$id}}/{{$time}}/1">首页<\/a><\/li>',
            prev: '<li class="prev"><a href="/taskflowshow/{{$id}}/{{$time}}/@{{page}}">上一页<\/a><\/li>',
            next: '<li class="next"><a href="/taskflowshow/{{$id}}/{{$time}}/@{{page}}">下一页<\/a><\/li>',
            last: '<li class="last"><a href="/taskflowshow/{{$id}}/{{$time}}/@{{totalPages}}">末页<\/a><\/li>',
            page: '<li class="page"><a href="/taskflowshow/{{$id}}/{{$time}}/@{{page}}">@{{page}}<\/a><\/li>',
            onPageChange: function (n) {
                $(".pagination-demo .disabled").each(function(){
                    $(this).find('a').attr('href','#');
                })
            }
        });


        $('.zft-tr').on('click', function (e) {
            var self = this,
                    accNo = $(self).attr('data-accNo'),
                    devNo = $(self).attr('data-devNo'),
                    time = $(self).attr('data-Time'),
                    clas = $(self).attr('data-class'),
                    ip = $(self).attr('data-ip'),
                    level = $(self).attr('data-level'),
                    label = $(self).attr('data-label'),
                    description = $(self).attr('data-description'),
                    logName=$(self).attr('data-logName'),
                    textAndPic = $('<div></div>');
            textAndPic.append('<b>卡号：</b>' + accNo + '</br><hr>');
            textAndPic.append('<b>终端号：</b>' + devNo + '</br><hr>');
            textAndPic.append('<b>时间：</b>' + time + '</br><hr>');
            textAndPic.append('<b>类名：</b>' + clas + '</br><hr>');
            textAndPic.append('<b>ip：</b>' + ip + '</br><hr>');
            textAndPic.append('<b>日志级别：</b>' + level + '</br><hr>');
            textAndPic.append('<b>日志标志：</b>' + logName + '</br><hr>');
            textAndPic.append('<b>自定义标志：</b>' + label + '</br><hr>');
            textAndPic.append('<b>附加信息：</b>' + description + '</br>');
            if ($(self).attr('data-isErrorLog') && $(self).attr('data-ex')) {
                textAndPic.append('<hr><b>异常信息：</b>' + $(self).attr('data-ex') + '</br>');
            };
            BootstrapDialog.show({
                title: '日志详情',
                message: textAndPic,
                buttons: [{
                    label: '关闭',
                    action: function (dialogItself) {
                        dialogItself.close();
                    }
                }]
            });

        });

        $('.bocom-tr').on('click', function (e) {
            var self = this,
                    Trade_Type = $(self).attr('data-Trade_Type'),
                    Trade_Time = $(self).attr('data-Trade_Time'),
                    Resp_NO = $(self).attr('data-Resp_NO'),
                    Pin_Code = $(self).attr('data-Pin_Code'),
                    Ftag = $(self).attr('data-Ftag'),
                    Message = $(self).attr('data-Message'),

                    textAndPic = $('<div></div>');
            textAndPic.append('<b>交易类型：</b>' + Trade_Type + '</br><hr>');
            textAndPic.append('<b>交易时间：</b>' + Trade_Time + '</br><hr>');
            textAndPic.append('<b>返回码：</b>' + Resp_NO + '</br><hr>');
            textAndPic.append('<b>终端标志：</b>' + Pin_Code + '</br><hr>');
            textAndPic.append('<b>流水号：</b>' + Ftag + '</br><hr>');
            textAndPic.append('<b>附加信息：</b>' + Message + '</br><hr>');

            BootstrapDialog.show({
                title: '日志详情',
                message: textAndPic,
                buttons: [{
                    label: '关闭',
                    action: function (dialogItself) {
                        dialogItself.close();
                    }
                }],
                onshown: function () {
                    $('.modal-content').css('overflow-y', 'auto');
                }
            });

        });
    </script>

@endsection
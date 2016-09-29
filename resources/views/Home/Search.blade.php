@extends('main')
@section('title', '搜索')

@section('content')
<p style="">
  <a href="#collapseExample" data-toggle="collapse" class="btn btn-link"><i class="icon-3x icon-filter"></i></a>
</p>
<div class="collapse in" id="collapseExample" >
    <div class="with-padding">
        <div class="col-sm-9">
            <div class="col-sm-4">
                <div class="btn-toolbar">
                    <div class="btn-group">
                        <button class="btn" id="zftButton">智付通</button>
                    </div>
                    <div class="btn-group">
                        <button class="btn" id="phoneButton">转账电话</button>
                    </div>
                    <div class="btn-group">
                        <button class="btn" id="manageButton">管理端</button>
                    </div>
                    <div class="btn-group" id="protocolButton">
                        <button class="btn">协议组件</button>
                    </div>
                    <div class="btn-group">
                        <button class="btn" id="bocomButton">交行</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div  class="input-group date form-datetime" data-date="{{date('Y-m-d H:i:s',time())}}" data-date-format="yyyy-mm-dd" data-link-field="dtp_input1">
                    <input id="start" class="form-control" size="16" type="text" value="" readonly="">
                    <span class="input-group-addon"><span class="icon-th"></span></span>
                    <span class="input-group-addon">开始时间(必填)</span>
                </div>
            </div>
            <div class="col-sm-4">
                <div  class="input-group date form-datetime" data-date="{{date('Y-m-d H:i:s',time())}}" data-date-format="yyyy-mm-dd" data-link-field="dtp_input1">
                    <input id="end" class="form-control" size="16" type="text" value="" readonly="">
                    <span class="input-group-addon"><span class="icon-th"></span></span>
                    <span class="input-group-addon">结束时间(必填)</span>
                </div>
            </div>
        </div>
        <!-- 定时任务 -->

        <!-- 智付通 -->
        <div id="zft" class="type col-sm-9 hidden" style="padding-top:30px">
            <div class="input-group col-sm-12">
                <span class="input-group-addon">Level</span>
                <input type="text" class="form-control" name="Level">
                <span class="input-group-addon fix-border fix-padding">DevNo</span>
                <input type="text" class="form-control" name="DevNo">
                <span class="input-group-addon fix-border fix-padding">Class</span>
                <input type="text" class="form-control" name="Class">
                <span class="input-group-addon fix-border fix-padding">AccNo</span>
                <input type="text" class="form-control" name="AccNo">
                <span class="input-group-addon fix-border fix-padding">Description</span>
                <input type="text" class="form-control" name="Description">
                <span class="input-group-addon fix-border fix-padding">Exception</span>
                <input type="text" class="form-control" name="Exception">
                <span class="input-group-addon fix-border fix-padding">LogName</span>
                <input type="text" class="form-control" name="LogName">

            </div>
            <div style="padding-top:30px">
                <div class="col-sm-1">
                    <label>
                        <input type="radio" class="normal" name="radio"> 正常日志
                    </label>
                </div>
                <div class="col-sm-1">
                    <label>
                        <input type="radio" class="abnormal" name="radio"> 异常日志
                    </label>
                </div>
                <div class="col-sm-1">
                    <label>
                        <input  type="radio" class="all" name="radio" checked="checked"> 全部日志
                    </label>
                </div>

                <div class="input-group col-sm-3">
                    <span class="input-group-addon"><i class="icon-search"></i></span>
                    <input type="text" id="searchData" class="form-control">
                    <span class="input-group-btn">
                        <button id="search" class="btn btn-default" type="button">搜索</button>
                        <button id="ZftTaskCreate" class="btn btn-default" type="button">建立定时任务</button>
                    </span>
                </div>
            </div>
        </div>
        <!--交行-->
        <div id="bocom" class="type col-sm-9 hidden" style="padding-top: 30px">
            <div class="input-group col-sm-9">
                <span class="input-group-addon">Trade_Type</span>
                <input type="text" class="form-control" name="Trade_Type">
                <span class="input-group-addon fix-border fix-padding">Message</span>
                <input type="text" class="form-control" name="Message">
                <span class="input-group-addon fix-border fix-padding">Resp_No</span>
                <input type="text" class="form-control" name="Resp_No">
                <span class="input-group-addon fix-border fix-padding">Ftag</span>
                <input type="text" class="form-control" name="Ftag">
                <span class="input-group-addon fix-border fix-padding">Pin_Code</span>
                <input type="text" class="form-control" name="Pin_Code">
            </div>
            <div style="padding-top:30px">
                <div class="col-sm-1">
                    <label>
                        <input type="radio" class="normal" name="bocomRadio"> 正常日志
                    </label>
                </div>
                <div class="col-sm-1">
                    <label>
                        <input type="radio" class="abnormal" name="bocomRadio"> 异常日志
                    </label>
                </div>
                <div class="col-sm-1">
                    <label>
                        <input  type="radio" class="all" name="bocomRadio" checked="checked"> 全部日志
                    </label>
                </div>

                <div class="input-group col-sm-3">
                    <span class="input-group-addon"><i class="icon-search"></i></span>
                    <input type="text" id="searchBocomData" class="form-control">
                    <span class="input-group-btn">
                        <button id="searchBocom" class="btn btn-default" type="button">搜索</button>
                        <button id="BocomTaskCreate" class="btn btn-default" type="button">建立定时任务</button>
                    </span>
                </div>
            </div>
        </div>

    </div>
</div>
{{--表格显示--}}
<div class="myTable col-sm-9 hidden" id="zftTable" style="float: left;padding-top: 0px">
    <hr>
    <p class="totalamount"></p>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>AccNo</th>
                <th>DevNo</th>
                <th>Time</th>
                <th>Class</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <ul class="pagination pagination-demo"></ul>
    </div>
</div>
<div class="myTable col-sm-9 hidden" id="bocomTable" style="float: left;padding-top: 0px">
    <hr>
    <p class="totalamount"></p>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>交易类型</th>
                <th>交易时间</th>
                <th>返回码</th>
                <th>终端标志</th>
                <th>流水号</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <ul class="pagination pagination-demo"></ul>
    </div>
</div>

<!--定时任务-->
<div id="TaskScheduling" class="col-sm-3 hidden">
    定时任务（Crontab格式填写）
    <form id="validForm">
        <div>
            <hr>
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            分钟:<input type="text" name="min" value="*">（0~59）(/2代表每两分钟，下同)<br>
            小时:<input type="text" name="hour" value="*">（0~23）<br>
            日:<input type="text" name="dom" value="*">（1~31）<br>
            月:<input type="text" name="month" value="*">（1~12）<br>
            周:<input type="text" name="dow" value="*">（1~7 周日=7）<br>
            年:<input type="text" name="year" value="*"><br>
            <hr>
            任务内容:<input type="text" name="taskContent">
            <hr>
            <button class="btn" type="button" id="taskSubmit">提交</button>
        </div>
    </form>
</div>
@endsection

@section('script')
    <link href="/Scripts/dialog/css/bootstrap-dialog.min.css" rel="stylesheet" />
    <script src="/Scripts/dialog/js/bootstrap-dialog.min.js"></script>

    <script src="/static/zui/lib/datetimepicker/datetimepicker.min.js"></script>
    <script src="/Scripts/jqPaginator.min.js"></script>
    <script type="text/javascript">
        window.onload = function() {
            $("#start").datetimepicker(
                    {
                        weekStart: 1,
                        todayBtn: 1,
                        autoclose: 1,
                        todayHighlight: 1,
                        startView: 2,
                        forceParse: 0,
                        showMeridian: 1,
                        format: "yyyy-mm-dd hh:ii"
                    });
            $('#end').datetimepicker(
                    {
                        weekStart: 1,
                        todayBtn: 1,
                        autoclose: 1,
                        todayHighlight: 1,
                        startView: 2,
                        forceParse: 0,
                        showMeridian: 1,
                        format: "yyyy-mm-dd hh:ii"
                    });
            $('#TaskTime').datetimepicker(
                    {
                        weekStart: 1,
                        todayBtn: 1,
                        autoclose: 1,
                        todayHighlight: 1,
                        startView: 2,
                        forceParse: 0,
                        showMeridian: 1,
                        format: "yyyy-mm-dd hh:ii"
                    });
            //显示隐藏
            $("#zftButton").on('click', function () {
                $(".type").addClass("hidden");
                $(".myTable").addClass("hidden");
                $("#zft").removeClass("hidden");
                $("#zftTable").removeClass("hidden");
            })
            $("#bocomButton").on('click', function () {
                $(".type").addClass("hidden");
                $(".myTable").addClass("hidden");
                $("#bocom").removeClass("hidden");
                $("#bocomTable").removeClass("hidden");
            })
            $("#ZftTaskCreate,#BocomTaskCreate").on('click', function(){
                $("#TaskScheduling").removeClass('hidden');
                var data = $("#searchData").val();
                $("#TaskData").val(data);
            })

            //zft搜索
            function getZftData(){
                var type = 'zft';
                var start = $("#start").val();
                var end = $("#end").val();
                var Level = $("[name='Level']").val();
                var DevNo = $("[name='DevNo']").val();
                var Class = $("[name='Class']").val();
                var AccNo = $("[name='AccNo']").val();
                var Description = $("[name='Description']").val();
                var Exception = $("[name='Exception']").val();
                var LogName = $("[name='LogName']").val();
                var log = $("input:checked[name='radio']").attr('class');
                return QueryData = type + '|' + start + '|' + end + '|' + Level + '|' + DevNo + '|' + Class + '|' + AccNo + '|' + Description + '|' + Exception + '|' + LogName + '|' + log;
            }
            $("#search").on('click', function () {
                $("#searchData").val(getZftData());
                showPage(1, getZftData());
            })
            $("#ZftTaskCreate").on('click', function(){
               $("input[name='taskContent']").val(getZftData());
            })
            //bocom搜索
            function getBocomData(){
                var type = 'bocom';
                var start = $("#start").val();
                var end = $("#end").val();
                var Trade_Type = $("[name='Trade_Type']").val();
                var Message = $("[name='Message']").val();
                var Resp_No = $("[name='Resp_No']").val();
                var Ftag = $("[name='Ftag']").val();
                var Pin_Code = $("[name='Pin_Code']").val();
                var log = $("input:checked[name='bocomRadio']").attr('class');
                return QueryData = type + '|' + start + '|' + end + '|' + Trade_Type + '|' + Message + '|' + Resp_No + '|' + Ftag + '|' + Pin_Code + '|' + log;
            }
            $("#searchBocom").on('click', function () {
                $("#searchBocomData").val(getBocomData());
                showBocomPage(1, getBocomData());
            })
            $("#BocomTaskCreate").on('click', function(){
                $("input[name='taskContent']").val(getBocomData());
            })
            //zft显示分页
            function showPage(p,QueryData) {
                var id = $("li .active").find('a').attr('id');
                if (id != p) {
                    $.ajax({
                        type: 'get',
                        url: '{{ url('') }}' + '/show/' + p + '/' + QueryData,
                        dataType: 'json',
                        async: false,
                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                        success: function (resp) {
                            $("#zftTable tbody").empty();
                            var data = eval(resp);
                            for (i = 0; i < data[0].length; i++) {
                                if (data[0][i].IsErrorLog == true) {
                                    $("#zftTable tbody").append(
                                            '<tr data-accno="' + data[0][i].AccNo + '" data-devno="' + data[0][i].DevNo + '" data-time="' + data[0][i].Time + '" data-class="' + data[0][i].Class +
                                            '"data-ip="' + data[0][i].Ip + '" data-level="' + data[0][i].Level + '" data-description="' + data[0][i].Description + '" data-label="' + data[0][i].Label +
                                            '"data-ex="' + data[0][i].Exception + '" data-iserrorlog="' + data[0][i].IsErrorLog + '" data-logname="' + data[0][i].LogName + '" class="zft-tr">' +
                                            '<th>' + '<span class="glyphicon glyphicon-remove">' + '</span>&nbsp;' + data[0][i].AccNo + '</th>' +
                                            '<th>' + data[0][i].DevNo + '</th>' +
                                            '<th>' + data[0][i].Time + '</th>' +
                                            '<th>' + data[0][i].Class + '</th>' +
                                            '</tr>'
                                    )
                                }
                                else if (data[0][i].IsErrorLog == false) {
                                    $("#zftTable tbody").append(
                                            '<tr data-accno="' + data[0][i].AccNo + '" data-devno="' + data[0][i].DevNo + '" data-time="' + data[0][i].Time + '" data-class="' + data[0][i].Class +
                                            '"data-ip="' + data[0][i].Ip + '" data-level="' + data[0][i].Level + '" data-description="' + data[0][i].Description + '" data-label="' + data[0][i].Label +
                                            '"data-ex="' + data[0][i].Exception + '" data-iserrorlog="' + data[0][i].IsErrorLog + '" data-logname="' + data[0][i].LogName + '" class="zft-tr">' +
                                            '<th>' + '<span class="glyphicon glyphicon-ok">' + '</span>&nbsp;' + data[0][i].AccNo + '</th>' +
                                            '<th>' + data[0][i].DevNo + '</th>' +
                                            '<th>' + data[0][i].Time + '</th>' +
                                            '<th>' + data[0][i].Class + '</th>' +
                                            '</tr>'
                                    )
                                }
                                else {
                                    $("#zftTable tbody").append(
                                            '<tr data-accno="' + data[0][i].AccNo + '" data-devno="' + data[0][i].DevNo + '" data-time="' + data[0][i].Time + '" data-class="' + data[0][i].Class +
                                            '"data-ip="' + data[0][i].Ip + '" data-level="' + data[0][i].Level + '" data-description="' + data[0][i].Description + '" data-label="' + data[0][i].Label +
                                            '"data-ex="' + data[0][i].Exception + '" data-iserrorlog="' + data[0][i].IsErrorLog + '" data-logname="' + data[0][i].LogName + '" class="zft-tr">' +
                                            '<th>' + '</span>&nbsp;' + data[0][i].AccNo + '</th>' +
                                            '<th>' + data[0][i].DevNo + '</th>' +
                                            '<th>' + data[0][i].Time + '</th>' +
                                            '<th>' + data[0][i].Class + '</th>' +
                                            '</tr>'
                                    )
                                }

                            }

                            //对话框
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
                                        logName = $(self).attr('data-logName'),
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
                            //分页
                            $(".totalamount").text('共：'+data[1]+'条数据');
                            $(".pagination-demo").jqPaginator({
                                totalCounts: data[1],
                                pageSize: 15,
                                visiblePages: 10,
                                currentPage: data[2],
                                first: '<li class="first" name="paginator"><a  id="1">首页<\/a><\/li>',
                                prev: '<li class="prev" name="paginator"><a id="@{{page}}">上一页<\/a><\/li>',
                                next: '<li class="next" name="paginator"><a  id="@{{page}}">下一页<\/a><\/li>',
                                last: '<li class="last" name="paginator"><a id="@{{totalPages}}">末页<\/a><\/li>',
                                page: '<li class="page" name="paginator"><a  id="@{{page}}">@{{page}}<\/a><\/li>',
                                onPageChange: function (n) {
                                    $(".pagination-demo .disabled").each(function () {
                                        $(this).find('a').attr('href', '#');
                                    })
                                }
                            });
                        },
                        error: function (resp) {
                            alert('搜索失败')
                        }
                    })
                    $("li[name='paginator']").on('click', function () {
                        var type = 'zft';
                        var start = $("#start").val();
                        var end = $("#end").val();
                        var Level = $("[name='Level']").val();
                        var DevNo = $("[name='DevNo']").val();
                        var Class = $("[name='Class']").val();
                        var AccNo = $("[name='AccNo']").val();
                        var Description = $("[name='Description']").val();
                        var Exception = $("[name='Exception']").val();
                        var LogName = $("[name='LogName']").val();
                        var log = $("input:checked[name='radio']").attr('class');
                        var QueryData = type + '|' + start + '|' + end + '|' + Level + '|' + DevNo + '|' + Class + '|' + AccNo + '|' + Description + '|' + Exception + '|' + LogName + '|' + log;
                        $("#searchData").val(QueryData);

                        var id = $(this).find('a').attr('id');
                        if (typeof(id) != 'undefined') {
                            showPage(id, QueryData);
                        }

                    })
                }
            }
            //bocom显示分页
            function showBocomPage(p,QueryData) {
                var id = $("li .active").find('a').attr('id');
                if (id != p) {
                    $.ajax({
                        type: 'get',
                        url: '{{ url('') }}' + '/show/' + p + '/' + QueryData,
                        dataType: 'json',
                        async: false,
                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                        success: function (resp) {
                            $("#bocomTable tbody").empty();
                            var data = eval(resp);
                            for (i = 0; i < data[0].length; i++) {
                                console.log(data[0][i].Succeed);
                                if (data[0][i].Succeed == true) {
                                    $("#bocomTable tbody").append(
                                            '<tr data-trade_time="'+data[0][i].Trade_Time+'" data-trade_type="'+data[0][i].Trade_Type+'" data-resp_no="'+data[0][i].Resp_NO+
                                            '"data-pin_code="'+data[0][i].Pin_Code+'" data-ftag="'+data[0][i].Ftag+'" data-message="'+data[0][i].Message+'" class="zft-tr">'+
                                            '<th>'+'<span class="glyphicon glyphicon-ok">'+'</span>&nbsp;'+data[0][i].Trade_Type+'</th>'+
                                                '<th>'+data[0][i].Trade_Time+'</th>'+
                                                '<th>'+data[0][i].Resp_NO+'</th>'+
                                                '<th>'+data[0][i].Pin_Code+'</th>'+
                                                '<th>'+data[0][i].Ftag+'</th>'+
                                            '</tr>'
                                    )
                                }
                                else if (data[0][i].Succeed == false) {console.log(data[0][0].Trade_Time);
                                    $("#bocomTable tbody").append(
                                            '<tr data-trade_time="'+data[0][i].Trade_Time+'" data-trade_type="'+data[0][i].Trade_Type+'" data-resp_no="'+data[0][i].Resp_NO+
                                            '"data-pin_code="'+data[0][i].Pin_Code+'" data-ftag="'+data[0][i].Ftag+'" data-message="'+data[0][i].Message+'" class="zft-tr">'+
                                            '<th>'+'<span class="glyphicon glyphicon-remove">'+'</span>&nbsp;'+data[0][i].Trade_Type+'</th>'+
                                            '<th>'+data[0][i].Trade_Time+'</th>'+
                                            '<th>'+data[0][i].Resp_NO+'</th>'+
                                            '<th>'+data[0][i].Pin_Code+'</th>'+
                                            '<th>'+data[0][i].Ftag+'</th>'+
                                            '</tr>'
                                    )
                                }
                                else {
                                    $("#bocomTable tbody").append(
                                            '<tr data-trade_time="'+data[0][i].Trade_Time+'" data-trade_type="'+data[0][i].Trade_Type+'" data-resp_no="'+data[0][i].Resp_NO+
                                            '"data-pin_code="'+data[0][i].Pin_Code+'" data-ftag="'+data[0][i].Ftag+'" data-message="'+data[0][i].Message+'" class="zft-tr">'+
                                            '<th>'+'</span>&nbsp;'+data[0][i].Trade_Type+'</th>'+
                                            '<th>'+data[0][i].Trade_Time+'</th>'+
                                            '<th>'+data[0][i].Resp_NO+'</th>'+
                                            '<th>'+data[0][i].Pin_Code+'</th>'+
                                            '<th>'+data[0][i].Ftag+'</th>'+
                                            '</tr>'
                                    )
                                }

                            }

                            //对话框
                            $('.zft-tr').on('click', function (e) {
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
                            //分页
                            $(".totalamount").text('共：'+data[1]+'条数据');
                            $(".pagination-demo").jqPaginator({
                                totalCounts: data[1],
                                pageSize: 15,
                                visiblePages: 10,
                                currentPage: data[2],
                                first: '<li class="first" name="paginator"><a  id="1">首页<\/a><\/li>',
                                prev: '<li class="prev" name="paginator"><a id="@{{page}}">上一页<\/a><\/li>',
                                next: '<li class="next" name="paginator"><a  id="@{{page}}">下一页<\/a><\/li>',
                                last: '<li class="last" name="paginator"><a id="@{{totalPages}}">末页<\/a><\/li>',
                                page: '<li class="page" name="paginator"><a  id="@{{page}}">@{{page}}<\/a><\/li>',
                                onPageChange: function (n) {
                                    $(".pagination-demo .disabled").each(function () {
                                        $(this).find('a').attr('href', '#');
                                    })
                                }
                            });
                        },
                        error: function (resp) {
                            alert('搜索失败')
                        }
                    })
                    $("li[name='paginator']").on('click', function () {
                        var type = 'bocom';
                        var start = $("#start").val();
                        var end = $("#end").val();
                        var Trade_Type = $("[name='Trade_Type']").val();
                        var Message = $("[name='Message']").val();
                        var Resp_No = $("[name='Resp_No']").val();
                        var Ftag = $("[name='Ftag']").val();
                        var Pin_Code = $("[name='Pin_Code']").val();
                        var log = $("input:checked[name='bocomRadio']").attr('class');
                        var QueryData = type + '|' + start + '|' + end + '|' + Trade_Type + '|' + Message + '|' + Resp_No + '|' + Ftag + '|' + Pin_Code + '|' + log;
                        $("#searchBocomData").val(QueryData);
                        var id = $(this).find('a').attr('id');
                        if (typeof(id) != 'undefined') {
                            showBocomPage(id, QueryData);
                        }
                    })
                }
            }

            //ajax提交定时任务
            $("#taskSubmit").on('click',function(){
                $.ajax({
                    type:'post',
                    url:'{{ url('') }}'+'/task',
                    data: $("#validForm").serialize(),
                    headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
                    success:function(result){
                        alert(result.msg);
                    },
                    error:function(result){
                        alert("提交失败！");
                    }
                });
            })
        }
    </script>
@endsection


@extends('main')
@section('title', '首页')

@section('content')
<h1 class="page-header">首页</h1>

<div class="row placeholders" style="text-align:center">
    <div class="col-xs-6 col-sm-6 placeholder" >
        <div style="margin:0 auto"><canvas id="zftChart" width="320" height="200" ></canvas></div>
        <h4 style="margin:0 auto">智付通pad</h4>
    </div>
    <div class="col-xs-6 col-sm-6  placeholder" >
        <div style="margin:0 auto"><canvas id="bocomChart" width="320" height="200" ></canvas></div>
        <h4 style="margin:0 auto">交行</h4>
    </div>
    <div class="col-xs-6 col-sm-6 placeholder" style="text-align:center;">
        
        <ul class="nav nav-secondary nav-justified" style="margin:0 auto;width:50%">
            <li id="li1" class="active"><a href="#">正常日志</a></li>
            <li id="li2"><a href="#" style="color:red">异常日志</a></li> 
        </ul>
       
        <ul id="zftdatatrue">
        @foreach($zftdatafalse as $value)
            <li class="log" data-time="{{$value->Time}}" data-class="{{$value->Class}}" data-des="{{$value->Description}}">
                <h5 style="font-size:15px;text-align:left;font-color:#222222;">|{{$value->Time}}|{{$value->Class}}|{{$value->Ip}}|{{$value->LogName}}|</h5>
                <p style="font-size:13px;text-align:left;">{{mb_substr($value->Description,0,100)}}</p>
                <hr>
            </li>

        @endforeach
        </ul>
        <ul id="zftdatafalse" class="hidden">
        @foreach($zftdatatrue as $value)
            <li class="log" data-time="{{$value->Time}}" data-class="{{$value->Class}}" data-des="{{$value->Exception}}">
                <h5 style="font-size:15px;text-align:left;font-color:#222222;">|{{$value->Time}}|{{$value->Class}}|{{$value->Ip}}|{{$value->LogName}}|</h5>
                <p style="font-size:13px;text-align:left;">{{mb_substr($value->Exception,0,100)}}</p>
                <hr>
            </li>

        @endforeach
        </ul>
    </div>
    <div class="col-xs-6 col-sm-6 placeholder" style="text-align:center;">
        <ul class="nav nav-secondary nav-justified" style="margin:0 auto;width:50%">
            <li id="li3" class="active"><a href="#">正常日志</a></li>
            <li id="li4"><a href="#" style="color:red">异常日志</a></li> 
        </ul>
        <ul id="bocomdatatrue">
        @foreach($bocomdatatrue as $value)
            <li class="log" data-time="{{$value->Trade_Time}}" data-class="{{$value->Trade_Type}}" data-des="{{$value->Message}}">
                <h5 style="font-size:15px;text-align:left;font-color:#222222;">|{{$value->Trade_Time}}|{{$value->Trade_Type}}|{{$value->Pin_Code}}|{{$value->Ftag}}|{{$value->Resp_No}}|</h5>
                <p style="font-size:13px;text-align:left;">{{mb_substr($value->Message,0,100)}}</p>
                <hr>
            </li>
        @endforeach
        </ul>
        <ul id="bocomdatafalse" class="hidden">
        @foreach($bocomdatafalse as $value)
            <li class="log" data-time="{{$value->Trade_Time}}" data-class="{{$value->Trade_Type}}" data-des="{{$value->Message}}">
                <h5 style="font-size:15px;text-align:left;font-color:#222222;">|{{$value->Trade_Time}}|{{$value->Trade_Type}}|{{$value->Pin_Code}}|{{$value->Ftag}}|{{$value->Resp_No}}|</h5>
                <p style="font-size:13px;text-align:left;">{{mb_substr($value->Message,0,100)}}</p>
                <hr>
            </li>
        @endforeach
        </ul>
    </div>
</div>
@endsection

@section('script')
<link href="/Scripts/dialog/css/bootstrap-dialog.min.css" rel="stylesheet" />
<script src="/Scripts/dialog/js/bootstrap-dialog.min.js"></script>
<script src="/static/zui/lib/chart/zui.chart.js"></script>

<script type="text/javascript">

    window.onload = function() {
        // 图表配置项，可以留空来使用默认的配置
        var options = {
            scaleShowLabels: true, // 展示标签
        };

        var zftdata = [{
            value: {{$zfttrue}},
            color: "#314656", // 使用颜色名称
            label: "正常"
        }, {
            value: {{$zftfalse}},
            color:"#dc143c", // 自定义颜色
            // highlight: "#FF5A5E", // 自定义高亮颜色
            label: "异常"
        }];

        var bocomdata = [{
            value: {{$bocomtrue}},
            color: "#314656", // 使用颜色名称
            label: "正常"
        }, {
            value: {{$bocomfalse}},
            color:"#dc143c", // 自定义颜色
            // highlight: "#FF5A5E", // 自定义高亮颜色
            label: "异常"
        }];

        
        // 创建饼图
        $("#zftChart").pieChart(zftdata, options);
        // 创建环形饼图
        $("#bocomChart").pieChart(bocomdata, options);
        //切换
        $("li").on('click',function(){
            if ($(this).hasClass('active')) {
            } else {
                $("li").removeClass('active');
                $(this).addClass('active')
            }
        })
        //显示
        $("#li1").on('click',function(){
            $("#zftdatatrue").removeClass('hidden');
            $("#zftdatafalse").addClass('hidden');
        }) 
        $("#li2").on('click',function(){
            $("#zftdatafalse").removeClass('hidden');
            $("#zftdatatrue").addClass('hidden');
        }) 
        $("#li3").on('click',function(){
            $("#bocomdatatrue").removeClass('hidden');
            $("#bocomdatafalse").addClass('hidden');
        }) 
        $("#li4").on('click',function(){
            $("#bocomdatafalse").removeClass('hidden');
            $("#bocomdatatrue").addClass('hidden');
        }) 
        
    }
    dialog();
    function dialog(){
        $(".log").unbind()
        $(".log").on('click',function(){
            var self = this,
                    time = $(self).attr('data-time'),
                    clas = $(self).attr('data-class'),
                    description = $(self).attr('data-des'),
                    textAndPic = $('<div></div>');
            textAndPic.append('<b>时间：</b>' + time + '</br><hr>');
           /* textAndPic.append('<b>类名：</b>' + clas + '</br><hr>');*/
            textAndPic.append('<b>附加信息：</b>' + description + '</br>');

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
        })
    }
    //消息推送
    function update(index, data) {
                if (index === 1) {//获取智付通正常日志
                    var ul = $("#zftdatatrue");
                    var time = ul.find("li:first").attr('data-time');
                    if (data.length >= 1) {console.log(data)
                        var obj = eval ("(" + data + ")");
                        var ul = $("#zftdatatrue");
                        var html = 
                            '<li class="log" data-time="'+obj.Time+'" data-class="'+obj.Class+'" data-des="'+obj.Description+'">'+
                                '<h5 style="font-size:15px;text-align:left;font-color:#222222;">'+
                                '|'+obj.Time+'|'+obj.Class+'|'+obj.Ip+'|'+obj.LogName+'|'+
                                '</h5>'+
                                '<p style="font-size:13px;text-align:left;">'+
                                     obj.Description.substr(0,100)+
                                '</p>'+
                            '<hr>'+
                            '</li>'
                        var liHeight = ul.find("li:last").height();
                        ul.animate({ marginTop: liHeight + 20 + "px" }, 1000, function () {
                            $(html).prependTo(ul);
                            dialog();
                            ul.find("li:first").hide();
                            ul.css({ marginTop: 0 });
                            ul.find("li:first").fadeIn(1000);
                            ul.find("li:last").remove();
                        });
                    }
                };
                if (index === 2) {//获取智付通错误日志
                    if (data.length >= 1) {
                        var obj = eval ("(" + data + ")");
                        var ul = $("#zftdatafalse");
                        var html =
                                '<li class="log" data-time="'+obj.Time+'" data-class="'+obj.Class+'" data-des="'+obj.Exception+'">'+
                                '<h5 style="font-size:15px;text-align:left;font-color:#222222;">'+
                                '|'+obj.Time+'|'+obj.Class+'|'+obj.Ip+'|'+obj.LogName+'|'+
                                '</h5>'+
                                '<p style="font-size:13px;text-align:left;">'+
                                    obj.Exception.substr(0,100)+
                                '</p>'+
                                '<hr>'+
                                '</li>'
                        var liHeight = ul.find("li:last").height();
                        ul.animate({ marginTop: liHeight + 20 + "px" }, 1000, function () {
                            $(html).prependTo(ul);
                            dialog();
                            ul.find("li:first").hide();
                            ul.css({ marginTop: 0 });
                            ul.find("li:first").fadeIn(1000);
                            ul.find("li:last").remove();
                        });
                    }
                };
                if (index === 3) {//获取交行正常日志
                    console.log(data);
                    if (data.length >= 1) {
                        var obj = JSON.parse(str);
                        var ul = $("#bocomdatatrue");
                        var html =
                                '<li class="log" data-time="'+obj.Trade_Time+'" data-class="'+obj.Trade_Type+'" data-des="'+obj.Message+'">'+
                                '<h5 style="font-size:15px;text-align:left;font-color:#222222;">'+
                                '|'+obj.Trade_Time+'|'+obj.Trade_Type+'|'+obj.Pin_Code+'|'+obj.Ftag+'|'+'|'+obj.Resp_No+'|'+
                                '</h5>'+
                                '<p style="font-size:13px;text-align:left;">'+
                                    obj.Message.substr(0,100)+
                                '</p>'+
                                '<hr>'+
                                '</li>'
                        var liHeight = ul.find("li:last").height();
                        ul.animate({ marginTop: liHeight + 20 + "px" }, 1000, function () {
                            $(html).prependTo(ul);
                            dialog();
                            ul.find("li:first").hide();
                            ul.css({ marginTop: 0 });
                            ul.find("li:first").fadeIn(1000);
                            ul.find("li:last").remove();
                        });
                    }
                };
                if (index === 4) {//获取交行错误日志
                    if (data.length >= 1) {
                        var obj = eval ("(" + data + ")");
                        var ul = $("#bocomdatafalse");
                        var html =
                                '<li class="log" data-time="'+obj.Trade_Time+'" data-class="'+obj.Trade_Type+'" data-des="'+obj.Message+'">'+
                                '<h5 style="font-size:15px;text-align:left;font-color:#222222;">'+
                                '|'+obj.Trade_Time+'|'+obj.Trade_Type+'|'+obj.Pin_Code+'|'+obj.Ftag+'|'+'|'+obj.Resp_No+'|'+
                                '</h5>'+
                                '<p style="font-size:13px;text-align:left;">'+
                                    obj.Message.substr(0,100)+
                                '</p>'+
                                '<hr>'+
                                '</li>'
                        var liHeight = ul.find("li:last").height();
                        ul.animate({ marginTop: liHeight + 20 + "px" }, 1000, function () {
                            $(html).prependTo(ul);
                            dialog();
                            ul.find("li:first").hide();
                            ul.css({ marginTop: 0 });
                            ul.find("li:first").fadeIn(1000);
                            ul.find("li:last").remove();
                        });
                    }
                };
            };
</script>
    <script>
        //workman消息推送
        var ws = new WebSocket('ws://192.168.10.147:1993');
        ws.onopen = function(){
            var uid = 'uid1';
            ws.send(uid);

        };
        ws.onmessage = function(e){
            str = e.data;
            console.log(e.data);
            var obj = JSON.parse(str);
           
            console.log(typeof(obj.IsErrorLog));
            if (typeof(obj.IsErrorLog) == "boolean") {
                if (obj.IsErrorLog == true) {
                    update(2, str);
                } else {
                    update(1, str);
                }
            } 
            if (typeof(obj.Succeed) == "boolean") {
                if (obj.Succeed == true) {
                    update(3, str);
                } else {
                    update(4, str);
                }
            } 
        };
    </script>
@endsection
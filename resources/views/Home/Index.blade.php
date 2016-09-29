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
        

        //消息推送控制
        var scrtime;
        $("#zftdatatrue").hover(function () {
            clearInterval(scrtime);
            if ($("#bocomdatafalse").hasClass("hidden")){
                scrtime = setInterval('update(3)', 3000);
            } else {
                scrtime = setInterval('update(4)', 3000);
            }
        }, function () {
            clearInterval(scrtime);
            scrtime = setInterval('update(0)', 3000);
        }).trigger("mouseleave");
        $("#zftdatafalse").hover(function () {
            clearInterval(scrtime);
            if ($("#bocomdatafalse").hasClass("hidden")){
                scrtime = setInterval('update(3)', 3000);
            } else {
                scrtime = setInterval('update(4)', 3000);
            }
        }, function () {
            clearInterval(scrtime);
            scrtime = setInterval('update(0)', 3000);
        }).trigger("mouseleave");
        $("#bocomdatatrue").hover(function () {
            clearInterval(scrtime);
            if ($("#zftdatafalse").hasClass("hidden"))
            {
                scrtime = setInterval('update(1)', 3000);
            } else {
                scrtime = setInterval('update(2)', 3000);
            }
        }, function () {
            clearInterval(scrtime);
            scrtime = setInterval('update(0)', 3000);
        }).trigger("mouseleave");
        $("#bocomdatafalse").hover(function () {
            clearInterval(scrtime);
            if ($("#zftdatafalse").hasClass("hidden"))
            {
                scrtime = setInterval('update(1)', 3000);
            } else {
                scrtime = setInterval('update(2)', 3000);
            }
        }, function () {
            clearInterval(scrtime);
            scrtime = setInterval('update(0)', 3000);

        }).trigger("mouseleave");
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
            textAndPic.append('<b>类名：</b>' + clas + '</br><hr>');
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
    function update(index) {
                if (index === 1) {//获取智付通正常日志
                    var ul = $("#zftdatatrue");
                    var time = ul.find("li:first").attr('data-time');
                    $.ajax({
                        type:'get',
                        url: '{{ url('') }}'+'/zfttrue',
                        dataType: 'json',
                        headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
                        success: function (data) {
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
                        }
                    });
                };
                if (index === 2) {//获取智付通错误日志
                    $.ajax({
                        type:'get',
                        url: '{{ url('') }}'+'/zfterr',
                        dataType: 'json',
                        headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
                        success: function (data) {
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
                        }
                    });

                };
                if (index === 3) {//获取交行正常日志
                    $.ajax({
                        type:'get',
                        url: '{{ url('') }}'+'/bocomtrue',
                        dataType: 'json',
                        headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
                        success: function (data) {
                            if (data.length >= 1) {
                                var obj = eval ("(" + data + ")");
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
                        }
                    });
                };
                if (index === 4) {//获取交行错误日志
                    $.ajax({
                        type:'get',
                        url: '{{ url('') }}'+'/bocomerr',
                        dataType: 'json',
                        headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
                        success: function (data) {
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
                        }
                    });
                };
                if (index === 0) {//获取交行错误日志
                    var ul = $("#zftdatatrue");
                    var time = ul.find("li:first").attr('data-time');
                    $.ajax({
                        type: 'get',
                        url: '{{ url('') }}' + '/zfttrue',
                        dataType: 'json',
                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                        success: function (data) {
                            if (data.length >= 1) {
                                var obj = eval("(" + data + ")");
                                var ul = $("#zftdatatrue");
                                var html =
                                        '<li class="log" data-time="' + obj.Time + '" data-class="' + obj.Class + '" data-des="' + obj.Description + '">' +
                                        '<h5 style="font-size:15px;text-align:left;font-color:#222222;">' +
                                        '|' + obj.Time + '|' + obj.Class + '|' + obj.Ip + '|' + obj.LogName + '|' +
                                        '</h5>' +
                                        '<p style="font-size:13px;text-align:left;">' +
                                        obj.Description.substr(0, 100) +
                                        '</p>' +
                                        '<hr>' +
                                        '</li>'
                                var liHeight = ul.find("li:last").height();
                                ul.animate({marginTop: liHeight + 20 + "px"}, 1000, function () {
                                    $(html).prependTo(ul);
                                    dialog();
                                    ul.find("li:first").hide();
                                    ul.css({marginTop: 0});
                                    ul.find("li:first").fadeIn(1000);
                                    ul.find("li:last").remove();
                                });

                            }
                        }
                    });

                    $.ajax({
                        type:'get',
                        url: '{{ url('') }}'+'/zfterr',
                        dataType: 'json',
                        headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
                        success: function (data) {
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
                        }
                    });
                    $.ajax({
                        type:'get',
                        url: '{{ url('') }}'+'/bocomtrue',
                        dataType: 'json',
                        headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
                        success: function (data) {
                            if (data.length >= 1) {
                                var obj = eval ("(" + data + ")");
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
                        }
                    });
                    $.ajax({
                        type:'get',
                        url: '{{ url('') }}'+'/bocomerr',
                        dataType: 'json',
                        headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
                        success: function (data) {
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
                        }
                    });
                }
            };
</script>

    <!-- <script>
        var index = index || {
            url: "/api/InsertLog/GetLog?p=1&pagesize=5&Normal=true",
            errorurl: "/api/InsertLog/GetLog?p=1&pagesize=5&error=true"
        };
        var padChart = echarts.init(document.getElementById('pad'));
        var jhChart = echarts.init(document.getElementById('jh'));
        (function () {
            $(document).ready(function () {
                $('#1').addClass('active');
                index.charts();
                index.li();
                //index.update();
                //index.scroll();
                index.interval();
            });
            index.li = function () {
                $.ajax({
                    url: index.url,
                    dataType: 'json',
                    success: function (data) {
                        if (data.length > 1) {
                            var interText = doT.template($("#interpolationtmpl").text());
                            $("#interpolation").html(interText(data));
                        }
                    }
                });
                $.ajax({
                    url: index.errorurl,
                    dataType: 'json',
                    success: function (data) {
                        if (data.length > 1) {
                            var interText = doT.template($("#interpolationtmpl").text());
                            $("#errorul").html(interText(data));
                        }
                    }
                });
            };
            index.scroll = function () {
                var scrtime;
                $("#interpolation").hover(function () {
                    clearInterval(scrtime);
                }, function () {
                    scrtime = setInterval(function () {
                        var ul = $("#interpolation");
                        var liHeight = ul.find("li:last").height();
                        ul.animate({ marginTop: liHeight + 40 + "px" }, 1000, function () {
                            ul.find("li:last").prependTo(ul)
                            ul.find("li:first").hide();
                            ul.css({ marginTop: 0 });
                            ul.find("li:first").fadeIn(1000);
                        });

                    }, 3000);
                }).trigger("mouseleave");
            };
            index.update = function (index) {
                var ul = $("#interpolation");
                var time = ul.find("li:first").attr('data-time');
                if (index === 1) {
                    $.ajax({
                        url: '/api/InsertLog/GetLog?Normal=true&p=1&pagesize=1&StartTime=' + time,
                        dataType: 'json',
                        success: function (data) {
                            if (data.length >= 1) {
                                var interText = doT.template($("#interpolationtmpl").text());
                                var html = interText(data);
                                var ul = $("#interpolation");
                                var liHeight = ul.find("li:last").height();
                                ul.animate({ marginTop: liHeight + 20 + "px" }, 1000, function () {
                                    $(html).prependTo(ul)
                                    ul.find("li:first").hide();
                                    ul.css({ marginTop: 0 });
                                    ul.find("li:first").fadeIn(1000);
                                    ul.find("li:last").remove();
                                });
                       
                            }
                        }
                    });
                };
                if (index === 2) {
                    $.ajax({
                        url: '/api/InsertLog/GetLog?Error=true&p=1&pagesize=1&StartTime=' + time,
                        dataType: 'json',
                        success: function (data) {
                            if (data.length >= 1) {
                                var interText = doT.template($("#interpolationtmpl").text());
                                var html = interText(data);
                                var ul = $("#errorul");
                                var liHeight = ul.find("li:last").height();
                                ul.animate({ marginTop: liHeight + 20 + "px" }, 1000, function () {
                                    $(html).prependTo(ul)
                                    ul.find("li:first").hide();
                                    ul.css({ marginTop: 0 });
                                    ul.find("li:first").fadeIn(1000);
                                    ul.find("li:last").remove();
                                });
                            }
                        }
                    });
                };
                if (index === 0) {
                    $.ajax({
                        url: '/api/InsertLog/GetLog?Normal=true&p=1&pagesize=1&StartTime=' + time,
                        dataType: 'json',
                        success: function (data) {
                            if (data.length >= 1) {
                                var interText = doT.template($("#interpolationtmpl").text());
                                var html = interText(data);
                                var ul = $("#interpolation");
                                var liHeight = ul.find("li:last").height();
                                ul.animate({ marginTop: liHeight + 20 + "px" }, 1000, function () {
                                    $(html).prependTo(ul)
                                    ul.find("li:first").hide();
                                    ul.css({ marginTop: 0 });
                                    ul.find("li:first").fadeIn(1000);
                                    ul.find("li:last").remove();
                                });
                            }
                        }
                    });
                    $.ajax({
                        url: '/api/InsertLog/GetLog?Error=true&p=1&pagesize=1&StartTime=' + time,
                        dataType: 'json',
                        success: function (data) {
                            if (data.length >= 1) {
                                var interText = doT.template($("#interpolationtmpl").text());
                                var html = interText(data);
                                var ul = $("#errorul");
                                var liHeight = ul.find("li:last").height();
                                ul.animate({ marginTop: liHeight + 20 + "px" }, 1000, function () {
                                    $(html).prependTo(ul)
                                    ul.find("li:first").hide();
                                    ul.css({ marginTop: 0 });
                                    ul.find("li:first").fadeIn(1000);
                                    ul.find("li:last").remove();
                                });
                            }
                        }
                    });
                };


            };
            index.interval = function () {
                var scrtime;
                $("#interpolation").hover(function () {
                    clearInterval(scrtime);
                    scrtime = setInterval('index.update(2)', 3000);
                    index.click();
                }, function () {
                    clearInterval(scrtime);
                    scrtime = setInterval('index.update(0)', 3000);
                }).trigger("mouseleave");
                $("#errorul").hover(function () {
                    clearInterval(scrtime);
                    scrtime = setInterval('index.update(1)', 3000);
                    index.click();
                }, function () {
                    clearInterval(scrtime);
                    scrtime = setInterval('index.update(0)', 3000);
                }).trigger("mouseleave");
            };})
            
    
    </script> -->
@endsection
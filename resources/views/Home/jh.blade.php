@extends('main')
@section('title', '交行')

@section('content')
<h2 class="sub-header">交行</h2>

<p>共找到：{{$totalCounts}} 条数据</p>
<nav><ul class="pagination pagination-demo pagination-sm"></ul></nav><div class="table-responsive">

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
            @foreach($bocom as $value)
                <tr data-trade_time="{{$value->Trade_Time}}" data-trade_type="{{$value->Trade_Type}}" data-resp_no="{{$value->Resp_NO}}"
                    data-pin_code="{{$value->Pin_Code}}" data-ftag="{{$value->Ftag}}" data-message="{{$value->Message}}" class="zft-tr">
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
@endsection

@section('script')
    <link href="/Scripts/dialog/css/bootstrap-dialog.min.css" rel="stylesheet" />
    <script src="/Scripts/dialog/js/bootstrap-dialog.min.js"></script>
    <script src="/Scripts/jqPaginator.min.js"></script>
    <script>

        var list = list || {};
        (function () {
            $(document).ready(function () {

                list.click();
                list.page();
            });
            list.click = function () {
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
            };
            list.page = function(){
             
                $(".pagination-demo").jqPaginator({
                    totalCounts:{{$totalCounts}},
                    pageSize: 15,
                    visiblePages: 10,
                    currentPage: {{$page}},
                    first: '<li class="first"><a href="/bocom/1">首页</a></li>',
                    prev: '<li class="prev"><a href="/bocom/@{{page}}">上一页</a></li>',
                    next: '<li class="next"><a href="/bocom/@{{page}}">下一页</a></li>',
                    last: '<li class="last"><a href="/bocom/@{{totalPages}}">末页</a></li>',
                    page: '<li class="page"><a href="/bocom/@{{page}}">@{{page}}</a></li>',
                    onPageChange: function (n) {
                        $(".pagination-demo .disabled").each(function(){
                            $(this).find('a').attr('href','#');
                        })
                    }
                });
            };
        })();
    </script>
@endsection






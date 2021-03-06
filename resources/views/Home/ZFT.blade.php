﻿@extends('main')
@section('title', 'pad智付通')

@section('content')
<h2 class="sub-header">pad智付通</h2>

<p>共找到：{{$totalCounts}} 条数据</p>
<nav><ul class="pagination pagination-demo pagination-sm"></ul></nav>


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
            @foreach($zft as $value)
                <tr data-accno="{{$value->AccNo}}" data-devno="{{$value->DevNo}}" data-time="{{$value->Time}}" data-class="{{$value->Class}}"
                    data-ip="{{$value->Ip}}" data-level="{{$value->Level}}" data-description="{{$value->Description}}" data-label="{{$value->Label}}"
                    data-ex="{{$value->Exception}}" data-iserrorlog="{{$value->IsErrorLog}}" data-logname="{{$value->LogName}}" class="zft-tr">
                    @if($value->IsErrorLog)
                        <th><span class="glyphicon glyphicon-remove"></span>&nbsp;{{$value->AccNo}}</th>
                    @else
                        <th><span class="glyphicon glyphicon-ok"></span>&nbsp;{{$value->AccNo}}</th>
                    @endif
                        <th>{{$value->DevNo}}</th>
                        <th>{{$value->Time}}</th>
                        <th>{{$value->Class}}</th>
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
                $('#2').addClass('active');
                list.click();
                list.page();
            });
            list.click = function () {
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
            };
            list.page=function(){
                $(".pagination-demo").jqPaginator({
                    totalCounts: {{$totalCounts}},
                    pageSize: 15,
                    visiblePages: 10,
                    currentPage: {{$page}},
                    first: '<li class="first"><a href="/zft/1">首页<\/a><\/li>',
                    prev: '<li class="prev"><a href="/zft/@{{page}}">上一页<\/a><\/li>',
                    next: '<li class="next"><a href="/zft/@{{page}}">下一页<\/a><\/li>',
                    last: '<li class="last"><a href="/zft/@{{totalPages}}">末页<\/a><\/li>',
                    page: '<li class="page"><a href="/zft/@{{page}}">@{{page}}<\/a><\/li>',
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
@extends('main')
@section('title', '定时任务管理')

@section('content')
    <h2 class="sub-header">任务流水</h2>
    <p>共找到：{{$totalCounts}} 条数据</p>
    <div class="table-responsive" style="">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>任务编号</th>
                <th>任务执行时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($taskFlow as $value)
                <tr class="zft-tr" >
                    <th>{{$value->name}}</th>
                    <th>{{$value->time}}</th>
                    <th><a id="" class="btn" href="/taskflowshow/{{$value->name}}/{{$value->time}}/1">查看</a></th>
                </tr>
            @endforeach
            </tbody>
        </table>
        <ul class="pagination pagination-demo"></ul>
    </div>

@endsection

@section('script')
    <script src="/Scripts/jqPaginator.min.js"></script>
    <link href="/Scripts/dialog/css/bootstrap-dialog.min.css" rel="stylesheet" />
    <script src="/Scripts/dialog/js/bootstrap-dialog.min.js"></script>
    <script>
        $(".pagination-demo").jqPaginator({
            totalCounts: {{$totalCounts}},
            pageSize: 15,
            visiblePages: 10,
            currentPage: {{$page}},
            first: '<li class="first"><a href="/task/1">首页<\/a><\/li>',
            prev: '<li class="prev"><a href="/task/@{{page}}">上一页<\/a><\/li>',
            next: '<li class="next"><a href="/task/@{{page}}">下一页<\/a><\/li>',
            last: '<li class="last"><a href="/task/@{{totalPages}}">末页<\/a><\/li>',
            page: '<li class="page"><a href="/task/@{{page}}">@{{page}}<\/a><\/li>',
            onPageChange: function (n) {
                $(".pagination-demo .disabled").each(function(){
                    $(this).find('a').attr('href','#');
                })
            }
        });

    </script>

@endsection
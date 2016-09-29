@extends('main')
@section('title', '定时任务管理')

@section('content')
    <h2 class="sub-header">定时任务管理</h2>

    <div class="table-responsive" >
        <table class="table table-striped">
            <thead>
            <tr>
                <th>name</th>
                <th>expression</th>
                <th>function</th>
                <th>enable</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($task as $value)
                <tr class="zft-tr" >
                    <th>{{$value->name}}</th>
                    <th>{{$value->expression}}</th>
                    <th>{{$value->function}}</th>
                    @if ($value->enable == true)
                        <th>true</th>
                    @else
                        <th>false</th>
                    @endif
                    <th><a id="" class="btn" href="/taskshow/{{$value->name}}/1">查看结果</a>
                        <a id="" class="btn" href="/task/{{$value->name}}/1">查看流水</a>
                        @if ($value->enable == true)
                            <button id="taskClose" onclick="taskclose({{$value->name}})" class="btn" value="{{$value->name}}">关闭</button></th>
                        @else
                            <button id="taskClose" onclick="taskopen({{$value->name}})" class="btn" value="{{$value->name}}">开启</button></th>
                        @endif
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
        $(function(){
            $(".pagination-demo").jqPaginator({
                totalCounts: {{$totalCounts}},
                pageSize: 15,
                visiblePages: 10,
                currentPage: {{$page}},
                first: '<li class="first"><a href="/taskmanage/1">首页<\/a><\/li>',
                prev: '<li class="prev"><a href="/taskmanage/@{{page}}">上一页<\/a><\/li>',
                next: '<li class="next"><a href="/taskmanage/@{{page}}">下一页<\/a><\/li>',
                last: '<li class="last"><a href="/taskmanage/@{{totalPages}}">末页<\/a><\/li>',
                page: '<li class="page"><a href="/taskmanage/@{{page}}">@{{page}}<\/a><\/li>',
                onPageChange: function (n) {
                    $(".pagination-demo .disabled").each(function () {
                        $(this).find('a').attr('href', '#');
                    })
                }
            });

        })
        function taskclose(name) {
            $.ajax({
                type: 'get',
                url: '{{ url('') }}' + '/taskclose/' + name,
                dataType: 'json',
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                success: function (resp) {
                    alert(resp);
                    location.reload();
                },
                error: function (resp) {
                    alert("提交失败");
                }
            })
        }

        function taskopen(name) {
            $.ajax({
                type: 'get',
                url: '{{ url('') }}' + '/taskopen/' + name,
                dataType: 'json',
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                success: function (resp) {
                    alert(resp);
                    location.reload();
                },
                error: function (resp) {
                    alert("提交失败");
                }
            })
        }
    </script>

@endsection
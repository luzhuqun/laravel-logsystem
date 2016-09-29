<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\task;
use App\Models\taskResult;
use App\Models\taskFlow;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class TaskController extends Controller
{
    /**
     * @param $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 任务流水查看
     */
    public function index($id, $page)
    {
        if ($id == '0') {
            $start = $page*15-15;
            $taskFlow = taskFlow::skip($start)->take(15)->orderBy('time','desc')->get();
            $totalCounts = taskFlow::count();
            return view('Home.task',['taskFlow'=>$taskFlow, 'page'=>$page, 'totalCounts'=>$totalCounts]);
        } else {
            $start = $page*15-15;
            $taskFlow = taskFlow::where('name',$id)->skip($start)->take(15)->orderBy('time','desc')->get();
            $totalCounts = taskFlow::where('name',$id)->count();
            return view('Home.task',['taskFlow'=>$taskFlow, 'page'=>$page, 'totalCounts'=>$totalCounts]);
        }
    }

    /**
     * @param $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 任务管理
     */
    public function manage($page)
    {
        $start = $page*15-15;
        $task = task::skip($start)->take(15)->get();
        $totalCounts = task::count();
        return view('Home.taskManage',['task'=>$task, 'page'=>$page, 'totalCounts'=>$totalCounts]);
    }

    /**
     * @param $id
     * @param $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 显示任务结果
     */
    public function show($id, $page)
    {
        $start = $page*15-15;
        $taskResult = taskResult::where('taskName',$id)->skip($start)->take(15)->get();
        $first = taskResult::where('taskName',$id)->first();
        $totalCounts = taskResult::where('taskName',$id)->count();
        if (is_null($first)){
            return view('Home.taskResult',['taskResult'=>$taskResult, 'page'=>$page, 'totalCounts'=>$totalCounts,'type'=>'0', 'id'=>$id]);
        }
        $explode = explode('|', $first->function);
        return view('Home.taskResult',['taskResult'=>$taskResult, 'page'=>$page, 'totalCounts'=>$totalCounts, 'type'=>$explode[0], 'id'=>$id]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 创建定时任务
     */
    public function store(Request $request)
    {
        $input = Input::all();
        $expression = $input['min'].' '.$input['hour'].' '.$input['dom'].' '.$input['month'].' '.$input['dow'].' '.$input['year'];
        $name = rand(0,999999)+time();
        //创建定时任务
        $task = new task;
        $task->name = (string)$name;
        $task->expression = $expression;
        $task->function = $request->input('taskContent');
        $task->enable = true;
        $task->save();

        $find = task::where('name',(string)$name)->first();
        if (is_null($find)){
            $result['msg'] = '数据库插入失败！';
        } else {
            $result['msg'] = '任务提交成功！';
        }
        return response()->json($result);
    }

    /**
     * @param $name
     * @return string
     * 任务管理界面关闭任务功能
     */
    public function close($name)
    {
        $task = task::where('name',$name)->first();
        $task->enable = false;
        $task->save();

        $find = task::where('name',$name)->where('enable',false)->first();
        if (is_null($find)) {
            $result = "任务关闭失败";
        } else {
            $result = "任务关闭成功";
        }
        return json_encode($result);
    }

    /**
     * @param $name
     * @return string
     * 任务开启
     */
    public function open($name)
    {
        $task = task::where('name',$name)->first();
        $task->enable = true;
        $task->save();

        $find = task::where('name',$name)->where('enable',true)->first();
        if (is_null($find)) {
            $result = "任务开启失败";
        } else {
            $result = "任务开启成功";
        }
        return json_encode($result);
    }

    /**
     * @param $id
     * @param $time
     * @param $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 任务流水查看功能
     */
    public function flowShow($id, $time, $page)
    {
        $start = $page*15-15;
        $taskResult = taskResult::where('taskName', $id)->where('taskTime', $time)->skip($start)->take(15)->get();
        $first = taskResult::where('taskName',$id)->where('taskTime', $time)->first();
        $totalCounts = taskResult::where('taskName',$id)->where('taskTime', $time)->count();
        if (is_null($first)){
            return view('Home.taskResult',['taskResult'=>$taskResult, 'page'=>$page, 'totalCounts'=>$totalCounts,'type'=>'0', 'id'=>$id]);
        }
        $explode = explode('|', $first->function);
        return view('Home.taskFlowResult',['taskResult'=>$taskResult, 'page'=>$page, 'totalCounts'=>$totalCounts, 'type'=>$explode[0], 'id'=>$id, 'time'=>$time]);
    }
}

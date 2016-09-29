<?php

namespace App\Providers;
use App\Models\task;
use App\Models\taskResult;
use App\Models\bocom;
use App\Models\zft;
use App\Models\taskFlow;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $function;
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Please note the different namespace
        // and please add a \ in front of your classes in the global namespace
        \Event::listen('cron.collectJobs', function() {
            $tasks = task::all();

            foreach ($tasks as $task) {

                \Cron::add((string)$task->name, $task->expression, function() use($task) {
                    $function = $task->function;
                    $explode = explode('|', $function);
                    $dateTime = date('Y-m-d H:i:s', time());
                    switch ($explode['0'])
                    {
                        case 'zft':
                            if ($explode['10'] == 'normal') {
                                $query = zft::where('IsErrorLog',false);
                            } elseif ($explode['10'] == 'abnormal') {
                                $query = zft::where('IsErrorLog',true);
                            } else {
                                $query = zft::whereIn('IsErrorLog',[false,true]);
                            }
                            $start = \DateTime::createFromFormat('Y-m-d H:i', $explode['1']);
                            $end = \DateTime::createFromFormat('Y-m-d H:i', $explode['2']);

                            $query = empty($explode['3'])?$query:$query->where('Level',intval($explode['3']));
                            $query = empty($explode['4'])?$query:$query->where('DevNo','like','%'.$explode['4'].'%');
                            $query = empty($explode['5'])?$query:$query->where('Class','like','%'.$explode['5'].'%');
                            $query = empty($explode['6'])?$query:$query->where('AccNo','like','%'.$explode['6'].'%');
                            $query = empty($explode['7'])?$query:$query->where('Description','like','%'.$explode['7'].'%');
                            $query = empty($explode['8'])?$query:$query->where('Exception','like','%'.$explode['8'].'%');
                            $query = empty($explode['9'])?$query:$query->where('LogName','like','%'.$explode['9'].'%');
                            $search = $query->where('Time','>',$start)->where('Time','<',$end)->get();
                            //将搜索结果添加进结果表
                            foreach ($search as $value) {
                                $taskResult = new taskResult;
                                $taskResult->taskName = $task->name;

                                $taskResult->Level = $value->Level;
                                $taskResult->Lable = $value->Lable;
                                $taskResult->DevNo = $value->DevNo;
                                $taskResult->Class = $value->Class;
                                $taskResult->AccNo = $value->AccNo;
                                $taskResult->Description = $value->Description;
                                $taskResult->Exception = $value->Exception;
                                $taskResult->Time = $value->Time;
                                $taskResult->LogName = $value->LogName;
                                $taskResult->IsErrorLog = $value->IsErrorLog;
                                $taskResult->__v = $value->__v;

                                $taskResult->taskTime = $dateTime;
                                $taskResult->function = $task->function;
                                $taskResult->save();
                            }

                            break;
                        case 'bocom':
                            if ($explode['8'] == 'normal') {
                                $query = bocom::where('Succeed',true);
                            } elseif ($explode['8'] == 'abnormal') {
                                $query = bocom::where('Succeed',false);
                            } else {
                                $query = bocom::whereIn('Succeed',[false,true]);
                            }
                            $start = $explode['1'];
                            $end = $explode['2'];
                            $query = empty($explode['3'])?$query:$query->where('Trade_Type','like','%'.$explode['3'].'%');
                            $query = empty($explode['4'])?$query:$query->where('Message','like','%'.$explode['4'].'%');
                            $query = empty($explode['5'])?$query:$query->where('Resp_No','like','%'.$explode['5'].'%');
                            $query = empty($explode['6'])?$query:$query->where('Ftag','like','%'.$explode['6'].'%');
                            $query = empty($explode['7'])?$query:$query->where('Pin_Code','like','%'.$explode['7'].'%');
                            $search = $query->where('Trade_Time','>',$start)->where('Trade_Time','<',$end)->get();
                            //将搜索结果添加进结果表
                            foreach ($search as $value) {
                                $taskResult = new taskResult;
                                $taskResult->taskName = $task->name;

                                $taskResult->Trade_Type = $value->Trade_Type;
                                $taskResult->Succeed = $value->Succeed;
                                $taskResult->Trade_Time = $value->Trade_Time;
                                $taskResult->Message = $value->Message;
                                $taskResult->Resp_No = $value->Resp_No;
                                $taskResult->Ftag = $value->Ftag;
                                $taskResult->Pin_Code = $value->Pin_Code;

                                $taskResult->taskTime = $dateTime;
                                $taskResult->function = $task->function;
                                $taskResult->save();
                            }
                            break;
                    }

                    $taskFlow = new taskFlow;
                    $taskFlow->name = $task->name;
                    $taskFlow->time = $dateTime;
                    $taskFlow->save();
                }, (bool)$task->enable);

            }
            //\Cron::setDisablePreventOverlapping();
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

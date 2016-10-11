<?php

namespace App\Http\Controllers;

use App\Models\task;
use Illuminate\Http\Request;
use App\Models\bocom;
use App\Models\zft;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Home.Search');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($page, $id)
    {
        $explode = explode('|',$id);

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
                $start = $explode['1'];
                $end = $explode['2'];

                $query = empty($explode['3'])?$query:$query->where('Level',intval($explode['3']));
                $query = empty($explode['4'])?$query:$query->where('DevNo','like','%'.$explode['4'].'%');
                $query = empty($explode['5'])?$query:$query->where('Class','like','%'.$explode['5'].'%');
                $query = empty($explode['6'])?$query:$query->where('AccNo','like','%'.$explode['6'].'%');
                $query = empty($explode['7'])?$query:$query->where('Description','like','%'.$explode['7'].'%');
                $query = empty($explode['8'])?$query:$query->where('Exception','like','%'.$explode['8'].'%');
                $query = empty($explode['9'])?$query:$query->where('LogName','like','%'.$explode['9'].'%');

                $totalCounts = $query->where('Time','>',$start)->where('Time','<',$end)->count();
                $startPage = $page*15-15;
                $search['0'] = $query->where('Time','>',$start)->where('Time','<',$end)->skip($startPage)->take(15)->get();
                $search['1'] = $totalCounts;
                $search['2'] = intval($page);

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

                $totalCounts = $query->where('Trade_Time','>',$start)->where('Trade_Time','<',$end)->count();
                $startPage = $page*15-15;
                $search['0'] = $query->where('Trade_Time','>',$start)->where('Trade_Time','<',$end)->skip($startPage)->take(15)->get();
                $search['1'] = $totalCounts;
                $search['2'] = intval($page);
                break;
        }
        return json_encode($search);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

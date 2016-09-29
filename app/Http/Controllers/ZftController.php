<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\zft;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ZftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page)
    {
        $totalCounts = zft::count();
        $start = $page*15-15;
        $totalPages  = ceil($totalCounts/15);
        $zft = zft::skip($start)->take(15)->get();
        return view('Home.ZFT',['zft' => $zft, 'totalCounts' => $totalCounts, 'page' => $page,
            'totalPages' => $totalPages]);
    }

    /**
     * pad智付通(异常)
     */
    public function exception($page)
    {
        $totalCounts = zft::where('IsErrorLog',true)->count();
        $start = $page*15-15;
        $totalPages  = ceil($totalCounts/15);
        $zft = zft::where('IsErrorLog',true)->skip($start)->take(15)->get();
        return view('Home.ZFTError',['zft' => $zft, 'totalCounts' => $totalCounts, 'page' => $page,
            'totalPages' => $totalPages]);
    }

    /**
     * pad智付通统计
     */
    public function statistics()
    {
        $zft = zft::where('IsErrorLog',true)->where('Time', '>', new \DateTime("-1 month"))->get();
        $err = array();
        $class = array();
        $amount = array();

        foreach($zft as $value)//初始化
        {
            $err[$value->Class]=0;
        }
        foreach($zft as $value)
        {
            $err[$value->Class]++;
        }
        arsort($err);//排序
        $i=0;
        foreach($err as $key => $value) {
            $class[$i] = $key;
            $amount[$i] = $value;
            $i++;
        }
        return view('Home.ZFTStatistics', ['class' => $class, 'amount' => $amount]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

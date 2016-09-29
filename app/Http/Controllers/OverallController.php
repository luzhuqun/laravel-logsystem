<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\zft;
use App\Models\bocom;
use App\Http\Requests;
use App\Http\Controllers\Controller;


class OverallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()//总体统计
    {
        $datetime = \DateTime::createFromFormat('Y-m-d h:i:s.u', '2016-01-26 00:00:00.000000');
        $date0 = date_add($datetime, date_interval_create_from_date_string('+1 days'));
        $datetime = \DateTime::createFromFormat('Y-m-d h:i:s.u', '2016-01-26 00:00:00.000000');
        $date1 = date_add($datetime, date_interval_create_from_date_string('-1 days'));
        $datetime = \DateTime::createFromFormat('Y-m-d h:i:s.u', '2016-01-26 00:00:00.000000');
        $date2 = date_add($datetime, date_interval_create_from_date_string('-2 days'));
        $datetime = \DateTime::createFromFormat('Y-m-d h:i:s.u', '2016-01-26 00:00:00.000000');
        $date3 = date_add($datetime, date_interval_create_from_date_string('-3 days'));
        $datetime = \DateTime::createFromFormat('Y-m-d h:i:s.u', '2016-01-26 00:00:00.000000');
        $date4 = date_add($datetime, date_interval_create_from_date_string('-4 days'));
        $datetime = \DateTime::createFromFormat('Y-m-d h:i:s.u', '2016-01-26 00:00:00.000000');
        $date5 = date_add($datetime, date_interval_create_from_date_string('-5 days'));
        $datetime = \DateTime::createFromFormat('Y-m-d h:i:s.u', '2016-01-26 00:00:00.000000');
        $date6 = date_add($datetime, date_interval_create_from_date_string('-6 days'));

        $zft1 = zft::where('IsErrorLog',true)->where('Time','>', $datetime)->where('Time','<=', $date0)->count();
        $zft2 = zft::where('IsErrorLog',true)->where('Time','>', $date1)->where('Time','<=', $datetime)->count();
        $zft3 = zft::where('IsErrorLog',true)->where('Time','>', $date2)->where('Time','<=', $date1)->count();
        $zft4 = zft::where('IsErrorLog',true)->where('Time','>', $date3)->where('Time','<=', $date2)->count();
        $zft5 = zft::where('IsErrorLog',true)->where('Time','>', $date4)->where('Time','<=', $date3)->count();
        $zft6 = zft::where('IsErrorLog',true)->where('Time','>', $date5)->where('Time','<=', $date4)->count();
        $zft7 = zft::where('IsErrorLog',true)->where('Time','>', $date6)->where('Time','<=', $date5)->count();

        return view('Home.OverallStatistics',['zft1'=>$zft1, 'zft2'=>$zft2, 'zft3'=>$zft3, 'zft4'=>$zft4, 'zft5'=>$zft5, 'zft6'=>$zft6, 'zft7'=>$zft7]);
    }

    public function overall()//总体
    {
        $zfttrue = zft::where('IsErrorLog',true)->count();
        $zftfalse = zft::where('IsErrorLog',false)->count();
        $bocomtrue = bocom::where('Succeed',true)->count();
        $bocomfalse = bocom::where('Succeed',false)->count();

        $zftdatatrue = zft::where('IsErrorLog',true)->orderBy('Time','desc')->take(5)->get();
        $zftdatafalse = zft::where('IsErrorLog',false)->orderBy('Time','desc')->take(5)->get();
        $bocomdatatrue = bocom::where('Succeed',true)->orderBy('Trade_Time','desc')->take(5)->get();
        $bocomdatafalse = bocom::where('Succeed',false)->orderBy('Trade_Time','desc')->take(5)->get();

        return view('Home.index',['zfttrue'=>$zfttrue, 'zftfalse'=>$zftfalse, 'bocomtrue'=>$bocomtrue, 'bocomfalse'=>$bocomfalse
            , 'zftdatatrue'=>$zftdatatrue, 'zftdatafalse'=>$zftdatafalse, 'bocomdatatrue'=>$bocomdatatrue, 'bocomdatafalse'=>$bocomdatafalse]);
    }

    public function zfterr()//首页推送
    {
        $zfterr = zft::where('IsErrorLog',true)->orderBy('Time','desc')->first()->toJson();
        return json_encode($zfterr);
    }
    public function zft()//首页推送
    {
        $zft = zft::where('IsErrorLog',false)->orderBy('Time','desc')->first()->toJson();
        return json_encode($zft);
    }
    public function bocom()//首页推送
    {
        $bocom = bocom::where('Succeed',true)->orderBy('Trade_Time','desc')->first()->toJson();
        return json_encode($bocom);
    }
    public function bocomerr()//首页推送
    {
        $bocomerr = bocom::where('Succeed',false)->orderBy('Trade_Time','desc')->first()->toJson();
        return json_encode($bocomerr);
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

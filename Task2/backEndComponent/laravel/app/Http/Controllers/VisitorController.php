<?php

namespace App\Http\Controllers;

use App\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Visitor::all();
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
     * @param  \Illuminate\Http\VisitorRequest  $VisitorRequest
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        return Visitor::create(request()->all());
    }

    /**
     * Display the specified resource.
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return  response()->json(['visit_stisstics' => $this->VisitStatistics(), 'city_statistics' => $this->CityStatistics()]);
    }

    /**
     * collect the unique users visit statstics for 24 hours of the current day
     * @return array
     */
    protected function VisitStatistics()
    {
        $statistics =[];
        for ($i=0; $i < 25; $i++) {
            $from = date('Y-m-d') ." 0$i:00:00";
            $j = $i+1;
            $to = date('Y-m-d') ." 0$j:00:00";
            $uniqueVisitors = Visitor::whereBetween('created_at', [$from, $to])->get()->unique('ip')->count();

            if ($uniqueVisitors) {
                $statistics[$i] =  $uniqueVisitors;
            }
        }
        return $statistics;
    }

    /**
    * collect the cities unique users statstics for 24 hours of the current day
    * @return array
    */
    protected function CityStatistics()
    {
        $statistics =[];
        $cities = Visitor::where('created_at', '>=', date('Y-m-d') ." 00:00:00")->get()->groupby('city')->toArray();
        foreach ($cities as $key => $value) {
            $uniqueIps = collect($value)->unique('ip')->count();
            $statistics[] = ['city'=>$key, 'quantity' => $uniqueIps];
        }
        return $statistics;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function edit(Visitor $visitor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\VisitorRequest  $VisitorRequest
     * @param  \App\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $VisitorRequest, Visitor $visitor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visitor $visitor)
    {
        //
    }
}

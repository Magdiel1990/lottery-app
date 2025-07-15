<?php

namespace App\Http\Controllers;

use App\Models\LotteryResult;
use Illuminate\Http\Request;

class LotteryResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $results = LotteryResult::orderBy("draw_date","desc")->get();

        return view("lottery_results/index", compact("results"));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("lottery_results/create");

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            "draw_date"=> "required|date",
            "numbers"=> "required|string"
        ]);

        $numbers = array_map("intval", explode(",", $request->numbers));

        LotteryResult::create([
            'draw_date'=> $request->draw_date,
            'numbers'=> $numbers
        ]);

        return redirect()->route('lottery_results.create')->with('success','Resultado guardado!');
    }

    /**
     * Display the specified resource.
     */
    public function show(LotteryResult $lotteryResult)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LotteryResult $lotteryResult)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LotteryResult $lotteryResult)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LotteryResult $lotteryResult)
    {
        //
    }
}

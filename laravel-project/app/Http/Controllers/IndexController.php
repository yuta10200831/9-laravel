<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spending;
use App\Models\Income;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $years = range(date('Y'), date('Y') - 10);
        $selectedYear = $request->query('year', date('Y'));

        $fixed_data = [];
        for ($month = 1; $month <= 12; $month++) {
            $total_income = Income::whereYear('accrual_date', $selectedYear)
                ->whereMonth('accrual_date', $month)
                ->sum('amount');
            $total_spend = Spending::whereYear('accrual_date', $selectedYear)
                ->whereMonth('accrual_date', $month)
                ->sum('amount');

            $fixed_data[] = [
                'month' => $month . '月',
                'total_income' => $total_income,
                'total_spend' => $total_spend
            ];
        }

        return view('kakeibo.index', [
            'fixed_data' => $fixed_data,
            'years' => $years,
            'selectedYear' => $selectedYear
        ]);
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
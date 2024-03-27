<?php

namespace App\Http\Controllers;
use App\Models\Income;
use App\Models\IncomeSource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Income::query();

        if ($request->filled('income_source_id')) {
            $query->where('income_source_id', $request->income_source_id);
        }
        if ($request->filled('start_date')) {
            $query->whereDate('accrual_date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('accrual_date', '<=', $request->end_date);
        }

        $incomes = $query->with('income_source')->get();
        $totalIncome = $incomes->sum('amount');
        $incomeSources = IncomeSource::all();

        return view('kakeibo.income.index', compact('incomes', 'totalIncome', 'incomeSources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $incomeSources = IncomeSource::all();
        return view('kakeibo.income.create', compact('incomeSources'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = Auth::id();

        $validatedData = $request->validate([
            'income_source_id' => 'required',
            'amount' => 'required|numeric',
            'accrual_date' => 'required|date',
        ]);

        $validatedData['user_id'] = $userId;

        Income::create($validatedData);

        return redirect()->route('incomes.index')->with('success', '収入が登録されました。');
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
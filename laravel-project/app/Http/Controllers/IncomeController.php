<?php

namespace App\Http\Controllers;
use App\Models\Income;
use App\Models\IncomeSource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UseCase\Income\IncomePageInteractor;
use App\UseCase\Income\CreateIncomeInput;
use App\UseCase\Income\CreateIncomeInteractor;
use App\UseCase\Income\UpdateIncomeInput;
use App\UseCase\Income\UpdateIncomeInteractor;

class IncomeController extends Controller
{

    public function __construct(
        IncomePageInteractor $incomePageInteractor,
        CreateIncomeInteractor $createIncomeInteractor,
        UpdateIncomeInteractor $updateIncomeInteractor
        )
    {
        $this->incomePageInteractor = $incomePageInteractor;
        $this->createIncomeInteractor = $createIncomeInteractor;
        $this->updateIncomeInteractor = $updateIncomeInteractor;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $incomeSourceId = $request->filled('income_source_id') ? (int) $request->input('income_source_id') : null;
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $data = $this->incomePageInteractor->handle($incomeSourceId, $startDate, $endDate);

        return view('kakeibo.income.index', $data);
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

        $input = new CreateIncomeInput(
            $request->input('income_source_id'),
            $request->input('amount'),
            $request->input('accrual_date')
        );

        $output = $this->createIncomeInteractor->handle($input, $userId);

        if ($output->isSuccess()) {
            return redirect()->route('incomes.index')->with('success', $output->getMessages()[0]);
        } else {
            return back()->withInput()->withErrors($output->getMessages());
        }
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
        $income = Income::with('incomeSource')->findOrFail($id);
        $incomeSources = IncomeSource::all();
        return view('kakeibo.income.edit', compact('income', 'incomeSources'));
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
        $input = new UpdateIncomeInput(
            $request->input('income_source_id'),
            $request->input('amount'),
            $request->input('accrual_date')
        );

        $output = $this->updateIncomeInteractor->handle($input, $id);

        if ($output->isSuccess()) {
            return redirect()->route('incomes.index')->with('success', $output->getMessages());
        } else {
            return back()->withInput()->withErrors($output->getMessages());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $income = Income::findOrFail($id);
        $income->delete();

        return redirect()->route('incomes.index')->with('success', '収入が削除されました。');
    }
}
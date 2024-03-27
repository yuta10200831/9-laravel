<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IncomeSource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\UseCase\IncomeSource\CreateIncomeSourceInput;
use App\UseCase\IncomeSource\CreateIncomeSourceInteractor;
use App\UseCase\IncomeSource\UpdateIncomeSourceInput;
use App\UseCase\IncomeSource\UpdateIncomeSourceInteractor;

class Income_sourcesController extends Controller
{

    public function __construct(
        CreateIncomeSourceInteractor $createInteractor,
        UpdateIncomeSourceInteractor $updateInteractor
    ) {
        $this->createInteractor = $createInteractor;
        $this->updateInteractor = $updateInteractor;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incomeSources = IncomeSource::all();
        return view('kakeibo.income.income_sources.index', compact('incomeSources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kakeibo.income.income_sources.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $userId = Auth::id();
        $input = new CreateIncomeSourceInput($validatedData['name'], $userId);
        $output = $this->createInteractor->handle($input);

        if ($output->isSuccess()) {
            return redirect()->route('income_sources.index')->with('success', '収入源が正常に追加されました。');
        } else {
            return back()->withInput()->withErrors($output->getErrors());
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
        $incomeSource = IncomeSource::findOrFail($id);
        return view('kakeibo.income.income_sources.edit', compact('incomeSource'));
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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $input = new UpdateIncomeSourceInput($id, $validatedData['name']);
        $output = $this->updateInteractor->handle($input);

        if ($output->isSuccess()) {
            return redirect()->route('income_sources.index')->with('success', '収入源が更新されました。');
        } else {
            return back()->withInput()->withErrors($output->getErrors());
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
        $incomeSource = IncomeSource::findOrFail($id);
        $incomeSource->delete();

        return redirect()->route('income_sources.index')->with('success', '収入源が削除されました。');
    }
}
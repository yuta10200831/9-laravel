<?php

namespace App\Http\Controllers;
use App\Models\Spending;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\UseCase\Spending\SpendingPageInteractor;
use App\UseCase\Spending\CreateSpendingInput;
use App\UseCase\Spending\CreateSpendingInteractor;
use App\UseCase\Spending\UpdateSpendingInput;
use App\UseCase\Spending\UpdateSpendingInteractor;

class SpendingController extends Controller
{

    public function __construct(
        SpendingPageInteractor $spendingPageInteractor,
        CreateSpendingInteractor $createSpendingInteractor,
        UpdateSpendingInteractor $updateSpendingInteractor
    ) {
        $this->spendingPageInteractor = $spendingPageInteractor;
        $this->createSpendingInteractor = $createSpendingInteractor;
        $this->updateSpendingInteractor = $updateSpendingInteractor;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $spendings = $this->spendingPageInteractor->handle(
            $request->input('category_id'),
            $request->input('start_date'),
            $request->input('end_date')
        );

        $totalSpending = $spendings->sum('amount');
        $categories = Category::all();

        return view('kakeibo.spending.index', [
            'spendings' => $spendings,
            'totalSpending' => $totalSpending,
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('kakeibo.spending.create', compact('categories'));
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

        if (is_null($userId)) {
            return redirect()->route('login')->withErrors('ログインしてください。');
        }

        $name = $request->input('name');
        $categoryId = $request->input('category_id');
        $amount = $request->input('amount');
        $accrualDate = $request->input('accrual_date');

        $input = new CreateSpendingInput($name, $categoryId, $amount, $accrualDate, $userId);

        $output = $this->createSpendingInteractor->handle($input);

        if ($output->isSuccess()) {
            return redirect()->route('spendings.index')->with('success', '支出が登録されました。');
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
        $spending = Spending::findOrFail($id);
        $categories = Category::all();
        return view('kakeibo.spending.edit', compact('spending', 'categories'));
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
        $userId = Auth::id();
        if (is_null($userId)) {
            return redirect()->route('login')->withErrors('ログインしてください。');
        }

        $input = new UpdateSpendingInput(
            $id,
            $request->input('name'),
            (int) $request->input('category_id'),
            (float) $request->input('amount'),
            $request->input('accrual_date')
        );

        $output = $this->updateSpendingInteractor->handle($input);

        if ($output->isSuccess()) {
            return redirect()->route('spendings.index')->with('success', '支出が更新されました。');
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
        $spending = Spending::findOrFail($id);
        $spending->delete();

        return redirect()->route('spendings.index')->with('success', '支出が削除されました。');
    }
}
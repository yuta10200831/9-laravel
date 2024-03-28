<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Spending;
use App\Models\Category;
use App\UseCase\Category\CreateCategoryInput;
use App\UseCase\Category\CreateCategoryInteractor;
use App\UseCase\Category\UpdateCategoryInput;
use App\UseCase\Category\UpdateCategoryInteractor;

class CategoriesController extends Controller
{

    public function __construct(
        CreateCategoryInteractor $createCategoryInteractor,
        UpdateCategoryInteractor $updateCategoryInteractor
        )
    {
        $this->createCategoryInteractor = $createCategoryInteractor;
        $this->updateCategoryInteractor = $updateCategoryInteractor;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('kakeibo.spending.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kakeibo.spending.categories.create');
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

        $input = new CreateCategoryInput($request->input('name'), $userId);
        $output = $this->createCategoryInteractor->handle($input);

        if ($output->isSuccess()) {
            return redirect()->route('categories.index')->with('success', 'カテゴリが追加されました。');
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
        $category = Category::findOrFail($id);
        return view('kakeibo.spending.categories.edit', compact('category'));
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
        $input = new UpdateCategoryInput($id, $request->input('name'));
        $output = $this->updateCategoryInteractor->handle($input);

        if ($output->isSuccess()) {
            return redirect()->route('categories.index')->with('success', 'カテゴリが更新されました。');
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
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'カテゴリが削除されました。');
    }
}
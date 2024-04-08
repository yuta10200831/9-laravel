@extends('layouts.header')

@section('title', '収入一覧')

@section('content')
<div class="container mx-auto mt-8">
 <h2 class="text-2xl font-semibold mb-6 text-blue-800">収入一覧</h2>
 <div class="mb-4">
  <p class="text-xl">合計額: <span class="font-bold">{{ number_format($totalIncome) }}円</span></p>
 </div>

 <div class="mb-6">
  <form method="GET" action="{{ route('incomes.index') }}" class="flex items-center space-x-2">
   <select name="income_source_id" class="form-control">
    <option value="">すべての収入源</option>
    @foreach ($incomeSources as $source)
    <option value="{{ $source->id }}" {{ request('income_source_id') == $source->id ? 'selected' : '' }}>
     {{ $source->name }}
    </option>
    @endforeach
   </select>
   <input type="date" name="start_date" class="form-control" value="{{ request ('start_date') }}" placeholder="開始日">
   <span class="mx-2">〜</span>
   <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}" placeholder="終了日">
   <select name="income_category_id" class="form-control">
    <option value="">すべてのカテゴリ</option>
    @foreach ($incomeCategories as $category)
    <option value="{{ $category->id }}" {{ request('income_category_id') == $category->id ? 'selected' : '' }}>
     {{ $category->name }}
    </option>
    @endforeach
   </select>
   <button type="submit" class="ml-4 bg-yellow-500 hover:bg-yellow-600 text-blue font-bold py-2 px-4 rounded shadow">
    検索
   </button>
  </form>
  <div class="mb-6 mt-4">
   <a href="{{ route('incomes.create') }}"
    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg transition ease-in-out duration-300 mt-4">
    収入を登録する
   </a>
   {{-- ここに新しいボタンを追加 --}}
   <a href="{{ route('income_categories.create') }}"
    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow-lg transition ease-in-out duration-300 ml-4">
    収入カテゴリを登録する
   </a>
  </div>
 </div>

 <div class="bg-white shadow-md rounded my-6">
  <table class="text-left w-full border-collapse">
   <thead>
    <tr>
     <th class="py-4 px-6 bg-blue-200 font-bold uppercase text-sm text-grey-dark border-b border-grey-light">収入源</th>
     <th class="py-4 px-6 bg-blue-200 font-bold uppercase text-sm text-grey-dark border-b border-grey-light">カテゴリ</th>
     <th class="py-4 px-6 bg-blue-200 font-bold uppercase text-sm text-grey-dark border-b border-grey-light">金額</th>
     <th class="py-4 px-6 bg-blue-200 font-bold uppercase text-sm text-grey-dark border-b border-grey-light">日付</th>
     <th class="py-4 px-6 bg-blue-200 font-bold uppercase text-sm text-grey-dark border-b border-grey-light">操作</th>

    </tr>
   </thead>
   <tbody>
    @foreach ($incomes as $income)
    <tr class="hover:bg-grey-lighter">
     <td class="py-4 px-6 border-b border-grey-light">
      {{ $income->incomeSource->name ?? '収入源なし' }}
     </td>
     <td class="py-4 px-6 border-b border-grey-light">
      @if ($income->incomeCategories)
      @if ($income->incomeCategories->isNotEmpty())
      @foreach ($income->incomeCategories as $category)
      {{ $loop->first ? '' : ', ' }}
      {{ $category->name }}
      @endforeach
      @else
      {{ 'カテゴリなし' }} {{-- カテゴリがない場合の表示 --}}
      @endif
      @else
      {{ 'カテゴリなし' }} {{-- カテゴリがnullの場合の表示 --}}
      @endif
     </td>
     <td class="py-4 px-6 border-b border-grey-light">{{ number_format($income->amount) }}</td>
     <td class="py-4 px-6 border-b border-grey-light">{{ $income->accrual_date->format('Y-m-d') }}</td>
     <td class="py-4 px-6 border-b border-grey-light">
      <a href="{{ route('incomes.edit', $income->id) }}" class="text-blue-500 pr-4">編集</a>
      <form action="{{ route('incomes.destroy', $income->id) }}" method="POST" class="inline-block">
       @csrf
       @method('DELETE')
       <button type="submit" class="text-red-500" onclick="return confirm('この収入を削除してもよろしいですか？');">削除</button>
      </form>
     </td>
    </tr>
    @endforeach
   </tbody>
  </table>
 </div>
</div>
@endsection
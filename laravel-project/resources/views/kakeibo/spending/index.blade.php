@extends('layouts.header')

@section('title', '支出一覧')

@section('content')
<div class="container mx-auto mt-8">
 <h2 class="text-2xl font-semibold mb-6 text-blue-800">支出一覧</h2>
 <div class="mb-4">
  <p class="text-xl">合計額: <span class="font-bold">{{ number_format($totalSpending) }}円</span></p>
 </div>

 <div class="mb-6">
  {{-- 検索フォーム --}}
  <form method="GET" action="{{ route('spendings.index') }}" class="flex items-center space-x-2 mb-6">

   {{-- カテゴリ選択 --}}
   <select name="category_id" class="form-control">
    <option value="">カテゴリーで絞り込む</option>
    @foreach ($categories as $category)
    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
     {{ $category->name }}
    </option>
    @endforeach
   </select>

   {{-- 日付選択 --}}
   <input type="date" name="start_date" class="form-control" placeholder="開始日">
   <span class="mx-2 text-gray-500">〜</span>
   <input type="date" name="end_date" class="form-control" placeholder="終了日">

   {{-- 検索ボタン --}}
   <button type="submit" class="ml-4 bg-yellow-500 hover:bg-yellow-600 text-blue font-bold py-2 px-6 rounded shadow">
    検索
   </button>
  </form>
  <a href="{{ route('spendings.create') }}"
   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg transition ease-in-out duration-300">
   支出を登録する
  </a>
 </div>

 <div class="bg-white shadow-md rounded my-6">
  <table class="text-left w-full border-collapse">
   <thead>
    <tr>
     <th class="py-4 px-6 bg-blue-200 font-bold uppercase text-sm text-grey-dark border-b border-grey-light">支出名</th>
     <th class="py-4 px-6 bg-blue-200 font-bold uppercase text-sm text-grey-dark border-b border-grey-light">カテゴリー</th>
     <th class="py-4 px-6 bg-blue-200 font-bold uppercase text-sm text-grey-dark border-b border-grey-light">金額</th>
     <th class="py-4 px-6 bg-blue-200 font-bold uppercase text-sm text-grey-dark border-b border-grey-light">日付</th>
     <th class="py-4 px-6 bg-blue-200 font-bold uppercase text-sm text-grey-dark border-b border-grey-light">操作</th>
    </tr>
   </thead>
   <tbody>
    @forelse ($spendings as $spending)
    <tr class="hover:bg-grey-lighter">
     <td class="py-4 px-6 border-b border-grey-light">{{ $spending->name }}</td>
     <td class="py-4 px-6 border-b border-grey-light">{{ $spending->category->name }}</td>
     <td class="py-4 px-6 border-b border-grey-light">¥{{ number_format($spending->amount) }}</td>
     <td class="py-4 px-6 border-b border-grey-light">{{ $spending->accrual_date->format('Y-m-d') }}</td>
     <td class="py-4 px-6 border-b border-grey-light">
      <a href="{{ route('spendings.edit', $spending->id) }}" class="text-blue-500 hover:text-blue-800">編集</a>
      <form action="{{ route('spendings.destroy', $spending->id) }}" method="POST" class="inline-block">
       @csrf
       @method('DELETE')
       <button type="submit" class="text-red-500 hover:text-red-800"
        onclick="return confirm('この支出を削除してもよろしいですか？');">削除</button>
      </form>
     </td>
    </tr>
    @empty
    <tr>
     <td colspan="5" class="text-center py-4 px-6 border-b border-grey-light">データがありません</td>
    </tr>
    @endforelse
   </tbody>
  </table>
 </div>
</div>
@endsection
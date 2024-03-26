@extends('layouts.header')

@section('title', '支出登録')

@section('content')
<div class="container mx-auto mt-8">
 <div class="flex justify-center">
  <div class="w-full max-w-2xl">
   <h2 class="text-2xl font-semibold mb-6 text-blue-800 text-center">支出を登録する</h2>
   <div class="bg-white p-12 border border-blue-300 rounded-lg shadow-lg">
    <form action="{{ route('spendings.store') }}" method="POST">
     @csrf
     <div class="mb-3">
      <label for="name" class="block text-blue-800 text-lg font-bold mb-2">支出名</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="支出名を入力してください" required>
     </div>
     <div class="mb-3">
      <label for="category_id" class="block text-blue-800 text-lg font-bold mb-2">カテゴリー</label>
      <div class="flex items-center mb-3">
       <select class="form-control mr-2" id="category_id" name="category_id" required>
        <option value="">カテゴリーを選択してください</option>
        @foreach ($categories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
       </select>
       <a href="{{ route('categories.index') }}"
        class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 border border-blue-700 rounded">
        カテゴリ一覧へ
       </a>
      </div>
     </div>
     <div class="mb-6">
      <label for="amount" class="block text-blue-800 text-lg font-bold mb-2">金額</label>
      <input type="number" class="form-control" id="amount" name="amount" placeholder="金額を入力してください" required>
     </div>
     <div class="mb-6">
      <label for="accrual_date" class="block text-blue-800 text-lg font-bold mb-2">日付</label>
      <input type="date" class="form-control" id="accrual_date" name="accrual_date" required>
     </div>
     <div class="flex items-center justify-between">
      <button type="submit"
       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded focus:outline-none focus:shadow-outline w-full text-lg">
       登録
      </button>
     </div>
     <div class="text-center mt-6">
      <a href="{{ route('spendings.index') }}" class="text-blue-500 hover:text-blue-800 text-lg">
       戻る
      </a>
     </div>
    </form>
   </div>
  </div>
 </div>
</div>
@endsection
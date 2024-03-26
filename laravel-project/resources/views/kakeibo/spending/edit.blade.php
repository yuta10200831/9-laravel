@extends('layouts.header')

@section('title', '支出の編集')

@section('content')

<div class="container mx-auto mt-8">
 <div class="w-full max-w-lg mx-auto">
  <h2 class="text-2xl font-semibold mb-4 text-center">支出を編集</h2>
  @if ($errors->any())
  <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
   <strong class="font-bold">エラー</strong>
   <span class="block sm:inline">入力に問題があります。</span>
   <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
   </ul>
  </div>
  @endif
  <form action="{{ route('spendings.update', $spending->id) }}" method="POST"
   class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
   @csrf
   @method('PUT')
   <!-- 支出名 -->
   <div class="mb-4">
    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">支出名:</label>
    <input type="text" name="name" id="name" value="{{ old('name', $spending->name) }}"
     class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
     required>
   </div>
   <!-- カテゴリー -->
   <div class="mb-4">
    <label for="category_id" class="block text-gray-700 text-sm font-bold mb-2">カテゴリー:</label>
    <select name="category_id" id="category_id"
     class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
     required>
     @foreach ($categories as $category)
     <option value="{{ $category->id }}" {{ $spending->category_id == $category->id ? 'selected' : '' }}>
      {{ $category->name }}</option>
     @endforeach
    </select>
   </div>
   <!-- 金額 -->
   <div class="mb-4">
    <label for="amount" class="block text-gray-700 text-sm font-bold mb-2">金額:</label>
    <input type="number" name="amount" id="amount" value="{{ old('amount', $spending->amount) }}"
     class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
     required>
   </div>
   <!-- 日付 -->
   <div class="mb-4">
    <label for="accrual_date" class="block text-gray-700 text-sm font-bold mb-2">日付:</label>
    <input type="date" name="accrual_date" id="accrual_date"
     value="{{ old('accrual_date', $spending->accrual_date->format('Y-m-d')) }}"
     class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
     required>
   </div>
   <!-- 更新ボタン -->
   <div class="flex items-center justify-between">
    <button type="submit"
     class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">更新</button>
    <a href="{{ route('spendings.index') }}"
     class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">キャンセル</a>
   </div>
  </form>
 </div>
</div>
@endsection
@extends('layouts.header')

@section('title', '収入カテゴリー作成')

@section('content')
<div class="flex justify-center pt-8 pb-24 bg-gray-100">
 <div class="w-full max-w-2xl">
  <h2 class="text-2xl font-semibold mb-6 text-blue-800 text-center">カテゴリの登録</h2>
  <div class="bg-white p-12 border border-blue-300 rounded-lg shadow-lg">
   <form method="POST" action="{{ route('income_categories.store') }}" class="mb-4">
    @csrf
    <div class="mb-6">
     <label for="name" class="block text-blue-800 text-lg font-bold mb-2">カテゴリ名</label>
     <input type="text"
      class="form-input mt-1 block w-full border rounded py-2 px-3 shadow outline-none ring-blue-300 focus:ring"
      id="name" name="name" placeholder="カテゴリ名を入力してください" required>
    </div>
    <button type="submit"
     class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded focus:outline-none focus:shadow-outline text-lg">
     登録
    </button>
   </form>
   <div class="text-center">
    <a href="{{ route('income_categories.index') }}"
     class="w-full inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-4 rounded focus:outline-none focus:shadow-outline text-lg">
     一覧へ
    </a>
   </div>
  </div>
 </div>
</div>
@endsection
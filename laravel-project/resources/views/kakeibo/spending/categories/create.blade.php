@extends('layouts.header')

@section('title', 'カテゴリ登録')

@section('content')
<div class="container mx-auto mt-8  max-w-xl">
 <h2 class="text-2xl font-semibold mb-6 text-blue-800 text-center">カテゴリ登録</h2>
 <div class="bg-white p-8 border border-blue-300 rounded-lg shadow-lg">
  <form method="POST" action="{{ route('categories.store') }}">
   @csrf
   <div class="mb-4">
    <label for="name" class="block text-grey-darker text-sm font-bold mb-2">カテゴリ名</label>
    <input type="text" id="name" name="name"
     class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" placeholder="カテゴリ名を入力してください">
   </div>
   <div class="flex items-center justify-between">
    <button type="submit"
     class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">登録</button>
    <a href="{{ route('categories.index') }}"
     class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">戻る</a>
   </div>
  </form>
 </div>
</div>
@endsection
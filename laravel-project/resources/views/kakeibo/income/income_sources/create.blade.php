@extends('layouts.header')

@section('title', '収入源登録')

@section('content')
<div class="flex justify-center pt-8 pb-24 bg-gray-100">
 <div class="w-full max-w-xl">
  <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
   <h1 class="text-xl mb-4 text-center font-semibold text-blue-800">収入源を登録する</h1>
   <form action="{{ route('income_sources.store') }}" method="POST">
    @csrf
    <div class="mb-4">
     <label for="name" class="block text-gray-700 text-sm font-bold mb-2">収入源名</label>
     <input type="text"
      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
      id="name" name="name" required>
    </div>
    <div class="flex items-center justify-between">
     <button type="submit"
      class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
      登録する
     </button>
     <a href="{{ route('income_sources.index') }}"
      class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
      戻る
     </a>
    </div>
   </form>
  </div>
 </div>
</div>
@endsection
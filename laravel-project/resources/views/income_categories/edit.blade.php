@extends('layouts.header')

@section('title', '収入カテゴリー編集')

@section('content')
<div class="container mx-auto mt-10">
 <div class="w-full max-w-2xl mx-auto bg-white p-8 border border-blue-200 rounded-lg">
  <h1 class="text-xl font-semibold mb-5 text-center text-blue-800">カテゴリ編集</h1>

  @if ($errors->any())
  <div class="mb-5 p-4 bg-red-100 text-red-700 border border-red-400 rounded">
   <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
   </ul>
  </div>
  @endif

  <form action="{{ route('income_categories.update', $incomeCategory->id) }}" method="POST">
   @csrf
   @method('PUT')
   <div class="mb-6">
    <label for="name" class="block text-blue-700 text-sm font-bold mb-2">カテゴリ名:</label>
    <input type="text"
     class="form-input w-full border rounded py-2 px-4 leading-tight focus:outline-none focus:border-blue-500"
     name="name" id="name" value="{{ $incomeCategory->name }}" required>
   </div>
   <div class="flex items-center justify-between">
    <button type="submit"
     class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
     更新する
    </button>
    <a href="{{ route('income_categories.index') }}" class="text-blue-500 hover:text-blue-800">
     キャンセル
    </a>
   </div>
  </form>
 </div>
</div>
@endsection
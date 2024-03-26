@extends('layouts.header')

@section('title', 'カテゴリ編集')

@section('content')
<div class="container mx-auto mt-8">
 <div class="w-full max-w-md mx-auto bg-white shadow-lg rounded-lg">
  <div class="py-4 px-8 text-black text-xl">カテゴリを編集する</div>

  @if ($errors->any())
  <div class="py-4 px-8">
   <ul class="list-disc list-inside text-red-600">
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
   </ul>
  </div>
  @endif

  <form action="{{ route('categories.update', $category->id) }}" method="post" class="py-4 px-8">
   @csrf
   @method('PUT')
   <div class="mb-4">
    <label for="name" class="block text-blue-700 text-sm font-bold mb-2">カテゴリ名:</label>
    <input type="text" name="name" id="name" value="{{ $category->name }}"
     class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline">
   </div>
   <div class="flex items-center justify-between">
    <button type="submit"
     class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">更新する</button>
   </div>
  </form>
 </div>
</div>
@endsection
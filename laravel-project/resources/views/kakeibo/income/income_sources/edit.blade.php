@extends('layouts.header')

@section('title', '収入源の編集')

@section('content')
<div class="container mx-auto mt-8">
 <div class="w-full max-w-xl mx-auto">
  <h2 class="text-2xl font-semibold mb-6 text-center text-blue-800">収入源の編集</h2>

  @if(session('error'))
  <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
   {{ session('error') }}
  </div>
  @endif

  <form action="{{ route('income_sources.update', $incomeSource->id) }}" method="POST"
   class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
   @csrf
   @method('PUT')

   <div class="mb-4">
    <label for="name" class="block text-blue-700 text-sm font-bold mb-2">収入源名</label>
    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="name"
     name="name" value="{{ old('name', $incomeSource->name) }}" required>
    @error('name')
    <p class="text-red-500 text-xs italic">{{ $message }}</p>
    @enderror
   </div>

   <div class="flex items-center justify-between">
    <button type="submit"
     class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
     更新
    </button>
    <a href="{{ route('income_sources.index') }}"
     class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
     戻る
    </a>
   </div>
  </form>
 </div>
</div>
@endsection
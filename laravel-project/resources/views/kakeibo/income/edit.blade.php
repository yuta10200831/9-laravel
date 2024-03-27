@extends('layouts.header')

@section('title', '収入の編集')

@section('content')
<div class="container mx-auto mt-8">
 <div class="w-full max-w-2xl mx-auto">
  <h2 class="text-2xl font-semibold mb-6 text-center text-blue-800">収入の編集</h2>

  @if(session('error'))
  <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
   {{ session('error') }}
  </div>
  @endif

  <form action="{{ route('incomes.update', $income->id) }}" method="POST"
   class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
   @csrf
   @method('PUT')

   <div class="mb-4">
    <label for="income_source_id" class="block text-blue-700 text-sm font-bold mb-2">収入源</label>
    <select name="income_source_id"
     class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
     @foreach ($incomeSources as $source)
     <option value="{{ $source->id }}" {{ $income->income_source_id == $source->id ? 'selected' : '' }}>
      {{ $source->name }}</option>
     @endforeach
    </select>
   </div>

   <div class="mb-4">
    <label for="amount" class="block text-blue-700 text-sm font-bold mb-2">金額</label>
    <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="amount"
     name="amount" value="{{ old('amount', $income->amount) }}" required>
   </div>

   <div class="mb-4">
    <label for="accrual_date" class="block text-blue-700 text-sm font-bold mb-2">日付</label>
    <input type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="accrual_date"
     name="accrual_date" value="{{ old('accrual_date', $income->accrual_date->format('Y-m-d')) }}" required>
   </div>

   @error('name')
   <div class="alert alert-danger">{{ $message }}</div>
   @enderror

   <div class="flex items-center justify-between">
    <button type="submit"
     class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
     更新
    </button>
    <a href="{{ route('incomes.index') }}"
     class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
     戻る
    </a>
   </div>
  </form>
 </div>
</div>
@endsection
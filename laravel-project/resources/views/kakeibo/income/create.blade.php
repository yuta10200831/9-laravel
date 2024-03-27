@extends('layouts.header')

@section('title', '収入登録')

@section('content')
<div class="flex justify-center pt-8 pb-24 bg-gray-100">
 <div class="w-full max-w-2xl">
  <h2 class="text-2xl font-semibold mb-6 text-blue-800 text-center">収入登録</h2>
  <div class="bg-white p-12 border border-blue-300 rounded-lg shadow-lg">
   <form method="POST" action="{{ route('incomes.store') }}">
    @csrf
    <div class="mb-3">
     <label for="amount" class="block text-blue-800 text-lg font-bold mb-2">収入源</label>
     <div class="flex items-center">
      <select name="income_source_id" id="income_source_id" class="form-control mr-2">
       <option value="">収入源を選択</option>
       @foreach($incomeSources as $incomeSource)
       <option value="{{ $incomeSource->id }}">{{ $incomeSource->name }}</option>
       @endforeach
      </select>
      <a href="{{ route('income_sources.index') }}"
       class="inline-block bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 border border-blue-700 rounded shadow-lg ">
       収入源一覧へ
      </a>
     </div>
    </div>
    <div class="mb-6">
     <label for="amount" class="block text-blue-800 text-lg font-bold mb-2">金額</label>
     <input type="number" id="amount" name="amount" required class="w-full p-3 border rounded text-lg">
    </div>
    <div class="mb-6">
     <label for="accrual_date" class="block text-blue-800 text-lg font-bold mb-2">日付</label>
     <input type="date" id="accrual_date" name="accrual_date" required class="w-full p-3 border rounded text-lg">
    </div>
    <div class="flex items-center justify-between">
     <button type="submit"
      class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded focus:outline-none focus:shadow-outline text-lg">
      登録する
     </button>
    </div>
    <div class="text-center mt-6">
     <a href="{{ route('incomes.index') }}" class="inline-block text-blue-500 hover:text-blue-800 text-lg">
      戻る
     </a>
    </div>
   </form>
  </div>
 </div>
</div>
@endsection
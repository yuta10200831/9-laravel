@extends('layouts.header')

@section('title', 'トップページ')

@section('content')
<div class="mx-auto my-8 w-4/5">
 <div class="text-center my-8">
  <h1 class="text-4xl mb-4">家計簿アプリ</h1>
  <div class="flex justify-center items-center mb-4">
   <form action="{{ url('/') }}" method="GET" class="flex items-center">
    <div class="flex border-2 border-blue-500 rounded">
     <select name="year" class="bg-white p-2 focus:outline-none">
      <option value="2022">2022年</option>
      <option value="2023">2023年</option>
      <option value="2024">2024年</option>
     </select>
     <span class="px-4 py-2 bg-blue-500 text-white font-bold">
      の収支一覧
     </span>
    </div>
    <button type="submit" class="ml-4 bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded shadow">
     検索
    </button>
   </form>
  </div>
 </div>
 <table class="min-w-full table-auto border-collapse border border-gray-400">
  <thead class="bg-gray-200">
   <tr>
    <th class="border border-gray-300 px-4 py-2">月</th>
    <th class="border border-gray-300 px-4 py-2">収入</th>
    <th class="border border-gray-300 px-4 py-2">支出</th>
    <th class="border border-gray-300 px-4 py-2">収支</th>
   </tr>
  </thead>
  <tbody>
   @foreach ($fixed_data as $data)
   <tr class="hover:bg-gray-100">
    <td class="border border-gray-300 px-4 py-2 text-center">{{ $data['month'] }}</td>
    <td class="border border-gray-300 px-4 py-2 text-right">{{ number_format($data['total_income']) }}円</td>
    <td class="border border-gray-300 px-4 py-2 text-right">{{ number_format($data['total_spend']) }}円</td>
    <td class="border border-gray-300 px-4 py-2 text-right">
     {{ number_format($data['total_income'] - $data['total_spend']) }}円</td>
   </tr>
   @endforeach
  </tbody>
 </table>
</div>
@endsection